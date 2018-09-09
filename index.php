<?php 
session_start();
require_once("vendor/autoload.php");

use \Sime\App;
use \Slim\Slim;
use \Sime\Page;
use \Sime\Controller\Usuario;

$app = new Slim();

$app->get('/', function(){
	
	$page = new Page();

	$page->setTpl("index");

});

$app->get('/login/', function(){
	
	$page = new Page("/views/",[
		"header"=>false,
		"footer"=>false
	]);	
	
	$page->setTpl("login");
});



$app->post('/login/', function(){
	
	try{
		$user = Usuario::login($_POST["user"], $_POST['pass']);
		switch ($user->getniveladmin()) {
			case '0':
				header("Location: /portal/aluno");
				exit;
			break;
			case '1':
				header("Location: /portal/escola");
				exit;
			break;
			case '2':
				header("Location: /admin/");
				exit;
			break;
		}
	}catch(\Exception $e){

		echo $e->getmessage();
		

	}
});
$app->get("/logout/", function(){
	Usuario::logout();
	header("Location: /login/");
	exit;
});

require_once("site.php");
require_once("admin.php");

$app->get("/:notfound/", function($not){
	echo "A pagina <b>www.sime.com.br/".$not."</b> não foi encontrada!";
});

$app->run();
 ?>