<?php

use \Casintec\PageAdmin;
use \Casintec\Model\User;
use \Casintec\Model\Order;
use \Casintec\Model\OrderStatus;


//Apagar Pedidos
$app->get("/admin/orders/:idorder/delete", function($idorder){

    User::verifyLogin();

    $order = new Order();

    $order->get((int)$idorder);

    $order->delete();

    header("Location: /admin/orders");
    exit;

});

//Alterar Status do Pedido
$app->get("/admin/orders/:idorder/status", function($idorder){

    User::verifyLogin();

    $order = new Order();

    $order = new OrderStatus();

    $order->get((int)$idorder);

    $page = new PageAdmin();

    $page->setTpl("order-status", [
        'order'=>$order->getValues(),
        'status'=>OrderStatus::listAll(),
        'msgError'=>Order::getError(),
        'msgSuccess'=>Order::getSuccess()
    ]);

});

//Alterar Status do Pedido envio POST
$app->post("/admin/orders/:idorder/status", function($idorder){

    User::verifyLogin();

    if (!isset($_POST['idstatus']) || (!(int)$_POST['idstatus'] > 0)) {
        Order::setError("Informe o Status Atual!");
        header("Location: /admin/orders/".$idorder."/status");
        exit;
    }

    $order = new Order();

    $order->get((int)$idorder);

	$order->setidstatus((int)$_POST['idstatus']);

	$order->save();

	Order::setSuccess("Status atualizado.");

	header("Location: /admin/orders/".$idorder."/status");
	exit;

});

//Detalhes dos Pedidos
$app->get("/admin/orders/:idorder", function($idorder){

    User::verifyLogin();

    $order = new Order();

    $order->get((int)$idorder);

    $cart = $order->getCart();

    $page = new PageAdmin();

    $page->setTpl('order', [
        'order'=>$order->getValues(),
        'cart'=>$cart->getValues,
        'products'=>$cart->getProducts
    ]);

});

//Visualização dos Pedidos no AdminPainel
$app->get("/admin/orders", function(){

    User::verifyLogin();

    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != ''){

		$pagination = Order::getPageSearch($search, $page);
	
	} else {

		$pagination = Order::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++) {
		array_push($pages, [
			'href'=>'/admin/orders?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}
	
	$page = new PageAdmin();

	$page->setTpl("orders", array(
		"orders"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	));


});

?>