<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Packet Software">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Sime">
  <title>SIME - Recuperar Senha</title>

 
  <link href="/res/Admin/img/favicon.png" rel="icon">
  <link href="/res/Admin/img/apple-touch-icon.png" rel="apple-touch-icon">

  
  <link href="/res/Admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="/res/Admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link href="/res/Admin/css/style.css" rel="stylesheet">
  <link href="/res/Admin/css/style-responsive.css" rel="stylesheet">

</head>

<body>

  <div id="login-page">
    <div class="container">
      <form class="form-login" action="/forgot/reset-password/" method="post">
        <h2 class="form-login-heading">Recupere Sua Senha</h2>
        <div class="login-wrap">
          
          <input type="password" id="senha" name="senha" class="form-control" minlength="8" placeholder="SENHA"  required>
          <br>
          <input type="password" id="resenha" name ="comsenha" class="form-control" minlength="8" placeholder="CONFIRMAÇÃO DE SENHA" required>
          <br>
          
          <input class="btn btn-theme btn-block" onclick="confirmPass();" type="submit" value="SALVAR"/>
          
        </div>
       </form>
        
    </div>
  </div>
  
  <script src="/res/Admin/lib/jquery/jquery.min.js"></script>
  <script src="/res/Admin/lib/bootstrap/js/bootstrap.min.js"></script>

  <script>
    function confirmPass() {
      if($('#senha').val() == "" || $('#resenha').val() == ""){
          alert('Campos Vazios!');
          return false;
      }
      if($('#senha').val() != $('#resenha').val()){
          alert('Senhas diferentes!');
          return false;
      }
    }
    
  </script>
</body>

</html>
