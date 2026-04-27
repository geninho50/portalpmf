<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	
	$idReserva = 0;
	$idReserva = (int)$_POST['idReserva'];
	if( $idReserva == 0 )
	{
		$idReserva = (int)$_GET['idReserva'];
	}
	
	if( $idReserva > 0 )
	{		
		$query = "select id,DAY(datareserva) as dia,MONTH(datareserva) as mes,YEAR(datareserva) as ano, guardareserva, titulo, codigolivro,datareserva from reserva where id=$idReserva";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		
		if( $linha )
		{
			$idreserva = $linha['id'];
			$codigo = $linha['codigolivro'];
			$datareserva = $linha['datareserva'];
			$guarda = $linha['guardareserva'];
			$titulo = $linha['titulo'];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
		function checar_caps_lock(ev) {
			var e = ev || window.event;
			codigo_tecla = e.keyCode?e.keyCode:e.which;
			tecla_shift = e.shiftKey?e.shiftKey:((codigo_tecla == 16)?true:false);
			if(((codigo_tecla >= 65 && codigo_tecla <= 90) && !tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && tecla_shift)) {
				document.getElementById('aviso_caps_lock').style.visibility = 'visible';
			}
			else {
				document.getElementById('aviso_caps_lock').style.visibility = 'hidden';
			}
		}
</script>
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
			include("menu.php");
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
	<legend class="negrito">Pagamento de Livros</legend>
<form name="form1" method="post" action="../classes/controlePagamentoLivro.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

<tr>
   <td align="right" class="letra">&nbsp;</td>
   <td><input name="chave" type="text" id="chave" value="Pagamento" size="30" readonly /></td>
 </tr>
 <tr>
    <td width="21%" align="right" class="letra">Atendente:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="79%"><input name="matricula" type="text" id="matricula" value="<?echo $matricula;?>" size="8" readonly/>
    <input name="login" type="text" id="login" value="<?echo $login;?>" size="30" readonly /></td>
 </tr>
 <tr>
    <td width="21%" align="right" class="letra">C&oacute;digo:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="79%"><input name="codigo" type="text" id="codigo" value="<?echo $codigo;?>" size="20" maxlength="6" readonly/></td>
 </tr>
 <tr>
    <td width="21%" align="right" class="letra">T&iacute;tulo:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="79%"><input name="titulo" type="text" id="titulo" value="<?echo $titulo;?>" size="70" readonly/></td>
 </tr>
 <tr>
   <td height="24" align="right" class="letra">Guarda:<font color="#FF0033">*</font></td>
   <td><input name="guardareserva" type="text" id="guardareserva" value="<?echo $guarda;?>" size="50" readonly/></td>
</tr>
	
 <tr>
   <td height="24" align="right" class="letra">Data da reserva:<FONT COLOR="#FF0033">*</FONT></td>
   <td><input type="text" value="<? echo $datareserva;?>" readonly name="datareserva" size="12"/></td>
</tr>
<tr>
   <td height="24" align="right" class="letra">Senha do Guarda :<FONT COLOR="#FF0033">*</FONT></td>
	<td colspan="2" align="left"><input name="xsenha" type="password" size="15" id="senha" class="one" onkeypress="checar_caps_lock(event)"/> <div id="aviso_caps_lock" style="visibility: hidden"><font color="#FF0000">Atencao: O Caps Lock esta ativado!</font></div></td>
</tr>
 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	

<tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>
</table>

</form>
</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>



</body>
</html>