<?php if(!class_exists('Rain\Tpl')){exit;}?><html>
<head>
</head>
<body>
O Aluno <?php echo htmlspecialchars( $nomealuno, ENT_COMPAT, 'UTF-8', FALSE ); ?> Faltou no dia <?php echo htmlspecialchars( $data, ENT_COMPAT, 'UTF-8', FALSE ); ?>!
</body>
</html>