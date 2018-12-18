<?php


use \Sime\Controller\Escola;
use \Sime\Controller\Usuario;
use \Sime\Controller\Frequencia;
use \Sime\Controller\FrequenciaAluno;
use \Sime\Controller\Aluno;
use \Sime\Page;
use Dompdf\Dompdf;

header('Content-Type: text/html; charset=utf-8');

$app->get("/portal/app/", function(){
	Usuario::verifyLogin(1);
	
		$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("app",array(
		"error"=>Escola::getError(),
		"success"=>Escola::getSuccess()
	));
});

$app->get("/portal/profile/", function(){
	Usuario::verifyLogin(1);
	$user = new Usuario();
	$dadosusuario = $user->listarPorEscola($_SESSION['User']['idusuario']);
	
	$escola = new Escola();
	$dados = $escola->listarPorEscola($dadosusuario[0]["escola_idescola"]);
		$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("profile",array(
		"escola"=>$dados[0],
		"username"=>$dadosusuario[0]["usuario"],
		"user"=>$dadosusuario[0]["inadmin"],
		"error"=>Escola::getError(),
		"success"=>Escola::getSuccess(),
		"avatar"=> $_SESSION['User']['avatar'],
		"inadmin"=> $_SESSION['User']['inadmin']
	));
});

$app->post("/portal/profile/", function(){
	Usuario::verifyLogin(1);

	$user = new Usuario();
	$dadosusuario = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$escola = new Escola();
	

	try {
		$escola = new Escola();
		$escola->buscarEscolaPorId($dadosusuario[0]['escola_idescola']);

		$escola->setData($_POST);
		
		$escola->editarEscola();

	} catch (\Exception $e) {
		Escola::setError($e->getmessage());
		header("Location: /portal/profile/");
		exit;
	}

	Escola::setSuccess("Dados alterado com sucesso!");
	header("Location: /portal/profile/");
	exit;
});

$app->get("/portal/", function(){
	header("Location: /portal/profile/");
	exit;
	Usuario::verifyLogin(1);

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("index");
});


$app->get("/portal/users/", function(){
	Usuario::verifyLogin(1);

	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}
	$user = new Usuario();

	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
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
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("users-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/users/create/", function(){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$user = new Usuario();

	if(!$user->validaCPF($_POST['cpfpessoa'])){
		Usuario::setError("Cpf Inválidoo");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	$_POST['cpfpessoa'] = str_replace(".", "", $_POST['cpfpessoa']);
	$_POST['cpfpessoa'] = str_replace("-", "", $_POST['cpfpessoa']);

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
		$avatar = null;
		if($_FILES['avatar']['name'] !== ""){
			$user->salvarAvatar($_FILES['avatar']);
			$avatar = $_POST['usuario'];
		}
		$user->salvarUsuarioEscola($avatar);

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
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$user = new Usuario();
	$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);
	if($dados == null){
		Usuario::setError("Usuário não encontrado");
		header("Location: /portal/users/");
		exit;
	}
	$user->setData($dados[0]);
	
	$user->deletarUsuarioEscola();	

	Usuario::setSuccess("Usuario Deletado com sucesso");
	header("Location: /portal/users/");
	exit;
});

$app->get("/portal/users/:id/status/:status/", function($id, $status){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	try{
		$user = new Usuario();
		$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);
		if($dados == null){
			Usuario::setError("Usuário não encontrado");
			header("Location: /portal/users/");
			exit;
		}
		$user->setData($dados[0]);
		
		$user->atualizarStatus((int)$status);

		Usuario::setSuccess("Status alterado com sucesso");
		header("Location: /portal/users/");
		exit;
		
	} catch (\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}	

	Usuario::setSuccess("Status alterado com sucesso!");
	header("Location: /admin/users/");
	exit;
});

