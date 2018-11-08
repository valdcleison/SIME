<?php 

use \Sime\Controller\Usuario;

use \Sime\WebService\Escola;
use \Sime\WebService\FrequenciaAluno;
use \Sime\WebService\Frequencia;
use \Sime\SMS;

$app->get("/teste/", function(){
		$idfrequenciaaluno = "1";

		$frequenciaaluno = new FrequenciaAluno();
		$dados = $frequenciaaluno->buscarFrequenciaAlunoPorId($idfrequenciaaluno);
		
			$data = new DateTime($dados["dtfrequencia"]);
			
			
			
			$email = new \Sime\Mailer($dados["email"], $dados["nomepessoa"] , "Notificação", "notificacao", array(
				"nomealuno"=>"Aluno Test",
				"data"=>$data->format('d-m-Y')
			));

			$email->send();
			
			$url = 'https://www.paposms.com/webservice/1.0/send/';

			$message = "O Aluno Teste, cuja matricula ". $dados["numeromatricula"] .", não compareceu a escola no dia ". date("d-m-Y") . "";
			$fields = array(
			        "user"=>'w.jotas3@gmail.com',
			        "pass"=>'willian23',
			        "numbers"=>$dados["telefone"],
			        "message"=>$message,
			        "return_format"=>"json"
			    );

			// Organizar dados para URL
			$postvars = http_build_query($fields);

			// Pedido de envio de SMS ao WebService
			$result = file_get_contents($url."?".$postvars);

			$result_array = json_decode($result, true);

			if ($result_array['result'] === true) {
			    echo "Mensagem enviada.";
			} else {
			    echo "Mensagem não enviada";
			}
			echo json_encode(array(
				"status"=>"ok",
				"menssage"=>"Aluno Ausente"

			));
});


$app->get("/ws/:version/escola/sincdata/", function($version){

	if($version !== "1.0"){
		
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"
		));
	} else {
		
		echo json_encode(array(
			"status"=>"OK",
			"menssage"=>"Versão compativel",
			"ok"=>"Ok"
		));




	}

});




$app->get("/ws/:version/login/:usuario/:senha/", function($version, $user, $senha){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					echo json_encode(array(
						"status"=>"ok",
						"menssage"=>"Dados recuperados",
						"usuario"=>$user->getValues()

					));
					
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});

$app->get("/ws/:version/portal/:usuario/:senha/dados-escola/", function($version, $user, $senha){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					$escola = new Escola();
					$escola->listarPorUsuario($user->getidusuario());

	
					echo json_encode(array(
						"status"=>"ok",
						"menssage"=>"campos gerados",
						"escola_usuario"=>array(
							"idescola_usuario"=> $escola->getidescola_usuario(),
							"escola"=> array(
								"idescola"=>$escola->getidescola(),
								"nomeescola"=>$escola->getnomeescola(),
								"cnpj"=>$escola->getcnpj(),
								"nomegestor"=>$escola->getnomegestor(),
								"contato"=>	array(
									"idcontato"=>$escola->getidcontato(),
									"telefone"=>$escola->gettelefone(),
									"celular"=>$escola->getcelular(),
									"email"=>$escola->getemail()
								),
								"anoletivo"=>array(
									"idanoletivo"=>$escola->getidanoletivo(),
									"anoletivo"=>$escola->getanoletivo(),
									"dtinicio"=>$escola->getdtinicio()
								),
								"endereco"=>array(
									"idendereco"=> $escola->getidendereco(),
									"rua"=> $escola->getrua(),
									"numero"=> $escola->getnumero(),
									"bairro"=> $escola->getbairro(),
									"cidade"=> $escola->getcidade(),
									"estado"=> $escola->getestado(),
									"cep"=> $escola->getcep(),
								)
							),
							"usuario"=> array(
								"idusuario"=> $escola->getidusuario(),
								"emailpessoa"=> $escola->getemailpessoa(),
								"usuario"=> $escola->getusuario(),
								"niveladmin"=> $escola->getniveladmin(),
								"statususuario"=> $escola->getstatususuario()
							),
							"inadmin"=> $escola->getinadmin()
						)));
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});


