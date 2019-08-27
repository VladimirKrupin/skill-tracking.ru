<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Models\User\User;
use App\Http\Resources\Common\SuccessResource;
use App\Http\Resources\User\UserDataResource;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Response\SuccessResponse;
use App\Http\Response\UnauthorizedResponse;
use App\Http\Response\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

}
