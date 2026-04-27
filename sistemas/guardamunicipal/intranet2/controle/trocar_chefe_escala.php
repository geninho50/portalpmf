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
   <legend class="negrito">Troca de Chefe de Guarni&ccedil;&atilde;o </legend>
   <form name="form1" action="../classes/controleTrocaChefeEscala.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<br>

<?php 
   $queryE = "SELECT * FROM listaescala where idescala='".$idescala."'";
   $resultE = $obj->executaQuery($queryE);
   $linhaE = mysql_fetch_array($resultE);
   if($linhaE > 0){
   
  		$chefe = $linhaE['chefe'];
		$idescala = $linhaE['idescala'];

?>

<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="15%" align="right" class="letra">Chefe Atual de Guarni&ccedil;&atilde;o:</td>
    <td width="85%"><input name="chefe" type="text" value="<?php echo $chefe;?>" size="35" /></td>
  </tr>
</table>
<?PHP  
}?>
<?PHP
		$query = "SELECT * FROM escalahoraextra where id='".$idescala."'";
		$result = $obj->executaQuery($query);
		while($linha = mysql_fetch_array($result)){
				$local = $linha['local'];

?>
<br>

<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="15%" align="right" class="letra">Evento:</td>
    <td width="85%"><input name="idescala" type="text" value="<?php echo $idescala;?>" size="1" /> - <input name="local" type="text" value="<?php echo $local;?>" size="60" /></td>
  </tr>
  <tr>
    <td width="15%" align="right" class="letra">Novo Chefe de Guarni&ccedil;&atilde;o:</td>
    <td width="85%">
    <select name="ychefe" class="negrito" onfocus="mudacor(this,'#8BC5F3')">
          <option value="0">SELECIONAR...</option>
          <?php 
				$queryU = "SELECT * FROM guarda_gmf where cargo!='Guarda Municipal' AND cargo!='Zona Azul' order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$login = $linhaU['login'];
					$cargo = $linhaU['cargo'];
			  ?>
          <option value="<?php echo $login; ?>"><?php echo $cargo.' '.$login; ?></option>
          <?php 
				} 
	  		  ?>
        </select>
    </td>
  </tr>
</table>
<?PHP } ?>

<table width="100%"  border="0">
<tr>   
    <td width="15%">&nbsp;</td>
    <td width="85%"><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="letra"><a href="javascript:history.back(1);">Voltar</a></td>
  </tr>
  
</table>
</form>
</fieldset>
	
	<!-- fim do adm -->
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