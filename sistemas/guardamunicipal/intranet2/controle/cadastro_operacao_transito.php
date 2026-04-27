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
   
    $sqlA = "SELECT * FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
   }
   
   $query = "select MAX(id) as id from ocorrencia";
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
		<?php include("head/incHeadCentral.php");?>
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
			<legend class="cabecalho">CADASTRAR OPERAÇÃO DE TRÂNSITO</legend>
		  <form action="../classes/controleOperacaoTransito.php" method="post" name="form" id="form" onsubmit="return validaFormAll(this,'Confirmar','Confirmar')" >
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>
				
				<table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="133" align="right"  class="letra">&nbsp;</td>
                      <td width="201">&nbsp;</td>
                      <td width="82" align="right"  class="letra">&nbsp;</td>
                      <td width="616">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Ocorrencia de N&ordm;:</td>
                      <td><font color="#000000" size="+2"><? echo $idOcorrencia+1;?></font></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Atendente:</td>
                      <td><input name="guarda" type="text" class="negrito" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Responsavel:</td>
                      <td><input name="xGM1_1" type="text" class="negrito" maxlength="10" id="xGM1_1" value="<? echo $responsavel;?>" onkeyup="converteUpper(this);"onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="158" align="right"  class="letra">Rua:</td>
                      <td><input name="xrua" type="text" class="negrito" value="<? echo $rua;?>" id="xrua" size="50" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
                      </td>
                      <td width="98" align="right"  class="letra">N&uacute;mero:</td>
                      <td width="592"><input name="numero" class="negrito" type="text" id="numero" value="<? echo $numero; ?>" size="8" maxlength="4" /></td>
                    </tr>
                    <tr>
                      <td width="158" align="right"  class="letra">Refer&ecirc;ncia:</td>
                      <td width="375"><input name="referencia" type="text" class="negrito" id="referencia" value="<? echo $referencia; ?>" size="30" onkeyup="converteUpper(this);"/></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td width="133" align="right" class="letra" >Tipifica&ccedil;&atilde;o:</td>
                      <td width="910"><select name="xtipificacao" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
                          <option value="APOIO">APOIO</option>
                          <option value="CRIME">CRIME</option>
                          <option value="TRANSITO" selected="selected">TRANSITO</option>
						  <option value="COLISAOVITIMA">COLISAO COM VITIMA</option>
						  <option value="COLISAOMATERIAIS">COLISAO COM DANOS MATERIAIS</option>
                          <option value="OUTROS">OUTROS</option>
                      </select></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
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
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>

</html>


