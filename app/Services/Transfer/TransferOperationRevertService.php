<?php

namespace App\Services\Transfer;

/**
 * Service for revert transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferOperationRevertService extends TransferOperationAbstract
{
    /**
     * Calculate revert value (adds value to the receiver)
     */
    protected function calculate(float $amount, float $value): float
    {
        return ($amount + $value);
    }
}
