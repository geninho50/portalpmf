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
	$idEscola = (int)$_POST['idEscola'];
	if( $idOcorrencia == 0 || $idEscola == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
		$idEscola = (int)$_GET['idEscola'];
	}
   
    $sqlA = "SELECT * FROM escolas where id=$idEscola";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$nome = $linhaA["nome"];
   }
   
   $query = "select MAX(id) as id from solicitacaoescola";
   $resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
   while ($linha=mysql_fetch_array($resultado))
   {
	 $idOcorrencia = $linha['id'];
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
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" height="85%" colspan="2" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td width="88%" valign="top">
          <fieldset>
			<legend class="cabecalho">CADASTRAR OCORRÊNCIA</legend>
		    <form action="../classes/controleOcorrenciaEscola.php" method="post" name="form" id="form" onsubmit="return validaFormAll(this,'Confirmar','Confirmar')" >
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Ocorr&ecirc;ncia de N&ordm;:</td>
                      <td><font color="#000000" size="+2"><? echo $idOcorrencia+1;?></font></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Escola:</td>
                      <td><input name="idescola" type="text" class="negrito" id="idescola" value="<? echo $id;?>" size="5" readonly="readonly"/><? echo $nome;?></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Gerado por:</td>
                      <td><input name="guarda" class="negrito" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Data:</td>
                      <td>
	       			<input type="text" value="<? echo $dataini;?>" readonly name="data" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].data,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>
                      </td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">VTR:</td>
                      <td><input type="text" class="negrito" name="xvtr" id="xvtr" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Guarnicao: Guarda 1:</td>
                      <td><input type="text" class="negrito" name="xGM1_1" id="xGM1_1" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Guarda 2:</td>
                      <td><input type="text" class="negrito" name="GM1_2" id="GM1_2" size="20"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Guarda 3:</td>
                      <td><input type="text" class="negrito" name="GM1_3" id="GM1_3" size="20"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="155" align="right" class="letra">Solicitante:</td>
                      <td width="209"><input name="comunicante" type="text" class="negrito" id="comunicante" value="<? echo $comunicante; ?>" onkeyup="converteUpper(this);"/></td>
                      <td width="87" align="right"  class="letra">&nbsp;</td>
                      <td width="756">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                  <tr>
                    <td align="right" valign="top" class="letra" >Tipificacao:</td>
                    <td>
                    <select name="xtipo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
                      <option value="0">Selecionar...</option>
                      <option value="INVASAO">INVASÃO</option>
                      <option value="ARROMBAMENTO">ARROMBAMENTO</option>
                      <option value="DEPREDACAO">DEPREDAÇÃO</option>
                      <option value="CONSUMO">CONSUMO/TRÁFICO DE DROGA</option>
                      <option value="FURTO">FURTO</option>
                      <option value="VIAS DE FATO">VIAS DE FATOS</option>
                      <option value="ROUBO">ROUBO</option>
                      <option value="ALICIAMENTO">ALICIAMENTO</option>
                      <option value="SEM ALTERACAO">SEM ALTERAÇÃO</option>
                      <option value="OUTROS">OUTROS</option>
                    </select>
                  </tr>
                  <tr>
                    <td width="133" align="right" valign="top" class="letra">Descri&ccedil;&atilde;o da Ocorr&ecirc;ncia:</td>
                    <td width="905"><textarea name="xdescricao" cols="100" class="negrito" rows="10" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"><? echo $encerramento_ocorrrencia;?></textarea></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
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
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>

</html>


