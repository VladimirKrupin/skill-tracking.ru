<?php
namespace App\Http\Response;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;

class UnauthorizedResponse
{
    static function get($message = null)
    {
        // Set default locale
        App::setLocale('en');
        return new Response(['error'=>($message)?$message:__('errors.unauthorized')],401,['Access-Control-Allow-Origin'=>'*']);
    }
}