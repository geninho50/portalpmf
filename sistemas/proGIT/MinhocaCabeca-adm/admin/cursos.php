<?php 

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  $gdb2 = new gdb();  


  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') );  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');    
  
  $adicionarParticipante = $gdb->vargetpost('adicionarParticipante')? $gdb->vargetpost('adicionarParticipante') :'N';

  $codigoTurma 		 = $gdb->vargetpost('codigoTurma');  
  $data 		     = $gdb->vargetpost('data','');   
  $hora 		 	 = $gdb->vargetpost('hora','');   
  $vagas 	 		 = $gdb->vargetpost('vagas','');   
  $codigoProgramacao = $gdb->vargetpost('codigoProgramacao');
  $codigoInscricao   = $gdb->vargetpost('codigoInscricao');
  $situacaoTurma     = $gdb->vargetpost('situacaoTurma');  
  $operacao          = $gdb->vargetpost('operacao');  
  
  if($adicionarParticipante == 'S'){
  	$select = "SELECT nome, cpf, codigoPessoa FROM pessoa a ORDER BY nome";
  } else if( $codigoTurma != "" && $codigoProgramacao != "" && $operacao == ""  ){	
     if( $situacaoTurma != 'Encerrado' ){
		 $gdb->open("UPDATE eventoProgramacao SET data = '$data',hora = '$hora:00' WHERE codigoProgramacao='$codigoProgramacao'  "); 
		 $gdb->open("UPDATE eventoTurma       SET numeroVagas = '$vagas' WHERE codigoTurma='$codigoTurma' "); 
	 }
	 $gdb->open("Select codigoInscricao as inscricao FROM eventoInscricao WHERE codigoTurma='$codigoTurma' ");
	 
	 foreach( $gdb->gs['INSCRICAO'] as $key=>$value ){
		if( $gdb->vargetpost('situacao'.$value) !="" ){ 
			$tipo = $gdb->vargetpost('situacao'.$value); 
			$gdb2->open("UPDATE eventoInscricao SET tipo = '$tipo' WHERE codigoInscricao='$value' ");
	    }	
	 }
	 
	  $select = "  SELECT date_format( data, '%d/%m/%Y' ) as data, 
							   date_format( hora, '%H:%m' ) as hora,
							   numeroVagas as vagas,
							   e.cargaHoraria,					   
					(   select count(codigoInscricao) from eventoInscricao i where i.tipo in ('P','C') and i.codigoTurma = t.codigoTurma   ) as Inscritos,
							   t.codigoTurma,
					 CASE WHEN   date_format( data, '%Y%m%d' )<date_format( sysdate(), '%Y%m%d' ) THEN 'Encerrado' ELSE '<b>Em aberto</b>' END as situacao 
						  FROM eventoProgramacao p, 
							   eventoTurma t,
							   evento e							   
						 where p.codigoTurma = t.codigoTurma        
						   and t.codigoEvento = e.codigoEvento						   
						   and e.codigoEvento = 1
						   order by date_format( data, '%Y%m%d' ) desc,hora, numeroVagas, e.cargaHoraria ";
					   
	  $codigoTurma = "";
	  
  }else if( $codigoTurma == "" && $operacao == "" ){
		    $select = " SELECT date_format( data, '%d/%m/%Y' ) as data, 
							   date_format( hora, '%H:%m' ) as hora,
							   numeroVagas as vagas,
							   e.cargaHoraria,					   
					(   select count(codigoInscricao) from eventoInscricao i where i.tipo in ('P','C') and i.codigoTurma = t.codigoTurma   ) as Inscritos,
							   t.codigoTurma,
					 CASE WHEN   date_format( data, '%Y%m%d' )<date_format( sysdate(), '%Y%m%d' ) THEN 'Encerrado' ELSE '<b>Em aberto</b>' END as situacao 
						  FROM eventoProgramacao p, 
							   eventoTurma t,
							   evento e							   
						 where p.codigoTurma = t.codigoTurma        
						   and t.codigoEvento = e.codigoEvento						   
						   and e.codigoEvento = 1
						   order by date_format( data, '%Y%m%d' ) desc,hora, numeroVagas, e.cargaHoraria ";
  }else if( ( $operacao == "novo" && $data !="" && $hora != "" && $vagas !="" ) or ( $operacao == "excluir" && $codigoTurma !="" )  ){
        /* */
		    if( $operacao == "novo" ){
				$gdb->open("insert into eventoTurma(codigoEvento,descricao,numeroVagas) values('1','Turma Compostagem','$vagas') "); 
				$gdb->open("select max(codigoTurma) as codigo  from eventoTurma");
				$codigoTurma = $gdb->gs['CODIGO'][0];		
				if( $codigoTurma !="" ){
				   $gdb->open("insert into eventoProgramacao(data,hora,codigoTurma,codigoEvento) values('$data','$hora:00','$codigoTurma',1) "); 
				}   
			}else{
				$gdb->open("delete from eventoTurma where codigoTurma = '$codigoTurma' "); 
				$gdb->open("delete from eventoProgramacao where codigoTurma = '$codigoTurma' "); 
			}
			
		    $codigoTurma = "";
		    $operacao     = "";
		    $select = " SELECT date_format( data, '%d/%m/%Y' ) as data, 
							   date_format( hora, '%H:%m' ) as hora,
							   numeroVagas as vagas,
							   e.cargaHoraria,					   
					(   select count(codigoInscricao) from eventoInscricao i where i.tipo in ('P','C') and i.codigoTurma = t.codigoTurma   ) as Inscritos,
							   t.codigoTurma,
					 CASE WHEN   date_format( data, '%Y%m%d' )<date_format( sysdate(), '%Y%m%d' ) THEN 'Encerrado' ELSE '<b>Em aberto</b>' END as situacao 
						  FROM eventoProgramacao p, 
							   eventoTurma t,
							   evento e							   
						 where p.codigoTurma = t.codigoTurma        
						   and t.codigoEvento = e.codigoEvento						   
						   and e.codigoEvento = 1
						   order by date_format( data, '%Y%m%d' ) desc,hora, numeroVagas, e.cargaHoraria ";			
						   
  }else{
	  $select = "	SELECT date_format( data, '%Y-%m-%d' ) as data,
						   date_format( hora, '%H:%m' ) as hora,
						   date_format( data, '%d/%m/%Y' ) as data2,
					  CASE WHEN   date_format( data, '%Y%m%d' )<date_format( sysdate(), '%Y%m%d' ) THEN 'Encerrado' ELSE 'Em aberto ' END as situacao  ,
						   numeroVagas as vagas,       
						   i.codigoInscricao as inscricao,
						   a.cpf,
						   a.nome,
						   a.email,
						   a.telefone,
						   a.celular,
						   p.codigoProgramacao as programacao,
						   t.codigoTurma as turma,
						   a.codigoPessoa,
					 CASE WHEN i.tipo = 'D' THEN 'Desistiu'	
                          WHEN i.tipo = 'N'	THEN 'N&atildeo Compareceu'
						  else '' END situacaoPessoa 
					  FROM eventoProgramacao p, 
						   eventoTurma t,
						   evento e,
						   eventoInscricao i,
						   pessoa a
					 where p.codigoTurma = t.codigoTurma        
					   and t.codigoEvento = e.codigoEvento
					   and i.codigoTurma = t.codigoTurma
					   and e.codigoEvento = 1
					   and a.codigoPessoa = i.codigoPessoa
					   and t.codigoTurma = '$codigoTurma'
					   -- group by date_format( data, '%Y%m%d' ) desc,hora, numeroVagas, e.cargaHoraria
					   order by date_format( data, '%Y%m%d' ) desc, hora, a.nome";	  
  }				   

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
						<h2>Manuten&ccedil;&atilde;o de Cursos</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
			<form name="frm" id="frm" action="" method="post" >
			<input type="hidden" name="operacao" id="operacao" value="">
			<div id="main" class="container">  
				<div class="inner">
					<header class="align-left">
					<table id="myTable">
					  <? 
					  		if($adicionarParticipante == 'S') {
					  ?>
					  		<tr>
					  			<td align="center">
					  				<input type="hidden" name="codigoTurma" id="codigoTurma" value="">								  
								  	<input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >
								  	<input type="hidden" name="adicionarParticipante" id="adicionarParticipante" value="<?=$adicionarParticipante?>" >
					  				<select id="codigoPessoa" name="codigoPessoa">
					  					<? foreach($gdb->gs['CODIGOPESSOA'] as $key=>$value) { ?>
					  						<option value="<?=$gdb->gs['CODIGOPESSOA'][$key]?>"><?php echo $gdb->gs['NOME'][$key]." - ".$gdb->gs['CPF'][$key] ?></option>
					  					<? } ?>
					  				</select>
					  				<input type="button" value="Incluir" onclick="cadastrarParticipanteCurso(<?=$codigoTurma?>, document.getElementById('codigoPessoa').options[document.getElementById('codigoPessoa').selectedIndex].value)">
					  			</td>
					  		</tr>
					  <?
							} else if( $codigoTurma == "" && $operacao == "" ){ ?>
								<tr><td align="center" colspan="8" ><b>Rela&ccedil;&atilde;o de Cursos</b></td></tr>
								<tr>
								   <td align="center" ><b>Data</b></td>
								   <td align="center" ><b>Hora</b></td>
								   <td align="center" ><b>Carga Horario</b></td>
								   <td align="center" ><b>Vagas</b></td>
								   <td align="center" ><b>Total de Inscritos</b></td>						   
								   <td align="center" ><b>Situa&ccedil;&atilde;o</b></td>						   
								   <td colspan="2" align="center" ><input type="button" value="Novo" onclick="novoCurso(1);" /></td>
								</tr>								
								  <input type="hidden" name="codigoTurma" id="codigoTurma" value="">								  
								  <input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >
								  <input type="hidden" name="adicionarParticipante" id="adicionarParticipante" value="<?=$adicionarParticipante?>" >
								<? 
									foreach($gdb->gs['DATA'] as $key=>$value){?>
										<tr>
										   <td align="center" ><? print $value; ?></b></td>
										   <td align="center" ><? print $gdb->gs['HORA'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['CARGAHORARIA'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['VAGAS'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['INSCRITOS'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['SITUACAO'][$key]; ?></td>
										   <td align="center" >    
											 <? if( $gdb->gs['INSCRITOS'][$key]>0){ ?>		
													<input type="button" value="Editar" onclick="editarCurso(<? print $gdb->gs['CODIGOTURMA'][$key]; ?>);" />																		 
											 <? }else{?>
													<input type="button" value="Excluir" onclick="excluirCurso(<? print $gdb->gs['CODIGOTURMA'][$key]; ?>);" />
											 <? }?>
										   </td>
										   <td><input type="button" value="INCLUIR" onclick="cadastrarParticipante(<? print $gdb->gs['CODIGOTURMA'][$key]; ?>);" /></td>
										</tr>
								  <?}
					     }else if( $operacao == "novo" ){ ?>
								<tr><td align="center" colspan="6" ><b>Dados do Curso</b></td></tr>
								<tr>
								   <td align="center" colspan="2" ><b>Data</b></td>
								   <td align="center" colspan="2" ><b>Horario</b></td>
								   <td align="center" ><b>Vagas</b></td>
								</tr>
								<tr>
								   <td align="center"  colspan="2" ><input type="date" id="data" name="data" size="10" value="" ></b></td>
								   <td align="center" colspan="2"><input type="time" id="hora" name="hora" size="5" value="" ></td>									   
								   <td align="center" ><input type="number" id="vagas" name="vagas" size="5" value="" ></td>									   																
								</tr>	
							    <tr>
								  <td align="left" colspan="3" >
								   <input type="button" value="Voltar" onclick="window.history.back();" />
								   <input type="button" value="Salvar" onclick="novoCurso(2);" />
								  </td>
							    </tr>								
					  <? }else{ ?>
					  
								<tr><td align="center" colspan="6" ><b>Dados do Curso</b></td></tr>
								<tr>
								   <td align="center" colspan="2" ><b>Data</b></td>
								   <td align="center" colspan="2" ><b>Horario</b></td>
								   <td align="center" ><b>Vagas</b></td>
								   <td align="center" ><b>Situa&ccedil;&atilde;o</b></td>						   
								</tr>								
								
								  <input type="hidden" name="codigoTurma" id="codigoTurma" value="<? print $codigoTurma; ?>" >
								  <input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario2; ?>" >
								  <input type="hidden" name="codigoProgramacao" id="codigoProgramacao" value="<? print $gdb->gs['PROGRAMACAO'][0]; ?>" >							  
								  <input type="hidden" name="situacaoTurma" id="situacaoTurma" value="<? print $gdb->gs['SITUACAO'][0]; ?>" >							  
								  <input type="hidden" name="adicionarParticipante" id="adicionarParticipante" value="<?=$adicionarParticipante?>" >
								<?  $data = "";
									foreach($gdb->gs['DATA'] as $key=>$value){
									  if( $data != $value )	{?>								   
										<tr>
										  <? if( $gdb->gs['SITUACAO'][$key] !='Encerrado' ){ ?>
											   <td align="center"  colspan="2" ><input type="date" id="data" name="data" size="10" value="<? print $value; ?>" ></b></td>
											   <td align="center" colspan="2"><input type="time" id="hora" name="hora" size="5" value="<? print $gdb->gs['HORA'][$key]; ?>" ></td>									   
											   <td align="center" ><input type="number" id="vagas" name="vagas" size="5" value="<? print $gdb->gs['VAGAS'][$key]; ?>" ></td>									   										   
										  <? }else{?> 
											   <td align="center"colspan="2" ><? print $gdb->gs['DATA2'][$key]; ?></b></td>
											   <td align="center"colspan="2" ><? print $gdb->gs['HORA'][$key]; ?></td>										   
											   <td align="center" ><? print $gdb->gs['VAGAS'][$key]; ?></td>									   									  
										  <? }?> 
										  <td align="center" ><? print $gdb->gs['SITUACAO'][$key]; ?></td>									   					   
										</tr>						 																		
										<tr><td align="center" colspan="7" ><b>Participantes</b></td></tr>
										
										<tr>
										   <td align="center" ><b>Nome</b></td>
										   <td align="center" ><b>CPF</b></td>
										   <td align="center" ><b>Email</b></td>
										   <td align="center" ><b>Telefone</b></td>
										   <td align="center" ><b>Celular</b></td>
										   <td align="center" ><b>Opera&ccedil;&atilde;o</b></td>									   
										</tr>
								   <?
									   $data = $value;							      
									  }?>
										<tr>
										   <td align="left" ><? print $gdb->gs['NOME'][$key]; ?></b></td>
										   <td align="center" ><? print $gdb->gs['CPF'][$key]; ?></td>
										   <td align="left" ><? print $gdb->gs['EMAIL'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['TELEFONE'][$key]; ?></td>
										   <td align="center" ><? print $gdb->gs['CELULAR'][$key]; ?></td>
										   <td align="left" ><? 
																if( $gdb->gs['SITUACAOPESSOA'][$key] == "" ){
																	montarCombo( $gdb->gs['SITUACAO'][$key], $gdb->gs['INSCRICAO'][$key] );
																}else{
																	print $gdb->gs['SITUACAOPESSOA'][$key];
																} ?></td>
									  </tr>						 																		
								  <?}?>
								  <tr>
									<td align="left" colspan=6 >
									  <input type="button" value="Voltar" onclick="window.history.back();" />
									  <input type="button" value="Salvar" onclick="salvar();" />
									  <input type="button" value="Gerar Lista" onclick="gerarLista();" />
									  <input type="button" value="Imprimir" onclick="window.print();" />
									</td>
								  </tr>
					  <? } ?>
					  
				  </table>
					</header>
				</div>
			</div>
			</form>
			<form id="pdf2" method="post" action="cursos.excel.php" target="_blank"></form>
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
  	function gerarLista(){
		var table, rows, i;
		var dados = new Array();
		var form = document.getElementById("pdf2");
		table = document.getElementById("myTable");
		rows = table.rows;
		dados[0] = new Array(3);
		dados[0][0] = document.getElementById("data").value;
		dados[0][1] = document.getElementById("hora").value;
		dados[0][2] = document.getElementById("vagas").value;
		var input_dados = document.createElement("input");
		input_dados.type = "hidden";
		input_dados.name = "dados[0]";
		input_dados.value = dados[0];
		form.appendChild(input_dados);
		for (i = 5; i <= (rows.length - 2); i++) {
			dados[i-4] = new Array(5);
			dados[i-4][0] = rows[i].getElementsByTagName("td")[0].innerHTML;
			dados[i-4][1] = rows[i].getElementsByTagName("td")[1].innerHTML;
			dados[i-4][2] = rows[i].getElementsByTagName("td")[2].innerHTML;
			dados[i-4][3] = rows[i].getElementsByTagName("td")[3].innerHTML;
			dados[i-4][4] = rows[i].getElementsByTagName("td")[4].innerHTML;

			var input_dados = document.createElement("input");
			input_dados.type = "hidden";
			input_dados.name = "dados[" + (i-4) + "]";
			input_dados.value = dados[(i-4)];
			form.appendChild(input_dados);
		}

		form.submit();
	}

  function editarCurso(turma){
	if( confirm("Tem certeza que deseja alterar dados deste curso ? ") ){ 	    
	    $("#codigoTurma").val( turma );
	    document.frm.submit();	  
    }	  
  }	  
  
  function excluirCurso(turma){
	if( confirm("Tem certeza que deseja excluir esta turma ? ") ){ 	    
	    $("#codigoTurma").val( turma );
		$("#operacao").val("excluir");
	    document.frm.submit();	  
    }	  
  }	    

  function cadastrarParticipante(codigoTurma) {
  	if( confirm("Tem certeza que deseja incluir um participante nesta turma ? ") ){ 	 
	  	$("#codigoTurma").val( codigoTurma );
	  	$("#adicionarParticipante").val('S');
	  	document.frm.submit();	
	}
  }
  
   function cadastrarParticipanteCurso(codigoTurma, codigoPessoa) {
  	$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "../../banco/cadastrarParticipanteCursoMNC.php", 
		  data: {
		  			codigoTurma : codigoTurma,
		  			codigoPessoa : codigoPessoa
		  		},
		  success: function( data ){
					 if( data.success == 1 ){
						 alert("O participante foi adicionado à turma.");
						 $("#adicionarParticipante").val('N');
	  					 document.frm.submit();	 
					 } else {
					     alert("Ocorreu um erro ao adicionar o participante à turma."); 		
					 }
				  },
		 error: function( data ){
			console.log( data );
		 }
		} 
		);
  }

  function novoCurso(opcao){
	if(opcao == 1){  
		// if( confirm("Tem certeza que deseja alterar dados deste curso ? ") ){ 	    
			$("#operacao").val("novo");		
			document.frm.submit();
		// }
	}else{
	   if( $("#data").val()=="" ){
		   alert("Informe a data !");
		   $("#data").focus();
	   }else if( $("#hora").val()=="" ){
		   alert("Informe a hora !");
		   $("#hora").focus();
	   }else if( $("#vagas").val()=="" ){
		   alert("Informe o numero de vagas!");
		   $("#vagas").focus();
	   }else if( confirm("Tem certeza que deseja criar esta nova turma ? ") ){
		  $("#operacao").val("novo");		
		  document.frm.submit();
	   }	 
	}	
  }	  
  
  function salvar(){
	if( confirm("Tem certeza que deseja salvar ? ") ){  
		document.frm.submit();	  
	}
  }  
</script>

<?
  function montarCombo($situacao,$codigo){
    if( $situacao == 'Encerrado'){?>
		<select name = "situacao<? print $codigo; ?>" >
		   <option value=""></option>
		   <option value="D">Desistiu</option>
		   <option value="N">N&atilde;o compareceu</option>
		</select>		
<?	}else{ 

	  $gdb3 = new gdb();  
	  
	  $gdb3->open("select codigoProgramacao as codigo, 
	                      date_format( data, '%d/%m/%Y' ) as data, 
						  date_format( hora, '%H:%m' ) as hora 
				     from eventoProgramacao p, eventoTurma t
					where date_format( data, '%Y%m%d' )>date_format( sysdate(), '%Y%m%d' )
					  and p.codigoTurma = t.codigoTurma
					  and t.numeroVagas>(  select count(*) 
					                         from eventoInscricao ee 
											where ee.codigoEvento = 1 
											  and ee.codigoTurma = t.codigoTurma   )
				 order by date_format( data, '%Y%m%d' ) desc,hora "); 
?>					
	  <select name = "situacao<? print $codigo; ?>" >
	     <option value=""></option>
	     <option value="D">Desistiu</option>		   
	<?	  if( $gdb3->linhas>0 ){?>		  
			<option value=""></option>
	        <option value=""><b>Datas com vagas disponiveis</b></option>
	<?		foreach($gdb3->gs['CODIGO'] as $i=>$value2 ){ ?>
			  <option value="<? print $value2; ?>"><? print $gdb3->gs['DATA'][$i].' - '.$gdb3->gs['HORA'][$i]; ?></option>
	<?		}			
		  }	?>			
	  </select>		
<?	}
  } ?>