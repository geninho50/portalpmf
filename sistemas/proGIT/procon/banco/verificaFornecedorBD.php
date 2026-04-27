<?php

include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

$cpf = $gdb->vargetpost('cpf');


if( strlen( $cpf ) == 11 ) $campoDocumento = 'cpf';
else $campoDocumento = 'cnpj';

$gdb->open("select p.nome, 
                   $campoDocumento as cpf, 
				   celular, 
				   telefone,
				   cep,
				   logradouro,
				   numero,
				   complemento,
				   bairro,
				   municipio,
				   estado,
				   email,
				   'ok' as mensagem
			 from pessoa p , 
				  pessoaAuxiliar pa,
				  pessoaEndereco pe	
			where p.codigopessoa = pa.codigopessoa
              and p.codigopessoa = pe.codigopessoa 			
			  and $campoDocumento = '$cpf' 
			  and pa.codigoprojeto = 'PROCON' 
			  and pa.situacaoPROCON='F' ");

if( $gdb->linhas > 0 ){		
    $retorno = json_encode( $gdb->gs );
}else{
	$errors = array( "success"=>"1","mensagem"=>"" );
	 $retorno = json_encode( $errors );
}

print $retorno;

?>