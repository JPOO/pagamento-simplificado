<?php

namespace App\Services\Transfer;

/**
 * Service for receive transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferOperationSendService extends TransferOperationAbstract
{
    /**
     * Calculate send value (decreases value to the sender)
     */
    protected function calculate(float $amount, float $value): float
    {
        return ($amount - $value);
    }
}
