<?php 
namespace Sime\Controller;

use \Sime\Model\FrequenciaAlunoDao;
use \Sime\Controller\Matricula;
use \Sime\Control;

class FrequenciaAluno extends Control{
	
	function listarTodosPorEscola($idfrequencia){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->BuscarPorFrequencia($idfrequencia);
		return $dados;
	}


	public function AlterarPorId($idfrequenciaaluno, $hrentrada){
		
		$frequenciaAluno = new FrequenciaAlunoDao();
		$frequenciaAluno->wsAlterarPorId($idfrequenciaaluno, $hrentrada);
	}

	public function buscarFrequenciaAlunoPorEscola($idescola){
		
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->wsBuscarFrequenciaAlunoPorEscola($idescola);
		return $dados;
	}

	public function novaFrequenciaAluno($idfrequencia, $idescola){
		$matricula = new Matricula();
		$dados = $matricula->listarTodosPorEscola($idescola);
		
		
		foreach ($dados as $key => $value) {
			
			$frequenciaAlunoDao = new FrequenciaAlunoDao();
			$frequenciaAlunoDao->novaFrequenciaAluno($value["idmatricula"], $idfrequencia);
			
		}
		
		
		return $dados;
	}

	function listarHoje($idescola){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->listarHoje($idescola);
		return $dados;
	}

	public function listarHojePorAluno($idmatricula){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->listarHojePorAluno($idmatricula);
		return $dados;
	}

	public function listarDataPorAluno($idmatricula, $data){
		$frequenciaAluno = new FrequenciaAlunoDao();
		$dados = $frequenciaAluno->listarDataPorAluno($idmatricula, $data);
		return $dados;
	}

	function listarPorId($idescola, $idfrequencia, $idfrequenciaaluno){
		$frequenciaalunodao = new FrequenciaAlunoDao();
		$dados = $frequenciaalunodao->listarPorId($idescola, $idfrequencia, $idfrequenciaaluno);
		return $dados;
	}

	function justificar($motivo, $anexo, $idfrequenciaaluno){
		$frequenciaalunodao = new FrequenciaAlunoDao();
		$frequenciaalunodao->justificar($idfrequenciaaluno, $motivo,$anexo);
	}

	function salvarAnexo($file, $idfrequenciaaluno){
		$caminhoAnexo = "".$_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"files" . DIRECTORY_SEPARATOR . 
				"justify" . DIRECTORY_SEPARATOR .
				$idfrequenciaaluno;

		if(!is_dir($caminhoAnexo)){
			mkdir($caminhoAnexo);
		}


		$extensao = explode(".", $file['name']);
		$extensao = end($extensao);
		
		switch ($extensao) {
			case "jpg":
			case "jpeg":
			case "JPG":
			case "JPEG":
				$image = imagecreatefromjpeg($file["tmp_name"]);
			break;
				
			case "gif":
			case "GIF":
				$image = imagecreatefromgif($file["tmp_name"]);
			break;
			case "png":
			case "PNG":
				$image = imagecreatefrompng($file["tmp_name"]);
			break;
			default:
				throw new \Exception("Por favor envie uma imagem");
			break;
		}
		

		$dist = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"Admin" . DIRECTORY_SEPARATOR .
			"files" . DIRECTORY_SEPARATOR . 
			"justify" . DIRECTORY_SEPARATOR . 
			$idfrequenciaaluno . DIRECTORY_SEPARATOR . 
			$idfrequenciaaluno . ".jpg";

		imagejpeg($image, $dist);
		imagedestroy($image);
	}
}



 ?>