<?php 
namespace Sime\DB;

class Sql{
	

	private $conn;

	function __construct(){

		$this->conn = new \PDO("mysql:host=localhost;dbname=db_sime", "root", "");
	
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

	public function select($rawQuery, $params = array()):array{
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}


 ?>