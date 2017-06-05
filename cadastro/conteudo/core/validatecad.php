<?php 
include '../../../classe/conexao.php';
$login = addslashes($_POST['login']);
$senha = md5(addslashes($_POST['senha']));

$sql_code = "SELECT nome, sobrenome, apelido, codigo, email, niveldeacesso, foto_perfil FROM t_users WHERE email = '$login' AND senha= '$senha'";
$sql_query = $PDO->query($sql_code);
if($sql_query->rowCount() > 0 )
    {
    foreach ($sql_query as $key => $userlogado){
    session_start();
    $_SESSION['codigo'] = $userlogado['codigo'];
    $_SESSION['nome'] = $userlogado['nome'];
    $_SESSION['sobrenome'] = $userlogado['sobrenome'];
    $_SESSION['niveldeacesso'] = $userlogado['niveldeacesso'];
    $_SESSION['email'] = $userlogado['email'];
    $_SESSION['apelido'] = $userlogado['apelido'];
    $_SESSION['foto_perfil'] = $userlogado['foto_perfil'];
    }
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
