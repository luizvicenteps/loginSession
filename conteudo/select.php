<?php
$busca = "luiz";
$sql = "SELECT * FROM t_users;";
$result = $PDO->query( $sql );
$rows = $result->fetchAll( PDO::FETCH_ASSOC );
 
print_r( $rows );
?>