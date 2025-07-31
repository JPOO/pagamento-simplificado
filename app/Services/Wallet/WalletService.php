<?php

namespace App\Services\Wallet;

use App\Repositories\WalletRepository;

/**
 * Service for wallet
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class WalletService
{
    /**
     * Return amount of user wallet
     */
    public function getAmount(): float
    {
        $repositoryWallet = (new WalletRepository())->getByUserSession();

        if (!$repositoryWallet->isEmpty()) {
            return $repositoryWallet->first()->amount;
        }

        return 0;
    }
}
