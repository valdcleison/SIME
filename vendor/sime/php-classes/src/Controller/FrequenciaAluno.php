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
}



 ?>