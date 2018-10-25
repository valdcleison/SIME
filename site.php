<?php 
use \Sime\Page;
use \Sime\Controller\Escola;

$app->get('/solicitacao/', function(){
	
	$page = new Page("/views/");	
	
	$page->setTpl("solicitacao",[
		"error" => Escola::getError(),
		"success" => Escola::getSuccess()		
	]);
});

$app->post('/solicitacao/', function(){
	

	foreach ($_POST as $key => $value) {
		if(!isset($key) || $key == ""){
			Escola::setError("Preencha todos os campos!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if((int) strlen($_POST['cpfgestor']) !== 11){
			Escola::setError("O cpf precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if((int) strlen($_POST['telefone']) !== 11){
			Escola::setError("O numero de telefone precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if((int) strlen($_POST['celular']) !== 11){
			Escola::setError("O numero de cellular precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if(!is_numeric($_POST['telefone'])){
			Escola::setError("digite apenas numeros para o numero de telefone!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if(is_numeric($_POST['celular'])){
			Escola::setError("Digite apenas numeros para o numero de cellular!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}

		if((int) strlen($_POST['cnpjescola']) !== 14){
			Escola::setError("O cnpj precisa conter 14 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
	}
	

	try{
	$escola = new Escola();

	$escola->setData($_POST);
	
	$escola->salvarEscola();
	
	}catch(Exception $e){
		Escola::setError($e->getmessage());
		echo "<script>javascript:history.back()</script>";
		exit;
	}
	
	header("Location: /");
	exit;
});





 ?>