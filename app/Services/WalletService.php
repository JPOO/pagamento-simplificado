<?php

namespace App\Services;

use App\Repositories\WalletRepository;

/**
 * Service for wallet
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class WalletService
{
    /*
     * Return amount of user wallet
     */
    public static function getAmount(): float
    {
        $repositoryWallet = WalletRepository::getByUserSession();

        if ($repositoryWallet->isEmpty()) {
            $amount = 0.00;
        } else {
            $amount = $repositoryWallet->amount;
        }

        return $amount;
    }
}
