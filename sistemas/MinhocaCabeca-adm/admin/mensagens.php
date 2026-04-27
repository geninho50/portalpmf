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
    
  $select = "   select codigoMensagem as codigo, 
					   nome, 
					   assunto as titulo, 
					   date_format( dataEnvio,'%d/%m/%Y') as data, 
					   case when ( select count(*) 
									 from caixaRespostaMNC r 
									where r.codigoMensagem = c.codigoMensagem )>0 Then 'Respondido'  
							else 'Aguardando' end as situacao,
                        mensagem as duvida							
				  from caixaEnvioMNC c, 
					   usuario u 
				 where u.codigoUsuario = c.codigoUsuario 
			order by dataEnvio desc";

  $select2 = "  select codigoResposta as codigo, 
					   nome,
					   date_format( dataResposta,'%d/%m/%Y') as data,
					   mensagem,
					   resposta
				  from caixaEnvioMNC c, 
					   caixaRespostaMNC r,
					   usuario u 
				 where u.codigoUsuario = r.codigoUsuario 
				   and c.codigoMensagem =  r.codigoMensagem 
				   and c.codigoMensagem = ";

  $gdb->open( $select );
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
				<div class="logo"><a href="../residuometro.html">RESIDUÔMETRO</a></div>
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
						<p><Strong>PROJETO MINHOCA NA CABEÇA</Strong></p>
						<h2>Caixa de Mensagens</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">

				<div class="inner">
					<form name="frm" id="frm" action="" method="post" >
					  <h1><strong>Clique na mensagem para ver o histórico.</strong></h1>
					</div> 
					<br><br>
					<table>
						<tr><td align="center" colspan="6" ><b><h2>Mensagens enviadas</h2></b></td></tr>
						<tr>
						   <td align="left"><b>Código</b></td>
						   <td align="left"><b>Nome</b></td>
						   <td align="left"><b>Assunto</b></td>
						   <td align="center"><b>Data</b></td>
						   <td align="center"><b>Situação</b></td>
						</tr>
						
						  <input type="hidden" name="inscricao" id="inscricao" value="">
						  <input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario; ?>" >
						<? 
							foreach($gdb->gs['CODIGO'] as $key=>$value){?>
								<tr onclick="mudancaDiv('div<?php print $value;?>');" <? if(  $gdb->gs['SITUACAO'][$key] == 'Aguardando' ){ print ' style="cursor:pointer;background:#C0C0C0;font-weight:bold;" '; }else{ print ' style="cursor:pointer;" '; } ?> >
								   <td align="left"><? print $value; ?></b></td>
								   <td align="left"><? print $gdb->gs['NOME'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['TITULO'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['DATA'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['SITUACAO'][$key]; ?></td>									
								</tr>
								 <?php									
									$gdb3->open( $select2." $value ");
									if( $gdb3->linhas>0 ){
										
										$gdb3->titulo_campo = "codigo,Usuário,Data,Dúvida,Resposta";
										$gdb3->formato_campo = ",,,,";
										$gdb3->visivel_campo = "i,v,v,v,v";
										$gdb3->alinha_campo = "d,d,c,e,e";
									}
									?>
									<tr>
										<td align="left" colspan="5">
											<div id="div<?php print $value;?>" style="display:none;">
												<?php 
												  if( $gdb3->linhas>0 ){ $gdb3->print_tabela("Resposta", 1, 1, ""); }
												  else{?> 
													 Dúvida   :   <b><?php print $gdb->gs['DUVIDA'][$key]; ?></b><br>  
												     Resposta:<textarea name="texto<?php print $value;?>" id="texto<?php print $value;?>" cols="100" rows="5"></textarea><br>
													<input type="button" class="button special" onclick="enviar(<?php print $value;?>);" value="Enviar" />
									  	    <?php }?>
											</div>
										</td>
									</tr>
									
					  <?php } ?>
				  </table>
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

	function enviar( codigo, codigoMensagem ){
		if(confirm("Deseja enviar esta mensagem?")){
			if($("#titulo").val()==""){
				alert("Informe o Assunto");

			}else if($("#texto").val()==""){
				alert("Informe a Mensagem");

			}else{
			   data = {
					 "tipo": "r",
					 "titulo": "",
					 "codigoMensagem":codigo,
					 "texto": $("#texto"+codigo ).val(),
					 "codigoUsuario": $("#codigoUsuario").val()
				};
				
				data = $( this ).serialize() + "&" + $.param(data);

				$.ajax( {
				  type: "POST",
				  dataType: "json",
				  url: "../../banco/enviarMensagem.php", 
				  data: data,
				  success: function( data ){
							if( data == 1){
								$("#texto"+codigo).val("");
								alert("Resposta enviada com sucesso!"); 
								frm.submit();
							}else{
								alert("Tivemos problema no envio da sua mensagem! Tente novamente mais tarde.");
							}	 
						  },
				 error: function( data ){
					console.log( data );
				 }
				} 
				);
			}
		}
	}
  
</script>