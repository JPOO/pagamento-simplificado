<?php

namespace App\Interfaces;

/**
 * Interface for transfer
 *
 * @package Interfaces
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
interface ProcessTransferInterface
{
    /**
     * Execute business rules for transfer
     */
    public function execute(string $cpfcnpj, float $value);
}
