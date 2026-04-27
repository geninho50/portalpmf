<?php
   	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $idescala =  (int)$_POST['idescala'];
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
   }
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   $chefe = "";
   $queryT = "SELECT chefe,auditado FROM listaescala where idescala='".$idescala."'";
   $resultT = $obj->executaQuery($queryT);
   if($linhaT = mysql_fetch_array($resultT)){
   	$chefe = $linhaT['chefe'];
	$auditado = $linhaT['auditado'];
   }
    
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
      <?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
   <legend class="negrito">Excluir Nomes dos Guardas Relacionados a Escala</legend>
<br>
<table width="500" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="129" align="right" class="letra">Chefe de Guarni&ccedil;&atilde;o:</td>
    <td width="364"><input name="xchefe" type="text" value="<?php echo $chefe ?>" size="35" /></td>
  </tr>
  <tr>
    <td width="129" align="right" class="letra">Auditado por:</td>
    <td width="364"><input name="auditado" type="text" value="<?php echo $auditado ?>" size="35" readonly="readonly" /></td>
  </tr>
</table>
<br>
<table width="50%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
  <tr>
    <td width="38%" align="left" class="branco"><b>Guardas</b></td>
	<td width="62%" align="left" class="branco">&nbsp;</td>
  </tr>
</table>

<?php 
   $adicional = 0;
		$queryE = "SELECT * FROM listaescala where idescala='".$idescala."'";
		$resultE = $obj->executaQuery($queryE);
		   
		   while($linhaE = mysql_fetch_array($resultE)):
		   
				$idescala = $linhaE['idescala'];
				$login =  $linhaE['login'];
?>
<table width="50%" border="0" cellpadding="1" cellspacing="1">
   
		<tr>
         <td width="38%"><input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /></td>
		 <td width="62%"><span class="letra"><a href="../classes/controleExcluirNomeEscala.php?idescala=<?PHP echo $idescala;?>&login=<?PHP echo $login;?>" border="0"><img src="imagens/excluir.png" alt="Excluir" width="21" height="21" border="0" /></a></span></td>
		</tr>
</table>
<?php 
  endwhile
?>
<table width="100%"  border="0">

  <tr>
    <td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
  </tr>
  
</table>
</fieldset>
	<!-- fim do adm -->
	</td>
  </tr>
</table>

</body>
</html>

<?php
   // Fechando as vari�veis de conex�o
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