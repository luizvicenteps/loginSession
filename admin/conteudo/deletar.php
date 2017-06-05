<?php

	$usu_codigo = intval($_GET['usuario']);

//	$sql_code = "DELETE FROM t_users WHERE codigo = '$usu_codigo'";
//	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        
        $sql_code = "DELETE FROM t_users WHERE codigo = '$usu_codigo'";        
        $sql_query = $PDO->query($sql_code);
	if($sql_query)
		echo "
		<script>
			alert('O usuário foi deletado com sucesso.');
			location.href='index.php?p=painel&padm=usuarios'; 
		</script>";
	else
		echo "
	<script> 
		alert('Não foi possível deletar o usuário.');
		location.href='index.php?p=painel&padm=usuarios'; 
	</script>";

?>
