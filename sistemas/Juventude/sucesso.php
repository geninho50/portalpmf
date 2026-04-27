<?php
header('Location: http://www.pmf.sc.gov.br');  
require_once("backend/db-comum.php");

$idcurso = substr($_POST['turno'],0,1);
$nuturma = substr($_POST['turno'],1);

$sqlidturma = "SELECT idturma FROM `juventude`.`turma` WHERE idcurso = '$idcurso' AND nuturma = '$nuturma'";
$resultidturma = $conn->query($sqlidturma);
$resultidturma = $resultidturma->fetch_assoc();
$idturma = $resultidturma['idturma'];

$sqlcurso = "SELECT nmcurso FROM `juventude`.`curso` WHERE idcurso = '$idcurso'";
$resultcurso = $conn->query($sqlcurso);
$resultcurso = $resultcurso->fetch_assoc();
$nmcurso = $resultcurso['nmcurso'];

$sqlturma = "SELECT nuturma, dt1, dt2, hrini, hrfim FROM `juventude`.`turma` WHERE idturma = '$idturma'";
$resultturma = $conn->query($sqlturma);
$resultturma = $resultturma->fetch_assoc();
$nuturma = $resultturma['nuturma'];
$dt1 = $resultturma['dt1'];
$dt2 = $resultturma['dt2'];
$hrini = $resultturma['hrini'];
$hrfim = $resultturma['hrfim'];

?>
<html>
  <head>
    <title>Juventude</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body class="subpage">

            <header id="header">
                <div class="logo"><a href="http://www.pmf.sc.gov.br">Sair</a></div>
            </header>


    <section id="two" class="wrapper style2">
                <div class="inner">
                    <div class="box">

                  <div align="center">
                     <img src="images/capa.png" width="100%">
                  </div>


                        <div class="content">
                            <header class="align-center">
 <br>
 <br>
 <br>
       <h4><b>PARABÉNS</b> você está inscrito no programa Jovem em Ação Floripa!</h4>

       <h3 align="center"><Strong>Seu número de inscrição é: <font color="red" size="30"><? print $_POST['id1']; ?></font></Strong></h3>
       <br>
       <h4>Anote: Data/Horário do CURSO na sua agenda, não falte e não se atrase. 
        <br>
        <font color="red" size="5" align="center">
          <?php echo utf8_encode($nmcurso)." - Turma ".$nuturma." - ".date("d/m/Y",strtotime($dt1))." e ".date("d/m/Y",strtotime($dt2))." - Horário das ".$hrini." as ".$hrfim; ?>
        </font>
       </h4>

       <br>
       <h4><strong>Você irá receber seu material didático via E-mail e confirmação da AULA via WHATASPP 48 horas antes do dia DO CURSO que você se CADASTROU.</strong></h4>
       <br><br>

       <br><br><br>
       <p>Qualquer alteração na ficha de inscrição deve ser solicitado por email, junto com o número de inscrição, para: <font color="red"><strong>juventude@pmf.sc.gov.br</strong></font></p>
       <br><br>


         <input type="button" id="btnImprimir" value="Imprimir" onclick="window.print();">
</div>

</body>

  </html>
