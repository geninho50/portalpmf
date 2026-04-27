<?php

session_start();

include '../fnc/listaDeAnos.php';
$curso = $_GET['curso'];
$escola = $_GET['escola'];
$id_periodo = $_GET['id_periodo'];
$periodo_ano = $_GET['periodo_ano'];

$fases = listaDeAnos($curso, $escola, $id_periodo, $periodo_ano);
foreach ($fases as $key => $value) {
    echo '<option value="' . $value[0] . '">' . $value[1] . '';
}
?>
