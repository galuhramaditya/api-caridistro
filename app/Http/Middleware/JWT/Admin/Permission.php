<?php

namespace App\Http\Middleware\JWT\Admin;

use Closure;
use App\Http\Middleware\JWT\JWT;
use App\Admin;

class Permission extends JWT
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('token')) {
            try {
                $request->token = $this->decode($request->headers->get('token'));

                if ($request->token->perms == 'admin') {
                    if (Admin::find($request->token->id)) {
                        return $next($request);
                    }
                }
            } catch (\Exception $e) {}
        }
        return response('permission denied', 401);
    }
}
