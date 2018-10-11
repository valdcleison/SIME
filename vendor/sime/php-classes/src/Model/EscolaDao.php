<?php 
namespace Sime\Model;

use \Sime\DB\Sql;

class EscolaDao {


	public function saveEscola($escola){
		$sql = new Sql();
		
		

		$results = $sql->select("CALL sp_escola_create(:pnomeescola, :pcnpj, :pnomegestor, :pcpfgestor, :pemailgestor, :ptelefone, :pcelular, :pemail, :prua, :pnumero, :pbairro, :pcidade, :pestado, :pcep, :pplano, :pusuarioescola, :psenhaescola)", array(

			":pnomeescola"=> $escola->getnomeescola() ,
			":pcnpj"=> $escola->getcnpjescola() ,
			":pnomegestor"=> $escola->getnomegestor(), 
			":pcpfgestor"=> $escola->getcpfgestor(),
			":pemailgestor"=>$escola->getemailgestor(),
			":ptelefone"=> $escola->gettelefone(),
			":pcelular"=> $escola->getcelular(),
			":pemail"=> $escola->getemailescola(),
			":prua"=> $escola->getlogradouro(),
			":pnumero"=> $escola->getnumero(),			
			":pbairro"=> $escola->getbairro(),
			":pcidade"=> $escola->getcidade(),
			":pestado"=> $escola->getestado(),
			":pcep"=> $escola->getcep(),
			":pplano"=> (int)$escola->getplanos(),
			":pusuarioescola"=> $escola->getusuarioescola(),
			":psenhaescola"=> $escola->getsenhaescola()		
		));
		

		$escola->setData($results);
	
	}

	public function deleteEscola($escola){
		
		$sql = new Sql();

		$retorno = $sql->query("CALL sp_escola_delete(:idescola, :idusuario, :idendereco, :idcontato)",array(
			":idescola"=>(int)$escola->getidescola(),
			":idusuario"=>(int)$escola->getidusuario(),
			":idendereco"=>(int)$escola->getidendereco(),
			":idcontato"=>(int)$escola->getidcontato()

		));

		
		
	}

	public static function listAll(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM escola es
				INNER JOIN endereco en ON es.endereco_idendereco = en.idendereco
				INNER JOIN contato co ON es.contato_idcontato = co.idcontato
				INNER JOIN anoletivo anl ON es.anoletivo_idanoletivo = anl.idanoletivo
				INNER JOIN escola_usuario eu ON es.idescola = eu.escola_idescola
				INNER JOIN usuario u ON eu.usuario_idusuario = u.idusuario");
	}

	public function listById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM escola es
				INNER JOIN endereco en ON es.endereco_idendereco = en.idendereco
				INNER JOIN contato co ON es.contato_idcontato = co.idcontato
				INNER JOIN anoletivo anl ON es.anoletivo_idanoletivo = anl.idanoletivo
				INNER JOIN escola_usuario eu ON es.idescola = eu.escola_idescola
				INNER JOIN usuario u ON eu.usuario_idusuario = u.idusuario
				WHERE es.idescola = :idescola", 
				array(
					":idescola"=>$id
				));
		return $results[0];
	}

	public function changeStatus($escola, $newStatus){
		$sql = new Sql();
		

		$sql->query("CALL sp_escola_changestatus(:idusuario, :idescola, :status)", 
				array(
					":idusuario"=>$escola->getidusuario(),
					":idescola"=>$escola->getidescola(),
					":status"=>$newStatus			
				));
		
	}




}
?>