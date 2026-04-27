<?php
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
      <?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
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

<table width="500" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="177" align="right" class="letra">Chefe Atual de Guarni&ccedil;&atilde;o:</td>
    <td width="316"><input name="chefe" type="text" value="<?php echo $chefe;?>" size="35" /></td>
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

<table width="600" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="179" align="right" class="letra">Evento:</td>
    <td width="414"><input name="idescala" type="text" value="<?php echo $idescala;?>" size="1" /> - <input name="local" type="text" value="<?php echo $local;?>" size="60" /></td>
  </tr>
  <tr>
    <td width="179" align="right" class="letra">Novo Chefe de Guarni&ccedil;&atilde;o:</td>
    <td width="414"><input name="xchefe" type="text" value="" size="35" /></td>
  </tr>
</table>
<?PHP } ?>

<table width="100%"  border="0">
<tr>   
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />   </td>
  </tr>
  <tr>
    <td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
  </tr>
  
</table>
</form>
</fieldset>
	
	<!-- fim do adm -->
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