 <?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
    include_once("../banco/gdb.php");

    $gdb = new gdb();


	$gdb->open("select  c.id as chave,
		 				c.tipo,
		 				c.assunto,
		 				c.secretaria,
		 				c.setor,
		 				c.solicitante,
		 				c.email,
		 				c.participantes,
		 				c.local,
		 				c.ministrante,
		 				DATE_FORMAT(a.data,'%d/%m/%Y') as data,
		 				TIME_FORMAT(a.horario,'%H:%i') as horario
		 		from capacitacao c, agenda a
		 		where c.id = a.idCapacitacao
		 		ORDER BY chave DESC");

	 $gdb2 = new gdb(); 


	 $cpf = $_GET['cpf'];

	    if($cpf == ''){
	       header('Location: index.php');
	    }


	  $gdb2->open("select cpf
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
<form method="post" name="frm">	
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
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs" id="cadastro">Lista de Participantes</h1><br>

	            	           	
		 		<div class="row">		 
		            <div class="col-md-12">
		                <label>Selecione a Capacitação:</label>
		                <select class="form-control" id="idcursos">
					      <?php foreach( $gdb->gs['CHAVE'] as $key=>$value ){ 	
		            			$idcursos = $value;
								print "<option value='$value'>".$gdb->gs['DATA'][$key]." - ".$gdb->gs['HORARIO'][$key]." | ".$gdb->gs['TIPO'][$key]." - ".$gdb->gs['ASSUNTO'][$key]." - ".$gdb->gs['SECRETARIA'][$key]."</option>";
								}
						   ?>
					    </select>
		            </div>
				</div>
<br><br>
				 <input type='hidden' name='idcurso' id='idcurso' value='<?php print $idcurso; ?>'>

				<div class="row">	
		            <div class="col-md-3">
		                <label>Nome:</label><input value="" id="nome" name="nome" class="form-control" type="text" />
		            </div>
		           

		        	<div class="col-md-3">
             			<label>CPF:</label><input value="" id="cpf" name="cpf" class="form-control" type="text" />
		            </div>   

		            <div class="col-md-3">
		                <label>Email:</label><input value="" id="email" name="email" class="form-control" type="text" />
		            </div>

		            <div class="col-md-3">
		                <label>Carga Horária:</label><input value="" id="carga" name="carga" class="form-control" type="text" />
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
  
 $("#cpf").mask("999.999.999-99");
 $("#carga").mask("99:99");

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

    	document.getElementById("idcurso").value = $("#idcursos").val();

		if( $('#nome').val() == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o cpf!");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe a email!");
			$('#email').focus();
			return false;
		}else if( $('#carga').val() == "" ){
			alert("Informe a carga horária!");
			$('#carga').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				nome                : $('#nome').val(),
				cpf             	: $('#cpf').val(),
				email          		: $('#email').val(),
				carga          		: $('#carga').val(),
				idCapacitacao       : $("#idcursos").val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../banco/cadastrarLista.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO."); 
						   $('#nome').val("");
						   $('#cpf').val("");
						   $('#email').val("");	
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

<script src="../../../layout/themePMF/js/slick.min.js"></script>

<script src="../../../layout/themePMF/js/main.min.js"></script>

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

<script src="../../../layout/themePMF/js/home.min.js"></script>

</body>
</html>
