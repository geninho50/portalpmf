<?php
if( $_GET['pagina'] == "mailhistpagina" || $_GET['pagina'] == "mailenvionot" || 
	$_GET['pagina'] == "mailenviodest" || $_GET['pagina'] == "mailenvioliberar" 
	){
	echo"
	<link rel=\"stylesheet\" href=\"../scripts/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../scripts/checkboxtree/jquery.checkboxtree.css\">	
	<script type=\"text/javascript\" src=\"../scripts/thickbox/jquery-1.4.2.js\"></script>
	<script type=\"text/javascript\" src=\"../scripts/thickbox/thickbox.js\"></script>
	<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js\"></script>
	<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js\"></script>
	<script type=\"text/javascript\" src=\"../scripts/checkboxtree/jquery.checkboxtree.js\"></script>";
}
?>