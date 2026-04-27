<? // Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<title>INTRANET [GMF]</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #2C628F;
}
.one {
width: 280px;
height: 26px;
background: url(images/login_text.png) no-repeat;
border: none;
padding: 2px 0 0 5px;
}
.style1 {color: #FFFFFF}
-->
</style>
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
	    
		//verificar se a expressão login está dentro da expressão senha. Ex: jonas - jonas123
		function LoginSenha(senha,login){
			var RegExp = /login/;
			if (senha.search(RegExp) != -1) {
					document.write("Encontrado na posição: "+ senha.search(RegExp));
			} else {
					document.write("Não encontrado!");
			}
		}
		function converteUpper(campo) {
        campo.value = campo.value.toUpperCase();
       }
</script>

	
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th align="center" scope="col"><table width="1024" height="800"  border="0" cellpadding="0" cellspacing="0" background="images/background.png">
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="20" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="200" align="center">
          <form name="form" method="post" action="../classes/processaLogin.php" onSubmit="return validaFormAll(this,'Continuar','Entrar')">
            <table width="100%"  border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td colspan="2" align="center"><a href="contato_reucpera.php"><font color="#FFFFFF">Esqueceu a senha?</font></a></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              <td align="left"><span class="style1">Usu&aacute;rio:</span></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input name="xlogin" type="text" id="login" value="MAIUSCULO" size="16" class="one" onkeyup="converteUpper(this);"/></td>
              </tr>
              <tr>
                <td width="36%" align="center">&nbsp;</td>
              <td width="64%" align="left"><span class="style1">Senha:</span></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input name="xsenha" type="password" size="15" id="senha" class="one" onkeypress="checar_caps_lock(event)"/> <div id="aviso_caps_lock" style="visibility: hidden"><font color="#FF0000">Atencao: O Caps Lock esta ativado!</font></div></td>
              </tr>
              <tr>
                <td colspan="2" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input name="submit" type="image" src="images/login_botao.png" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Entrar" border="0"/></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center">
                <td colspan="2"><a href="https://www.google.com/chrome/?hl=pt-BR" target="_blank"><img src="images/login_informativo.png" width="323" height="54" border="0"></a></td>
              </tr>
            </table>
        </form></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></th>
  </tr>
</table>
</body>
</html>
