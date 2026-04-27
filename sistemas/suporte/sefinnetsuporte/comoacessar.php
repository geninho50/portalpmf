<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("/home/www/scripts/php/config.php");
require_once("/home/www/scripts/php/funcoes_bd.php");
require_once("/home/www/scripts/php/funcoes.php");
//$drive->conecta();
$menu_principal = "home";
$charset = $_GET["charset"];
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}

if(isset($_GET['aviso'])){
  $aviso=True;
}else{
  $aviso=False;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155089928-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155089928-1');
</script>

<!-- Hotjar Tracking Code for http://www.pmf.sc.gov.br/tutorialsefinnet.php -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1614853,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Como Acessar</title>


     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/comoacessar.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Como acessar Sefinnet - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/comoacessar.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>

  <link rel="stylesheet" href="../../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../../scripts/js/ui/jquery-ui.css">
  <link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
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
    h2{
      text-align:left;
    }
  }

  p{
    font-size: 1.4rem !important;
  }
  </style>

</head>
<body onload="carregaPopup()">

  <?php
    include("/home/www/layout/menus/menu_geral.php");
    echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
?>
<form name="formulario">

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
<link rel="stylesheet" href="/home/www/layout/themePMF/css/style.css">

<div id="conteudo_pagina" class="column6-lg" align="justify"  style="margin:auto">

  <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <br>
  Filtros de Pesquisa: 

 <select onchange = "changeStatus(this.value)" id="filtro" class="busca-home-field">
  <option value="0" >Profissionais Autônomos</option> 
  <option value="1" >Pessoas Jurídicas</option>
  <option value="2" >Certificação Digital</option>
  <option value="3" >Primeiro Acesso</option>
</select> 

  <br>

<div id="pessoaFisica" style="display:block;">

<h2>Como acessar: Profissionais Autônomos</h2>
<br>
<p>Médicos, dentistas, advogados, engenheiros e fisioterapeutas, entre  outros, deverão enviar as suas declarações eletrônicas por meio do  SEFINNET.
Os contribuintes do Imposto Sobre Serviços de Qualquer Natureza (ISS)  de Florianópolis devem ficar atentos para os prazos estabelecidos na  legislação tributária do Município para o cumprimento de suas obrigações  tributárias, como a entrega das declarações eletrônicas e o pagamento  dos respectivos impostos.<br><br>
Os profissionais autônomos de nível superior, como médicos,  advogados, dentistas e engenheiros, entre outros do gênero, deverão  gerar e enviar as suas declarações eletrônicas por meio do SEFINNET,  funcionalidade já disponível na página da Prefeitura Municipal de  Florianópolis, na internet. Para aqueles contribuintes que, por qualquer  motivo, não tenham acesso à rede mundial de computadores – Internet –  as declarações poderão ser realizadas no Pró-Cidadão, na sua unidade do  centro, por meio de atendimento presencial.<br><br>
A Prefeitura alerta que, assim como em  anos anteriores, não enviará nenhum carnê contendo os documentos de  arrecadação (DAMs) para o pagamento do ISS. Só serão enviados os  documentos de arrecadação (DAMs) relativos às taxas municipais.<br><br>
De acordo com os prazos fixados na legislação tributária do  município, o envio da declaração e o pagamento do respectivo imposto  (ISS) deverão ser realizados, impreterivelmente, até o dia 20 de janeiro  do ano corrente. O imposto poderá ser pago em cota única até o dia 20  de janeiro, com 10% de desconto ou, se preferir o contribuinte,  parcelado em 12 (doze) vezes, sempre com vencimento no 20º (vigésimo)  dia de cada mês.<br><br>
Lembra ainda, que os  Profissionais Autônomos de Nível Médio e Fundamental não estão obrigados  a enviar as suas declarações para realizarem o pagamento do imposto. É  que para esses contribuintes foram impressos e enviados para os seus  endereços os carnês contendo os documentos de arrecadação (DAMs). O  mesmo ocorreu em relação aos contribuintes das taxas de licença – Taxa  de Licença de Funcionamento em Horário Especial – TLHE e Taxa de Licença  para Publicidade – TLP.</p>
<a class="category active" style="color:#2855B5" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/pessoafisica/index.vm"><u>Sistema SefinNet Pessoa Física</u></a>
<h3>Verifique seu usuário</h3>
<iframe src="https://sefinnetweb2.pmf.sc.gov.br/Sefinnet/pesquisaEmailPF.vm" scrolling="no" width="490" height="200" frameborder="0"></iframe>
<br>
</div>

<div id="pessoaJuridica"  style="display:none;">
  <h2>Como acessar: Pessoa Jurídica</h2>
<br><p>
O SefinnetWeb é um sistema para realização das declarações do ISSQN de forma eletrônica, todos os Contribuintes Pessoa Jurídica (exceto Micro Empreendedor Individual - MEI) registrados no Municipio de Florianopolis deverão realizar suas respectivas declarações via SefinnetWeb.
Os contribuintes no Regime do Simples Nacional deverão declarar e recolher seu ISSQN através do Site do Simples Nacional e realizar a declaração DES-SP quando houver notas fiscais emitidas.
Já o Contribuinte no Regime Normal deverá declarar e recolher seu ISSQN via SefinnetWeb.</p>
<a class="category active" style="color:#2855B5" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/index.vm"><u>Sistema SefinNet Pessoa Jurídica</u></a>
<br><br>
</div>

