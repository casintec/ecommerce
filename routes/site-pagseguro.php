<?php 

use \Casintec\Page;
use \Casintec\Model\User;
use \GuzzleHttp\Client;
use \Casintec\Pagseguro\Config;
use \Casintec\Model\Order;


$app->get('/payment/pagseguro', function() {
	
	$client = new Client();
    $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuth()));

    echo $response->getBody()->getContents(); // '{"id": 1420053, "name": "guzzle", ...}'

});

$app->get("/payment", function(){

    User::verifyLogin(false);

    $order = new Order();

    $order->getFromSession();

    $years = [];

    for ($y = date('Y'); $y < date('Y')+14; $y++){

        array_push($years, $y);

    }

    $page = new Page();

    $page->setTpl("payment", [
        'order'=>$order->getValues(),
        'msgError'=>Order::getError(),
        'years'=>$years,
        'pagseguro'=>[
            "urlJS"=>Config::getUrlJs()
        ]
    ]);

});

?>