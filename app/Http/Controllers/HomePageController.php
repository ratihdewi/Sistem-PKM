<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        ini_set("soap.wsdl_cache_enabled", 0);
        ini_set("soap.wsdl_cache_ttl", 0);

        $wsdl = "https://siup.universitaspertamina.ac.id/soapOrganization/quote";
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

        $client = new SoapClient($wsdl, $soap_args);

        $token = $client->getToken('ods', '12345');
        $nim = '101116021';

        // $response = $client->getAllofOrganizationStudent($token);
        $response = $client->getAllofOrganizationStudentByNim($token, $nim);

        // dd(json_decode($response));

        return view('page.index');
    }
}
