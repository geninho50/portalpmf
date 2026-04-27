<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   
   $id =  (int)$_POST['idEvento'];
   if( $id == 0 )
   {
      $id = (int)$_GET['idEvento'];
   }

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	$tamanho = 0;
	$nome = "";
	$descricao = "";
	$politica = "";
	$eventos = "";	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM evento where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$numdocumento = $linha["numdocumento"];
			$nome = $linha["nome"];
			$dataini = $linha["data"];
			$hora = $linha["hora"];
			$solicitante = $linha["solicitante"];
			$telefone = $linha["telefone"];
			$rua = $linha["rua"];
			$bairro = $linha["bairro"];
			$descricao = $linha["descricao"];
			$horainicial = $linha['horainicial'];
			$horafinal = $linha['horafinal'];
			$co = $linha['co'];
			$qtdguarda = $linha['qtdguardas'];
			$tipoescala = $linha['tipoescala'];
			$hora100 = $linha['hora100'];
			$hora200 = $linha['hora200'];
			$material = $linha['material'];
			$relatoriofinal = $linha['relatoriofinal'];
			$status = $linha['status'];
			$naoatentido = $linha['relatorionaoatendimento'];
		}		
	}
	
	$sqlU = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultadoU = $obj->executaQuery($sqlU);
	$linhaU = mysql_fetch_array($resultadoU);
	if( $linhaU )
	{
		$matricula = $linhaU["matricula"];
		$login = $linhaU["nome"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>RELATORIO DE EVENTOS - GMF</title>
	
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="print"/>
    
    <link rel="shortcut icon" href="imagens/favicon.ico" >
	
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
     	 <tr>
      	  <td width="16%" align="center" valign="top"><img src="imagens/brasao.png" width="82" height="101" /></td>
       	  <td width="84%" align="center" valign="middle"><font class="style1">PREFEITURA MUNICIPAL DE FLORIAN&Oacute;POLIS</font><BR>
          <font class="style2">SECRETARIA MUNICIPAL DE SEGURAN&Ccedil;A E DEFESA DO CIDAD&Atilde;O<BR>
          GUARDA MUNICIPAL DE FLORIAN&Oacute;POLIS</font></td>
     	 </tr>
    	</table>
	</td>
  </tr>
  <tr>
    <td align="center"><span class="style3">RELAT&Oacute;RIO DO EVENTO</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
 
 
  <tr>
    <td>
	  <fieldset>
			<legend class="cabecalho">DADOS DO EVENTO</legend>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		   <tr>
			<td><table width="100%"  border="0" cellspacing="0" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">Evento:</span></td>
				<td width="84%" align="left"><span class="negrito"><? echo $nome;?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">N&ordm; Documento:</span></td>
				<td width="84%" align="left"><span class="negrito"><? echo $numdocumento;?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">Data:</span></td>
				<td width="11%" align="left"><span class="negrito"><? echo $dataini;?></span></td>
				<td width="8%" align="right"><span class="letra">Hora:</span></td>
				<td width="65%" align="left"><span class="negrito"><? echo $hora;?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">Solicitante:</span></td>
				<td width="49%" align="left"><span class="negrito"><? echo $solicitante;?></span></td>
				<td width="5%" align="right"><span class="letra">Telefone:</span></td>
				<td width="30%" align="left"><span class="negrito"><? echo $telefone;?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">Rua:</span></td>
				<td width="49%" align="left"><span class="negrito"><? echo $rua;?></span></td>
				<td width="5%" align="right"><span class="letra">Bairro:</span></td>
				<td width="30%" align="left"><span class="negrito"><? echo $bairro;?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="16%" align="right"><span class="letra">Descrição:</span></td>
				<td width="84%" align="left"><span class="negrito"><? echo $descricao; ?></span></td>
			  </tr>
			</table></td>
		  </tr>
		  
      </table>
	   </fieldset>
	</td>
  </tr>
 
 
 
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<fieldset>
	<legend class="cabecalho">RELATÓRIO FINAL DO EVENTO</legend>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      
		<?
		if($status==1){
			echo'<tr><td>EVENTO NAO FOI ATENDIDO!</td></tr><tr><td>'.$naoatentido.'</td></tr>';
		}else{
		?>
			  <tr>
				<td>
				 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
				  <tr>
					<td width="22%" align="right"><span class="letra">Hora Inicial:</span></td>
					<td width="9%" align="left"><span class="negrito"><? echo $horainicial;?></span></td>
					<td width="11%" align="right"><span class="letra">Hora Final:</span></td>
					<td width="58%" align="left"><span class="negrito"><? echo $horafinal;?></span></td>
				  </tr>
				 </table>
				</td>
			  </tr>
			  <tr>
				<td>
				 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
				  <tr>
					<td width="22%" align="right"><span class="letra">Chefe de Operações:</span></td>
					<td width="78%" align="left"><span class="negrito"><? echo $co; ?></span></td>
				  </tr>
				 </table>
				</td>
			  </tr>
			  <tr>
				<td>
				 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
				  <tr>
					<td width="22%" align="right"><span class="letra">Qtd de Guardas:</span></td>
					<td width="78%" align="left"><span class="negrito"><? echo $qtdguardas; ?></span></td>
				  </tr>
				 </table>
				</td>
			  </tr>
			  <tr>
				<td>
				 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
				  <tr>
					<td width="22%" align="right"><span class="letra">Hora 100%:</span></td>
					<td width="8%" align="left"><span class="negrito"><? echo $hora100;?></span></td>
					<td width="12%" align="right"><span class="letra">Hora 200%:</span></td>
					<td width="58%" align="left"><span class="negrito"><? echo $hora200;?></span></td>
				  </tr>
				 </table>
				</td>
			  </tr>
			  <tr>
				<td>
				 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
				  <tr>
					<td width="22%" align="right"><span class="letra">Equip./Material usado:</span></td>
					<td width="78%" align="left"><span class="negrito"><? echo $material; ?></span></td>
				  </tr>
				 </table>
				</td>
			  </tr>
			  <tr>
			<td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="22%" align="right"><span class="letra">Relatório de Atividade:</span></td>
				<td width="78%" align="left"><span class="negrito"><? echo $relatoriofinal; ?></span></td>
			  </tr>
			</table></td>
		  </tr>
		<?
		}
		?>
		
    </table>
	</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="46%" align="center">....................................................................................</td>
        <td width="8%">&nbsp;</td>
        <td width="46%" align="center">....................................................................................</td>
      </tr>
      <tr>
        <td align="center"><font class="negrito">Gerado por: </font><? echo $login;?> <br />
            <font class="negrito"> Matricula:</font> <? echo $matricula;?></td>
        <td>&nbsp;</td>
        <td align="center" class="negrito">Chefia Respons&aacute;vel </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="negrito">Rua Cap Euclides de Castro, 236, Coqueiros, Florian&oacute;polis - SC <br />
CEP: 88080-010 Fone/Fax: (48) 3281-4600 <br />
www.gmf.sc.gov.br</td>
  </tr>
</table>
</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	$obj->closeVar($nomeCategoria);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
