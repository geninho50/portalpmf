<?php
	include_once("gdb.php"); 

    $gdb = new gdb();  
    
    $id_pessoa = $gdb->vargetpost('id_pessoa');
    $data_troca = $gdb->vargetpost('troca');
    $quantidade_troca = $gdb->vargetpost('quantidade_troca');

    $sqlTroca = "INSERT INTO minhocario (id_pessoa,data_troca,quantidade_troca) VALUES ('$id_pessoa','$data_troca','$quantidade_troca')";

    // if($gdb->incluirTroca($id_pessoa,$data_troca,$quantidade_troca)) {
    $retorno =  $gdb->open( $sqlTroca,1 );    
    if( $retorno ) {        
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'erro : '.$retorno));    
    }
	
    
?>