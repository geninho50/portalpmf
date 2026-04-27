<?php
	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$matricula = $linha["matricula"];
		$nome = $linha["nome"];
	}
	
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idOcorrencia == 0 )
   {
	 $idOcorrencia = (int)$_GET['idOcorrencia'];
   }
   
   $sqlA = "SELECT id,DAY(data_cadastro) as dia,MONTH(data_cadastro) as mes,YEAR(data_cadastro) as ano,guarda,guarda_finalizar,telefone,comunicante,rua,numero,bairro,descricao_ocorrencia,motivo,motivo_finalizar,hora_cadastro,hora_empenho,hora_chegada,hora_saida,encerramento_ocorrencia,autuados,orientados FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$guarda = $linhaA["guarda"];
		$guarda_finalizar = $linhaA["guarda_finalizar"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
		$data_cadastro = $linhaA["data_cadastro"];
		$hora_cadastro = $linhaA["hora_cadastro"];
		$hora_empenho1 = $linhaA["hora_empenho"];
		$hora_chegada = $linhaA["hora_chegada"];
		$hora_saida = $linhaA["hora_saida"];
		$autuados = $linhaA["autuados"];
		$orientados = $linhaA["orientados"];
		$encerramento_ocorrencia = $linhaA["encerramento_ocorrencia"];
		$motivo = $linhaA["motivo"];
		$motivo_finalizar = $linhaA["motivo_finalizar"];
		$dia = $linhaA['dia'];
		$mes = $linhaA['mes'];
		$ano = $linhaA['ano'];
		
		$sqlI = "SELECT * FROM ocorrencia_finalizada where idOcorrencia=$id";
		$resultadoI = $obj->executaQuery($sqlI);
		if( $linhaI = mysql_fetch_array($resultadoI))
		{
			//$id = $linhaI["id"];
			$descricao = $linhaI["descricao"];
			$guarda_add = $linhaI["guarda"];
		}
		$sqlD = "SELECT * FROM dados_ocorrencia where idOcorrencia=$id";
		$resultadoD = $obj->executaQuery($sqlD);
		if( $linhaD = mysql_fetch_array($resultadoD))
		{
			//$id = $linhaI["id"];
			$descricao_ocorrencia = $linhaD["descricao_ocorrencia"];
			$guarda_ad = $linhaD["guarda"];
		}
		
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
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><img src="imagens/brasao.png" width="72" height="91" /></td>
      </tr>
	  <tr>
        <td width="84%" align="center" valign="middle"><font class="style1">PREFEITURA MUNICIPAL DE FLORIAN&Oacute;POLIS</font><BR>
          <font class="style2">SECRETARIA MUNICIPAL DE SEGURAN&Ccedil;A E GESTÃO DO TRÂNSITO<BR>
          GUARDA MUNICIPAL DE FLORIAN&Oacute;POLIS</font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><span class="style3">RELAT&Oacute;RIO DE OCORR&Ecirc;NCIA </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="negrito"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<fieldset>
		<legend class="negrito">Registro de Ocorrencia N&ordm;<? echo ': <font class="style2">'.$id.'/'.$ano.'</font> '; ?></legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="20%" align="right" class="negrito">Data:</td>
        <td width="13%" align="left">&nbsp;&nbsp;<?php echo $dia." / ".$mes." / ".$ano; ?></td>
        <td width="11%" align="right" class="negrito">Hora:</td>
        <td width="56%" align="left">&nbsp;&nbsp;<? echo $hora_cadastro;?></td>
      </tr>
      <tr>
        <td align="right" class="negrito">Solicitante:</td>
        <td align="left">&nbsp;&nbsp;<? echo $comunicante;?></td>
        <td align="right" class="negrito">Telefone:</td>
        <td align="left">&nbsp;&nbsp;<? echo $telefone; ?></td>
      </tr>
      <tr>
        <td align="right" class="negrito">Cadastrado pelo GM :</td>
        <td align="left">&nbsp;&nbsp;<? echo $guarda; ?></td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
    </table>
</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<fieldset>
		<legend class="negrito">Descricao da Ocorrencia</legend>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<table width="100%"  border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="41%" align="left" class="negrito">Local:</td>
					<td width="59%" align="left" class="negrito">Bairro:</td>
				  </tr>
				  <tr>
					<td align="left"><? echo $rua.', '.$numero; ?></td>
					<td align="left"><? echo $bairro; ?></td>
				  </tr>
			  </table>		</td>
		  </tr>
		  <tr>
			<td>
				<table width="100%"  border="0" cellpadding="0" cellspacing="0">
				 <tr>
					<td align="left" class="negrito">Descricao:</td>
				</tr>
				<tr>
					<td align="left"><? echo $descricao_ocorrrencia; ?></td>
				 </tr>
				</table>
			</td>
		  </tr>
		</table>
		</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<fieldset>
		<legend class="negrito">Guarnicao e Viatura(s) Empenhada(s)</legend>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="61%" align="left">
				<?
					$sqlG = "SELECT ocorrencia_guarnicao.idguarnicao,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 FROM ocorrencia_guarnicao inner join guarnicao where ocorrencia_guarnicao.idocorrencia=$id and guarnicao.id=ocorrencia_guarnicao.idguarnicao";
					$resultadoG = $obj->executaQuery($sqlG);
					while( $linhaG = mysql_fetch_array($resultadoG))
					{
						$vtr = $linhaG["vtr"];
						$guarda1 = $linhaG["guarda1"];
						$guarda2 = $linhaG["guarda2"];
						$guarda3 = $linhaG["guarda3"];
						$guarda4 = $linhaG["guarda4"];
						$guarda5 = $linhaG["guarda5"];
					
						if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
						if($guarda2 != '' ){echo ' / '.$guarda2;}
						if($guarda3 != '' ){echo ' / '.$guarda3;}
						if($guarda4 != '' ){echo ' / '.$guarda4;}
						if($guarda5 != '' ){echo ' / '.$guarda5;}
				}
				?>
				<BR>
				<?
				$sqlGR = "SELECT guarnicao_apoio_ocorrencia.hora_entrada,guarnicao_apoio_ocorrencia.hora_saida,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 FROM guarnicao_apoio_ocorrencia inner join guarnicao where guarnicao_apoio_ocorrencia.idocorrencia=$id and guarnicao.id=guarnicao_apoio_ocorrencia.idguarnicao";
					$resultadoGR = $obj->executaQuery($sqlGR);
					while( $linhaGR = mysql_fetch_array($resultadoGR))
					{
						$vtrR = $linhaGR["vtr"];
						$guarda1R = $linhaGR["guarda1"];
						$guarda2R = $linhaGR["guarda2"];
						$guarda3R = $linhaGR["guarda3"];
						$guarda4R = $linhaGR["guarda4"];
						$guarda5R = $linhaGR["guarda5"];
						$horaE = $linhaGR["hora_entrada"];
						$horaS = $linhaGR["hora_saida"];
						
						if($guarda1R != '' ){echo $vtrR.' = '.$guarda1R;}
						if($guarda2R != '' ){echo ' / '.$guarda2R;}
						if($guarda3R != '' ){echo ' / '.$guarda3R;}
						if($guarda4R != '' ){echo ' / '.$guarda4R;}
						if($guarda5R != '' ){echo ' / '.$guarda5R;}
						echo'<font class="negrito"> Hora Entrada: </font>'.$horaE.'<font class="negrito"> Hora Saída: </font>'.$horaS.'<BR>';
				}
				?></td>
                <td width="39%" align="left" class="negrito">&nbsp;</td>
              </tr>
            </table></td>
		  </tr>
		  <tr>
			<td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="19%" align="left" class="negrito">Hora do Empenho:</td>
                <td width="18%" align="left" class="negrito">Hora da Chegada:</td>
                <td width="63%" align="left" class="negrito">Hora Encerramento: </td>
              </tr>
              <tr>
                <td align="left"><? echo $hora_empenho1;?></td>
                <td align="left"><? echo $hora_chegada;?></td>
                <td align="left" ><? echo $hora_saida;?></td>
              </tr>
            </table></td>
		  </tr>
		</table>
		</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<fieldset>
		<legend class="negrito">Encerramento da Ocorrencia feito pelo(a) GM <? echo $guarda_finalizar;?></legend>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="left">
			<?
			if($autuados > 0){
				echo'VEÍCULOS AUTUADOS: '.$autuados.'<br>';
			}
			if($orientados > 0){
					echo'CONDUTORES ORIENTADOS: '.$orientados.'<br>';
			}	
			?>
			<? echo $motivo;?><? echo $encerramento_ocorrencia;?><? echo $motivo_finalizar;?></td>
		  </tr>
		  <? if($descricao!=''){?>
		  <tr>
		    <td class="negrito" align="left">Dados Adicionados pelo GM(a) <? echo $guarda_add;?>: </td>
	      </tr>
		  <tr>
		    <td align="left"><? echo $descricao;?></td>
	      </tr>
		  <? }else{}?>
          <? if($descricao_ocorrencia!=''){?>
		  <tr>
		    <td class="negrito" align="left">Dados Adicionados pelo GM(a) <? echo $guarda_ad;?>: </td>
	      </tr>
		  <tr>
		    <td align="left"><? echo $descricao_ocorrencia;?></td>
	      </tr>
		  <? }else{}?>
		</table>
		</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--GUINCHAMENTO-->
		<? 
			$queryG = "select * from guinchamento where idocorrencia='$id'";
			$resultG = $obj->executaQuery($queryG);
			$linhaG = mysql_fetch_array($resultG);
			if( $linhaG  ){
			?>
				<? include("includeGuichamento.php");?>
			<?
			}
		?>
		
		
	<!--FIM-->
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="46%" align="center">....................................................................................</td>
        <td width="8%">&nbsp;</td>
        <td width="46%" align="center">....................................................................................</td>
      </tr>
      <tr>
        <td align="center"><font class="negrito">Gerado por: </font><? echo $nome;?> <br>
          <font class="negrito"> Matricula:</font> <? echo $matricula;?></td>
        <td>&nbsp;</td>
        <td align="center" class="negrito">Chefia Respons&aacute;vel </td>
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
    <td align="center" class="negrito">Rua Cap Euclides de Castro, 236, Coqueiros, Florian&oacute;polis - SC <br>
      CEP: 88080-010 Fone/Fax: (48) 3281-4600 <br>
   www.gmf.sc.gov.br </td>
  </tr>
</table>
</body>
</html>
