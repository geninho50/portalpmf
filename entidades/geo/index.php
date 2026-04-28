<?php require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
foreach( $_GET as $i=>$value ){
  $drive->verificarEntrada($i);
  }
$drive->conecta();
$pasta = explode("/" , $_SERVER['PHP_SELF']);
$path = $pasta[2];
$sql = "SELECT * FROM entidades WHERE entidade_path = '$path'";
$resultado = $drive->pedido($sql);
require_once("../qwerty.php"); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>