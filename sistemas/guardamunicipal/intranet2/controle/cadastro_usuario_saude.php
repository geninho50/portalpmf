<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	$matricula = $_GET['matricula'];
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objS = new trataString;
	$conexao->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $conexao->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!--inicio adm-->
	<table width="540"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="130"><a href="cadastro_usuario.php?matricula=<? echo $matricula; ?>"><img src="imagens/pessoal_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/pessoal_1.jpg'" onMouseOut="this.src='imagens/pessoal_0.jpg'" /></a></td>
    <td width="130"><a href="cadastro_usuario_recado.php?matricula=<? echo $matricula; ?>"><img src="imagens/recado_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/recado_1.jpg'" onMouseOut="this.src='imagens/recado_0.jpg'" /></a></td>
    <td width="150"><a href="cadastro_usuario_saude.php?matricula=<? echo $matricula; ?>"><img src="imagens/saude_1.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/saude_0.jpg'" onMouseOut="this.src='imagens/saude_1.jpg'" /></a></td>
    <td width="150"><a href="cadastro_usuario_escolaridade.php?matricula=<? echo $matricula; ?>"><img src="imagens/escolaridade_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/escolaridade_1.jpg'" onMouseOut="this.src='imagens/escolaridade_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_profissional.php?matricula=<? echo $matricula; ?>"><img src="imagens/profissional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/profissional_1.jpg'" onMouseOut="this.src='imagens/profissional_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_institucional.php?matricula=<? echo $matricula; ?>"><img src="imagens/institucional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/institucional_1.jpg'" onMouseOut="this.src='imagens/institucional_0.jpg'" /></a></td>  
  </tr>
</table>
<fieldset>
	<legend class="cabecalho">CONTROLE DE CADASTRO DE INFORMAÇÕES DE SAÚDE</legend>

<table width="100%"  border="0">
      <tr>
        <td width="9%" align="center">&nbsp;</td>
        <td width="14%" align="center"><a href="javascript:POPUP('pop_historico_doenca.php?matricula=<? echo $matricula; ?>','750','500')"><IMG SRC="imagens/historico.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE HISTÓRICO DE DOENÇAS"></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('pop_tratamento.php?matricula=<? echo $matricula; ?>','750','500')"><IMG SRC="imagens/hospital.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE TRATAMENTO DE SAÚDE"></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('pop_alergia.php?matricula=<? echo $matricula; ?>','750','500')"><IMG SRC="imagens/tratamento.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE ALERGIA"></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('pop_medicamento.php?matricula=<? echo $matricula; ?>','750','500')"><IMG SRC="imagens/medicamento.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE MEDICAMENTO"></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('pop_plano_saude.php?matricula=<? echo $matricula; ?>','750','500')"><IMG SRC="imagens/planosaude.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE PLANO DE SAÚDE"></a></td>
       	<td width="9%" align="center"> <a href="javascript:POPUP('pop_tipo_sanguinio.php?matricula=<? echo $matricula; ?>','750','250')"><IMG SRC="imagens/doacao.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE TIPO SANGUINIO"></a></td>
        <td width="12%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Hist&oacute;rico de Doen&ccedil;as </td>
        <td align="center" class="negrito">Tratamento de Sa&uacute;de </td>
        <td align="center" class="negrito">Alergia a Medicamento, Alimentos e Outros </td>
        <td align="center" class="negrito">Medicamento</td>
        <td align="center" class="negrito">Plano de Sa&uacute;de </td>
        <td align="center" class="negrito">Tipo Sanguinho </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
</table>


</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
