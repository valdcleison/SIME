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

	if($_POST['nomepessoa'] === "" 
		|| $_POST['cpfpessoa'] === "" 
		|| $_POST['email'] == ""
		|| $_POST['usuario'] == ""
		|| $_POST['pass'] == ""
		|| $_POST['repass'] == "")
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