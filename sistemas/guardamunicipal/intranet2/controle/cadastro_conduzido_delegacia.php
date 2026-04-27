<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$objS = new trataString;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
    $idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
  
   $query = "select MAX(id) as id from conduzir_delegacia";
   $resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
   while ($linha=mysql_fetch_array($resultado))
   {
	 $idconduzir = $linha['id'];
   }
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="85%" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="88%" valign="top">
          <fieldset>
			<legend class="cabecalho">CADASTRO CONDUZINDO A DELEGACIA</legend>
		    <form action="../classes/controleConduzirDelegacia.php" method="post" name="form" id="form" enctype="multipart/form-data" onsubmit="return validaFormAll(this,'Confirmar','Confirmar')" >
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="15%" align="right"  class="letra">N&ordm; do registro:</td>
                      <td width="40%"><font color="#000000" size="+2"><? echo $idconduzir+1;?></font></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td width="33%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">N&ordm; da ocorr&ecirc;ncia:</td>
                      <td><input name="ocorrencia" type="text" id="ocorrencia" class="negrito" value="<? echo $idOcorrencia;?>" size="15" readonly="readonly"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">N&ordm; do BO:</td>
                      <td><input name="bo" type="text" id="bo" class="negrito" value="<? echo $bo;?>" size="30" onkeyup="converteUpper(this);"/></td>
                      <td align="right"  class="letra">N&ordm; do REPP: </td>
                      <td><input name="repp" type="text" id="repp" class="negrito" value="<? echo $repp;?>" size="30" onkeyup="converteUpper(this);"/></td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Nome do Conduzido:</td>
                      <td><input name="nomeconduzido" type="text" id="nomeconduzido" class="negrito" value="<? echo $nomeconduzido;?>" size="55" onkeyup="converteUpper(this);"/></td>
                      <td width="12%" align="right"  class="letra">Ra&ccedil;a:</td>
                      <td><select name="raca" class="negrito">
                        <option value="">Selecione...</option>
						<option value="BRANCO">BRANCO</option>
                        <option value="AFRO-BRASILEIRO">AFRO-BRASILEIRO</option>
                        <option value="MULATO">MULATO (BRANCO E NEGRO)</option>
                        <option value="CABOCLO">CABOCLO (BRANCO E &Iacute;NDIO)</option>
                        <option value="CAFUZO">CAFUZO (&Iacute;NDIO E NEGRO)</option>
                        <option value="GABRA">CABRA (MULATO E NEGRO)</option>
                        <option value="INDIO">&Iacute;NDIO</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Sexo:</td>
                      <td><select name="sexo" class="negrito" id="sexo">
                        <option value="">Selecione...</option>
						<option value="MASCULINO">MASCULINO</option>
                        <option value="FEMININO">FEMININO</option>
                      </select></td>
                      <td align="right"  class="letra">Data de Nascimento:</td>
                      <td><input name="datafinal" type="text" id="datafinal" value="<? echo $datafinal;?>" class="negrito" size="12" readonly/>
			<a onClick="displayCalendar(document.forms[0].datafinal,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Nome da M&atilde;e:</td>
                      <td><input name="nomemae" type="text" id="nomemae" onkeyup="converteUpper(this);" class="negrito" value="<? echo $nomemae;?>" size="55"/></td>
                      <td align="right"  class="letra">Documento:</td>
                      <td><input name="documento" type="text" size="20" id="documento" class="negrito" value="<? echo $documento; ?>" onkeyup="converteUpper(this);"/></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="15%" align="right"  class="letra">Nascionalidade:</td>
                      <td><input name="nascionalidade" type="text" value="<? echo $nascionalidade;?>" class="negrito" id="nascionalidade" size="20" onkeyup="converteUpper(this);"/>
                      </td>
                      <td align="right"  class="letra">Naturalidade:</td>
                      <td width="33%"><input name="naturalidade" type="text" id="naturalidade" class="negrito" value="<? echo $naturalidade; ?>" size="20" onkeyup="converteUpper(this);"/></td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Delegacia:</td>
                      <td width="40%"><select name="delegacia" class="negrito">
                        <option value="">Selecione...</option>
						<option value="PRIMEIRA DELEGACIA PC">1&ordm; DELEGACIA PC</option>
                        <option value="SEGUNDA DELEGACIA PC">2&ordm; DELEGACIA PC</option>
                        <option value="TERCEIRA DELEGACIA PC">3&ordm; DELEGACIA PC</option>
                        <option value="QUARTA DELEGACIA PC">4&ordm; DELEGACIA PC</option>
                        <option value="QUINTA DELEGACIA PC">5&ordm; DELEGACIA PC</option>
                        <option value="SEXTA DELEGACIA PC">6&ordm; DELEGACIA PC</option>
                        <option value="SETIMA DELEGACIA PC">7&ordm; DELEGACIA PC</option>
                                            </select></td>
                      <td width="12%" align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td width="15%" align="right"><span class="letra">Crime (C&oacute;digo):</span></td>
                <td width="85%"><input name="xait" id="xait" type="text" size="100" class="negrito"/></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="15%" align="right" valign="top" >Pertences:</td>
                      <td width="905"><textarea name="pertences" cols="100" rows="5" id="pertences" class="negrito"><? echo $encerramento_ocorrrencia;?></textarea></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="15%" align="right" class="letra" >Foto</td>
                      <td width="1068"><input name="arquivo" size="52" type="file" class="negrito"/></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="7%" align="right">&nbsp;</td>
                      <td width="37%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
                      <td width="7%">&nbsp;</td>
                      <td width="49%">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>
        </form>
		</fieldset>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>

</html>


