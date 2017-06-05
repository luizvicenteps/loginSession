<?php
//error_reporting(0);
//	$sql_code = "SELECT * FROM t_users";
//	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
//	$linha = $sql_query->fetch_assoc();
//        

$sql_code = "SELECT * FROM t_users";



$sql_query = $PDO->query($sql_code);
$linha = $sql_query->fetchAll(PDO::FETCH_ASSOC);

$s = ["0" => "Masculino", "1" => "Feminino"];

$acs = ["0" => "Básico", "1" => "Admin"];
//
//	$nacesso[1] = "Básico";
//	$niveldeacesso[2] = "Admin";
//        print_r($linha);
//        echo print_r($linha); 
//print_r($linha);


echo "<h1>Exibir Usuários - Conexão PDO</h1>";
echo '<a href="index.php?p=cadastrar">Cadastrar um usuário</a>';
// Acessando Array dentro de array
// $mostra =($linha[1]);
// echo $mostra['sobrenome'];
//echo '<pre>';
//print_r($linha);
//echo '</pre>';
//
//foreach($linha as $l => $mostra) {
//    
//    print_r($mostra['nome']);
//    echo '<br>';
//    
//}
//
?>


<p class=espaco></p>

<div class="table table-responsive">

    <div style="margin:7px">
        <div class="col-xs-6">
            <div class="btn-group">
                <a class="btn btn-default"><span>Novo</span></a>
                <a class="btn btn-default"><span>Editar</span></a>
                <a class="btn btn-default"><span>Deletar</span></a>
            </div>
        </div>
        <div class="col-xs-6 pull-right form-group">
            <input type="text" class="form-control" style="border-radius:0px" placeholder="Pesquisar">
        </div>
    </div>
    <div class="panel-body" style="padding:0px">
        <table class="table table-striped table-bordered" style="margin:0px">
            <thead>
                <tr style="font-weight:bold; text-align: left">
                    <td><strong>Nome</strong></td>
                    <td>Sobrenome</td>
                    <td>Login</td>
                    <td>Sexo</td>
                    <td>E-mail</td>
                    <td>Nível de Acesso</td>
                    <td>Data de Cadastro</td>
                    <td>Ação</td>
                    <td>Saldo</td>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($linha as $l => $mostra) {
                    extract($mostra);
                    ?>

                    <tr style="white-space: nowrap">
        <!--		<td><?php echo $mostra['nome']; ?></td>-->
                        <td><?php echo $nome; ?></td>
                        <td><?php echo $mostra['sobrenome']; ?></td>
                        <td><?php echo $mostra['login']; ?></td>
                        <td><?php echo ($mostra['sexo'] == 1 ? $s[0] : $s[1]); ?></td>
                        <td><?php echo $mostra['email']; ?></td>
                        <td><?php echo ($mostra['niveldeacesso'] == 1 ? $acs[0] : $acs[1]); ?></td>
                        <td><?php
                            $d = explode(" ", $mostra['datadecadastro']);
                            $data = explode("-", $d[0]);
                            echo "$data[2]/$data[1]/$data[0] às $d[1]";
                            ?></td>
                        <td style="align-items:center">

                            <a href="index.php?p=editar&usuario=<?php echo $mostra['codigo']; ?>">
                                <button type="button" class="btn btn-xs btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </a> 
                            <span>| |</span>
                            <a href="javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $mostra['nome']; ?>?'))
                               location.href='index.php?p=deletar&usuario=<?php echo $mostra['codigo']; ?>';">
                                <button type="button" data-bind="click: $parent.remove" class="remove-news btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
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
<!--    <div class="panel-footer">
      <div class="col-xs-3"><div class="dataTables_info" id="example_info">Exibindo 01 - 10 de 100</div></div>
    <div class="col-xs-6">
<div class="dataTables_paginate paging_bootstrap">
<ul class="pagination pagination-sm" style="margin:0 !important"><li class="prev disabled"><a href="#">← Ant</a></li>
<li class="active"><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li class="next disabled"><a href="#">Prox → </a></li></ul>
</div>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
    10 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" style="min-width: 0px ">
    <li><a href="#">5</a></li>
    <li class="active"><a href="#">10</a></li>
    <li><a href="#">15</a></li>
    <li><a href="#">15</a></li>
  </ul>
  <span>Itens por página </span>
</div>
  </div>-->
</div>