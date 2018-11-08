<?php 

namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\AlunoDao;


class Aluno extends Control{
	
	public function listar($idescola){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listar($idescola);
		return $dados;
	}

	public function listarPorNumMatricula($numMatricula, $idescola){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listarPorNumMatricula($numMatricula, $idescola);
		return $dados;
	}

	public function salvarAluno($idescola){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->salvarAluno($this, $idescola);
	}
	
}


 ?>