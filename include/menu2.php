<?php

$menu_logo = 'index.php?p=painel';
$menu_inicio = '<a href="index.php?p=painel">Início</a>';
$menu_cadastrar =  '<a href="index.php?p=cadastrar">Cadastrar</a>';
$menu_exibe = "<a href='index.php?p=inicial'>Editar</a>";
$menu_sair = "<a href='index.php?p=core/logoff'>Sair</a>";

$mostra_menus = "<nav class='nav navbar-inverse'>
                                <div class='container-fluid'>
                                    <div class='navbar-header'>
                                        <a class='navbar-brand' href='$menu_logo'>LoginSession</a>
                                    </div>
                                    <ul class='nav navbar-nav'>
					<li>$menu_inicio</li>
					<li>$menu_cadastrar</li>
					<li>$menu_exibe</li>
					<li>$menu_sair</li>
                                    </ul>
                                </div> 
                        </nav>";
				
				print $mostra_menus;

?>