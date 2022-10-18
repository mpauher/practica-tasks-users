<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;


class Authenticate extends BaseMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle( $request, \Closure $next,)
    {
        try
        {   
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e)
        {
            return response(['error' => 'Token inválido'], 401);
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
           return response(['error' => 'Token inválido'], 401);
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
        {
            return response(['error' => 'El token ha expirado'], 401);
        }
        catch (\Tymon\JWTAuth\Exceptions\JWTException $e)
        {
            return response(['error' => 'El token no ha sido encontrado'], 401);
        }
        catch (Exception $e)
        {
            return response(['error' => 'El token no ha sido encontrado'], 401);
        }
    }
}
