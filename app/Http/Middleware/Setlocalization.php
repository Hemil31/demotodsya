<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Setlocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check header request and determine localizaton
        // dd('hello');
        if ($request->is('api/*') || $request->expectsJson()) {
            $lang = $request->header('Accept-Language', 'en'); // default 'en'
            app()->setLocale($lang);
        }
        return $next($request);

    }
}
