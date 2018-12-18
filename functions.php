<?php

function formatarData($data){
	$data = date('d-m-Y', strtotime($data));
	return $data;
}

function formatarHora($data){
	$data = date('h:m:s', strtotime($data));
	return $data;
}

function formatarCpf($cpf){

}

function mascara($val, $mask)
{
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++){
	if($mask[$i] == '#'){
 		if(isset($val[$k]))
 			$maskared .= $val[$k++];
 	}
 	else{
 		if(isset($mask[$i]))
 			$maskared .= $mask[$i];
 	}
 }
 return $maskared;
}


?>