<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Mail\User\ForgotPasswordMail;
use App\Http\Mail\User\RegisterConfirmationMail;
use App\Http\Mail\User\RegistrationSuccess;
use App\Http\Mail\User\ResetPasswordMail;
use App\Http\Models\User\ForgotPassword;
use App\Http\Models\User\RegisterConfirmation;
use App\Http\Models\User\User;
use App\Http\Resources\User\UserDataResource;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Response\SuccessResponse;
use App\Http\Response\UnauthorizedResponse;
use App\Http\Response\ValidatorResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
//        var_dump(App::getLocale());
        $input = [
            'email' => $request->input('email'),
            'host' => $request->input('host'),
        ];
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:users|unique:register_confirmation',
            'host' => 'required|string|max:25',
        ]);
        if ($validator->fails()) {
            $error_str = '';
            foreach ($validator->errors()->all() as $error){
                $error_str .= ' '.$error;
            }
            return ValidatorResponse::get(['error' => "$error_str"]);
        }

        $hash = str_random(50);
        $mailData['hash'] = $hash;
        $mailData['host'] = $request->input('host');

        RegisterConfirmation::create([
            'email' => $request->input('email'),
            'hash' => $hash,
        ]);
        Mail::to($input['email'])->send(new RegisterConfirmationMail($mailData));
    }

    public function registerConfirmation(Request $request)
    {
        //валидация запроса
        $validator = Validator::make($request->all(), [
            'hash' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $hash =  $request->input('hash');

        $register_confirmation = RegisterConfirmation::where('hash', $hash)->first();

        if (!$register_confirmation){
            return ValidatorResponse::get(['error'=>__('register.bad_link')]);
        }

        $register_confirmation->hash = 0;
        $register_confirmation->save();

        $pass = str_random(8);
        $input['email'] = $register_confirmation->email;
        $input['password'] = bcrypt($pass);
        $input['lang'] = $request->header('lang');

        if (User::create($input)){
            $user = User::where('email',$input['email'])->first();
            Mail::to($input['email'])->send(new RegistrationSuccess($input['email'],$pass));
        }

        return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);
    }

    public function userCreate(Request $request){

    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {return UnauthorizedResponse::get();}

        $input = $request->all();

        if (! $user = User::where('email', $input['email'])->first()){return UnauthorizedResponse::get(__('errors.unknown_user'));}

        if (! Hash::check($input['password'], $user->getAuthPassword())){return UnauthorizedResponse::get(__('errors.wrong_password'));}

        return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);

    }

    public function getUserData(Request $request){
        return new UserDataResource(Auth::user());
    }

    public function putLang(Request $request){
        $validator = Validator::make($request->all(), [
            'lang' => 'required|string|min:2|max:2',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        User::where('id',Auth::user()['id'])->update(['lang'=>$request->input('lang')]);

        return new SuccessResponse();

    }

    public function forgotPassword(Request $request)
    {
        //валидация запроса
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'host' => 'required|string|max:25',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $email = $request->input('email');
        $host =  $request->input('host');

        if (!$user = User::where('email',$request->input('email'))->with('forgotPassword')->first()){
            return ValidatorResponse::get(__('errors.not_found_user'));
        }

        $hash = str_random(50);
        if (is_null($user['forgotPassword'])){
            ForgotPassword::create([
                'email' => $email,
                'hash' => $hash,
                'attempts' => 1
            ]);
            $mailData = [
              'hash' => $hash,
              'host' => $host
            ];
            Mail::to($email)->send(new ForgotPasswordMail($mailData));
        }else{
            $user_forgot = $user['forgotPassword']->toArray();
            $today = Carbon::today();
            $diff_in_hours = $today->diffInHours($user_forgot['updated_at'], true);
            if ($user_forgot['attempts'] === 2 && $diff_in_hours < 24){
                return ValidatorResponse::get(['error' => __('errors.attempts')]);
            }elseif($user_forgot['attempts'] === 2 && $diff_in_hours > 24){
                ForgotPassword::where('email', $email)->update([
                    'hash' => $hash,
                    'attempts' => 1
                ]);
                $mailData = [
                    'hash' => $hash,
                    'host' => $host
                ];
                Mail::to($email)->send(new ForgotPasswordMail($mailData));
            }
            else{
                ForgotPassword::where('email', $email)->update([
                    'hash' => $hash,
                    'attempts' => $user_forgot['attempts']+1
                ]);
                $mailData = [
                    'hash' => $hash,
                    'host' => $host
                ];
                Mail::to($email)->send(new ForgotPasswordMail($mailData));
            }
        }
    }
    public function resetPassword(Request $request)
    {
        //валидация запроса
        $validator = Validator::make($request->all(), [
            'hash' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $hash =  $request->input('hash');

        $forgot_password = ForgotPassword::where('hash', $hash)->first();

        if (!$forgot_password){
            return ValidatorResponse::get(['error'=>__('forgot.bad_link')]);
        }

        $forgot_email = $forgot_password->email;
        $forgot_password->attempts = 2;
        $forgot_password->hash = 0;
        $forgot_password->save();
        $pass = str_random(8);

        $user = User::where('email',$forgot_email)->first();
        $user->password = bcrypt($pass);
        $user->save();

        $mailData = [
            'pass' => $pass
        ];

        Mail::to($forgot_email)->send(new ResetPasswordMail($mailData));

        return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);
    }

}