$app->get("/ws/:version/portal/:usuario/:senha/dados-frequencia/", function($version, $user, $senha){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					$escola = new Escola();
					$escola->listarPorUsuario($user->getidusuario());

					$frequencia = new Frequencia();
					$dados = $frequencia->listarPorEscola($escola->getidescola());
					
					echo json_encode(array(
						"status"=>"ok",
						"menssage"=>"campos gerados",
						"frequencia"=>[
							"idfrequencia" => $dados[0]["idfrequencia"],
						    "qtalunospresentes" => $dados[0]["qtalunospresentes"] ,
						    "qtalunosausentes" =>$dados[0]["qtalunosausentes"] ,
						    "dtfrequencia" => $dados[0]["dtfrequencia"],
						    "hrinicio" => $dados[0]["hrinicio"],
						    "hrtermino" => $dados[0]["hrtermino"],
						    "escola"=> array(
								"idescola"=>$escola->getidescola(),
								"nomeescola"=>$escola->getnomeescola(),
								"cnpj"=>$escola->getcnpj(),
								"nomegestor"=>$escola->getnomegestor(),
								"contato"=>	array(
									"idcontato"=>$escola->getidcontato(),
									"telefone"=>$escola->gettelefone(),
									"celular"=>$escola->getcelular(),
									"email"=>$escola->getemail()
								),
								"anoletivo"=>array(
									"idanoletivo"=>$escola->getidanoletivo(),
									"anoletivo"=>$escola->getanoletivo(),
									"dtinicio"=>$escola->getdtinicio()
								),
								"endereco"=>array(
									"idendereco"=> $escola->getidendereco(),
									"rua"=> $escola->getrua(),
									"numero"=> $escola->getnumero(),
									"bairro"=> $escola->getbairro(),
									"cidade"=> $escola->getcidade(),
									"estado"=> $escola->getestado(),
									"cep"=> $escola->getcep(),
								)
							)
						]));
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});

