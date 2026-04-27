			<!-- ini inc head -->
					<?php 
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	ini_set('default_charset','UTF-8');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
					include("incValidaSessao.php");
					$idsession = $_SESSION['idSESSION'];
					require ("../classes/DB_mysql.php");
					require ("../classes/trataString.php");
					$obj = new DB_mysql ;
					$objS = new trataString;
					$conexao = $obj->conectarConf();
					include("head/incHeadCentral.php");
					?>
			<!-- fim inc head -->
			<legend class="fieldset">OCORRÊNCIAS EM ABERTO</legend>
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0" valign="top" align="left">
			<tr>
				<th width="4%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			
			<? 
				$sqlA = "SELECT * FROM ocorrencia where status=0 order by setor";
				$resultadoA = $obj->executaQuery($sqlA);
				while( $linhaA = mysql_fetch_array($resultadoA))
				{
					$id = $linhaA["id"];
					$telefone = $linhaA["telefone"];
					$comunicante = $linhaA["comunicante"];
					$rua = $linhaA["rua"];
					$numero = $linhaA["numero"];
					$bairro = $linhaA["bairro"];
					$setor = $linhaA["setor"];
					$descricao = $linhaA["descricao_ocorrencia"];
					$hora_cadastro = $linhaA["hora_cadastro"];
			?>
			<tr valign="top">
				<th align="center" valign="top" scope="col">&nbsp;</th>
				<th width="96%" align="left" valign="top" class="negrito" scope="col" title="<? echo 'Comunicante:'.$comunicante.' - '.$telefone.'&#13;Endere&ccedil;o: '.$rua.', '.$numero.' - '.$bairro.' - Setor '.$setor.'&#13;Descri&ccedil;&atilde;o: '.$descricao;?>"><a href="javascript:POPUP('empenhar_guarnicao.php?idOcorrencia=<? echo $id; ?>','900','550')"><? echo $hora_cadastro.' - '.$rua.'<font color="#FF0000"> - SETOR <font>'.$setor;?></a>
				  <br><HR></th>
			  </tr>
			<?
			}
			?>	
			
		</table>
		</fieldset>
