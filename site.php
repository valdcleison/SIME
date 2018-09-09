<?php 

$app->get('/solicitacao/', function(){
	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);	
	
	$page->setTpl("solicitacao");
});

$app->post('/solicitacao/', function(){
	
	
});



 ?>