<?php
error_reporting(0);
extract($_POST);

if (isset($_POST['enviar'])) {
    include '../../classe/conexao.php';
    $sql_code = "SELECT email FROM t_users WHERE email = '$email'";
    $sql_query = $PDO->query($sql_code);

//    if (strlen($senha) < 8 || strlen($senha) > 16)
//        $erro[] = "Preencha a senha corretamente.";
    if ($senha != $rsenha)
        $erro[] = "As senhas não batem.";
    if (substr_count($email, '@') != 1 || substr_count($email, '.') < 1 || substr_count($email, '.') > 2)
        $erro[] = "Preencha o e-mail corretamente.";
    if ($sql_query->rowCount() > 0)
        $erro[] = "E-mail já cadastrado.  <a href='index.php'>Login</a>";
    // 3 - Inserção no Banco e redirecionamento
    if (count($erro) == 0) {
        if (isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false) {
            move_uploaded_file($arquivo['tmp_name'], 'uploads/perfil/' . $arquivo['name']);
        }

        $senha = md5($email);

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
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
            <strong> Falha na conexão com o Banco de Dados </strong><br></div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head> 
        <?PHP include '../include/header.php'; ?>
        <!--        <link href="../../style/style.css" rel="stylesheet" type="text/css">
        
                 Incluindo o CSS do Bootstrap 
                <link href="../../style/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
                <link href="../../style/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen"> 
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" href="../../style/css/bootstrap.css">
                
                <script type="text/javascript" src="../../style/js/bootstrap.js"></script>
        
                 Website CSS style 
        
        -->
        <!--         Website Font style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <!--Google Fonts--> 
        <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

        <title>Admin</title>
    </head>
    <body>


        <div class="container" style="margin-top:30px">

            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  ">
                <div class="panel panel-default">

                    <div class="panel-heading"><h3 class="panel-title"><strong>Registre-se! </strong></h3>
                        <div style="float:right; font-size: 90%; position: relative; top:-10px"> <a href="index.php">Login</a></div>
                    </div>           


                    <div class="panel-body" style="padding: 10px">

                        <form role="form" class="form-horizontal" method="post" action="index.php?p=newUser">
                            <?php
                            if (count($erro) > 0) {
                                echo "<div class='erro'>";
                                foreach ($erro as $valor) {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<button type='button' class='close' data-dismiss='alert'>×</button>";
                                    echo "<strong> $valor </strong><br></div>";
                                }
                                echo "</div>";
                            }
                            ?>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                <label for="name" class="cols-sm-2 control-label">Seu Nome</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $_POST[nome]; ?>" name="nome" id="nome"  placeholder="Insira seu Nome" required=""/>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-md-4 "> </div>-->

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 col-lg-12">

                                <label for="name" class="cols-sm-2 control-label">Seu Sobrenome</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $_POST[sobrenome]; ?>" name="sobrenome" id="sobrenome"  placeholder="Insira seu Sobrenome" required=""/>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group col-md-12 col-xs-12">
                                <label for="email" class="cols-sm-2 control-label">Seu E-mail</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" value="<?php echo $_POST[email]; ?>" name="email" id="email"  placeholder="Ex. usuario@email.com" required="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <label class="cols-sm-2 control-label" for="sexo">*Sexo:</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-male fa" aria-hidden="true"></i></span>
                                    <select id="sexo" name="sexo" class="form-control" required="">
                                        <option value="#">Selecione</option>
                                        <option value="1" <?php if ($_POST[sexo] == 1) echo "selected"; ?> >Masculino</option>
                                        <option value="2" <?php if ($_POST[sexo] == 2) echo "selected"; ?> >Feminino</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  col-md-12 col-xs-12">
                                <label for="apelido" class="cols-sm-2 control-label">Apelido</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $_POST[apelido]; ?>" name="apelido" id="apelido"  placeholder="Como quer ser tratado ?" required="" />
                                    </div>
                                </div>
                            </div>

<!--                            <div class="form-group col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                <label for="password" class="cols-sm-2 control-label">Sua Senha</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="senha" id="senha"  placeholder="Min 8 - Max 16"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                <label for="confirm" class="cols-sm-2 control-label">Repita a Senha</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="rsenha" id="rsenha"  placeholder="Confirme sua senha"/>
                                    </div>
                                </div>
                            </div>-->
                            <div id="remember" class="checkbox col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                                <label>
                                    <input type="checkbox" value="remember-me"> Aceita <a href="#"> Termos?</a> 
                                </label>
                            </div>

                            <div class="col-md-4 col-md-offset-4 col-xs-3 col-xs-offset-4" style="min-width: 120px;">
                                <button id="enviar" name="enviar" class="btn btn-primary btn-lg btn-block login-button">Enviar</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>

        <script type="text/javascript" src="../../style/js/bootstrap.js"></script>
    </body>
</html>