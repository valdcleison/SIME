<?php 
namespace Sime\DB;

class Sql{
	

	private $conn;

	function __construct(){

		$this->conn = new \PDO("mysql:host=br876.hostgator.com.br;dbname=simeesco_db_sime", "simeesco_admin", "sime250499");
		/*$this->conn = new \PDO(
         "mysql:db_name=simeesco_db_sime;host=br876.hostgator.com.br", 
         "simeesco_admin",
         "sime250499",
         array(
            \PDO::ATTR_EMULATE_PREPARES=>false,
            \PDO::MYSQL_ATTR_DIRECT_QUERY=>false,
            \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
        )
     );*/
	
	}
	private function setParams($statment, $data = array()){
		foreach ($data as $key => $value) {
			$statment->bindParam($key, $value);
		}
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}


 ?>