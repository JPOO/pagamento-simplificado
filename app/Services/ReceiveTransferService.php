<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Service for receive transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class ReceiveTransferService
{
    /**
     * Receive transference value for user
     */
    public static function receiveTransfer(int $id_user_receive, float $value)
    {
        $wallet = WalletRepository::get($id_user_receive);

        $amount = $wallet->amount();

        $new_amount = $this->calculateNewAmount($amount, $value);

        return WalletRepository::update($id_user_receive, [
            'amont' => $new_amount
        ]);
    }

    /**
     * Calculate receive value
     */
    private static function calculateNewAmount(float $amount, float $value): float
    {
        return ($amount + $value);
    }
}
