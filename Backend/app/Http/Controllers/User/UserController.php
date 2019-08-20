<?php
namespace App\Http\Controllers\User;
use App\Http\Helpers\Common;
use App\Http\Helpers\Logs;
use App\Http\Helpers\PodioItemValues;
use App\Http\Models\User\UsersPasswordChange;
use App\Http\Models\User\UsersPasswordReset;
use App\Http\Resources\UsersResource;
use App\Mail\RegistrationSuccessEmployee;
use App\Mail\User\ChangePassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\User\User;
use App\Http\Models\User\OauthAccessToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Mail\RegistrationSuccess;
use App\Mail\User\ResetPassword;
use App\Mail\User\ResetPasswordSuccess;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
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
        var_dump($user->toArray());
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не корректный email или пароль']],
            ]);
        }

        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if (empty($user)){
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не верный логин или пароль']],
            ]);
        }

        $validCredentials = Hash::check($input['password'], $user->getAuthPassword());

        if (!$validCredentials) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не верный логин или пароль']],
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'data' => ['token' => $user->createToken('MyApp')->accessToken],
        ]);
    }

}
