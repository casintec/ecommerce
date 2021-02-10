<?php 

use \Casintec\Page;
use \Casintec\Model\User;
use \GuzzleHttp\Client;
use \Casintec\Pagseguro\Config;


$app->get('/payment/pagseguro', function() {
	
	$client = new Client();
    $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuth()));

    echo $response->getBody()->getContents(); // '{"id": 1420053, "name": "guzzle", ...}'

});

?>