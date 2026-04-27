<?php

require_once("banco/gdb.php");

$gdb = new gdb( );

$cpf = $_GET['cpf'];

    if($cpf == ''){
       header('Location: index.php');
    }


$gdb->open("select idlista as chave, 
				nome, 
				CPF
                FROM lista
                WHERE cpf = '$cpf'");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

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
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">

		<div class="mini-header">
	    <ul class="mini-header__items">
	      <li style="font-size: 13px;">Capacitação Rastreabilidade</li>
	    </ul>
	  </div>
	

<div class="header">
  <div class="header__brand">
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="../../images/marca-pmf.svg">
  	</a>
	</div>

		<ul class="header__nav">

	<li>
		<a href="../../tutorial.php" style="font-size: 15px;">Voltar</a>
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


		<div class="flex-container hero-wrapper"  style="background-image: url(imagens/praia.jpg);">
			<div id="busca-home" class="search-bar search-bar--home column3-lg column4-sm column4-xs">
		        <h1 class="hidden-sm hidden-xs" style="color: #FDAE45;">Imprimir Certificado</h1><br>
		       <?php foreach( $gdb->gs['CHAVE'] as $key=>$value ){ 	
								echo "<p style='color: white;'>Oi ".$gdb->gs['NOME'][$key]." clique abaixo para obter seu certificado.</p>";
								}
						   ?>
			
			<a href="certificado_imprimir.php?codigoUsuario=<?echo $cpf;?>" target="_blank" style="color: #099BC8;">Visualizar certificado</a>

			<br><br>
		

       <input type='hidden' name='cpf' id='cpf' value='<?php print $cpf; ?>' >

            <h1 class="hidden-sm hidden-xs" style="color: #FDAE45;">Avalie sua Capacitação</h1><br>

            <div class="row">
                 <div class="col-md-10">
                    <label>1 - Avaliando a Capacitação do Sistema Rastreabilisade, o quanto atendeu a suas expectativas?</label>
                    <p style="color: white;">(Dê uma nota de 0 a 10, onde 0 = não atendeu e 10 = atendeu com excelência)</p>
				</div>

				<div class="col-md-4">
		       <select class="form-control" id="pergunta1">
		       		<option value="10">10</option>
		       		<option value="9">9</option>
		       		<option value="8">8</option>
		       		<option value="7">7</option>
		       		<option value="6">6</option>
		       		<option value="5">5</option>
		       		<option value="4">4</option>
		       		<option value="3">3</option>
		       		<option value="2">2</option>
					<option value="1">1</option>								
				</select>

		</div>

 <!--
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="1">1</label>
                  </div>
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="2">2</label>
                  </div>
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="3">3</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="4">4</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="5">5</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="6">6</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="7">7</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="8">8</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="9">9</label>
                  </div> 
                  <div class="radio-inline">
                    <label><input type="radio" name="pergunta1" value="10">10</label>
                  </div>  
                </div>   -->
        </div><br>

        <div class="row">
                 <div class="col-md-10">
                    <label>2 - O material utilizado na capacitação foi adequado?</label><input value="" id="pergunta2" name="pergunta2" class="form-control" type="text" />
                </div>   
        </div><br>

        <div class="row">
                 <div class="col-md-10">
                    <label>3 - Você saiu com dúvidas de usabilidade do sistema após a capacitação? Se sim qual(is).</label><input value="" id="pergunta3" name="pergunta3" class="form-control" type="text" />
                </div>   
        </div><br>

        <div class="row">
                 <div class="col-md-10">
                    <label>4 - Os exemplos demonstrados atendem a sua realidade diária de utilização do sistema? Se não, cite exemplos.</label><input value="" id="pergunta4" name="pergunta4" class="form-control" type="text" />
                </div>   
        </div><br>

        <div class="row">
                 <div class="col-md-10">
                    <label>5 - O instrutor transmitiu informação de forma clara e objetiva? Se não, elabore sugestões de melhoria.</label><input value="" id="pergunta5" name="pergunta5" class="form-control" type="text" />
                </div>   
        </div><br>
                            
        <div class="row">
          <div class="col-md-12">
            <input type="button" class="btn btn-primary botao" value="Enviar avaliação" onclick="enviar();" />
          </div>
          <div class="col-md-6">
            <h2 class="hidden-sm hidden-xs">*Todos os campos são obrigatórios</h2>
          </div>
        </div>
      </div>
</form></div>

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

  <script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>  
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


	
     function enviar(){

	if( $('#pergunta1').val() == "" ){
      alert("Informe a questão 1!");
      $('#pergunta1').focus();
      return false;
    }else if( $('#pergunta2').val() == "" ){
      alert("Informe a questão 2!");
      $('#pergunta2').focus();
      return false;
    }else if( $('#pergunta3').val() == "" ){
      alert("Informe a questão 3!");
      $('#pergunta3').focus();
      return false;
    }else if( $('#pergunta4').val() == "" ){
      alert("Informe a questão 4!");
      $('#pergunta4').focus();
      return false;
    }else if( $('#pergunta5').val() == "" ){
      alert("Informe a questão 5!");
      $('#pergunta5').focus();
      return false;
    }else{
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
        cpf        : $("#cpf").val(),
		    pergunta1  : $('#pergunta1').val(),
        pergunta2  : $('#pergunta2').val(),
        pergunta3  : $('#pergunta3').val(),
        pergunta4  : $('#pergunta4').val(),
        pergunta5  : $('#pergunta5').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "banco/avaliacao.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
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
          <li><p style="color: white;">Thalia Souza</p></li>
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
