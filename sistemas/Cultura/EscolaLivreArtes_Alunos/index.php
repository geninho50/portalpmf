<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta charset="UTF-8">
    <title>Franklin Cascaes</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-6">
                <img src="img/pmf2.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>

        <br><br>

        <h1>Formulário de Inscrições para Alunos</h1>

        <div class="row">

        	<div class="col-md-12">
                <form id="frm1" name="frm1" method="post" action="backend/cadastrar.php"; enctype="multipart/form-data">

                    <h2>INFORMAÇÕES</h2><br>

                    <p>Todas as informações prestadas neste formulário serão consideradas verdadeiras e deverão ser comprovadas no momento da matrícula. </p>
                    <p>A inscrição neste formulário não garante a matrícula na Escola Livre de Artes. </p>
                    <p>As vagas serão preenchidas, preferencialmente, por candidatos de baixa renda, residentes em Florianópolis, seguindo os critérios socioeconômicos conforme o Edital. </p>
                    <p>A divulgação da lista com os alunos habilitados para a matrícula será divulgada seguindo o cronograma do Edital. </p>
                    <p>Para efetuar a matrícula o aluno que for classificado deverá levar uma cópia dos documentos solicitados no Edital . </p>
                    <p>Servem como comprovantes de renda: contracheque, declaração de desempregado, declaração de autônomo indicando a média mensal recebida, extrato bancário dos três últimos meses. </p>
                    <p>Servem como comprovantes de endereço: conta de água, luz ou telefone, contrato de aluguel onde conste o nome e endereço, declaração de residência escrita pelo dono do imóvel e reconhecida em cartório. </p><br><br>

                <h2>INSCRIÇÕES</h2><br>
                <div class="col-md-4">
                <a href="maior.php" type="button" class="btn btn-default">MAIOR DE 18 ANOS</a></div>
                <div class="col-md-4">
                <a href="menor.php" type="button" class="btn btn-default">MENOR DE 18 ANOS</a></div>
   
<br><br>

     

</body>

</html>