$app->get("/ws/:version/portal/:usuario/:senha/dados-frequencia-aluno/", function($version, $user, $senha){

	if($version !== '1.0'){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;



	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					$escola = new Escola();
					$escola->listarPorUsuario($user->getidusuario());
					
					$frAluno = new FrequenciaAluno();
					$dados = $frAluno->buscarFrequenciaAlunoPorEscola((int)$escola->getidescola());
					
					
					$data = array();
					
					for($i = 0; $i < count($dados); $i++){
						$array = array(array(
							"status"=>"ok",
							"menssage"=>"dados gerados",
							"frequenciaaluno"=>array(
									"idfrequenciaaluno" => $dados[$i]["idfrequenciaaluno"],
								    "data" => $dados[$i]["data"],
								    "hrentrada" => $dados[$i]["hrentrada"],
								    "matricula" => [
								    	"idmatricula"=>$dados[$i]["idmatricula"],
									    "aluno"=>[
								    		"idaluno"=>$dados[$i]["idaluno"],
								    		"pessoa"=>[
								    			"idpessoa"=>$dados[$i]["idpessoa"],
								    			"nomepessoa"=>$dados[$i]["nomepessoa"],
								    			"cpfpessoa"=>$dados[$i]["cpfpessoa"]
								    		]
									    ],
									    "numeromatricula"=>$dados[$i]["numeromatricula"]
								    ],
								    "frequencia" => [
								    	"idfrequencia"=>$dados[$i]["idfrequencia"],
								    	"qtalunospresentes"=>$dados[$i]["qtalunospresentes"],
									    "qtalunosausentes"=>$dados[$i]["qtalunosausentes"],
									    "dtfrequencia"=>$dados[$i]["dtfrequencia"],
									    "hrinicio"=>$dados[$i]["hrinicio"],
									    "escola"=> [
											"idescola"=>$escola->getidescola(),
											"nomeescola"=>$escola->getnomeescola(),
											"cnpj"=>$escola->getcnpj(),
											"nomegestor"=>$escola->getnomegestor(),
											"contato"=>	array(
												"idcontato"=>$escola->getidcontato(),
												"telefone"=>$escola->gettelefone(),
												"celular"=>$escola->getcelular(),
												"email"=>$escola->getemail()
											),
											"anoletivo"=>array(
												"idanoletivo"=>$escola->getidanoletivo(),
												"anoletivo"=>$escola->getanoletivo(),
												"dtinicio"=>$escola->getdtinicio()
											),
											"endereco"=>array(
												"idendereco"=> $escola->getidendereco(),
												"rua"=> $escola->getrua(),
												"numero"=> $escola->getnumero(),
												"bairro"=> $escola->getbairro(),
												"cidade"=> $escola->getcidade(),
												"estado"=> $escola->getestado(),
												"cep"=> $escola->getcep(),
											)
										]
								    ]

								)
						));
						array_push($data, $array[0]);
					}	

					
					echo json_encode($data);

					
					

				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			throw new \Exception($e, 1);
			
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});


$app->get("/ws/:version/portal/dados-escola/", function($version){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($_POST['user'], $_POST['pass']);
			switch ($user->getniveladmin()) {
				case '1':
					$usuario = new Usuario();
					
					$usuario->listarPorEscola($user->getidusuario());
					echo json_encode($usuario->getValues());
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Versão incompativel"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}

});

$app->post("/ws/:versao/portal/:usuario/:senha/sincdata/", function($version, $user, $senha){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					$idfrequenciaaluno = (int)$_POST['idfrequenciaaluno'];
					$hrentrada = $_POST['hrentrada'];

					$frequenciaaluno = new FrequenciaAluno();
					$dados = $frequenciaaluno->buscarFrequenciaAlunoPorId($idfrequenciaaluno);

					if($hrentrada === "null" || $hrentrada === null || $hrentrada === ""){

							$data = new DateTime($dados["dtfrequencia"]);
							
														
							$url = 'https://www.paposms.com/webservice/1.0/send/';
				
							$message = "O Aluno Teste, cuja matricula ". $dados["numeromatricula"] .", não compareceu a escola no dia ". date("d-m-Y") . "";
							$fields = array(
							        "user"=>'bilca2011@gmail.com',
							        "pass"=>'simesco',
							        "numbers"=>$dados["telefone"],
							        "message"=>$message,
							        "return_format"=>"json"
							    );
				
							// Organizar dados para URL
							$postvars = http_build_query($fields);
				
							// Pedido de envio de SMS ao WebService
							$result = file_get_contents($url."?".$postvars);
				
							$result_array = json_decode($result, true);
				
							if ($result_array['result'] === true) {
							    echo "Mensagem enviada.";
							} else {
							    echo "Mensagem não enviada";
							}
							echo json_encode(array(
								"status"=>"ok",
								"menssage"=>"Aluno Ausente".$hrentrada.""
				
							));
					}else{
					
						$frAluno = new FrequenciaAluno();
						$frAluno->AlterarPorId($idfrequenciaaluno, $hrentrada);
						echo json_encode(array(
							"status"=>"ok",
							"menssage"=>"Aluno Presente".$hrentrada.""
							

						));
					}
				
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Frequência não encontrada!"

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}



});

$app->post("/ws/:versao/portal/:usuario/:senha/sincfrequencia/", function($version, $user, $senha){

	if($version === 1.0){
		echo json_encode(array(
			"status"=>"failed",
			"menssage"=>"Versão incompativel"

		));
		exit;

	} else {

		try{
			$user = Usuario::login($user, $senha);
			switch ($user->getniveladmin()) {
				case '1':
					$idfrequencia = (int)$_POST['idfrequencia'];
					$hrinicio = (String)$_POST['hrinicio'];
					$hrtermino = (String)$_POST['hrtermino'];
					try{
						$frequencia = new Frequencia();
						$frequencia->alterarFrequencia($idfrequencia ,$hrinicio, $hrtermino);
					} catch (\Exception $e){
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Frequencia ".$e->getmessage().""

					));
					exit;
					}
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"Frequencia "

					));
					exit;
				break;
				default:
					echo json_encode(array(
						"status"=>"failed",
						"menssage"=>"".$hrinicio."".$idfrequencia.""

					));
					exit;
				break;
			}
		}catch(\Exception $e){
			echo json_encode(array(
				"status"=>"failed",
				"menssage"=>$e->getmessage()

			));
			exit;
		}
	}



});