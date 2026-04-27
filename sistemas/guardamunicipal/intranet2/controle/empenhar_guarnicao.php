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
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$data_cadastro = $linhaA["data_cadastro"];
		$hora_cadastro = $linhaA["hora_cadastro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
		$infracao = $linhaA["infracao"];
		$tipificacao = $linhaA["tipificacao"];
		$referencia = $linhaA["referencia"];
		$gerado = $linhaA["gerado"];
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
    <th bgcolor="#666666" scope="col">&nbsp;</th>
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
      <td>&nbsp;</td>
    </tr>
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
              <td colspan="2" class="negrito">
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
		  <td width="40%" class="negrito">
		  <a href="javascript:POPUP('mapa.php?rua=<? echo $rua;?>','900','600')"><img src="imagens/logo_google.png" width="16" height="16" border="0" title="LOCALIZAR RUA NO MAPA" /></a>
		  </td>
        </tr>
        <tr>
          <td width="10%" align="right"  class="letra">Bairro:</td>
          <td colspan="2" class="negrito">&nbsp;&nbsp;<? echo $bairro.' - '.$referencia; ?></td>
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
          <td width="11%" class="negrito">&nbsp;&nbsp;<? echo $data_cadastro;?></td>
		  <td width="4%" align="right" class="letra" >Hora:</td>
          <td width="75%" class="negrito">&nbsp;&nbsp;<? echo $hora_cadastro;?></td>
        </tr>
      </table>
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
		
	
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">EMPENHAR GUARNIÇÃO</legend>
    <form name="form" action="../classes/controleEmpenhoGuarnicao.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <tr>
          <td align="right" class="letra">Despachante:</td>
          <td><input name="login" class="negrito" type="text" maxlength="10" id="login" readonly="readonly" value="<? echo $login;?>"/></td>
        </tr>
	<tr>
          <td align="right" class="letra">Ocorr&ecirc;ncia:</td>
          <td><input name="idOcorrencia" class="negrito" type="text" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
        </tr>	
	<tr>
      <td width="14%" align="right" class="letra">VTR:</td>
      <td width="86%"><select name="idguarnicao" class="negrito">
		  <option>Selecionar...</option>
		  <option value="0">FINALIZAR</option>
		  <?php 
					//$queryS = "SELECT * FROM guarnicao where status=1 and data_entrada='$data_atual'";
					$queryS = "SELECT * FROM guarnicao where status=1 or status=8 order by vtr";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$idguarnicao = $linhaS['id'];
						$vtr = $linhaS["vtr"];
						$guarda1 = $linhaS["guarda1"];
						$guarda2 = $linhaS["guarda2"];
						$guarda3 = $linhaS["guarda3"];
						$guarda4 = $linhaS["guarda4"];
						$guarda5 = $linhaS["guarda5"];
						$outros = $linhaS["outros"];
				  ?>
		  				<option value="<?php echo $idguarnicao; ?>">
							<? 
								if($guarda1 != '' ){echo '<br>'.$vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								echo ' - '.$outros;
						?>
						</option>
		  <?php 
					} 
				  ?>
		</select>
		</td>
    </tr>
    <tr>
      <td align="right" class="letra">Empenho:</td>
      <td align="left"><input name="hora_empenho" class="negrito" type="text" size="20" value="<? echo $hora_atual;?>" /></td>
    </tr>
    <tr>
      <td align="right" class="letra">Motivo:
      <td align="left"><select name="pfisica" class="negrito">
        <option value="0">Selecione...</option>
		<option value="VTR INDISPONIVEL">VTR INDISPONIVEL</option>
        <option value="DISPENSADA PELO SOLICITANTE">DISPENSADA PELO SOLICITANTE</option>
        <option value="CHUVA (MOTO)">CHUVA (MOTO)</option>
        <option value="SINALIZACAO INEFICIENTE">SINALIZA&Ccedil;&Atilde;O INEFICIENTE</option>
        <option value="SINALIZACAO INCOMPLETA">SINALIZA&Ccedil;&Atilde;O INCOMPLETA</option>
        <option value="SINALIZACAO IRREGULAR">SINALIZA&Ccedil;&Atilde;O IRREGULAR</option>
		<option value="SINALIZACAO INEXISTENTE">SINALIZA&Ccedil;&Atilde;O INEXISTENTE</option>
        <option value="ATENDIMENTO DISPENSADO PELO SOLICITANTE">ATENDIMENTO DISPENSADO PELO SOLICITANTE</option>
      </select> 
    </tr>
    <tr>
      <td align="right" valign="top" class="letra">Descricao do Motivo:</td>
      <td><textarea name="motivo_finalizar" id="motivo_finalizar" class="negrito"  cols="60" rows="5" onkeyup="converteUpper(this);"><? echo $motivo_finalizar;?></textarea></td>
    </tr>
    </table>
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
      <tr> </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
