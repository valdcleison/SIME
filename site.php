<?php 
use \Sime\Page;
use \Sime\Controller\Escola;

$app->get('/solicitacao/', function(){
	
	$page = new Page("/views/");	
	
	$page->setTpl("solicitacao");
});

$app->post('/solicitacao/', function(){
	try{
	$escola = new Escola();

	$escola->setData($_POST);


	var_dump($escola);
	exit;

	$escola->salvarEscola();
	
	}catch(Exception $e){
		Escola::setError($e->getmessage());
		header("Location: /solicitacao/");
		exit;
	}
});



 ?>