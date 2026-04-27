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
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	$registro = $_POST['xregistro'];

	$xBusca = trim($registro);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	
	$query = "select id,comunicante,rua,numero,bairro,descricao_ocorrencia, DAY(data_cadastro) as dia,MONTH(data_cadastro) as mes,YEAR(data_cadastro) as ano,hora_cadastro, hora_saida,telefone from ocorrencia where id=$registro order by data_cadastro asc";
	
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

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<fieldset>
	<legend class="cabecalho">CONSULTAR OCORRÊNCIA POR REGISTRO	</legend>
		<form name="form1" method="post" action="relatorio_ocorrencia_numero.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="10%" align="right" class="letra">Registro(Numero): </td>
			<td width="90%" class="letra">
			<input type="text" value="<? echo $registro;?>" name="xregistro" size="12" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		</td>
		  </tr>		   
	      <tr>
			<td align="right" class="letra">&nbsp;</td>
			<td align="left" class="letra"><input name="Pesquisar" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
		  </tr>
		</table>
		
		
		
		</form>
		</fieldset>

	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="cabecalho">RETORNOU(s) <B><? echo $nvaloresencontrados;?></B> OCORRÊNCIA DE NÚMERO&nbsp;<? echo $registro;?>.</legend>

    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="3%" align="center" class="branco"></td>
		<td width="5%" align="center" class="branco"><B>ID</B></td>		
		<td width="8%" align="center" class="branco"><B>DATA</B></td>
		<td width="11%" align="center" class="branco"><B>HORA CADASTRO</B></td>
		<td width="11%" align="center" class="branco"><B>COMUNICANTE</B></td>
		<td width="9%" align="center" class="branco"><B>TELEFONE</B></td>
		<td width="44%" align="center" class="branco">DESCRI&Ccedil;&Atilde;O</td>
		<td width="9%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $dados = mysql_fetch_array($resultado) )
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
		<td width="3%" align="center" valign="top" scope="col"><a HREF="javascript:POPUP('cadastro_guinchamento.php?idOcorrencia=<? echo $id; ?>','750','580')" border="0"><IMG SRC="imagens/guincho.png" WIDTH="20" HEIGHT="20" BORDER="0" TITLE="GUINCHAMENTO DE VE&Iacute;CULOS"></A></td>
		<td width="5%" align="center" class="negrito"><? echo $id; ?></td>		
		<td width="8%" align="center" class="negrito"><? echo $dia." / ".$mes." / ".$ano;?></td>
		<td width="11%" align="center" class="negrito"><? echo $hora_cadastro; ?></td>
		<td width="11%" align="center" class="negrito"><? echo $comunicante; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $telefone;?></td>
		<td width="44%" align="left" class="negrito"><? echo $descricao_ocorrencia;?></td>
		<td width="9%" align="center" class="negrito">
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
?>
	
</table>
</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="letra">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA OCORRÊNCIA DE NÚMERO&nbsp;<? echo $registro;?></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para  de numero&nbsp;<? echo $registro;?></B></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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