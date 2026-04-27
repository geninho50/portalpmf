<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta Pública Parque Urbano e Marina Beira-mar Norte</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="jumbotron">
        <div>
            <img class ='logo' src="img/logo.png" />
        </div>
    </div>  

    <div class="menu pull-left esquerda">
        <a href="produto1.php" class="btn btn-default menu"><b>Produto 1:<br> Diagnóstico Ambiental Simplificado</b></a>
        <a href="produto2.php" class="btn btn-default menu"><b>Produto 2:<br> Estudo de Territorialidade</b></a>
        <a href="produto3.php" class="btn btn-default menu"><b>Produto 3:<br> Estudo de Impacto Simplificado</b></a>
        <a href="produto4.php" class="btn btn-default menu"><b>Produto 4:<br> Aspectos Legais</b></a>
        <a href="produto5.php" class="btn btn-default menu"><b>Produto 5:<br> Estudo Preliminar Arquitetônico e Urbanístico</b></a>
        <a href="produto6.php" class="btn btn-default menu"><b>Produto 6:<br> Estudo de Viabilidade Econômico-Financeiro</b></a>
        <a href="documentos.php" class="btn btn-default menu doc"><b>Manifestações Oficiais</b></a>
        <a href="concessao.php" class="btn btn-default menu doc"><b>Termo de Referência da Concessão</b></a>
    </div>     

    <div class="container">

        <h2 class="text-center">Consulta Pública Parque Urbano e Marina Beira-mar Norte</h2>
        <h2 class="text-center">FINALIZADA!</h2>

        <img class="foto" src="img/marina1.jpg">

        <p>Os estudos preliminares para a implantação do Parque Urbano e Marina na Beira-mar Norte já foram obtidos por meio do Procedimento de Manifestação de Interesse (PMI), do qual duas empresas apresentaram propostas preliminares – AJX & Karolyne Soares e a ARK7 Arquitetura – que servirão como base para a elaboração do termo de referência e do edital de licitação de concessão para a implantação da iniciativa.</p>

        <p>Ao todo são seis produtos compõem os estudos. Cada um deles foi criteriosamente analisado por um grupo técnico e consultores de notório saber, designados de acordo com a sua área de atuação.</p>

        <p>Sendo assim, colocamos estes estudos à disposição para que você possa opinar, ou sugerir melhorias, aos produtos que compõem o projeto como um todo. Sendo eles: Diagnóstico Ambiental Simplificado, Estudo de Territorialidade, Estudo de Impacto Simplificado e Aspectos Legais, Estudo Preliminar Arquitetônico e Urbanístico e Estudo de Viabilidade Econômico-Financeiro. Estes dois últimos, contudo, tiveram algumas alterações após a análise do Grupo de Trabalho para melhor alinhá-los às expectativas da Prefeitura de Florianópolis e com relação a viabilidade econômica como um todo.</p>

        <p>A área contará com um parque urbano público, de convivência, com espaço para a realização de eventos, estacionamento de veículos, quiosques, área de lazer e espaço para práticas esportivas que envolvam o mar. Haverá a integração de modais, já que a parte de marina abrigará vagas molhadas destinadas ao uso público, sendo uma parte designada a uma futura instalação de transporte náutico.</p>

        <div class="pdf">
            <iframe src="http://www.pmf.sc.gov.br/sistemas/consulta/setur/arquivos/apresentacao.pdf" width="100%" height="100%" style="border: 1px solid;"></iframe>
        </div>

        <div class="destaque">
            <p>ENCERRADA A ENTRADA DE OPINIÕES SOBRE O PARQUE URBANO E MARINA BEIRA-MAR NORTE</p>
        </div>    

        <p><a class="clique" href="http://www.pmf.sc.gov.br/sistemas/consulta/setur/resultado.php">CLIQUE AQUI</a> para ter acesso aos resultados da consulta.</p>

        <p><a class="clique" href="http://www.pmf.sc.gov.br/sistemas/consulta/setur/respostas.php">CLIQUE AQUI</a> para ter acesso as respostas da PMF as considerações apresentadas.</p>




    </div>

<script language="JavaScript" type="text/javascript">
	function Mudarestado(el) {
	    var display = document.getElementById(el).style.display;
	    if(display == "block")
	        document.getElementById(el).style.display = 'none';
	    else
	        document.getElementById(el).style.display = 'block';
	}

     $('#cpf').mask("999.999.999-99");
    $('#voltar').bind('click', function(){
        window.location.href = "index.php";
    });


        $.post( "insert.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "confirmado.php";
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                window.scrollTo(0, 0);
            }
        });
    });
</script>


</body>



</html>