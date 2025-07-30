<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService
{
    public static function getUserByCpfCnpj(string $cpfcnpj)
    {
        $user = UserRepository::getUserByCpfCnpj($cpfcnpj);

        return $user;
    }

    /*
     * Verify if session user is common or not
     *
     * @return bool
     */
    public function verifyCommonUserSession(): bool
    {
        $type = Auth::user()->type;

        if ($type == User::COMMON_USER) {
            return true;
        }

        return false;
    }
}
