<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$guarda = $_POST['xGM1_1'];
	
	$datainicial = $_POST['xdataini'];
	$datafinal = $_POST['xdatafinal'];
	
	$arrayI = explode("-", $datainicial);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
	
	$arrayF = explode("-", $datafinal);
	$diaf = $arrayF[2];
	$mesf = $arrayF[1];
	$anof = $arrayF[0];	
	
	$guarda = trim($guarda);
	$tamanho = strlen($guarda);
	$nvaloresencontrados = 0;
	
	echo $queryC = "SELECT * FROM guarnicao WHERE guarda1='$guarda' OR guarda2='$guarda' OR guarda3='$guarda' OR guarda4='$guarda' OR guarda5='$guarda' and data_entrada between '$datainicial' and '$datafinal' order by data_entrada desc";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($queryC);
	}
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42%" align="left">&nbsp;</td>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTAR OCORRÊNCIA POR GUARDA</legend>
		<form name="form1" method="post" action="relatorio_guarda.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		    <tr>
		      <td align="right" class="letra">Data Inicial: </td>
		      <td align="left" class="letra">
			  <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12" class="codigo"/>
			<a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			  </td>
	      </tr>
		    <tr>
		      <td align="right" class="letra">Data Final: </td>
		      <td align="left" class="letra">
			  <input type="text" value="<? echo $datafinal;?>" readonly name="xdatafinal" size="12" class="codigo"/>
			<a onClick="displayCalendar(document.forms[0].xdatafinal,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			  </td>
	      </tr>
		    <tr>
		      <td width="10%" align="right" class="letra">Guarda:</td>
		      <td width="90%" align="left" class="letra"><input type="text" name="xGM1_1" id="xGM1_1" size="20" class="codigo"/></td>
	      </tr>
	      <tr>
			<td align="right" class="letra">&nbsp;</td>
			<td align="left" class="letra"><input name="Pesquisar" type="submit" class="botao" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
		  </tr>
		</table>
		
		
		
		</form>
		</fieldset>

	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="cabecalho">RETORNOU <B><? echo $nvaloresencontrados;?></B> OCORRÊNCIAS PARA O GUARDA <? echo $guarda;?>.</legend>

		<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
            <tr align="center">
              <td width="6%" class="branco"><b>Ocorr&ecirc;ncia</b> </td>
			  <td width="10%" align="center" class="branco"><b>Guarni&ccedil;&atilde;o</b></td>
			  <td width="8%" align="center" class="branco"><b>Data</b></td>
              <td width="19%" align="left" class="branco"><b>Descri&ccedil;&atilde;o</b></td>
			  <td width="19%" align="left" class="branco"><b>Encerramento</b></td>
		  </tr>
	  </table>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse: collapse">
		<?
			$chavet = true;
			$resultadoC = $obj->executaQuery($queryC);
			while( $linhaC = mysql_fetch_array($resultadoC) )
			{
				$idguarnicao = $linhaC['id'];
				$outrosC = $linhaC['outros'];
				$vtrC = $linhaC['vtr'];
				$guarda1C = $linhaC['guarda1'];
				$guarda2C = $linhaC['guarda2'];
				$guarda3C = $linhaC['guarda3'];
				$guarda4C = $linhaC['guarda4'];
				$guarda5C = $linhaC['guarda5'];
				$hora_entradaC = $linhaC['hora_entrada'];
				$hora_saidaC = $linhaC['hora_saida'];
				$data_entradaC = $linhaC['data_entrada'];
				
				$arrayI = explode("-", $data_entradaC);
				$diai = $arrayI[2];
				$mesi = $arrayI[1];
				$anoi = $arrayI[0];
				
				$sql = "select ocorrencia.id, ocorrencia.descricao_ocorrencia,ocorrencia.encerramento_ocorrencia from ocorrencia_guarnicao inner join ocorrencia where idguarnicao=$idguarnicao and ocorrencia_guarnicao.idocorrencia=ocorrencia.id";
				$result = $obj->executaQuery($sql);
				if( $linha = mysql_fetch_array($result) )
				{
					$idocorrencia = $linha['id'];
					$descricao_ocorrencia = $linha['descricao_ocorrencia'];
					$encerramento_ocorrencia = $linha['encerramento_ocorrencia'];
		?>

		  <tr bgColor="<?PHP if($chavet)
								{
									echo '#cccccc';
								}
								else{ 
									echo '#ffffff';
								} 
								$chavet=!$chavet;
							?>" >
			<td width="6%" align="center" class="negrito"><? echo $idocorrencia;?></td>
			<td width="10%" align="center" class="negrito"><a href="relatorio_guarnicao_imprimir.php?idguarnicao=<? echo $idguarnicao;?>" target="_blank">
							<? 
								if($guarda1C != '' ){echo $guarda1C;}
								if($guarda2C != '' ){echo ' / '.$guarda2C;}
								if($guarda3C != '' ){echo ' / '.$guarda3C;}
								if($guarda4C != '' ){echo ' / '.$guarda4C;}
								if($guarda5C != '' ){echo ' / '.$guarda5C;}
							?>
						  </a>
			</td>
			<td width="8%" align="center" class="negrito"><? echo $diai.'-'.$mesi.'-'.$anoi;?></td>
			<td width="19%" class="negrito"><? echo $descricao_ocorrencia;?></td>
			<td width="19%" class="negrito"><? echo $encerramento_ocorrencia;?></td>
		  </tr>
		 <?
		 		}
		 }
		 ?> 
</table>

</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="cabecalhO">RETORNOU <B><?echo $nvaloresencontrados;?></B> PARA O GUARDA <? echo $guarda;?>.</legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para o Guarda <B> <? echo $guarda;?>.</B></td>
	</tr>	
</table>
</fieldset>
<?
}
?>


    </td>
  </tr> 
	
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>