<?php

namespace App\Repositories;

use App\Models\Transfer;

class TransferRepository
{
    /**
     * Save data in transfer table
     *
     * @return Wallet
     */
    public function save(array $data): Transfer
    {
        $transfer = (new Transfer())->fill($data);
        $transfer->save();

        return $transfer;
    }
}
