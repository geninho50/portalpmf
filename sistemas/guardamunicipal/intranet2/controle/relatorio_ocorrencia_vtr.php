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
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$vtr = $_POST['yvtr'];
	$datainicial = $_POST['xdataini'];
	$datafinal = $_POST['xdatafinal'];
	
	$arrayI = explode("-", $datainicial);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
	
	$arrayF = explode("-", $datafinal);
	$diaf = $arrayF[2];
	$mesf = $arrayF[1];
	$anof = $arrayF[0];	

	$vtr = trim($vtr);
	$tamanho = strlen($vtr);
	$nvaloresencontrados = 0;
	
	//$query = "select guarnicao.vtr, ocorrencia_guarnicao.idocorrencia from guarnicao inner join ocorrencia_guarnicao where guarnicao.data_entrada between '$datainicial' and '$datafinal' and guarnicao.vtr='$vtr' and ocorrencia_guarnicao.idguarnicao=guarnicao.id  order by guarnicao.data_entrada desc";
	$query = "select ocorrencia_guarnicao.idocorrencia,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 from guarnicao inner join ocorrencia_guarnicao where guarnicao.data_entrada between '$datainicial' and '$datafinal' and guarnicao.vtr ='$vtr' and ocorrencia_guarnicao.idguarnicao=guarnicao.id ORDER BY guarnicao.id ASC";
	
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
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
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTAR OCORRÊNCIA POR VTR</legend>
		<form name="form1" method="post" action="relatorio_ocorrencia_vtr.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="13%" align="right" class="letra">Data Inicial: </td>
			<td width="12%">
			<input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12" class="negrito"/>
			<a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		</td>
			<td width="7%" align="right" class="letra">Data Final:</td>
		    <td width="68%">
			<input type="text" value="<? echo $datafinal;?>" readonly name="xdatafinal" size="12" class="negrito"/>
			<a onClick="displayCalendar(document.forms[0].xdatafinal,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		</td>
		  </tr>		   
		    <tr>
		      <td width="13%" align="right" class="letra">VTR: </td>
		      <td width="12%" align="left">
			  <select name="yvtr" class="negrito">
			  <option value="0">Selecionar...</option>
			  <?php 
				$queryU = "SELECT * FROM vtr order by vtr";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$vtrLista = $linhaU['vtr'];
			  ?>
						 <option value="<?php echo $vtrLista; ?>"><?php echo $vtrLista; ?></option>
			  <?php 
				} 
	  		  ?>
	    </select> 
			  </td>
			  <td align="right" class="letra">&nbsp;</td>
			<td align="right" class="letra">&nbsp;</td>
	      </tr>
	      <tr>
			<td align="right" class="letra">&nbsp;</td>
			<td align="left" class="letra"><input name="Pesquisar" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
			<td align="right" class="letra">&nbsp;</td>
			<td align="right" class="letra">&nbsp;</td>
		  </tr>
		</table>
		
		
		
		</form>
		</fieldset>

	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="cabecalho">RETORNOU(s) <B><? echo $nvaloresencontrados;?></B> OCORRÊNCIAS PARA A  <? echo $vtr;?> ENTRE ÀS DATAS <? echo $diai.'-'.$mesi.'-'.$anoi.' a '.$diaf.'-'.$mesf.'-'.$anof;?>.</legend>

    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="5%" align="center" class="branco"></td>
		<td width="7%" align="center" class="branco"><B>ID</B></td>		
		<td width="8%" align="center" class="branco"><B>DATA</B></td>
		<td width="11%" align="center" class="branco"><B>HORA CADASTRO</B></td>
		<td width="12%" align="center" class="branco"><B>COMUNICANTE</B></td>
		<td width="12%" align="center" class="branco"><B>GUARNI&Ccedil;&Atilde;O</B></td>
		<td width="45%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linhaQ = mysql_fetch_array($resultado) )
	{		
		$idocorrencia = $linhaQ['idocorrencia'];
		$guarda1 = $linhaQ['guarda1'];
		$guarda2 = $linhaQ['guarda2'];
		$guarda3 = $linhaQ['guarda3'];
		$guarda4 = $linhaQ['guarda4'];
		$guarda5 = $linhaQ['guarda5'];
		
		$sql = "select id,comunicante,rua,numero,bairro,descricao_ocorrencia, DAY(data_cadastro) as dia,MONTH(data_cadastro) as mes,YEAR(data_cadastro) as ano,hora_cadastro, hora_saida from ocorrencia where id=$idocorrencia order by id";
		$result = $obj->executaQuery($sql);
		while ( $dados = mysql_fetch_array($result) )
		{		
			$id = $dados['id'];
			$telefone = $dados['telefone'];
			$comunicante = $dados['comunicante'];
			$rua = $dados['rua'];
			$numero = $dados['numero'];
			$bairro = $dados['bairro'];
			$referencia = $dados['referencia'];
			$descricao_ocorrencia = $dados['descricao_ocorrencia'];
			$tipificacao = $dados['tipificacao'];
			$data_cadastro = $dados['data_cadastro'];
			$hora_cadastro = $dados['hora_cadastro'];
			$hora_empenho1 = $dados['hora_empenho'];
			$hora_chegada1 = $dados['hora_chegada'];
			$hora_saida1 = $dados['hora_saida'];
			$encerramento_ocorrencia = $dados['encerramento_ocorrencia'];
			$status = $dados['status'];
			$dia = $dados['dia'];
			$mes = $dados['mes'];
			$ano = $dados['ano'];
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>" >
					
		<td width="5%" align="center" valign="top" scope="col"><a HREF="javascript:POPUP('cadastro_guinchamento.php?idOcorrencia=<? echo $id; ?>','750','580')" border="0"><IMG SRC="imagens/guincho.png" WIDTH="20" HEIGHT="20" BORDER="0" TITLE="GUINCHAMENTO DE VE&Iacute;CULOS"></A></td>
		<td width="7%" align="center" class="negrito"><? echo $id; ?></td>		
		<td width="8%" align="center" class="negrito"><? echo $dia." / ".$mes." / ".$ano;?></td>
		<td width="11%" align="center" class="negrito"><? echo $hora_cadastro; ?></td>
		<td width="12%" align="center" class="negrito"><? echo $comunicante; ?></td>
		<td width="12%" align="center" class="negrito"><a href="#" title="<? echo $descricao_ocorrencia;?>">
			<? 
				if($guarda1 != '' ){echo $guarda1;}
				if($guarda2 != '' ){echo ' / '.$guarda2;}
				if($guarda3 != '' ){echo ' / '.$guarda3;}
				if($guarda4 != '' ){echo ' / '.$guarda4;}
				if($guarda5 != '' ){echo ' / '.$guarda5;}
			?></a>
		</td>
		<td width="45%" align="center" class="negrito">
			<? 
				$queryG = "select * from guinchamento where idocorrencia='$id'";
				$resultG = $obj->executaQuery($queryG);
				$linhaG = mysql_fetch_array($resultG);
				if( $linhaG  ){
				?>
						<a HREF="javascript:POPUP('imprimir_guinchamento.php?idGuinchamento=<? echo $linhaG['id']; ?>','700','600')" border="0"><IMG SRC="imagens/guincho.png" WIDTH="20" HEIGHT="20" BORDER="0" TITLE="GUINCHAMENTO DA OCORR&Ecirc;NCIA"></A>
				<?
				}
			?>
			<a HREF="javascript:POPUP('imprimir_ocorrencia.php?idOcorrencia=<? echo $dados['id']; ?>','700','600')" border="0"><IMG SRC="imagens/p.png" WIDTH="20" HEIGHT="20" BORDER="0" TITLE="IMPRIMIR OCORR&Ecirc;NCIA"></A>
			<a href="javascript:POPUP('adicionar_dados_ocorrencia_finalizada.php?idOcorrencia=<? echo $dados['id']; ?>','700','350')"><IMG SRC="imagens/add.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES A OCORR&Ecirc;NCIA"></a>
		</td>
		
	</tr>

<?php
		}
	}
?>
	
</table>
</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA A <? echo $vtr;?> ENTRE ÀS DATAS <? echo $diai.'-'.$mesi.'-'.$anoi.' à '.$diaf.'-'.$mesf.'-'.$anof;?></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para a <B> <? echo $vtr;?> entre as datas <? echo $diai.'-'.$mesi.'-'.$anoi.' à '.$diaf.'-'.$mesf.'-'.$anof;?></B></td>
	</tr>	
</table>
</fieldset>
<?
}
?>


    </td>
  </tr> 
	
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>