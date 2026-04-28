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

print '<pre>';
print_r($_GET);
print '</pre>';

$equTombamento    = $gdb->vargetpost('equTombamento');
$equTipo          = $gdb->vargetpost('equTipo');
$equLocalOrigem   = $gdb->vargetpost('equLocalOrigem');
$equSituacao      = $gdb->vargetpost('equSituacao');
$equObs           = $gdb->vargetpost('equObs');
$equMemoria       = $gdb->vargetpost('equMemoria');
$equCPU           = $gdb->vargetpost('equCPU');
$equHD            = $gdb->vargetpost('equHD');
$equMAC           = $gdb->vargetpost('equMAC');
$equSistema       = $gdb->vargetpost('equSistema');
$equVersaoSistema = $gdb->vargetpost('equVersaoSistema');
$equArquitetura   = $gdb->vargetpost('equArquitetura');
$equDescricao     = $gdb->vargetpost('equDescricao');


$gdb->open("select * from servicoEquipamento where equMAC = '$equMAC' ");

$temEquipamento = 0;

if( $gdb->linhas > 0 ){
	$temEquipamento = 1;
}

if( !$temEquipamento  ){
	
	if(	$gdb->open("INSERT INTO servicoEquipamento (    equTombamento,   
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
                                                        '$equDescricao'      ) ") ){
		    $operacao = array( "success"=>"1","mensagem"=>"Cadastro de Equipamento realizado com SUCESSO!" );
        }else{
            $operacao = array( "error"=>"0","mensagem"=>"Erro na Inserção de dados!" );
        }
}else{
           
    if( $gdb->open("UPDATE servicoEquipamento SET  equTombamento = '$equTombamento',
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
                                        WHERE  equMAC = '$equMAC' ",1 ) ){

            $operacao = array( "success"=>"1","mensagem"=>"Equipamento atualizado com SUCESSO!"  );   
    }else{
        $operacao = array( "error"=>"0","mensagem"=>"Erro na aatualização de dados!" );
    }                                      
}

$retorno = json_encode( $operacao );

echo $retorno;							

?> 