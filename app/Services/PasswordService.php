<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

/**
 * Service for password hash
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class PasswordService
{
    /**
     * Encrypt password
     *
     * @return Hash
     */
    public function getEncryptPassword(string $password): string
    {
        return Hash::make($password);
    }
}
