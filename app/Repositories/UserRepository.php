<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Repository for user
 *
 * @package Repositories
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class UserRepository
{
    /**
     * Save data in user table
     *
     * @return User
     */
    public function save(array $data): User
    {
        $user = (new User())->fill($data);
        $user->save();

        return $user;
    }

    /**
     * Get user by cpf-cnpj
     */
    public function getByCpfCnpj(string $cpfcnpj)
    {
        return User::where('cpfcnpj', $cpfcnpj)
            ->get();
    }
}
