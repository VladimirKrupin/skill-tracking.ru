<?php
namespace App\Http\Response;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class ValidatorResponse extends Res
{
    static function get($message = null)
    {
        return new Response($message,400,['Access-Control-Allow-Origin'=>'*']);
    }
}