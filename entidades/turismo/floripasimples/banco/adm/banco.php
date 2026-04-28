  <?php

    include_once("../gdb.php");

    $gdb = new gdb();
    
	
	$gdb->open("select idconsulta as chave,
					   nome,
					   cpf,
					   cnpj,
					   empresa,
					   email,
					   pais,
					   assunto,
					   sugestao,
					   telefone 
	              from consulta");
  ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Parque Urbano e Marina Beira-mar</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="main.css" />
		 <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   		       

   		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>
	</head>
	<body>

			<section id="intro" class="main">
						<h1>Parque Urbano e Marina Beira-mar</h1>
				<table>

					<tr>  
					   <td align="center"><b>Nome</b></td>
					   <td align="center"><b>CPF</b></td>
					   <td align="center"><b>CNPJ</b></td>
					   <td align="center"><b>Empresa</b></td>
					   <td align="center"><b>Telefone</b></td>
					   <td align="center"><b>Email</b></td>
					   <td align="center"><b>Pais</b></td>
					   <td align="center"><b>Assunto</b></td>
					   <td align="center"><b>Sugestao</b></td>
					</tr>
											  
					<? 
						foreach($gdb->gs['CHAVE'] as $key=>$value){

							?>
							<tr>
							   <td align="center"><? print $gdb->gs['NOME'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['CPF'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['CNPJ'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['EMPRESA'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['TELEFONE'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['EMAIL'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['PAIS'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['ASSUNTO'][$key]; ?></td>
							   <td align="center"><? print $gdb->gs['SUGESTAO'][$key]; ?></td>
							</tr>				 					  						 
					
							<?
								}; ?>	 
						
				  </table>

		</section>
					<footer id="footer">
						<ul class="icons">
							<li><a href="https://twitter.com/scflorianopolis" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="https://www.instagram.com/prefflorianopolis/" target="blank" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="mailto:parquemarina@pmf.sc.gov.br?Subject=Parque%20Marina" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<a href="http://www.pmf.sc.gov.br" target="blank"><img src="../../images/pmf.png" width="20%"></a>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/skel.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>
			<script src="../../../../MinhocaCabeca/assets/js/jquery.min.js"></script>
  			<script src="../../../../MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>


	</body>
</html>