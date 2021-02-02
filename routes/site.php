<?php 

use \Casintec\Page;
use \Casintec\Model\Product;
use \Casintec\Model\Category;
use \Casintec\Model\Cart;

$app->get('/', function() {
	
	$products = Product::listAll();
	
	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checklist($products)
	]);

});


$app->get('/category/:idcategory', function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/category/'.$category->getidcategory().'?page='.$i,
			'page'=>$i
		]);
	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination['data'],
		'pages'=> $pages
	]);

});

$app->get("/products/:desurl", function($desurl){

	$product = new Product();

	$product->getFromURL($desurl);

	$page = new Page();

	$page->setTpl("product-detail", [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);


});

$app->get("/cart", function(){

	$cart = Cart::getFromSession();

	$page = new Page();

	$page->setTpl("cart");

});

?>