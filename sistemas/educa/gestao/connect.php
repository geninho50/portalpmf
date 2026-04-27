<?php

$link = mysql_connect('192.168.1.20', 'educacao', '@e57731!');
if (!$link) {
   die('Não conseguiu conectar: ' . mysql_error());
}

// seleciona o banco criativaidea05
$db_selected = mysql_select_db('matricula', $link);
if (!$db_selected) {
   die ('Não pode selecionar o banco de dados : ' . mysql_error());
}