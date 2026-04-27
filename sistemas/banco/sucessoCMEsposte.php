
<!doctype html>
<html lang='pt-BR'>
  <head>
    <meta charset="utf8">
    <title>Fundação Municipal de Esportes</title>
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
			<div class="col-md-6">
				<img src="http://www.pmf.sc.gov.br/sistemas/backend/img/logo.png"  class="pmf"> 
			</div> 			
			<div class="col-md-6">
				<img src="http://www.pmf.sc.gov.br/sistemas/esportes/images/logo.png" class="fcc"> 
			</div>
        </div>
		<br><br>
		<h4>1ª Conferência Municipal de Esportes</h4>
		<br><br>
        <h4>Sua inscri&ccedil;&atilde;o foi realizada com <b>sucesso</b>!!</h4>
        <h4><font color="red">Seu c&oacute;digo de inscri&ccedil;&atilde;o:</font><br /> </h4>
        <h4></h4><h3 align="center"><Strong><font color="red" size="30"><? print $_GET['codigo']; ?></font></Strong></h3>
        <br><br><br>
        <p><strong><font color="red">Imprima seu comprovante</font></strong> de inscri&ccedil;&atilde;o que dever&aacute; ser <strong><font color="red">apresentado no dia</font></strong> da Conferência.</p>
        <br>
            <strong>
              <a href="../esportes/comprovante.php?codigo=<? print $_GET['codigo'];?>"><button class="btn btn-danger btn-lg btn-block"  role="button">IMPRIMIR</button></a>
           </strong>
        
        <br><br>        
        <p>D&uacute;vidas e informa&ccedil;&otilde;es: <font color="red">984360214<strong> aos cuidados de Fabiano</strong></font></p>
        <br><br>
        <a href="../esportes/">Voltar ao Inicio</a>

		
</div>  

</body>

  </html>