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
	function wsBuscarFrequenciaAlunoPorE($idescola){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON frea.frequencia_idfrequencia = fre.idfrequencia
		    INNER JOIN escola es ON fre.escola_idescola = es.idescola
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN responsavel r ON al.responsavel_idresponsavel = r.idresponsavel
		    INNER JOIN contato cr ON cr.idcontato = r.contato_idcontato
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    WHERE frea.idfrequenciaaluno = :idfrequencia", array(
		    	":idfrequencia"=>$idescola
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
		    WHERE fre.idfrequencia = :idfrequencia", array(
		    	":idfrequencia"=>$idfrequencia
		    ));
		
		return $results;
	}

	public function novaFrequenciaAluno($idmatricula, $idfrequencia){
		$sql = new Sql();
		$results = $sql->query("INSERT INTO frequenciaaluno (data, frequencia_idfrequencia, matricula_idmatricula) 
			VALUES (CURRENT_DATE, :idfrequencia, :idmatricula)", array(
				":idfrequencia"=>$idfrequencia,
				":idmatricula"=>$idmatricula
			));
		return $results;

	}

	public function listarHoje($idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON frea.frequencia_idfrequencia = fre.idfrequencia
		    INNER JOIN escola es ON fre.escola_idescola = es.idescola
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    WHERE frea.data = CURRENT_DATE
		    AND es.idescola = :idescola", array(
		    	":idescola"=>$idescola
		    ));
		if($results <= 0 ){
			throw new \Exception("Frequência não realizada Hoje!", 1);
			
		}
		return $results;
	}

	public function listarHojePorAluno($idmatricula){
	
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    WHERE ma.idmatricula = :idmatricula", array(
		    	":idmatricula"=>$idmatricula
		    ));
		
		

		if($results <= 0 ){
			throw new \Exception("Frequência não realizada Hoje!", 1);
			
		}
		return $results;
	}

	public function listarDataPorAluno($idmatricula, $data){
	
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
		    INNER JOIN matricula ma ON frea.matricula_idmatricula = ma.idmatricula
		    INNER JOIN aluno al ON ma.aluno_idaluno = al.idaluno
		    INNER JOIN pessoa pa ON al.pessoa_idpessoa = pa.idpessoa
		    WHERE ma.idmatricula = :idmatricula
		    AND frea.data = :data", array(
		    	":idmatricula"=>$idmatricula,
		    	":data"=>$data
		    ));
		
		

		if($results <= 0 ){
			throw new \Exception("Frequência não realizada Hoje!", 1);
			
		}
		return $results;
	}

	public function listarPorId($idescola, $idfrequencia, $idfrequenciaaluno){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequenciaaluno frea
			INNER JOIN frequencia fre ON fre.idfrequencia = frea.frequencia_idfrequencia
			INNER JOIN escola es ON es.idescola = fre.escola_idescola
		    WHERE es.idescola = :idescola 
		    AND fre.idfrequencia = :idfrequencia 
		    AND frea.idfrequenciaaluno = :idfrequenciaaluno
		    AND frea.hrentrada is null
		    AND frea.frequenciaocorrencia_idfrequenciaocorrencia is null", array(
		    	":idescola"=>$idescola,
		    	":idfrequencia"=>$idfrequencia,
		    	":idfrequenciaaluno"=>$idfrequenciaaluno
		    ));
		if($results <= 0 ){
			throw new \Exception("Frequência não encontrada!", 1);
			
		}
		return $results;
	}

	public function justificar($idfrequenciaaluno,$motivo, $anexo){
		$sql = new Sql();
		$sql->select("CALL sp_escola_frequencia_justificar(:idfrequenciaaluno, :motivo, :anexo)", array(
			":idfrequenciaaluno"=>$idfrequenciaaluno,
			":motivo"=>$motivo,
			":anexo"=>$anexo
		));
		
	}

}



 ?>