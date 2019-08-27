<?php
namespace App\Http\Response;

use Illuminate\Http\Response;

class SuccessResponse extends Res
{
    static function get()
    {
        return new Response([],200,['Access-Control-Allow-Origin'=>'*']);
    }
}