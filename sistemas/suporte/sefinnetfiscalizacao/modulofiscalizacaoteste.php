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
  <title>TESTE MODULO FISCALIZACAO</title>
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
<body onload="carregaModulo();">



  <div class="loader" style="position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color:#435E95 ">
    
</div>

  <?php
    include("/home/www/layout/menus/menu_geral.php");
    echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
?>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="/home/www/layout/themePMF/css/style.css">

<a type="button" class="btn btn-primary botao" href="/tutorialfiscalizacao.php" style="color: white;margin-left: 60px ;margin-top: 20px;margin-bottom: 10px">Retornar</a>
<button type="button" onclick= "exibeQuestionario();" class="btn btn-primary botao" style="color: white;margin-left: 60px ;margin-top: 20px;margin-bottom: 10px; height: 60px">Exibir Questionario 📝</button>
<br>

<div style="margin-left: 60px;">Seu progresso:</div>
<div style="background:grey; width: 25%; margin-left: 60px;height:10px">
          <div style="width:0%;background:green;text-align:center; height:100%;" id="barra"></div>
      </div>

<br>

      <button type="button"  onclick= "mudaExibicao();" style="background: #bababa;margin-left: 60px">Modo Exibição: <span id="modoExibicao">Lista</span></button>



  <div id="modulo1" style="display: center">
    <center><h3 text>MODULO I - Processo de Fiscalização</h3></center>
    <br>

    <div class="questionario" style="display: none;margin-left: 20px;margin-right: 40px">
     
      <? echo $questoesModulo1; ?>

    </div>


 <div class= "videoContainer" style="grid-template-columns: auto auto auto;" align="center">


  <div>
    <video id= "video1"  onplay="inicioVideo(1,1)" onended="completaVideo(1,1);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/emitirordem.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 01 - Emitir Ordem de Serviço</h4>
  </div>


  <div>
    <video id="video2" onplay="inicioVideo(1,2)" onended="completaVideo(1,2);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/solicitarordem.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 02 - Solicitar Ordem de Serviço</h4>
  </div>



   <div>
    <video id="video3" onplay="inicioVideo(1,3)" onended="completaVideo(1,3);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoinicio.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 03 - Emitir Termo de Inicio</h4>
  </div>


  <div>
    <video id="video4" onplay="inicioVideo(1,4)" onended="completaVideo(1,4);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoprorrog.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 04 - Emitir Termo de Prorrogação</h4>
  </div>

  <div>
    <video id="video5" onplay="inicioVideo(1,5)" onended="completaVideo(1,5);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoencerramento.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 05 - Emitir Termo de Encerramento</h4>
  </div>

  <div>
    <video id="video6" onplay="inicioVideo(1,6)" onended="completaVideo(1,6);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/quadrotermo.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 06 - Visualizar Quadro de Acompanhamento</h4>
  </div>

    <div>
    <video id="video7" onplay="inicioVideo(1,7)" onended="completaVideo(1,7);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/intimacao.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 07 - Como Emitir uma Intimação</h4>
  </div>

  <div>
    <video id="video8" onplay="inicioVideo(1,8)" onended="completaVideo(1,8);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/auto.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 08 - Como emitir um Auto de Infração</h4>
  </div>


   <div>
    <video id="video9" onplay="inicioVideo(1,9)" onended="completaVideo(1,9);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/circunstanciado.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 9 - Como Emitir Termo Circunstanciado</h4>
  </div>


   <div>
    <video id="video10" onplay="inicioVideo(1,10)" onended="completaVideo(1,10);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/papeis.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 10 - Anexar Papeis de trabalho</h4>
  </div>





</div>

</div>

<div id = "modulo2" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>
</div>

<div id = "modulo3" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">

</div>

</div>

<div id = "modulo4" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo5" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo6" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo7" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo8" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo9" style="display:center;">
  <center><h3 text>MODULO IX - Construção Civil</h3></center>


  <br>

  <div class="questionario" style="display: none;margin-left: 20px;margin-right: 40px">
     
      <? echo $questoesModulo9; ?>

    </div>

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">

  <div>
    <video id= "video11"onplay="inicioVideo(9,11)" onended="completaVideo(9,11);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/cnaegifst.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 01 - Como configurar um CNAE para GIF ST PF</h4>
  </div>



  <div>
    <video  id="video12" onplay="inicioVideo(9,12)" onended="completaVideo(9,12);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/matriculacei.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 02 - Visualizar Declarações por Matrícula CEI</h4>
  </div>

</div>

</div>

<div id = "modulo10" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">


</div>

</div>

<div id = "modulo11" style="display:center;">

 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">

