<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

  <table width="424" height="117" border="0" align="center">
	<tr>
	  <td width="414" height="113">
	   <?
			$mensagem = "";
			$mensagem = $_GET['Mensagem'];
	   ?>
		<span><font face="tahoma" color="FF0000"><CENTER><H3><?echo $mensagem?></H3></CENTER>
		</font></span></td>
	</tr>
  </table>
	  
</body>
</html>