<?php 
namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\EscolaDao;
use \Sime\Model\UsuarioDao;

class Escola extends Control{
	
	const ERROR = "EscolaError";
	const ERROR_REGISTER = "EscolaErrorRegister";
	const SUCCESS = "EscolaSucesss";
	
	public function salvarEscola(){

		$this->listarPorEmail();
		$this->listarPorCpf();
		$this->listarPorUser();
		$this->listarPorCnpj();
		$escolaDao = new EscolaDao();

		
		$password = password_hash($this->getsenhaescola(), PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		$this->setsenhaescola($password);

		
		$escolaDao->saveEscola($this);

		echo "<script>alert('Escola Cadastrada com sucesso aguarde o nosso contato!');</script>";

	}

	public function listarPorEmail(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByEmail($this->getemailgestor()) !== null){
			throw new \Exception("Email já Cadastrado!");	
		}
	}

	public function listarPorCpf(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByCpf($this->getcpfgestor()) !== null){
			throw new \Exception("Cpf já Cadastrado!");	
		}
		
	}

	public function listarPorCnpj(){

		

		$escolaDao = new EscolaDao();

		$dado =  $escolaDao->getEscolaByCnpj($this->getcnpjescola());



		if($dado !== null){
			
			throw new \Exception("Escola já Cadastrada!");	
		}
		
		
	}

	public function listarPorUser(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByUser($this->getusuarioescola()) !== null){
			throw new \Exception("Usuario já Cadastrado, escolha outro!");	
		}
	}

	public function editarEscola(){
		$escolaDao = new EscolaDao();

		$escolaDao->updateEscola($this);

	}

	public function deletarEscola(){
		$escolaDao = new EscolaDao();

		

		$escolaDao->deleteEscola($this);
			
	}

	public static function buscarEscola(){
		return EscolaDao::listAll();
	}

	public function buscarEscolaPorId($id){
		$escolaDao = new EscolaDao();
		$dados =  $escolaDao->listById((int)$id);
		if($dados === null){
			throw new \Exception("Dados não encontrados!", 1);
			
		}
		$this->setData($dados);
	}

	


	public function alterarStatusEscola($status){
		
		if($status === 0){
			$escolaDao = new EscolaDao();
			$escolaDao->changeStatus($this, (int)1);

		}else if($status === 1){
			$escolaDao = new EscolaDao();
			$escolaDao->changeStatus($this, (int)0);
		}else{
			throw new \Exception("Não foi possivel alterar o status!", 1);
			
		}
	}

	public static function setError($msg){

		$_SESSION[Usuario::ERROR] = $msg;

	}

	public static function getError(){

		$msg = (isset($_SESSION[Usuario::ERROR]) && $_SESSION[Usuario::ERROR]) ? $_SESSION[Usuario::ERROR] : '';

		Usuario::clearError();

		return $msg;

	}

	public static function clearError(){

		$_SESSION[Usuario::ERROR] = NULL;

	}

	public static function setSuccess($msg){

		$_SESSION[Usuario::SUCCESS] = $msg;

	}

	public static function getSuccess(){

		$msg = (isset($_SESSION[Usuario::SUCCESS]) && $_SESSION[Usuario::SUCCESS]) ? $_SESSION[Usuario::SUCCESS] : '';

		Usuario::clearSuccess();

		return $msg;

	}

	public static function clearSuccess(){

		$_SESSION[Usuario::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg){

		$_SESSION[Usuario::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister(){

		$msg = (isset($_SESSION[Usuario::ERROR_REGISTER]) && $_SESSION[Usuario::ERROR_REGISTER]) ? $_SESSION[Usuario::ERROR_REGISTER] : '';

		Usuario::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister(){

		$_SESSION[Usuario::ERROR_REGISTER] = NULL;

	}
}


 ?>