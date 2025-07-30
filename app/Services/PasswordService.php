<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PasswordService
{
    private string $password;

    public function hashPassword(string $password)
    {
        $this->password = $password;

        return Hash::make($this->password);
    }
}
