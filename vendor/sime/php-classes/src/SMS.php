<?php 

namespace Sime;


class Control{

	public function avisarResponsavel(){
		$url = 'https://www.paposms.com/webservice/1.0/send/';

		$message = "O Aluno Roberto Soares Da Silva, cuja matricula 123456, não compareceu a escola no dia 31-08-2018";
		$fields = array(
		        "user"=>'w.jotas3@gmail.com',
		        "pass"=>'willians3',
		        "numbers"=>'87991154745',
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

	}

}


 ?>