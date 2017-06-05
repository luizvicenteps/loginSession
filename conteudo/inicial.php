<?php
error_reporting(0);
	

	$sql_code = "SELECT * FROM t_users";
	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
	$linha = $sql_query->fetch_assoc();

	$sexo[1] = "Masculino";
	$sexo[2] = "Feminino";

	$niveldeacesso[1] = "Básico";
	$niveldeacesso[2] = "Admin";

?>

<h1>Usuários</h1>
<a href="index.php?p=cadastrar">Cadastrar um usuário</a>
<p class=espaco></p>
<table border=1 cellpadding=10>
	<tr class=titulo>
		<td>Nome</td>
		<td>Sobrenome</td>
		<td>Sexo</td>
		<td>E-mail</td>
		<td>Nível de Acesso</td>
		<td>Data de Cadastro</td>
		<td>Ação</td>
		<td>Saldo</td>
	</tr>
	<?php
	do{
	?>
	<tr>
		<td><?php echo $linha['nome']; ?></td>
		<td><?php echo $linha['sobrenome']; ?></td>
		<td><?php echo $sexo[$linha['sexo']]; ?></td>
		<td><?php echo $linha['email']; ?></td>
		<td><?php echo $niveldeacesso[$linha['niveldeacesso']]; ?></td>
		<td><?php
		$d = explode(" ", $linha['datadecadastro']);
		$data = explode("-", $d[0]);
		echo "$data[2]/$data[1]/$data[0] às $d[1]"; 

		?></td>
		<td>
			<a href="index.php?p=editar&usuario=<?php echo $linha['codigo']; ?>">Editar</a> |
			<a href="javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $linha['nome']; ?>?'))
			location.href='index.php?p=deletar&usuario=<?php echo $linha['codigo']; ?>';">Deletar</a>
		</td>
		<td><?php echo $linha['saldo']; ?></td>
		
	</tr>
	<?php } while($linha = $sql_query->fetch_assoc()); ?>

</table>