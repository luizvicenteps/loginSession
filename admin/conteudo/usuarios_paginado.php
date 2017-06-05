<?php
//$sql_code = "SELECT * FROM t_users";
//$sql_query = $PDO->query($sql_code);
//$linha = $sql_query->fetchAll(PDO::FETCH_ASSOC);

//$s = ["0" => "Masculino", "1" => "Feminino"];
//$acs = ["0" => "Básico", "1" => "Admin"];
	$acs[0] = "Básico";
	$acs[1] = "Admin";
	$s[0] = "Masc";
	$s[1] = "Femi";

//Limita o número de registros a serem mostrados por página
$limite = 3;
//Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
//Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante

$inicio = ($pg * $limite) - $limite;
 
//seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
$sql_code = "SELECT * FROM t_users ORDER BY codigo ASC LIMIT ".$inicio. ",". $limite;        
$sql_query = $PDO->query($sql_code);
$linha = $sql_query->fetchAll(PDO::FETCH_ASSOC);
        
        
        
echo "<h1>Usuários - Conexão PDO</h1>";

?>
<div class="table table-responsive">

    <div style="margin:7px" >
        <div class="col-xs-6">
            <div class="btn-group">
                <a href="index.php?p=painel&padm=cadastrar" class="btn btn-default btn-success">Novo</a>
            </div>
        </div>
        
                    <div id="custom-search-input">
                <div class="input-group col-xs-6 pull-right form-group">
                    <input type="text" class="form-control input-lg" placeholder="Buscar" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        
        
            <!--        <div class="col-xs-6 pull-right form-group">
            <input type="text" class="form-control" style="border-radius:0px" placeholder="Pesquisar">
            </div>-->
    </div>
    <div class="panel-body" style="padding:0px">
        <table class="table table-striped table-bordered" style="margin:0px">
            <thead>
                <tr style="font-weight:bold; text-align: left">
                    <td><strong>Cod</strong></td>
                    <td><strong>Nome</strong></td>
                    <td>Sobrenome</td>
                    <td>Login</td>
                    <td>Sexo</td>
                    <td>E-mail</td>
                    <td>Perfil</td>
                    <td>Data de Cadastro</td>
                    <td>Ação</td>
                    <td>Saldo</td>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($linha as $l => $mostra) {
                    //extract($mostra);
                    ?>

                    <tr style="white-space: nowrap">
        <!--		<td><?php echo $mostra['nome']; ?></td>-->
                        <td><?php echo $mostra['codigo']; ?></td>
                        <td><?php echo $mostra['nome']; ?></td>
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

                            <a href="index.php?p=painel&padm=editar&usuario=<?php echo $mostra['codigo']; ?>">
                                <button type="button" class="btn btn-xs btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </a> 
                            <span>| |</span>
                            <a href="javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $mostra['nome']; ?>?'))
                               location.href='index.php?p=painel&padm=deletar&usuario=<?php echo $mostra['codigo']; ?>';">
                                <button type="button" data-bind="click: $parent.remove" class="remove-news btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </a>
                        </td>
                        <td><?php echo $mostra['saldo']; ?></td>

                    </tr>

                <?php } ?>
<!--                    //PAGINACAO-->
                <?php
                    $sql_Total = 'SELECT codigo FROM t_users';
                    $sql_Total = $PDO->query($sql_Total);
                    $Total = $sql_Total->fetchAll(PDO::FETCH_ASSOC);
                    
                    $qtdPag = ceil(count($Total)/$limite);
//                    echo count($Total).'<br>';
//                    echo $qtdPag;
                ?>
                    
            </tbody>
        </table>
            <div class="panel-footer">
                <div class="row">
                <?php if($qtdPag > 1){?>
                    <div class="col-md-4 col-sm-4"></div>
<!--                    <div class="col-md-4" style="text-align: center" >
                        <span></br>Página <?php echo $pg;?> de <?php echo $qtdPag;?> </span>
                    </div>-->
                  <div class="col-md-4 col-sm-4"  style="text-align: center" >
                    <ul class="pagination">
                        
                    <?php 
                        //Botão Seta pagina anterior
                        if($pg > 1){
                        $beforepg = $pg-1;
                        echo '<li class="page-item"><a href="index.php?p=painel&padm=usuarios&pg=1">««</a></li>';
                        echo '<li class="page-item"><a href="index.php?p=painel&padm=usuarios&pg='.$beforepg.'">«</a></li>';
                            }else{echo '<li class="disabled page-item" style="text-color:red"><a href="">««</a></li>';//Desabilita na primeira página
                            echo '<li class="disabled page-item"><a href="">«</a></li>';}//Desabilita na primeira página

                        //Ativa o botão da pg Atual
                        if($qtdPag > 1 && $pg<= $qtdPag){
                            //Laço de repetição para montar o botão com numero das páginas. Por enquanto sem limite de paginas.
                            for($i=1; $i <= $qtdPag; $i++){
                                if($i==$pg){$classnum = 'active';}else{$classnum = '';}
                                echo '<li class="page-item '.$classnum.'"><a href="index.php?p=painel&padm=usuarios&pg='.$i.'">'.$i.'</a></li>';
                            }
                         }
                        //Botão Seta pagina Posterior
                        if($pg < $qtdPag){
                           $nextpg = $pg+1;
                           echo '<li class="page-item"><a href="index.php?p=painel&padm=usuarios&pg='.$nextpg.'">»</a></li>';
                           echo '<li class="page-item"><a href="index.php?p=painel&padm=usuarios&pg='.$qtdPag.'">»»</a></li>';
                                }else{echo '<li class="disabled page-item"><a href="">»</a></li>';//Desabilita na ultima página
                                      echo '<li class="disabled page-item"><a href="">»»</a></li>';}//Desabilita na ultima página
                    ?>
                    </ul>
                <?php }?>
                    
<!--                    <ul class="pagination visible-xs pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">»</a></li>
                    </ul>-->
                  </div>
                <div class="col-md-4 col-sm-4"></div>
                </div>
            </div>


    </div>

    </div>
