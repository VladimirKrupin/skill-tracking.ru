<?php
namespace App\Http\Response;
use Illuminate\Support\Facades\App;

class Response
{
    public function __construct()
    {
        // Set default locale
        App::setLocale('en');
    }
}