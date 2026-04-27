<?php

 include_once("../banco/gdb.php");

 $gdb = new gdb(); 


$cpf = $_GET['cpf'];

    if($cpf == ''){
       header('Location: index.php');
    }


$gdb->open("select cpf
                FROM adm
                WHERE cpf = '$cpf'");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>


  <link rel="stylesheet" href="../../../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../../layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="../../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../../scripts/js/ui/jquery-ui.css">
  <link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>

<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="../../../layout/themePMF/css/style.css">

		<div class="mini-header">
		    <ul class="mini-header__items">
		      <li style="font-size: 13px;">Capacitação Rastreabilidade</li>
		    </ul>
	  	</div>
	

<div class="header">
  <div class="header__brand">
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="../../../images/marca-pmf.svg">
  	</a>
	</div>

		<ul class="header__nav">
			<li>
				<a href="solicitacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Solicitações</a>
			</li>
			<li>
				<a href="agenda.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #e827d7;">Agenda</a>
			</li>
			<li>
				<a href="capacitacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Capacitação</a>
			</li>
			<li>
				<a href="lista.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #A020F0;">Participantes</a>
			</li>
			<li>
				<a href="feriado.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Compromisso</a>
			</li>
			<li>
				<a href="duvidas.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #32CD32;">Dúvidas</a>
			</li>
			<li>
				<a href="participantes.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Capacitados</a>
			</li>
	        <li>
	        	<a href="avaliacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Avaliação</a>
	      	</li>
		</ul>
</div>



		<div class="flex-container hero-wrapper">
			<form method="post" name="frm">	
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs" id="cadastro">Adicionar Capacitação</h1><br>

	            	           	
		 		<div class="row">		 
		            <div class="col-md-3">
		                <label>Tipo de Curso:</label>
		                <select class="form-control" id="tipo">
							<option value="Visita Técnica">Visita Técnica</option>
							<option value="Workshop">Workshop</option>
							<option value="Capacitação">Capacitação</option>
						</select>
		            </div>

		            <div class="col-md-3">
		                <label>Assunto:</label>
		                <select class="form-control" id="assunto">
							<option value="Correspondência Física">Correspondência Física</option>
							<option value="Correspondência Digital">Correspondência Digital</option>
							<option value="Processo">Processo</option>
							<option value="Correspondência Física e Digital">Correspondência Física e Digital</option>
							<option value="Correspondência Física e Processo">Correspondência Física e Processo</option>
							<option value="Correspondência Digital e Processo">Correspondência Digital e Processo</option>
						</select>
		            </div>
		           

		        	<div class="col-md-3">
<label>Secretaria:</label>
<select class="form-control" id="secretaria">
<option value="COMCAP - Companhia Melhoramentos da Capital">COMCAP - Companhia Melhoramentos da Capital</option>
<option value="FCFFC - Fundação Cultural de Florianópolis Franklin Cascaes">FCFFC - Fundação Cultural de Florianópolis Franklin Cascaes</option>
<option value="FLORAM - Fundação Municipal do Meio Ambiente de Florianópolis">FLORAM - Fundação Municipal do Meio Ambiente de Florianópolis</option>
<option value="FME - Fundação Municipal de Esportes">FME - Fundação Municipal de Esportes</option>
<option value="GAPRE - Gabinete do Prefeito">GAPRE - Gabinete do Prefeito</option>
<option value="IGEOF - Instituto de Geração de Oportunidades de Florianópolis">IGEOF - Instituto de Geração de Oportunidades de Florianópolis</option>
<option value="IPREF - Instituto de Previdência Social dos Servidores Públicos do Munícipio de Florianópolis">IPREF - Instituto de Previdência Social dos Servidores Públicos do Munícipio de Florianópolis</option>
<option value="IPUF - Instituto de Planejamento Urbano de Florianópolis">IPUF - Instituto de Planejamento Urbano de Florianópolis</option>
<option value="PGM - Procuradoria Geral do Município">PGM - Procuradoria Geral do Município</option>
<option value="SEMAS - Secretaria Municipal de Assistência Social">SEMAS - Secretaria Municipal de Assistência Social</option>
<option value="SMA - Secretaria Municipal de Administração">SMA - Secretaria Municipal de Administração</option>
<option value="SMCAM - Secretaria Municipal do Continente e Assuntos Metropolitanos">SMCAM - Secretaria Municipal do Continente e Assuntos Metropolitanos</option>
<option value="SMCC - Secretaria Municipal da Casa Civil">SMCC - Secretaria Municipal da Casa Civil</option>
<option value="SMCEJ - Secretaria Municipal de Cultura, Esporte e Juventude">SMCEJ - Secretaria Municipal de Cultura, Esporte e Juventude</option>
<option value="SMDCTR - Secretaria de Defesa do Consumidor, Trabalho e Renda">SMDCTR - Secretaria de Defesa do Consumidor, Trabalho e Renda</option>
<option value="SMDU - Secretaria Municipal de Desenvolvimento Urbano">SMDU - Secretaria Municipal de Desenvolvimento Urbano</option>
<option value="SME - Secretaria Municipal da Educação">SME - Secretaria Municipal da Educação</option>
<option value="SMF - Secretaria Municipal da Fazenda">SMF - Secretaria Municipal da Fazenda</option>
<option value="SMS - Secretaria Municipal de Saúde">SMS - Secretaria Municipal de Saúde</option>
<option value="SMI - Secretaria de Infraestrutura">SMI - Secretaria de Infraestrutura</option>
<option value="SMSP - Secretaria Municipal de Segurança Pública">SMSP - Secretaria Municipal de Segurança Pública</option>
<option value="SMTMU - Secretaria Municipal de Transporte e Mobilidade Urbana">SMTMU - Secretaria Municipal de Transporte e Mobilidade Urbana</option>
<option value="SMTTDE - Secretaria Municipal de Turismo, Tecnologia e Desenvolvimento Econômico">SMTTDE - Secretaria Municipal de Turismo, Tecnologia e Desenvolvimento Econômico</option>
</select>                
		            </div>   

		            <div class="col-md-3">
		                <label>Setor:</label><input value="" id="setor" name="setor" class="form-control" type="text" />
		            </div>

				</div><br>	

				<div class="row">
 					 <div class="col-md-3">
					    	<label>Solicitante:</label><input value="" id="solicitante" name="solicitante" class="form-control" type="text" />
						</div>

					<div class="col-md-3">
		                <label>Telefone:</label><input value="" id="telefone" name="telefone" class="form-control" type="text" />
		            </div>

				 <div class="col-md-3">
			    	<label>Email:</label><input value="" id="email" name="email" class="form-control" type="text" />
				</div>

				<div class="col-md-3">
		            <label>Número de Participantes:</label><input id="participantes" class="form-control" type="text"/>
		        </div>

			</div><br>

				<div class="row">
					<div class="col-md-3">
			    		<label>Ministrante:</label><input value="" id="ministrante" name="ministrante" class="form-control" type="text" />
					</div>

					<div class="col-md-3">
					 	<label>Local:</label><input id="local" name="local" class="form-control" type="text"/>	
		            </div>

		            <div class="col-md-3">
					 <label>Data:</label><input type="date" id="dataEscolhida" class="form-control" name="dataEscolhida" value="" />	 
					</div>

					<div class="col-md-3">
					 <label>Horario:</label><input type="text" id="horario" class="form-control" name="horario" value="" />	 
					</div>
				</div>

<br><br>
			<div class="row">
				 <div class="col-md-12">
					<input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" onclick="salvar();" />
				</div>
				<div class="col-md-6">
					<h2 class="hidden-sm hidden-xs">*Todos os campos são obrigatórios</h2>
				</div>
			</div>

		</form>
</div>
</div>
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

  <script type="text/javascript" src="../../Biblioteca/js/validadores.js"></script>  
  <script src="../../MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="../../MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  
  <script type="text/javascript">
 
 $("#telefone").mask("(99) 99999999?9");
 $("#horario").mask("99:99");

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

    function salvar(){
		if( $('#tipo').val() == "" ){
			alert("Informe o tipo!");
			$('#tipo').focus();
			return false;
		}else if( $('#assunto').val() == "" ){
			alert("Informe o assunto!");
			$('#assunto').focus();
			return false;
		}else if( $('#secretaria').val() == "" ){
			alert("Informe a Secretaria!");
			$('#secretaria').focus();
			return false;
		}else if( $('#setor').val() == "" ){
			alert("Informe o setor!");
			$('#setor').focus();
			return false;
		}else if( $('#solicitante').val() == "" ){
			alert("Informe o solicitante!");
			$('#solicitante').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" ){
			alert("Informe o telefone!");
			$('#telefone').focus();
			return false;
		}else if( $('#participantes').val() == "" ){
			alert("Informe o número de participantes");
			$('#participantes').focus();
			return false;
		} else if( $('#ministrante').val() == "" ){
			alert("Informe o ministrante");
			$('#ministrante').focus();
			return false;
		} else if( $('#local').val() == "" ){
			alert("Informe o local");
			$('#local').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				tipo                : $('#tipo').val(),
				assunto             : $('#assunto').val(),
				secretaria          : $('#secretaria').val(),
				setor               : $('#setor').val(),
				solicitante         : $('#solicitante').val(),
				telefone            : $('#telefone').val(),
				email           	: $('#email').val(),
				participantes       : $('#participantes').val(),
				ministrante         : $('#ministrante').val(),
				local               : $('#local').val(),
				dataEscolhida       : $('#dataEscolhida').val(),
				horario 			: $('#horario').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../banco/cadastrarCapacitacao.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						   
						   $('#tipo').val("");
						   $('#assunto').val("");
						   $('#secretaria').val("");	
						   $('#setor').val("");		
						   $('#solicitante').val("");	
						   $('#telefone').val("");		
						   $('#email').val("");	  
						   $('#participantes').val("");		
						   $('#ministrante').val("");	
						   $('#local').val("");	  
						   $('#dataEscolhida').val("");
						   $('#horario').val("");

						   document.frm.submit();
						  
					   }else{
						   alert(data['error']);
					   }	
					},				   
				   error: function ( data ) {
					  alert( data['error'] );
				   }
				
			});
			
		}
	}
    

</script>

<script src="layout/themePMF/js/slick.min.js"></script>

<script src="layout/themePMF/js/main.min.js"></script>

<div id="rodape">
  <div class="info">
    <div class="info-column">
      <div class="info-block">
        <h4>Equipe de Suporte</h4>
        <ul>
          <li><p style="color: white;">Karla Kinchescki</p></li>
          <li><p style="color: white;">Mayara Meurer</p></li>
        </ul>
      </div>
    </div>

     <div class="info-column">
      <div class="info-block">
        <h4>Telefone - Endereço</h4>
        <ul>
          <li><p style="color: white;">(48) 3213-5509 - Secretaria da Fazenda</p></li>
          <li><p style="color: white;">(48) 3251-6457 - Pró-Cidadão</p></li>
        </ul>
      </div>

       <div class="info-block">
        <h4>Email</h4>
        <ul>
          <li><p style="color: white;">suporte.rastreabilidade@pmf.sc.gov.br</p></li>
        </ul>
      </div>
    </div>
    </div>
</div>

<script src="layout/themePMF/js/home.min.js"></script>

</body>
</html>
