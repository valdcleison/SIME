<?php 
namespace Sime\WebService;

use \Sime\Control;
use \Sime\Model\FrequenciaAlunoDao;	

class FrequenciaAluno extends Control{
	
	function buscarFrequenciaAlunoPorEscola($idescola){
		$frequenciaAlunoDao = new FrequenciaAlunoDao();
		$dados = $frequenciaAlunoDao->wsBuscarFrequenciaAlunoPorEscola($idescola);
		
		return $dados;
	}

	public function AlterarPorId($idfrequenciaaluno, $hrentrada){
		
		$frequenciaAluno = new FrequenciaAlunoDao();
		$frequenciaAluno->wsAlterarPorId($idfrequenciaaluno, $hrentrada);
	}

	public function buscarFrequenciaAlunoPorId($idfrequenciaaluno){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->BuscarPorFrequencia($idfrequenciaaluno);
		return $dados;
	}
}
?>