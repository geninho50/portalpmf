<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DEMO of "how to feed jQuery UI’s autocomplete with a database-generated dataset" | burnmind.com</title>
	<meta name="description" content="DEMO of 'how to feed jQuery UI’s autocomplete with a database-generated dataset' | burnmind.com" />
	<meta name="keywords" content="demo, burnmind, how to, jquery, ui, autocomplete, database, dataset" />
  
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
	<style type="text/css">
		body 
		{
			background-color: #000;
			color: #fff;
		};
	</style>
	
	<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#auto').autocomplete(
			{
				source: "search.php",
				minLength: 3
			});
		});
	</script>

</head>

<body>
	<p>Type the name of a band: <input type="text" id="auto" /></p>
</body>
</html>