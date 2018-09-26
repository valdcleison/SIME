<?php 
namespace Sime\Controller;

use \Sime\Control;

class Escola extends Control{
	
	const ERROR = "EscolaError";
	const ERROR_REGISTER = "EscolaErrorRegister";
	const SUCCESS = "EscolaSucesss";
	
	public function salvarEscola(){
		$escolaDao = new EscolaDao();
		$escolaDao->saveEscola($this);
	}

	public function editarEscola(){

	}

	public function deletarEscola(){

	}

	public static function buscarEscola(){

	}

	public static function buscarEscolaPorId(){
		
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