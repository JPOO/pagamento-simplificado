<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

class SendTransferService
{
    public static function sendTransfer(float $value)
    {
        $wallet = WalletRepository::getByUserSession();

        $amount = $wallet->amount();

        $new_amount = $this->calculateNewAmount($amount, $value);

        return WalletRepository::update(Auth::user()->id, [
            'amont' => $new_amount
        ]);
    }

    private function calculateNewAmount(float $amount, float $value): float
    {
        return $amount - $value;
    }
}
