<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class FrequenciaAlunoDao{
	
	function wsBuscarFrequenciaAlunoPorEscola($idescola){
		
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

	public function wsAlterarPorId($idfrequenciaaluno, $hrentrada){
		
		$sql = new Sql();
		$sql->query("UPDATE frequenciaaluno SET hrentrada = :hrentrada WHERE idfrequenciaaluno = :idfrequenciaaluno", array(
			":hrentrada"=>$hrentrada,
			":idfrequenciaaluno"=>$idfrequenciaaluno
		));
	}

	public function BuscarPorFrequencia($idfrequencia){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON frea.frequencia_idfrequencia = fre.idfrequencia
		    INNER JOIN escola es ON fre.escola_idescola = es.idescola
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN responsavel r ON al.responsavel_idresponsavel = r.idresponsavel
		    INNER JOIN contato cr ON cr.idcontato = r.contato_idcontato
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    AND fre.idfrequencia = :idfrequencia", array(
		    	":idfrequencia"=>$idfrequencia
		    ));
		
		return $results;
	}


}



 ?>