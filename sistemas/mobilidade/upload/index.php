<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke - Upload</title>
    </head>
    <body>
        <h1>Cadastrar Imagem</h1>
        <?php
    //    if(isset($_SESSION['msg'])){
      //      echo $_SESSION['msg'];
        //    unset($_SESSION['msg']);
   //     }
        ?>
     <form action="envia.php" method="post" enctype="multipart/form-data">
     <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    <input name="nome" type="text" class="form-control" style="text-transform: uppercase;" id="nome" placeholder="Nome completo">
                                </div>
                            </div>

	Arquivo: <input type="file" name="arquivo">
	<input type="submit" value="Enviar">
</form>
    </body>
</html>
