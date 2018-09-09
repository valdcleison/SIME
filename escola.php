<?php 

$app->get("/portal/escola/", function(){

	if(!Usuario::verifyLogin(1)){
		header("Location: /login/");
		exit;
	}
	$user = $_SESSION[Usuario::SESSION];
	echo $user['niveladmin'];

});




 ?>