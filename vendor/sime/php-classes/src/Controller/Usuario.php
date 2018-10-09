<?php 

namespace Sime\Controller;

use \Sime\Model\UsuarioDao;
use \Sime\Control;

class Usuario extends Control{
	const SESSION = "User";
	const ENCODEKEY = "simeescolavwjdjp";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

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

	public static function verifyLogin($nivelAdmin){

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

	public static function validaCPF($cpf = null) {

		if(empty($cpf)) {
			return false;
		}

		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		

		if (strlen($cpf) != 11) {
			return false;
		}

		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;

		 } else {   
			
			for ($t = 9; $t < 11; $t++) {
				
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	public static function validaCNPJ($cnpj = null) {

		// Verifica se um número foi informado
		if(empty($cnpj)) {
			return false;
		}

		// Elimina possivel mascara
		$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
		$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
		
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cnpj) != 14) {
			return false;
		}
		
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cnpj == '00000000000000' || 
			$cnpj == '11111111111111' || 
			$cnpj == '22222222222222' || 
			$cnpj == '33333333333333' || 
			$cnpj == '44444444444444' || 
			$cnpj == '55555555555555' || 
			$cnpj == '66666666666666' || 
			$cnpj == '77777777777777' || 
			$cnpj == '88888888888888' || 
			$cnpj == '99999999999999') {
			return false;
			
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
		 
			$j = 5;
			$k = 6;
			$soma1 = "";
			$soma2 = "";

			for ($i = 0; $i < 13; $i++) {

				$j = $j == 1 ? 9 : $j;
				$k = $k == 1 ? 9 : $k;

				$soma2 += ($cnpj{$i} * $k);

				if ($i < 12) {
					$soma1 += ($cnpj{$i} * $j);
				}

				$k--;
				$j--;

			}

			$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
			$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

			return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
		 
		}
	}

	public function listarPorEmail(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByEmail($this->getemailpessoa()) !== null){
			throw new \Exception("Usuario já Existe!");	
		}
	}

	public function listarPorCpf(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByCpf($this->getcpfpessoa()) !== null){
			throw new \Exception("Usuario já Existe!");	
		}
		
	}

	public function checkUsuario($id){
		$userDao = new UsuarioDao();
		$escola = $userDao->checkUsuario($id);

		$this->setData($escola);

		
		if((int)$this->getstatusescola() === 0){
			throw new \Exception("Escola bloqueada, por favor entre em contato com o suporte do sistema!!", 1);
			
		}
	}

	public function listarPorUser(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByUser($this->getusuario()) !== null){
			throw new \Exception("Usuario já Existe!");	
		}
	}

	public static function listar(){
		return UsuarioDao::listAll();
	}

	public function salvarAdmin(){
		$userDao = new UsuarioDao();

		$this->listarPorCpf();
		$this->listarPorEmail();
		$this->listarPorUser();

		$password = password_hash($this->getpass(), PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		
		
		$this->setpass($password);

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

		return $userDao;
		
	}

	public static function codigoValidado($id){
		$userDao = new UsuarioDao();
		$userDao->setForgotUsed($id);
	}


	public function atualizarSenha($senha){
		$userDao = new UsuarioDao();
		
		$userDao->changePassword($this->getidusuario(),$senha);
	}

	public function alterarSenha($senhaAtual, $novaSenha){
		$atual = password_hash($senhaAtual, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		$nova = password_hash($novaSenha, PASSWORD_DEFAULT, [
			'cost'=>12
		]);



		if(!password_verify($senhaAtual, $this->getsenha())){
			throw new \Exception("Senha Atual não confere!");
		}else{
			$userDao = new UsuarioDao();
		
			$userDao->changePassword($this->getidusuario(),$nova);
		}
	}

	public function atualizarStatus($statusAtual){

		if($statusAtual === 0){
			
			$userDao = new UsuarioDao();
			$userDao->changeStatus($this, 1);

		}else if($statusAtual === 1){
			
			$userDao = new UsuarioDao();
			$userDao->changeStatus($this, 0);

		}else{
			throw new \Exception("Não foi possivel editar o status");			
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