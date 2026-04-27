<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../banco/gdb.php"); 
  include_once("../banco/usuario.func.php");   
		  
  $gdb = new usuarios(); 
  
  $codigoUsuario2  = $gdb->vargetpost('codigoUsuario'); 
  $codigoUsuario = $gdb->vargetpost('codigoUsuario');	  
  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') ) ;

  $gdb->open(" select p.codigoPessoa, 
                      p.nome,
                      p.email,
			 ( select count(*)
		  from pessoa pi, eventoInscricao i, eventoProgramacao pe, evento e 
		where pi.codigoPessoa = i.codigoPessoa 
		  and pe.codigoTurma = i.codigoTurma 
		  and pe.codigoEvento = e.codigoEvento 
		  and codigoprojeto = 'MNC' 
		  and  ADDDATE( pe.data, INTERVAL 14 DAY)<sysdate()
		  and i.codigoPessoa = p.codigoPessoa  ) as ok
                from usuario u, 
				      pessoa p
			   where u.codigoUsuario = '$codigoUsuario' 
			     and p.email = u.login "); 
 $codigoPessoa = $gdb->gs['CODIGOPESSOA'][0];  				 
  
  
?>  
<html>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<?php
		  include_once("menu.php");   
		  menu( $codigoUsuario2 ); 
		  ?>


		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Certificado</h2>
					</header>
				</div>
			</section>
		
			<div class="box">
				<div class="content">
					
						<h3>Clique no bot&atilde;o abaixo e imprima seu certificado</h3>

						<form method="post" action="#" id="formIndex" name="formIndex">
							<input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >						
							<div class="12u$">
								<ul class="actions">									
								 <!--<li><a href="#" onclick="alert('Em breve seu certificado ser&aacute; liberado !');" class="button alt" >Certificado</a></li>-->								
								 <li>
								   <? if( $gdb->gs['OK'][0]>0 ){ ?><a href="certificadoMNC.php?codigoPessoa=<?echo $codigoPessoa;?>" class="button alt" >Certificado</a>
								   <? }else{ ?><a href="#" class="button alt" >Certificado n&atilde;o est&aacute; Liberado</a><? } ?>
								 </li>	
								</ul>
							</div>
						</form>


				</div>
			</div>

			</div>


		<!-- Footer
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com/_comcap" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/comcapoficial" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/explore/locations/240724652/prefeitura-de-florianopolis/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="mailto:minhocacabeca.comcap@pmf.sc.gov.br" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					<header class="align-center">
							<img src="images/Comcap.png" alt="" />
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>
			 -->

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>

<script type="text/javascript">

    function alterar(){
		
	  var senha = $("#senha").val();
	  var repitaSenha = $("#repitaSenha").val();
	  
	  if( senha =="" ||  repitaSenha ==""  ){
		  alert("Informe a nova senha e repita !");	
          $("#senha").val("");		  
		  $("#repitaSenha").val("");
		  $("#senha").focus();
	  }else if( senha != repitaSenha ){
			  alert("As senhas são diferentes !");	
			  $("#senha").val("");		  
			  $("#repitaSenha").val("");
			  $("#senha").focus();
	  }else{
			data = {
				 "alterarSenha" :1,
				 "codigoUsuario": $("#codigoUsuario").val(),
				 "senha": senha
			};
			
			data = $( this ).serialize() + "&" + $.param(data);

			$.ajax( {
				  type: "POST",
				  dataType: "json",
				  url: "../banco/loginMNC.php", 
				  data: data,
				  success: function( data ){
							 if( data != 0  ){
								 alert("Sua senha foi alterada com sucesso !"); 
								 document.formIndex.action = "login.html";						 
								 document.formIndex.submit();						 
							 }            
						  },
				  error: function( data ){
							console.log( data );
				  }
			  } 
			);
	  }	

    }
</script>