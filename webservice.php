<?php 


$app->post("/ws/:version/login/", function($version){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($_POST["user"], $_POST['pass']);
			switch ($user->getniveladmin()) {
				case '1':
					echo json_encode($user->getValues());
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});


$app->get("/ws/:version/escola/sincdata/", function((String)$version){

	if($version !== "1.0"){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"
		));
	} else {
		
		




	}

});
