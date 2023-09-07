<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class AuthenticateAdmin extends Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login');
    }
}
