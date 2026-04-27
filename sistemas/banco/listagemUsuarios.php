<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();  
  
  $campo   = $gdb->vargetpost('campo'); 
  
  $orderBy = " ORDER BY Nome ";
  
  if( $campo !='' ){
	$orderBy = " ORDER BY $campo ";  
  }

  // $gdb->open("SELECT codigoUsuario as codigo, Status as situacao, Nome, Login, DataInsert, codigoProjeto FROM usuario ");  
  $gdb->open("SELECT codigoUsuario as codigo, 
                    CASE WHEN Status = '0' THEN 'Desativado' ELSE 'Ativo' END as Status, 
					nome, 
					login, 
					codigoProjeto  
			   FROM usuario $orderBy ");

  $gdb->titulo_campo  ='Codigo, Status, Nome, Usuário, Projeto'; 
  $gdb->visivel_campo ='v,v,v,v,v'; 
  $gdb->alinha_campo  ='e,e,e,e,e'; 
  $gdb->formato_campo =',,,,'; 
  $gdb->chave_campo   ='0';
			
  $gdb->print_tabela("Listagem de Usuários",1,1,'');
  
?>