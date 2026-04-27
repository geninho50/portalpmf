<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	   
include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   $idrecado = $_GET['idrecado'];
	if( $idrecado > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$idrecado = $_POST['idrecado'];
	}

	$consulta = "SELECT * FROM guarda_gmf where id=$idsession";
	$resposta = $obj->executaQuery($consulta);
	$dados = mysql_fetch_array($resposta);
	if( $dados )
	{
		$matricula = $dados["matricula"];
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr align="center" bgcolor="#666666">
    <th colspan="2" scope="col">
	<!-- ini menu -->
		<?php 
		$sql = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
						
			include("menu.php");
		}
		?>
    <!-- fim menu -->
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <!--inicio adm-->
      <?php 

	$queryE = "SELECT  id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano, de, para, assunto, texto FROM recadodireto where id='$idrecado'";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$id = $linhaE['id'];
		$de = $linhaE['de'];
		$para = $linhaE['para'];
		$assunto = $linhaE['assunto'];
		$texto = $linhaE['texto'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
				
?>
  <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    
  <tr>
      <td width="9%" align="right" bgcolor="#006699" class="branco"><b>De:</b></td>
      <td width="91%" align="left"><? echo $de; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#006699" class="branco"><b>Para:</b></td>
      <td align="left"><? echo $para; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#006699" class="branco"><b>Assunto:</b></td>
      <td align="left"><? echo $assunto; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#006699" class="branco"><b>Texto:</b></td>
      <td align="left" valign="top"><? echo $texto; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#006699" class="branco"><b>Data:</b></td>
      <td align="left"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
    </tr>
  </table>
      <?php
	}
?>
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="15%">&nbsp;</td>
      <td width="8%">&nbsp;</td>
      <td width="12%">&nbsp;</td>
      <td width="65%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><a href="../classes/controleRecadoDireto.php?idRecado=<? echo $id; ?>&acao=excluir"><font class="negrito">Excluir</a></font></td>
      <td><a href="javascript:history.back(1);"><font class="negrito">Voltar</font></a></td>
    </tr>
  </table>
	  <!--fim adm-->
    </td></tr>
</table>


</body>
</html>
