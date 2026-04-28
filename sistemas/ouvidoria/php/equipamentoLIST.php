<?php

/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);
 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

include_once("gdb.php"); 

$gdb = new gdb();  

$token    = $gdb->vargetpost('token');

if ( $token != '3A1633217779975' ){
    die();
}


$gdb->open("select * from servicoEquipamento ");

$gdb->

$temEquipamento = 0;

if( $gdb->linhas > 0 ){
	$temEquipamento = 1;
}

if( !$temEquipamento  ){
	
		$gdb->open("INSERT INTO servicoEquipamento (    equTombamento,   
                                                        equTipo,         
                                                        equLocalOrigem,
                                                        equSituacao,     
                                                        equObs,                                                         
                                                        equMemoria,      
                                                        equCPU,          
                                                        equHD,           
                                                        equMAC,          
                                                        equSistema,      
                                                        equVersaoSistema,
                                                        equArquitetura,
                                                        equDescricao     )

                                                VALUES ('$equTombamento',   
                                                        '$equTipo',         
                                                        '$equLocalOrigem',  
                                                        '$equSituacao',     
                                                        '$equObs',                                                                     
                                                        '$equMemoria',      
                                                        '$equCPU',          
                                                        '$equHD',           
                                                        '$equMAC',          
                                                        '$equSistema',      
                                                        '$equVersaoSistema',
                                                        '$equArquitetura',
                                                        '$equDescricao'      ) ");
		
		$operacao = array( "success"=>"1","mensagem"=>"Cadastro de Equipamento realizado com SUCESSO!" );
}else{
           
    $gdb->open("UPDATE servicoEquipamento SET  equTombamento = '$equTombamento',
                                               equTipo          = '$equTipo',          
                                               equLocalOrigem   = '$equLocalOrigem',  
                                               equSituacao      = '$equSituacao',       
                                               equObs           = '$equObs',           
                                               equMemoria       = '$equMemoria',        
                                               equCPU           = '$equCPU',  
                                               equHD            = '$equHD',                                           
                                               equSistema       = '$equSistema',       
                                               equVersaoSistema = '$equVersaoSistema',  
                                               equArquitetura   = '$equArquitetura',
                                               equDescricao     = '$equDescricao'   
                                        WHERE  equMAC = '$equMAC' " );

    $operacao = array( "success"=>"1","mensagem"=>"Equipamento atualizado com SUCESSO!" );                                        
}

$retorno = json_encode( $operacao );

echo $retorno;							

?> 