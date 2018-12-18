<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class AlunoDao{

	public function listarPorAluno($idaluno){
		$sql = new Sql();
		$results = $sql->select("SELECT a.*, c.*, m.*, p.*, r.*, en.*, rp.idpessoa as idresponsavelpessoa, rp.nomepessoa as nomeresponsavel, rp.cpfpessoa as cpfresponsavel FROM aluno a
			INNER JOIN matricula m ON a.idaluno = m.aluno_idaluno
		    INNER JOIN pessoa p ON a.pessoa_idpessoa = p.idpessoa
		    INNER JOIN responsavel r ON r.idresponsavel = a.responsavel_idresponsavel
		    INNER JOIN endereco en ON en.idendereco = r.endereco_idendereco
		    INNER JOIN contato c ON c.idcontato = r.contato_idcontato
		    INNER JOIN pessoa rp ON rp.idpessoa = r.pessoa_idpessoa
		    WHERE a.idaluno = :idaluno", array(
		    	":idaluno"=>$idaluno
		    ));
		return $results;
	}

	public function listarPorId($idaluno){
		$sql = new Sql();
		$results = $sql->select("SELECT a.*, c.*, m.*, p.*, r.*, u.*, en.*, rp.idpessoa as idresponsavelpessoa, rp.nomepessoa as nomeresponsavel, rp.cpfpessoa as cpfresponsavel FROM aluno a
			INNER JOIN matricula m ON a.idaluno = m.aluno_idaluno
		    INNER JOIN pessoa p ON a.pessoa_idpessoa = p.idpessoa
		    INNER JOIN responsavel r ON r.idresponsavel = a.responsavel_idresponsavel
		    INNER JOIN endereco en ON en.idendereco = r.endereco_idendereco
		    INNER JOIN contato c ON c.idcontato = r.contato_idcontato
		    INNER JOIN pessoa rp ON rp.idpessoa = r.pessoa_idpessoa
		    INNER JOIN usuario u ON u.idpessoa = a.pessoa_idpessoa
		    WHERE a.idaluno = :idaluno", array(
		    	":idaluno"=>$idaluno
		    ));
		return $results;
	}

	public function listar($idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT a.*, m.*, e.*, p.*, r.*, u.*, en.*, rp.nomepessoa as nomeresponsavel FROM aluno a
			INNER JOIN matricula m ON a.idaluno = m.aluno_idaluno
		    INNER JOIN escola e ON m.escola_idescola = e.idescola
		    INNER JOIN pessoa p ON a.pessoa_idpessoa = p.idpessoa
		    INNER JOIN responsavel r ON r.idresponsavel = a.responsavel_idresponsavel
		    INNER JOIN endereco en ON en.idendereco = r.endereco_idendereco
		    INNER JOIN pessoa rp ON rp.idpessoa = r.pessoa_idpessoa
		    INNER JOIN usuario u ON u.idpessoa = a.pessoa_idpessoa
		    WHERE e.idescola = :idescola
		    ORDER BY a.idaluno", array(
		    	":idescola"=>$idescola
		    ));
		return $results;
	}

	public function listarPorNumMatricula($numMatricula, $idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM aluno a
			INNER JOIN matricula m ON m.aluno_idaluno = a.idaluno
		    INNER JOIN escola e ON m.escola_idescola = e.idescola
		    WHERE e.idescola = :idescola
		    AND m.numeromatricula = :nummatricula", array(
		    	":idescola"=>$idescola,
		    	"nummatricula"=>$numMatricula
		    ));
		return $results;
	}

	public function salvarAluno($aluno, $idescola){

		
		$sql = new Sql();
		$results = $sql->select("CALL sp_alunos_create(:nomealuno, :cpfaluno, :numeromatricula, :nomeresponsavel, :cpfresponsavel, :rua, :bairro, :numero, :cidade, :estado, :cep, :telefone,:celular, :emailresponsavel, :usuario, :senha, :idescola)", array(
			":nomealuno" =>$aluno->getnomealuno() , 
			":cpfaluno" =>$aluno->getcpfaluno() , 
			":numeromatricula" =>$aluno->getnumeromatricula() , 
			":nomeresponsavel" =>$aluno->getnomeresponsavel() , 
			":cpfresponsavel" =>$aluno->getcpfresponsavel() , 
			":rua" =>$aluno->getrua() , 
			":bairro" =>$aluno->getbairro() , 
			":numero" =>$aluno->getnumero() , 
			":cidade" =>$aluno->getcidade() , 
			":estado" =>$aluno->getestado() , 
			":cep" =>$aluno->getcep() , 
			":telefone" =>$aluno->gettelefone() ,
			":celular" =>$aluno->getcelular() , 
			":emailresponsavel" =>$aluno->getemailresponsavel() , 
			":usuario"=> $aluno->getusuario(),
			":senha"=> $aluno->getsenha(),
			":idescola" => $idescola
		));	
		

	}

	public function atualizarAluno($aluno){

		$sql = new Sql();
		$results = $sql->select("CALL sp_alunos_update(:nomealuno, :cpfaluno, :nomeresponsavel, :rua, :bairro, :numero, :cidade, :estado, :cep, :telefone,:celular, :emailresponsavel, :idpessoa, :idcontato, :idendereco, :idpessoaresposavel)", array(
			":nomealuno" =>$aluno->getnomealuno() , 
			":cpfaluno" =>$aluno->getcpfaluno() , 
			":nomeresponsavel" =>$aluno->getnomeresponsavel() , 
			":rua" =>$aluno->getrua() , 
			":bairro" =>$aluno->getbairro() , 
			":numero" =>$aluno->getnumero() , 
			":cidade" =>$aluno->getcidade() , 
			":estado" =>$aluno->getestado() , 
			":cep" =>$aluno->getcep() , 
			":telefone" =>$aluno->gettelefone() ,
			":celular" =>$aluno->getcelular() , 
			":emailresponsavel" =>$aluno->getemailresponsavel() , 
			":idpessoa"=>$aluno->getidpessoa(),
			":idcontato" => $aluno->getidcontato(),
			":idendereco"=> $aluno->getidendereco(),
			":idpessoaresposavel"=>$aluno->getidresponsavelpessoa()
		));	
		
	}

	public function atualizarSenhaAluno($aluno, $novasenha){
		$sql = new Sql();
		$results = $sql->query("UPDATE usuario SET senha = :senha WHERE idusuario = :id", array(
			":senha" => $novasenha,
			":id" => $aluno->getidusuario()
		));	
	}

	public function deletarAluno($aluno){
		
		$sql = new Sql();
		$results = $sql->select("CALL sp_alunos_delete(:idaluno, :idpessoa, :idcontato, :idendereco, :idpessoaresposavel, :idmatricula, :idresponsavel)", array(
			":idaluno"=>$aluno->getidaluno(),
			":idpessoa"=>$aluno->cgetidpessoa(),
			":idcontato" => $aluno->getidcontato(),
			":idendereco"=> $aluno->getidendereco(),
			":idpessoaresposavel"=>$aluno->getidresponsavelpessoa(),
			":idmatricula"=>$aluno->getidmatricula(),
			":idresponsavel"=>$aluno->getidresponsavel()
		));	
		
	}

	public function listarporusuario($idusuario){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM aluno a
			INNER JOIN matricula m ON m.aluno_idaluno = a.idaluno
		    INNER JOIN escola e ON m.escola_idescola = e.idescola
		    INNER JOIN usuario u ON u.idpessoa = a.pessoa_idpessoa
		    WHERE u.idusuario = :idusuario", array(
		    	":idusuario"=>$idusuario
		    ));
		return $results;
	}


}
?>