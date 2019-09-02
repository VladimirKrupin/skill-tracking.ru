<?php
namespace App\Http\Response;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UnauthorizedResponse extends Res
{
    static function get($message = null)
    {
//        if (!$lang = Auth::user()['lang']){
//            $lang = $_COOKIE['lang'];
//        }
        return new Response(['error'=>($message)?$message:__('errors.unauthorized')],401,['Access-Control-Allow-Origin'=>'http://localhost:8080','Access-Control-Allow-Credentials'=>'true']);
    }
}