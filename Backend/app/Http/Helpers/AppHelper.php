<?php
namespace App\Http\Helpers;

use App\Http\Registry\AppRegistry;
use Illuminate\Support\Facades\Config;

class AppHelper
{
    public static function checkLang($lang){
        return (in_array($lang,AppRegistry::get('lang')))?$lang:Config::get('app.locale');
    }
}