<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletRepository
{
    public static function getByUserSession()
    {
        return Wallet::where('user_id', Auth::user()->id)
            ->get();
    }

    public static function update(int $user_id, array $data)
    {
        return Wallet::where('user_id', $user_id)
            ->update($data);
    }

    public static function get(int $user_id)
    {
        return Wallet::where('user_id', $user_id)
            ->get();
    }
}
