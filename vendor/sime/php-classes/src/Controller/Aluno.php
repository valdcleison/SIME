<?php 

namespace Sime\Controller;

use \Sime\Control;
use \Sime\Model\AlunoDao;


class Aluno extends Control{
	
	public function listar($idescola){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listar($idescola);
		return $dados;
	}

	public function listarPorNumMatricula($numMatricula, $idescola){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listarPorNumMatricula($numMatricula, $idescola);
		return $dados;
	}

	public function salvarAluno($idescola){
		$alunoDao = new AlunoDao();
		
		$password = password_hash($this->getsenha(), PASSWORD_DEFAULT, [
			'cost'=>12
		]);
		$this->setsenha($password);

		$dados = $alunoDao->salvarAluno($this, $idescola);
	}

	public function atualizarAluno(){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->atualizarAluno($this);
	}

	public function deletarAluno(){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->deletarAluno($this);
	}

	public function listarPorAluno($idaluno){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listarPorAluno($idaluno);
		return $dados;
	}

	public function listarPorId($idaluno){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listarPorId($idaluno);
		return $dados;
	}

	public function atualizarSenhaAluno($novasenha){
		$alunoDao = new AlunoDao();

		$password = password_hash($novasenha, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

		$dados = $alunoDao->atualizarSenhaAluno($this, $password);
	}

	public function listarporusuario($idusuario){
		$alunoDao = new AlunoDao();
		$dados = $alunoDao->listarporusuario($idusuario);
		return $dados;
	}
	public function gerarCarteirinha($aluno, $nomeescola,$idescola){

		$numMatricula = $aluno->getnumeromatricula();
		
		$caminho = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"Admin" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR . 
			"carteirinha-frente.png";


		$caminhoFonte = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"fonts" . DIRECTORY_SEPARATOR . 
				"Arial" . DIRECTORY_SEPARATOR . 
				"Arial-Black.ttf";

		//Criando a frente da carteirinha
		$frente =  @imagecreatefrompng($caminho);
		$titleColor = @imagecolorallocate($frente, 0, 0, 0);

		@imagettftext($frente, 32, 0, 300, 335, $titleColor, $caminhoFonte,substr($aluno->getnomepessoa(), 0, 60));
		@imagettftext($frente, 32, 0, 386, 525, $titleColor, $caminhoFonte, substr($aluno->getnumeromatricula(), 0, 60));
		@imagettftext($frente, 32, 0, 710, 714, $titleColor, $caminhoFonte, substr($nomeescola, 0, 30));

		$caminhoEscola = "".$_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"img" . DIRECTORY_SEPARATOR . 
				"alunos-carteirinha" . DIRECTORY_SEPARATOR .$idescola;

		if(!is_dir($caminhoEscola)){
			mkdir($caminhoEscola);
		}
		


		$dist = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"img" . DIRECTORY_SEPARATOR . 
				"alunos-carteirinha" . DIRECTORY_SEPARATOR . 
				$idescola . DIRECTORY_SEPARATOR .
				$aluno->getnumeromatricula() . "-frente.png";
	
		@imagepng($frente, $dist,9);
		@imagedestroy($frente);
		//Gerando o QrCode
		$caminhoQr = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR
		."res".DIRECTORY_SEPARATOR
		."Admin".DIRECTORY_SEPARATOR
		."img".DIRECTORY_SEPARATOR
		."alunos-carteirinha".DIRECTORY_SEPARATOR.
		$idescola . DIRECTORY_SEPARATOR .
		$numMatricula.".png";

		\QRcode::png($numMatricula, $caminhoQr,QR_ECLEVEL_L , 20);

		//Criando o verso da carteirinha
		$caminhoVerso = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"Admin" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR . 
			"carteirinha-verso.png";

		$verso =  imagecreatefrompng($caminhoVerso);
		$qrcode =  imagecreatefrompng($caminhoQr);
		
		@imagecopymerge($verso,$qrcode,  560, 290,  0, 0, 600, 500, 100);
		
		$distVerso = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"img" . DIRECTORY_SEPARATOR . 
				"alunos-carteirinha" . DIRECTORY_SEPARATOR . 
				$idescola . DIRECTORY_SEPARATOR .
				$aluno->getnumeromatricula() . "-verso.png";

		@imagepng($verso, $distVerso, 9);
		@imagedestroy($verso);
	}

	public function baixarCarteirinha($aluno, $nomeescola,$idescola){

		//Caminho da frente da carteirinha

		$dist = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"img" . DIRECTORY_SEPARATOR . 
				"alunos-carteirinha" . DIRECTORY_SEPARATOR . 
				$idescola . DIRECTORY_SEPARATOR .
				$aluno->getnumeromatricula() . "-frente.png";
	


		//Caminho do verso da carteirinha

		$distVerso = $_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"Admin" . DIRECTORY_SEPARATOR .
				"img" . DIRECTORY_SEPARATOR . 
				"alunos-carteirinha" . DIRECTORY_SEPARATOR . 
				$idescola . DIRECTORY_SEPARATOR .
				$aluno->getnumeromatricula() . "-verso.png";


		
	}

	public function download (){
		set_time_limit(0);
		// Arqui você faz as validações e/ou pega os dados do banco de dados
		$aquivoNome = 'imagem.jpg'; // nome do arquivo que será enviado p/ download
		$arquivoLocal = '/pasta/do/arquivo/'.$aquivoNome; // caminho absoluto do arquivo
		// Verifica se o arquivo não existe
		if (!file_exists($arquivoLocal)) {
		// Exiba uma mensagem de erro caso ele não exista
		exit;
		}
		// Aqui você pode aumentar o contador de downloads
		// Definimos o novo nome do arquivo
		$novoNome = 'imagem_nova.jpg';
		// Configuramos os headers que serão enviados para o browser
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="'.$novoNome.'"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($aquivoNome));
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		// Envia o arquivo para o cliente
		readfile($aquivoNome);
	}
	
}


 ?>