<?php

namespace App\Services;

/**
 * Service for receive transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class ProcessTransferSendService extends ProcessTransferAbstract
{
    /**
     * Calculate send value (decreases value to the sender)
     */
    protected function calculateAmount(float $amount, float $value): float
    {
        return ($amount - $value);
    }
}
