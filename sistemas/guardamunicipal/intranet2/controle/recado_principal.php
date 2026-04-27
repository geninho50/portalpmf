<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   
   include("incValidaSessao.php");
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   require ("../classes/trataData.php");
	class_exists('../classes/trataArquivo') || require_once ("../classes/trataArquivo.php");
	$objDt = new trataData;
	$objT = new trataArquivo;
   
   $idsession = $_SESSION['idSESSION'];
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
   
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<fieldset>
	<legend class="cabecalho">PAINEL DE RECADO</legend>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<?PHP 
$chavet = true;
 $queryE = "SELECT id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, nome, texto FROM recado order by id desc";
   $resultE = $obj->executaQuery($queryE);
   
   while($linhaE = mysql_fetch_array($resultE)):
   
  		$id = $linhaE['id'];
		$nome =  $linhaE['nome'];
		$texto =  $linhaE['texto'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
?>

  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
   <td width="11%" align="center" class="negrito"> <?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
   <td width="24%" align="left" class="negrito"><?PHP echo $nome; ?></td>
   <td width="65%" align="left" class="negrito"><?PHP echo $texto; ?></td>
  </tr>


<?PHP
		 endwhile
		
?>
</table>
</fieldset>
<fieldset>
	<legend class="cabecalho">CAIXA DE ENTRADA DE <? echo $login;?> </legend>
<table bgcolor="#0086A8" width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="17%" align="left" class="branco"><B>De:</B></td>
    <td width="67%" align="left" class="branco"><B>Assunto:</B></td>
    <td width="10%" align="center" class="branco"><B>Data:</B></td>
    <td width="6%" align="center">&nbsp;</td>
  </tr>
  </table>
<table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
<?php 
$chavee = true;
	$queryE = "SELECT id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano, de,para,assunto FROM recadodireto where statusexcluir=0 and para='$login'";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$id = $linhaE['id'];
		$de = $linhaE['de'];
		$assunto = $linhaE['assunto'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
				
?>
  <tr bgColor="<?PHP if($chavee)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavee=!$chavee;
					?>">
    <td width="17%" align="left" class="negrito"><? echo $de;?></td>
    <td width="67%" align="left" class="negrito" ><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
    <td width="10%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
    <td width="6%" align="center"><a href="../classes/controleRecadoDireto.php?idRecado=<? echo $id; ?>&acao=excluir"><font class="negrito">Excluir</font></a></td>
  </tr>
    <?php
	}
?>
</table>

</table>
</fieldset>
<fieldset>
	<legend class="cabecalho">ITENS ENVIADOS</legend>
<table bgcolor="#0086A8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="18%" align="left" class="branco"><B>Para:</B></td>
    <td width="67%" align="left" class="branco"><B>Assunto:</B></td>
    <td width="11%" align="center" class="branco"><B>Data:</B></td>
  </tr>
  </table>
<table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
<?php 
 	$data_atual = date("Y-m-d");
    $mes_atual = substr($data_atual,5,2);
	
	$chaves = true;
	$queryE = "SELECT id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano, de,para,assunto FROM recadodireto where de='$login' and MONTH(datacadastro)='$mes_atual'";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$id = $linhaE['id'];
		$para = $linhaE['para'];
		$assunto = $linhaE['assunto'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
				
?>
  <tr bgColor="<?PHP if($chaves)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chaves=!$chaves;
					?>">
    <td width="18%" align="left" class="negrito"><? echo $para;?></td>
    <td width="67%" align="left" class="negrito"><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
    <td width="11%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
  </tr>
    <?php
	}
?>
</table>

</fieldset>


</body>
</html>
