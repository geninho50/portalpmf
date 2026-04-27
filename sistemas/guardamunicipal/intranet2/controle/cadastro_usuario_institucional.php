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
    <td width="200%" colspan="2">
	<!--inicio adm-->

<table width="540"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="130"><a href="cadastro_usuario.php?matricula=<? echo $matricula; ?>"><img src="imagens/pessoal_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/pessoal_1.jpg'" onMouseOut="this.src='imagens/pessoal_0.jpg'" /></a></td>
    <td width="130"><a href="cadastro_usuario_recado.php?matricula=<? echo $matricula; ?>"><img src="imagens/recado_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/recado_1.jpg'" onMouseOut="this.src='imagens/recado_0.jpg'" /></a></td>
    <td width="130"><a href="cadastro_usuario_saude.php?matricula=<? echo $matricula; ?>"><img src="imagens/saude_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/saude_1.jpg'" onMouseOut="this.src='imagens/saude_0.jpg'" /></a></td>
    <td width="150"><a href="cadastro_usuario_escolaridade.php?matricula=<? echo $matricula; ?>"><img src="imagens/escolaridade_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/escolaridade_1.jpg'" onMouseOut="this.src='imagens/escolaridade_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_profissional.php?matricula=<? echo $matricula; ?>"><img src="imagens/profissional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/profissional_1.jpg'" onMouseOut="this.src='imagens/profissional_0.jpg'" /></a></td>
	<td width="130"><img src="imagens/institucional_1.jpg" width="150" height="40" /></td>
  </tr>
</table>
<fieldset>
	<legend class="negrito">Controle Informacoes Institucional</legend>

    <table width="100%"  border="0">
      <tr>
	  
        <td width="6%" align="center">&nbsp;</td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_local_trabalho.php?matricula=<? echo $matricula; ?>','750','650')"><IMG SRC="imagens/local_trabalho.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DO LOCAL DE TRABALHO"></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_notas.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/notas.png" width="60" height="60" border="0" title="ADICIONAR INFORMAÇÕES DAS NOTAS" /></a></td>
        <td width="15%" align="center"><a href="javascript:POPUP('cadastro_atividades_extras.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/bloco_notas.png" width="60" height="60" border="0" title="ADICIONAR ATIVIDADES EXTRAS" /></a></td>
        <td width="18%" align="center"><a href="anexar_documentos.php?matricula=<? echo $matricula; ?>"><img src="imagens/anexar.png" width="60" height="60" border="0" /></a></td>
        <td width="33%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Local de Trabalho</td>
        <td align="center" class="negrito">Notas</td>
        <td align="center" class="negrito">Projetos Apresentados</td>
		<td align="center" class="negrito">Anexar Documentos </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
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
