<?php
include_once("backend/gdb.php");

$gdb = new gdb();

$idpalestra = $gdb->vargetpost("idpalestrahidden");

$gdb->open("SELECT nome_palestra, data, horario 
              FROM palestras 
              WHERE idpalestra IN ($idpalestra) ");

$nome_palestra = $gdb->gs["NOME_PALESTRA"];

?>
<html>

<head>
  <title>Palestras</title>
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
          <img style="object-fit:cover; object-position: 0 30%; height: 400px;" src="images/capa.jpg" width="100%">
        </div>

        <br><br>

        <h3>Sua inscrição foi realizada com <b>sucesso</b>!</h3>
        <br>
        <h3 style="color: red; font-weight: bold;">ATENÇÃO!! Anote as palestras em que você está inscrito para não esquecer!</h3>
        <br>
        <h4>Você está inscrito(a) nas palestras: </h4>
        <br>
        
        <?php
		  	foreach ($gdb->gs["NOME_PALESTRA"] as $key => $value) {?>
        <h4> 
          <?= $value." <br> ".date("d/m/Y",strtotime($gdb->gs["DATA"][$key]))." <br/> ".$gdb->gs["HORARIO"][$key].'<br/>'; ?>
            
          </h4><br />
        
        <?}; ?>
        <br><br>

        <input type="button" class="btn btn-primary botao" id="btnImprimir" value="Imprimir" onclick="window.print();">
      </div>
    </div>
  </section>

  <footer id="footer">
    <div class="copyright">

      <header class="align-center">
        <img src="images/Prefeitura.png" alt="" />
      </header>

    </div>

  </footer>

</body>

</html>