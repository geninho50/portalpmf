<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
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
		$data_cadastro = $linhaA["data_cadastro"];
		$hora_cadastro = $linhaA["hora_cadastro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
		$infracao = $linhaA["infracao"];
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
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
     <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">ADICIONAR GUARNIÇÃO A OCORRÊNCIA</legend>
    <form name="form" action="../classes/controleAddGuarnicao.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <tr>
          <td align="right"  class="letra">Ocorrência:</td>
          <td><input name="idOcorrencia" type="text" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
        </tr>	
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%"><select name="yidguarnicao" class="negrito">
		  <option value="0">Selecionar...</option>
		  <?php 
					//$queryS = "SELECT * FROM guarnicao where status=1 and data_entrada='$data_atual'";
					$queryS = "SELECT * FROM guarnicao where status=1 order by vtr asc";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$idguarnicao = $linhaS['id'];
						$vtr = $linhaS["vtr"];
						$guarda1 = $linhaS["guarda1"];
						$guarda2 = $linhaS["guarda2"];
						$guarda3 = $linhaS["guarda3"];
						$guarda4 = $linhaS["guarda4"];
						$guarda5 = $linhaS["guarda5"];
						$outros = $linhaS["outros"];
		  ?>
		  			<option value="<?php echo $idguarnicao; ?>">
						<? 
								if($guarda1 != '' ){echo '<br>'.$vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								echo ' - '.$outros;
						?>
					</option>
		  <?php 
					} 
				  ?>
		</select>
		</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
