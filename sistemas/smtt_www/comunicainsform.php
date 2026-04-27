<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edita Comunicado</title>
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
?>
<body>
<form id="form1" name="form1" method="post" action="comunicainsere.php">
	<table align="center" border=4 bordercolor='#9ACD32'>
	<tr><th colspan="6"><align="center">Edite a Comunica&ccedil&atildeo</th></tr>
	<tr>
    <td align="right"><label for="nome">No.:</label></a></td>
	<td align="left"><input type="text" name="numero" size="6"></a></td>
    <td align="right"><label for="nome">Data:</label></a></td>
	<td align="left"><input type="text" name="data" size="8" maxlength= "10" onChange="validDate(this)"></a></td>
    <td align="right"><label for="nome">Hora:</label></a></td>
	<td align="left"><input id="hora" type="text" name="hora" size="4" maxlength= "5" OnKeyPress="formatar(this, '##:##')"></a></td>
	</tr>
	<tr>
    <td align="right"><label for="nome">Placa:</label></a></td>
	<?php
		require("conecta.php");
//		echo "<td><SELECT name='placa' align='left'>";
//		echo "<OPTION></OPTION>";
//		$sql="SELECT placa, noordem, nomeservico, permissionario FROM vencimentos ORDER BY placa";
//		$resultado=pg_query($sql);
//		$linhas=pg_num_rows($resultado);
//		for ($i=0;$i<$linhas;$i++)
//		{
//			$placa=pg_result($resultado,$i,"placa");
//			$noordem=pg_result($resultado,$i,"noordem");
//			$nomeservico=pg_result($resultado,$i,"nomeservico");
//			$permissionario=pg_result($resultado,$i,"permissionario");
//			echo "<OPTION>".$placa."</OPTION>";
//		}
//		echo "</td>";
	?>
	<td align="left"><input type="text" name="placa" align='left' size="6" maxlength= "7"></a></td>
    <td align="right"><label for="nome">Servi&ccedilo:</label></a></td>
	<td align='left'><SELECT name='servico'>
	<OPTION></OPTION>
	<OPTION>ESCOLAR</OPTION>
	<OPTION>EXECUTIVO</OPTION>
	<OPTION>REGULAR</OPTION>
	<OPTION>TAXI</OPTION>
	<OPTION>TURISMO</OPTION>
	</td>
    <td align="right"><label for="nome">No.Ordem:</label></a></td>
	<td align="left"><input type="text" name="numordem" size="5" maxlength= "5"></a></td>
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
			$permissionario=pg_result($resultado,$i,"permissionario");
			echo "<OPTION>".utf8_encode($permissionario)."</OPTION>";
		}
		echo "</th>";
	?>
	</tr>
	<tr>
    <td align="right"><label for="nome">Fiscal:</label></td>
	<?php
		//require("conecta.php");
		echo "<td colspan='5'><SELECT name='fiscal' align='left'>";
		echo "<OPTION></OPTION>";
		$sql="SELECT nome, usuario_id, funcao FROM usuarios WHERE (funcao='Fiscal') ORDER BY nome";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
		{
			$fiscalnome=pg_result($resultado,$i,"nome");
			$us_id=pg_result($resultado,$i,"usuario_id");
			echo "<OPTION>".utf8_encode($fiscalnome)."</OPTION>";
		}
		echo "</td>";
	?>
	</tr><tr>
    <td align="right">Comunica&ccedil&atildeo:</td>
    <th align="left" colspan='5'><label for="textarea"></label>
    <textarea name="textarea" id="textarea" cols="45" rows="6"></textarea>
    </th>
	<?php
//		session_start();
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
		{
			echo "<p align='center'>".$_SESSION['msg'];
			unset($_SESSION['msg']);
		}	
	?>
	</tr><tr>
    <td align="right"><label for="nome">Prazo:</label></a></td>
	<td align="left"><input type="text" name="prazo" size="6"></a></td>
    <td align="right"><label for="nome">Terminal:</label></td>
	<td align='left'><SELECT name='terminal'>
	<OPTION></OPTION>
	<OPTION>TICAN</OPTION>
	<OPTION>TICEN</OPTION>
	<OPTION>TILAG</OPTION>
	<OPTION>TIRIO</OPTION>
	<OPTION>TISAN</OPTION>
	<OPTION>TITRI</OPTION>	
	</td>
    <td align="right"><label for="status">Situa&ccedil&atildeo:</label></td>
	<td align='left'><SELECT name='status'>
	<OPTION>Aguardando</OPTION>
	<OPTION>Encerrada</OPTION>
	</td>
	</tr>
	<br/>
	</table>
	<table align="center" border=0 bordercolor='#9ACD32'>
	<tr><td>
	<input type="submit" name="button" id="button" value="Enviar" />
	</td></tr>
	</table>
</form>
<table align='center' border=0>
<tr><td align='center'><a class='sma' href='comunicalista.php?op=a'>Listar Comunica&ccedil&otildees</a></td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
<td align="center"><a class='lp' href="logout.php">Sair</a></td>
</tr>
</table>
</body>	
</html>
