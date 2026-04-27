<?php 
$conecta = mysql_connect("127.0.0.1", "root", ""); 
$data = mysql_select_db('db_orcamento') or die ("falha ao conectar no BD");
?> 