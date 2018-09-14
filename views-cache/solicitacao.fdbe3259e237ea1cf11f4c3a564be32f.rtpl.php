<?php if(!class_exists('Rain\Tpl')){exit;}?><!--<!DOCTYPE html>
<html>
<head>
	<title>
		
	Solicitação
	</title>
	<link href="/res/Admin/Dashio/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="/res/Admin/Dashio/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="/res/Admin/Dashio/lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="/res/Admin/Dashio/lib/bootstrap-daterangepicker/daterangepicker.css" />
</head>
<body>

<form action="/solicitacao/" method="post" class="form-panel">
	Nome da Escola: <input type="text" name="nomeEscola" class="form-control">
	CNPJ: <input type="text" name="CNPJ" class="form-control">
	<input type="submit" name="ENVIAR" class="btn btn-theme">

</form>


</body>
</html>

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Packet Software">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Sime">
  <title>SIME - Faça sua solicitação</title>


  <link href="/res/Admin/img/favicon.png" rel="icon">
  <link href="/res/Admin/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="/res/Admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="/res/Admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link href="/res/Admin/css/style.css" rel="stylesheet">
  <link href="/res/Admin/css/style-responsive.css" rel="stylesheet">

</head>

<body>
  <section id="container">

    <header class="header black-bg">
      
      <!--logo start-->
      <a href="/" class="logo"><b><span>SI</span>ME</b></a>
      <!--logo end-->
      
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="/">INICIO</a></li>
          <li><a class="logout" href="/#sime">O SIME</a></li>
          <li><a class="logout" href="/#team">EQUIPE</a></li>
          <li><a class="logout" href="/#contact">CONTATO</a></li>
          <li><a class="logout" href="/login/">LOGIN</a></li>
          <li><a class="logout" href="/solicitacao">SOLICIAR</a></li>
        </ul>
      </div>
    </header>
       
    <section id="content">
      <section class="wrapper">
       
     <a href="#" class="logo"><b><span><i class="fa fa-angle-right"></i> SOLICITE SEU ACESSO</span></b></a>

	        <div class="row mt">
	          <div class="col-lg-12">
	            
	            <div class="form-panel">
	              <div class=" form">
	                <form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="">
	                  <div class="form-group ">
	                    <label for="cname" class="control-label col-lg-2">Nome da instituição: </label>
	                    <div class="col-lg-10">
	                      <input class=" form-control" id="cname" name="nomeescola" minlength="2" type="text" required />
	                    </div>
	                  </div>
	                  <div class="form-group ">
	                    <label for="cemail" class="control-label col-lg-2">Email da instituição: </label>
	                    <div class="col-lg-10">
	                      <input class="form-control " id="cemail" type="emailescola" name="email" required />
	                    </div>
	                  </div>
	                  <div class="form-group ">
	                    <label for="curl" class="control-label col-lg-2">CNPJ da instituição:</label>
	                    <div class="col-lg-10">
	                      <input class="form-control " id="curl" type="text" name="cnpjescola" />
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <div class="col-lg-offset-2 col-lg-10">
	                      <button class="btn btn-theme" type="submit">SOLICITAR</button>
	                      <button class="btn btn-theme04" type="button">CANCELAR</button>
	                    </div>
	                  </div>
	                </form>
	              </div>
	            </div>
	            <!-- /form-panel -->
	          </div>
	          <!-- /col-lg-12 -->

	        </div>
      </section>

    </section>

    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">

          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="form_validation.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    
  </section>

  <script src="/res/Admin/lib/jquery/jquery.min.js"></script>
  <script src="/res/Admin/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="/res/Admin/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="/res/Admin/lib/jquery.scrollTo.min.js"></script>
  <script src="/res/Admin/lib/jquery.nicescroll.js" type="text/javascript"></script>

  <script src="/res/Admin/lib/common-scripts.js"></script>

  <script src="/res/Admin/lib/form-validation-script.js"></script>
  
</body>

</html>
