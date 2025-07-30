<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserRepository
{
    public static function createUser(User $user, array $validated)
    {
        $user = $user->fill($validated);

        return $user->save();
    }

    public static function getUserByCpfCnpj(string $cpfcnpj)
    {
        return User::where('cpfcnpj', $cpfcnpj)->get();
    }

    public static function get()
    {
        return User::find(Auth::user()->id)->get();
    }
}
