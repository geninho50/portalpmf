 <html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
<link rel="stylesheet" type="text/css" href="estilos.css">
<title> Ponto Periodo</title>
<head>
<script LANGUAGE="JavaScript">

function toUnicode(elmnt,content)
{
    if (content.length==elmnt.maxLength)
	{
		next=elmnt.tabIndex
		if (next<document.forms[0].elements.length)
		{
			document.forms[0].elements[next].focus()
		}
	}
}
function validDate(fld) 
{
    var testMo, testDay, testYr, inpMo, inpDay, inpYr, msg, dtamd, ano, mes, dia
    var inp = fld.value
    status = ""
    // attempt to create date object from input data
    // extract components of input data
    inpDay = parseInt(inp.substring(0, inp.indexOf("/")), 10)
	if(inp.indexOf("/")==inp.lastIndexOf("/")) 
	{
		inpMo = parseInt(inp.substring((inp.lastIndexOf("/") + 1), inp.length), 10);
		var d=new Date();
		inpYr = d.getFullYear();
	}
	else
	{
		inpMo = parseInt(inp.substring((inp.indexOf("/")+1),inp.lastIndexOf("/")), 10);
		inpYr = parseInt(inp.substring((inp.lastIndexOf("/") + 1), inp.length), 10);
	}
//    var testDate = new Date(inp)	
    var testDate = new Date(inpYr,inpMo-1,inpDay)
    // extract pieces from date object
    testMo = testDate.getMonth()+1
	if (testMo < 10) 
	{
		mes="0"+testMo
	} 
	
	else 
	{
		mes=testMo
	}
    testDay = testDate.getDate()
	if (testDay < 10) 
	{
		dia="0"+testDay
	} 
	else 
	{
		dia=testDay
	}
    testYr = testDate.getYear()
	if (testYr < 100) 
	{
		ano=2000+testYr
	} 
	else
	{
		ano=testYr
	}
	dtamd=dia + '/' + mes + '/' + ano
    // make sure parseInt() succeeded on input components
    if (isNaN(inpMo) || isNaN(inpDay) || isNaN(inpYr))
	{
        msg = "Data inválida"
    }
    // make sure conversion to date object succeeded
    if (isNaN(testMo) || isNaN(testDay) || isNaN(testYr)) 
	{
        msg = "Data inválida"
    }
    // make sure values match
    if (testMo != inpMo || testDay != inpDay || testYr != inpYr) 
	{
        msg = "Data inválida"
    }
    if (msg) 
	{
        // there's a message, so something failed
        alert(msg)
        // work around IE timing problem with alert by
        // invoking a focus/select function through setTimeout();
        // must pass along reference of fld (as string)
        setTimeout("doSelection(document.forms['" + 
        fld.form.name + "'].elements['" + fld.name + "'])", 0)
        return false
    } 
	else 
	{
        // everything's OK; if browser supports new date method,
        // show just date string in status bar
		//document.forms['" + fld.form.name + "'].elements['" + fld.name + ".value'] = dtamd
		fld.value = dtamd
        status = (testDate.toLocaleDateString) ? testDate.toLocaleDateString() : 
            "Date OK"
        return true
    }
}

// separate function to accommodate IE timing problem
function doSelection(fld) 
{
    fld.focus()
    fld.select()
}

</script>
</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="80">
<tr>
<td width="10%" bgcolor="#9ACD32" height="20">
<p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
</td>
</tr>
<tr align="center">
<td width="60%" height="40">
<p align="center"> <h2><br>Controle de Ponto</p></h2>
<table border="0"> <form method="POST" action="pontoformgerencia.php">
<tr><td align="left">
</td>

<?php
	
	if(!empty($_GET["campo"]))
	{ 
		if ($_GET["campo"] == 'nf')
		{
			echo "<td align='left'><font face='verdana' color='#FF0000' size='2' > Escolha um nome ou digite um dia</font></td></tr>";
		}
	}
	require("conecta.php");
	require("valida_qq_sessao.php");
	echo "<tr>";
	echo "<td align='right'><a class='smt'>Nome:</a></td>";
	session_start();
	$nomeus=$_SESSION['nomeusuario'];
	if ($_SESSION['admin']=="A")
	{
		echo "<td align='left'><SELECT name='nomeus' id='nomeus'' align='center'>";
		echo "<OPTION></OPTION>";
		$sql="SELECT nome, usuario_id FROM usuarios ORDER BY nome";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
		{
			$fiscalnome=pg_result($resultado,$i,"nome");
			$us_id=pg_result($resultado,$i,"usuario_id");
			echo "<OPTION value=".$us_id.">".utf8_encode($fiscalnome)."</OPTION>";
		}
		echo "</td>";
	}
	else
	{
		$sql="SELECT nome, usuario_id FROM usuarios WHERE nome = '$nomeus'";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
//		echo $nomeus;
//		echo $linhas;
//		exit;
		if ($linhas==1)
		{
			//$fiscalnome=pg_result($resultado,0,"nome");
			$nomeus=pg_result($resultado,0,"usuario_id");
		}
		echo "<td width='60%' height='80%'><a class='hr'>";
		echo utf8_encode($_SESSION['nomeusuario']);
		echo "<input type='hidden' name='nomeus' value=".$nomeus.">";
		echo "</a></td>";
	}
?>

</tr>
<tr align="center">
	<td align='right'><a class='smt'>Per&iacuteodo:</a></td>
	<td align="left"><a class="smt"><input type="text" name="dia1" size="8" tabindex="2" maxlength= "10" onkeyup= "toUnicode(this,this.value)" onChange="validDate(this)"></a>
	<a class="smt"> A </a>
	<a class="smt"><input type="text" name="dia2" size="8" tabindex="3" maxlength= "10" onkeyup= "toUnicode(this,this.value)" onChange="validDate(this)"></a>
	</td>	
</tr>
</table>


		
		<input type="hidden" name="operacao" value="listar">
		<p></p><p align="center"><input type="submit" value="LISTAR PONTO" name="enviar" face="verdana" ></p>
		</form>
		<p align="center"><a class='lp' href="fiscalnovo.php">Voltar</a></font></p>
		<p align="center"><a class='lp' href="logout.php">Sair</a></font></p>

</form>
</body>
</html>
