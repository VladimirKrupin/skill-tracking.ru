<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\Http\Mail\User\ChangePasswordMail;
use App\Http\Mail\User\ForgotPasswordMail;
use App\Http\Mail\User\RegisterConfirmationMail;
use App\Http\Mail\User\RegistrationSuccess;
use App\Http\Mail\User\ResetPasswordMail;
use App\Http\Models\User\ChangePassword;
use App\Http\Models\User\ForgotPassword;
use App\Http\Models\User\RegisterConfirmation;
use App\Http\Models\User\User;
use App\Http\Models\User\UserSetting;
use App\Http\Registry\AppRegistry;
use App\Http\Resources\User\UserDataResource;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Response\SuccessResponse;
use App\Http\Response\UnauthorizedResponse;
use App\Http\Response\ValidatorResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private $today;

    public function __construct()
    {
        $this->today = Carbon::today();
    }

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

        if (User::create($input)){
            $user = User::where('email',$input['email'])->first();
            UserSetting::create([
                'user_id'=>$user->id,
                'key'=>'lang',
                'value' => AppHelper::checkLang($request->header('lang'))

            ]);
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
        return new UserDataResource(User::where('id',Auth::user()['id'])->with('settings')->first());
    }

    public function putLang(Request $request){
        $validator = Validator::make($request->all(), [
            'lang' => 'required|string|min:2|max:2',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $user_settings = UserSetting::where('user_id',Auth::user()['id'])->where('key','lang')->first();
        if ($user_settings){
            $user_settings->value = $request->input('lang');
            $user_settings->save();
        }else{
            UserSetting::create([
                'user_id'=>Auth::user()['id'],
                'key'=>'lang',
                'value'=>$request->input('lang')
            ]);
        }
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
            $diff_in_hours = $this->today->diffInHours($user_forgot['updated_at'], true);
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

        DB::table('oauth_access_tokens')
            ->where('user_id', $user->id)
            ->update([
                'revoked' => 1
            ]);

        $mailData = [
            'pass' => $pass
        ];

        Mail::to($forgot_email)->send(new ResetPasswordMail($mailData));

        return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);
    }

    public function changePassword(Request $request){
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password.oldPassword' => 'required|max:50',
            'password.newPasswordConfirm' => 'required|max:50',
            'password.newPassword' => 'required|max:50',
            'host' => 'required|string|max:25',
        ]);
        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $validOldPassword = Hash::check($request->input('password.oldPassword'), $user->getAuthPassword());

        if (!$validOldPassword){return ValidatorResponse::get(__('change.bad_old'));}

        if ($request->input('password.newPassword') !== $request->input('password.newPasswordConfirm')){
            return ValidatorResponse::get(__('change.not_match'));
        }

        $user_current = User::where('id',$user['id'])->with('changePassword')->first();

        if (is_null($user_current->changePassword)){
            ChangePassword::create([
                'user_id' => $user['id']
            ]);
        }else{
            if ($this->today->diffInHours($user_current->changePassword->updated_at, true) < 24){
                return ValidatorResponse::get(__('change.wait'));
            }
        }

        $newPassword = bcrypt($request->input('password.newPassword'));

        User::where('id',$user['id'])->update([
           'password'=>$newPassword
        ]);

        $hash = str_random(50);

        $forgot = ForgotPassword::where('email',$user['email'])->first();

        if ($forgot){
            $forgot->hash = $hash;
            $forgot->attempts = 2;
            $forgot->save();
        }else{
            ForgotPassword::create([
                'email'=>$user['email'],
                'hash'=>$hash,
                'attempts'=>1,
            ]);
        }

        $mailData = [
          'hash' => $hash,
          'host' => $request->input('host'),
        ];
        Mail::to($user['email'])->send(new ChangePasswordMail($mailData));

        return new SuccessResponse();
    }

}
