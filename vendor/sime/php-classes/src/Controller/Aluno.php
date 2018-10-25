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
}


 ?>