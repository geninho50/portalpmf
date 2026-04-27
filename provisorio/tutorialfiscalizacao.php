<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
require_once("sistemas/suporte/banco/gdb.php");


$drive->conecta();
$menu_principal = "home";
$charset = $_GET["charset"];
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}

//para debug
 session_start();  
 //$_SESSION["usuario"] = "padrao";

$db = new gdb(); //relativo ao login dos users
$db2 = new gdb(); //Pega os modulos e exibe eles
$db3 = new gdb();
$db4 = new gdb();

/*

if(isset($_POST['cpfusuario'])){
  $uname=$db->vargetpost('cpfusuario');
  $password=$db->vargetpost('senhaUsuario');

  $sql="SELECT * FROM suporteStm.usuarioFiscalizacao WHERE CPF = '".$uname."' AND SENHA = '".$password."' LIMIT 1";

  $result=$db->open($sql);

  if($db->linhas == 1){
    $login_incorreto = 0;
    $_SESSION = array();
    $_SESSION["idUsuario"]     =  $db->gs['ID'][0];
    $_SESSION["nomeUsuario"]     =  $db->gs['NOME_FISCAL'][0];
    //exit();
  } else {

    //echo "<script>alert('Erro ao Realizar o Login');</script>"

    print_r("LOGIN INCORRETO");
    //header("Refresh:0");
    //exit();
  }
}
*/

$db2->open("SELECT * FROM suporteStm.modulosFiscalizacao ORDER BY ID");



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Aulas tutoriais Módulos da Rastreabilidade."/>
<meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, nota, florianópolis, prefeitura,floripa, nfps, nfps-e, como, emitir, transmitir,copiar, duplicar, emissão, criação, clonar,criar, requirir,baixar, pdf, celular, xml, tutorial, cnae, cfps, cst, autenticidade ."/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Suporte Rastreabilidade"/>
<meta property="og:description" content="Aulas tutoriais Módulos da Rastreabilidade."/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/tutorialfiscalizacao.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ambiente de Aprendizagem e Capacitação - Gerencia da Fiscalização
</title>
<?php
echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/layout/pmf-estilo.css\">");
?>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<link rel="stylesheet" href="layout/pmf-estilo-home-new-2.css" type="text/css">
<link rel="stylesheet" href="scripts/slidesjs/css/global.css">
<link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
<link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
	@media (max-width: 960px) {
		.invisible{
			display: none !important;
		}

		video, .botao {
			width: 100% !important;
		}

		.active{
			padding-left: 10% !important;
		}

		#popup_novo_site{
      width: 70% !important;
      height: 20%;
    }
    a p{
     word-wrap: break-word;
     font-size: 10px;
   }

 }


 a{
  font-weight: bold !important;
}

.search-bar--home{
	margin: 25px auto !important;
}
.category{
 border:1px solid #427988 !important;
}
}
</style>

</head>
<body>

  <?php 
  if(isset($_POST['cpfusuario'])){
  $uname=$db->vargetpost('cpfusuario');
  $password=$db->vargetpost('senhaUsuario');

  $sql="SELECT * FROM suporteStm.usuarioFiscalizacao WHERE LOGIN = '".$uname."' AND SENHA = '".$password."' LIMIT 1";

  $result=$db->open($sql);

  if($db->linhas == 1){
    $login_incorreto = 0;
    $_SESSION = array();
    $_SESSION["idUsuario"]     =  $db->gs['ID'][0];
    $_SESSION["nomeUsuario"]     =  $db->gs['NOME_FISCAL'][0];
    //exit();
  } else {
    
    echo "<script>alert('Login Incorreto, por favor tente novamente');</script>";
    //print_r("LOGIN INCORRETO");
    //echo '<span style="color:red">Login Incorreto</span>';
    //exit();
  }
}



  ?>


  <div class="header"  style="background: #2C354A; color:white;text-align: right;">


   <h4>Gerência de Fiscalização Educação Corporativa</h4>

   <?php if (isset($_SESSION["idUsuario"])) { 
    echo '<span style="margin-left: 60%;white-space:nowrap;">Olá, <b>'.$_SESSION["nomeUsuario"].'</b></span>
   <a href="sistemas/suporte/banco/logout_fiscalizacao.php" class="button" style="font-size: 15px;color: #b38634;margin-left: 2%">Sair</a>';
  } else {
    echo ' <button id="btLogin" onclick = "popupLogin()" style="font-size: 15px;color: #b38634;margin-left: 60%">ACESSAR</button>';
  }?>

  

   <div id="loginTela" style="display: none; position:absolute; color: grey;margin-left: 50%;">


    <form action="#" method="post">
      <div >
        <label for="uname"><b>Login(e-mail)</b></label>
        <input type="text"  name="cpfusuario"  id="usuario" >
        <label for="psw"><b>Senha</b></label>
        <input type="password"  name="senhaUsuario" id="senha">
        <button type="button" onclick="verSenha();">👁️</button>   
        <input type="submit" value="Entrar">

      </div>
    </form>
  </div> 


