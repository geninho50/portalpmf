<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idOcorrencia == 0 )
   {
	 $idOcorrencia = (int)$_GET['idOcorrencia'];
   }

    $sqlA = "SELECT * FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
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
	<legend class="negrito">Cadastrar Guarni&ccedil;&atilde;o</legend>
    <form name="form" action="../classes/controleGuarnicao.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%">
		  <select name="yvtr1">
			  <option value="0">Selecionar...</option>
			  <?php 
				$queryU = "SELECT * FROM vtr order by vtr";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$vtr = $linhaU['vtr'];
			  ?>
						 <option value="<?php echo $vtr; ?>"><?php echo $vtr; ?></option>
			  <?php 
				} 
	  		  ?>
	    </select> 
		</td>
    </tr>
    <tr>
      <td align="right">Guarni&ccedil;&atilde;o:</td>
      <td>
	  <select name="yGM1_1">
			  <option value="">Selecionar...</option>
			  <?php 
				$queryU = "SELECT * FROM guarda_gmf order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$log = $linhaU['login'];
			  ?>
						 <option value="<?php echo $log; ?>"><?php echo $log; ?></option>
			  <?php 
				} 
	  		  ?>
	    </select> 
	  - 
	  <select name="GM1_2">
        <option value="">Selecionar...</option>
        <?php 
				$queryU = "SELECT * FROM guarda_gmf order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$log = $linhaU['login'];
			  ?>
        <option value="<?php echo $log; ?>"><?php echo $log; ?></option>
        <?php 
				} 
	  		  ?>
      </select>
	  - 
	  <select name="GM1_3">
        <option value="">Selecionar...</option>
        <?php 
				$queryU = "SELECT * FROM guarda_gmf order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$log = $linhaU['login'];
			  ?>
        <option value="<?php echo $log; ?>"><?php echo $log; ?></option>
        <?php 
				} 
	  		  ?>
      </select>
	  - 
	  <select name="GM1_4">
        <option value="">Selecionar...</option>
        <?php 
				$queryU = "SELECT * FROM guarda_gmf order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$log = $linhaU['login'];
			  ?>
        <option value="<?php echo $log; ?>"><?php echo $log; ?></option>
        <?php 
				} 
	  		  ?>
      </select>
	  </td>
    </tr>
    <tr>
      <td align="right">Outros:</td>
      <td>
	  	<input type="radio" name="outros" id="outros" value="" onclick="pf()"> 
		<input name="pfisica" id="pfisica" type="text" style="width: 185; height: 22; visibility: hidden" size="40" onkeyup="converteUpper(this);" </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" class="botao" id="Submit2" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
    </tr>
  </table>
</form>
</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
