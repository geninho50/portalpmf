<?php 

  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  $gdb2 = new gdb();  
  
  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') );  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');    
    
  $nome 		 = $gdb->vargetpost('nome');  
  $cpf 		     = $gdb->vargetpost('cpf');   
  $fone 		 = $gdb->vargetpost('fone');   
  $email 	 	 = $gdb->vargetpost('email');   
  $bairro        = $gdb->vargetpost('bairro');
  $logradouro    = $gdb->vargetpost('logradouro');
  $operacao      = $gdb->vargetpost('operacao');    
  $where         = "";
  
  
  if( $operacao != ""  ){	
  
      if( $bairro != "" ){
		  $where = "where upper( e.bairro ) like upper('%$bairro%' )";
	  }

	  if( $logradouro != "" ){		  
		  
          if( $where == "" ) $where = " where upper(e.logradouro) like upper('%$logradouro%') ";
		  else  $where .= " and upper(e.logradouro) like upper('%$logradouro%') ";		  
	  }	  
	  
      if( $nome != "" ){		  
		  
          if( $where == "" ) $where = " where upper(a.nome) like upper('%$nome%') ";
		  else  $where .= " and upper(a.nome) like upper('%$nome%') ";		  
	  }	  
	  
      if( $fone != "" ){
          if( $where == "" ) $where = " where ( a.telefone like '%$fone%' or a.celular like '%$fone%' )";
		  else  $where .= " and ( a.telefone like '%$fone%' or a.celular like '%$fone%' )";
	  }	  	  
	  
      if( $email != "" ){
          if( $where == "" ) $where = " where a.email like '%$email%' ";
		  else  $where .= " and a.email like '%$email%' ";
	  }	  	  	  
	  
	  if( $cpf != "" ){
          if( $where == "" ) $where = " where a.cpf = '$cpf' ";
		  else  $where .= " and a.cpf = '$cpf' ";
	  }	  	  	  
	  
  	  $select = "   SELECT i.codigoInscricao as inscricao,
						   a.cpf,
						   a.nome,
						   a.email,
						   a.telefone,
						   a.celular,
                           upper(e.bairro) as bairro,
                           upper(e.logradouro) as logradouro,						   
						   t.codigoTurma as turma,
						   a.codigoPessoa,
					 CASE WHEN i.tipo = 'D' THEN 'Desistiu'	
                          WHEN i.tipo = 'N'	THEN 'N&atildeo Compareceu'
                          WHEN i.tipo = 'P' THEN 'Participante'
                          WHEN i.tipo = 'E' THEN 'Fila de espera'
                          WHEN i.tipo = 'M' THEN 'Convite por email'
                          WHEN i.tipo = 'O' THEN 'Aguardando revisão fila de espera'
                          WHEN i.tipo = 'A' THEN 'Enviado e-mail da revisão fila de espera'
                          WHEN i.tipo = 'C' THEN 'Compareceu'
                          ELSE 'Situação não identificada' END situacaoPessoa, 
                          date_format( p.data, '%d/%m/%y' ) as data,
                          date_format( p.hora, '%h:%m' ) as hora,
						  t.codigoTurma as turma,
						  d.docIdentificacao as docId,
						  d.comprovanteResidencia as docComprov,
						  d.comprovanteResidenciaComplementar as docCompl
					 FROM pessoa a
                     left join documentoPessoaMNC d on d.codigoPessoa = a.codigoPessoa
                     join eventoInscricao i
                       on i.codigoPessoa = a.codigoPessoa
					   
                 left join pessoaEndereco e
                       on e.codigoPessoa = a.codigoPessoa
                      and codigoProjeto = 1
					  
			    left join eventoTurma t
					   on t.codigoTurma = i.codigoTurma 
                       
                left join eventoProgramacao p
                       on p.codigoTurma  = t.codigoTurma        
					   
				$where   
				
				order by nome
				";	  
				
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
		  menu( $codigoUsuario2 ); 
		  ?>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Manuten&ccedil;&atilde;o de Cursos</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
			<form name="frm" id="frm" action="" method="post" >
			<input type="hidden" name="operacao" id="operacao" value="">
			    <div id="main" class="container" style="width: 95%;margin: 0 auto;">  
				<div class="inner">					
					  <? if( $operacao == "" ){ ?>
							<div class="row uniform">								
								<div class="6u$ 12u$(xsmall)">
								   <label>Informe as opcoes abaixo para fazer a busca</label>  
								</div>								
								<div class="6u$ 12u$(xsmall)">
								   <label>Nome</label><input type="text" id="nome" name="nome" placeholder="Contém no nome">								   
								</div>								
								<div class="6u$ 12u$(xsmall)">
								   <label>CPF</label><input type="text" id="cpf" name="cpf" placeholder="Informe o número do CPF">
								</div>								
								<div class="6u$ 12u$(xsmall)">
								   <label>Email</label><input type="text" id="email" name="email" placeholder="Contém no email">								   
								</div>
								<div class="6u$ 12u$(xsmall)">
								   <label>Logradouro</label><input type="text" id="logradouro" name="logradouro" placeholder="Contém no logradouro ">
								</div>									
								<div class="6u$ 12u$(xsmall)">
								   <label>Bairro</label><input type="text" id="bairro" name="bairro" placeholder="Contém no bairro ">
								</div>															
								<div class="6u$ 12u$(xsmall)">
								   <label>Telefone</label><input type="text" id="fone" name="fone" placeholder="Contém no número do Telefone ">
								</div>		
								<div class="12u$">
								  <ul class="actions">								
									<li><input type="button" value="Buscar" onclick="buscar();" /></li>
								  </ul>
								</div>								
								
							</div>	 							  																		
					  <?  }else if( $gdb->linhas>0 ){ ?>					  
								<div align="center">
								<table class="alt">					
								<tr><td align="center" colspan="10" ><b>Resultado da Busca <? if( $gdb->linhas>0 ) print " ( ".$gdb->linhas." pessoas )"; ?></b></td></tr>
								<?  $data = "";
									foreach($gdb->gs['DATA'] as $key=>$value){
									  if( $data != 1 )	{?>								   										
											<tr>
											   <td align="center" ><b>Nome</b></td>
											   <td align="center" ><b>CPF</b></td>
											   <td align="center" ><b>Email</b></td>
											   <td align="center" ><b>Logradouro</b></td>
											   <td align="center" ><b>Bairro</b></td>
											   <td align="center" ><b>Telefone</b></td>
											   <td align="center" ><b>Celular</b></td>
											   <td align="center" ><b>Situa&ccedil;&atilde;o</b></td>
											   <td align="center" ><b>Turma</b></td>
											   <td align="center" ><b>Documentos</b></td>
											</tr>
											<? $data = 1;							      
									  }?>
										<tr>
										   <td align="left" ><? print $gdb->gs['NOME'][$key]; ?></b></td>
										   <td align="center" ><? print $gdb->gs['CPF'][$key]; ?></td>
										   <td align="left" ><? print $gdb->gs['EMAIL'][$key]; ?></td>
										   <td align="left" ><? print $gdb->gs['LOGRADOURO'][$key]; ?></td>
										   <td align="left" ><? print $gdb->gs['BAIRRO'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['TELEFONE'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['CELULAR'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['SITUACAOPESSOA'][$key]; ?></td>
										   <td align="left" >
												<? 
												if( $gdb->gs['TURMA'][$key] != "" ){
													print $gdb->gs['DATA'][$key].' - '.$gdb->gs['HORA'][$key].'<input type="button" value="Ver turma" onclick="buscarTurma('.$gdb->gs['TURMA'][$key].');" />';
												} ?>
										   </td>
										   <td align="left" >
										   	<? 										   	 
										   	if( $gdb->gs['DOCID'][$key] != "" ){
										   		$targetPathDocIdentificacao = "../documentosParticipantes/".$gdb->gs['CODIGOPESSOA'][$key]."/".$gdb->gs['DOCID'][$key];
										   		print "<a href ='".$targetPathDocIdentificacao."'>Documento Identificação</a>";
										   	} 

										   	if($gdb->gs['DOCCOMPROV'][$key] != ""){
										   		$targetPathDocComprovante = "../documentosParticipantes/".$gdb->gs['CODIGOPESSOA'][$key]."/".$gdb->gs['DOCCOMPROV'][$key];
										   		print "<a href ='".$targetPathDocComprovante."';>Documento Comprovante Residência</a>";
										   	}

										   	if($gdb->gs['DOCCOMPL'][$key] != ""){
										   		$targetPathDocComplementar = "../documentosParticipantes/".$gdb->gs['CODIGOPESSOA'][$key]."/".$gdb->gs['DOCCOMPL'][$key];
										   		print "<a href ='".$targetPathDocComplementar."';>Documento Comprovante Residência Complementar</a>";
										   	}

										   	?>
										   </td>
									  </tr>						 																		
								  <?}?>
								  <tr>
									<td align="left" colspan="10" >
									   <input type="button" value="Voltar" onclick="window.history.back();" />									  
									</td>
								  </tr>
								  </table>
								  </div>
					  <? }else{ ?>
							<div class="table-wrapper">
							  <table class="alt" width="40%">
								  <tr><td align="center" colspan="10" ><b>Nenhum participante encontrado</b></td></tr>
								  <tr><td align="left" colspan="10" ><input type="button" value="Voltar" onclick="window.history.back();" /></td></tr>
							  </table>
							</div>
					  <? } ?>					  				  
				</div>
				</div>
				</form>
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
	if( $("#nome").val() =="" && $("#fone").val() =="" && $("#bairro").val() =="" && $("#logradouro").val() =="" && $("#cpf").val() =="" && $("#email").val() ==""  ){ 	    
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

</script>