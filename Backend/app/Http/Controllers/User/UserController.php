<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Mail\User\ForgotPasswordMail;
use App\Http\Mail\User\RegistrationSuccess;
use App\Http\Models\User\ForgotPassword;
use App\Http\Models\User\User;
use App\Http\Resources\Common\SuccessResource;
use App\Http\Resources\User\UserDataResource;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Response\SuccessResponse;
use App\Http\Response\UnauthorizedResponse;
use App\Http\Response\ValidatorResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function register(Request $request)
    {
//        var_dump(App::getLocale());
        $input = [
            'email' => $request->input('email'),
        ];
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            $error_str = '';
            foreach ($validator->errors()->all() as $error){
                $error_str .= ' '.$error;
            }
            return ValidatorResponse::get(['error' => "$error_str"]);
        }
        $pass = str_random(8);
        $input['password'] = bcrypt($pass);
        $input['lang'] = $request->header('lang');
        if (User::create($input)){
            $user = User::where('email',$input['email'])->first();
            Mail::to($input['email'])->send(new RegistrationSuccess($input['email'],$pass));
            return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);
        }
    }

    public function create(Request $request)
    {
        $input = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'name' => $request->input('name'),
        ];
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            $error_str = '';
            foreach ($validator->errors()->all() as $error){
                $error_str .= ' '.$error;
            }
            return ['error' => "Ошибка при валидации данных для создания учетной записи. $error_str"];
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
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
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        $email = $request->input('email');
        $host =  $request->getSchemeAndHttpHost();

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
            $diff_in_hours = $today->diffInHours($user_forgot['updated_at'], false);
            if ($user_forgot['attempts'] === 2 && $diff_in_hours < 24){
                return ValidatorResponse::get(__('errors.attempts'));
            }else{
                $mailData = [
                    'hash' => $hash,
                    'host' => $host
                ];
                Mail::to($email)->send(new ForgotPasswordMail($mailData));
            }
        }

        die;

        // посмотрим сбрасывали уже пароль пароль
        $user_reset = UsersPasswordReset::where('email',$request->input('email'))->first();

        if ($user_reset) {
            if (!$this->checkAttemts($user_reset)) {
                return response()->json(['error' => ['email' => ['Количество попыток восстановления ограничено, попробуйте позже']]], 200);
            }
            return response()->json(['resendmail' => ['message' => ['Не пришло письмо?']], 'error' => ['email' => ['Письмо уже было отправлено, проверте почту и следуйте инструкциям в письме']]], 200);
        }

        //если все нормально
        //сделаем ему хэш и секрет хэш, секрет отправим в письме, а ключ отправим в респонсе, потом будем проверять
        $hash = str_random(200);
        $link = $request->input('host').'/forgot-password/#'.$hash;

        UsersPasswordReset::create([
            'email' => $request->input('email'),
            'hash' => $hash,
        ]);

        Mail::to($request->input('email'))->send(new ResetPassword($link));

        return response()->json([
            'success'=>'Письмо с инструкцией для сброса пароля было отправленно вам на почту. Откройте его и следуйте инструкции.',
            'hash' => $hash
        ], 200);

    }

}
