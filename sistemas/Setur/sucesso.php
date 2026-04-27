  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>Projeto Crescendo e Empreendendo - Curso de Perfil Empreendedor</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>

      <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

          <div class="row">
            <div class="col-md-12">
                <img src="img/capa.jpg" class="fcc"> 
            </div> 
        </div>
        </div>
 <br>
 <br>
 <br>
       <h4>Sua inscrição no Curso de Perfil Empreendedor foi realizada com <b>sucesso</b>!!</h4><br><br>

        <h4>Seu número de inscrição:</h4>
       <h4></h4><h3 align="center"><Strong><font color="red" size="30"><? print $_POST['id1']; ?></font></Strong></h3>
       <br>
       <p>Qualquer alteração na ficha de inscrição deve ser solicitado por email, junto com o número de inscrição, para: <font color="red"><strong>sde@pmf.sc.gov.br</strong></font></p>
       <p>Dúvidas e informações: <font color="red">sde@pmf.sc.gov.br / Telefone (48) 3952-7016</font></p>
       <br><br>


         <input type="button" id="btnImprimir" value="Imprimir" onclick="window.print();">
</div>  

</body>

  </html>