<?php

namespace App\Services;

use SoapClient;

class SoapApiService
{
    public function execute()
    {
        ini_set("soap.wsdl_cache_enabled", 0);
        ini_set("soap.wsdl_cache_ttl", 0);

        $url = "https://siup.universitaspertamina.ac.id/soapOrganization/quote";
        $soap_args = array(
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' =>  stream_context_create(
                array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    )
                )
            )
        );

        $client = new SoapClient($url, $soap_args);

        return $client;
    }
}
