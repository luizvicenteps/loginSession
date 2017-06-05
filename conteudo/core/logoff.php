<?php session_start();
      session_destroy();
      
      header("Location: index.php");
      echo 'Logoff Efetuado com Sucesso';
      
      ?>
 