$app->get("/portal/users/:id/password/", function($id){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$user = new Usuario();
	$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);
	if($dados == null){
		Usuario::setError("Usuário não encontrado");
		header("Location: /portal/users/");
		exit;
	}

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("users-update-password", array(
		"id"=>$id,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/users/:id/password/", function($id){	
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	if($_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	if($_POST['newpass'] !== $_POST['repass']){
		Usuario::setError("Senhas não conferem");
		header("Location: /portal/users/$id/password/");
		exit;
	}
	$user = new Usuario();
	$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);
	if($dados == null){
		Usuario::setError("Usuário não encontrado");
		header("Location: /portal/users/$id/password/");
		exit;
	}
	$user->setData($dados[0]);

	$user->atualizarSenha($_POST['newpass']);

	Usuario::setSuccess("Senha alterada com sucesso");
	header("Location: /portal/users/");
	exit;
});

$app->get("/portal/users/:id/", function($id){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	try {
		$user = new Usuario();
		$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);
		if($dados == null){
			Usuario::setSuccess("Usuário não encontrado");
			header("Location: /portal/users/");
			exit;
		}
		
	} catch (\Exception $e) {
		throw new \Exception($e, 1);
	}
	
	

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
		)
	]);


	$page->setTpl("users-update", array(
		"user"=>$dados[0],
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/users/:id/", function($id){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	try{
		$user = new Usuario();
		$dados = $user->listarUsuariosEscola($_SESSION['User']['idusuario'], $id);

		if($dados == null){
			Usuario::setSuccess("Usuário não encontrado");
			header("Location: /portal/users/");
			exit;
		}

		
		$user->setData($dados[0]);
		$user->setinadmin(null);
		$user->setData($_POST);
		
		$avatar = null;

		if($_FILES['avatar']['name'] !== ""){
			$user->salvarAvatar($_FILES['avatar']);
			$avatar = $user->getusuario();
		}

		$user->editarUsuarioEscola($avatar);

		Usuario::setSuccess("Usuário Editado com sucesso");
		header("Location: /portal/users/");
		exit;
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
});


