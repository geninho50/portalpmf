<?php
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />

<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>
<!-- caps_lock-->
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
	<legend class="negrito">Atualizar Informacoes de Acesso</legend>

<form name="form1" method="post" action="../classes/controleDadosAcesso.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td align="right" class="letra">Matricula:</td>
   <td><input name="xmatricula" id="xmatricula" type="text" size="30"/></td>
   <td>&nbsp;</td>
 </tr>
 <tr>
    <td width="130" align="right" class="letra">Novo Login:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="782"><input name="xlogin" id="xlogin" type="text" size="30" onkeyup="converteUpper(this);"/></td>
    <td width="74">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" class="letra">Email:<FONT COLOR="#FF0033">*</FONT></td>
   <td><input name="xemail" id="xemail" type="text" size="50"/></td>
   <td>&nbsp;</td>
 </tr>
 <tr>
   <td align="right" class="letra">Data Nascimento: </td>
   <td>
    <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'></a>   
   </td>
   <td>&nbsp;</td>
 </tr>
 <tr>
    <td width="130" align="right" class="letra">Informa o Codigo:<FONT COLOR="#FF0033">*</FONT> </td>
    <td width="782"><input name="xpalavra" id="xpalavra" type="text" size="20" /></td>
    <td width="74">&nbsp;</td>
 </tr>
  <tr>
    <td width="130" align="right" class="letra"></td>
    <td width="782"><img src="captcha.php?l=150&a=50&tf=20&ql=5"></td>
    <td width="74">&nbsp;</td>
 </tr>

 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
	
  <tr height="2">
    <td align="left" class="quote" colspan="3">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
    <td>&nbsp;</td>
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