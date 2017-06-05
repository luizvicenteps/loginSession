<?php
error_reporting(0);
	if(!isset($_GET['usuario']))
		echo "<script> alert('Codigo invalido.'); location.href='index.php?p=painel&padm=usuarios'; </script>";
	else{

                $usu_codigo = intval($_GET['usuario']);
                extract($_POST);

                if (isset($_POST['enviarnew'])) {
                    
		if (strlen($senha) < 8 || strlen($senha) > 16)
                $erro[] = "Preencha a senha corretamente.";

                if ($senha != $rsenha)
                $erro[] = "As senhas não batem.";
                
                // 3 - Inserção no Banco e redirecionamento
                if (count($erro) == 0) {
                $senha = md5($_POST['senha']);
                $sql_code = "UPDATE t_users SET
                            senha = '$senha' 
                            WHERE codigo = '$usu_codigo'";
                $PDO->query($sql_code);
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
<form class="form-horizontal" action="index.php?p=painel&padm=editar_senha&usuario=<?php echo $usu_codigo;?>" method="POST" enctype="multipart/form-data" >
    <fieldset>

        <!-- Form Name -->
        <legend>Alterar Senha</legend>

        <!-- Text input-->
        <div class="form-group">
            <div class="text-center">
          <img src="<?php echo $_SESSION['foto_perfil']?>" class="avatar img-circle" alt="avatar">
            </div>            
            <!--<label class="col-md-4 control-label" for="nome">Avatar:</label>-->  
            <div class="col-md-4">
           

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="nome">*Nome:</label>  
            <div class="col-md-4">
                <input id="nome" name="nome" value="<?php echo $_POST[nome]; ?>" type="text"   readonly="" placeholder="" class="form-control input-md" required  ="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="sobrenome">*Sobrenome:</label>  
            <div class="col-md-4">
                <input id="sobrenome" name="sobrenome" value="<?php echo $_POST[sobrenome]; ?>" readonly="" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">*E-mail:</label>  
            <div class="col-md-4">
                <input id="email" name="email" value="<?php echo $_POST[email]; ?>" readonly=""  type="email" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Select Basic -->
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="senha">*NOVA Senha:</label>
            <div class="col-md-4">
                <input id="senha" name="senha" value="<?php echo $_POST[senha]; ?>" type="password" placeholder="" class="form-control input-md" required="">
                <span class="help-block">Mín-8  /  Máx-16</span>
                
            </div>
        </div>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="repetesenha">*Repita NOVA Senha:</label>
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