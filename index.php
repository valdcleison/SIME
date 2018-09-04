<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Sime\Page;

$app = new Slim();

$app->get('/', function(){
	
	$page = new Page();

	$page->setTpl("index");

});

$app->get('/admin/', function(){
	
	

	

});


$app->run();
 ?>