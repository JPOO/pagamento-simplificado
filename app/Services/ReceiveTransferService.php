<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

class ReceiveTransferService
{
    public static function receiveTransfer(int $id_user_receive, float $value)
    {
        $wallet = WalletRepository::get($id_user_receive);

        $amount = $wallet->amount();

        $new_amount = $this->calculateNewAmount($amount, $value);

        return WalletRepository::update($id_user_receive, [
            'amont' => $new_amount
        ]);
    }

    private static function calculateNewAmount(float $amount, float $value): float
    {
        return $amount + $value;
    }
}
