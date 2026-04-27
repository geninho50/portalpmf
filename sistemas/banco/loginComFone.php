<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();
  $sessao = new sessao();
  
  $usuario       = $gdb->vargetpost('login');
  $nascimento    = $gdb->vargetpost('nascimento');
	  
  $gdb->open("select u.CODIGOUSUARIO, 
					 p.nome as nome 
				from pessoa p, 
					 usuario u  
			   where upper( p.email ) = upper( u.login ) 
				 and ( upper(p.email) = upper('$usuario') or p.cpf = '$usuario' ) 
				 and p.nascimento = '$nascimento' ");	  
  
  if( $gdb->linhas>0 ){
	  $sessao->iniciar_sessao('MNC',$gdb->gs['CODIGOUSUARIO'][0] );
	  echo $gdb->gs['CODIGOUSUARIO'][0];
  }else{
	  echo '0';
  }	  
?>