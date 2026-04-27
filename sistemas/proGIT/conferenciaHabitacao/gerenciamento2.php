<?php
$user = $_POST['user'];
$password = $_POST['password'];
  if($user=="admin" && $password=="#p6&e=(c@x%") {
include_once("../banco/gdb.php");

$gdb = new gdb();

$gdb->open("SELECT
              idinscricaoHabitacao, nome, cpf, nascimento, cpf, email, telefone, instituicao, comunidade, bairro, regiao, segmento
            FROM
              inscricaoHabitacao");
  ?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Seminário</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <div class="page-wrap">
      <nav id="nav">
        <ul>
          <li><a href="index.php"><span class="icon fa-home"></span></a></li>
          <li><a href="inscricao.php" class="active"><span class="icon fa-file-text-o"></span></a></li>
          <li><a href="inscricaoConsulta.php" class="active"><span class="fa fa-search"></span></a></li>
          <li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
          <li><a href="MINUTA_Regimento_Interno_COMHIS_FPOLIS.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
        </ul>
      </nav>
      <?php

  $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
  $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
  $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
  $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
  $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
  $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

  if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
    echo '<section id="main" >
          <section id="banner">
            <div class="inner">
              <h2 style="font-size: 20px;">1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
                <ul class="actions">
                <li><a href="inscricao.php" class="button alt">Inscrições</a></li>
               </ul>
          </div>
        </section>
      <section>';
  }else{
    echo '<section id="main" >
          <section id="banner">
            <div class="inner">
              <h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
               <ul class="actions">
              <!--  <li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
                <li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="button alt scrolly big">Plano Municipal de Habitação de Interesse Social - PMHIS</a></li>
               </ul>
                <ul class="actions">
              <!--  <li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
                <li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li>
               </ul>
          </div>
        </section>
      <section>';  };    ?>

        <section>
          <div class="inner">
            <header>
              <h2 align="center">Inscrições</h2><br/>
            </header>
            <div class="column">
              <table>
                <thead>
                  <tr>
                    <th>Inscricão</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Instituição</th>
                    <th>Comunidade</th>
                    <th>Bairro</th>
                    <th>Região</th>
                    <th>Segmento</th>
                  </tr>
                </thead>
                <tbody>
<?php
                  foreach ($gdb->gs["NOME"] as $key => $value) {
?>
                    <tr style="font-size: 12px">
                      <td><?=$gdb->gs["IDINSCRICAOHABITACAO"][$key]?></td>
                      <td><?=$gdb->gs["NOME"][$key]?></td>
                      <td><?=$gdb->gs["NASCIMENTO"][$key]?></td>
                      <td><?=$gdb->gs["CPF"][$key]?></td>
                      <td><?=$gdb->gs["EMAIL"][$key]?></td>
                      <td><?=$gdb->gs["TELEFONE"][$key]?></td>
                      <td><?=$gdb->gs["INSTITUICAO"][$key]?></td>
                      <td><?=$gdb->gs["COMUNIDADE"][$key]?></td>
                      <td><?=$gdb->gs["BAIRRO"][$key]?></td>
                      <td><?=$gdb->gs["REGIAO"][$key]?></td>
                      <td><?=$gdb->gs["SEGMENTO"][$key]?></td>
                    </tr>
<?php
                  }
?>
                </tbody>
              </table>
            </div>
        </section>

          <!-- Footer -->
            <footer id="footer" style="background-color: #0D1217; width: 100%">
              <div class="copyright">
               <a href="http://www.pmf.sc.gov.br"><img src="images/Prefeitura.png"></a>.
              </div>
            </footer>
    </div>

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.poptrox.min.js"></script>
      <script src="assets/js/jquery.scrolly.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>

      <script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>
      <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>

<script>
</script>
<?php
} else {
  header('location:http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao/');
}
?>
