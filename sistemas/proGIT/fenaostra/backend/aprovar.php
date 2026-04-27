<?php
	include_once 'comum.php';
	
	$indice = $_POST['id'];

	$data = getData();
	
	foreach($data as $key => $item){
		if($item['id'] == $indice){
			$data[$key]['aproved'] = true;
		}
	}
	
	storeData($data);
	
	echo 1;