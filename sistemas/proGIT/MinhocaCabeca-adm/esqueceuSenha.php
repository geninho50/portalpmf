<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../banco/gdb.php"); 
  include_once("../banco/usuario.func.php");   
  include_once("../banco/sessao.php");  

  $gdb = new usuarios();
  
  $usuario  = $gdb->vargetpost('login');
  $senha    = md5($gdb->vargetpost('senha') );
  
  $gdb->open("select * 
                from usuario 
			   where login = '$usuario' 
			     and codigoProjeto = 'MNC' ");
  
  if( $gdb->linhas>0 ){
	  
	  $nome          = $gdb->gs['NOME'][0];
	  $code			 = base64_encode( $gdb->gs['CODIGOUSUARIO'][0] );
	  $Destinatario  = "$usuario";
	  $email= "noreply@pmf.sc.gov.br";
	  $titulo="Projeto Minhoca na Cabeça";
	  $mensagem1="Clique no link abaixo e altere a sua senha do sistema :
	  
	  
	  http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/alterarSenha.php?code=$code
	  
	  
	  Equipe Minhoca na Cabeça";
	  
	  mail("$Destinatario","$titulo", "$mensagem1","From:$email");
	  
	  echo '1';
  }else{
	  echo '0';
  }  
?>