<?php
	include("incValidaSessao.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<frameset rows="90,*" cols="*" framespacing="0" frameborder="no" border="0" bordercolor="#FFFFFF">
  <frame src="topo.html" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="242,*" framespacing="0" frameborder="no" border="0" bordercolor="#FFFFFF">
    <frame src="menu.php" name="leftFrame" scrolling="yes" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="recado_principal.php" name="principal" scrolling="yes" id="principal" title="principal" />
  </frameset>
</frameset>

<noframes>
	<body>
	</body>
</noframes>

</html>

