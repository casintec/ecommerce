<?php

namespace Casintec\Pagseguro;

use \GuzzleHttp\Client;

class Transporter{

    public function createSession(){

        $client = new Client();
        $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuth()), [
            'verify'=>false
        ]);

        $xml = simplexml_load_string($response->getBody()->getContents()); // '{"id": 1420053, "name": "guzzle", ...}'
        
        return ((String)$xml->id);

    }

}

?>