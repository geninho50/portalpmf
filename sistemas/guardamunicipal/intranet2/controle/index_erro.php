<?
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	$mensagem = "";
	$mensagem = $_GET['Mensagem'];

?>

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
        <td valign="bottom"><font color="#FF0000" face="Calibri, Geneva, sans-serif" size="2"><? echo $mensagem?></font></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="bottom">
          <form name="form" method="post" action="../classes/processaLogin.php" onSubmit="return validaFormAll(this,'Continuar','Entrar')">
            <table width="100%"  border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="35%" align="right" class="letra">cpf:</td>
                <td width="65%" height="30">
                  <input type="text" name="xCPF" id="xCPF" class="negrito" maxlength="11" onBlur="Verifica_campo_CPF(this)" ></td>
              </tr>
              <tr>
                <td align="right" class="letra">senha:</td>
                <td height="30"><input type="password" name="xSENHA" id="xSENHA" class="negrito" onKeyPress="checar_caps_lock(event)"/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="left">
                  <input name="submit" type="image" src="imagens/botao_entrar.jpg" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Entrar" border="0"/>
                </td>
              </tr>
            </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="bottom" align="center"><div id="aviso_caps_lock" style="visibility: hidden"><font color="#FF0000" face="Calibri, Geneva, sans-serif" size="2">Atenção: O Caps Lock esta ativado!</font></div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="bottom"><a href="javascript:POPUP('ajuda_acesso.htm','400','400')"><img src="imagens/ajuda.png" width="207" height="22" border="0"></a></td>
        <td>&nbsp;</td>
      </tr>
      
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
