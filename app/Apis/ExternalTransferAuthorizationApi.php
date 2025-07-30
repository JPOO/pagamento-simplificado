<?php

namespace App\Apis;

/**
 * Api for external transfer authorization
 *
 * @package Apis
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class ExternalTransferAuthorizationApi
{
    const URL = 'https://66ad1f3cb18f3614e3b478f5.mockapi.io/v1/auth';

    /**
     * Curl get external transfer authorization
     */
    public function get()
    {
        $curl = new CurlClient();

        $response = $curl->get(self::URL);

        if (!$response) {
            return $curl->getError();
        } else {
            return json_decode($response, true);
        }
    }
}
