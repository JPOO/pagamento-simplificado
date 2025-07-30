<?php

namespace App\Services;

/**
 * Service for receive transference
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class ProcessTransferReceiveService extends ProcessTransferAbstract
{
    /**
     * Calculate receive value (adds value to the receiver)
     */
    protected function calculateAmount(float $amount, float $value): float
    {
        return ($amount + $value);
    }
}
