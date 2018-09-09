<?php 

use \Sime\Page;
use \Sime\Controller\Usuario;

$app->get("/admin/", function(){
	

	if(!(bool)Usuario::verifyLogin(2)){
		header("Location: /login/");
		exit;
	}

	$page = new Page("/views/Admin/");
	$page->setTpl("index");


});

$app

 ?>