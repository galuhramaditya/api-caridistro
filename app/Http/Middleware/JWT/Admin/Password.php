<?php

namespace App\Http\Middleware\JWT\Admin;

use Closure;
use Hash;
use App\Http\Middleware\JWT\JWT;
use App\Admin;

class Password extends JWT
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('token')) {
            try {
                $request->token = $this->decode($request->headers->get('token'));
                $admin          = Admin::find($request->token->id);

                if ($admin) {
                    if(Hash::check($request->password, $admin->password)) {
                        return $next($request);
                    }   
                }
            } catch (\Exception $e) {}
        }
        return response('password is wrong', 401);
    }
}
