<?php
	include_once 'comum.php';
	
	$data = getData();
	
	foreach($data as $key => $item){
		if($item['showed'] or $item['aproved'] != null){
			unset($data[$key]);
		}
	}
	
	echo json_encode(array_values($data));
	
