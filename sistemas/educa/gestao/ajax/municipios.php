<?php

if(isset($_GET['id_estado'])){

	include '../fnc/listaDeMunicipios.php';
	$municipios = listaDeMunicipios($_GET['id_estado']);

?>
<?php
    echo "<option></option>";
	foreach ($municipios as $key => $value) {
		echo "<option value='".$key."'>".($value[1])."</option>";
	}
}

?>