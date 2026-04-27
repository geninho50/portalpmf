<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  
  $codigoUsuario = base64_decode( $gdb->vargetpost('codigoUsuario') );
  
  $codigoUsuario2 =  $gdb->vargetpost('codigoUsuario');
  
  $gdb->open("select p.nome,
  					 cpf,
  					 identidade,
  					 cep,
  					 logradouro,
  					 numero,
  					 bairro,
  					 telefone,
  					 celular,
                     email
                from pessoa p,
                     pessoaEndereco e,				
				     usuario u
               where p.email = u.login
			     and e.codigoPessoa = p.codigoPessoa
				 and u.codigoUsuario = '$codigoUsuario' ");
  
  $nome 	   = $gdb->gs['NOME'][0];
  $cpf 		   = $gdb->gs['CPF'][0];
  $identidade  = $gdb->gs['IDENTIDADE'][0];
  $cep 		   = $gdb->gs['CEP'][0];
  $logradouro  = $gdb->gs['LOGRADOURO'][0];
  $numero      = $gdb->gs['NUMERO'][0];
  $bairro      = $gdb->gs['BAIRRO'][0];
  $telefone    = $gdb->gs['TELEFONE'][0];
  $celular     = $gdb->gs['CELULAR'][0];
  $email       = $gdb->gs['EMAIL'][0];
  
  $codigoUsuario = $gdb->vargetpost('codigoUsuario');
  
?>
<!DOCTYPE HTML>
<html>
		<?php 
		  include_once("cabecalho.php"); 
		  cabecalho( $codigoUsuario2 );
		?>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<? 
		include_once("menu.php");   
		menu( $codigoUsuario2 ); 
		?>
		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Meus Dados</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
				<div class="inner">
					<header class="align-left">
						<br>
						<p> <?php echo $nome ?></p>
						<p>CPF: <?php echo $cpf ?> - Identidade: <?php echo $identidade ?></p>
						<p></p>
						<p>Endere&ccedil;o: <?php echo $logradouro." - ".$numero." - ".$bairro." - ".$cep ?></p>
						<p>Telefones: <?php echo $telefone." - ".$celular ?></p>
						<p><?php echo $email ?></p>
						<br>
						<span style="background-color: white;">Qualquer altera&ccedil;&atilde;o dever&aacute; ser enviada para o email: minhocanacabeca@comcap.org.br</span>
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
							<img src="../images/Comcap.png" alt="" />
							<img src="../images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>