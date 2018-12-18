<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class MatriculaDao{
	
	public function buscarPorEscola($idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM matricula m
		INNER JOIN escola e ON e.idescola = m.escola_idescola
        WHERE e.idescola = :idescola", array(
        	":idescola"=>$idescola
        ));
        return $results;
	}
}

 ?>