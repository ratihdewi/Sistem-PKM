<?php

namespace App\Services;

use GuzzleHttp\Client;

class MasayuApiService
{
    public function execute()
    {
        $client = new Client([
            'base_uri' => 'https://masayu.universitaspertamina.ac.id/',
            'headers' => ['Content-Type' => 'application/json'],
            'http_errors' => false
        ]);

        return $client;
    }
}
