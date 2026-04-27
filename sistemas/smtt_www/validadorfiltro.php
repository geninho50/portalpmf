<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filtrar Viagens</title>
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
<?php
require("valida_qq_sessao.php");
session_start();
if(isset($_SESSION['data1']) && !empty($_SESSION['data1']))
{
	$data1=$_SESSION['data1'];
}
if(isset($_SESSION['data2']) && !empty($_SESSION['data2']))
{
	$data2=$_SESSION['data2'];
}
if(isset($_SESSION['hora1']) && !empty($_SESSION['hora1']))
{
	$hora1=$_SESSION['hora1'];
}
if(isset($_SESSION['hora2']) && !empty($_SESSION['hora2']))
{
	$hora2=$_SESSION['hora2'];
}
if(isset($_SESSION['linha']) && !empty($_SESSION['linha']))
{
	$linhafiltro=$_SESSION['linha'];
}
?>
<body>
<form id="form1" name="form1" method="post" action="validadorlista.php">
	<table align="center" border=4 bordercolor='#9ACD32'>
		<tr><th colspan="4"><align="center">Filtrar Viagens</th></tr>
		<tr>
		<?php
			echo "<td align='right'><label for='nome'>Do dia:</label></a></td>";
			echo "<td align='left'><input type='text' name='data1' value='$data1' size='8' maxlength='10' onChange='validDate(this)'></a></td>";
			echo "<td align='right'><label for='nome'>at&eacute:</label></a></td>";
			echo "<td align='left'><input type='text' name='data2' value='$data2' size='8' maxlength='10' onChange='validDate(this)'></a></td>";
		?>
			</tr><tr>
			<td align='right'><label for='nome'>Hor&aacuterio das:</label></a></td>
			<?php echo "<td align='left'><input type='text' id='hora1' name='hora1' value='$hora1' size='4' maxlength= '5'" ?> OnKeyPress="formatar(this, '##:##')"></a></td>
			<td align='right'><label for='nome'>at&eacute:</label></a></td>
			<?php echo "<td align='left'><input type='text' id='hora2' name='hora2' value='$hora2' size='4' maxlength= '5'" ?> OnKeyPress="formatar(this, '##:##')"></a></td>
		</tr>
	<tr>
    <td align="right"><label for="nome">Linha:</label></td>
	<?php
		require("conecta.php");
		$sql="SELECT linha, nome_linha FROM linhas ORDER BY linha";
		$resultado=pg_query($sql);
		$registros=pg_num_rows($resultado);
		echo "<td colspan='5'><SELECT name='linha' align='left'>";
		echo "<OPTION></OPTION>";
		for ($i=0;$i<$registros;$i++)
		{
 			$linha=pg_result($resultado,$i,"linha");
			$linhanome=pg_result($resultado,$i,"nome_linha");
			//$linha=$linha.' - '.pg_result($resultado,$i,"nome_linha");
			if($linhafiltro == $linha)
			{
				echo "<OPTION selected value=\"{$linha}\">".utf8_encode($linha).' - '.utf8_encode($linhanome)."</OPTION>";
			}
			else
			{
				echo "<OPTION value=\"{$linha}\">".utf8_encode($linha).' - '.utf8_encode($linhanome)."</OPTION>";
			}
		}
		echo "</td>";
	?>
	</tr>
	</table>
	<br/>
	<table align="center" border=0>
	<tr><td align="center">
	<input type="submit" name="button" id="button" value="Listar">
	</td></tr>
	</table>
</form>
<table align='center' border=0>
<tr>
<br/>
<td><align="center"><a class='sma' href="logout.php">Sair</a></td>
</tr>
</table>
</body>	
</html>
