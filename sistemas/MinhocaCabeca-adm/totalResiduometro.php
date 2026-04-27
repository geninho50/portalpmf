<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../banco/gdb.php"); 

  $gdb = new gdb();
  
 
  $gdb->open(" SELECT sum( qtdeTroca ) as totalTroca 
		       FROM trocaCaixaMNC t  ");
 
  $totalTroca = $gdb->gs['TOTALTROCA'][0];

  echo $totalTroca;

?>