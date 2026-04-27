<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idVtr = 0;
   $idVtr = (int)$_POST['idVtr'];
   if( $idVtr == 0 )
   {
	 $idVtr = (int)$_GET['idVtr'];
   }

    $sqlA = "SELECT * FROM vtr where id=$idVtr";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$vtr = $linhaA["vtr"];
		$classe = $linhaA["classe"];
   }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
<script language="JavaScript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
		function converteUpper(campo) {
        campo.value = campo.value.toUpperCase();
       }
	   function pf(){
		document.form.pfisica.style.visibility='visible';
		document.form.pjuridica.style.visibility='hidden';
		}
		shortcut.add("F3",function() 
		{
			window.location.href = 'cadastro_guarnicao.php';
		});
		shortcut.add("F2",function() 
		{
			window.location.href = 'cadastro_ocorrencia.php';
		});
		shortcut.add("F4",function() 
		{
			window.location.href = 'administrar_ocorrencia.php';
		});

		function converteUpper(campo) {
        campo.value = campo.value.toUpperCase();
       }
</script>

</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
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
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Cadastrar VTR </legend>
    <form name="form" action="../classes/controleVtr.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%">
			<input type="text" name="xvtr" value="<? echo $vtr;?>" onkeyup="converteUpper(this);"/>			
	</td>
    </tr>
    <tr>
      <td align="right">Guarni&ccedil;&atilde;o:</td>
      <td>
	  <input type="text" name="xclasse" value="<? echo $classe;?>" onkeyup="converteUpper(this);"/>
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" class="botao" id="Submit2" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
    </tr>
  </table>
</form>
</fieldset>

	<fieldset>
	<legend class="letra">VTR Cadastradas</legend>

    <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="53%" align="left" class="branco"><B>VTR</B></td>				
		<td width="23%" align="center" class="branco"><B> Classe</B></td>	
	</tr> 
</table>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<?php
		$sqlhora1 = "SELECT * FROM vtr ORDER BY vtr ASC ";
		$resultadohora1 = $obj->executaQuery($sqlhora1);
		while ( $linhaH1 = mysql_fetch_array($resultadohora1) )
		{	
			  $vtr = $linhaH1['vtr'];
			  $classe = $linhaH1['classe'];
?>
		<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
			<td width="53%" align="left" class="letra"><? echo $vtr; ?></td>		
	    <td width="23%" class="letra" align="center"><? echo $classe; ?></td>
    	</tr>
<?php
		}	
?>
</table>
</fieldset>	
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
