<?php

  require_once("/home/www/scripts/php/config.php");

  // DEFINIÇÕES
  // Numero de campos de upload
  $numeroCampos = 6;
  // Tamanho máximo do arquivo (em bytes)
  $tamanhoMaximo = 1024 * 1024 * 50; //10Mb
  // Extensões aceitas
  $extensoes = array(".pdf");
  // Caminho para onde o arquivo será enviado
  $caminho = CAMINHO_SITE."/sistemas/MostraQuintaisCenicos/Pdfs/";
  // Substituir arquivo já existente (true = sim; false = nao)
  $substituir = false;

  $id = $_POST["id1"];

  /*for ($i = 0; $i < $numeroCampos; $i++) {
    
    // Informações do arquivo enviado
    $nomeArquivo = $_FILES["arquivo"]["name"][$i];
    $tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
    $nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
    
    // Verifica se o arquivo foi colocado no campo
    if (!empty($nomeArquivo)) {
    
      $erro = false;
    
      // Verifica se o tamanho do arquivo é maior que o permitido
      if ($tamanhoArquivo > $tamanhoMaximo) {
        $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
      } 
      // Verifica se a extensão está entre as aceitas
      elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
        $erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
      } 
      // Verifica se o arquivo existe e se é para substituir
      elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
        $erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
      }
    
      // Se não houver erro
      if (!$erro) {
        // Move o arquivo para o caminho definido
        // move_uploaded_file($nomeTemporario, ($caminho . $id . "_" . $nomeArquivo));
        move_uploaded_file($nomeTemporario, ( $caminho . $id . "_" . $nomeArquivo) );
        // Mensagem de sucesso
        //echo $caminho . $id . "_" . $nomeArquivo." <br />";
      } 
      // Se houver erro
      else {
        // Mensagem de erro
        echo $erro . "<br />";
      }
    }
  }*/

  ?>

  <head>
    <meta charset="UTF-8">
    <title>2° Mostra Quintais Cênicos</title>
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
        <div class="row">
            <div class="col-md-6">
                <img src="img/logo.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>
 <br>
 <br>
 <br>
       <h4>Sua inscrição no 2° Mostra Quintais Cênicos foi realizada com <b>sucesso</b>!!</h4> 
       <h4>Anote seu número de <b>Inscrição:</b></h4>
       <br>
       <h2><Strong>Seu número de inscrição é <? print $id; ?></b></Strong></h2>

       <br><br><br>
       <p>Qualquer alteração na ficha de inscrição deve ser solicitado por email, junto com o número de inscrição, para: <strong> deptoteatro.fcffc@pmf.sc.gov.br</strong></p>

       <a href="./dadosCadastro.php">Voltar</a> 
</div>


