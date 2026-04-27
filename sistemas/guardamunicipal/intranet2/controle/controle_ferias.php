<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

	$anoTemp = $_POST['yano'];
	
	if($anoTemp==''){
		$anoTemp = substr($data_atual,0,4);	
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
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
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td width="48%">
      <fieldset>
        <legend class="cabecalho">CADASTRAR ATIVIDADES</legend>
        <form name="form1" method="post" action="../classes/controleFerias.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
          
          <INPUT TYPE="hidden" name="cadastro" value="true">
          
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="13%" align="right" class="letra">GM:</td>
              <td width="19%" align="left"><input type="text" name="xguarda" id="xguarda" size="20" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
              <td width="6%" align="left">&nbsp;</td>
              <td width="62%" align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="letra">Tipo:</td>
              <td align="left"><select name="yatividade" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
                <option value="0">Selecionar...</option>
                <option value="1">FERIAS</option>
                <option value="2">ATESTADO</option>
                <option value="3">FOLGA</option>
                <option value="4">DOACAO</option>
                <option value="5">LICENCA GALA</option>
                <option value="6">LICENCA NOJO</option>
                <option value="7">LICENCA PATERNIDADE</option>
                <option value="8">LICENCA GESTACAO</option>
                <option value="9">LICENCA NAO REMUNERADA</option>
                <option value="10">LICENCA PREMIO</option>
                </select></td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="letra">Data Inicial:</td>
              <td align="left">
                <input type="text" value="<? echo $data_inicial;?>" readonly name="xdata_inicial" size="12" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
                <a onClick="displayCalendar(document.forms[0].xdata_inicial,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
              </td>
              <td align="right" class="letra">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><span class="letra">Data Final:</span></td>
              <td align="left"><input type="text" value="<? echo $data_final;?>" readonly name="xdata_final" size="12" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
              <a onClick="displayCalendar(document.forms[0].xdata_final,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a></td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            
            <tr>
              <td width="13%" align="right"><span class="letra"></span></td>
              <td width="19%" align="left"><input name="Submit" type="submit" class="letra" id="Submit" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
              <td width="6%" align="left">&nbsp;</td>
              <td width="62%" align="left">&nbsp;</td>
            </tr>
          </table>
        </form>
      </fieldset>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

<br>
<fieldset>
  <legend class="cabecalho">ESCALA DE PONTUAÇÃO</legend>
<table width="100%"  border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JANEIRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>FEVEREIRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>MAR&Ccedil;O</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>ABRIL</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>MAIO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JUNHO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JULHO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>AGOSTO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>SETEMBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>OUTUBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>NOVEMBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>DEZEMRO</b></td>
  </tr>
  <tr>
    <td align="center" class="negrito">12</td>
    <td align="center" class="negrito">11</td>
    <td align="center" class="negrito">10</td>
    <td align="center" class="negrito">04</td>
    <td align="center" class="negrito">03</td>
    <td align="center" class="negrito">06</td>
    <td align="center" class="negrito">07</td>
    <td align="center" class="negrito">01</td>
    <td align="center" class="negrito">02</td>
    <td align="center" class="negrito">05</td>
    <td align="center" class="negrito">08</td>
    <td align="center" class="negrito">09</td>
  </tr>
</table>
</fieldset>
<BR>
<table width="100%"  border="0" cellspacing="1" cellpadding="1">
  <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$idGrupo = $linhaG['id'];
  ?>
        <tr>
          <td class="negrito">
           <a href="javascript:POPUP('ferias_setor.php?idFerias=<? echo $idGrupo; ?>&setor=<? echo $nome;?>','800','350')" title="VIZUALIZAR FÉRIAS"><? echo $nome; ?></a>
          </td>
        </tr>
  <?
  }
  ?>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21%" class="negrito" align="right">Selecione o ano de sua escolha:</td>
    <td width="79%" align="left">
    <form name="form1" method="post" action="controle_ferias.php" onSubmit="return validaFormAll(this,'Buscar','Buscar')">
      <select class="negrito" name="yano" id="yano">
        <option value="0">Selecionar...</option>
        <option value="2020">2020</option>
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2017">2017</option>
        <option value="2016">2016</option>
        <option value="2015">2015</option>
        <option value="2014">2014</option>
        <option value="2013">2013</option>
        <option value="2012">2012</option>
        <option value="2011">2011</option>
      </select>
      <input type="submit" name="Submit" id= "Submit" class="letra" value="Buscar" onclick="onClickButton(null,'Aguarde...','','Buscar')">
    </form></td>
  </tr>
