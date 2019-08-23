<?php
namespace App\Http\Response;

use Illuminate\Support\Facades\App;

class UnauthorizedResponse extends Response
{
    static function get($message = null)
    {
        // Set default locale
        App::setLocale('en');
        return response(['error'=>($message)?$message:__('errors.unauthorized')],401,['Access-Control-Allow-Origin'=>'*']);
    }
}