<?php 

use \Sime\Controller\Usuario;

use \Sime\WebService\Escola;
use \Sime\WebService\FrequenciaAluno;


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
					$dados = $frAluno->wsBuscarFrequenciaAluno($escola->getidescola());
					//var_dump($dados);
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
								    	"idmatricula",
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
									    "hrtermino"=>$dados[$i]["hrtermino"],
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