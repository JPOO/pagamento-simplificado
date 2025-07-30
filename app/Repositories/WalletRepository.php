<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

/**
 * Repository for wallet
 *
 * @package Repositories
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class WalletRepository
{
    /**
     * Get wallet by user session
     */
    public static function getByUserSession()
    {
        return Wallet::where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * Update data in wallet table
     */
    public static function update(int $userId, array $data)
    {
        return Wallet::where('user_id', $userId)
            ->update($data);
    }

    /**
     * Get data in wallet table
     */
    public static function get(int $userId)
    {
        return Wallet::where('user_id', $userId)
            ->get();
    }
}
