<?php
  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  $gdb2 = new gdb();  
  
  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') );  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');    
  $inscricao 	  =  $gdb->vargetpost('inscricao');  
  $texto 	  	  =  $gdb->vargetpost('texto');  
    
  $select = "select distinct codigoInscricao as codigo,
					 p.nome,
					 cpf,
					 email,
					 celular,
					 telefone,
				 case when tipo = 'O' Then 'Aguardando'
				 else 'Enviado' end as situacao
				from pessoa p,
					 pessoaAuxiliar a,
					 eventoInscricao e
				where a.codigoProjeto = 'MNC'
				 and a.codigoPessoa = p.codigoPessoa
				 and e.codigoPessoa = a.codigoPessoa
				 and e.tipo  IN ('O', 'A')
			order by codigoInscricao ";

  $gdb->open( $select );				

  $temEnvio = 0;
  $totalEmail = 0;
  
  if( $inscricao == "" ){	  
	  foreach( $gdb->gs['CODIGO'] as $i => $value ){
		$checkBox = $gdb->vargetpost("checkBox$value","");
		
		if( $checkBox == 'on' ){
			// $gdb2->open(" UPDATE eventoInscricao SET tipo = 'A' WHERE codigoInscricao = '$value' ");
			$temEnvio = 1;
			
			$registro	  = base64_encode( $gdb->gs['CODIGO'][$i] );
			$Destinatario = $gdb->gs['EMAIL'][$i];
			$email		  = "minhocacabeca.comcap@pmf.sc.gov.br";
			$titulo		  = "PROJETO MINHOCA NA CABECA";
			$mensagem1    ="Caro(a) Senhor(a) ".$gdb->gs['NOME'][$i].",
			<br><br>".$texto."<br><br>
			Clique no link abaixo e finalize sua inscrição no projeto.<br>
			http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/admin/cadastroFilaEspera.php?codigo=$registro <br><br>
			Autarquia Comcap<br>
			Prefeitura Municipal de Florianópolis";
			  
			include_once("../email/gmailSender.class.php");
			$gmailSender = new gmailSender();
			if ($gmailSender->smtpmailer($Destinatario, 'minhocanacabeca.comcap@gmail.com', utf8_decode($gdb->gs['NOME'][$i]), $titulo, utf8_decode($mensagem1))) {
			}
			
			$totalEmail++;
		}  
	  }	  	  
	  
  }else{
  	$gdb2->open(" UPDATE eventoInscricao SET tipo = 'E' WHERE codigoInscricao = '$inscricao' ");
     $temEnvio = 1;	 
  }
  
  if( $temEnvio ){
	 $gdb->open( $select );  
  }
  
  
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
		  menu( $codigoUsuario2); 
		?>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Manutenção de Fila de Espera</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
			
				<div class="inner">
					<header class="align-left">
					<form name="frm" id="frm" action="" method="post" >
					<table>
					    <? if ( $totalEmail !=0 ){?>
						      <tr><td align="center" colspan="9" ><h3>Foram enviado(s) <? print $totalEmail; ?> email(s)</h3></textarea></td></tr>
						<? } ?>
					    <tr><td align="left" colspan="9" ><h2>Escreva a mensagem:</h2><textarea id="texto" name="texto" placeholder="Mensagem a ser enviada para pessoas da fila de espera" ></textarea></td></tr>
						<tr><td align="center" colspan="9" ><b><h2>Relação de Inscritos</h2></b></td></tr>
						<tr>
						   <td align="center" ><b>Inscri&ccedil;&atilde;o</b></td>
						   <td align="center" ><b>Nome</b></td>
						   <td align="center" ><b>CPF</b></td>
						   <td align="center" ><b>Email</b></td>
						   <td align="center" ><b>Celular</b></td>
						   <td align="center" ><b>Telefone</b></td>
						   <td align="center" ><b>Situa&ccedil;&atilde;o</b></td>
						   <td align="center" ><b>Opera&ccedil;&atilde;o</b></td>
						</tr>						
						  <input type="hidden" name="inscricao" id="inscricao" value="">
						  <input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >
						<? 
							foreach($gdb->gs['CODIGO'] as $key=>$value){?>
								<tr>
								   <td align="left"   ><? print $value; ?></b></td>
								   <td align="left"   ><? print $gdb->gs['NOME'][$key]; ?></td>
								   <td align="center" ><? print $gdb->gs['CPF'][$key]; ?></td>
								   <td align="left"   ><? print $gdb->gs['EMAIL'][$key]; ?></td>
								   <td align="left"   ><? print $gdb->gs['CELULAR'][$key]; ?></td>
								   <td align="left"   ><? print $gdb->gs['TELEFONE'][$key]; ?></td>
								   <td align="center" ><? print $gdb->gs['SITUACAO'][$key]; ?></td>
								   <td align="center" >
								   <?php if( $gdb->gs['SITUACAO'][$key] == 'Enviado' ){ ?>
								   	<input type="button" value="Voltar para fila" onclick="voltarFila(<? print $value; ?>);" />
									   <input type="hidden" value="enviado" id="checkBox<? print $value; ?>" />
								 <? }else{ ?>
										 <input type="checkbox" id="checkBox<? print $value; ?>" name="checkBox<? print $value; ?>"  >
										 <label for="checkBox<? print $value; ?>" >Enviar</label>
								 <? } ?>
								   </td>					   
								</tr>						 
						  <?}?>
						
					    <tr>
					      <td align="center"  colspan="9" >
							<input type="submit" value="Enviar EMAIL" />
						  </td>						  
					    </tr>
						</form>  
				  </table>
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
<script>
  function voltarFila(inscricao){
	 if( confirm("Tem certeza que deseja colocar ele(a) de volta na lista de Espera? ") ){ 
	    $("#inscricao").val(inscricao);
	    document.frm.submit();	  
     }	  
  }	  
</script>