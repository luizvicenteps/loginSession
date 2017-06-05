<?php session_start();
      session_destroy();
      
      header("Location: ../");
      echo 'Logoff Efetuado com Sucesso';
      
      ?>
 
