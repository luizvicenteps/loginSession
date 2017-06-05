<?php 
include 'core/session.php';
?>
<header>
<?PHP include ("include/menu.php");?>
    </header>
<div class="container">
<div class="principal">
<?PHP


if(isset($_GET['padm']))
    {   
    $padm = $_GET['padm'].".php";
      if(is_file("conteudo/$padm")){
        include("conteudo/$padm");
        }else{
        include("conteudo/404.php");
    }
    }  else { include("conteudo/gad.php");
    }


?>
<footer class="nav navbar-inverse navbar-fixed-bottom">
    <div class='container'>
        <p class="navbar-text center">
            © 2016 - LogginSession - Simples Demostração de um sistema CRUD
        </p>
    </div>

</footer>

