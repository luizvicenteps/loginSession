<?php 
include 'core/session.php';
//session_start();

$logado = $_SESSION['login'];

echo '<br><h1>Olá '.$logado.'!</h1>';
echo '<a href="index.php?p=select">Select Array<br></a>';
//echo '<a href="index.php?p=exibirtodos">Exibir Todos</a>';

?>
