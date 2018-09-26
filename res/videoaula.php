S<?php
if($_POST)
{
	session_start();
	$cookie = $_SESSION['cookie'];

	$link = "http://www.receita.fazenda.gov.br/aplicacoes/atcta/cpf/ConsultaPublicaExibir.asp";

	$dados = array
	(
		'txtCPF' => preg_replace('/[^0-9]/', '', $_POST['cpf']),
		'txtTexto_captcha_serpro_gov_br' => $_POST['captcha'],
		'Enviar' => 'Consultar'
	);

	$dados = http_build_query($dados, NULL, "&");

	$ch = curl_init($link);
	curl_setopt($ch, CURLOPT_REFERER, $link);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);

	$html = curl_exec($ch);

	echo $html;

	curl_close($ch);
	unlink($cookie);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Cpf: <input type="text" name="cpf"/>
		Captcha: <input type="text" name="captcha"/>
		<img src="captcha.php" />
		<input type="submit" value="Enviar" />
	</form>
</body>
</html>