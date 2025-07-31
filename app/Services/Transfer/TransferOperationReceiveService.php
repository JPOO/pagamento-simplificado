<?php

namespace App\Services\Transfer;

/**
 * Service for receive transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferOperationReceiveService extends TransferOperationAbstract
{
    /**
     * Calculate receive value (adds value to the receiver)
     */
    protected function calculate(float $amount, float $value): float
    {
        return ($amount + $value);
    }
}
