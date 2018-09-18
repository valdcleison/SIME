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

});

$app->get("/admin/users/:id/delete", function($id){
	Usuario::verifyLogin(2);

	
});

$app->get("/admin/users/:id", function($id){
	Usuario::verifyLogin(2);

	$page = new Page("/views/admin/");

	$page->setTpl("users-update");
});





 ?>