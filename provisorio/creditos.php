<?php
//---------------------------------------------------------------------
// busca as configurações e funções para mostrar corretamento o portal
//---------------------------------------------------------------------
require_once("scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Prefeitura Municipal de Florianópolis</title>
    
    <link rel="stylesheet" href="layout/pmf-estilo.css" type="text/css">
    <link rel="stylesheet" href="layout/pmf-estilo-home.css" type="text/css">
	<link rel="stylesheet" href="layout/pmf-estilo-governo.css" type="text/css">
    <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
		
</head>
<body>
	<div class="layout_governo">
	<?php 
	$menu_principal = "home"; 
	include("layout/menus/menu_geral.php");
	?>
	<div id="conteudo_wrapper">
       	<div id="conteudo">
        	<div id="conteudo_coluna1"></div>
            <div id="conteudo_coluna2">
           	 <div id="caminho_migalhas">desenvolvimento do Portal Corporativo da Prefeitura Municipal de Florianópolis</div>
                <div id="titulo_pagina">página de créditos</div>                
                <br /><br />                
                <div style="font-size:13px; font-weight:bold;">Projeto do Sistema de Gestão de Conteúdo</div>                
                <div style="padding-left:30px;">
                	Rodrigo Rigoni<br>
                	<i>Gerente de Portal Corporativo</i><br>
                	<a href="mailto:rigoni@pmf.sc.gov.br"><i>rigoni@pmf.sc.gov.br</i></a>
                </div>
                <br /><br />
                
                <div style="font-size:13px; font-weight:bold;">Implementação do Sistema de Gestão de Conteúdo (v2)</div>
                <div style="padding-left:30px;">
                	Equipe do CPD da Prefeitura.<br />
                	Rodrigo Rigoni<br>
                    Romollo Valério dos Santos<br />
                	<a href="mailto:portal@pmf.sc.gov.br"><i>portal@pmf.sc.gov.br</i></a> 
                </div>                  
                <br /><br />
                
                <div style="font-size:13px; font-weight:bold;">Projeto Gráfico</div>
                <div style="padding-left:30px;">
                	Genilda Oliveira de Araujo<br>
                	<i>designer de informação</i><br>                	
                </div>
                <br /><br />
                <div style="font-size:13px; font-weight:bold;">Conteúdo do Portal</div>
                <div style="padding-left:30px;">
                	Equipe das Secretarias e Órgãos da Prefeitura.
            	</div>
            </div>
        	<br class="clearfloat">
		</div>	<!-- fim do conteudo -->
	</div> <!-- fim do conteudo_wrapper -->
	<?php include("layout/rodape/rodape.php"); ?>
</div><!-- fim layout-home -->
</body>
</html>
<?php
$drive->close();
?>