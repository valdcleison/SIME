<?php 
use \Sime\Page;

$app->get('/solicitacao/', function(){
	
	$page = new Page("/views/",[
		"header"=>false,
		"footer"=>false
	]);	
	
	$page->setTpl("solicitacao");
});

$app->post('/solicitacao/', function(){
	
	
});



 ?>