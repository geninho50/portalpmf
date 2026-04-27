<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  $gdb2 = new gdb();
  $gdb3= new gdb();  
  
  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') );  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');     
  $inscricao 	  =  $gdb->vargetpost('inscricao');  
  $texto 	      =  $gdb->vargetpost('texto');  
  $comboDiv       =  $gdb->vargetpost('comboDiv');  
    
  $select = "select p.codigoPessoa as codigo,
  	  		 p.nome,
  	  		 p.celular,
				( SELECT sum( qtdeTroca ) FROM trocaCaixaMNC t where p.codigoPessoa = t.codigoPessoa) as qtdeTroca,
				  date_format(c.dataTroca, '%d/%m/%Y' )  as data,
				  p.email
					
					FROM pessoa p, trocaCaixaMNC c	   
				where  p.codigoPessoa = c.codigoPessoa 
                  and  ( SELECT max( t1.dataTroca ) 
                          FROM trocaCaixaMNC t1 
                         WHERE p.codigoPessoa = t1.codigoPessoa ) = c.dataTroca
				order by p.nome";


  $select2 = "select p.codigoPessoa as codigo,
 				p.nome,
 				p.email,
 				p.celular,
 				''as data,
 				''as qtdeTroca
				from pessoa p

				JOIN eventoInscricao e
				ON p.codigoPessoa = e.codigoPessoa

				where e.tipo = 'P'
				AND e.codigoTurma is not null
				AND (select count(*) from trocaCaixaMNC t where t.codigoPessoa = p.codigoPessoa) = 0
				ORDER BY p.nome";


  $temEnvio = 0;
  if( $inscricao == "" ){
  	if ($comboDiv == "I") {
  		$gdb->open( $select2 );
  	}else{
  		$gdb->open( $select );
  	}
	  foreach( $gdb->gs['CODIGO'] as $i => $value ){
		  
		$checkBox = $gdb->vargetpost("checkBox$value","");
		
		if( $checkBox == 'on' ){
			
			$temEnvio++;

			$Destinatario = $gdb->gs['EMAIL'][$i];
			$email		  = "minhocanacabeca.comcap@pmf.sc.gov.br";
			$titulo		  = "PROJETO MINHOCA NA CABECA";
			$mensagem1    ="Caro(a) Senhor(a) ".$gdb->gs['NOME'][$i].",
			<br>".$texto."<br>
			Autarquia Comcap<br>
			Prefeitura Municipal de Florianópolis";
			
			include_once("../email/gmailSender.class.php");
			$gmailSender = new gmailSender();
			$gmailSender->smtpmailer($Destinatario, 'minhocanacabeca.comcap@gmail.com', utf8_decode($gdb->gs['NOME'][$i]), $titulo, $mensagem1);
		}  
	  }
  }
  
   $gdb->open( $select );
   $gdb2->open( $select2 );

   
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
						<h2>Troca de Caixas</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">

				<div class="inner">
					<header align="center">
						<?
						  if( $temEnvio > 0){
						  	 print "<b>$temEnvio</b> email(s) enviado(s) com sucesso! ";
						  }
						?>
					</header>
					<form name="frm" id="frm" action="" method="post" >

					<div class="12u$ 12u$(xsmall)" align="center">
						<h2>Escreva a mensagem:</h2><textarea id="texto" name="texto" placeholder="Mensagem a ser enviada ao participante" ></textarea>
					</div><br>

					 <div class="form-group">
					  <h2 for="sel1">Escolha:</h2>
					  <h1>Envie no máximo 100 emails por dia (restrição do email @pmf).</h1>
					  <h1><strong>Clique no nome do participante para ver mais detalhes das trocas.</strong></h1>
					  <select class="form-control" id="sel1" name="comboDiv" onchange="mudancaSelect(this);">
					    <option value="A">Participantes Ativos</option>
					    <option value="I">Participantes Inativos</option>
					  </select>
					</div> 
					<br><br>

					<div id="ativos" style="display:block;">
					<table>
						<tr><td align="center" colspan="6" ><b><h2>Relação de Trocas Realizadas ( Total de participante(s) <?php print "<b>".$gdb->linhas."</b>"; ?> )</h2></b></td></tr>
						<tr>
						   <td align="left"><b>Código</b></td>
						   <td align="left"><b>Nome</b></td>
						   <td align="left"><b>Fone</b></td>
						   <td align="center"><b>Data da Última Troca</b></td>
						   <td align="center"><b>Quantidade Total:</b></td>
						</tr>
						
						  <input type="hidden" name="inscricao" id="inscricao" value="">
						  <input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >
						<? 
							foreach($gdb->gs['CODIGO'] as $key=>$value){?>
								<tr onclick="mudancaDiv('div<?php print $value;?>');" style="cursor:pointer;">
								   <td align="left"><? print $value; ?></b></td>
								   <td align="left"><? print $gdb->gs['NOME'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['CELULAR'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['DATA'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['QTDETROCA'][$key]; ?></td>
								   <td align="center">
								   	<input type="checkbox" id="checkBox<? print $value; ?>" name="checkBox<? print $value; ?>"  >
									<label for="checkBox<? print $value; ?>" >Enviar</label>
								   </td>					   
									
								</tr>
								
										 <?php
										 
										 	$select3 ="  SELECT ' ',
											                    ' ',
											                    date_format( p.dataTroca, '%d/%m/%Y' ) as data, 
																qtdeTroca 
														   FROM trocaCaixaMNC p 
														  WHERE p.codigoPessoa = '$value' 
 												       ORDER BY  dataTroca DESC 
													   limit 0,10";
													   
										 	$gdb3->open($select3);
											$gdb3->titulo_campo = ",,Data,Quantidade";
										    $gdb3->formato_campo = ",,,";
										    $gdb3->visivel_campo = "i,i,v,v";
										    $gdb3->alinha_campo = "c,c,c,d";
										 ?>
											 	<tr>
											 		<td align="left" colspan="6">
											 			<div id="div<?php print $value;?>" style="display:none;">
											 				<? $gdb3->print_tabela("Trocas do usuário", 1, 1, ""); ?>		
											 			</div>
											 		</td>
											 	</tr>					 					  
								 
						
					    	<?php }?>
					      <td align="center"  colspan="6" >
							<input type="submit" value="Enviar EMAIL" />
						  </td>						  
					    
				  </table>
				  </div>

				   <div id="inativos" style="display:none;">
				  	<table>
						<tr><td align="center" colspan="6" ><b><h2>Relação de Participantes sem Nenhuma Troca ( Total de participante(s) <?php print "<b>".$gdb2->linhas."</b>"; ?> )</h2></b></td></tr>
						<tr>
						   <td align="left"><b>Código</b></td>
						   <td align="left"><b>Nome</b></td>
						   <td align="left"><b>Telefone</b></td>
						   <td align="left"><b>Email</b></td>
						</tr>

						<? 
							foreach($gdb2->gs['CODIGO'] as $key=>$value){?>
								<tr>
								   <td align="left"><? print $value; ?></b></td>
								   <td align="left"><? print $gdb2->gs['NOME'][$key]; ?></td>
								   <td align="left"><? print $gdb2->gs['CELULAR'][$key]; ?></td>
								   <td align="left"><? print $gdb2->gs['EMAIL'][$key]; ?></td>
								   <td align="center" > 
								   	<input type="checkbox" id="checkBox<? print $value; ?>" name="checkBox<? print $value; ?>"  >
									<label for="checkBox<? print $value; ?>" >Enviar</label>
								   </td>					   
								</tr>						 
						  <?}

						  ?>
						
					    <tr>
					      <td align="center"  colspan="6" >
							<input type="submit" value="Enviar EMAIL" />
						  </td>						  
					    </tr>
				  </table>
				</div>

				  </form>  
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
			<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>

	</body>
</html>
<script>
  $('#cpf').mask("999.999.999-99");
  
  function buscar(turma){
	if( $("#nome").val() =="" && $("#fone").val() =="" && $("#bairro").val() =="" && $("#cpf").val() =="" && $("#email").val() ==""  ){ 	    
	    alert("Informe pelo menos um item ! ");
    }else{
		$("#operacao").val("buscar");
		document.frm.submit();
	}	  
  }	

  function buscarTurma( codigoTurma ){
	document.frm.action = "cursos.php?codigoUsuario=<?echo $codigoUsuario2;?>&codigoTurma="+codigoTurma;
    $("#operacao").val("");
	document.frm.submit();
  }  

  function mudancaSelect(obj){
   	if(obj.value == 'A'){
  		document.getElementById('ativos').style.display = 'block';
  		document.getElementById('inativos').style.display = 'none';
  	} else {
  		document.getElementById('ativos').style.display = 'none';
  		document.getElementById('inativos').style.display = 'block';
  	}
  }

    function mudancaDiv(obj){
   	if(document.getElementById(obj).style.display == 'none'){
  		document.getElementById(obj).style.display = 'block';
  	} else {
		document.getElementById(obj).style.display = 'none';
  	}
  }

</script>