<div id="certificadoDigital"  style="display:none;">
<h2>Sobre a Certificação Digital</h2>
<p>O Certificado Digital é uma assinatura com validade jurídica que garante proteção às transações eletrônicas e outros serviços via internet, permitindo que pessoas e empresas se identifiquem e assinem digitalmente de qualquer lugar do mundo com mais segurança e agilidade.</p>
<br>
<h5>Sua aplicações:</h5>
<ol>
<li>Assinar e enviar documentos pela internet;</li>
<li>Logar-se em ambientes seguros;</li>
<li>Realizar transações bancárias;</li>
<li>Assinar escriturações contábeis e fiscais, etc;</li>
<li>Enviar as declarações de sua empresa;</li>
</ol>
<h5>Seus Benefícios:</h5>
<ol>
<li>Validade jurídica nos documentos eletrônicos;</li>
<li>Desburocratiza processos, pois não necessita de reconhecimento de firma;</li>
<li>Economiza tempo, pois os serviços são realizados pela internet;</li>
</ol>
<br>
</div>

<div id="primeiroAcesso"  style="display:none;">
<h2>Meu primeiro acesso</h2>
 <p>Para acessar os sistemas SEFINNETWEB e FIAC todo Responsável Legal  (Preposto Contabilista, Preposto Não Contabilista, Empresa Contábil ou Contribuinte) deverá estar munidos de seu  Certificado Digital (E-CNPJ ou E-CPF padrão ICP- Brasil) e sua senha de acesso nos seguintes endereços:<br>
<li><a href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/index.vm" target="_blank" style="color: blue">SEFINNETWEB</a></li>
<li><a href="https://sefinnet2.pmf.sc.gov.br/fiac/" target="_blank" style="color: blue">FIAC</a></li> </p>

<p>Caso seja seu primeiro Acesso ou Esqueceu sua Senha, o responsavel legal deverá  solicitar senha nas seguintes opções:</p>
<ul>
<li>Na <a href="https://sefinnet2.pmf.sc.gov.br/fiac/" target="_blank">FIAC</a> selecionar o campo “esqueci a senha”;</li>
<li>Acessar este <a href="http://portal.pmf.sc.gov.br/sites/sefinnet/index.php?cms=recuperar+senha&amp;menu=7" target="_blank">LINK</a>, informando seus dados de e-mail e CRC onde será enviada a senha de acesso.</li>
</ul>
<p>Recebida a senha no e-mail informado, o usuário utilizará o menu  FIAC (Ficha de Inscrição e Atualização Cadastral) com certificado  digital e fará o vinculo dos contribuintes por meio do E-CNPJ ou E-CPF  (Contadores ou Empresas Contábeis com CRC-SC).</p>
<p><br> Para realizar suas Declarações no SEFINNETWEB utilize <a href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/index.vm" target="_blank">Clique Aqui.</a></p>        
</div>

</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_COMO_ACESSAR&sistema=1" width="0" height="0"></iframe>

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


   <!-- <a class="btn-block btn-primary btn-sm" href="../calendario.php">Ver calend&aacute;rio completo</span></a>
-->
    </div>
  </div>

 
<script src="/home/www/layout/themePMF/js/slick.min.js"></script>

<script src="/home/www/layout/themePMF/js/main.min.js"></script>

<?php include_once('/home/www/footerNfps.php'); ?>

<script src="/home/www/layout/themePMF/js/home.min.js"></script>

<script>
  
  function carregaPopup(){
    
      var mostrarPopup = "<?php echo $aviso ?>";
       if(mostrarPopup==1){
           document.getElementById("popup_novo_site").style.display = "block";
        }
  }
  function fechaPopup(){
    document.getElementById("popup_novo_site").style.display = "none";
  }

</script>

<script>
            function changeStatus(status) {
                switch (status) {
                    case "0":
                        document.getElementById("pessoaFisica").style = "display: block";
                        document.getElementById("pessoaJuridica").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("primeiroAcesso").style = "display: none";
                        break;
                    case "1":
                        document.getElementById("pessoaFisica").style = "display: none";
                        document.getElementById("pessoaJuridica").style = "display: block";
                        document.getElementById("certificadoDigital").style = "display: none";
                         document.getElementById("primeiroAcesso").style = "display: none";
                        break;
                    case "2":
                        document.getElementById("pessoaFisica").style = "display: none";
                        document.getElementById("pessoaJuridica").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: block";
                        document.getElementById("primeiroAcesso").style = "display: none";
                        break;
                    case "3":
                        document.getElementById("pessoaFisica").style = "display: none";
                        document.getElementById("pessoaJuridica").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("primeiroAcesso").style = "display: block";
                        break;
                    default:
                        document.getElementById("pessoaFisica").style = "display: block";
                        document.getElementById("pessoaJuridica").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("primeiroAcesso").style = "display: none";
                }
            }
        </script>

</body>
</html>
