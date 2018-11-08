<?php
// Enviar mensagem e receber retorno em JSON
// URL de WebService
$url = 'https://www.paposms.com/webservice/1.0/send/';

// Dados para o SMS
$fields = array(
        "user"=>'user',
        "pass"=>'pass',
        "numbers"=>'4100000000',
        "message"=>'Mensagem!!',
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
