<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class UsuarioDao {



public function save(){

	$sql = new Sql();

	$results = $sql->select("CALL sp_user_save(:user, :pass :nivelAdmin)", array(
		":user"=>$user->getidproduct(),
		":pass"=>$user->getdesproduct(),
		":nivelAdmin"=>$user->getvlprice()
	));

	return $results;
}

public function login($user, $pass){
	$sql = new Sql();

	$results = $sql->select("SELECT * FROM usuario WHERE usuario = :user", array(
		":user"=>$user
	));

	if(count($results) === 0){
		throw new \Exception("Usuario Inexistente ou Senha Invalida!");
		
	}
	$data = $results[0];


	if(password_verify($pass, $data['senha']) === true){
		
		return $data;

	}else{


		throw new \Exception("Usuario Inexistente ou Senha Invalida!");

	}
}
	public static function listAll(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = 2 ORDER BY b.nomepessoa");
	}
		

}





 ?>