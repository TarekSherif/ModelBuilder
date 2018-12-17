<?php

namespace App\Http\Middleware;

use Closure;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
            if(session()->has("lang")){
                $CurrentLang=session("lang");
            }
            else{
                $CurrentLang="en";
                session()->put("lang", $CurrentLang);
            }
            
        app()->setLocale($CurrentLang);

        return $next($request);
    }
}
