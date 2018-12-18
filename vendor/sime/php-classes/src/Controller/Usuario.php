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
		$_SESSION[Usuario::SESSION] = NULL;   
	}

	public static function verifyLogin($nivelAdmin){

		if(
			!isset($_SESSION[Usuario::SESSION])||
			!$_SESSION[Usuario::SESSION]||
			!(int)$_SESSION[Usuario::SESSION]["idusuario"] > 0 ||
			(int)$_SESSION[Usuario::SESSION]["niveladmin"] !== $nivelAdmin
		){
			Usuario::setError("Necessario realizar login");
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

	$j=0;
			for($i=0; $i<(strlen($cnpj)); $i++)
				{
					if(is_numeric($cnpj[$i]))
						{
							$num[$j]=$cnpj[$i];
							$j++;
						}
				}
			//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
			if(count($num)!=14)
				{
					$isCnpjValid=false;
				}
			//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
			if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
				{
					$isCnpjValid=false;
				}
			//Etapa 4: Calcula e compara o primeiro dígito verificador.
			else
				{
					$j=5;
					for($i=0; $i<4; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=4; $i<12; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[12])
						{
							$isCnpjValid=false;
						} 
				}
			//Etapa 5: Calcula e compara o segundo dígito verificador.
			if(!isset($isCnpjValid))
				{
					$j=6;
					for($i=0; $i<5; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=5; $i<13; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[13])
						{
							$isCnpjValid=false;
						}
					else
						{
							$isCnpjValid=true;
						}
				}
			
			return $isCnpjValid;
	}
	public function listarPorEscola($idescola){

		$userDao = new UsuarioDao();
		$dados = $userDao->checkUsuario($idescola);
		
		$escola = $userDao->listByEscola($dados[0]['idescola']);

		$this->setData(array());
		
		return $escola;
	}

	public function listarPorEmail(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByEmail($this->getemailpessoa()) !== null){
			
			throw new \Exception("Email já Existe!");	
		}
	}

	public function listarPorCpf(){
		$userDao = new UsuarioDao();

		if($userDao->getUserByCpf($this->getcpfpessoa()) !== null){
		
			throw new \Exception("CPF já Existe!");	
		}
		
	}



	public function checkUsuario($id){
		$userDao = new UsuarioDao();
		$escola = $userDao->checkUsuario($id);
		
		$this->setData($escola[0]);

		
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

	public static function listar($nivel){

		return UsuarioDao::listAll($nivel);
	}

	public function checarAvatar(){
		if(file_exists($_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"Admin" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR . 
			"user-avatar" . 
			$this->getidusuario() . ".jpg")){

			$url = "/res/Admin/img/user-avatar/" . $this->getusuario() . ".jpg";
		} else {
			$url = "/res/Admin/images/user.png";
		}


	}



	public function salvarUsuarioEscola($avatar){
		$usuarioDao = new UsuarioDao();
		
		if($this->getinadmin() === null){
			$this->setinadmin(0);
		}else{
			$this->setinadmin(1);
		}

		$password = password_hash($this->getpass(), PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		
		
		$this->setpass($password);
		
		$usuarioDao->saveUserEscola($this, $avatar);

	}

	public function salvarAvatar($file){
		
		$extensao = explode(".", $file['name']);
		$extensao = end($extensao);
		
		switch ($extensao) {
			case "jpg":
			case "jpeg":
			case "JPG":
			case "JPEG":
				$image = imagecreatefromjpeg($file["tmp_name"]);
			break;
				
			case "gif":
			case "GIF":
				$image = imagecreatefromgif($file["tmp_name"]);
			break;
			case "png":
			case "PNG":
				$image = imagecreatefrompng($file["tmp_name"]);
			break;
			
			default:
				throw new \Exception("Por favor envie uma imagem");
			break;
		}
		

		$dist = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"Admin" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR . 
			"user-avatar" . DIRECTORY_SEPARATOR . 
			$this->getusuario() . ".jpg";

		imagejpeg($image, $dist);
		imagedestroy($image);

		$this->checarAvatar();
		$_SESSION['User']['avatar'] = $this->getusuario();
	}


	public function listarUsuariosEscola($idescola, $idusuario){

		$userDao = new UsuarioDao();
		$dados = $userDao->checkUsuario($idescola);
		
		$escola = $userDao->listUserByEscola($dados[0]['idescola'], $idusuario);

		$this->setData(array());
		
		return $escola;
	}

	public function editarUsuarioEscola($avatar){
		$usuarioDao = new UsuarioDao();
		
		if($this->getinadmin() === null){
			$this->setinadmin(0);
		}else{
			$this->setinadmin(1);
		}
		
		$usuarioDao->editUserEscola($this, $avatar);
	}

	public function deletarUsuarioEscola(){
		$usuarioDao = new UsuarioDao();
		
		$usuarioDao->deleteUserEscola($this);
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

	public function salvarEscola($idescola){
		$userDao = new UsuarioDao();
		$userDao->saveEscola($this, $idescola);
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

		
		$link = "www.simeescola.com.br/forgot/reset-password?code=$code";

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
		$pass = password_hash($senha, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		$userDao->changePassword($this->getidusuario(),$pass);
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