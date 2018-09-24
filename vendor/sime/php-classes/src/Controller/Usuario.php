<?php 

namespace Sime\Controller;

use \Sime\Model\UsuarioDao;
use \Sime\Control;

class Usuario extends Control{
	const SESSION = "User";
	const ENCODEKEY = "simeescolavwjdjp";

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
			header("Location: /login/");
			exit;
		}
	}

	public static function list(){
		return UsuarioDao::listAll();
	}

	public function salvarAdmin(){
		$userDao = new UsuarioDao();

		$userDao->saveAdmin($this);

	}

	public function buscarAdmin($id){
		$userDao = new UsuarioDao();

		$data = $userDao->getAdmin((int)$id);

		$this->setData($data);
	}
					
	public function atualizarAdmin(){
		$userDao = new UsuarioDao();
		
		$userDao->updateAdmin($this);
	}

	public function deletarAdmin(){
		$userDao = new UsuarioDao();
		
		$userDao->deleteAdmin($this);
	}

	public static function reSenha($email){
		$userDao = new UsuarioDao();
		$user = $userDao->getUserByEmail($email);

		$data = $userDao->forgotPassword($user);

		
		$code = base64_encode(openssl_encrypt( $data["idusuariorecuperarsenha"] , 'aes-256-cbc' , Usuario::ENCODEKEY , 0,  Usuario::ENCODEKEY));

		//$code = base64_encode(openssl_encrypt($data["idusuariorecuperarsenha"], 'aes-256-cbc', Usuario::ENCODEKEY, $iv));

		$link = "www.sime.com.br/forgot/reset-password?code=$code";

		$email = new \Sime\Mailer($user['emailpessoa'], $user['nomepessoa'], "Redefinir Senha", "forgot", array(
			"name"=>$user['nomepessoa'],
			"link"=>$link
		));

		$email->send();

		return $data;
	}

	public static function validarCodigo($code){
		
		
		$id = openssl_decrypt(base64_decode($code),'aes-256-cbc', Usuario::ENCODEKEY, 0, Usuario::ENCODEKEY);
		
		$userDao = UsuarioDao::getRecovery($id);

		Usuario::codigoValidado($id);
		
		return $userDao;
		
	}

	public static function codigoValidado($id){
		$userDao = new UsuarioDao();
		$userDao->setForgotUsed($id);
	}

	public function atualizarSenha($senha){
		$userDao = new UsuarioDao();
		$userDao->changePassword();
	}
}
 ?>