<?php

$menu_logo = 'index.php?p=painel';
$menu_inicio = '<a href="index.php?p=painel">Início</a>';
$menu_usuarios = "<a data-toggle='dropdown' href='#'>Usuários<span class='caret'></span></a>";
$menu_usuarios_todos = "<a href='index.php?p=painel&padm=usuarios'>Pesquisar</a>";
$menu_usuarios_new =  '<a href="index.php?p=painel&padm=cadastrar">Novo</a>';
$menu_sair = "<a href='index.php?p=core/logoff' class='btn btn-default btn-sm pull-right btn-danger'> Sair </a>";
$menu_usuario_senha = "<a href='index.php?p=painel&padm=editar_senha&usuario=".$_SESSION['codigo']."' class='btn btn-default btn-sm pull-right'> Alterar Senha </a>";
$menu_usuario_perfil = "<a href='index.php?p=painel&padm=editar_perfil&usuario=".$_SESSION['codigo']."' class='btn btn-primary btn-sm active'>Seu Perfil</a>";
$menu_usuario_nome = $_SESSION["nome"];
$menu_usuario_sobrenome = $_SESSION['sobrenome'];
$menu_usuario_apelido = $_SESSION["apelido"];
$menu_usuario_email = $_SESSION["email"];
$menu_usuario_img = "<img src='".$_SESSION['foto_perfil']."' style='height: 100px' class='avatar img-circle' alt='avatar'";


$mostra_menus = " 
                
                <nav class='nav navbar-inverse navbar-fixed-top' role='navigation'>
        <div class='container topnav'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='$menu_logo'>LoginSession</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>

                    <li class='dropdown'>
                        $menu_usuarios
                            <ul class='dropdown-menu'>
                            <li>
                                $menu_usuarios_new
                            </li>
                            <li>
                                $menu_usuarios_todos
                            </li>
                          </ul>
                    </li>
                 </ul>   
                <ul class='nav navbar-nav navbar-right'>    
                    <!-- Menu do Usuarios logado -->
                    
                    <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Olá, $menu_usuario_apelido
                        <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                            <li>
                                <div class='navbar-content'>
                                    <div class='row'>
                                        <div class='col-md-5 col-xs-5'>
                                            $menu_usuario_img
                                            <p class='text-center small'>
                                                <a href='#'> </a></p>
                                        </div>
                                        <div class='col-md-7 col-xs-7 '>
                                            <span> $menu_usuario_nome </br></span>
                                            <span> $menu_usuario_sobrenome </span>
                                            <p class='text-muted small'>
                                                $menu_usuario_email</p>
                                            <div class='divider'>
                                            </div>
                                                $menu_usuario_perfil<!-- <a href='#' class='btn btn-primary btn-sm active'>View Profile</a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class='navbar-footer'>
                                    <div class='navbar-footer-content'>
                                        <div class='row'>
                                            <div class='col-md-6 col-xs-6'>
                                                $menu_usuario_senha<!--<a href='#' class='btn btn-default btn-sm'>Change Passowrd</a>-->
                                            </div>
                                            <div class='col-md-6 col-xs-6'>
                                                $menu_sair <!-- <a href='http://www.jquery2dotnet.com' class='btn btn-default btn-sm pull-right'>Sair</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

        ";
				
				print $mostra_menus;

?>