<span id="incorreto" style="color:red"></span>

  

  


</div>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="layout/themePMF/css/style.css">
<div class="flex-container hero-wrapper" style="background-image: url(sistemas/rastreabilidade/imagens/novo.jpg);">


 <div class="column4-lg column4-md column8-sm" >
  <div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
    <div id="moduloInfo">
     <h1 class="hidden-sm hidden-xs" id="tituloModulo">Escolha um módulo</h1><br>
     <p style="color:white">O Sistema SefinnetWeb da Prefeitura Municipal de Florianópolis (PMF) tem o objetivo de fazer a transformação digital da gestão de processos e procedimentos relacionados aos Auditores Fiscais de Tributos Municipais - AFTM. <br>Cada módulo irá cobrir uma determinada parte do sistema com vídeos e tutoriais, para poder prosseguir para um próximo módulo será necessário completar um questionário baseado no conteúdo do módulo atual. <br><br><b>OBS: </b><span style="color:#ba3b32;">Somente os módulos <u>1 a 4</u> estão disponíveis no momento.</span></p><br>

      <span id="listaAulas" style="color:white">*Faça Login e escolha um Módulo para iniciar</span>

   </div>

   

<?php if (isset($_SESSION["idUsuario"])) {
 echo '<a id="iniciaModulo" onclick="" href="#" class="button" style="background-color: #ffffff;color: #278aae;display:flex;justify-content:center;">INICIAR MODULO</a>';
}
?>
<span id="prazo"> </span>

</div>
</div>



<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
  <div class="category-list" >
   <div class="category-list">
    <div class="category-citizen active">


      <?php
        for($i = 0; $i < count($db2->gs['ID']); $i++){ 
          ?>
          <a onclick="mostraModulo(<?=$db2->gs['ID'][$i]?>);"class="category active" href="#"><?=$db2->gs['DESCRICAO'][$i];?></a>

          <?php
          };
            ?>
            <a class="category active invisible" style="background-color: transparent;"></a>
          
   </div>
 </div>

</div>
</div>

</div>

</div>
</div>
</div>
</div>



</script>

<?php include_once('/home/www/footerRastreabilidade.php'); ?>

<script src="layout/themePMF/js/slick.min.js"></script>

<script src="layout/themePMF/js/main.min.js"></script>

<script src="layout/themePMF/js/home.min.js"></script>

<script type="text/javascript">



  function popupLogin(){
    document.getElementById("btLogin").style.display ="none";
    document.getElementById("loginTela").style.display ="block";
  }




  var usuario = document.getElementById("usuario");
  var senha = document.getElementById("senha");

  var senhaEscondida = true;

  function verSenha(){

    senhaEscondida = !senhaEscondida;

    if(!senhaEscondida){
        senha.type = "text";
    }else{
        senha.type = "password";
    }
  }


function calculaPrazo(data, dias){
  alert(data);
}

 
</script>


