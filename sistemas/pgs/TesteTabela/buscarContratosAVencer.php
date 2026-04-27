<?php 
include_once ('../db/gdb_mysql.php');

$gdb = new gdb();

$days = isset($_POST['days']) ? intval($_POST['days']) : 30;
$currentDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime("+$days days"));

$query = "
    SELECT nomeUsual 
    FROM contratos 
    WHERE vigenciaFinal BETWEEN '$currentDate' AND '$endDate' 
    AND arquivado = 0";

$gdb->open($query);

$json = json_encode($gdb->gs);
echo $json; 
?>
