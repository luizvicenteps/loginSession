<?php

error_reporting(0);



    if(!isset($_GET['usuario']))

        echo "<script> alert('Codigo invalido.'); location.href='index.php?p=painel&padm=usuarios'; </script>";

    else{   
                $cod_usuario = intval($_GET['usuario']);

                if (isset($_POST['enviarnew'])) {
                    
                    $sql_code = "SELECT codigo, email FROM t_users WHERE codigo <> '$cod_usuario' AND email = '$_POST[email]'";        
                    $sql_query_user = $PDO->query($sql_code);

                    if(substr_count($_POST[email], '@') != 1 || substr_count($_POST[email], '.') < 1 || substr_count($_POST[email], '.') > 2){
                        $erro[] = "Preencha o e-mail corretamente.";
                    }

                    if($sql_query_user->rowCount() > 0 ){
                        $erro[] = "E-mail utilizado por outro usuário.";    
                    }

                    

                    // 3 - Inserção no Banco e redirecionamento

                    if (count($erro) == 0) {
                        $sql_update = "UPDATE t_users SET

                                    nome = '$_POST[nome]', 

                                    sobrenome = '$_POST[sobrenome]', 

                                    email = '$_POST[email]', 

                                    apelido = '$_POST[apelido]', 

                                    sexo = '$_POST[sexo]' 

                                    WHERE codigo = '$cod_usuario'";

                            

                        $PDO->query($sql_update);
                        header("Location: index.php?p=painel&padm=usuarios"); //localhost
                        echo "<script> location.href='index.php?p=painel&padm=usuarios'; </script>"; //locaweb
                    }



                    }else{
                            $sql_code = "SELECT * FROM t_users WHERE codigo = '$cod_usuario'";
                            $sql_query = $PDO->query($sql_code);
                            $linha = $sql_query->fetchALL(PDO::FETCH_ASSOC);        

                            foreach ($linha as $l => $mostra) {
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



<form class="form-horizontal" action="index.php?p=painel&padm=editar&usuario=<?php echo $cod_usuario;?>" method="POST" enctype="multipart/form-data" >

    <fieldset>



        <!-- Form Name -->

        <legend>Alterar Informações Pessoais</legend>



        <!-- Text input-->

        <div class="form-group">

             <div class="text-center">

          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">

         

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