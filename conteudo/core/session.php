<!-- esse bloco de codigo em php verifica se existe a sessao-->
<?php  
        session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            header("Location: index.php?r=1");
            
        }
   
?>