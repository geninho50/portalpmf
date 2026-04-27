<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$login = mysql_escape_string($_GET['login_acesso']);
	$sql = "SELECT * FROM guarda_gmf where login_usuario='$login'";
	$result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$login_temp = $linha["login_usuario"];
		$senhaantiga = $linha["senha"];
	}

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
		$sql = "SELECT * FROM guarda_gmf where login_usuario='$login'";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			//$login_temp = $linha["login_usuario"];
			
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
	<legend class="negrito">Atualizar Senha</legend>

<form name="form1" method="post" action="../classes/controleAtualizaSenha.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="130" align="right" class="letra">Login:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="782"><input name="xlogin" id="xlogin" type="text" readonly="readonly" onKeyUp="counterUpdate('xlogin','countNome','195');" size="60" value="<?echo $login_temp;?>"/></td>
    <td width="74">&nbsp;</td>
 </tr>

  <tr>
	<td width="130">&nbsp;</td>
    <td align="left" class="letra">
	Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres � Limite: <B>195</B> caracteres</p>
	</td>
    <td align="left" class="letra">&nbsp;</td>
  </tr>

  <tr>
    <td width="130" align="right" class="letra">Senha antiga:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="782"><input name="xsenhaantiga" id="xsenhaantiga" readonly="readonly" type="password" size="60" value="<? echo $senhaantiga;?>"/></td>
    <td width="74">&nbsp;</td>
  </tr>
 <tr>
    <td width="130" align="right" valign="top" class="letra">Nova senha:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="782">
	<input name="xnovasenha" type="password" size="60" id="xnovasenha" class="password" onkeypress="checar_caps_lock(event)"/> 
	<font color="#FF0000"> A senha tem que conter letras e numeros!</font>
	<div id="aviso_caps_lock" style="visibility: hidden"><font color="#FF0000">Atencao: O Caps Lock esta ativado!</font></div>
    <td width="74" align="left" valign="top">&nbsp;</td>
 </tr>
 <tr>
    <td width="130" align="right" class="letra">Confirmar senha :<FONT COLOR="#FF0033">*</FONT></td>
    <td width="782"><input name="xconfirmarsenha" id="xconfirmarsenha" type="password" size="60" value="<?echo $confirmarsenha;?>"/></td>
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