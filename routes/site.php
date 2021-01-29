<?php 

use \Casintec\Page;

$app->get('/', function() {
    
	$page = new Page();

	$page->setTpl("index");

});

?>