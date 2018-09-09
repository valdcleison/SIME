<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>SIME - Administração</title>

  <link href="img/favicon.png" rel="icon">


  <link href="/res/Admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="/res/Admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link href="/res/Admin/css/style.css" rel="stylesheet">
  <link href="/res/Admin/css/style-responsive.css" rel="stylesheet">


<body>
  <section id="container">
    
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>

      <a href="/admin/" class="logo"><b><span>SIME</span></b></a>

      
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="/logout/">SAIR</a></li>
        </ul>
      </div>
    </header>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="/res/Admin/img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">Valdcleison Valdeci Araujo Carvalho</h5>
          <li class="mt">
            <a href="?admin/">
              <i class="fa fa-dashboard"></i>
              <span>Inicio</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Usuarios</span>
              </a>
            <ul class="sub">
              <li><a href="/admin/cadastrar/">Cadastrar</a></li>
              <li><a href="/admin/listar/">Listar</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Escolas</span>
              </a>
            <ul class="sub">
              <li><a href="/admin/escola/cadastrar/">Cadastrar</a></li>
              <li><a href="/admin/escola/listar/">Listar</a></li>
            </ul>
          </li>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>