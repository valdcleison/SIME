<?php 
namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\FrequenciaDao;
use \Sime\Controller\Escola;


class Frequencia extends Control{

	public function listarTodosPorEscola($idescola){
		$frequenciaDao = new FrequenciaDao();

		$dados = $frequenciaDao->listarTodosPorEscola($idescola);

		return $dados;
	}

	public function listarTodosPorNovasEscola($idescola){
		$frequenciaDao = new FrequenciaDao();

		$dados = $frequenciaDao->listarTodosPorNovasEscola($idescola);

		return $dados;
	}
	
	public function listar(){
		$frequenciaDao = new FrequenciaDao();

		$dados = $frequenciaDao->listar();

		return $dados;

	}

	public function listarPorId($id){
		$frequenciaDao = new FrequenciaDao();

		$dados = $frequenciaDao->listarPorId($id);

		return $dados;

	}

	public function deletar($id){
		$frequenciaDao = new FrequenciaDao();

		$frequenciaDao->deletar($id);

	}


	public function checarFrequencia($idescola){
		$frequenciaDao = new FrequenciaDao();
		$dados = $frequenciaDao->listarPorEscola($idescola);
		
		if($dados != null){
			
			if($dados[0]["hrinicio"] != null){
				throw new \Exception("Frequência já realizada!", 1);
			}
			throw new \Exception("Frequência já registrada!", 1);
		}  
		
		return $dados;
	}

	public function novaFrequencia($idescola){
		$frequenciaDao = new FrequenciaDao();
		$dados = $frequenciaDao->novaFrequencia($idescola);
		
		return $dados;
	}
}

 ?>