<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("/home/www/scripts/php/config.php");
require_once("/home/www/scripts/php/funcoes_bd.php");
require_once("/home/www/scripts/php/funcoes.php");
require_once("/home/www/sistemas/suporte/banco/gdb.php");

$drive->conecta();
$menu_principal = "home";
$charset = $_GET["charset"];
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}

if(isset($_GET['modulo'])){
  $modulo = $_GET['modulo'];
}

//test only
$idUsuario = "357";

include 'perguntasfiscalizacao.php';

$db = new gdb();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155089928-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155089928-1');
</script>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dados Usuários</title>
     <?php
     echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/home/www/layout/pmf-estilo.css\">");
    ?>
  <br>

 

  <link rel="stylesheet" href="/home/www/layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="/home/www/layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="/home/www/scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="/home/www/scripts/js/ui/jquery-ui.css">
  <link href="/home/www/layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
  @media (max-width: 960px) {
    video{
      width:100%;
      margin-left: 0% !important;
    }
    #conteudo_pagina{
      margin-left: 10px !important;
      margin-right: 10px !important;
    }

    #popup_novo_site{
      width: 70% !important;
    }
  }

  .loader.hidden {
    animation: fadeOut 1s;
    animation-fill-mode: forwards;
  }

  </style>

</head>
<body onload="carregaUsuarios();">


  <?php
    include("/home/www/layout/menus/menu_geral.php");
    echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
?>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="/home/www/layout/themePMF/css/style.css">







<script src="/home/www/layout/themePMF/js/slick.min.js"></script>

<script src="/home/www/layout/themePMF/js/main.min.js"></script>

<?php include_once('/home/www/footerRastreabilidade.php'); ?>

<script src="layout/themePMF/js/home.min.js"></script>

<script>

var exibeComoLista = true;

var videoContainer = document.getElementsByClassName("videoContainer");


 var modulo = "<?php echo $modulo ?>";

function mudaExibicao(){
  exibeComoLista = !exibeComoLista;

  if(!exibeComoLista){
      videoContainer[modulo-1].style.display = "grid";
      document.getElementById("modoExibicao").innerHTML = "Grade";
  }else{
      videoContainer[modulo-1].style.display = "list-item";
      document.getElementById("modoExibicao").innerHTML = "Lista";
  }
}

var mostraQuestionario = false;
function exibeQuestionario(){
    
    mostraQuestionario =!mostraQuestionario;
    var questionarios = document.getElementsByClassName('questionario');
    
    if(mostraQuestionario){
    for(var i = 0; i < questionarios.length; i++) { 
        questionarios[i].style.display='block';
        }
    }else{
       for(var i = 0; i < questionarios.length; i++) { 
          questionarios[i].style.display='none';
        }
    }
}

//chamado no onbodyload
function carregaModulo(){




}
   
</script>


</body>
</html>
