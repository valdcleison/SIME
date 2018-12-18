<?php

use \Sime\Controller\Escola;
use \Sime\Controller\Usuario;
use \Sime\Controller\Frequencia;
use \Sime\Controller\FrequenciaAluno;
use \Sime\Controller\Aluno;
use \Sime\Page;

$app->get("/portal/aluno/", function(){
	Usuario::verifyLogin(0);
	try {
		$aluno = new Aluno();
		$dados = $aluno->listarporusuario($_SESSION['User']['idusuario']);


		$FrequenciaAluno = new FrequenciaAluno();
		$dadosFrequencia = $FrequenciaAluno->listarHojePorAluno($dados[0]["idmatricula"]);

			
	} catch (\Exception $e) {
		Escola::setError($e->getmessage());
		header("Location: /portal/aluno/");
		exit;
	}

	$ausente = count($dadosFrequencia);
	$presente = 0;
	$justificada = 0;

	foreach ($dadosFrequencia as $key => $value) {
		if($value['hrentrada'] != null){

			$ausente = $ausente - 1;
			$presente = $presente + 1;

		}else{
			if($value['frequenciaocorrencia_idfrequenciaocorrencia'] !== null){
				$ausente = $ausente - 1;
				$justificada = $justificada + 1;
			}
		}

	}

	

	$page = new Page("/views/Aluno/",[
		"header"=>true,
		"footer"=>true,
		"data"=>array(
			"name"=> $_SESSION['User']['nomepessoa'],
			"avatar"=> $_SESSION['User']['avatar']
		)
	]);


	$page->setTpl("index", array(
		"frequencia"=>$dadosFrequencia,
		"ausente"=>$ausente,
		"presente"=>$presente,
		"justificada"=> $justificada,
		"error"=>Escola::getError(),
		"succes"=>Escola::getSuccess()
	));
});

$app->post("/portal/aluno/search/all/", function(){
	Usuario::verifyLogin(0);

	$aluno = new Aluno();
	$dados = $aluno->listarporusuario($_SESSION['User']['idusuario']);


	$FrequenciaAluno = new FrequenciaAluno();
	$dadosFrequencia = $FrequenciaAluno->listarHojePorAluno($dados[0]["idmatricula"]);

	if($dadosFrequencia == null){
		echo "<tr>";
		echo "<td colspan='5'> <b> Sem Resultados Total </b>";
        echo "</td>";
		echo "</tr>";
	}else{

		foreach ($dadosFrequencia as $key => $value) {
			echo "<tr>";
			echo "<td data-title='Aluno'>".$value['nomepessoa']."</td>";
			
			$cpf = $value['cpfpessoa'];
	        if($cpf === null){
	          echo "<td data-title='CPF'>Aluno sem CPF</td>";
	        }else{
	          echo "<td data-title='CPF'>".mascara($cpf)."</td>";
	        }

	        echo "<td data-title='Data'>".date('Y-m-d', strtotime($value['data']))."</td>";

	        if($value['hrentrada'] === null){
	          echo "<td data-title='Hora Entrada'>Sem entrada registrada</td>";
	        }else{

	          echo "<td data-title='Hora Entrada'>".date('h:m:s', strtotime($value['hrentrada']))."</td>";
	        }

	        echo "<td data-title='Status'>";
	            if($value['hrentrada'] === null){
	                if($value['frequenciaocorrencia_idfrequenciaocorrencia'] === null){
	                  echo "Falta não justificada";
	                }else{
	                  echo "Falta justificada";
	                }
	            }else{
	                echo "Presente";
	            }

	        echo "</td>";
			echo "</tr>";
		}
	}

});

$app->post("/portal/aluno/search/", function(){

	$valor = $_POST["palavra"];
	

	$data = date('Y-m-d', strtotime($valor));

	try {
		$aluno = new Aluno();
		$dados = $aluno->listarporusuario($_SESSION['User']['idusuario']);


		$FrequenciaAluno = new FrequenciaAluno();
		if($valor === "__-__-____"){
			$dadosFrequencia = $FrequenciaAluno->listarHojePorAluno($dados[0]["idmatricula"]);
		}else{
			$dadosFrequencia = $FrequenciaAluno->listarDataPorAluno($dados[0]["idmatricula"], $data);
		}
		

		if($dadosFrequencia == null){
			echo "<tr>";
			echo "<td colspan='5'> <b> Sem Resultados</b>";
	        echo "</td>";
			echo "</tr>";
		}else{
			foreach ($dadosFrequencia as $key => $value) {
				echo "<tr>";
				echo "<td data-title='Aluno'>".$value['nomepessoa']."</td>";
				
				$cpf = $value['cpfpessoa'];
		        if($cpf == null){
		          echo "<td data-title='CPF'>Aluno sem CPF</td>";
		        }else{
		          echo "<td data-title='CPF'>".mascara($cpf, "###.###.###-##")."</td>";
		        }

		        echo "<td data-title='Data'>".date('d-m-Y', strtotime($value['data']))."</td>";

		        if($value['hrentrada'] == null){
		          echo "<td data-title='Hora Entrada'>Sem entrada registrada</td>";
		        }else{

		          echo "<td data-title='Hora Entrada'>".date('h:m:s', strtotime($value['hrentrada']))."</td>";
		        }

		        echo "<td data-title='Status'>";
		            if($value['hrentrada'] == null){
		                if($value['frequenciaocorrencia_idfrequenciaocorrencia'] == null){
		                  echo "Falta não justificada";
		                }else{
		                  echo "Falta justificada";
		                }
		            }else{
		                echo "Presente";
		            }

		        echo "</td>";
				echo "</tr>";
			}
		}
	} catch (\Exception $e) {
		echo "<tr>";
		echo "<td colspan='5'> <b> Sem Resultados ".$e."</b>";
        echo "</td>";
		echo "</tr>";
	}
	
});
$app->get("/portal/aluno/profile/", function(){
	Usuario::verifyLogin(0);
});

$app->get("/portal/aluno/frequencia/", function(){
	Usuario::verifyLogin(0);
});
?>