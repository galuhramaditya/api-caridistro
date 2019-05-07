<?php

namespace App\Http\Middleware\JWT;

use Closure;

class NoToken
{
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('token')) {
            return $next($request);
        }
        return response('token detetected', 401);
    }
}
