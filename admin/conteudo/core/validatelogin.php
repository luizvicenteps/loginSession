<?php 
define('NOIMAGE', 'https://letstalkbitcoin.com/files/avatars/default.jpg');
include '../../../classe/conexao.php';
$login = addslashes($_POST['login']);
$senha = md5(addslashes($_POST['senha']));

$sql_code = "SELECT nome, sobrenome, apelido, codigo, email, niveldeacesso, foto_perfil FROM t_users WHERE email = '$login' AND senha= '$senha'";
$sql_query = $PDO->query($sql_code);
$contador = count($sql_query);

if($contador > 0 )
    {
    foreach ($sql_query as $userlogado){
    session_start();
    $_SESSION['codigo'] = $userlogado['codigo'];
    $_SESSION['nome'] = $userlogado['nome'];
    $_SESSION['sobrenome'] = $userlogado['sobrenome'];
    $_SESSION['niveldeacesso'] = $userlogado['niveldeacesso'];
    $_SESSION['email'] = $userlogado['email'];
    $_SESSION['apelido'] = $userlogado['apelido'];
    $_SESSION['foto_perfil'] = $userlogado['foto_perfil'];
//    if($userlogado['foto_perfil'] != ""){
//    $_SESSION['foto_perfil'] = '../img/'.$userlogado['foto_perfil'];
//    }else{
//        $_SESSION['foto_perfil'] = "https://letstalkbitcoin.com/files/avatars/default.jpg";
//    }
    $_SESSION['foto_perfil'] = (!empty($_SESSION['foto_perfil']) ? '../img/'.$userlogado['foto_perfil'] : NOIMAGE);
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
