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
  <tr align="center" bgcolor="#666666">
    <th scope="col">
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
	<legend class="negrito">Resultado da Solicitacao</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="8%" align="center" class="branco"><strong>Numero</strong></td>	
		<td width="14%" align="left" class="branco"><B>GM Solicitante</B></td>
		<td width="30%" align="left" class="branco"><B>Para o dia...</B></td>
		<td width="42%" align="left" class="branco"><B>Motivo Negado</B></td>
		<td width="3%" align="center" class="branco">&nbsp;</td>				
		<td width="3%" align="center" class="branco"><B>&nbsp;</B></td>				
	</tr> 
</table>

<?php 
	$chavet = true;
	$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano, gmsolicitante, motivostatus, status FROM doacaosangue where gmsolicitante='$login' order by id desc";
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
		<td width="8%" align="center" class="negrito"><? echo $linhaE['id']; ?></td>
		<td width="14%" align="left" class="negrito"><? echo $linhaE['gmsolicitante']; ?></td>
		<td width="30%" align="left" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
		<td width="42%" align="left" class="negrito"><? echo $linhaE['motivostatus']; ?></td>		
		<td width="3%" class="letra"align="center">
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
		 	<a onClick="Excluir('../classes/controleDoacaoSangue.php?id=<? echo $linhaE['id']; ?>')" href="#">	   
	  		 <IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="20" BORDER="0" ALT="Excluir"></A>
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
    <td width="40%" class="letra"><img src="images/lixeira.jpg" width="16" height="16" /> Excluir Solicita&ccedil;&atilde;o </td>
  </tr>
</table>



<fieldset>
	<legend class="negrito">Cadastro Pedido Do de Sangue</legend>
<form name="form1" method="post" action="../classes/controleDoacaoSangue.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

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
<td colspan="2">&nbsp;</td>
</tr>
  <tr>
    <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%" align="right">Atividade ou Turno:<font class="bignum">*</font>:</td>
        <td width="14%"><select name="yturno" id="yturno">
          <option value="0">Selecionar...</option>
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
        </select></td>
        <td width="10%" height="24" align="right" class="letra">Data da doa&ccedil;&atilde;o:</td>
  		 <td width="62%" align="left">
			<input name="xdatadoacao" type="text" class="stylo1" id="xdatadoacao" value="<? echo $datatroca;?>" size="12" readonly/>  			
			<a onClick="displayCalendar(document.forms[0].xdatadoacao,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>   
   		</td>
      </tr>
    </table></td>
  </tr>
		<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
    <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="86%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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

