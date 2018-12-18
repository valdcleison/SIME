<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class FrequenciaDao{

	public function listarTodosPorEscola($idescola){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola
			WHERE e.idescola = :idescola", array(
				":idescola" => $idescola 
			));
		return $results;
	}

	public function listarTodosPorNovasEscola($idescola){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola
			WHERE e.idescola = :idescola
			ORDER by f.dtfrequencia DESC", array(
				":idescola" => $idescola 
			));
		return $results;
	}
	
	public function listar(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola");
		return $results;
	}

	public function listarPorId($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			WHERE idfrequencia = :idfrequencia", array(
				":idfrequencia"=>$id
			));
		return $results;
	}

	public function deletar($id){
		var_dump($id);
		$sql = new Sql();
		$sql->query("DELETE FROM frequenciaaluno WHERE frequencia_idfrequencia = :id", array(
			":id" =>$id
		));
		$sql->query("DELETE FROM frequencia WHERE idfrequencia = :id", array(
			":id" =>$id
		));
	}

	public function listarPorEscola($idescola){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola
			WHERE e.idescola = :idescola
			AND f.dtfrequencia = CURRENT_DATE", array(
				":idescola"=>$idescola
			));
		return $results;
	}

	public function alterarFrequencia($idfrequencia ,$hrinicio, $hrtermino){
		$sql = new Sql();
		$results = $sql->select("UPDATE frequencia
			SET hrinicio = :hrinicio,
			hrtermino = :hrtermino
			WHERE idfrequencia = :idfrequencia", array(
				":idfrequencia"=>$idfrequencia,
				":hrinicio"=> $hrinicio,
				":hrtermino"=> $hrtermino
			));
		return $results;
	}

	public function novaFrequencia($idescola){
		
		$sql = new Sql();
		$results = $sql->select("CALL sp_escola_novafrequencia(:idescola)", array(
			":idescola"=>$idescola
		));
		
		return $results[0];
	}
}

 ?>