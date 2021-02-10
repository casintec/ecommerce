<?php 

use \Casintec\Page;
use \Casintec\Model\User;
use \Casintec\Pagseguro\Config;
use \Casintec\Pagseguro\Transporter;
use \Casintec\Model\Order;

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
            "urlJS"=>Config::getUrlJs(),
            "id"=>Transporter::createSession()
        ]
    ]);

});

?>