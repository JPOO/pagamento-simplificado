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
     */
    public static function save(User $user, array $validated)
    {
        $user = $user->fill($validated);

        return $user->save();
    }

    /**
     * Get user by cpf-cnpj
     */
    public static function getByCpfCnpj(string $cpfcnpj)
    {
        return User::where('cpfcnpj', $cpfcnpj)
            ->get();
    }
}
