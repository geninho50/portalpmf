<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	ini_set('default_charset','UTF-8');
	
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
	<!--inicio adm-->
	
<fieldset>
	<legend class="cabecalho">RESULTADO DA SOLICITAÇÃO</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="4%" align="center" class="branco"><strong>N</strong></td>	
		<td width="10%" align="left" class="branco"><B>Troca com...</B></td>
		<td width="15%" align="left" class="branco"><B>Para o dia...</B></td>
		<td width="18%" align="left" class="branco"><B>Forma de Reposição</B></td>
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
		 	<IMG SRC="imagens/true.png" ALT="Autorizado o Pedido" width="19" height="19"BORDER="0">
		<? }else{
		 if($status == 2){
		?> 
			<IMG SRC="imagens/negado.png" ALT="Negado o Pedido" width="19" height="19"BORDER="0">
		<? }else{
		 ?>
		 	<IMG SRC="imagens/editor_texto.png" ALT="Clic na imagem para fazer parte da escala" width="19" height="19"BORDER="0">
		<? 
			}}
		?>
		</td>
		<td width="3%" align="center" class="quote">
		<?
		 if($status != 1 && $status != 2){
		 ?>
		 	<a onClick="Excluir('../classes/controleTrocaServico.php?id=<? echo $linhaE['id']; ?>')" href="#">	   
	  		 <IMG SRC="imagens/excluir.png" WIDTH="19" HEIGHT="19" BORDER="0" ALT="Excluir"></A>
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
    <td width="20%" class="letra"><img src="imagens/true.png" width="19" height="19" /> Pedido Aprovado </td>
    <td width="19%" class="letra"><img src="imagens/negado.png" width="19" height="19" /> Pedido Negado </td>
    <td width="21%" class="letra"><img src="imagens/editor_texto.png" width="19" height="19" /> Pedido em Avalia&ccedil;&atilde;o </td>
    <td width="40%" class="letra"><img src="imagens/excluir.png" width="19" height="19" /> Excluir Solicita&ccedil;&atilde;o </td>
  </tr>
</table>

<fieldset>
	<legend class="cabecalho">SOLICITAÇÃO TROCA DE SERVIÇO</legend>
<form name="form1" method="post" action="../classes/controleTrocaServico.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">GM:</td>
    <td width="15%" align="left"><input name="gmsolicitante" class="negrito" type="text" id="gmsolicitante" value="<?php echo $login; ?>" readonly="readonly" /></td>
    <td width="7%" align="right" class="letra">Matricula:</td>
    <td width="64%" align="left"><input name="matricula" class="negrito" type="text" value="<?php echo $matricula; ?>" readonly="readonly"/></td>
  </tr>
        <tr>
          <td colspan="4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" class="letra">Troca com o GM:</td>
              <td width="15%" align="left">
              <input type="text" class="codigo" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
        </td>
              <td width="7%" align="right" class="letra">Data da troca:</td>
              <td width="64%" align="left"><input name="xdatatroca" type="text" class="negrito" id="xdatatroca" value="<? echo $datatroca;?>" size="12" readonly onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
                <a onClick="displayCalendar(document.forms[0].xdatatroca,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a></td>

            </table></td>
        </tr>
        <tr>
          <td align="right" class="letra">Forma de reposição:</td>
          <td colspan="3" align="left"><input name="xformareposicao" type="text" onkeyup="converteUpper(this);" class="negrito" id="xformareposicao" value="<? echo $xformareposicao;?>" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
            <a onClick="displayCalendar(document.forms[0].xformareposicao,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a></td>
        </tr>
        <tr>
          <td align="right" class="letra">Atividade ou Turno:</td>
          <td colspan="3" align="left"><select name="yturno" id="yturno" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
            <option value="0">Selecionar...</option>
            <option value="Diretoria">DIRETORIA</option>
            <option value="Central">CENTRAL</option>
            <option value="Administrativo">ADMINISTRATIVO</option>
            <option value="Educacao">EDUCAÇÃO</option>
            <option value="Logisitca">LOGÍSTICA</option>
            <option value="Sentinela">SENTINELA</option>
            <option value="Digitacao">DIGITAÇÃO</option>
            <option value="Matutino">OPERACIONAL MATUTINO</option>
            <option value="Vespertino">OPERACIONAL VESPERTINO</option>
            <option value="Alfa">ALFA</option>
            <option value="Bravo">BRAVO</option>
            <option value="Zona Azul">ZONA AZUL</option>
            <option value="Obras">OBRAS</option>
            <option value="Ronda Escolar">RONDA ESCOLAR</option>
            <option value="Canil">CANÍL</option>
          </select></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="letra">Motivo(s) para a troca:</td>
          <td colspan="3"><textarea name="motivo" cols="80" rows="8" class="negrito" onkeyup="converteUpper(this);"></textarea></td>
        </tr>
        <tr>
		<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
          <td align="right">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
    <tr>	
    	<td width="14%">&nbsp;		</td>
        <td colspan="3">
		<input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>

