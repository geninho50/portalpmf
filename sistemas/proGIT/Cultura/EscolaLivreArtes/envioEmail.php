<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();  
  
  $gdb->open("SELECT a.codigoPessoaAux as codigo,  p.email, nome 
                FROM pessoa p,
       				 pessoaAuxiliar a 
			   WHERE a.codigoPessoa = p.codigoPessoa 
			     AND a.codigoProjeto = 'CMESPORTE'
                 AND p.codigoPessoa<1616 ");
				 
  $total =0;				 
  
  print "Aguarde ....<br>";
  
  if( $gdb->linhas>0 ){
	  foreach( $gdb->gs['EMAIL'] as $key=>$value  ){
		  
		$registro	  = $gdb->gs['CODIGO'][$key];
		$Destinatario = "$value";
		$email		  = "noreply@pmf.sc.gov.br";
		$titulo		  = "Fundação Municipal de Esportes";
		$mensagem1    ="\n Caro(a) Senhor(a) ".$gdb->gs['NOME'][$key]."
		
		\n \n Clique no link abaixo e imprima o seu comprovante de inscrição da 1ª Conferência Municipal de Esporte.\n 			
		  \n \n http://www.pmf.sc.gov.br/sistemas/banco/sucessoCMEsposte.php?codigo=$registro
		  
		  \n \n OBs.: Desconsidere os emails anteriores, este é o correto.   	  
		  
		 \n Diretoria de Governo Eletrônico\n Casa Civil \n Prefeitura Municipal de Florianópolis";
		  
		  mail("$Destinatario","$titulo", "$mensagem1","From:$email");
		  
		  $total += 1;

	  }
	  
	  Print "Total de Emails ".$total;
	  
  }
?>