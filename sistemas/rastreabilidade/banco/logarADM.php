<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php");          
		
  $gdb    = new gdb();

  $cpf     = $gdb->vargetpost('cpf');
  $senha   = $gdb->vargetpost('senha');
  
 $gdb->open("SELECT cpf, senha FROM adm WHERE cpf = '$cpf' AND senha = '$senha'");

	  if ($gdb->linhas == 0) {
	  	echo json_encode(array('error' => "CPF não cadastrado!"));

	  }else{

	  	echo json_encode(array('success' => 1));
	  }
	  
?>