<?php   $acs[0] = "Básico";
	$acs[1] = "Admin";
	$s[0] = "Masc";
	$s[1] = "Femi";
$sql_code = "SELECT * FROM t_users";        
$sql_query = $PDO->query($sql_code);
$linha = $sql_query->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Pesquisar Usuários</h1>"; ?>
<legend></legend>
<div class="table table-responsive">
    <table id="formdt" class="table table-striped table-bordered" style="margin:0">
            <thead>
                <tr style="font-weight:bold; text-align: left">
                    <th><strong>Cod</strong></th>
                    <th><strong>Nome</strong></th>
                    <th>Sobrenome</th>
                   <th>Apelido</th>
<!--                     <th>Sexo</th>-->
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Data de Cadastro</th>
                    <th>Ação</th>
                    <th>Saldo</th>

                </tr>
            </thead>
            <tfoot>
                <tr style="font-weight:bold; text-align: left">
                    <th><strong>Cod</strong></th>
                    <th><strong>Nome</strong></th>
                    <th>Sobrenome</th>
                    <th>Login</th>
<!--                    <th>Sexo</th>-->
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Data de Cadastro</th>
                    <th>Ação</th>
                    <th>Saldo</th>

                </tr>
            </tfoot>
            <tbody>
                <?php
                foreach ($linha as $l => $mostra) {
                    //extract($mostra);
                    ?>

                    <tr style="white-space: nowrap">
        
                        <td><?php echo $mostra['codigo']; ?></td>
                        <td><?php echo $mostra['nome']; ?></td>
                        <td><?php echo $mostra['sobrenome']; ?></td>
                        <td><?php echo $mostra['apelido']; ?></td>
<!--                        <td><?php echo ($mostra['sexo'] == 1 ? $s[0] : $s[1]); ?></td>-->
                        <td><?php echo $mostra['email']; ?></td>
                        <td><?php echo ($mostra['niveldeacesso'] == 1 ? $acs[0] : $acs[1]); ?></td>
                        <td><?php
                            $d = explode(" ", $mostra['datadecadastro']);
                            $data = explode("-", $d[0]);
                            echo "$data[2]/$data[1]/$data[0] às $d[1]";
                            ?></td>
                        <td style="align-items:center">

                            <a href="index.php?p=painel&padm=editar&usuario=<?php echo $mostra['codigo']; ?>">
                                <button title="Alterar Dados do Usuário" type="button" class="btn btn-xs btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </a> 
                            <span>| |</span>
                            <a href="index.php?p=painel&padm=editar_senha&usuario=<?php echo $mostra['codigo']; ?>">
                                <button title="Alterar Senha" type="button" class="btn btn-xs btn-default">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </button>
                            </a> 
                            <span>| |</span>
                            <a href="javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $mostra['nome']; ?>?'))
                               location.href='index.php?p=painel&padm=deletar&usuario=<?php echo $mostra['codigo']; ?>';">
                                <button title="EXCLUIR Usuário" type="button" data-bind="click: $parent.remove" class="remove-news btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </a>
                        </td>
                        <td><?php echo $mostra['saldo']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>
