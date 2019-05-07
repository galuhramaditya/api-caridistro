<?php

namespace App\Http\Middleware\JWT;

use JWT as Token;

class JWT
{
    protected function decode($data)
    {
        return Token::decode($data, env('JWT_SECRET'), ['HS256']);
    }
}
