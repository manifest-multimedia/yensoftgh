<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\User;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return User::find($identifier);
    }

    public function retrieveByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Check if the password is valid for the given user
        return \Hash::check($credentials['password'], $user->getAuthPassword());
    }

    public function retrieveByToken($identifier, $token)
    {
        // Not implemented
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not implemented
    }
}
