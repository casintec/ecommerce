<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Casintec\Page;
use \Casintec\PageAdmin;
use \Casintec\Model\User;
use \Casintec\Model\Category;
use \Casintec\Model\Product;

$app = new Slim();

$app->config('debug', true);

require_once("routes/site.php");

require_once("routes/admin.php");

require_once("routes/admin-users.php");

require_once("routes/admin-categories.php");

require_once("routes/admin-products.php");

$app->run();

 ?>