<div>
    <video onended="acabou(2);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/painelorgao.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4 id="video2">Aula 01 - Painel Gerencial para Orgãos Públicos</h4>
  </div>

  <div>
    <video onended="acabou(2);" poster="videosrastreabilidade/thumbnail.png" width="520"  height="440"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/manuorgao.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4 id="video2">Aula 02 - Manutenção de Orgãos Públicos</h4>
  </div>

</div>

</div>

<div id = "modulo12" style="display:center;">

   <center><h3 text>MODULO XII - Administração aplicada à GFIS</h3></center>

    <div class="questionario" style="display: none;margin-left: 20px;margin-right: 40px">


<? echo $questoesModulo12; ?>

</div>


   <center><h5 text>Clique nos links para download:</h5></center>
 <div class= "videoContainer" style="grid-template-columns: auto auto auto;"align="center">
  <div>
  <img src="videosrastreabilidade/comunicacao.png" alt="Smiley face" height="420" width="580">
  <a href="videosrastreabilidade/COMUNICAÇÃO POSITIVA.pdf" download><h4> <u>Comunicação Positiva</u></h4></a><br>
  </div>
  <div>
  <img src="videosrastreabilidade/planejamento.jpg" alt="Smiley face" height="420" width="520">
  <a href="videosrastreabilidade/PLANEJAMENTO ESTRATÉGICO APLICADO À GFIS.pdf" download> <h4><u>Administração aplicada à GFIS</u></h4></a>
  </div>

</div>
</div>

</div>


<br>







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
/*

//in progress
    var progresso = 0;
    var videosCompletados =[];
function acabouVideoExibeProgresso(modulo,idVideo){

      switch(modulo) {
        case 1:
          
          if(verificaArray("video"+idVideo)){
            videosCompletados.push("video"+idVideo);
            //document.getElementById("video"+idVideo).style.backgroundColor = "#76a277";
            document.getElementById("video"+idVideo).style.border = "thick solid #76a277"
            progresso+=10;
          }
     
        break;
        case 9:
          if(verificaArray("video"+idVideo)){
            videosCompletados.push("video"+idVideo);
            //document.getElementById("video"+idVideo).style.backgroundColor = "#76a277";
            document.getElementById("video"+idVideo).style.border = "thick solid #76a277"
            progresso+=50;
          }
    
        break;
        default:
    
      }
      console.log(videosCompletados);
      document.getElementById("barra").style.width =progresso +"%";
    }

function verificaArray(idVideo){
   var i;
    for (i = 0; i < videosCompletados.length; i++) {
        if (videosCompletados[i] === idVideo) {
            return false;
        }
    }

    return true;
}

function inicioVideo(modulo,video){
  //alert("Modulo: "+modulo+ " Video:" +video+" ID USER: "+ <?echo $_SESSION["idUsuario"]?>);


    var idUsuario =  <?echo $_SESSION["idUsuario"]?>;

      $.ajax({
            url: "/sistemas/suporte/banco/aulas_fiscalizacao.php",
            type: "POST",
            data: "idUsuario="+idUsuario+"&modulo="+modulo+"&numAula="+video+"&tipo=iniciar",
            dataType: "html"
        }).done(function(resposta) {  
         // alert(resposta);
            console.log('sucesso');
        }).fail(function(jqXHR, textStatus ) {
            console.log('fail');
        }).always(function() {
            console.log('ok');
        });
}

function completaVideo(modulo,video){
    //alert("Modulo: "+modulo+ " Video:" +video+" ID USER: "+ <?echo $_SESSION["idUsuario"]?>);

    acabouVideoExibeProgresso(modulo,video);
    var idUsuario =  <?echo $_SESSION["idUsuario"]?>;

      $.ajax({
            url: "/sistemas/suporte/banco/aulas_fiscalizacao.php",
            type: "POST",
            data: "idUsuario="+idUsuario+"&modulo="+modulo+"&numAula="+video+"&tipo=inserir",
            dataType: "html"
        }).done(function(resposta) {  
         // alert(resposta);
            console.log('sucesso');
        }).fail(function(jqXHR, textStatus ) {
            console.log('fail');
        }).always(function() {
            console.log('ok');
        });
}
*/

//chamado no onbodyload
function carregaModulo(){


  const loader = document.querySelector(".loader");
  loader.className += " hidden"; 


  var header = document.getElementsByClassName("header");
  var miniHeader = document.getElementsByClassName("mini-header");
  header[0].style.display="none";
  miniHeader[0].style.display="none";

   var modulo = "<?php echo $modulo ?>";

   for(var i =1; i<=12; i++){
    
    if(i!=modulo){
      
      try {
       document.getElementById("modulo"+i).style.display ="none";
      }
      catch (e) {
  
      }
    }
   }


    document.getElementById('modoExibicao').click();


}
   
</script>


</body>
</html>
