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
     
  
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">EMPENHAR GUARNIÇÕES NA ESCOLA</legend>
    <form name="form" action="../classes/controleEscolaGuarnicao.php" enctype="multipart/form-data" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
	  <td align="right" class="letra">Operador:</td>
	  <td><input type="text" class="negrito" name="guarda" id="guarda" size="20" readonly="readonly" value="<? echo $login;?>"/></td>
	  </tr>
	<tr>
      <td width="12%" align="right" class="letra">VTR:</td>
      <td width="88%">
		<select name="yidguarnicao" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
		  <option value="0">Selecionar...</option>
		  <?php 
					//$queryS = "SELECT * FROM guarnicao where status=1 and data_entrada='$data_atual'";
					$queryS = "SELECT * FROM guarnicao where status=1 order by vtr";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$idguarnicao = $linhaS['id'];
						$vtr = $linhaS["vtr"];
						$guarda1 = $linhaS["guarda1"];
						$guarda2 = $linhaS["guarda2"];
						$guarda3 = $linhaS["guarda3"];
						$guarda4 = $linhaS["guarda4"];
						$guarda5 = $linhaS["guarda5"];
						$outros = $linhaS["outros"];
				  ?>
		  				<option value="<?php echo $idguarnicao; ?>">
							<? 
								if($guarda1 != '' ){echo '<br>'.$vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								echo ' - '.$outros;
						?>
						</option>
		  <?php 
					} 
				  ?>
		</select>
		</td>
    </tr>

	<tr>
      <td width="12%" align="right" valign="top" class="letra">Escola:</td>
      <td width="88%"><input type="text" class="codigo" name="xescola" id="xescola" size="60" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
  </table>
</form>
</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>
