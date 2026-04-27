<?php

if(isset($_GET['curso'])){
	include '../fnc/buscaFases.php';
	$fases = buscaFases($_GET['curso']);
	foreach ($fases as $key => $value) {
		echo '<option value="'.$value[0].'">'.($value[1]).'</option>';
	}
}

?>