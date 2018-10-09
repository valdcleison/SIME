<?php 

use \Sime\Page;
use \Sime\Controller\Usuario;
use \Sime\Controller\Escola;
use \Sime\Controller\Planos;

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
		

	$users = Usuario::listar();
	
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

	if(strlen($_POST['cpfpessoa']) !== 11){
		Usuario::setError("Cpf invalido!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	if(empty($_POST['nomepessoa']) && $_POST['nomepessoa'] === ""
		|| empty($_POST['cpfpessoa']) && $_POST['cpfpessoa'] ===""
		|| empty($_POST['emailpessoa']) && $_POST['emailpessoa'] === ""
		|| empty($_POST['usuario']) && $_POST['usuario'] ===""
		|| empty($_POST['pass']) && $_POST['pass'] ===""
		|| empty($_POST['repass']) && $_POST['repass'] === "")
	{	
		Usuario::setError("Preencha todos os campos");
		echo "<script>javascript:history.back()</script>";
		exit;
	}else if($_POST['pass'] !== $_POST['repass']){
		Usuario::setError("Senhas não conferem!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	if(!Usuario::validaCPF($_POST['cpfpessoa'])){
		Usuario::setError("CPF Invalido!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	try{
		$user = new Usuario();

		$user->setData($_POST);

		$user->salvarAdmin();
	} catch(\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
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
		"user"=>$user->getValues(),
		"error"=>Usuario::getError()
	));
});

$app->post("/admin/users/:id", function($id){
	Usuario::verifyLogin(2);
	
	try{
		$user = new Usuario();
		$user->buscarAdmin((int)$id);
		$user->setData($_POST);

		$user->atualizarAdmin($id);
	} catch (\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}	

	Usuario::setSuccess("Dados alterados com sucesso!");
	header("Location: /admin/users");
	exit;
});

$app->get("/admin/users/:id/password/", function($id){
	Usuario::verifyLogin(2);


	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);
	$page->setTpl("users-update-password",array(
		"id"=>$id,
		"error"=>Usuario::getError()
	));
});

$app->post("/admin/users/:id/password/", function($id){
	Usuario::verifyLogin(2);

	if(empty($_POST['newpass']) || empty($_POST['repass'])){
		Usuario::setError("Preencha todos os campos!");
		header("Location: /admin/users/$id/password/");
		exit;
	}

	if ($_POST['newpass'] !== $_POST['repass']) {
		Usuario::setError("Senhas não conferem!");
		header("Location: /admin/users/$id/password/");
		exit;
	}

	try{
		$user = new Usuario();
		$user->buscarAdmin((int)$id);
		$user->setData($_POST);
		$user->alterarSenha($_POST['actualpass'], $_POST['newpass']);

		Usuario::setSuccess("Senha Alterada com sucesso!");
		header("Location: /admin/users/");
		exit;
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /admin/users/$id/password/");
		exit;
	}
});

$app->get("/admin/escola/", function(){
	Usuario::verifyLogin(2);
		

	$escola = Escola::buscarEscola();

	
	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);

	$page->setTpl("escola", array(
		"escola"=>$escola,
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});

$app->get("/admin/escola/create/", function(){
	Usuario::verifyLogin(2);
	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]);
	$page->setTpl("escola-create", [
		"error"=>Usuario::getError(),
		"success"=>Usuario::getSuccess()
	]);
});

$app->get("/admin/usuario/:id/status/:status", function($id, $status){
	Usuario::verifyLogin(2);

	try{
		$user = new Usuario();
		$user->buscarAdmin((int)$id);
		
		$user->atualizarStatus((int)$status);
		
	} catch (\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}	

	Usuario::setSuccess("Status alterado com sucesso!");
	header("Location: /admin/users/");
	exit;


});

$app->get("/admin/escola/:id/status/:statusescola/", function($id, $statusescola){
	Usuario::verifyLogin(2);
	try{
		$escola = new Escola();
		$escola->buscarEscolaPorId((int)$id);


		$escola->alterarStatusEscola((int)$statusescola);

	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /admin/escola/");
		exit;
	}
	Usuario::setSuccess("Status alterado com sucesso!");
	header("Location: /admin/escola/");
	exit;
});

$app->get("/admin/planos/", function(){
	Usuario::verifyLogin(2);

	$planos = Planos::buscarPlanos();


	$page = new Page("/views/admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);

	$page->setTpl("planos", array(
		"planos"=>$planos,
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});



 ?>