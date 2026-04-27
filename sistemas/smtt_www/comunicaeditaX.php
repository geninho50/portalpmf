<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edite Comunicação</title>
<script LANGUAGE="JavaScript">
function validDate(fld) {
    var testMo, testDay, testYr, inpMo, inpDay, inpYr, msg, dtamd, ano, mes, dia
    var inp = fld.value
    status = ""
    // attempt to create date object from input data
    // extract components of input data
    inpDay = parseInt(inp.substring(0, inp.indexOf("/")), 10);
	if(inp.indexOf("/")==inp.lastIndexOf("/")) 
	{
		inpMo = parseInt(inp.substring((inp.lastIndexOf("/") + 1), inp.length), 10);
		var d=new Date();
		inpYr = d.getFullYear();
	}
	else
	{
		inpMo = parseInt(inp.substring((inp.indexOf("/") + 1),inp.lastIndexOf("/")), 10);
		inpYr = parseInt(inp.substring((inp.lastIndexOf("/") + 1), inp.length), 10);
	}
//    var testDate = new Date(inp)	
    var testDate = new Date(inpYr,inpMo-1,inpDay)
    // extract pieces from date object
    testMo = testDate.getMonth()+1
	if (testMo < 10) {
		mes="0"+testMo
	} else {
		mes=testMo
	}
    testDay = testDate.getDate()
	if (testDay < 10) {
		dia="0"+testDay
	} else {
		dia=testDay
	}
    testYr = testDate.getYear()
	if (testYr < 100) {
		ano=2000+testYr
	} else {
		ano=testYr
	}
	dtamd=dia + '/' + mes + '/' + ano
    // make sure parseInt() succeeded on input components
    if (isNaN(inpMo) || isNaN(inpDay) || isNaN(inpYr)) {
        msg = "Data inválida"
    }
    // make sure conversion to date object succeeded
    if (isNaN(testMo) || isNaN(testDay) || isNaN(testYr)) {
        msg = "Data inválida"
    }
    // make sure values match
    if (testMo != inpMo || testDay != inpDay || testYr != inpYr) {
        msg = "Data inválida"
    }
    if (msg) {
        // there's a message, so something failed
        alert(msg)
        // work around IE timing problem with alert by
        // invoking a focus/select function through setTimeout();
        // must pass along reference of fld (as string)
        setTimeout("doSelection(document.forms['" + 
        fld.form.name + "'].elements['" + fld.name + "'])", 0)
        return false
    } else {
        // everything's OK; if browser supports new date method,
        // show just date string in status bar
		//document.forms['" + fld.form.name + "'].elements['" + fld.name + ".value'] = dtamd
		fld.value = dtamd
        status = (testDate.toLocaleDateString) ? testDate.toLocaleDateString() : 
            "Date OK"
        return true
    }
}
</script>
<script>
function validHour(fld) {
    var testHr, testSg, inpHr, inpSg, msg, hor, seg
    var inp = fld.value
    status = ""
    // attempt to create date object from input data
    // extract components of input data
	if inp.length < 4 {
		//inpHr = parseInt(inp.substring(0, inp.indexOf(":")), 5)
		//inpSg = parseInt(inp.substring((inp.IndexOf(":") + 1), inp.length), 5)
		inpHr = parseInt(inp.substring(0, 1), 5);
		inpSg = parseInt(inp.substring(1, 1), 5);
		inpSg = inpSg + parseInt(inp.substring(3, 1), 5);
	} else {
		inpHr = parseInt(inp.substring(0, 2), 5);
		inpSg = parseInt(inp.substring(3, 2), 5);
	}
	fld.value=inpHr + ":" + inpSg;
}
</script>
<script>
function formatar(src, mask)
{
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i)
if (texto.substring(0,1) != saida)
  {
		src.value += texto.substring(0,1);
  }
}
</script>
</head>
<body>
<?php
	$id=$_GET["id"];
