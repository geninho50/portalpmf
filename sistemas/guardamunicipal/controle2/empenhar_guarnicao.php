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
   if( $idAnotacao == 0 )
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
<script type="text/javascript">
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
	<fieldset>
	<legend class="negrito">Detalhes da Ocorrências</legend>
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="right"  class="letra">Solicitante:</td>
          <td class="negrito"><? echo $comunicante.' - '.$telefone;?></td>
        </tr>
        <tr>
          <td width="10%" align="right"  class="letra">Rua:</td>
          <td class="negrito"><? echo $rua.', '.$numero; ?></td>
		  </tr>
        <tr>
          <td width="10%" align="right"  class="letra">Bairro:</td>
          <td width="90%" class="negrito"><? echo $bairro.' - '.$referencia;; ?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="10%" align="right" valign="top" class="letra" >Descri&ccedil;&atilde;o:</td>
          <td width="90%" class="negrito"><? echo $descricao_ocorrrencia;?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
	  <table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="6%" align="right" class="letra" >Data:</td>
          <td width="11%" class="negrito"><? echo $data_atual;?></td>
		  <td width="7%" align="right" class="letra" >Hora:</td>
          <td width="56%" class="negrito"><? echo $hora_atual;?></td>
        </tr>
      </table>
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
		
	
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Empenhar Guarni&ccedil;&atilde;o</legend>
    <form name="form" action="../classes/controleEmpenhoGuarnicao.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <tr>
          <td align="right"  class="letra">Ocorrência:</td>
          <td><input name="idOcorrencia" type="text" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
        </tr>	
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%"><select name="yvtr1">
		  <option value="0">Selecionar...</option>
		  <?php 
					$queryS = "SELECT * FROM guarnicao where status=1 and data_entrada='$data_atual'";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$vtr1 = $linhaS["vtr01"];
						$guarda1 = $linhaS["guarda1"];
						$guarda2 = $linhaS["guarda2"];
						$guarda3 = $linhaS["guarda3"];
						$guarda4 = $linhaS["guarda4"];
						$outros = $linhaS["outros"];
				  ?>
		  <option value="<?php echo $vtr1; ?>"><? echo $vtr1.' = '.$guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' - '.$outros;?></option>
		  <?php 
					} 
				  ?>
		</select>
		</td>
    </tr>

	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%">
		    <select name="vtr2">
		  <option value="0">Selecionar...</option>
		  <?php 
					$queryS = "SELECT * FROM guarnicao where status=1 and data_entrada='$data_atual'";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$vtr1 = $linhaS["vtr01"];
						$guarda1 = $linhaS["guarda1"];
						$guarda2 = $linhaS["guarda2"];
						$guarda3 = $linhaS["guarda3"];
						$guarda4 = $linhaS["guarda4"];
						$outros = $linhaS["outros"];
				  ?>
		  <option value="<?php echo $vtr1; ?>"><? echo $vtr1.' = '.$guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' - '.$outros;?></option>
		  <?php 
					} 
				  ?>
		</select>
		</td>
    </tr>
    <tr>
      <td align="right">Empenho:</td>
      <td align="left"><input name="hora_empenho" type="text" size="20" value="<? echo $hora_atual;?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
