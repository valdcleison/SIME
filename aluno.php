<?php 
$app->get("/portal/aluno/", function(){

	if(!Usuario::verifyLogin(0)){
		header("Location: /login/");
		exit;
	}
	$user = $_SESSION[Usuario::SESSION];
	echo $user['niveladmin'];
});

 ?>