</body>


<script type="text/javascript">


  function registraInicioModulo(idModulo){


    var idUsuario =  <?echo $_SESSION["idUsuario"]?>;

      $.ajax({
            url: "sistemas/suporte/banco/iniciar_novo_modulo.php",
            type: "POST",
            data: "idUsuario="+idUsuario+"&id_modulo="+idModulo,
            dataType: "html"
        }).done(function(resposta) {  
            document.location.href = "sistemas/suporte/sefinnetfiscalizacao/modulotutoriais.php?modulo="+idModulo;
            console.log('sucesso');
        }).fail(function(jqXHR, textStatus ) {
            console.log('fail');
        }).always(function() {
            console.log('ok');
        });
  }


  function mostraModulo(modulo){

      $.ajax({
       url: "sistemas/suporte/banco/mostra_modulo.php",
       type: "POST",
        data: "modulo="+modulo,
        dataType: "html"
        }).done(function(resposta) {  
          console.log("mudamodulo");
          var resp = unicodeToChar(resposta);
            console.log(resp);
            document.getElementById("tituloModulo").innerHTML = "Módulo "+modulo;
            document.getElementById("listaAulas").innerHTML= "Lista de aulas:<br> "+resp.replace("\"","");
            verificaInicioModulo(modulo);
        }).fail(function(jqXHR, textStatus ) {
            console.log('fail');
        }).always(function() {
            console.log('ok2');
        });
  }


  function verificaInicioModulo(modulo){

       var idUsuario =  <?echo $_SESSION["idUsuario"]?>

        $.ajax({
       url: "sistemas/suporte/banco/verifica_inicio_modulo.php",
       type: "POST",
        data: "idUsuario="+idUsuario+"&modulo="+modulo,
        dataType: "html"
        }).done(function(resposta) {  

          if(resposta== 0){// nao começou modulo, mas tem acesso a ele
             document.getElementById("prazo").innerText = "";
            document.getElementById('iniciaModulo').setAttribute('onclick','registraInicioModulo('+modulo+')');
             document.getElementById('iniciaModulo').innerText ="INICIAR MÓDULO";
          }else if(resposta == 1){ // nao completou modulo anterior, não pode começar
            document.getElementById("prazo").innerText = "";
            document.getElementById('iniciaModulo').setAttribute('onclick','');
            document.getElementById('iniciaModulo').innerText ="COMPLETE O MODULO ANTERIOR PARA INICIAR ESSE MODULO";
          }else if(resposta ==2){
              document.getElementById("prazo").innerText = ""; 
              document.getElementById('iniciaModulo').setAttribute('onclick','continuarModulo('+modulo+')');
             document.getElementById('iniciaModulo').innerText ="MÓDULO COMPLETADO (CLIQUE PARA VISUALIZAR)";
          }else if(resposta.startsWith("CONTATE")){ // falhou no modulo
             document.getElementById("prazo").innerText = "";
            document.getElementById('iniciaModulo').setAttribute('onclick','');
            document.getElementById('iniciaModulo').innerText = resposta;
          }else{ //modulo iniciado
            //document.getElementById("prazo").innerText = resposta; // a resposta é o prazo que falta do modulo
             document.getElementById("prazo").innerText = "";
              document.getElementById('iniciaModulo').setAttribute('onclick','continuarModulo('+modulo+')');
             document.getElementById('iniciaModulo').innerText ="CONTINUAR MÓDULO";
          }
          
        }).fail(function(jqXHR, textStatus ) {
            console.log('fail');
        }).always(function() {
            console.log('ok2');
        });
  }

  function unicodeToChar(text) {
   return text.replace(/\\u[\dA-F]{4}/gi, 
          function (match) {
               return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
          });
}


function continuarModulo(modulo){
  document.location.href = "sistemas/suporte/sefinnetfiscalizacao/modulotutoriais.php?modulo="+modulo;
}

function sair(){
  alert("Sair");
}

</script>

</html>
