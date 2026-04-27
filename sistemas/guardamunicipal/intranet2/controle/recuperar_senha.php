<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- ini inc head -->
		<?php include("head/login.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td width="787" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td height="100" valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td width="374" height="190" valign="bottom" background="imagens/LOGO.jpg">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="bottom">
          <form name="form" method="post" action="../classes/controleRecuperaSenha.php" onSubmit="return validaFormAll(this,'Continuar','Entrar')">
            <table width="100%"  border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="35%" align="right" class="letra">cpf:</td>
                <td width="65%" height="30">
                  <input type="text" name="xcpf" id="xcpf" class="negrito" maxlength="11" onBlur="Verifica_campo_CPF(this)" ></td>
                </tr>
              <tr>
                <td align="right" class="letra">chave:</td>
                <td height="30"><input type="password" name="xchave" id="xchave" class="negrito" maxlength="4" onkeypress="return SomenteNumero(event);"/></td>
                </tr>
              <tr>
                <td align="right">Senha:</td>
                <td align="left"><input type="password" name="xsenha" id="xsenha" class="negrito" onkeypress="return SomenteNumero(event);"/></td>
                </tr>
              <tr>
              <tr>
                <td>&nbsp;</td>
                <td align="left">
                  <input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
                  </td>
                </tr>
              </table>
          </form></td>
        <td>&nbsp;</td>
      </tr>
      
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
