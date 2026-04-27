<?php

  include_once('gdb.php'); 
  include_once("usuarios.func.php");   
		  
  $gdb = new usuarios();    		  
  
  $jasonForm 	= $gdb->vargetpost('jsonForm');
  $tipoOperacao = $gdb->vargetpost('tipoOperacao');
  $tabela       = $gdb->vargetpost('tabela');
  $registro     = $gdb->vargetpost('registro');
  $campoChave   = $gdb->vargetpost('campoChave');
  // tratando o campo chave

	foreach( $jasonForm as $i=>$x  ){
		if( substr($x,2,1) == '/' && substr($x,5,1) == '/' ){
				$jasonForm[$i] = substr($x,6,4).'-'.substr($x,3,2).'-'.substr($x,0,2); 
		}
	}

  $where     = " ";

 	if( $tipoOperacao == "update" ){   
			$where = " update $tabela set ";
			foreach( $jasonForm as $key => $value  ){
				if( $key != "email" ){
						$value = strtoupper($value);
				}	 
				$where .= " $key = '$value', "; 
			}
			$where = substr( $where,0, ( strlen( $where ) - 2 ) )." where $campoChave = ".$registro;
	}else{
			$where = " insert into $tabela ( ";
			$values = " values(";

			foreach( $jasonForm as $key => $value  ){
			 if( $key != "email" ){
					 $value = strtoupper($value);
			 }
			 $where .= " $key,";
			 $values .= "'$value',";
			}
		
			$where  = substr( $where,0, ( strlen( $where ) - 1 ) ).")";
			$values = substr( $values,0, ( strlen( $values ) - 1 ) ).")";
			$where .= $values;  
	}

  $gdb->open( $where );
 
  if( $gdb->linhas>0 ){
  	 $retorno = json_encode( $gdb->gs );
  }else{
		 $errors = array("erro :"=>"$where");
		 $retorno = json_encode( $errors );
	}
  echo $retorno;
?>