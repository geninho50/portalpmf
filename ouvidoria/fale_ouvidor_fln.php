
<html>
<head>
<script>

function AtualizaCampos()
{
        document.frm_atendimento.action = "fale_ouvidor.php";
        document.frm_atendimento.submit();
}


function loadMun( estado ){
	//if(estado!='')
	ajaxHTML('dv_mun','../../ajax/cmb_municipio.php?p_estado='+estado);	
}


function valida()
{
        if (document.frm_atendimento.p_texto.value=="") {
            alert("O campo \"Comentário\" é de preenchimento obrigatório");
            document.frm_atendimento.p_texto.focus();
            return false;
        }
}
 
</script>
<? include "template_head.php"; ?>
<script src="/ouvidoria/script/ajaxutil.js"></script>


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
                  <td> 
                    
                    <div align="justify" ><font class="texto_form" color="#000066">

                    
                    </font></div>

                    <p></p></div></td>
                </tr>
                <tr>
                  <td><form name='frm_atendimento' action='fale_ouv_db.php' method='POST' OnSubmit="return valida()">
                            <div align=center>
                            <center>
                                <table border=0 cellpadding=0 width=510>
                                  <td align=right valign=middle height="15"><span class="texto_form"> 
                                    <input type=hidden name=p_codorgao value=123>
                                Reivindica&ccedil;&atilde;o:</span> </td>
                                  <td align=left valign=top height="15"> <select name=p_natureza class="texto_form" style='width=233'>
                                  <option value=1>Denúncia</option>
<option value=8>Elogio</option>
<option value=2>Reclamação</option>
<option selected value=3>Solicitação</option>
<option value=4>Sugestão</option>
                                    </select> </td>
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Nome:</span>&nbsp; 
                                    </td>
                                    <td align=left valign=top height="15"> <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_nome size=48 maxlength=100 value=> 
                                    </td>
                                  </tr>
                                  <!-- alterado em 23.08.05 -->
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Tratamento:</span> 
                                    </td>
                                    <td align=left valign=top height="15">                                      <select name=p_apelido class="texto_form" style='width:95'> <option selected value=Sr>Senhor</option><option value=Voc&ecirc;>Você</option><option value=Senhora>Senhora</option><option value=Senhorita>Senhorita</option>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Idade:</span>
                                    </td>
                                    <td align=left valign=top height="15"> <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_idade size=2 maxlength=2 value=> 
                                    &nbsp;&nbsp; <span class="texto_form">Sexo:</span> 
                                   <select name=p_sexo class="texto_form" style='width:95'>
                                  <option selected value=N>Selecione...</option><option value=F>Feminino</option><option value=M>Masculino</option>
                                    </select> </td>
                                  </tr>
                                  <!-- fim -->
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Endere&ccedil;o:</span> 
                                    </td>
                                    <td align=left valign=top height="15"><input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_ender value='' size=48 maxlength=150> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Complemento:</span> 
                                    </td>
                                    <td align=left valign=top height="15"><input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_compl size=48 maxlength=100 value=> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">Bairro:</span> 
                                    </td>
                                    <td align=left valign=top height="15"><input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_bairro size=48 maxlength=50 value=> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"><span class="texto_form">CEP:</span> 
                                    </td>
                                    <td align=left valign=top height="15"><input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_cep size=15  maxlength=13 value=> 
                                    </td>
                                  </tr>
                                  <tr>
                                               <td align=right valign=middle height="15"><span class="texto_form">Estado:</span></td>
                                                <td align=left valign=top height="15">
                                                   <select name='p_estado' class="texto_form" style='width:250' onchange='loadMun(this.options[this.selectedIndex].value);'>
															 
                                                    </select>
                                                </td>
                                        </tr>
                                        <tr>
                                        <td align=right valign=middle height="15"><span class="texto_form">Munic&iacute;pio:</span></td>
                                        <td align=left valign=top height="15"><div id="dv_mun">
                                                        <select name=p_munic class="texto_form" style='width:250px'>
                                                        <option value='' > </option> 
                                                        </select>
                                                        
                                                </div></td>
                                        </tr>                                  <tr> 
                                    
                                  </tr>
                                  <tr> 
                                    <td align=right valign=middle height="15"> 
                                      <span class="texto_form">Telefone Com.:</span> </td>
                                    <td align=left valign=top height="15"> <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name='p_fonea' size=15 maxlength=13 value=>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="texto_form">Fax:</span> 
                                      <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name='p_foneb' size=15 maxlength=13 value=> 
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align=right valign=middle height="15">
                                      <span class="texto_form">Telefone Res.:</span> </td>
                                    <td align=left valign=top height="15"> <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name='p_fonec' size=15 maxlength=13 value=>
                                      &nbsp;&nbsp;<span class="texto_form">Celular:</span> 
                                      <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name='p_celular' size=15 maxlength=13 value=>
                                    </td>
                                  </tr>
                                 
                                  <tr> 
                                    <td align=right valign=middle height="15"> 
                                      <span class="texto_form">E-mail:</span> </td>
                                    <td align=left valign=top height="15"> <input style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' name=p_email size=48 maxlength=50 value=> 
                                    </td>
                                  </tr>
                      
                                  <tr>
                                    <td align=right valign=top height="15"><span class="texto_form">Coment&aacute;rio:</span><span class="texto_form"></span>
                                    </td>
                                    <td>
                                      <TEXTAREA style= 'border-color: #cccccc; border-style: solid; border-width:1px; padding:2px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8.5pt; color: #333333' id=comentario name=p_texto rows=5 wrap=hard cols=50><?echo $p_texto?></TEXTAREA>  </td>
                                      </font>
                                  </tr>

                                  <tr>
                                    <td align=right valign=middle height="15">
                                        <span class="texto_form">Sugest&atilde;o de encaminhamento:</span>
                                    </td>
                                    <td align=left valign=top height="15">
                                        <select name='p_orgao_sugestao' class="texto_form"  >
                                                 
                                        </select>
                                    </td>
                                  </tr>


                                  <tr>
                                    <td align=right valign=middle height="15">&nbsp;</td>
                                    <td align=left valign=top height="15"> <input  type="submit" value="Enviar" border="0" name="enviar" align="center" width="57" height="21" >
                                      <input  type="reset"  value="Limpar" border="0" name="limpar" align="center" width="57" height="21">
                                    </td>
                                  </tr>

                                </table>
                            </center>
                          </div>
                          <table>
                          <tr><td height=25 width=116>
                          <td width="312" height=25>&nbsp; </table>
                          
                        </form></td>
                </tr>
              </table>
</body>
</html>