<?php 

use \Sime\Controller\Escola;
use \Sime\Controller\Usuario;
use \Sime\Controller\Frequencia;
use \Sime\Controller\FrequenciaAluno;
use \Sime\Controller\Aluno;
use \Sime\Page;


$app->get("/portal/profile/", function(){
	Usuario::verifyLogin(1);

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("profile");
});

$app->get("/portal/", function(){
	Usuario::verifyLogin(1);

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("index");
});


$app->get("/portal/users/", function(){
	Usuario::verifyLogin(1);	


	$user = new Usuario();

	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	


	$page->setTpl("users", array(
		"users"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});


$app->get("/portal/users/create/", function(){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/users/create/", function(){
	Usuario::verifyLogin(1);

	$user = new Usuario();

	if(!$user->validaCPF($_POST['cpfpessoa'])){
		Usuario::setError("Cpf Inválidoo");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	if($_POST['pass'] !== $_POST['repass']){
		Usuario::setError("Senhas não conferem");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	
	try{
		$user->setData($_POST);

		$user->listarPorCpf();
		$user->listarPorEmail();
		$user->listarPorUser();
		
		$user->setidescola($dados[0]["escola_idescola"]);
		
		if($_FILES['avatar']['name'] !== ""){
			$user->salvarAvatar($_FILES['avatar']);
		}
		$user->salvarUsuarioEscola();

		Usuario::setSuccess("Usuario Cadastrado com sucesso");
		header("Location: /portal/users/");
		exit;
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	
});

$app->get("/portal/users/:id/delete/", function($id){
	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/status/:status", function($id, $status){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/password/", function($id){
	Usuario::verifyLogin(1);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/users/:id/", function($id){
	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("users-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});



$app->get("/portal/alunos/", function(){
	$users = Usuario::listar(1);

	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$aluno = new Aluno();
	$dados = $aluno->listar($dados[0]['escola_idescola']);

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("alunos", array(
		"alunos"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/create/", function(){
	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("alunos-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/alunos/create/", function(){
	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	if($_POST['celular'] === $_POST['telefone']){
		Usuario::setError("Telefones não podem ser iguais");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	if(strlen($_POST['cpfresponsavel']) !== 11){
		Usuario::setError("CPF do responsavel precisa conter 11 números");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	if(!Usuario::validaCPF($_POST['cpfresponsavel'])){
		Usuario::setError("CPF do responsavel invalído");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	if(strlen($_POST['cpfaluno']) !== 0 && strlen($_POST['cpfaluno']) === 11){
		if(!Usuario::validaCPF($_POST['cpfresponsavel'])){
			Usuario::setError("CPF do aluno invalído");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
	}
	try{
		$aluno = new Aluno();
		$checarMatricula = $aluno->listarPorNumMatricula($_POST["numeromatricula"], $dados[0]["escola_idescola"]);
		if(!empty($checarMatricula)){
			Usuario::setError("Número de matricula já existe");
			echo "<script>javascript:history.back()</script>";
			exit;
		}

		$aluno->setData($_POST);
		$aluno->salvarAluno($dados[0]["escola_idescola"]);

		Usuario::setSuccess("Aluno Cadastrado com sucesso!");
		header("Location: /portal/alunos/");
		exit;
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}

});

$app->get("/portal/alunos/:id/delete/", function($id){
	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("alunos-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/:id/", function($id){
	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("alunos-update", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/frequencia/", function(){
	$frequencia = new Frequencia();
	$dados = $frequencia->listar();
	

	$page = new Page("/views/Frequencia/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	

	$page->setTpl("index", array(
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});


$app->get("/portal/frequencia/:idfrequencia/detalhes", function($id){
	$frequenciaaluno = new FrequenciaAluno();
	$dados = $frequenciaaluno->listarTodosPorEscola($id);
	
	
	$page = new Page("/views/Frequencia/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa']
		)
	]);	
	
	$page->setTpl("frequenciaaluno", array(
		"idfrequencia"=>$id,
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/frequencia/new/", function(){
	echo "Criando nova frequencia!";
});

 ?>