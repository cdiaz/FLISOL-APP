<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dashboard - Flisol 2014</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/pages/signin.css" rel="stylesheet" type="text/css">
  <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/pages/dashboard.css" rel="stylesheet">
  <link href="assets/css/select2.css" rel="stylesheet">
</head>
<body>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container"> 
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> 
        </a>
        <a class="brand" href="index.html">Flisol 2014 </a>
        <div class="nav-collapse">
          <ul class="nav pull-right">
            <li class="dropdown" id="menuLogin">
              <a data-flisol="toggleLogin"><i class="icon-user"></i> Acceder</a>
              <div id="loginform"class="dropdown-menu" style="padding:17px;">
                <form action="#" method="post">
                  <h2>Acceso</h2>   
                  <div class="login-fields">
                    <p>Porfavor suministre sus credenciales de acceso</p>
                    <div class="field">
                      <input type="text" id="username" name="username" value="" placeholder="Usuario" class="login username-field" />
                    </div> 
                    <div class="field">
                      <input type="password" id="password" name="password" value="" placeholder="Contraseña" class="login password-field"/>
                    </div> 
                  </div> 
                  <div class="login-actions">
                    <button type="button" data-flisol="loginFlisol" class="button btn btn-success btn-large">Acceder</button>
                  </div> 
                </form>
              </div>
            </li>
            <li id="menuLogged" style="display:none">
              <a><span class="nombre"></span> <span class="icon-off" data-flisol="logoutFlisol"></span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="subnavbar">
    <div class="subnavbar-inner">
      <div class="container">
        <ul id="menu_recepcionista" class="mainnav menuFlisol" style="display:none">
          <li><a><i class="icon-dashboard"></i><span data-vista="dashboard">Dashboard</span> </a> </li>
          <li><a href="#registrar_persona" data-toggle="modal"><i class="icon-user"></i><span>Agregar persona</span> </a> </li>
          <li><a><i data-vista="formulario_equipo" data-flisol="buscarPersona" class="icon-desktop"></i><span data-vista="formulario_equipo" data-flisol="buscarPersona">Agregar equipo</span> </a></li>
          <li><a><i data-flisol="enviarEquipo" class="icon-truck"></i><span data-flisol="enviarEquipo">Enviar equipo</span> </a> </li>        
          <li><a><i class="icon-list-ol"></i><span>Listar equipos</span> </a> </li>   
          <li><a><i class="icon-list-ol"></i><span>Recibir equipo</span> </a> </li>          
          <li><a><i class="icon-ok-sign"></i><span>Entregar equipo</span> </a> </li>   
        </ul>
        <ul id="menu_director" class="mainnav menuFlisol" style="display:none">
          <li><a><i class="icon-dashboard"></i><span data-vista="dashboard">Dashboard</span> </a> </li>
          <li><a><i class="icon-signin"></i><span>Recibir equipo</span> </a> </li>
          <li><a><i class="icon-download-alt"></i><span>Instalar equipo</span> </a></li>
          <li><a><i class="icon-wrench"></i><span>Configurar equipo</span> </a> </li>        
          <li><a><i class="icon-check"></i><span>Terminar equipo</span> </a> </li>        
          <li><a><i class="icon-truck"></i><span>Salida equipo</span> </a> </li>   
        </ul>
      </div>
    </div> 
  </div>