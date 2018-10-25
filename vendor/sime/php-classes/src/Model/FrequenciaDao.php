<?php 
namespace Sime\Model;

use \Sime\DB\SQL;


class FrequenciaDao{
	
	public function listar(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM frequencia f
			INNER JOIN escola e ON f.escola_idescola = e.idescola");
		return $results;
	}
}

 ?>