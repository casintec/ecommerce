<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	echo "OK. Outro teste de Sincronia 4.";

});

$app->run();

 ?>