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
		":user"=>$user->getusuario(),
		":pass"=>$user->getpass()
	));
	
	$user->setData($results[0]);
}

public function updateAdmin($user){
	
	$sql = new Sql();

	
	$results = $sql->select("CALL sp_user_update(:piduser, :pnomepessoa, :pcpfpessoa, :pemailpessoa, :puser)", array(
		":piduser" => $user->getidusuario(),
		":pnomepessoa" => $user->getnomepessoa(),
		":pcpfpessoa" => $user->getcpfpessoa(),
		":pemailpessoa" => $user->getemailpessoa(),
		":puser" => $user->getusuario()
	));
	
	
	$user->setData($results[0]);
}

public function deleteAdmin($user){
	
	$sql = new Sql();

	
	$sql->query("CALL sp_user_delete(:iduser)", array(
		":iduser" => $user->getidusuario()
	));
	
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

	public function getUserByEmail($email){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM usuario u INNER JOIN pessoa p USING(idpessoa) WHERE u.emailpessoa = :email", array(
			":email"=>$email
		));

		if(count($result) <= 0){
			throw new \Exception("Não foi possivel recuperar a senha!");
		}
		return $result[0];
	}

	public function forgotPassword($user){
		
		$sql = new Sql();
		$results = $sql->select("CALL sp_userspasswordsrecoveries_create(:idusuario, :ipusuario)", array(
			":idusuario"=> $user['idusuario'],
			":ipusuario"=>$_SERVER["REMOTE_ADDR"]

		));

		if($results <= 0){
			throw new \Exception("Não foi possivel recuperar a senha!");
		}
		return $results[0];
	}

	public static function getRecovery($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM usuariorecuperarsenha urs 
				INNER JOIN usuario u ON urs.usuario_idusuario = u.idusuario
				INNER JOIN pessoa p ON u.idpessoa = p.idpessoa 
				WHERE idusuariorecuperarsenha = :id
				AND urs.dtrecuperacao IS NULL
				AND DATE_ADD(urs.dtregistro, INTERVAL 1 HOUR) >= NOW()", 
				array(
					":id"=>$id
				));

		if(count($results) <= 0){
			throw new \Exception("Não foi possivel recuperar a senha!");
		}
		return $results;

	}

	public static function setForgotUsed($id){
		$sql = new Sql();
		$sql->query("UPDATE usuariorecuperarsenha SET dtrecuperacao = NOW() WHERE idusuariorecuperarsenha = :id", 
			array(
				":id"=>$id

		));
	}

	public function changePassword($idUsuario, $senha){
		$sql = new Sql();
		$sql->query("UPDATE usuario SET senha = :senha WHERE idUsuario = :idUsuario", array(
			":senha"=>$senha,
			":idUsuario"=>$idUsuario
		));
	}
		

}





 ?>