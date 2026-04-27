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
	
	$login = "";
	$senhaantiga = "";
	$novasenha = "";
	$confirmasenha = "";
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$cpf = $linha["cpf"];
		$senhaantiga = $linha["senha"];
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />

<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
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
	    
		//verificar se a express�o login est� dentro da express�o senha. Ex: jonas - jonas123
		function LoginSenha(senha,login){
			var RegExp = /login/;
			if (senha.search(RegExp) != -1) {
					document.write("Encontrado na posição: "+ senha.search(RegExp));
			} else {
					document.write("Não encontrado!");
			}
		}
		</script>
</head>
<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">ATUALIZAR SENHA</legend>

<form name="form1" method="post" action="../classes/controleAtualizaSenha.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="19%" align="right" class="letra">CPF:</td>
    <td width="79%"><input name="xcpf" id="xcpf" type="text" class="negrito" readonly="readonly" size="60" value="<?echo $cpf;?>"/></td>
    <td width="2%">&nbsp;</td>
 </tr>

<tr>
    <td align="right" class="letra">Senha antiga:</td>
    <td><input name="xsenhaantiga" id="xsenhaantiga" type="password" class="negrito" size="60" onkeypress="return SomenteNumero(event);"/></td>
    <td>&nbsp;</td>
  </tr>
 <tr>
    <td align="right" valign="top" class="letra">Nova senha:</td>
    <td> <input name="xnovasenha" type="password" size="60" id="xnovasenha" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/> </td>
    <td>&nbsp;</td>
 </tr>
 <tr>
    <td align="right" class="letra">Confirmar senha:</td>
    <td><input name="xconfirmarsenha" id="xconfirmarsenha" type="password" size="60" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/></td>
    <td >&nbsp;</td>
 </tr>

 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
	
  <tr height="2">
    <td align="left" class="quote" colspan="3">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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