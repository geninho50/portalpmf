<?php 	
	error_reporting(1); // sem msg de erro
	error_reporting(E_ALL); // todas
	require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/config.php");
	require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
	foreach( $_GET as $i=>$value ){
		$drive->verificarEntrada($i);
		}
	$drive->conecta();
	$pasta = explode("/" , $_SERVER['PHP_SELF']);
	$path = $pasta[2];
	$sql = "SELECT * FROM entidades WHERE entidade_path = '$path'";
	$resultado = $drive->pedido($sql);

	require_once("../qwerty.php"); 

	$urlHost = $_SERVER['HTTP_HOST'];

?>

<script>
	//deixa banner estatico
	$('.bannerprev').remove();
	$('.bannernext').remove();
	bannerFixo = true;
	
	//remove menu noticias
	$('#menu_fechado_9').remove();

	$('#menugeral').children().children().css("border-top", "0px");
	
	/*
	$('#menugeral').children().children().filter(function() {
		var res = this.id.split("_");
		return (res[2] > 7);
  	}).find('a').css("font-size", "9px");
	*/
	//
	$('.painel_ultimas').remove();
	var home = "<?=$_GET['pagina']?>";
	var cms = "<?=$_GET['cms']?>";
	if(home == 'home' || cms == ''){
		location.href = "http://<?=$urlHost?>/sites/transparencia_h/index.php?cms=home&menu=0";
		
	}

	if(cms == 'home'){
		$('#caminho_migalhas').remove();
		$('#titulo_pagina').remove();
		$('#banner_home').css('padding','0px').css('list-style','none');
		$('#banner_texto_home').css('width', '200px').css('float', 'left');
		var banner = "<div class='banner-individual'>";
		    banner+= "<a href='http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm' target=_blank>";
		    banner+= "<img src='../../arquivos/banners/png/22_07_2015_13.47.59.beba06b945f4e96203b1ddb9995bcedc.png' alt='PORTAL DA TRANSPARÊNCIA DO GOVERNO FEDERAL'>";
		    banner+= "<div class='container-texto'><div class='texto-banner'><h1>PORTAL DA TRANSPARÊNCIA DO GOVERNO FEDERAL</h1>Lei Federal de Acesso a Informação</div></div></a></div>";
	
		var links = "<ul><li><a herf='#'>ORÇAMENTO</a></li>";
		    links += "<li><a herf='#'>PRESTAÇÃO DE CONTAS DALRF</a></li>";
		    links += "<li><a herf='#'>RECEITA</a></li>";
		    links += "<li><a herf='#'>PLANO DE GOVERNO</a></li>";
	 	    links += "<li><a herf='#'>DESPESAS</a></li>";
		    links += "<li><a herf='#'>COMPRAS E LICITAÇÕES</a></li>";
		    links += "<li><a herf='#'>BALAÇOS</a></li>";
		    
		var lei = "<a href='http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm' target=_blank>LEI DE ACESSO <br>Lei Federal nº 12.527/2011</a>";

		$('#banner_jquery').html(banner);
		$('#links').html(links);
		$('#lei').html(lei);
	}
</script>

<style>
#banner_jquery img{
	padding: 0px!important;
	margin: 0px!important;
	
}
#banner_jquery{
	float: left; 
	width: 722px!important; 
	height: 222px!important;
	margin-top: -23px;
}
.container-texto{
	    float: right;
	    width: 260px;
	    height: 220px;
	    background-color: #1b9be4;
	    margin-top: 0px;
	    color: #fff;
	    padding: 0px;
	    margin-right: 1px;
	    overflow: hidden;
}
 .texto-banner{
    height: 205px;
    padding: 30px;
    padding-top: 35px;
    padding-left: 35px;
    font-family: fontsite, "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size: 16pt;
    letter-spacing: 0.5px;
    line-height: 17pt;
}

.texto-banner h1 {
    color: #000;
    font-size: 22pt;
    line-height: 20pt;
    margin-bottom: 6px;
    text-transform: uppercase;
}

p{
   text-align: justify;
   font-size: 12px!important;
}
h2{
   color: black!important;
   padding: 7px 0px 7px 0px; 
}
#conteudo_pagina{
	width: 722px!important; 
	
}

#destaques_jquery{
	width: 722px!important;
	margin: 40px auto 10px auto;
}

#links{
	width: 460px;
	height: 110px;
	background-color: #1b9be4;
	margin: 0px!important;
	padding: 0px!important;
	float:left;
}
#links ul li{
	background: none!important;
	float: left;
	width: 200px;
	margin: 0px 0px 0px 20px;!important;
	padding: 5px!important;
	text-decoration: underline;
	color: #fff!important;
}
#links ul li a {
	color: #fff!important;
	cursor: pointer;
}

#lei{
   width: 208px;
   height: 83px;
   border: 1px solid black;
   float: left;
   font-size: 20px;
   text-align: center;
   text-decoration: underline;
   margin-left: 20px;
   padding: 15px 10px 10px 10px;
}
</style>
