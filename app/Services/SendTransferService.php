<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

class SendTransferService
{
    /**
     * Send transference value for user
     */
    public static function sendTransfer(float $value)
    {
        $wallet = WalletRepository::getByUserSession();

        $amount = $wallet->amount();

        $new_amount = $this->calculateNewAmount($amount, $value);

        return WalletRepository::update(Auth::user()->id, [
            'amount' => $new_amount
        ]);
    }

    /**
     * Calculate send value
     */
    private function calculateNewAmount(float $amount, float $value): float
    {
        return ($amount - $value);
    }
}
