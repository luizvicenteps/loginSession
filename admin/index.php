<?php include '../include/header.php';
if(isset($_GET['p']))
    {
    $pagina = $_GET['p'].".php";
      if(is_file("conteudo/$pagina")){
        include("conteudo/$pagina");
        }else
        include("conteudo/404.php");

    }else
      include("conteudo/core/flogin.php");
 
include '../include/footer.php';?>