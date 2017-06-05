<?php
error_reporting(0);


$arquivo = $_FILES['foto'];
extract($_POST);

if (isset($_POST['enviar'])) {

    $sql_code = "SELECT email FROM t_users WHERE email = '$email'";
    $sql_query = $PDO->query($sql_code);

    if (strlen($senha) < 8 || strlen($senha) > 16)
        $erro[] = "Preencha a senha corretamente.";
    if ($senha != $rsenha)
        $erro[] = "As senhas não batem.";
    if (substr_count($email, '@') != 1 || substr_count($email, '.') < 1 || substr_count($email, '.') > 2)
        $erro[] = "Preencha o e-mail corretamente.";
    if ($sql_query->rowCount() > 0)
        $erro[] = "E-mail já cadastrado.";
    // 3 - Inserção no Banco e redirecionamento
    if (count($erro) == 0) {
        if (isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false) {
            move_uploaded_file($arquivo['tmp_name'], 'uploads/perfil/' . $arquivo['name']);
        }

        $senha = md5($_POST['senha']);

        $sql_code = "INSERT INTO t_users (
				nome, 
				sobrenome, 
                                apelido,
				email, 
				senha, 
				sexo, 
				datadecadastro)
				VALUES(
				'$nome',
				'$sobrenome',
				'$apelido',
				'$email',
				'$senha',
				'$sexo',
				NOW()
				)";

        if ($PDO->query($sql_code)) {
            unset($_POST);
//            header("Location: index.php");
            header("Location: index.php?p=painel&padm=usuarios");
        } else {
            echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
            <strong> Falha na conexão com o Banco de Dados </strong><br></div>";
        }
    }
}
?>
<div class="container" style="margin-top:30px">

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Cadastro! </strong></h3>
                <!--                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Esqueceu a senha?</a></div>-->
            </div>
            <div class="panel-body">
                <form role="form" name="session" action="validatecad.php" method="post" >
                    
<?php
if (isset($_GET['r'])) {
    if (($_GET['r'] == '0')) {


        echo '  <div class="alert alert-danger">
                    <a class="close" data-dismiss="alert" href="#">×</a>Usuário e/ou senha Incorreto!
                    </div>';
    }
    if (($_GET['r'] == '1')) {


        echo '  <div class="alert alert-danger">
                    <a class="close" data-dismiss="alert" href="#">×</a>Por favor, faça login!
                    </div>';
    }
}
?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-12">
                                <div style="margin-bottom: 12px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" value="" placeholder="E-mail">                                        
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div style="margin-bottom: 12px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="nome" type="text" class="form-control" name="nome" value="" placeholder="Nome">                                        
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div style="margin-bottom: 12px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="sobrenome" type="text" class="form-control" name="sobrenome" value="" placeholder="Sobrenome">                                        
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div style="margin-bottom: 12px; margin-top: 12px" class="input-group">
                                    <label style="font-size:85%"> Regra da senha</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div style="margin-bottom: 12px; " class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="senha" type="password" class="form-control" name="senha" placeholder="Digite sua senha">
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div style="margin-bottom: 12px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="rsenha" type="password" class="form-control" name="rsenha" placeholder="Repita sua senha">
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">

                                <div class="checkbox" style="margin-top: 10px; font-size:85%">
                                    <label>
                                        <input id="aceito" type="checkbox" name="aceito" value="1"> Aceito todos os <a href="#">
                                            <strong>Termos</strong>
                                        </a>.
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-offset-5 col-sm-2 text-center">
                                    <div class="btn-group" data-toggle="buttons">
                                        <button id="enviar" type="submit" class="btn btn-success" style="width: 100px; padding: -50%">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>