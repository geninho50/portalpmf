<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();
  $sessao = new sessao();
  
  $usuario  = $gdb->vargetpost('login');
  $fone     = $gdb->vargetpost('fone');
	  
  $gdb->open("select u.codigoInscricao as codigo, 
					 p.nome as nome 
				from pessoa p, 
					 eventoInscricao u  
			   where u.codigoPessoa = p.codigoPessoa 
				 and ( upper(p.email) = upper('$usuario') or p.cpf = '$usuario' ) 
				 and ( p.telefone like '%$fone%' or p.celular like '%$fone%' )");	  
  
  if( $gdb->linhas>0 ){
	  $sessao->iniciar_sessao('MNC',$gdb->gs['CODIGO'][0] );
	  echo $gdb->gs['CODIGO'][0];
  }else{
	  echo '0';
  }	  
?>