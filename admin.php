<?php 

use \Sime\Page;
use \Sime\Controller\Usuario;
use \Sime\Controller\Escola;
use \Sime\Controller\Planos;

$app->get("/admin/", function(){
	
	
	header("Location: /admin/escola/");
	exit;

});

$app->get("/admin/users/", function(){
	Usuario::verifyLogin(2);
		

	$users = Usuario::listar(2);
	
	$page = new Page("/views/Admin/",[
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

	$page = new Page("/views/Admin/",[
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
	//Usuario::verifyLogin(2);
	$_POST['cpfpessoa'] = str_replace(".", "", $_POST['cpfpessoa']);
	$_POST['cpfpessoa'] = str_replace("-", "", $_POST['cpfpessoa']);
	/*if(strlen($_POST['cpfpessoa']) !== 11){
		Usuario::setError("Cpf inválido!");
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
		Usuario::setError("CPF inválido!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}*/

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

	$page = new Page("/views/Admin/",[
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
	

	if(empty($_POST['nomepessoa']) && $_POST['nomepessoa'] === "")
	{	
		Usuario::setError("Preencha todos os campos");
		echo "<script>javascript:history.back()</script>";
		exit;
	}



	try{
		$user = new Usuario();
		$user->buscarAdmin((int)$id);
		$user->setnomepessoa($_POST['nomepessoa']);

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


	$page = new Page("/views/Admin/",[
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

	if ((String)$_POST['newpass'] !== (String)$_POST['repass']) {
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

$app->get("/admin/escola/", function(){
	Usuario::verifyLogin(2);
		

	$escola = Escola::buscarEscola();

	
	$page = new Page("/views/Admin/",[
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
	$planos = Planos::buscarPlanos();

	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
	)]);

	$page->setTpl("escola-create", [
		"planos"=>$planos,
		"error"=>Usuario::getError(),
		"success"=>Usuario::getSuccess()
	]);
});

$app->post("/admin/escola/create/", function(){
	Usuario::verifyLogin(2);
	try{
		if((int) strlen($_POST['telefone']) < 9){
			Escola::setError("O numero de telefone precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if((int) strlen($_POST['celular']) < 10 ){
			Escola::setError("O numero de cellular precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		$_POST['cpfgestor'] = str_replace(".", "", $_POST['cpfgestor']);
		$_POST['cpfgestor'] = str_replace("-", "", $_POST['cpfgestor']);

		$_POST['cnpjescola'] = str_replace( ".", "", $_POST['cnpjescola']);
		$_POST['cnpjescola'] = str_replace( "-", "", $_POST['cnpjescola']);
		$_POST['cnpjescola'] = str_replace( "/", "", $_POST['cnpjescola']);

		$_POST['cep'] = str_replace( "-", "", $_POST['cep']);

		$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
		$_POST['celular'] = str_replace( "-", "", $_POST['celular']);
		

		foreach ($_POST as $key => $value) {
			if(empty($key)){
				Usuario::setError("Preencha todos os campos");
				echo "<script>javascript:history.back()</script>";
				exit;
			}
		}

		if(!Usuario::validaCPF($_POST['cpfgestor'])){
			Usuario::setError("CPF inválido!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		
		if(!Usuario::validaCNPJ($_POST['cnpjescola'])){
			Usuario::setError("CNPJ inválido!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}

		$xml = simplexml_load_file("https://viacep.com.br/ws/".$_POST['cep']."/xml/");

		if($xml === null){
			Usuario::setError("CEP inválido!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}

		$escola = new Escola();

		$escola->setData($_POST);

		$escola->salvarEscola();
	
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /admin/escola/create/");
		exit;
	}

	Usuario::setSuccess("Escola Cadastrada com sucesso!");
	header("Location: /admin/escola/");
	exit;

});

$app->get("/admin/escola/:id/delete/", function($idEscola){
	Usuario::verifyLogin(2);
	try{
		$escola = new Escola();
		$escola->buscarEscolaPorId((int)$idEscola);
		



		$escola->deletarEscola();

	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /admin/escola/");
		exit;
	}
    Usuario::setSuccess("Escola deletada alterado com sucesso!");
	header("Location: /admin/escola/");
	exit;

});

$app->get("/admin/escola/:idEscola/", function($idEscola){
	Usuario::verifyLogin(2);
	$planos = Planos::buscarPlanos();
	try {
		$escola = new Escola();
		$escola->buscarEscolaPorId((int)$idEscola);

	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		header("Location: /admin/escola/");
		exit;
	}


	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
	)]);
	
	$page->setTpl("escola-update", [
		"planos"=>$planos,
		"escola"=>$escola->getValues(),
		"error"=>Usuario::getError(),
		"success"=>Usuario::getSuccess()
	]);
});

$app->post("/admin/escola/:idEscola/", function($idEscola){
	Usuario::verifyLogin(2);
	try {
		$escola = new Escola();
		$escola->buscarEscolaPorId((int)$idEscola);

		$escola->setData($_POST);
		
		$escola->editarEscola();

	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		header("Location: /admin/escola/");
		exit;
	}

	Usuario::setSuccess("Dados alterado com sucesso!");
	header("Location: /admin/escola/");
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


	$page = new Page("/views/Admin/",[
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

$app->get("/admin/planos/create/", function(){
	Usuario::verifyLogin(2);

	$planos = Planos::buscarPlanos();


	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);

	$page->setTpl("planos-create", array(
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});

$app->post("/admin/planos/create/", function(){
	Usuario::verifyLogin(2);
	if(empty($_POST['preco'] || empty($_POST['descricao']))){
		Usuario::setError("Preencha Todos os campos!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	if(!strpos($_POST['preco'],".")){
		Usuario::setError("Por favor digite um preço valido!");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	$_POST['preco'] = str_replace(",", ".", $_POST['preco']);
	try {
		$planos = new Planos();
		$planos->setData($_POST);
		$planos->salvarPlanos();
	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	Usuario::setSuccess("Plano Cadastrado com sucesso!");
	header("Location: /admin/planos/");
	exit;


	
});

$app->get("/admin/planos/:id/delete/", function($id){
	Usuario::verifyLogin(2);
	try {


		$planos = new Planos();
		$planos->buscarPlanosPorId($id);

		$planos->deletarPlanos();

	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		header("Location: /admin/planos/");
		exit;
	}

	Usuario::setSuccess("Plano Deletado com sucesso!");
	header("Location: /admin/planos/");
	exit;
});

$app->get("/admin/planos/:id", function($id){
	Usuario::verifyLogin(2);

	$planos = new Planos();
	$planos->buscarPlanosPorId($id);

	$page = new Page("/views/Admin/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)]
	);
	
	$page->setTpl("planos-update", array(
		"plano"=>$planos->getValues(),
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});

$app->post("/admin/planos/:id", function($id){
	Usuario::verifyLogin(2);
	try {


		if(empty($_POST['preco'] || empty($_POST['descricao']))){
			Usuario::setError("Preencha Todos os campos!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		
		if(!strpos($_POST['preco'],".")){
			Usuario::setError("Por favor digite um preço valido!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		$_POST['preco'] = str_replace(",", ".", $_POST['preco']);

		$planos = new Planos();
		$planos->buscarPlanosPorId($id);
		$planos->setData($_POST);

		$planos->atualizarPlanos();

	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		header("Location: /admin/planos/");
		exit;
	}

	Usuario::setSuccess("Plano Alterado com sucesso!");
	header("Location: /admin/planos/");
	exit;

	
});

 ?>