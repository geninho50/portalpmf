<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../banco/gdb.php"); 
  include_once("cabecalho.php"); 

  $gdb = new gdb();
  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');  
  $codigoUsuario = base64_decode( $gdb->vargetpost('codigoUsuario') );

  cabecalho( $codigoUsuario2 );
?>
	
<style>
 .divCentralizada {
	 display: flex;
	 flex-direction: row;
	 justify-content: center;
	 align-items: center
 }
</style>	
	
<?php
  
  $gdb->open("SELECT  codigoPessoa,
					        p.nome,
					        p.email,
				replace((SELECT DATE_FORMAT(MAX(dataTroca),'%d/%m/%Y')
				   FROM backend.trocaCaixaMNC t
				  WHERE t.codigoPessoa = p.codigoPessoa),'.',',') as dataTroca,
				replace((SELECT sum(qtdeTroca)
				   FROM backend.trocaCaixaMNC t
				  WHERE t.codigoPessoa = p.codigoPessoa),'.',',') as totalPessoaTroca,
				(SELECT sum(qtdeTroca)
				    FROM backend.trocaCaixaMNC t ) as totalTroca,
				(SELECT count(*)
				    FROM backend.pessoa pi
				    JOIN backend.eventoInscricao i ON pi.codigoPessoa = i.codigoPessoa
				    JOIN backend.eventoProgramacao pe ON pe.codigoTurma = i.codigoTurma
				    JOIN backend.evento e ON pe.codigoEvento = e.codigoEvento
				    WHERE codigoprojeto = 'MNC'
				    AND ADDDATE( pe.data, INTERVAL 14 DAY)<sysdate()
				    AND i.codigoPessoa = p.codigoPessoa) AS ok
				FROM backend.usuario u
				JOIN backend.pessoa p ON p.email = u.login
				WHERE u.codigoUsuario = '$codigoUsuario'");
  
  $codigoPessoa     = $gdb->gs['CODIGOPESSOA'][0];
  $nome 		    = $gdb->gs['NOME'][0];
  $email 		    = $gdb->gs['EMAIL'][0];
  $ultimaTroca      = $gdb->gs['DATATROCA'][0];			   
  $totalPessoaTroca = $gdb->gs['TOTALPESSOATROCA'][0];
  $totalTroca       = $gdb->gs['TOTALTROCA'][0];
  
?>

	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="">RESIDU&Ocirc;METRO :&nbsp; &nbsp; <? print $totalTroca; ?></a></div>
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
						<p>Prefeitura de Florian&oacute;polis / Comcap</p>
						<h2>Minha Caixa</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
				<div class="inner">
					<header class="align-center">

						<div id="main" class="container">
							<form method="post" action="#" id="formIndex" name="formIndex" method="post" >
								<input type="hidden" id="codigoUsuario2" value="<?echo $codigoUsuario; ?>">
								<div class="row uniform">
									<div class="6u 12u$(xsmall)">
										<label>Data da Ultima troca</label>
										<input type="text" disabled="disabled" value="<? print $ultimaTroca; ?>" />
									</div>																					
									<div class="6u$ 12u$(xsmall)">
										<label>Veja aqui quantos quilos o projeto j&aacute; desviou: </label>
										<input type="text" disabled="disabled" value="<? print $totalPessoaTroca; ?>" size = "12" />
									</div>
									 <? if( $gdb->gs['OK'][0]>0 ){ ?>	
											<label>Cada troca tem um peso estimado, previamente calculado pela equipe da Comcap sobre o volume da caixa. 
													Ao inserir a data e clicar no bot&atilde;o "Adicionar", o sistema acrescenta esse valor e certifica
													sua contribui&ccedil;&atilde;o ambiental.</label>										
											<div class="12u$ 12u$(xsmall)" >										    
												<label>Data da Troca</label>											
												<input type="date" id="dateTroca" name="dateTroca" class="obrigatorio" placeholder="Informe a data que você trocou a sua caixa"  /> &nbsp; &nbsp; 
												<input type="button" class="button special" value="Adicionar + 15,9 Kg"  onclick="trocar();"/>
											</div>											
									 <? }else{ ?><label>As opera&ccedil;&otilde;es de troca, s&oacute; ser&aacute; liberadas ap&oacute;s a realiza&ccedil;&atilde;o do curso.</label><? } ?>

								</div>	
							</form>
						</div>		
							
					</header>
				</div>
			</section>
			


		<!-- Footer -->
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>

<script>
		
function trocar(){
  
  if( $("#dateTroca").val() =="" ){
	  alert("Informe a data da troca ! !");	
	  $("#dateTroca").focus();		  
  }else{
	data = {
		 "dateTroca": $("#dateTroca").val(),
		 "codigoUsuario": $("#codigoUsuario2").val()
	};
	
	data = $( this ).serialize() + "&" + $.param(data);

	$.ajax( {
	  type: "POST",
	  dataType: "json",
	  url: "../banco/trocarCaixaMNC.php", 
	  data: data,
	  success: function( data ){
				 if( data == 1  ){
                      alert("Sua troca foi feita com sucesso !");
					  document.formIndex.submit();
					  $("#dateTroca").val("");
					  $("#dateTroca").focus();
				 }else if( data == 2  ){
					      alert("De acordo com as regras da COMCAP, voce ainda nao pode fazer a troca ! ");
				 }else if( data == 3  ){
					      alert("A data da troca e menor que a da ultima troca !");
				 }else{
					 alert(data);
					 alert("O usuario ou senha, esta incorreto !"); 
					 $("#login").val("");		  
					 $("#senha").val("");
					 $("#login").focus;
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