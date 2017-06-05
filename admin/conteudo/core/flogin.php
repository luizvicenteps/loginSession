<!--<div class="container"><a href="index.php"> <img src="img/logo250x241.png" class="logo"></a></div>-->
<div class="container" style="margin-top:30px">

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Olá! </strong></h3>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Esqueceu a senha?</a></div>
            </div>

            <div class="panel-body">
                <form role="form" name="session" action="conteudo/core/validatelogin.php" method="post" >
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

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login" type="text" class="form-control" name="login" value="" placeholder="Login ou E-mail">                                        
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="senha" type="password" class="form-control" name="senha" placeholder="senha">
                    </div>

                    <div class="input-group">
                        <div class="checkbox" style="margin-top: 0px;">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Lembrar
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Entrar</button>

                    <hr style="margin-top:10px;margin-bottom:10px;" >

                    <div class="form-group">

                        <div style="font-size:85%">
                            Novo? 
                            <a href="index.php?p=newUser" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                Cadastre-se aqui! 
                            </a>
                        </div>

                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>