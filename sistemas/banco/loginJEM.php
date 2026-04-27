<?php

  error_reporting( E_ALL );
  ini_set('display_errors', '0');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		
  $gdb    = new usuarios();
  $gdb1   = new usuarios();
  $sessao = new sessao();
  
  $alterarSenha  = $gdb->vargetpost('alterarSenha');   
  $email         = $gdb->vargetpost('login');
  $senha         = md5($gdb->vargetpost('senha') );
  //$senha         = $gdb->vargetpost('senha');
 
  
  $gdb->open("SELECT login FROM usuario WHERE UPPER(login) = UPPER('$email')");
  $gdb1->open("SELECT login, codigoUsuario FROM usuario WHERE UPPER(login) = UPPER('$email') AND senha = '$senha'");

   if ( $gdb->linhas == 0 ) {
       echo json_encode(array('error' => "Usuário incorreto ou não cadastrado!"));
   } elseif( $gdb1->linhas == 0 ){
           echo json_encode(array('error' => "Senha incorreta!"));
   }else{
	  $sessao->iniciar_sessao('JEM',$gdb1->gs['CODIGOUSUARIO'][0] );
	  echo json_encode(array('success' => 1, 'codigoUsuario' => $gdb1->gs['CODIGOUSUARIO'][0]));
   }
?>