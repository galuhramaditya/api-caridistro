<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use JWT;

class Controller extends BaseController
{
    protected function jwt($data, $permission) {
        $payload = [
            'id'    => $data,
            'iat'   => time(),
            'perms'	=> $permission
        ];
        
        return JWT::encode($payload, env('JWT_SECRET'));
    }
}
