<?php

include_once("gdb.php"); 

$gdb = new gdb();  
$gdb2 = new gdb(); 

$nome               = $gdb->vargetpost('nome');
$senha              = $gdb->vargetpost('senha');
$login              = $gdb->vargetpost('login');

$gdb2->open("SELECT login FROM usuario WHERE UPPER(login) = UPPER('$email') AND codigoProjeto = 'MNC'");

if ($gdb2->linhas != 0) {
  echo json_encode(array('error' => "Este email já esta sendo usado!"));
} else {
    $senha = md5($senha);
    $data = date('Y-m-d');

    if($gdb->open("INSERT INTO usuario (codigoUsuario, login, nome, insercao, senha, codigoProjeto, status, perfil) VALUES (default, '$login', '$nome', '$data', '$senha', 'MNC', 1, 'P')")){
      echo json_encode(array('success' => 1));
    }else {
      echo json_encode(array('error' => 0));
    }  
}