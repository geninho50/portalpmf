<?php
		// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $arrayI = explode("-", $data_atual);
   $dia = $arrayI[2];
   $mes = $arrayI[1];
   $ano = $arrayI[0];
		
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
	<legend class="negrito">Cadastro Falta</legend>
	<form name="form1" method="post" action="../classes/controleFaltas.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	  <tr>
		<td align="right">Guarda:</td>
	  <td align="left">
	    <select name="yGM" class="letra">
				  <option value="0">Selecionar...</option>
				  <?php 
					$query = "SELECT * FROM guarda_gmf where login != '$login' order by login";
					$resultado = $obj->executaQuery($query);
					while($linha = mysql_fetch_array($resultado))
					{
						$login = $linha['login'];
				  ?>
							 <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
				  <?php 
					} 
				  ?>
			  </select></td>
	  </tr>
	  <tr>
		<td align="right">Dia da Falta:</td>
	  <td align="left">
	  	  <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" class="stylo1" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'>
	  </td>
	  </tr>
			<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
			<tr>
			  <td align="right">Descricao da Falta: </td>
			<td><input name="xdescricao" type="text" id="xdescricao" value="<? echo $descricao; ?>" size="60" onkeyup="converteUpper(this);"></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		<tr>	
			<td width="12%">&nbsp;		</td>
			<td width="88%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		</tr>
	</table>
	</form>
	</fieldset>
	
	</td>
  </tr>
</table>
	<!--fim adm-->
	<fieldset>
	<legend class="negrito">Falta referente ao m&ecirc;s <? echo $dataTemp = $mes-1;?></legend>
	<table  bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	  <tr>
		<td width="20%" class="branco"><b>NOME</b></td>
		<td width="64%" class="branco"><b>MOTIVO</b></td>
		<td width="16%" class="branco"><b>DATA</b></td>
	  </tr>
</table>
	
	<table width="100%" bordercolor="#FFFFFF" border="0" cellspacing="1" cellpadding="1">
	  <?
		$chavet = true;
		$dataTemp = $mes-1;
	  	$query = "SELECT * FROM falta where MONTH(data)=$dataTemp and year(data)=$ano order by data";
		$resultado = $obj->executaQuery($query);
		while($linha = mysql_fetch_array($resultado))
		{
			$guarda = $linha['guarda'];
	  		$descricao = $linha['descricao'];
			$data = $linha['data'];
			$arrayI = explode("-", $data);
			$diai = $arrayI[2];
			$mesi = $arrayI[1];
			$anoi = $arrayI[0];
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
			<td width="20%" class="negrito"><? echo $guarda;?></td>
			<td width="64%" class="negrito"><? echo $descricao;?></td>
			<td width="16%" class="negrito"><? echo $diai.'-'.$mesi.'-'.$anoi;?></td>
		  </tr>
	  <?
	  	}
	  ?>
	</table>
	</fieldset>
	<fieldset>
	<legend class="negrito">Falta referente ao m&ecirc;s <? echo $mes;?></legend>
		<table  bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	  <tr>
		<td width="20%" class="branco"><b>NOME</b></td>
		<td width="64%" class="branco"><b>MOTIVO</b></td>
		<td width="16%" class="branco"><b>DATA</b></td>
	  </tr>
</table>
	
	<table width="100%" bordercolor="#FFFFFF" border="0" cellspacing="1" cellpadding="1">
	  <?
		$chavet = true;
	  	$query = "SELECT * FROM falta where MONTH(data)=$mes and year(data)=$ano order by data";
		$resultado = $obj->executaQuery($query);
		while($linha = mysql_fetch_array($resultado))
		{
			$guarda = $linha['guarda'];
	  		$descricao = $linha['descricao'];
			$data = $linha['data'];
			$arrayI = explode("-", $data);
			$diai = $arrayI[2];
			$mesi = $arrayI[1];
			$anoi = $arrayI[0];
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
			<td width="20%" class="negrito"><? echo $guarda;?></td>
			<td width="64%" class="negrito"><? echo $descricao;?></td>
			<td width="16%" class="negrito"><? echo $diai.'-'.$mesi.'-'.$anoi;?></td>
		  </tr>
	  <?
	  	}
	  ?>
	</table>
	</fieldset>
	</td>
  </tr>
</table>


</body>
</html>

