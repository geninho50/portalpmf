<?php

//Credenciais de acesso ao BD


define('HOST', '192.168.173.178');
define('USER', 'michel');
define('PASS', 'mittmann');
define('DBNAME', 'SMPU');
$conn = new PDO('pgsql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

?>