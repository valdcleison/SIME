<?php 

namespace Sime\Controller;

use \Sime\Model\UsuarioDao;
use \Sime\Control;

class Usuario extends Control{
	const SESSION = "User";

	public static function login($nomeUser, $pass){
		$UsuarioDao = new UsuarioDao();

		$data = $UsuarioDao->login($nomeUser, $pass);

		$user = new Usuario();

		$user->setData($data);

		$_SESSION[Usuario::SESSION] = $user->getValues();

		return $user;
	}

	public static function logout(){
		session_unset($_SESSION[Usuario::SESSION]);
	}

	public function verifyLogin($nivelAdmin){

		if(
			!isset($_SESSION[Usuario::SESSION])||
			!$_SESSION[Usuario::SESSION]||
			!(int)$_SESSION[Usuario::SESSION]["idusuario"] > 0 ||
			!(int)$_SESSION[Usuario::SESSION]["niveladmin"] === $nivelAdmin
		){
			return false;
		}else{
			return true;
		}
	}

}
 ?>