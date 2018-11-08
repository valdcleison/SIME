<?php 
namespace Sime\Model;

use \Sime\DB\Sql;


class AlunoDao{

	public function listar($idescola){
		$sql = new Sql();
		$results = $sql->select("SELECT a.*, m.*, e.*, p.*, r.*, en.*, rp.nomepessoa as nomeresponsavel FROM aluno a
			INNER JOIN matricula m ON a.idaluno = m.aluno_idaluno
		    INNER JOIN escola e ON m.escola_idescola = e.idescola
		    INNER JOIN pessoa p ON a.pessoa_idpessoa = p.idpessoa
		    INNER JOIN responsavel r ON r.idresponsavel = a.responsavel_idresponsavel
		    INNER JOIN endereco en ON en.idendereco = r.endereco_idendereco
		    INNER JOIN pessoa rp ON rp.idpessoa = r.pessoa_idpessoa
		    WHERE e.idescola = :idescola", array(
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
		$results = $sql->select("CALL sp_alunos_create(:nomealuno, :cpfaluno, :numeromatricula, :nomeresponsavel, :cpfresponsavel, :rua, :bairro, :numero, :cidade, :estado, :cep, :telefone,:celular, :emailresponsavel, :idescola)", array(
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
			":idescola" => $idescola



		));	
		

	}
}
?>