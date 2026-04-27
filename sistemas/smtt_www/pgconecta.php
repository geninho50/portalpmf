<?php
$con_string = "host=192.168.1.24 port=5432 dbname=smtt user=smtt_mgr password=060668";
$conecta = pg_connect($con_string);
echo pg_connection_status($conecta);
?>