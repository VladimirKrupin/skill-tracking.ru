<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Locale {

    private $allowed_languages = [
      'en','ru'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale((in_array($req_lang = $request->header('lang'),$this->allowed_languages))?$req_lang:Config::get('app.locale'));
        return $next($request);
    }

}