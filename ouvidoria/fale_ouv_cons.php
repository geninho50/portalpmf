<?
require($_SERVER[DOCUMENT_ROOT].'/ouvidoria/com/config.php');
   
   $image_server="";
   $image_css="";

?>

<html>
<head>

<script>

function AtualizaCampos()
{
        document.frm_cons_cidadao.action = "fale_ouvidor.php";
        document.frm_cons_cidadao.submit();
}

function validaCampos()
{
        if (document.frm_cons_cidadao.p_atend.value=="") {
            alert("O campo \"Atendimento\" é de preenchimento obrigatório");
            document.frm_cons_cidadao.p_atend.focus();
            return false;
        }

        if (document.frm_cons_cidadao.p_codconsulta.value=="") {
            alert("O campo \"Código da Consulta\" é de preenchimento obrigatório");
            document.frm_cons_cidadao.p_codconsulta.focus();
            return false;
        }


}

</script>
<style type="text/css">
<!--
.texto_form {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8.5pt;
	color: #333333;
	font-weight: normal;
}
-->
</style>

</head>
<body marginheight="0" marginwidth="0">

<table width="510" border="0" align="center" cellpadding="0" cellspacing="0">
                
                <tr>
                  <td><form name='frm_cons_cidadao' action='atend_cons_cidadao.php' method='POST' onSubmit="return validaCampos()">
                            <div align=center>
                            <center>
                                <table border=0 cellpadding=0 width="510">
                                  <!-- alterado em 23.08.05 -->
                                  <tr>
                                    <td height="15" align=right valign=middle>
                                      <div align="left"><span class="texto_form">Atendimento:</span> 
                                        <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name='p_atend' size=10 maxlength=9 value=>
&nbsp;&nbsp; <span class="texto_form">Ex.: 9999/2005</span></div></td>
                                  </tr>
                                  <tr>
                                    <td align=right valign=middle height="15"><div align="left"><span class="texto_form">C&oacute;digo da Consulta: 
                                      <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_codconsulta size=8  maxlength=5 value=>
                                    </span>
                                    </div></td>
                                  </tr>
                                  <!-- fim -->
                                  <tr>
                                    <td align=right valign=middle height="15"><div align="left">
                                      <input  type="submit" value="Enviar" border="0" name="enviar" align="center" width="57" height="21" >
                                      <input  onclick="javascript: document.forms[0].reset(); return false;" type="reset"  value="Limpar" border="0" name="limpar" align="center" width="57" height="21" >
                                    </div></td>
                                  </tr>
                                </table>
                            </center>
                          </div>
                        </form></td>
                </tr>
              </table>

</body>
</html>
