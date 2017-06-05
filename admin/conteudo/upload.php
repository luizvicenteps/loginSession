
<h1>Editar Usuário</h1>
<form method="post" action="index.php?p=painel&padm=recebe_upload" enctype="multipart/form-data">
    <fieldset>
<legend>Alterar Informações Pessoais</legend>

        <!-- Text input-->
        <div class="form-group">
             <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
         
            </div>  
            <label class="col-md-4 control-label" for="nome">Avatar:</label>  
            <div class="col-md-4">
                <input type="file" name="arquivo" class="form-control input-md"/>

            </div>
        </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="enviar"></label>
            <div class="col-md-4">
                <button id="enviarnew" name="enviarnew" class="btn btn-info">Enviar</button>
            </div>
        </div>
  

  </fieldset>
</form>