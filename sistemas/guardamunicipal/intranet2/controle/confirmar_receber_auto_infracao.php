<?php
ini_set('default_charset','UTF-8');

// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;

	
	$sqlR = "SELECT * FROM temp_receber_auto order by numbloco";
	$resultadoR = $obj->executaQuery($sqlR);
	$linhaR = mysql_fetch_array($resultadoR);
	if( $linhaR )
	{
		$loginR = $linhaR["login"];
		$matriculaR = $linhaR["matricula"];
		$numblocoR = $linhaR["numbloco"];
		$letraR = $linhaR["letra"];
		$quantidadeR = $linhaR["quantidade"];
		$data_cadastroR = $linhaR["data_cadastro"];
		$hora_cadastroR = $linhaR["hora_cadastro"];
	}
	
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
    <th width="100%" colspan="2">
		<!--topo--><!--topo-->
	</th>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CONFIRMAR RECEBIMENTO DE AUTO DE INFRAÇÃO</legend>
    <form name="form1" method="post" action="../classes/controleReceberAuto.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%">&nbsp;</td>
            <td width="96%" class="cabecalho">O Guarda Municipal <? echo '<font class="receber_auto">'.$loginR.'</font>'?> recebeu <? echo '<font class="receber_auto">'.$quantidadeR.'</font>'?>  AIT's do Guarda Municipal de matricula <? echo '<font class="receber_auto">'.$matriculaR.'</font>'?> na data <? echo '<font class="receber_auto">'.$data_cadastroR.'</font>'?> e hora <? echo '<font class="receber_auto">'.$hora_cadastroR.'</font>'?> com os números listados abaixo.</td>
          </tr>
        </table>


        <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td></td>
            </tr>
                <td width="14%" align="right" valign="top" class="letra">AIT:</td>
          <td width="86%" class="cabecalho">
          <? 
		  	$sqlRA = "SELECT * FROM temp_receber_auto order by numbloco";
			$resultadoRA = $obj->executaQuery($sqlRA);
			while( $linhaRA = mysql_fetch_array($resultadoRA) )
			{
				$numbloco = $linhaRA["numbloco"];
				$letra = $linhaRA["letra"];
				
				echo''.$numbloco.' - '.$letra.'<BR>';
			}
		  
		  ?>
          
          </td>
        </tr>
		    <tr height="2">
		      <td align="right" class="letra">Matricula:</td>
		      <td align="left">
              <input type="text" class="negrito" name="matriculaR" id="matriculaR" size="15" value="<? echo $matriculaR;?>" readonly="readonly"  />
	        </tr>
            <tr height="2">
		      <td align="right" class="letra">Confirmar Recebimento?:</td>
		      <td align="left" class="negrito"><input name="sim" type="checkbox" value="0" />Sim <input name="nao" type="checkbox" value="1" />Não </td>
	        </tr>
		    <tr height="2">
			<td align="left" class="letra" colspan="2">&nbsp;</td>
		  </tr>
		  <tr>	
			<td align="right">
			<td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
			</td>
		  </tr>
		</table>
		</form>
		</fieldset>
	<!-- fim do adm -->
	
	</td>
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
