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
			$motivo = $linha["motivo"];
			$horainicial = $linha["horainicial"];
			$horafinal = $linha["horafinal"];
			$co = $linha["co"];
			$qtdguarda = $linha["qtdguarda"];
			$tipoescala = $linha["tipoescala"];
			$hora100 = $linha["hora100"];
			$hora200 = $linha["hora200"];
			$material = $linha["material"];
			$relatoriofinal = $linha["relatoriofinal"];
			$relatorionaoatendimento = $linha["relatorionaoatendimento"];
			$tamanho = strlen($nome);
			
			// Path
			$path = $objT->getPath(16).$id."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
		}		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">DADOS ANTERIORES AO EVENTO</legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
		  <tr>
		    <td width="30%" height="3" align="right" class="letra">Evento:</td>
		    <td width="70%" align="left"  class="negrito"><? echo $nome;?></td>
	    </tr>
		  <tr>
			<td align="right" class="letra">N&ordm; Documento:</td>
			<td align="left"  class="negrito"><? echo $numdocumento;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Data:</td>
			<td align="left" class="negrito"><? echo $dataini;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Hora:</td>
			<td width="966" class="negrito"><? echo $hora;?></td>
		 </tr>
		  <tr>
			<td align="right" class="letra">Solicitante:</td>
			<td align="left" class="negrito"><? echo $solicitante;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Telefone:</td>
			<td align="left" class="negrito"><? echo $telefone;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Rua:</td>
			<td align="left" class="negrito"><? echo $rua;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Bairro:</td>
			<td align="left" class="negrito"><? echo $bairro;?></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descricao:</td>
			<td align="left" class="negrito"><? echo $descricao; ?></td>
		  </tr>
		  <tr>	
			<td align="right" class="letra">Nao Atendido:</td>
			<td align="left" class="negrito"><? echo $relatorionaoatendimento; ?></td>
		  </tr>
		</table>
	<!-- fim do adm -->
	
   	  <fieldset>
	<legend class="cabecalho">RELATÓRIO FINAL DO EVENTO</legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		 <tr>
			<td width="30%" align="right" class="letra">Hora Inicial:</td>
			<td width="70%"><? echo $horainicial;?></td>
		 </tr>
		  <tr>
			<td align="right" class="letra">Hora Final:</td>
			<td width="929"><? echo $horafinal;?></td>
		 </tr>
		  <tr>
			<td align="right" class="letra">Chefe de Operacoes:</td>
			<td align="left" class="letra"><? echo $co;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">N de Guardas:</td>
			<td width="929"><? echo $qtdguarda;?></td>
		 </tr>
		  <tr>
			<td align="right" class="letra">Tipo de Escala:</td>
			<td align="left" class="letra"><? echo $tipoescala;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Hora de 100:</td>
			<td align="left" class="letra"><? echo $hora100;?></td>
		  </tr>
		  <tr>
			<td align="right" class="letra">Hora de 200:</td>
			<td align="left" class="letra"><? echo $hora200;?></td>
		  </tr>
		 <tr>
			<td align="right" valign="top" class="letra">Equipamento/Material usado:</td>
			<td align="left" class="letra"><? echo $material;?></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descricao:</td>
			<td align="left" class="letra"><? echo $relatoriofinal;?></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descricao:</td>
			<td align="left" class="letra"><? echo $relatorionaoatendimento;?></td>
		  </tr>
		</table>
		</fieldset>
    	
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
