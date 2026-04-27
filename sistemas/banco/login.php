<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();
  
  $usuario  = $gdb->vargetpost('login');
  $senha    = $gdb->vargetpost('senha');
  $senha = md5( $senha );
  $gdb->select("",$usuario,"","",$senha);

  if( $usuario !='' && $senha !='' ){	 
	  if( $gdb->linhas >0 ){
		  // print "Codigo : ".$gdb->gs['CODIGOUSUARIO'][0];
		  iniciar_sessao('sisdgov_',$gdb->gs['CODIGOUSUARIO'][0] );
		  echo $gdb->gs['CODIGOUSUARIO'][0];
	  }else{
		  echo '0';
	  }
  }
?>