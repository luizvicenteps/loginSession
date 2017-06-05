<?php 
include '../../classe/conexao.php';
$login = $_POST['login'];
$senha = $_POST['senha'];
$senhacp = md5($_POST['senha']);
$result = mysql_query("SELECT * FROM t_users WHERE login = '$login' AND senha= '$senhacp'");

if(mysql_num_rows ($result) > 0 )
    {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    header("Location: ../../index.php?p=painel");
    }
else {
    header("Location: ../../index.php?r=0");
    ?>
<!--<script type='text/javascript'> alert('Dados editados com sucesso');
     //window.location.href='index.php';
     window.history.go(-1);
      </script>-->
<?php

}
?>
