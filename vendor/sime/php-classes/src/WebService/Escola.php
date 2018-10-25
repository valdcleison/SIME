<?php 
namespace Sime\WebService;

use \Sime\Control;
use \Sime\Model\EscolaDao;
use \Sime\Model\UsuarioDao;

class Escola extends Control{

public function listarPorUsuario($idusuario){
	$escolaDao = new EscolaDao();
	$escola = $escolaDao->wslistarPorUsuario($idusuario);
	$this->setData($escola);
}


}
?>