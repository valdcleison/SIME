<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class UsuarioDao {



public function saveAdmin($user){

	$sql = new Sql();
	
	$results = $sql->select("CALL sp_users_create(:pnomepessoa, :pcpfpessoa, :pemailpessoa, :user, :pass)", array(
		":pnomepessoa"=>$user->getnomepessoa(),
		":pcpfpessoa"=>$user->getcpfpessoa(),
		":pemailpessoa"=>$user->getemailpessoa(),
		":user"=>$user->getuser(),
		":pass"=>$user->getpass()
	));

	return $results[0];
}

public function updateAdmin($user){
	$sql = new Sql();
	
	$results = $sql->select("CALL sp_user_update(:piduser, :pnomepessoa, :pcpfpessoa, :pemailpessoa, :puser)", array(
		":piduser"=>$user->getidusuario(),
		":pnomepessoa"=>$user->nomepessoa(),
		":pcpfpessoa"=>$user->getcpfpessoa(),
		":pemailpessoa"=>$user->getemailpessoa(),
		":puser"=>$user->getusuario(),
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

		return $sql->select("SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = 2 ORDER BY a.idusuario");
	}

	public function getAdmin($id){
		$sql = new Sql();

		$resuts = $sql->select("SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.idusuario = :iduser", array(
			":iduser"=>$id
		));
		
		return $resuts[0];
	}


		

}





 ?>