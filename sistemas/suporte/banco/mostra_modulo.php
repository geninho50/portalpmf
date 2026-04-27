<?php



include_once("gdb.php");
$gdb = new gdb();


$gdb->open("SELECT * FROM suporteStm.aulas WHERE ID_MODULO = ".$_POST["modulo"]." ORDER BY ID");

$aulas= NULL;
for($i = 0; $i < count($gdb->gs['ID']); $i++){ 
	//$aulas.='<p style="color:white">'.$gdb->gs['DESCRICAO'][$i].'<\/p>';
	$aulas.=$gdb->gs['DESCRICAO'][$i]."<br>";
}
$aulas = substr($aulas, 0, -1);
 $aulas = ltrim($aulas, '"'); 
echo json_encode($aulas);

?>

