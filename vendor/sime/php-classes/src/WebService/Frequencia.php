<?php 
namespace Sime\WebService;

use \Sime\Control;
use \Sime\Model\FrequenciaDao;	

class Frequencia extends Control{
	
	public function listarPorEscola($idescola){
		$frequenciaDao = new FrequenciaDao();
		$dados = $frequenciaDao->listarPorEscola($idescola);
		return $dados;
	}

	public function alterarFrequencia($idfrequencia ,$hrinicio, $hrtermino){
		$frequenciaDao = new FrequenciaDao();
		$frequenciaDao->alterarFrequencia($idfrequencia, $hrinicio, $hrtermino);
	}

}




 ?>