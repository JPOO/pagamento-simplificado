<?php

namespace App\Services;

use App\Interfaces\ProcessTransferInterface;
use App\Repositories\WalletRepository;

abstract class ProcessTransferAbstract implements ProcessTransferInterface
{
    public function execute(int $idUser, float $value)
    {
        $wallet = WalletRepository::get($idUser);

        $amount = $wallet->amount();

        $new_amount = $this->calculateAmount($amount, $value);

        return WalletRepository::update(Auth::user()->id, [
            'amount' => $new_amount
        ]);
    }

    abstract protected function calculateAmount(float $amount, float $value);
}
