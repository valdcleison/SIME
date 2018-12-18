<?php 
namespace Sime\Controller;

use \Sime\Model\MatriculaDao;
use \Sime\Control;

class Matricula extends Control{
	
	function listarTodosPorEscola($idescola){
		$matriculaDao = new MatriculaDao();
		$dados = $matriculaDao->buscarPorEscola($idescola);
		return $dados;
	}


}



 ?>