//	echo $id;
//	echo "Aqui";
//	exit;
	require("conecta.php");
	$sql = "SELECT * FROM comunica WHERE id=".$id;
	$resultado=pg_query($sql);
	if($resultado != FALSE)
	{
		$linhas=pg_num_rows($resultado);	
		if($linhas > 0)
		{
			$id=pg_result($resultado,0,"id");
			$numero=pg_result($resultado,0,"numero");
			$data=pg_result($resultado,0,"datacom");
			$hora=pg_result($resultado,0,"hora");
			$hora=substr($hora,0,8);
			$dia=substr($data,8,2);
			$mes=substr($data,5,2);
			$ano=substr($data,0,4);
			$dataformatada=$dia.'/'.$mes.'/'.$ano.' '.$hora;
			$servico=pg_result($resultado,0,"servico");
			$placa=pg_result($resultado,0,"placa");
			$numordem=pg_result($resultado,0,"numordem");
			$permissionario=pg_result($resultado,0,"permissionario");
			$permissionario=str_replace("`","'",$permissionario);
			$fiscal=pg_result($resultado,0,"fiscal");
			$comunicado=pg_result($resultado,0,"comunicado");
			$prazo=pg_result($resultado,0,"prazo");
			$terminal=pg_result($resultado,0,"terminal");
			$status=pg_result($resultado,0,"status");
		}
		else
		{
//			$usuario="";
//			$comunicado="";
//			$status="";
		}
	}
?>
<form id="form1" name="form1" method="post" action="comunicainsere.php">
<table align="center" border=4 bordercolor='#9ACD32'>
<tr><th colspan="6"><align="center">Edite a Comunica&ccedil&atildeo</th></tr>
<tr>
<td align="right"><label for="nome">No.:</label></a></td>
<?php
	echo "<td align='left'><input type='text' name='numero' value='$numero' size='6'></a></td>";
?>
<td align="right"><label for="nome">Data:</label></a></td>
<td align="left"><input type="text" name="data" <?php echo "value=".$dataformatada?> size="8" maxlength="10" onChange="validDate(this)"></a></td>
<td align="right"><label for="nome">Hora:</label></a></td>
<td align="left"><input id="hora" type="text" name="hora" <?php echo "value=".$hora?> size="4" maxlength= "5" OnKeyPress="formatar(this, '##:##')"></a></td>
</tr>
<tr>
<td align="right"><label for="nome">Placa:</label></a></td>
	<td align="left"><input type="text" name="placa" <?php echo "value='".$placa."'"?> align="left" size="6" maxlength= "7"></a></td>
    <td align="right"><label for="nome">Servi&ccedilo:</label></a></td>
	<td align='left'><SELECT name='servico'>
	<OPTION></OPTION>
	<?php
	if ($servico == 'ESCOLAR')
	{
		echo "<OPTION SELECTED>ESCOLAR</OPTION>";
	}
	else
	{
		echo "<OPTION>ESCOLAR</OPTION>";
	}
	if ($servico == 'EXECUTIVO')
	{
		echo "<OPTION SELECTED>EXECUTIVO</OPTION>";
	}
	else
	{
		echo "<OPTION>EXECUTIVO</OPTION>";
	}
	if ($servico == 'REGULAR')
	{
		echo "<OPTION SELECTED>REGULAR</OPTION>";
	}
	else
	{
		echo "<OPTION>REGULAR</OPTION>";
	}
	if ($servico == 'TAXI')
	{
		echo "<OPTION SELECTED>TAXI</OPTION>";
	}
	else
	{
		echo "<OPTION>TAXI</OPTION>";
	}
	if ($servico == 'TURISMO')
	{
		echo "<OPTION SELECTED>TURISMO</OPTION>";
	}
	else
	{
		echo "<OPTION>TURISMO</OPTION>";
	}
	?>
	</td>
    <td align="right"><label for="nome">No.Ordem:</label></a></td>
	<td align="left"><input type="text" name="numordem" <?php echo "value=".$numordem?> size="4" maxlength= "4"></a></td>
	</tr>
	<tr>
    <td align="right"><label for="nome">Permission&aacuterio:</label></td>
	<?php
		//require("conecta.php");
		echo "<th colspan='5'><SELECT name='permissionario' align='left'>";
		echo "<OPTION></OPTION>";
		$sql="SELECT permissionario FROM vencimentos GROUP BY permissionario ORDER BY permissionario";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
		{
			$permis=pg_result($resultado,$i,"permissionario");
			if ($permissionario == utf8_encode($permis))
			{
				echo "<OPTION SELECTED>".utf8_encode($permis)."</OPTION>";
			}	
			else
			{
				echo "<OPTION>".utf8_encode($permis)."</OPTION>";
			}	
		}
		echo "</th>";
	?>
	</tr>
	<tr>
    <td align="right"><label for="nome">Fiscal:</label></td>
	<?php
		//require("conecta.php");
		echo "<td align='left' colspan='5'><SELECT name='fiscal'>";
		echo "<OPTION></OPTION>";
		$sql="SELECT nome, usuario_id, funcao FROM usuarios WHERE (funcao='Fiscal') ORDER BY nome";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
		{
			$fiscalnome=pg_result($resultado,$i,"nome");
			$us_id=pg_result($resultado,$i,"usuario_id");
			if ($fiscal == utf8_encode($fiscalnome))
			{
				echo "<OPTION SELECTED>".utf8_encode($fiscalnome)."</OPTION>";
			}	
			else
			{
				echo "<OPTION>".utf8_encode($fiscalnome)."</OPTION>";
			}	
		}
		echo "</td>";
		echo "</tr><tr>";
		echo "<td align='right'>Comunica&ccedil&atildeo:</td>";
		echo "<th align='left' colspan='5'><label for='textarea'></label>";
		echo "<textarea name='textarea' id='textarea' cols='45' rows='7'>$comunicado</textarea>";
		echo "</th>";
