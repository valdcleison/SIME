<?php 

use \Sime\Controller\Escola;
use \Sime\Controller\Usuario;
use \Sime\Controller\Frequencia;
use \Sime\Controller\FrequenciaAluno;
use \Sime\Controller\Aluno;
use \Sime\Page;


$app->get("/portal/profile/", function(){
	Usuario::verifyLogin(1);

	$page = new Page("/views/Escola/");	
	
	$page->setTpl("profile");
});

$app->get("/portal/", function(){
	Usuario::verifyLogin(1);

	$page = new Page("/views/Escola/");	
	
	$page->setTpl("index");
});


$app->get("/portal/users/", function(){
	Usuario::verifyLogin(1);	


	$user = new Usuario();

	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);
	
	$page = new Page("/views/Escola/");	


	$page->setTpl("users", array(
		"users"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/create/", function(){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/users/create/", function(){
	Usuario::verifyLogin(1);

	$user = new User();
	
	$user->setData($_POST);

	$user->salvarEscola();
	var_dump($_POST);
	exit;	
});

$app->get("/portal/users/:id/delete/", function($id){
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/status/:status", function($id, $status){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/password/", function($id){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/");	
	
	$page->setTpl("users-create", array(
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
	$users = Usuario::listar(1);

	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$aluno = new Aluno();
	$dados = $aluno->listar($dados[0]['escola_idescola']);
	
	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunos", array(
		"alunos"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/create/", function(){
	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);


	$page = new Page("/views/Escola/");	
	
	$page->setTpl("alunos-create", array(
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
	$frequencia = new Frequencia();
	$dados = $frequencia->listar();
	
	$page = new Page("/views/Frequencia/");	
	
	$page->setTpl("index", array(
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});


$app->get("/portal/frequencia/:idfrequencia/detalhes", function($id){
	$frequenciaaluno = new FrequenciaAluno();
	$dados = $frequenciaaluno->listarTodosPorEscola($id);
	
	
	$page = new Page("/views/Frequencia/");	
	
	$page->setTpl("frequenciaaluno", array(
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/frequencia/new/", function(){
	echo "Criando nova frequencia!";
});

 ?>