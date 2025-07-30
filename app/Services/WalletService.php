<?php

namespace App\Services;

use App\Repositories\WalletRepository;

class WalletService
{
    /*
     * Return amount of user wallet
     */
    public static function getAmount(): int
    {
        $repositoryWallet = WalletRepository::getByUserSession()->toArray();

        if (empty($repositoryWallet)) {
            $amount = 0;
        } else {
            $amount = $repositoryWallet['amount'];
        }

        return $amount;
    }
}
