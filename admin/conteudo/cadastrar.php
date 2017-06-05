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
    if(substr_count($email, '@') != 1 || substr_count($email, '.') < 1 || substr_count($email, '.') > 2)
        $erro[] = "Preencha o e-mail corretamente.";
    if($sql_query->rowCount() > 0 )
        $erro[] = "E-mail já cadastrado.";
    // 3 - Inserção no Banco e redirecionamento
    if (count($erro) == 0) {
        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
            move_uploaded_file($arquivo['tmp_name'], 'uploads/perfil/'.$arquivo['name']);
            
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
            
        }  else {
            echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
            <strong> Falha na conexão com o Banco de Dados </strong><br></div>";
        }
    }
}
?>



<h1>Cadastrar Usuário</h1>

<!--<a href="index.php?p=usuarios">< Voltar</a>-->


<!--<a href="javascript:window.history.go(-1)">Voltar</a>-->
<form class="form-horizontal" action="index.php?p=painel&padm=cadastrar" method="POST" enctype="multipart/form-data" >
    <fieldset>

        <!-- Form Name -->
        <legend></legend>
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
        
        <!-- Text input-->
        <div class="form-group">
            <div class="text-center">
          <img src="https://letstalkbitcoin.com/files/avatars/default.jpg" class="avatar img-circle" alt="avatar">
          
          
          
        </div>
            <label class="col-md-4 control-label" for="nome">Avatar:</label>  
            <div class="col-md-4">
                <input type="file" name="foto" class="form-control input-md"/>

            </div>
        </div>
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
            <label class="col-md-4 control-label" for="login">*Apelido: </label>  
            <div class="col-md-4">
                <input id="apelido" name="apelido" value="<?php echo $_POST[apelido]; ?>" type="text" placeholder="" class="form-control input-md" required="">
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
                    <option value="1" <?php if($_POST[sexo] == 1) echo "selected"; ?> >Masculino</option>
                    <option value="2" <?php if($_POST[sexo] == 2) echo "selected"; ?> >Feminino</option>
                </select>
            </div>
        </div>


        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="senha">*Senha:</label>
            <div class="col-md-4">
                <input id="senha" name="senha" value="<?php echo $_POST[senha]; ?>" type="password" placeholder="" class="form-control input-md" required="">
                <span class="help-block">Mín-8  /  Máx-16</span>
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="repetesenha">*Repita Senha:</label>
            <div class="col-md-4">
                <input id="rsenha" name="rsenha" value="<?php echo $_POST[rsenha]; ?>" type="password" placeholder="" class="form-control input-md" required="">

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