//		session_start();
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
		{
			echo "<p align='center'>".$_SESSION['msg'];
			unset($_SESSION['msg']);
		}	
		echo "</tr><tr>";
		echo "<td align='right'><label for='nome'>Prazo:</label></a></td>";
		echo "<td align='left'><input type='text' name='prazo' value='$prazo' size='6'></a></td>";
		echo "<td align='right'><label for='nome'>Terminal:</label></td>";
		echo "<td align='left'><SELECT name='terminal'>";
		echo "<OPTION></OPTION>";
		if ($terminal == 'TICAN')
		{
			echo "<OPTION SELECTED>TICAN</OPTION>";
		}
		else
		{
			echo "<OPTION>TICAN</OPTION>";
		}
		if ($terminal == 'TICEN')
		{
			echo "<OPTION SELECTED>TICEN</OPTION>";
		}
		else
		{
			echo "<OPTION>TICEN</OPTION>";
		}
		if ($terminal == 'TILAG')
		{
			echo "<OPTION SELECTED>TILAG</OPTION>";
		}
		else
		{
			echo "<OPTION>TILAG</OPTION>";
		}
		if ($terminal == 'TIRIO')
		{
			echo "<OPTION SELECTED>TIRIO</OPTION>";
		}
		else
		{
			echo "<OPTION>TIRIO</OPTION>";
		}
		if ($terminal == 'TISAN')
		{
			echo "<OPTION SELECTED>TISAN</OPTION>";
		}
		else
		{
			echo "<OPTION>TISAN</OPTION>";
		}
		if ($terminal == 'TITRI')
		{
			echo "<OPTION SELECTED>TITRI</OPTION>";
		}
		else
		{
			echo "<OPTION>TITRI</OPTION>";
		}
		echo "</td>";
		echo "<td><label for='status'>Situa&ccedil&atildeo:</label></td>";
		echo "<td align='left'><SELECT name='status'>";
		if ($status == 'Aguardando')
		{
			echo "<OPTION SELECTED>Aguardando</OPTION>";
		}
		else
		{
			echo "<OPTION>Aguardando</OPTION>";
		}
		if ($status == 'Encerrada')
		{
			echo "<OPTION SELECTED>Encerrada</OPTION>";
		}
		else
		{
			echo "<OPTION>Encerrada</OPTION>";
		}
		echo "</td></tr>";
		echo "<td><input name='id' type='hidden' id='id' value='$id'></td>";
		echo "</td>";
		echo "</tr>";
		echo "<br/>";
		echo "</table>";
//	session_start();
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
		{
			echo "<p align='center'>".$_SESSION['msg'];
			unset($_SESSION['msg']);
		}	
?>
<table align="center" border=0 bordercolor='#9ACD32'>
<tr><td>
<input type="submit" name="button" id="button" value="Enviar" />
</td></tr>
<table align='center' border=0>
<tr><td align='center'><a class='sma' href='javascript:window.history.go(-1)'>Voltar</a></td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
<td align="center"><a class='sma' href="logout.php">Sair</a></td>
</tr>
</table>
</form>
</body>	
</html>
