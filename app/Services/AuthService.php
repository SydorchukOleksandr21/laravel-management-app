<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param array $credentials
     * @return bool
     */
    public function attemptLogin(array $credentials): bool
    {
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        return Auth::attempt($credentials, $remember);
    }
}
