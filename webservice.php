<?php 


$app->post("/ws/:version/login/", function($version){
	if($version === 1){
		$user = Usuario::login($_POST["user"], $_POST['pass']);
		echo json_encode($user);
	}

});



 ?>