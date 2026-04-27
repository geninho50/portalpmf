<?php
//$conecta = mysql_connect('localhost','root','');
//echo "Conectando";
//$con_string = "host=localhost port=5432 dbname=stmt user=phpwikiuser password=phpwikiuser";
//$con_string = "host=192.168.1.24 port=5432 dbname=smtt user=smtt_mgr password=060668";
$con_string = "host=192.168.1.20 port=5432 dbname=smtmt user=smtt_mgr password=060668";
//$con_string = "host=200.192.64.1 port=5432 dbname=smtmt user=smtt_mgr password=060668";
$pg_con = pg_connect($con_string);
$stat = pg_connection_status($pg_con);
	if ($stat === 0) {
		echo '';	
	} else {
		echo 'Connection status bad';
	}
?>