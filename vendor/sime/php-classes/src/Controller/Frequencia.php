<?php 
namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\FrequenciaDao;
use \Sime\Controller\Escola;


class Frequencia extends Control{

	
	public function listar(){
		$frequenciaDao = new FrequenciaDao();

		$dados = $frequenciaDao->listar();

		return $dados;

	}
}

 ?>