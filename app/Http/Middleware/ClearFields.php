<?php

namespace App\Http\Middleware;

use Closure;

class ClearFields
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
        $request["document"] = str_replace([".", "-", "/"], "", $request["documento"]);
        return $next($request);
    }
}
