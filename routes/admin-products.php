<?php

use \Casintec\PageAdmin;
use \Casintec\Model\User;
use \Casintec\Model\Product;

$app->get('/admin/products', function(){

    User::verifyLogin();

    $products = Product::listAll();

    $page = new PageAdmin();

    $page->setTpl("products", [
        "products"=>$products
    ]);

});

$app->get('/admin/products/create', function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("products-create");

});

$app->post("/admin/products/create", function(){

	User::verifyLogin();

	$product = new Product();

	$product->setData($_POST);

	$product->save();

	header("Location: /admin/products");
	exit;

});

?>