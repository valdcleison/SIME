<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class FrequenciaDao{
	
	public function listar(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola");
		return $results;
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
}

 ?>