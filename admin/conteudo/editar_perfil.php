<?php
error_reporting(0);

	if(!isset($_GET['usuario']))
		echo "<script> alert('Codigo invalido.'); location.href='index.php?p=painel&padm=usuarios'; </script>";
	else{   
                extract($_POST);
                $cod_sessao = $_SESSION['codigo'];
                $sql_code = "SELECT codigo, email FROM t_users WHERE codigo <> '$cod_sessao' AND email = '$email'";        
                $sql_query = $PDO->query($sql_code);

                $usu_codigo = intval($_GET['usuario']);
                extract($_POST);

                if (isset($_POST['enviarnew'])) {
                    
//		if (strlen($senha) < 8 || strlen($senha) > 16)
//                $erro[] = "Preencha a senha corretamente.";
//
//                if ($senha != $rsenha)
//                $erro[] = "As senhas não batem.";
                if(substr_count($email, '@') != 1 || substr_count($email, '.') < 1 || substr_count($email, '.') > 2)
                    $erro[] = "Preencha o e-mail corretamente.";
                if($sql_query->rowCount() > 0 )
                $erro[] = "E-mail utilizado por outro usuário.";
                // 3 - Inserção no Banco e redirecionamento
                if (count($erro) == 0) {
                    
                
                $sql_code = "UPDATE t_users SET
                            nome = '$_POST[nome]', 
                            sobrenome = '$_POST[sobrenome]', 
                            email = '$_POST[email]', 
                            apelido = '$_POST[apelido]', 
                            sexo = '$_POST[sexo]' 
                            WHERE codigo = '$usu_codigo'";
                    
                $PDO->query($sql_code);
                    $sql_code = "SELECT * FROM t_users WHERE email = '$email'";        
                    $sql_query = $PDO->query($sql_code);
                    foreach ($sql_query as $key => $userlogado){
                    session_start();
                    $_SESSION['codigo'] = $userlogado['codigo'];
                    $_SESSION['nome'] = $userlogado['nome'];
                    $_SESSION['sobrenome'] = $userlogado['sobrenome'];
                    $_SESSION['niveldeacesso'] = $userlogado['niveldeacesso'];
                    $_SESSION['email'] = $userlogado['email'];
                    $_SESSION['apelido'] = $userlogado['apelido'];
                    }
                echo "<script> location.href='index.php?p=painel&padm=usuarios'; </script>";
		}

                }else{

		$sql_code = "SELECT * FROM t_users WHERE codigo = '$usu_codigo'";
                $sql_query = $PDO->query($sql_code);
                $linha = $sql_query->fetchAll(PDO::FETCH_ASSOC);		
                //$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
		//$linha = $sql_query->fetch_assoc();
                foreach ($linha as $l => $mostra) {
		//if(!isset($_POST))
                $_POST[nome] = $mostra['nome'];
		$_POST[sobrenome] = $mostra['sobrenome'];
		$_POST[email] = $mostra['email'];
		$_POST[apelido] = $mostra['apelido'];
		$_POST[sexo] = $mostra['sexo'];
		}

	}

?>

<h1>Editar Usuário</h1>
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

<form class="form-horizontal" action="index.php?p=painel&padm=editar_perfil&usuario=<?php echo $usu_codigo;?>" method="POST" enctype="multipart/form-data" >
    <fieldset>

        <!-- Form Name -->
        <legend>Alterar Informações Pessoais</legend>

        <!-- Text input-->
        <div class="form-group">
             <div class="text-center">
                 <img src="<?php echo $_SESSION['foto_perfil']?>" style="height: 100px" class="avatar img-circle" alt="avatar">
         
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
                <button id="enviarnew" name="enviarnew" class="btn btn-info">Enviar</button>
            </div>
        </div>
        <div class="form-group">
             
            <span>(*) Obrigatório</span>
            <div class="col-md-4">
             
            </div>
        </div>

    </fieldset>
    
    
</form>

<?php } ?>