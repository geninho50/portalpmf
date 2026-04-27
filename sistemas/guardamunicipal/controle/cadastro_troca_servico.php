<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th bgcolor="#666666">
	<!-- ini menu -->
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
    <!-- fim menu -->
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	
<fieldset>
	<legend class="negrito">Resultado da Solicitacao </legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="4%" align="center" class="branco"><strong>N</strong></td>	
		<td width="10%" align="left" class="branco"><B>Troca com...</B></td>
		<td width="15%" align="left" class="branco"><B>Para o dia...</B></td>
		<td width="18%" align="left" class="branco"><B>Forma de Reposi��o</B></td>
		<td width="47%" align="left" class="branco"><B>Motivo Negado</B></td>
		<td width="3%" align="center" class="branco">&nbsp;</td>				
		<td width="3%" align="center" class="branco"><B>&nbsp;</B></td>
	</tr> 
</table>

<?php 
	$chavet = true;
	$queryE = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano, gmsolicitante,gmsolicitado, formareposicao, motivostatus, status FROM trocaservico where gmsolicitante='$login' order by id desc";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$status = $linhaE['status'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
?>

<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
		<td width="4%" align="center" class="negrito"><? echo $linhaE['id']; ?></td>
		<td width="10%" align="left" class="negrito"><? echo $linhaE['gmsolicitado']; ?></td>
		<td width="15%" align="left" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
		<td width="18%" align="left" class="negrito"><? echo $linhaE['formareposicao']; ?></td>
		<td width="47%" align="left" class="negrito"><? echo $linhaE['motivostatus']; ?></td>		
		<td width="3%" class="letra" align="center">
		<?
		 if($status == 1){
		 ?>
		 	<IMG SRC="images/true.gif" ALT="Autorizado o Pedido" width="14" height="13"BORDER="0">
		<? }else{
		 if($status == 2){
		?> 
			<IMG SRC="images/false.gif" ALT="Negado o Pedido" width="16" height="16"BORDER="0">
		<? }else{
		 ?>
		 	<IMG SRC="images/outros.gif" ALT="Clic na imagem para fazer parte da escala" width="16" height="16"BORDER="0">
		<? 
			}}
		?>
		</td>
		<td width="3%" align="center" class="quote">
		<?
		 if($status != 1 && $status != 2){
		 ?>
		 	<a onClick="Excluir('../classes/controleTrocaServico.php?id=<? echo $linhaE['id']; ?>')" href="#">	   
	  		 <IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Excluir"></A>
		<? }?>
		</td>
	</tr>


</table>

<?php
	}
?>

</fieldset>


<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" class="letra"><img src="images/true.gif" width="14" height="13" /> Pedido Aprovado </td>
    <td width="19%" class="letra"><img src="images/false.gif" width="16" height="16" /> Pedido Negado </td>
    <td width="21%" class="letra"><img src="images/outros.gif" width="16" height="16" /> Pedido em Avalia&ccedil;&atilde;o </td>
    <td width="40%" class="letra"><img src="images/lixeira.jpg" width="16" height="20" /> Excluir Solicita&ccedil;&atilde;o </td>
  </tr>
</table>

<fieldset>
	<legend class="negrito">Solicitacao Troca de Servico</legend>
<form name="form1" method="post" action="../classes/controleTrocaServico.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td width="14%" align="right">GM:</td>
        <td width="15%"><input name="gmsolicitante" type="text" id="gmsolicitante" value="<?php echo $login; ?>" readonly="readonly" /></td>
        <td width="6%" align="right">Matricula:</td>
        <td width="65%"><input name="matricula" type="text" value="<?php echo $matricula; ?>" readonly="readonly"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%" align="right">Troca com o GM <font class="bignum">*</font>:</td>
        <td width="14%">
		<select name="ygmsolicitado">
			  <option value="0">Selecionar...</option>
			  <?php 
				$query = "SELECT * FROM guarda_gmf order by login";
				$resultado = $obj->executaQuery($query);
				while($linha = mysql_fetch_array($resultado))
				{
					$login = $linha['login'];
			  ?>
						 <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
			  <?php 
				} 
	  		  ?>
		  </select>
		</td>
        <td width="9%" height="24" align="right" class="letra">Data da troca<font class="bignum">*</font>:</td>
  		 <td width="63%" align="left">
			<input name="xdatatroca" type="text" class="stylo1" id="xdatatroca" value="<? echo $datatroca;?>" size="12" readonly/>  			
			<a onClick="displayCalendar(document.forms[0].xdatatroca,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>   
   		</td>
      </tr>
    </table></td>
  </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top">Forma de reposi&ccedil;&atilde;o<font class="bignum">*</font>: </td>
              <td width="86%" align="left"><input name="xformareposicao" type="text" class="stylo1" id="xformareposicao" value="<? echo $xformareposicao;?>" size="12"/>  			
			<a onClick="displayCalendar(document.forms[0].xformareposicao,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a></td>

          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" height="24" align="right">Atividade ou Turno:<font class="bignum">*</font>:</td>
              <td width="86%">
                <select name="yturno" id="yturno">
                  <option value="0">Selecionar...</option>
                  <option value="Administrativo">Administrativo</option>,
				  <option value="Central">Central</option>
				  <option value="Comando">Comando</option>
				  <option value="Digitacao">Digitacao</option>
				  <option value="Educacao">Educacao</option>
				  <option value="Logisitca">Logistica</option>
				  <option value="Matutino">Operacional Matutino</option>
                  <option value="Vespertino">Operacional Vespertino</option>
				  <option value="Noturno">Operacional Vespertino</option>
                  <option value="12x36">Operacional 12x36</option>
				  <option value="Passarela">Passarela</option>
                  <option value="Ronda Escolar">Ronda Escolar</option>
				  <option value="Sentinela">Sentinela</option>
				  <option value="Zona Azul">Zona Azul</option>
                </select>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top">Motivo(s) para a troca: </td>
              <td width="86%"><textarea name="motivo" cols="80" rows="8"></textarea>
			  </td>
            </tr>
          </table></td>
        </tr>
        <tr>
		<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="86%">
		<input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
</table>
</form>
</fieldset>

</td>
</tr>
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>

