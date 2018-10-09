<?php 

namespace Sime\Model;

use \Sime\DB\Sql;

class PlanosDao {


	public static function buscarPlanos(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM planos");
	}
}

 ?>