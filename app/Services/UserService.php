<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Service for user
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class UserService
{
    /*
     * Return user by cpf-cnpj
     *
     * @return bool
     */
    public static function getUserByCpfCnpj(string $cpfcnpj)
    {
        return UserRepository::getByCpfCnpj($cpfcnpj);
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
