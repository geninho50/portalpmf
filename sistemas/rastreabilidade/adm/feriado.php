<?php

require_once("../banco/gdb.php");

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
<form method="post" name="feriadoFORM">	
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
			
			<div id="busca-home" class="search-bar search-bar--home ">
		        <h1 class="hidden-sm hidden-xs">Cadastro de dia e hora indisponível para atendimento.</h1><br>
				<br>
			 		<div class="row">		 
			            <div class="col-md-6">
							<label>Motivo:</label><input value="" id="motivo" name="motivo" class="form-control" type="text"/>
						</div>
						<div class="col-md-3">
							<label>Data:</label><input value="" id="dataOFF" name="dataOFF" class="form-control" type="date" />
						</div>
						<div class="col-md-3">
							<label>Horário:</label>
						    <select class="form-control" id="horarioOFF" name="horarioOFF" class="div-select">
						    	  <option value="08:00:00">08:00:00</option>
				 				  <option value="09:00:00">09:00:00</option>
							      <option value="10:00:00">10:00:00</option>
							      <option value="11:00:00">11:00:00</option>
							      <option value="12:00:00">12:00:00</option>
							      <option value="13:00:00">13:00:00</option>
							      <option value="14:00:00">14:00:00</option>
							      <option value="15:00:00">15:00:00</option>
							      <option value="16:00:00">16:00:00</option>
							      <option value="17:00:00">17:00:00</option>
							      <option value="18:00:00">18:00:00</option> 
							      <option value="inteiro">DIA INTEIRO</option>    
						    </select>
					</div>

				</div>
				<div class="row">
				 <div class="col-md-12">
					<input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" onclick="feriado();" />
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

  <script type="text/javascript" src="../assets/js/validadores.js"></script>  
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <script type="text/javascript">
  
 $("#telefone").mask("(99) 99999999?9");

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
		   url: "../horario.php",
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
    


    function salvarSituacao(){
 	$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				idsolicitacao       : $('#idsolicitacao').val(),
				situacao 			: $('#situacao').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../banco/situacao.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						  
						    $('#idsolicitacao').val("");
 							$('#situacao').val("");
						     

					   }else{
						   alert(data['error']);
					   }	
					},				   
				   error: function ( data ) {
					  alert( data['error'] );
				   }
				
			});
			
	}

	function feriado(){
		if( $('#motivo').val() == "" ){
			alert("Informe o motivo!");
			$('#motivo').focus();
			return false;
		}else if( $('#dataOFF').val() == "" ){
			alert("Informe a data!");
			$('#dataOFF').focus();
			return false;
		}else if( $('#horarioOFF').val() == "" ){
			alert("Informe o horário");
			$('#horarioOFF').focus();
			return false;
		}else{
			$('#error').addClass('hide');
			var err = '';
			

			var obj = {
				motivo          	: $('#motivo').val(),
				dataOFF       		: $('#dataOFF').val(),
				horarioOFF          : $('#horarioOFF').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../banco/feriado.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");

						       $('#motivo').val("");
						       $('#dataOFF').val("");		 
							   $('#horarioOFF').val("");						  

					   }else{
						   alert(data['error']);   
					   }
					  				   	
					},				   
				   error: function ( data ) {
					   alert( data['error'] );
					   console.log(data);
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
