<?php

$menu_logo = 'index.php?p=painel';
$menu_inicio = '<a href="index.php?p=painel">Início</a>';
$menu_cadastrar =  '<a href="index.php?p=cadastrar">Cadastrar</a>';
$menu_usuarios = "<a class='btn dropdown-toggle' data-toggle='dropdown' href='index.php?p=usuarios'>Usuários<span class='caret'></span></a>";
$menu_sair = "<a href='index.php?p=core/logoff'>Sair</a>";

$mostra_menus = " 
                
                <nav class='nav navbar-inverse navbar-fixed-top role='navigation''>
        <div class='container'>
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
                    <li>
                        $menu_inicio
                    </li>
                    <li>
                        $menu_cadastrar
                    </li>dsdsdsds
                    <li class='dropdown'>
                        $menu_usuarios
                            <ul class='dropdown-menu'>
                            
                            $menu_inicio
                            
                          </ul>
                    </li>
                    <li>
                        $menu_sair
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