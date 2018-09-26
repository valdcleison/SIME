<?php 

use \Sime\Page;
use \Sime\Controller\Usuario;

$app->get("/admin/", function(){
	

	Usuario::verifyLogin(2);

	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]);
	$page->setTpl("index");


});

$app->get("/admin/users/", function(){
	Usuario::verifyLogin(2);
		

	$users = Usuario::list();
	
	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);

	$page->setTpl("users", array(
		"users"=>$users,
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});

$app->get("/admin/users/create/", function(){
	Usuario::verifyLogin(2);

	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);

	$page->setTpl("users-create", [
		"error"=>Usuario::getError()

	]);
});

$app->post("/admin/users/create/", function(){
	Usuario::verifyLogin(2);

	if(empty($_POST['nomepessoa']) && $_POST['nomepessoa'] === ""
		|| empty($_POST['cpfpessoa']) && $_POST['cpfpessoa'] ===""
		|| empty($_POST['emailpessoa']) && $_POST['emailpessoa'] === ""
		|| empty($_POST['usuario']) && $_POST['usuario'] ===""
		|| empty($_POST['pass']) && $_POST['pass'] ===""
		|| empty($_POST['repass']) && $_POST['repass'] === "")
	{	
		Usuario::setError("Preencha todos os campos");
		header("Location : /admin/users/create");
		exit;
	}


	$user = new Usuario();

	$user->setData($_POST);

	$user->salvarAdmin();

	Usuario::setSuccess("Usuario Cadastrado com sucesso!");
	header("Location: /admin/users/");
	exit;
});

$app->get("/admin/users/:id/delete", function($id){
	try{
		Usuario::verifyLogin(2);

		$user = new Usuario();
		
		$user->buscarAdmin((int)$id);

		$user->deletarAdmin();
	}catch(Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /admin/users/");
		exit;
	}

	Usuario::setSuccess("Usuario apagado com sucesso!");
	header("Location: /admin/users/");
	exit;
	
});

$app->get("/admin/users/:id", function($id){
	Usuario::verifyLogin(2);

	$user = new Usuario();
	$user->buscarAdmin((int)$id);

	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);
	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));
});

$app->post("/admin/users/:id", function($id){
	Usuario::verifyLogin(2);


	$user = new Usuario();
	$user->buscarAdmin((int)$id);
	$user->setData($_POST);
	$user->atualizarAdmin($id);

	header("Location: /admin/users");
	exit;
});



 ?>