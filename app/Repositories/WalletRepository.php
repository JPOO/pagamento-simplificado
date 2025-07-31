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
     * Save data in wallet table
     *
     * @return Wallet
     */
    public function save(array $data): Wallet
    {
        $wallet = (new Wallet())->fill($data);
        $wallet->save();

        return $wallet;
    }

    /**
     * Get wallet by user session
     */
    public function getByUserSession()
    {
        return Wallet::where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * Get data in wallet table by cpfcnpj
     */
    public function getByUserId(string $userId)
    {
        return Wallet::where('user_id', $userId)
            ->get();
    }

    /**
     * Update data in wallet table
     */
    public function update(int $userId, array $data)
    {
        return Wallet::where('user_id', $userId)
            ->update($data);
    }
}
