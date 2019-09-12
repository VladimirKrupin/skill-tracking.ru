<?php
namespace App\Http\Middleware;

use App\Http\Helpers\AppHelper;
use App\Http\Registry\AppRegistry;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Locale {

    public function __construct()
    {
        AppRegistry::set('lang',['en','ru']);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale(AppHelper::checkLang($request->header('lang')));
        return $next($request);
    }

}