<?php 
namespace Sime\Controller;

use \Sime\Model\FrequenciaAlunoDao;
use \Sime\Control;

class FrequenciaAluno extends Control{
	
	function listarTodosPorEscola($idfrequencia){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->BuscarPorFrequencia($idfrequencia);
		return $dados;
	}


	public function AlterarPorId($idfrequenciaaluno, $hrentrada){
		
		$frequenciaAluno = new FrequenciaAlunoDao();
		$frequenciaAluno->wsAlterarPorId($idfrequenciaaluno, $hrentrada);
	}

	public function buscarFrequenciaAlunoPorEscola($idescola){
		
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->wsBuscarFrequenciaAlunoPorEscola($idescola);
		return $dados;
	}
}



 ?>