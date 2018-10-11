<?php 
session_start();
require_once("vendor/autoload.php");

use \Sime\App;
use \Slim\Slim;
use \Sime\Page;
use \Sime\Controller\Usuario;

$app = new Slim();

$app->notFound(function () use ($app) {
    $page = new Page("/views/", [
    	"header"=>false,
    	"footer"=>false
    ]);

	$page->setTpl("not");
});

$app->get('/', function(){
	
	$page = new Page();

	$page->setTpl("index");

});

$app->get('/login/', function(){
	
	$page = new Page("/views/",[
		"header"=>false,
		"footer"=>false
	]);	
	
	$page->setTpl("login", [
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	]);
});



$app->post('/login/', function(){
	if (empty($_POST["user"]) || empty($_POST['pass'])) {

		Usuario::setError("Preencha todos os campos");
		header("Location: /login/",1000);
		exit;
	}
	try{
		$user = Usuario::login($_POST["user"], $_POST['pass']);
		switch ($user->getniveladmin()) {
			case '0':
				if((int)$user->getstatususuario() === 0){
					Usuario::logout();
					Usuario::setError("Usuario bloqueado, por favor entre em contato com o gestor da escola!");
					header("Location: /login/",1000);
					exit;
				}
				header("Location: /portal/aluno");
				exit;
			break;
			case '1':

				$user->checkUsuario($user->getidusuario());
					
				if((int)$user->getstatususuario() === 0){
					Usuario::logout();
					Usuario::setError("Usuario bloqueado, por favor entre em contato com o gestor da escola!");
					header("Location: /login/",1000);
					exit;
				}
				header("Location: /portal/");
				exit;
			break;
			case '2':
				if((int)$user->getstatususuario() === 0){
					Usuario::logout();
					Usuario::setError("Usuario bloqueado, por favor entre em contato com o administrador do sistema!");
					header("Location: /login/",1000);
					exit;
				}
				header("Location: /admin/");
				exit;
			break;
		}
	}catch(\Exception $e){
		Usuario::setError($e->getmessage());
		header("Location: /login/",1000);
		exit;
	}
});
$app->get("/logout/", function(){
	Usuario::logout();
	Usuario::setSuccess("Usuario desconectado com sucesso!");
	header("Location: /login/");
	exit;
});

$app->post("/forgot/", function(){
	if(empty($_POST['emailpessoa'])){
		Usuario::setError("Preencha todos os campos!");
		header("Location: /login/");
		exit;
	}
	try{
		$email = $_POST['emailpessoa'];

		$user = Usuario::reSenha($email);
		
	}catch(Exception $e){
		Usuario::setError("Não foi possivel recuperar sua senha!");
		header("Location: /login/");
		exit;
	}


	Usuario::setSuccess("Acese seu email para recuperar sua senha!");
	header("Location: /login/");
	exit;
});

$app->get("/forgot/reset-password", function(){

	$userInfo = Usuario::validarCodigo($_GET['code']);
	
	$page = new Page("/views/",[
		"header"=>false,
		"footer"=>false
	]);	
	
	$page->setTpl("forget", array(
		"code"=>$_GET['code'],
		"error"=>Usuario::getError(),
		"succes"=>Usuario::getSuccess()
	));
});

$app->post("/forgot/reset-password/", function(){
	if($_POST['senha'] != $_POST['comsenha']){
	
		Usuario::setError("Senhas não conferem");
		header("Location: /forgot/reset-password?code=".$_POST['code']."");
		exit;
	}
	if(empty($_POST['senha']) || empty($_POST['comsenha'])){
	
		Usuario::setError("Preencha todos os campos");
		header("Location: /forgot/reset-password?code=".$_POST['code']."");
		exit;
	}
	try{
		$code = $_POST['code'];
		$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		$recoveryInfo = Usuario::validarCodigo($code);
		
		$idusuario = (int)$recoveryInfo['idusuario'];

		Usuario::codigoValidado((int)$recoveryInfo['idusuariorecuperarsenha']);

		$user = new Usuario();

		$user->buscarAdmin($idusuario);
		$user->atualizarSenha($senha);
	}catch(Exception $e){
		Usuario::setError($e->getMessage());
		header("Location: /login");
		exit;
	}

	Usuario::setSuccess("Senha alterada com sucesso!");
	header("Location: /login/");
	exit;

});

require_once("site.php");
require_once("admin.php");
require_once("escola.php");


$app->run();
 ?>