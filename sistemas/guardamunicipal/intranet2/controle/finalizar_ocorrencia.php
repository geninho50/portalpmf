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
	require ("../classes/trataString.php");
	$objS = new trataString;
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idAnotacao == 0 )
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
		$gerado = $linhaA["gerado"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
		$infracao = $linhaA["infracao"];
		$tipificacao = $linhaA["tipificacao"];
		$data_cadastro = $linhaA["data_cadastro"];
		$hora_cadastro = $linhaA["hora_cadastro"];
		$hora_empenho = $linhaA["hora_empenho"];
		$hora_chegada = $linhaA["hora_chegada"];
		$abordados = $linhaA["abordados"];
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
	$sqlG = "SELECT * FROM guarnicao where id=$gerado";
	$resultadoG = $obj->executaQuery($sqlG);
	$linhaG = mysql_fetch_array($resultadoG);
	if($linhaG )
	{
		$idGuarnicao = $linhaG["id"];
		$vtr = $linhaG["vtr"];
		$guarda1 = $linhaG["guarda1"];
		$guarda2 = $linhaG["guarda2"];
		$guarda3 = $linhaG["guarda3"];
		$guarda4 = $linhaG["guarda4"];
		$guarda5 = $linhaG["guarda5"];
		$setor = $linhaG["setor"];
		$outros = $linhaG["outros"];
		$hora_entrada = $linhaG["hora_entrada"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
	<fieldset>
	<legend class="cabecalho">DETALHES DA OCORRÊNCIA</legend>
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
            <?
        	if($gerado==1){
		?>
            <tr>
              <td align="right"  class="letra">Solicitante:</td>
              <td colspan="2" class="negrito">&nbsp;&nbsp;<? echo $comunicante.' - '.$telefone;?></td>
            </tr>
         <?
			}else{
		 ?>	
		 	<tr>
              <td align="right"  class="letra">Guarnição:</td>
              <td colspan="2" class="negrito">&nbsp;
			  	<?
              		if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
					if($guarda2 != '' ){echo ' / '.$guarda2;}
					if($guarda3 != '' ){echo ' / '.$guarda3;}
					if($guarda4 != '' ){echo ' / '.$guarda4;}
					if($guarda5 != '' ){echo ' / '.$guarda5;}
					if($outros != '' ){echo ' - '.$outros;}  
				?>
              </td>
            </tr>		 
		 <?	
			}
		 ?>
        <tr>
          <td width="10%" align="right"  class="letra">Rua:</td>
          <td width="50%" class="negrito">&nbsp;&nbsp;<? echo $rua.', '.$numero; ?></td>
          <td width="40%" class="negrito"> <a href="javascript:POPUP('mapa.php?rua=<? echo $rua;?>','900','600')"><img src="imagens/logo_google.png" width="16" height="16" border="0" title="LOCALIZAR RUA NO MAPA" /></a> </td>
        </tr>
        <tr>
          <td width="10%" align="right"  class="letra">Bairro:</td>
          <td colspan="2" class="negrito">&nbsp;&nbsp;<? echo $bairro.' - '.$referencia;; ?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="10%" align="right" valign="top" class="letra" >Descri&ccedil;&atilde;o:</td>
          <td width="90%" class="negrito">&nbsp;&nbsp;<? echo $descricao_ocorrrencia;?></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="letra" >Tipifica&ccedil;&atilde;o:</td>
          <td class="cinza">&nbsp;&nbsp;<? echo $tipificacao;?></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="letra" >Infra&ccedil;&atilde;o:</td>
          <td class="cinza">&nbsp;&nbsp;<? echo $infracao;?></td>
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
          <td width="10%" align="right" class="letra" >Data:</td>
          <td width="10%" class="negrito"><? echo $data_cadastro;?></td>
		  <td width="6%" align="right" class="letra" >Hora:</td>
          <td width="73%" class="negrito"><? echo $hora_cadastro;?></td>
        </tr>
      </table>
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
	
	<fieldset>
	<legend class="cabecalho">DETALHES DO EMPENHO</legend>
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="17%" align="right"  class="letra">VTR's:</td>
          <td width="83%" class="negrito">
		  <?
		$sqlG = "SELECT ocorrencia_guarnicao.idguarnicao,guarnicao.vtr FROM ocorrencia_guarnicao inner join guarnicao where ocorrencia_guarnicao.idocorrencia=$id and guarnicao.id=ocorrencia_guarnicao.idguarnicao";
		$resultadoG = $obj->executaQuery($sqlG);
		while( $linhaG = mysql_fetch_array($resultadoG))
		{
			$vtr = $linhaG["vtr"];
			?>
			 <input name="vtr" value="<? echo $vtr;?>" type="text" readonly="readonly" />
		<?
		}
		  ?>
		 </td>
        </tr>
        <tr>
          <td align="right"  class="letra">Hora do Empenho</td>
          <td class="negrito"><input name="hora_empenho" value="<? echo $hora_empenho;?>" type="text" readonly="readonly" /></td>
        </tr>
		<tr>
          <td align="right"  class="letra">Hora do J10</td>
          <td class="negrito"><input name="hora_chegada" value="<? echo $hora_chegada;?>" type="text" readonly="readonly" /></td>
        </tr>      
		</table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">FINALIZAR A OCORRÊNCIA</legend>
    <form name="form" action="../classes/controleFinalizarOcorrencia.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    
	<tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
		<tr>
		  <td width="9%" align="right" valign="top" class="letra" >Finalizado por: </td>
		  <td colspan="3"><input name="guarda" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
		  </tr>
		<tr>
		  <td align="right" valign="top" class="letra" >Gerado por:</td>
		  <td colspan="3"><input name="gerado" type="text" maxlength="10" id="gerado" readonly="readonly" <? if($gerado==1){ ?> value="SOLICITANTE" <? }else{?> value="GUARDA" <? } ?>/></td>
		  </tr>
		<tr>
          <td align="right" valign="top" class="letra" >Ocorr&ecirc;ncia:</td>
          <td colspan="3"><input name="idOcorrencia" type="text" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
        </tr>
		<tr>
             <td align="right" class="letra" >Tipifica&ccedil;&atilde;o:</td>
                <td colspan="3"><select name="xtipificacao" class="negrito">
                          <option <? if($tipificacao=='APOIO'){?> selected="selected" value="APOIO" <? }?>>APOIO</option>
                          <option <? if($tipificacao=='CRIME'){?> selected="selected" value="CRIME" <? }?>>CRIME</option>
                          <option <? if($tipificacao=='TRANSITO'){?> selected="selected" value="TRANSITO" <? }?>>TRANSITO</option>
						  <option <? if($tipificacao=='COLISAOVITIMA'){?> selected="selected" value="COLISAOVITIMA" <? }?>>COLISAO COM VITIMA</option>
						  <option <? if($tipificacao=='APOCOLISAOMATERIAISIO'){?> selected="selected" value="COLISAOMATERIAIS" <? }?>>COLISAO COM DANOS MATERIAIS</option>
                          <option <? if($tipificacao=='OPERACAORADAR'){?> selected="selected" value="OPERACAORADAR" <? }?>>OPERACAO RADAR</option>
                          <option <? if($tipificacao=='OUTROS'){?> selected="selected" value="OUTROS" <? }?>>OUTROS</option>
                </select>
				</td>
             </tr>
			<tr>
                <td align="right" class="letra" >Descri&ccedil;&atilde;o:</td>
                <td colspan="3"><input name="ait" id="ait" type="text" size="100" value="<? echo $infracao; ?>" /></td>
            </tr>
            <tr>
              <td align="right" class="letra" >Ve&iacute;culos Autuados: </td>
              <td width="4%"><input name="autuados" type="text" id="autuados" value="0" size="5"/></td>
              <td width="23%" align="right" class="letra" >Condutores Orientados: </td>
              <td width="64%"><input name="orientados" type="text" id="orientados" value="0" size="5"/></td>
            </tr>
            <tr>
              <td align="right" class="letra" >Motivo:</td>
              <td colspan="3"><select name="motivo" class="negrito" id="motivo">
                <option value="">Selecione se necess&aacute;rio...</option>
                <option value="ENDERECO NAO CONFERE">ENDERE&Ccedil;O N&Atilde;O CONFERE</option>
                <option value="OCORRENCIA NAO CONFERE">OCORR&Ecirc;NCIA N&Atilde;O CONFERE</option>
                <option value="NUMERO NAO EXISTE">N&Uacute;MERO N&Atilde;O EXISTE</option>
                <option value="SINALIZACAO INEFICIENTE">SINALIZA&Ccedil;&Atilde;O INEFICIENTE</option>
                <option value="SINALIZACAO INCOMPLETA">SINALIZA&Ccedil;&Atilde;O INCOMPLETA</option>
                <option value="SINALIZACAO IRREGULAR">SINALIZA&Ccedil;&Atilde;O IRREGULAR</option>
				<option value="SINALIZACAO INEXISTENTE">SINALIZA&Ccedil;&Atilde;O INEXISTENTE</option>
                <option value="OCORRENCIA SEM ENCERRAMENTO PELA GUARNICAO">OCORR&Ecirc;NCIA SEM ENCERRAMENTO PELA GUARNI&Ccedil;&Atilde;O</option>
                <option value="ATENDIMENTO DISPENSADO PELO SOLICITANTE">ATENDIMENTO DISPENSADO PELO SOLICITANTE</option>
                <option value="VEICULO RETIRADO PELO CONDUTOR">VEÍCULO RETIRADO PELO CONDUTOR</option>
              </select></td>
            </tr>
            <tr>
          <td align="right" valign="top" class="letra" >Encerramento:</td>
          <td colspan="3"><textarea name="encerramento" cols="100" rows="5" id="encerramento"><? echo $encerramento_ocorrrencia;?></textarea>
          </td>
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
          <td width="8%" align="right">&nbsp;</td>
          <td width="92%"><input name="Submit" type="submit" class="letra" id="Submit" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
          </tr>
      </table></td>
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
