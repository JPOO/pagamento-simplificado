<?php

namespace App\Services\Transfer;

use App\Interfaces\ProcessTransferInterface;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;

/**
 * Service for external transfer authorization
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
abstract class TransferOperationAbstract implements ProcessTransferInterface
{
    public function execute(string $cpfcnpj, float $value)
    {
        $user = (new UserRepository())->getByCpfCnpj($cpfcnpj)->first();
        $wallet = (new WalletRepository())->getByUserId($user->id)->first();

        $amount = $wallet->amount;

        $newAmount = $this->calculate($amount, $value);

        return (new WalletRepository())->update($user->id, [
            'amount' => $newAmount
        ]);
    }

    abstract protected function calculate(float $amount, float $value);
}
