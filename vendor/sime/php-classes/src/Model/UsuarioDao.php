<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class UsuarioDao {

	public function checkUsuario($id){
		$sql = new Sql();

			$results =  $sql->select("SELECT * FROM escola es
					INNER JOIN endereco en ON es.endereco_idendereco = en.idendereco
					INNER JOIN contato co ON es.contato_idcontato = co.idcontato
					INNER JOIN anoletivo anl ON es.anoletivo_idanoletivo = anl.idanoletivo
					INNER JOIN escola_usuario eu ON es.idescola = eu.escola_idescola
					INNER JOIN usuario u ON eu.usuario_idusuario = u.idusuario
					WHERE u.idusuario = :id", array(
				":id"=>(int)$id

			));
			
			return $results;
	}

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

	public function saveUserEscola($user, $avatar){
		$sql = new Sql();
		
		$results = $sql->select("CALL sp_escola_user_create(:pnomepessoa, :pcpfpessoa, :pemailpessoa, :user, :pass, :avatar, :inadmin, :idescola)", array(
			":pnomepessoa"=>$user->getnomepessoa(),
			":pcpfpessoa"=>$user->getcpfpessoa(),
			":pemailpessoa"=>$user->getemailpessoa(),
			":user"=>$user->getusuario(),
			":pass"=>$user->getpass(),
			":avatar"=>$avatar,
			":inadmin"=>$user->getinadmin(),
			":idescola"=>$user->getidescola()
		));
		
		$user->setData($results[0]);
	}

	public function listUserByEscola($idescola, $idusuario){
		$sql = new Sql();
		
		$resuts = $sql->select("SELECT * FROM usuario u 
				INNER JOIN escola_usuario eu ON eu.usuario_idusuario = u.idusuario
				INNER JOIN pessoa p ON u.idpessoa = p.idpessoa
				WHERE eu.escola_idescola = :id
				AND u.idusuario = :idusuario", array(
				":id"=>$idescola,
				":idusuario"=>$idusuario
		));

		return $resuts;
	}

	public function editUserEscola($user, $avatar){
		$sql = new Sql();
		
		$results = $sql->select("CALL sp_escola_user_update(:pnomepessoa, :avatar, :inadmin, :idusuario, :idpessoa, :idescola_usuario)", array(
			":pnomepessoa"=>$user->getnomepessoa(),
			":avatar"=>$avatar,
			":inadmin"=>$user->getinadmin(),
			":idusuario"=>$user->getidusuario(),
			":idpessoa"=>$user->getidpessoa(),
			":idescola_usuario"=>$user->getidescola_usuario()
		));
		
		
	}

	public function deleteUserEscola($user){
	
		$sql = new Sql();
		
		$results = $sql->select("CALL sp_escola_user_delete(:idusuario, :idpessoa, :idescola_usuario)", array(
			
			":idusuario"=>$user->getidusuario(),
			":idpessoa"=>$user->getidpessoa(),
			":idescola_usuario"=>$user->getidescola_usuario()
		));
		
		
	}

	public function updateAdmin($user){
		
		$sql = new Sql();

		
		$results = $sql->select("CALL sp_user_update(:piduser, :pnomepessoa)", array(
			":piduser" => $user->getidusuario(),
			":pnomepessoa" => $user->getnomepessoa(),
		));
		
		
		$user->setData($results[0]);
	}

	public function changeStatus($user, $newStatus){
		$sql = new Sql();
		

		$sql->query("UPDATE usuario SET statususuario = :status WHERE idusuario = :idusuario", array(
			":status" => $newStatus,
			":idusuario" => $user->getidusuario()
		));



	}

	public function deleteAdmin($user){
		
		$sql = new Sql();
		
		
		$sql->query("CALL sp_user_delete(:iduser, :idpessoa)", array(
			":iduser" =>$user->getidusuario(),
			":idpessoa"=>$user->getidpessoa()
		));
		
	}

	public function login($user, $pass){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario u  INNER JOIN pessoa p USING (idpessoa) WHERE u.usuario = :user", array(
			":user"=>$user
		));

		if(count($results) === 0){
			throw new \Exception("Usuário ou senha inválidos");
			
		}
		$data = $results[0];

		
		if(password_verify($pass, $data['senha'])){
			
			
			if((int)$data['niveladmin'] === 1){
				$results2 = $sql->select("SELECT * FROM usuario u  
					INNER JOIN pessoa p USING (idpessoa) 
					INNER JOIN escola_usuario eu ON eu.usuario_idusuario = u.idusuario WHERE u.usuario = :user", array(
					":user"=>$user
				));

				return $results2[0];

				
			}
			return $data;

		}else{

			throw new \Exception("Usuário ou senha inválidos");

		}
	}
	public function listByEscola($id){
		$sql = new Sql();
		
		$resuts = $sql->select("SELECT * FROM usuario u 
				INNER JOIN escola_usuario eu ON eu.usuario_idusuario = u.idusuario
				INNER JOIN pessoa p ON u.idpessoa = p.idpessoa
				WHERE eu.escola_idescola = :id", array(
			":id"=>$id
		));

		return $resuts;
	}
	public static function listAll($nivel){
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = :nivel ORDER BY a.idusuario", array(
			":nivel"=>$nivel
		));
	}

	public function getAdmin($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.idusuario = :iduser", array(
			":iduser"=>$id
		));

		

		if(count($results) < 1){
			throw new \Exception("Usuário não encontrado!");
			
		}
		
		return $results[0];
	}



	public function getUserByEmail($email){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM usuario u INNER JOIN pessoa p USING(idpessoa) WHERE u.emailpessoa = :email", array(
			":email"=>$email
		));

		if(count($result) <= 0){
			return null;
		}
		return $result[0];
	}

	public function getUserByCpf($cpf){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM usuario u INNER JOIN pessoa p USING(idpessoa) WHERE p.cpfpessoa = :cpf", array(
			":cpf"=>$cpf
		));

		if(count($result) <= 0){
			return null;
		}
		return $result[0];
	}

	public function getUserByUser($user){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM usuario WHERE usuario = :usuario", array(
			":usuario"=>$user
		));

		if(count($result) <= 0){
			return null;
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
		return $results[0];

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
		$sql->query("UPDATE usuario SET senha = :senha WHERE idusuario = :idUsuario", array(
			":senha"=>$pass,
			":idUsuario"=>$idUsuario
		));
	}
		

}





 ?>