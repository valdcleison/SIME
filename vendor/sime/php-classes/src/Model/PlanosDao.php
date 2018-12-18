<?php 

namespace Sime\Model;

use \Sime\DB\Sql;

class PlanosDao {

	public function savePlanos($plano){
		$sql = new Sql();
		$sql->query("INSERT INTO planos(descricao, preco, descricao_plano) VALUES (:descricao, :preco, :descricao_plano)", array( 
			":descricao"=>$plano->getdescricao(),
			":preco"=>$plano->getpreco(),
			":descricao_plano"=>$plano->getdescricaoplano()
		));
	}

	public static function buscarPlanos(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM planos");
	}

	public static function listById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM planos WHERE idplano = :id", array( 
			":id"=>$id
		));

		return $result[0];
	}

	public function updatePlanos($planos){
		$sql = new Sql();
		$result = $sql->select("UPDATE planos SET descricao = :descricao, preco = :preco, descricao_plano = :descricao_plano WHERE idplano = :id", array( 
			":id"=>$planos->getidplano(),
			":descricao"=>$planos->getdescricao(),
			":preco"=>$planos->getpreco(),
			"descricao_plano"=>$planos->getdescricaoplano()
		));
	}

	public function deletePlanos($plano){
		$sql = new Sql();
		$sql->query("DELETE FROM planos WHERE idplano = :idplano", array( 
			":idplano"=>$plano->getidplano()
		));
	}
}

 ?>