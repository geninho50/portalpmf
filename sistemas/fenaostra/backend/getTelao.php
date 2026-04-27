<?php
	include_once 'comum.php';
	
	$data = getData();
	$telao = $data;
	foreach($data as $key => $item){
		if($item['showed'] || $item['aproved'] == false){
			unset($telao[$key]);
		}else{
			$data[$key]['showed'] = true;
		}
	}
	
	if(!empty($data)){
		storeData($data);
	}
	
	echo json_encode(array_values($telao));
	
