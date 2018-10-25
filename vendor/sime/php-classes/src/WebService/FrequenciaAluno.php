<?php 
namespace Sime\WebService;

use \Sime\Control;
use \Sime\Model\FrequenciaAlunoDao;	

class FrequenciaAluno extends Control{
	
	function wsBuscarFrequenciaAluno($idescola){
		$frequenciaAlunoDao = new FrequenciaAlunoDao();
		$dados = $frequenciaAlunoDao->wsBuscarFrequenciaAluno($idescola);
		
		return $dados;
	}
}




 ?>