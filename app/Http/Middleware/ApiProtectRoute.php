<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiProtectRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            $arrayRouteVerify = ["api","web"];
            if(in_array($arrayRouteVerify[0],$request->route()->middleware())){
                $request['routeType'] = "api";
            }

            if(in_array($arrayRouteVerify[1],$request->route()->middleware())){
                $request['routeType'] = "web";
            }
            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $exception) {

            if ($exception instanceof TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($exception instanceof TokenExpiredException){
                return response()->json(['status' => 'Token is Expired']);
            }else{
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}