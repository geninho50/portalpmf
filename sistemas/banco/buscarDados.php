<?php
	include_once('gdb.php'); 
	  
	$gdb = new gdb(); 
	  
	$tabela      = $gdb->vargetpost('tabela');
	$campoChave  = $gdb->vargetpost('campoChave');
	$registro    = $gdb->vargetpost('registro');
	$listaCampos = $gdb->vargetpost('listaCampos','*');

    if( $registro != '' ){ 
	    $select = "select $listaCampos from $tabela Where $campoChave = '$registro' ";
    }else{
	    $select = "select $listaCampos from $tabela Where $campoChave = ( select min( $campoChave ) from $tabela ) "; 
    }
  
	$gdb->open( $select );

	if( $gdb->linhas>0 ){
		 $retorno = json_encode( $gdb->gs );
	}else{
		 $errors = array("erro :"=>"1");
		 $retorno = json_encode( $errors );
	}

	echo $retorno;
?>