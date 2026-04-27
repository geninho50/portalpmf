<?php



include_once("gdb.php");
$gdb = new gdb();


$sql = "INSERT INTO suporteStm.registraDataHoraFiscal (ID_MODULO,ID_USUARIO,DATA_HORA,PRAZO,SITUACAO)  VALUES (".$_POST["id_modulo"].", ".$_POST["idUsuario"].",NOW(), NOW() + INTERVAL 7 DAY , 1)"; // situacao 1 - modulo iniciado


echo $sql;
//$gdb->query($sql);

$gdb->open($sql);


?>

