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
	
	$ait = $_POST['xait'];
	
	$ait = trim($ait);
	$tamanho = strlen($ait);
	$nvaloresencontrados = 0;
	
	$queryC = "SELECT * FROM receber_auto WHERE numblocoinicial=$ait order by data_cadastro desc";

	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($queryC);
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTA BLOCO POR CAIXA </legend>
		<form name="form1" method="post" action="relatorio_ait.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		    <tr>
		      <td width="10%" align="right" class="letra">AIT:</td>
		      <td width="90%" align="left" class="letra"><input type="text" name="xait" id="xait"/></td>
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
	<legend class="cabecalho">RETORNOU(s) <B><? echo $nvaloresencontrados;?></B> AIT COM O NÚMERO <B><? echo $ait;?></B>.</legend>

		<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
            <tr align="center">
              <td width="20%" align="center" class="branco"><b>Agente que Recebeu</b></td>
			  <td width="41%" align="center" class="branco"><b>Matricula do Guarda</b></td>
			  <td width="11%" align="center" class="branco"><b>Data Recebida</b></td>
              <td width="11%" align="center" class="branco"><b>Hora Recebida</b></td>
		  </tr>
	  </table>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse: collapse">
		<?
			$chavet = true;
			$resultadoC = $obj->executaQuery($queryC);
			while( $linhaC = mysql_fetch_array($resultadoC) )
			{
				$id = $linhaC['id'];
				$login = $linhaC['login'];
				$numinicialbloco = $linhaC['numinicialbloco'];
				$matricula = $linhaC['matricula'];
				$data_cadastro = $linhaC['data_cadastro'];
				$hora_cadastro = $linhaC['hora_cadastro'];
				
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
			<td width="20%" align="center" class="negrito"><? echo $login;?></td>
			<td width="41%" align="center" class="negrito"><? echo $matricula;?></td>
			<td width="11%" align="center" class="negrito"><? echo $data_cadastro;?></td>
			<td width="11%" align="center" class="negrito"><? echo $hora_cadastro;?></td>
		  </tr>
		 <?
		 }
		 ?> 
</table>

</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA BLOCO DE NÚMERO<? echo $caixa;?>.</legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhum bloco registrado para <B> <? echo $caixa;?>.</B></td>
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