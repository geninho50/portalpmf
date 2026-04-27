<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;

		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Controle de Hora Extra dos Agentes da Zona Azul</legend>
	<form name="form" method="post" action="../classes/controleAdicionarAgente.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	  <tr>
		
		<td width="14%" align="right" class="letra">GM:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="12%" align="left"><select name="yagente">
		  <option value="0">Selecionar...</option>
		  <?php 
					$queryS = "SELECT nome,turno,dias,DAY(datalimite) as dia,MONTH(datalimite) as mes,YEAR(datalimite) as ano FROM agente_zonaazul where dias != 0 order by datalimite asc";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$nome = $linhaS['nome'];
						$dias = $linhaS['dias'];
						$dia = $linhaS['dia'];
						$mes = $linhaS['mes'];
						$ano = $linhaS['ano'];
				  ?>
		  <option value="<?php echo $nome; ?>"><?php echo $nome.' ('.$dias.') - '.$dia.'/'.$mes.'/'.$ano; ?></option>
		  <?php 
					} 
				  ?>
		</select></td>
	<td width="9%" align="right" class="letra">Data:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="15%" align="left"><input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data' /></a> 
		</td>
			<td width="50%" align="left"><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		</tr>
	
	</table>
	
	</form>
	</fieldset>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="30">&nbsp;</td>
		<td width="1084">
			<!-- ini agenda -->
				<?php include("caladmagente.php"); ?>
				<!-- fim agenda  -->
		</td>
		<td width="30">&nbsp;</td>
	  </tr>
	</table>
	
	<fieldset>
		<legend class="negrito">Painel de Recado </legend>
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
	<?PHP 
	$chavet = true;
	 $queryE = "SELECT id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, nome, texto FROM recado_agente";
	   $resultE = $obj->executaQuery($queryE);
	   
	   while($linhaE = mysql_fetch_array($resultE)):
	   
			$id = $linhaE['id'];
			$nome =  $linhaE['nome'];
			$texto =  $linhaE['texto'];
			$dia = $linhaE['dia'];
			$mes = $linhaE['mes'];
			$ano = $linhaE['ano'];
	?>
	
	  <tr bgColor="<?PHP if($chavet)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chavet=!$chavet;
						?>">
	   <td width="11%" align="center" class="negrito"> <?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
	   <td width="24%" align="left" class="negrito"><?PHP echo $nome; ?></td>
	   <td width="65%" align="left" class="negrito"><?PHP echo $texto; ?></td>
	  </tr>
	
	
	<?PHP
			 endwhile
			
	?>
	</table>
	</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

