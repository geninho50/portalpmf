<?php

if(isset($_GET['curso'])){
	if(isset($_GET['ano'])){
		if(isset($_GET['escola'])){
			include '../fnc/buscaFases.php';
			$fases = buscaFasesCAE($_GET['curso'], $_GET['ano'], $_GET['escola']);
			if($fases != false){
				foreach ($fases as $key => $value) {
					echo '<option value="'.$value[0].'">'.($value[1]).'</option>';
				}
			}
		}
	}
}

?>