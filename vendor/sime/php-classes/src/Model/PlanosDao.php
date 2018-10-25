<?php 

namespace Sime\Model;

use \Sime\DB\Sql;

class PlanosDao {

	public function savePlanos($plano){
		$sql = new Sql();
		$sql->query("INSERT INTO planos(descricao, preco) VALUES (:descricao, :preco)", array( 
			":descricao"=>$plano->getdescricao(),
			":preco"=>$plano->getpreco()
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
		$result = $sql->select("UPDATE planos SET descricao = :descricao, preco = :preco WHERE idplano = :id", array( 
			":id"=>$planos->getidplano(),
			":descricao"=>$planos->getdescricao(),
			":preco"=>$planos->getpreco()
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