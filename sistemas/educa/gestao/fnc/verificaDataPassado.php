<?php

function verificaDataPassado($data){
	
	$data = str_replace('/', '-', $data);
	$dataArray = explode('-', $data);

	if(!checkdate($dataArray[1], $dataArray[0], $dataArray[2])){
		return false;
	}
        
        if($dataArray[2] < 1800){
            return false;
        }

	$dataDeHoje = date('d-m-Y');

	$hoje = strtotime($dataDeHoje);

	$nascimento = strtotime($data);
	
	if($nascimento > $hoje){
		return false;
	}

	return true;
}

?>