<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php");          
		
  $gdb    = new gdb();
  $gdb1   = new gdb();
   
  $processo    = $gdb->vargetpost('processo');
  $cpf         = $gdb->vargetpost('cpf');
 
  
 $gdb1->open("SELECT processo, nome FROM login WHERE documento = '$cpf'");
 $nome = $gdb1->gs["NOME"][0];


 $gdb->open("SELECT processo, documento FROM login WHERE processo = '$processo' AND documento = '$cpf'");

	  if ($gdb->linhas == 0) {
	  	echo json_encode(array('error' => "Processo incorreto ou CPF não cadastrado!"));

	  }else{

	  	echo json_encode(array('success' => 1, 'nome' => $nome ));
	  }
	  
?>