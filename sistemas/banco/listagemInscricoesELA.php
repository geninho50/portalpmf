<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();  
  
  $campo   = $gdb->vargetpost('campo');  
  $orderBy = " ORDER BY p.codigoPessoa ";
  
  if( $campo !='' ){
	$orderBy = " ORDER BY $campo ";  
  }
    
  $gdb->open("SELECT p.codigoPessoa as codigo,
                     habilidades,  
                     Nome,
					 date_format(Nascimento,'%d/%m/%Y')  as Nascimento, 
					 CPF,
					 Identidade, 
					 logradouro, 
					 Numero, 
					 Complemento, 
					 Bairro, 
					 Municipio, 
					 cep, 
					 email, 
					 Telefone, 
					 Celular  
	 		    FROM backend.pessoa p, 
				     backend.pessoaAuxiliar a  
			   WHERE p.codigopessoa = a.codigopessoa  
			     AND a.codigoProjeto = 'ELA'
			  $orderBy");

  $gdb->titulo_campo  ='Codigo,Habilidades,Nome,Data Nascimento, CPF,Identidade, Logradouro, Nr., Complemento, Bairro, Municipio, CEP, Email, Telefone, Celular'; 
  $gdb->visivel_campo ='v,v,v,v,v,i,i,i,i,v,i,i,i,v,v'; 
  $gdb->alinha_campo  ='e,e,e,c,c,e,e,e,e,e,e,e,e,e,e'; 
  $gdb->formato_campo =',,,,,,,,,,,,,,'; 
  $gdb->chave_campo   ='0';
			
  $gdb->print_tabela("Listagem de Inscricoes",1,1,'');
?>  

  
