<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
		  
  $gdb = new gdb();
  $codigoUsuario  = $gdb->vargetpost('codigoUsuario'); 
  $dateTroca  	  = $gdb->vargetpost('dateTroca'); 
  
  $gdb->open("select codigoPessoa from usuario u, pessoa p where u.login = p.email and codigoUsuario = '$codigoUsuario' "); 	 
  $codigoPessoa = $gdb->gs['CODIGOPESSOA'][0];
 
  $gdb->open("select count(*) as trocas 
                from usuario u, pessoa p, trocaCaixaMNC t
			   where  u.codigoUsuario=$codigoUsuario			   
			     and  u.login = p.email
				 and  p.codigoPessoa = t.codigoPessoa ");
  
	  
 if( $gdb->gs['TROCAS'][0] == 0 ){
     $gdb->open("INSERT INTO trocaCaixaMNC(codigoPessoa,dataTroca,qtdeTroca) values($codigoPessoa,'$dateTroca',16.00 )");   
	 echo '1';	
}else{	  
     $trocas = $gdb->gs['TROCAS'][0];
	 $gdb->open(" select abs( DATEDIFF(max(t.dataTroca),'$dateTroca' ))  as dias,
	           CASE WHEN max(t.dataTroca)>'$dateTroca' THEN 0 ELSE 1 END as OK
	                from usuario u, 
						 pessoa p, 
						 trocaCaixaMNC t
				   where u.codigoUsuario=$codigoUsuario			   
					 and u.login = p.email
					 and p.codigoPessoa = t.codigoPessoa ");
					 
	 $dias = $gdb->gs['DIAS'][0];	 
	 $ok   = $gdb->gs['OK'][0];	 
	 
	 if( $ok ){
		 if( $dias<16 ){
			 echo '2'; 
		 }else{
			 $qtdePeso = 15.9;
			 // if( $trocas>2 ){
			 //	$qtdePeso = $dias*1.60;		 
			 // } 	 
			 $gdb->open("INSERT INTO trocaCaixaMNC(codigoPessoa,dataTroca,qtdeTroca) values($codigoPessoa,'$dateTroca',$qtdePeso )");   
			 echo '1';				 
	 	 }
	 }else{
		 echo '3';
	 }
}
	  
?>