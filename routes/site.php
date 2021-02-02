<?php 

use \Casintec\Page;
use \Casintec\Model\Product;
use \Casintec\Model\Category;


$app->get('/', function() {
	
	$products = Product::listAll();
	
	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checklist($products)
	]);

});


$app->get('/category/:idcategory', function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>Product::checkList($category->getProducts())
	]);

});

?>