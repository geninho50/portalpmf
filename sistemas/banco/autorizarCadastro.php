<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$cpf   = $gdb->vargetpost('cpf');
$email = $gdb->vargetpost('email');

$gdb->open("select p.codigoPessoa, 
                   e.codigoInscricao
              from pessoa p, 
			       eventoInscricao e 
			 where cpf = '$cpf' 
			   and upper(email) = upper('$email') 
			   and p.codigoPessoa = e.codigoPessoa
			   and upper(e.tipo) in ('E','M') ");

$link = '0';

if( $gdb->linhas>0 ){
	$registro  = base64_encode( $gdb->gs['CODIGOINSCRICAO'][0] );
	$gdb->open(" UPDATE eventoInscricao 
	                SET tipo = 'M' 
				  WHERE codigoInscricao = '$inscricao' ");
	$link	= "http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/admin/cadastroFilaEspera.php?codigo=$registro";
}

echo $link;