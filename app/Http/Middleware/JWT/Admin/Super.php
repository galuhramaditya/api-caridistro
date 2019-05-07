<?php

namespace App\Http\Middleware\JWT\Admin;

use Closure;
use App\Admin;
use App\Http\Middleware\JWT\JWT;

class Super extends JWT
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('token')) {
            try {
                $request->token = $this->decode($request->headers->get('token'));
                $admin          = Admin::find($request->token->id);

                if ($admin) {
                    if($admin->super) {
                        return $next($request);
                    }   
                }
            } catch (\Exception $e) {}
        }
        return response('permission denied', 401);
    }
}
