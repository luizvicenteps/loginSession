<?php

$host = "localhost";
$userbd = "root";
$passbd = "";
$bd = "cadcli";

/*$mysqli = new mysqli($host, $userbd, $passbd, $bd);

$con = mysql_connect("$host", "$userbd", "$passbd") or die ("Sem conexão com o servidor");
$select = mysql_select_db("cadcli") or die("Sem acesso ao DB, Entre em contato com o Administrador, gilson_sales@bytecode.com.br");
#conexao PDO
*/
try
{
$PDO = new PDO( 'mysql:host=' . $host . ';dbname=' . $bd, $userbd, $passbd );

}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}


        ?>