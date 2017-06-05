<?php
error_reporting(0);
include 'core/session.php';
        
        
extract($_POST);
        
if (isset($_POST['enviar'])) {

    if (strlen($senha) < 8 || strlen($senha) > 16)
        $erro[] = "Preencha a senha corretamente.";

    if ($senha != $rsenha)
        $erro[] = "As senhas não batem.";
    if(substr_count($email, '@') != 1 || substr_count($email, '.') < 1 || substr_count($email, '.') > 2)
			$erro[] = "Preencha o e-mail corretamente.";

    // 3 - Inserção no Banco e redirecionamento
    if (count($erro) == 0) {

        $senha = md5($_SESSION['senha']);

        $sql_code = "INSERT INTO t_users (
				nome, 
				sobrenome, 
                                login,
				email, 
				senha, 
				sexo, 
				datadecadastro)
				VALUES(
				'$nome',
				'$sobrenome',
				'$login',
				'$email',
				'$senha',
				'$sexo',
				NOW()
				)";
         
        if ($PDO->query($sql_code)) {
            unset($_POST);
//            header("Location: index.php");
            header("Location: index.php?p=usuarios");
            
        }  else {
            echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
            <strong> Falha na conexão com o Banco de Dados </strong><br></div>";
        }
    }
}
?>

<h1>Cadastrar Usuário</h1>
<?php
if (count($erro) > 0) {
    echo "<div class='erro'>";
    foreach ($erro as $valor)
        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
    <strong> $valor </strong><br></div>";

    echo "</div>";
}
?>
<!--<a href="index.php?p=usuarios">< Voltar</a>-->


<a href="javascript:window.history.go(-1)">Voltar</a>
<form class="form-horizontal" action="index.php?p=cadastrar" method="POST">
    <fieldset>

        <!-- Form Name -->
        <legend>Novo Usuário</legend>



        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="nome">*Nome:</label>  
            <div class="col-md-4">
                <input id="nome" name="nome" value="<?php echo $_POST[nome]; ?>" type="text"  placeholder="" class="form-control input-md" required  ="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="sobrenome">*Sobrenome:</label>  
            <div class="col-md-4">
                <input id="sobrenome" name="sobrenome" value="<?php echo $_POST[sobrenome]; ?>" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="login">*Login: </label>  
            <div class="col-md-4">
                <input id="login" name="login" value="<?php echo $_POST[login]; ?>" type="text" placeholder="" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">*E-mail:</label>  
            <div class="col-md-4">
                <input id="email" name="email" value="<?php echo $_POST[email]; ?>" type="email" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="sexo">*Sexo:</label>
            <div class="col-md-2">
                <select id="sexo" name="sexo" class="form-control" >
                    <option value="#">Selecione</option>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                </select>
            </div>
        </div>


        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="senha">*Senha:</label>
            <div class="col-md-4">
                <input id="senha" name="senha" value="<?php echo $_SESSION[senha]; ?>" type="password" placeholder="" class="form-control input-md" required="">
                <span class="help-block">Mín-8  /  Máx-16</span>
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="repetesenha">*Repita Senha:</label>
            <div class="col-md-4">
                <input id="rsenha" name="rsenha" value="<?php echo $_SESSION[rsenha]; ?>" type="password" placeholder="" class="form-control input-md" required="">

            </div>
        </div>



        <!-- Multiple Checkboxes (inline) -->
        <!--<div class="form-group">
          <label class="col-md-4 control-label" for="termos">Concordo com os termos.</label>
          <div class="col-md-4">
            <label class="checkbox-inline" for="termos-0">
              <input type="checkbox" name="termos" id="termos-0" value="1">
              Sim
            </label>
          </div>
        </div>-->

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="enviar"></label>
            <div class="col-md-4">
                <button id="enviar" name="enviar" class="btn btn-info">Enviar</button>
            </div>
        </div>
        <div class="form-group">
             
            <span>(*) Obrigatório</span>
            <div class="col-md-4">
             
            </div>
        </div>

    </fieldset>
    
</form>
