<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
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
   
   $idGuarnicao = 0;
   $idGuarnicao = (int)$_POST['idGuarnicao'];
   if( $idGuarnicao == 0 )
   {
	 $idGuarnicao = (int)$_GET['idGuarnicao'];
   }
   $queryO = "SELECT * FROM guarnicao where id=$idGuarnicao";
   $resultO = $obj->executaQuery($queryO);
   if( $dadosO = mysql_fetch_array($resultO) )
	{
		$idGuarnicao = $dadosO["id"];
		$vtr = $dadosO["vtr"];
		$guarda1 = $dadosO["guarda1"];
	    $guarda2 = $dadosO["guarda2"];
		$guarda3 = $dadosO["guarda3"];
		$guarda4 = $dadosO["guarda4"];
		$guarda5 = $dadosO["guarda5"];
		$setor = $dadosO["setor"];
		$outros = $dadosO["outros"];
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
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
<form name="form" action="../classes/controleRemoverOcupantes.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    
    <fieldset>
	<legend class="negrito">Ocupantes da Guarnicao <? echo $idGuarnicao; ?> atual</legend>
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right">Guarnicao:</td>
      <td width="88%"><input name="idGuarnicao" id="idGuarnicao" type="text" value="<? echo $idGuarnicao;?>" size="5" readonly="readonly"/></td>
    </tr>
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%"><input type="text" name="vtr1" id="vtr1" size="10" value="<? echo $vtr;?>" readonly="readonly"/></td>
    </tr>
    <tr>
      <td align="right">Setor:</td>
      <td><input type="text" name="setor1" id="setor1" size="20" value="<? echo $setor;?>" readonly="readonly"/></td>
    </tr>
    <tr>
      <td align="right">Atual:</td>
      <td>
        
        <input type="text" name="guarda1" id="guarda1" size="20" value="<? echo $guarda1;?>" readonly="readonly"/>
        <input type="text" name="guarda2" id="guarda2" size="20" value="<? echo $guarda2;?>" readonly="readonly"/>
        <input type="text" name="guarda3" id="guarda3" size="20" value="<? echo $guarda3;?>" readonly="readonly"/>
        <input type="text" name="guarda4" id="guarda4" size="20" value="<? echo $guarda4;?>" readonly="readonly"/>
        <input type="text" name="guarda5" id="guarda5" size="20" value="<? echo $guarda5;?>" readonly="readonly"/>
        </td>
    </tr>
    <tr>
      <td align="right">Tipo:</td>
      <td><input type="text" name="tipo" id="outros" size="20" value="<? echo $outros;?>" readonly="readonly"/></td>
    </tr>
    </table>
  </fieldset>
  
  <fieldset>
	<legend class="negrito">Ocupantes da Guarnicao <? echo $idGuarnicao; ?> a ser inserida</legend>
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
	  <td width="12%" align="right">VTR:</td>
	  <td width="88%">
         <select name="yvtr" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="0">Selecionar...</option>
          <option value="A PE">A PE</option>
          <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
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
      <td align="right">Setor:</td>
      <td><select name="setor" class="negrito">
        <option value="0" selected="selected">SETOR 0</option>
        <option value="1" >SETOR 1</option>
        <option value="2">SETOR 2</option>
        <option value="3">SETOR 3</option>
        <option value="4">SETOR 4</option>
        <option value="5">SETOR 5</option>
        <option value="6">SETOR 6</option>
        <option value="7">SETOR 7</option>
        <option value="8">SETOR 8</option>
        <option value="9">SETOR 9</option>
        <option value="10">SETOR 10</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Nova Guarnicao:</td>
      <td>
        <input type="text" name="xGM1_1" id="xGM1_1" size="20" value="<? echo $guarda1;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
        <input type="text" name="GM1_2" id="GM1_2" size="20" value="<? echo $guarda2;?>"/>
        <input type="text" name="GM1_3" id="GM1_3" size="20" value="<? echo $guarda3;?>"/>
        <input type="text" name="GM1_4" id="GM1_4" size="20" value="<? echo $guarda4;?>"/>
        <input type="text" name="GM1_5" id="GM1_5" size="20" value="<? echo $guarda5;?>"/>
        </td>
    </tr>
    <tr>
      <td align="right">Tipo:</td>
      <td>
	  	<select name="youtros" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="ATENDIMENTO 153" selected>ATENDIMENTO 153</option>
		  <option value="ZONA AZUL" >ZONA AZUL</option>
		  <option value="PRO CIDADAO" >PRO CIDADAO</option>
		  <option value="RONDA ESCOLAR NORTE" >RONDA ESCOLAR NORTE</option>
		  <option value="RONDA ESCOLAR SUL" >RONDA ESCOLAR SUL</option>
          <option value="RONDA ESCOLAR CENTRO" >RONDA ESCOLAR CENTRO</option>
		  <option value="APOIO" >APOIO</option>
		  <option value="APOIO SESP" >APOIO SESP</option>
		  <option value="HORA EXTRA" >HORA EXTRA</option>
		  <option value="ADMINISTRATIVO" >ADMINISTRATIVO</option>
        </select>
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
  </table>
  </fieldset>
</form>


	<!--fim adm-->
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








    