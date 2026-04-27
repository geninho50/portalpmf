
<!doctype html>
<html lang='pt-BR'>
  <head>
    <meta charset="UTF-8">
    <title>Franklin Cascaes</title>
    <link rel="stylesheet" href="http://www.pmf.sc.gov.br/sistemas/Cultura/EscolaLivreArtes/css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://www.pmf.sc.gov.br/sistemas/Cultura/EscolaLivreArtes/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>
  
  <body>
    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-12">
                <img src="<? print $_GET['localImagem']; ?>pmf2.png" width='30%' height='30%' class="pmf"> 
            </div> 
			<!--
            <div class="col-md-6">
                <img src="<? print $_GET['localImagem']; ?>fcc.png" class="fcc"> 
            </div>
			-->
        </div>

 <br>
 <br>
 <br>
   <?  if( $_GET['codigoPessoa'] !=''){ ?>
			<h4>Sua atualização foi realizada com <b>sucesso</b>!!</h4>
   <?  }else{?>
			<h4>Sua inscrição foi realizada com <b>sucesso</b>!!</h4>
   <?  } ?>
        <h4><font color="red">Seu número de inscrição:</font><br /> </h4>
       <h4></h4><h3 align="center"><Strong><font color="red" size="30"><? print $_GET['codigoprojeto'].$_GET['codigo']; ?></font></Strong></h3>
       <br>
       <br><br>
		
       <p>Qualquer alteração na ficha de inscrição deve ser solicitado por email, junto com o codigo de inscrição, para: <font color="red"><strong>escolalivredeartesffc@gmail.com</strong></font></p>
       <p>Dúvidas e informações: <font color="red"><? print $_GET['telefone']; ?></font></p>
       <br><br>


         <input type="button" id="btnImprimir" value="Imprimir" onclick="window.print();">
</div>  

</body>

  </html>