<?php
session_start();

$link 		= "http://www.receita.fazenda.gov.br/aplicacoes/atcta/cpf/consultapublica.asp";
$captcha 	= "http://www.receita.fazenda.gov.br/aplicacoes/atcta/cpf/captcha/gerarCaptcha.asp";

$arquivo = __DIR__ . DIRECTORY_SEPARATOR .md5(rand().time());
file_put_contents($arquivo, '');

$ch = curl_init($captcha);
curl_setopt($ch, CURLOPT_REFERER, $link);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $arquivo);

$captcha = curl_exec($ch);
curl_close($ch);

$_SESSION['cookie'] = $arquivo;

$captcha = imagecreatefromstring($captcha);
header('Content-type: image/png');
imagepng($captcha);
exit();
?>