$app->get("/portal/alunos/", function(){
	Usuario::verifyLogin(1);
	$users = Usuario::listar(1);

	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$aluno = new Aluno();
	$dados = $aluno->listar($dados[0]['escola_idescola']);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("alunos", array(
		"alunos"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/:id/senha/", function($id){
	Usuario::verifyLogin(1);

	$aluno = new Aluno();
	$dados = $aluno->listarPorId($id);
	
	$aluno->setData($dados[0]);



	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);


	$page->setTpl("alunos-senha", array(
		"id"=>$aluno->getidaluno(),
		"nome"=>$aluno->getnomepessoa(),
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/alunos/:id/senha/", function($id){
	Usuario::verifyLogin(1);
	if($_POST['newpass'] !== $_POST['repass']){
		Escola::setError("Senhas não conferem");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	if(strlen($_POST['newpass']) < 8 || strlen($_POST['repass']) < 8){
		Escola::setError("Senha precisa conter no minimo 8 caracteres");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	

	$aluno = new Aluno();
	$dados = $aluno->listarPorId($id);
	
	$aluno->setData($dados[0]);

	$aluno->atualizarSenhaAluno($_POST['newpass']);

	Escola::setSuccess("Senha alterada com sucesso");
	header("Location: /portal/alunos/");
	exit;
});

$app->get("/portal/alunos/:id/carteirinha", function($id){
	Usuario::verifyLogin(1);

	$aluno = new Aluno();
	$dados = $aluno->listarPorAluno($id);
	$aluno->setData($dados[0]);

	$escola = new Escola();
	$dadosescola = $escola->listarPorEscola($aluno->getescola_idescola());

	$aluno->gerarCarteirinha($aluno, $dadosescola[0]['nomeescola'], $dadosescola[0]['idescola']);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("carteirinha", array(
		"matricula"=>$aluno->getnumeromatricula(),
		"id"=>$dadosescola[0]['idescola'],
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/alunos/create/", function(){
	Usuario::verifyLogin(1);
	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);


	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("alunos-create", array(
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/alunos/create/", function(){
	Usuario::verifyLogin(1);
	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$_POST['cpfresponsavel'] = str_replace(".", "", $_POST['cpfresponsavel']);
	$_POST['cpfresponsavel'] = str_replace("-", "", $_POST['cpfresponsavel']);

	$_POST['cep'] = str_replace( "-", "", $_POST['cep']);

	$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
	$_POST['celular'] = str_replace( "-", "", $_POST['celular']);

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
	$_POST['cpfaluno'] = str_replace(".", "", $_POST['cpfaluno']);
	$_POST['cpfaluno'] = str_replace("-", "", $_POST['cpfaluno']);
	
	if(strlen($_POST['cpfaluno']) !== 0 && strlen($_POST['cpfaluno']) === 11){
		if(!Usuario::validaCPF($_POST['cpfaluno'])){
			Usuario::setError("CPF do aluno invalído");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		$_POST['cpfaluno'] = str_replace(".", "", $_POST['cpfaluno']);
		$_POST['cpfaluno'] = str_replace("-", "", $_POST['cpfaluno']);

	}
	if($_POST["senha"] !== $_POST["resenha"]){
		Usuario::setError("Senhas não conferem");
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	

	
	try{
		$user = new Usuario();
		$user->setusuario($_POST["usuario"]);
		$user->listarPorUser();

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
	Usuario::verifyLogin(1);
	try {
		$aluno = new Aluno();
		$dados = $aluno->listarPorAluno($id);

		$aluno->setData($dados[0]);
		$aluno->deletarAluno();

		Usuario::setSuccess("Aluno Deletado com sucesso!");
		header("Location: /portal/alunos/");
		exit;
	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}


});

$app->get("/portal/alunos/:id/", function($id){
	Usuario::verifyLogin(1);

	$aluno = new Aluno();
	$dados = $aluno->listarPorAluno($id);

	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);

	$page->setTpl("alunos-update", array(
		"aluno"=>$dados[0],
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/alunos/:id/", function($id){
	Usuario::verifyLogin(1);

	$aluno = new Aluno();
	$dados = $aluno->listarPorAluno($id);

	if($_POST['celular'] === $_POST['telefone']){
		Usuario::setError("Telefones não podem ser iguais");
		echo "<script>javascript:history.back()</script>";
		exit;
	}

	if($_POST['cpfaluno'] !== ""){

		if(!Usuario::validaCPF($_POST['cpfaluno'])){
			Usuario::setError("CPF do aluno invalído");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
	}
	try {
		$aluno->setData($dados[0]);
		$aluno->setData($_POST);

		$aluno->atualizarAluno();

		Usuario::setSuccess("Aluno Editado com sucesso!");
		header("Location: /portal/alunos/");
		exit;
	} catch (\Exception $e) {
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}

});


$app->get("/portal/frequencia/", function(){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$frequencia = new Frequencia();
	$dados = $frequencia->listarTodosPorNovasEscola($dados[0]["escola_idescola"]);


	$page = new Page("/views/Frequencia/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar']
		)
	]);


	$page->setTpl("index", array(
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});



$app->get("/portal/frequencia/:idfrequencia/detalhes/", function($id){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$frequenciaaluno = new FrequenciaAluno();
	$dados = $frequenciaaluno->listarTodosPorEscola($id);


	$page = new Page("/views/Frequencia/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar']
		)
	]);

	$page->setTpl("frequenciaaluno", array(
		"idfrequencia"=>$id,
		"frequencia"=>$dados,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->get("/portal/frequencia/:idfrequencia/detalhes/:idfrequenciaaluno/", function($id, $idfrequenciaaluno){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$user = new Usuario();
	$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

	$frequenciaaluno = new FrequenciaAluno();
	$dados = $frequenciaaluno->listarPorId($dados[0]['escola_idescola'],$id, $idfrequenciaaluno);


	$page = new Page("/views/Frequencia/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar']
		)
	]);

	$page->setTpl("justificar", array(
		"idfrequencia"=>$id,
		"frequencia"=>$dados[0],
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/frequencia/:idfrequencia/detalhes/:idfrequenciaaluno/", function($id, $idfrequenciaaluno){
	Usuario::verifyLogin(1);
	if((int)$_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}
	try {
		$user = new Usuario();
		$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

		$frequenciaaluno = new FrequenciaAluno();
		$dadosFrequencia = $frequenciaaluno->listarPorId($dados[0]['escola_idescola'],$id, $idfrequenciaaluno);

		$anexo = null;	

		if($_FILES['anexo']['name'] !== ""){
			$frequenciaaluno->salvarAnexo($_FILES['anexo'], $dadosFrequencia[0]['idfrequenciaaluno']);
			$anexo = $dadosFrequencia[0]['idfrequenciaaluno'];
		}


		$frequenciaaluno->justificar($_POST['motivo'], $anexo, $dadosFrequencia[0]['idfrequenciaaluno']);

	} catch (Exception $e) {
		Usuario::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	Usuario::setSuccess("Frequência justificada com sucesso");
	header("Location: /portal/frequencia/$id/detalhes/");
	exit;


});

$app->get("/portal/frequencia/new/", function(){
	Usuario::verifyLogin(1);
	if($_SESSION['User']['inadmin'] !== 1){
		Escola::setError("Você não possui permissão para acessar essa área");
		header("Location: /portal/profile/");
		exit;
	}

	$users = Usuario::listar(1);
	try {
		$user = new Usuario();
		$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

		$frequencia = new Frequencia();
		$frequencia->checarFrequencia($dados[0]["escola_idescola"]);

		$dadosFrequencia = $frequencia->novaFrequencia($dados[0]["escola_idescola"]);

		$frequenciaaluno = new FrequenciaAluno();
		$frequenciaaluno->novaFrequenciaAluno($dadosFrequencia["idfrequencia"], $dados[0]["escola_idescola"]);

		Escola::setSuccess("Frequencia registrada com sucesso!");
		header("Location: /portal/frequencia/");
		exit;
	} catch (\Exception $e) {
		Escola::setError($e->getmessage());
		header("Location: /portal/frequencia/");
		exit;
	}

});

$app->get("/portal/relatorios/", function(){
	Usuario::verifyLogin(1);
	try {
		$user = new Usuario();
		$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

		$FrequenciaAluno = new FrequenciaAluno();
		$dadosFrequencia = $FrequenciaAluno->listarHoje($dados[0]["escola_idescola"]);

			
	} catch (\Exception $e) {
		Escola::setError($e->getmessage());
		header("Location: /portal/frequencia/");
		exit;
	}

	$ausente = count($dadosFrequencia);
	$presente = 0;


	foreach ($dadosFrequencia as $key => $value) {
		if($value['hrentrada'] != null){
			$ausente = $ausente - 1;
			$presente = $presente + 1;
		}

	}



	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar'],
			"inadmin"=> $_SESSION['User']['inadmin']
		)
	]);


	$page->setTpl("relatorios", array(
		"frequencia"=>$dadosFrequencia,
		"ausente"=>$ausente,
		"presente"=>$presente,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});


$app->get("/portal/relatorios/pdf/", function(){

	Usuario::verifyLogin(1);
	try {
		$user = new Usuario();
		$dados = $user->listarPorEscola($_SESSION['User']['idusuario']);

		$FrequenciaAluno = new FrequenciaAluno();
		$dadosFrequencia = $FrequenciaAluno->listarHoje($dados[0]["escola_idescola"]);

			
	} catch (\Exception $e) {
		Escola::setError($e->getmessage());
		header("Location: /portal/frequencia/");
		exit;
	}

	$ausente = count($dadosFrequencia);
	$presente = 0;


	foreach ($dadosFrequencia as $key => $value) {
		if($value['hrentrada'] == null){
			$ausente = $ausente - 1;
			$presente = $presente + 1;
		}

	}



	$page = new Page("/views/Escola/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar']
		)
	]);


	$html = $page->setTpl("relatorios", array(
		"frequencia"=>$dadosFrequencia,
		"ausente"=>$ausente,
		"presente"=>$presente,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	),true);


	try {

		$dompdf = new Dompdf();
		$dompdf->loadHtml('
			<h1 style="text-align: center;">Celke - Gerar PDF</h1>
			<p>Donec viverra erat sed eros tristique venenatis. Suspendisse vulputate tortor eget nulla tincidunt semper. Fusce ac sodales sem. Maecenas quis massa ut nisi dictum ultrices. Nunc quis tortor tortor. In quis ante vel enim efficitur scelerisque. Vestibulum rutrum mauris mattis ligula blandit, at imperdiet odio interdum. Proin luctus interdum nisi. Etiam sapien augue, aliquam vel augue et, tristique placerat tortor. Sed in porttitor urna, et fringilla libero. Curabitur mollis sodales blandit.</p>

			<p>Nulla at leo in risus varius sagittis. Aliquam ullamcorper lectus ultrices tempus mattis. Nunc dapibus lorem ut efficitur cursus. Duis ac sem sed diam pulvinar interdum at nec dolor. Proin nibh augue, efficitur ornare nibh lobortis, pretium fermentum erat. Aliquam in diam faucibus, consectetur orci non, ultrices ex. Mauris auctor urna in eleifend malesuada. Aenean sit amet laoreet turpis. Proin ac ante mi. Vivamus aliquam quis erat non porttitor. Sed efficitur turpis suscipit massa pretium, eget viverra erat luctus. Curabitur rutrum arcu at massa pretium, ac sodales mauris elementum. Curabitur id odio et velit accumsan interdum. Nulla facilisi.</p>
		');

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
		
	} catch (\Exception $e) {
		throw new Exception($e, 1);
		
	}

	



});
 ?>
