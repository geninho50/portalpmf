<?php
$file = $_GET['file'];
$tipo = $_GET['tipo'];

header('Cache-Control: public'); // Para o i.e.
header("Content-Type: ".$tipo."");
header("Content-Length:".filesize($file));
header('Content-Disposition: attachment; filename="'.$file.'"');
header("Content-Transfer-Enconding: binary");
header('Expires: 0');
header('Pragma: no-cache');

$fp = fopen("$file","r");
fpassthru($fp);
fclose($fp);

?>