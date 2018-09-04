<?php 
namespace Sime\DB;

class Sql{
	

	private $conn;

	function __construct(){

		$conn = new PDO("mysql:host=localhost;dbname=db_sime", "root", "");
	
	}
	private function setParams($statment, $data = array()){
		foreach ($data as $key => $value) {
			$stmt->bondParam($key, $value);
		}
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


 ?>