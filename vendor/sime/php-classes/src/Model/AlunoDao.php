<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class AlunoDao{

	public function listar($idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM aluno a
			INNER JOIN escola_aluno ea ON ea.aluno_idaluno = a.idaluno
		    INNER JOIN escola e ON ea.escola_idescola = e.idescola
		    INNER JOIN pessoa p ON a.pessoa_idpessoa = p.idpessoa
		    INNER JOIN usuario u ON a.usuario_idusuario = u.idusuario
		    WHERE e.idescola = :idescola", array(
		    	":idescola"=>$idescola
		    ));
		return $results;
	}



}
?>