</table>
<br>
<fieldset>
	<legend class="cabecalho">GABARITO DE FÉRIAS/LICENÇA&nbsp;<? echo $anoTemp; ?> </legend>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
  	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JANEIRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>FEVEREIRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>MAR&Ccedil;O</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>ABRIL</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>MAIO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JUNHO</b></td>
  </tr>
</table>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$idFerias = $linhaG['id'];
  	
	 ?>
	 <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
	 <?
		 for ( $i = 1; $i <= 6; $i++ ) {
	?>
	  
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT id,login,atividade,DAY(data_inicial) as diaI,MONTH(data_inicial) as mesI,YEAR(data_inicial) as anoI,DAY(data_final) as diaF,MONTH(data_final) as mesF,YEAR(data_final) as anoF FROM feriastemp where MONTH(data_inicial)=$i and YEAR(data_inicial)=$anoTemp and grupo=$idFerias";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$atividade = $linhaJ['atividade'];
				$mesI = $linhaJ['mesI'];
				$anoI = $linhaJ['anoI'];
				$diaI = $linhaJ['diaI'];
				$mesF = $linhaJ['mesF'];
				$anoF = $linhaJ['anoF'];
				$diaF = $linhaJ['diaF'];
				//$diaF = $diaF-1;

				if($atividade==1){?>
					<a href="#" title="FERIAS<? echo ' => ('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')'?>" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo $loginM.'<br>';?></a>
				
				<? }if($atividade==10){?>
					<a href="#" title="LICENCA PREMIO<? echo ' => ('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')'?>" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#DAA250">'.$loginM.'</font><br>';?></a>
				<? }
			}
		?>
		</td>
	
		<? 
			}
		?>
  </tr>
		<?
		}
		?>
        
</table>	


<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JULHO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>AGOSTO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETEMBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>OUTUBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>NOVEMBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>DEZEMBRO</b></td>
  </tr>
</table>
  <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$idFerias = $linhaG['id'];
  	
	 ?>
	 <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
	 <?
		 for ( $i = 7; $i <= 12; $i++ ) {
	?>
	  
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT id,login,atividade,DAY(data_inicial) as diaI,MONTH(data_inicial) as mesI,YEAR(data_inicial) as anoI,DAY(data_final) as diaF,MONTH(data_final) as mesF,YEAR(data_final) as anoF FROM feriastemp where MONTH(data_inicial)=$i and YEAR(data_inicial)=$anoTemp and grupo=$idFerias";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$atividade = $linhaJ['atividade'];
				$mesI = $linhaJ['mesI'];
				$anoI = $linhaJ['anoI'];
				$diaI = $linhaJ['diaI'];
				$mesF = $linhaJ['mesF'];
				$anoF = $linhaJ['anoF'];
				$diaF = $linhaJ['diaF'];
				//$diaF = $diaF-1;
				
				if($atividade==1){?>
					<a href="#" title="FERIAS<? echo ' => ('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')'?>" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo $loginM.'<br>';?></a>
				
				<? }if($atividade==10){?>
					<a href="#" title="LICENCA PREMIO<? echo ' => ('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')'?>" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#DAA250">'.$loginM.'</font><br>';?></a>
				<? }
			}
		?>
		</td>
	
		<? 
			}
		?>
	</tr>
		<?
		}
		?>
        
</table>	

</fieldset>

</body>
</html>

