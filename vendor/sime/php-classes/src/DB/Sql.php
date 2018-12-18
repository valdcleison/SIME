<?php 

namespace Sime\DB;

use \Sime\Controller\Usuario;

header("Content-Type: text/html;  charset=ISO-8859-1",true);

class Sql {

	const HOSTNAME = "br876.hostgator.com.br";
	const USERNAME = "simeesco";
	const PASSWORD = "sime12345";
	const DBNAME = "simeesco_db_sime";
	/*
	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "db_sime";*/

	private $conn;

	public function __construct()
	{
		try {
			$this->conn = new \PDO(
				"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
				Sql::USERNAME,
				Sql::PASSWORD
			);
		} catch (\Exception $e) {
			Usuario::setError("Não foi possivel concluir a solicitação, por favor tente mais tarde");
			echo "alert('Não foi possivel concluir a solicitação, por favor tente mais tarde')";
			header("Location: /");
		}
		

	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		return $stmt->execute();

	}

	public function select($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>