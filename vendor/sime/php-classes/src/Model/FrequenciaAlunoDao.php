<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class FrequenciaAlunoDao{
	
	function wsBuscarFrequenciaAluno($idescola){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON frea.frequencia_idfrequencia = fre.idfrequencia
		    INNER JOIN escola es ON fre.escola_idescola = es.idescola
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    WHERE fre.dtfrequencia = CURRENT_DATE
		    AND es.idescola = :idescola", array(
		    	":idescola"=>$idescola
		    ));
		
		return $results;
	}

	public function BuscarPorFrequencia($idfrequencia){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON frea.frequencia_idfrequencia = fre.idfrequencia
		    INNER JOIN escola es ON fre.escola_idescola = es.idescola
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    AND fre.idfrequencia = :idfrequencia", array(
		    	":idfrequencia"=>$idfrequencia
		    ));
		
		return $results;
	}
}



 ?>