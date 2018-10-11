<?php 

use \Sime\Controller\Escola;
use \Sime\Controller\Usuario;
use \Sime\Page;

/*$app->get("/portal/", function(){

	if(!Usuario::verifyLogin(1)){
		header("Location: /login/");
		exit;
	}

	$user = $_SESSION[Usuario::SESSION];
	echo $user['niveladmin'];

});*/

$app->get("/portal/", function(){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("index");
});

$app->get("/portal/users/", function(){
	$users = Usuario::listar();

	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users", array(
		"users"=>$users,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/create/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/delete/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/", function(){
	$users = Usuario::listar();

	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunos", array(
		"users"=>$users,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/create/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunosalunos-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/:id/delete/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunos-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/:id/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunos-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/frequencia/", function(){
	$page = new Page("/views/Frequencia/");	
	
	$page->setTpl("index", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

 ?>