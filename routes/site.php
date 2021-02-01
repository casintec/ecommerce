<?php 

use \Casintec\Page;
use \Casintec\Model\Product;

$app->get('/', function() {
	
	$products = Product::listAll();
	
	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checklist($products)
	]);

});

?>