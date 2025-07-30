<?php

namespace App\Services;

use App\Apis\ExternalTransferAuthorizationApi;
use App\Helpers\Number;

/**
 * Service for external transfer authorization
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class ExternalTransferAuthorizationService
{
    /**
     * Verify if transfer has authorization
     *
     * @return bool
     */
    public static function hasAuthorization(
        array $DataTransferSend,
        array $DataTransferReceive,
        float $value
    ):bool {
        $transferAuthorization = new ExternalTransferAuthorizationApi();
        $listAuthorization = $transferAuthorization->get();

        foreach ($listAuthorization as $auth) {
            $origin = $auth['origin'];
            $destination = $auth['destination'];

            $verifyDataSend = ($DataTransferSend['cpfcnpj'] == $origin['cpfcnpj']);
            $verifyDataReceive = ($DataTransferReceive['cpfcnpj'] == $destination['cpfcnpj']);
            $verifyAmount = ($value == Number::normalizeStringToNumber((string) $auth['amount']));

            if ($verifyDataSend && $verifyDataReceive && $verifyAmount) {
                return true;
            }
        }

        return false;
    }
}
