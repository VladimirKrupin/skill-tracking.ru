<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Models\User\User;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Response\UnauthorizedResponse;
use Illuminate\Http\Request;
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
        var_dump($user->toArray());
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {return UnauthorizedResponse::get();}

        $input = $request->all();

        if (! $user = User::where('email', $input['email'])->first()){return response(['error'=>'message'],401);}

        if (! Hash::check($input['password'], $user->getAuthPassword())){return response(['error'=>'message'],401);}

        return new UserLoginResource( (object) ['token' => $user->createToken('MyApp')->accessToken]);



    }

}
