<?php

namespace App\Apis;

/**
 * Api for curl
 *
 * @package Apis
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class CurlClient
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    /**
     * Curl get
     */
    public function get($url)
    {
        $this->setOption(CURLOPT_URL, $url);
        $this->setOption(CURLOPT_RETURNTRANSFER, true);

        return curl_exec($this->curl);
    }

    /**
     * Return errors
     */
    public function getError()
    {
        return curl_error($this->curl);
    }

    /**
     * Set options for curl
     */
    private function setOption($option, $value)
    {
        curl_setopt($this->curl, $option, $value);

        return $this;
    }
}
