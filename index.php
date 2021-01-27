<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$Sql = new Casintec\DB\Sql();

	$results = $Sql->select("SELECT * FROM tb_users");

	echo json_encode($results);

});

$app->run();

 ?>