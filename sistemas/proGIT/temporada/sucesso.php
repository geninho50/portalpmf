<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

  <?php
    include_once("banco/gdb.php");

    $gdb = new gdb();
    $gdb2 = new gdb();
    
    $cpf = $gdb->vargetpost("cpf");
    $idcursos = $gdb->vargetpost("idcurso");
    


 /*   if($cpf == ''){
       header('Location: index2.php');
    } */



$gdb->open("SELECT dia, horario, local 
              FROM cursos 
              WHERE idcursos = '$idcursos' ");

$dia = $gdb->gs["DIA"][0];
$horario = $gdb->gs["HORARIO"][0];
$local = $gdb->gs["LOCAL"][0];

$gdb2->open("SELECT nome from login where documento = '$cpf' ");
$nome = $gdb2->gs["NOME"][0];


  ?>


  <link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../scripts/js/ui/jquery-ui.css">
  <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>
  <div style="display:none">
      <a href="mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
  </div>

    <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">

    <div class="mini-header">
      <ul class="mini-header__items">
        <li style="font-size: 13px;">Treinamentos Ambulantes - Operação Verão 2020</li>
      </ul>
    </div>
  

<div class="header">
  <div class="header__brand">
    <a href="http://www.pmf.sc.gov.br">
      <img src="../../images/marca-pmf.svg">
    </a>
  </div>
  </ul>
</div>
<div class="flex-container hero-wrapper">
  <div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">

       <h4>Sua inscrição foi realizada com <b>sucesso</b>!</h4>

       <h3 style="color: white;">Oi <? print $nome." - ".$cpf; ?></h3>
       <br>
       <h4>Está inscrito(a) no curso: </h4><h3 style="color: white;"><? echo $dia." ".$horario." ".$local; echo' <br />';?></h3><br />
       <br><br>
		
         <input type="button" class="btn btn-primary botao" id="btnImprimir" value="Imprimir" onclick="window.print();">

  </div>
</div>

 <div class="flex-container">
    <div class="column4-lg column4-md column8-sm">
      <div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=150853192172803";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</div>
    </div>
  </div>


  <script type="text/javascript" src="js/validadores.js"></script>  
  <script src="../MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="../MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  <script type="text/javascript">
  
      function loadScript( url, callback ) {
        var script = document.createElement( "script" )
        script.type = "text/javascript";
        if(script.readyState) {  //IE
          script.onreadystatechange = function() {
            if ( script.readyState === "loaded" || script.readyState === "complete" ) {
              script.onreadystatechange = null;
              callback();
            }
          };
        } else {  //Others
          script.onload = function() {
            callback();
          };
        }
        script.src = url;
        document.getElementsByTagName( "head" )[0].appendChild( script );
      }

</script>

<script src="../../layout/themePMF/js/slick.min.js"></script>

<script src="../../layout/themePMF/js/main.min.js"></script>
<div id="rodape">
  <div class="info">
     <div class="info-column">
      <div class="info-block">
        <h4>Telefone</h4>
        <ul>
          <li><p style="color: white;">(48) 3225-9558 - Superintendência de Serviços Públicos</p></li>
        </ul>
      </div>

       <div class="info-block">
        <h4>Email</h4>
        <ul>
          <li><p style="color: white;">superintendente.susp@pmf.sc.gov.br</p></li>
        </ul>
      </div>
    </div>
    </div>
</div>

<script src="../../layout/themePMF/js/home.min.js"></script>

</form>
</body>
</html>

