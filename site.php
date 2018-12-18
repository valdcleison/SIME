<?php
use \Sime\Page;
use \Sime\Controller\Escola;
use \Sime\Controller\Planos;
use \Sime\Controller\Usuario;



$app->get('/solicitacao/', function(){
	$planos = Planos::buscarPlanos();
	
	$page = new Page("/views/");

	$page->setTpl("solicitacao",[
		"planos"=>$planos,
		"error" => Escola::getError(),
		"success" => Escola::getSuccess()
	]);


});

$app->post('/solicitacao/', function(){


	try{
		$_POST['cpfgestor'] = str_replace(".", "", $_POST['cpfgestor']);
		$_POST['cpfgestor'] = str_replace("-", "", $_POST['cpfgestor']);

		$_POST['cnpj'] = str_replace( ".", "", $_POST['cnpj']);
		$_POST['cnpj'] = str_replace( "-", "", $_POST['cnpj']);
		$_POST['cnpj'] = str_replace( "/", "", $_POST['cnpj']);

		$_POST['cep'] = str_replace( "-", "", $_POST['cep']);

		$_POST['telefone'] = str_replace("-", "", $_POST['telefone']);
		$_POST['celular'] = str_replace( "-", "", $_POST['celular']);
		/*if((int) strlen($_POST['telefone']) < 11){
			Escola::setError("O numero de telefone precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}
		if((int) strlen($_POST['celular']) < 11 ){
			Escola::setError("O numero de cellular precisa conter 11 numeros!");
			echo "<script>javascript:history.back()</script>";
			exit;
		}


		foreach ($_POST as $key => $value) {
			if(empty($key)){
				Usuario::setError("Preencha todos os campos");
				echo "<script>javascript:history.back()</script>";
				exit;
			}
		}

		/*if(!Usuario::validaCPF($_POST['cpfgestor'])){
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
		}*/

		$escola = new Escola();

		$escola->setData($_POST);

		$escola->salvarEscola();

	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /solicitacao/");
		exit;
	}

	Usuario::setSuccess("Escola Cadastrada com sucesso!");
	header("Location: /solicitacao/");
	exit;
});


 ?>
