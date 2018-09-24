<?php 

use \Sime\Page;
use \Sime\Controller\Usuario;
$app->get("/admin/", function(){
	

	Usuario::verifyLogin(2);

	$page = new Page("/views/Admin/");
	$page->setTpl("index");


});

$app->get("/admin/users/", function(){
	Usuario::verifyLogin(2);
		

	$users = Usuario::list();
	
	$page = new Page("/views/admin/");

	$page->setTpl("users", array(
		"users"=>$users
	));
});

$app->get("/admin/users/create/", function(){
	Usuario::verifyLogin(2);

	$page = new Page("/views/admin/");

	$page->setTpl("users-create");
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
		throw new \Exception("Preencha todos os campos");
		header("Location : /admin/users/create");
	}


	$user = new Usuario();

	$user->setData($_POST);

	$user->salvarAdmin();

	header("Location: /admin/users/");
	exit;
});

$app->get("/admin/users/:id/delete", function($id){
	Usuario::verifyLogin(2);

	$user = new Usuario();
	
	$user->buscarAdmin((int)$id);

	$user->deletarAdmin();

	header("Location: /admin/users/");
	exit;
	
});

$app->get("/admin/users/:id", function($id){
	Usuario::verifyLogin(2);

	$user = new Usuario();
	$user->buscarAdmin((int)$id);

	$page = new Page("/views/admin/");
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