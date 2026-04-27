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
	<td width="150"><a href="cadastro_usuario_profissional.php?matricula=<? echo $matricula; ?>"><img src="imagens/profissional_1.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/profissional_0.jpg'" onMouseOut="this.src='imagens/profissional_1.jpg'" /></a></td>
 	<td width="150"><a href="cadastro_usuario_institucional.php?matricula=<? echo $matricula; ?>"><img src="imagens/institucional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/institucional_1.jpg'" onMouseOut="this.src='imagens/institucional_0.jpg'" /></a></td>
  </tr>
</table><fieldset>
	<legend class="negrito">Controle Cadastro Profissional</legend>
    <table width="100%"  border="0">
      <tr>
        <td width="16%" align="center">&nbsp;</td>
        <td width="13%" align="center"><a href="javascript:POPUP('profissional_conhecimento_especifico.php?matricula=<? echo $matricula; ?>','750','650')"><IMG SRC="imagens/cursos.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE CONHECIMENTO ESPECIFICO"></a></td>
        <td width="12%" align="center"><a href="javascript:POPUP('profissional_experiencia.php?matricula=<? echo $matricula; ?>','750','650')"><IMG SRC="imagens/esperiencia.png" WIDTH="60" HEIGHT="60" BORDER="0" title="ADICIONAR INFORMAÇÕES DE EXPERIENCIA PROFISSIONAL"></a></td>
        <td width="59%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Conhecimentos Espec&iacute;ficos </td>
        <td align="center" class="negrito">Esperi&ecirc;ncias Profissionais </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
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
