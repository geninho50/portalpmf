<?php
	echo '<pre>';
	//controle de data
	include_once 'comum.php';

    $tag = 'fenaostra2015';
    $client_id = '8e8a0c2eb66945509d2d8b2824419576';
    $next_url = file_get_contents("next_url.txt");
    if(empty($next_url)){
	    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
    }else{
	    $url = $next_url;
    }

    $all_result  = processURL($url);
    $decoded_results = json_decode($all_result, true);

    setNextUrl($decoded_results['pagination']['next_url']);
    
	$data = getData();
	$all = ($data != NULL) ? $data : array();
	foreach($decoded_results['data'] as $item){
		

		//verifica se id da foto já existe
		$exists = false;
		foreach($all as $one){
			if($item['caption']['id'] == $one['id']){
				$exists = true;
				break;
			}
		}
		
		if(!$exists){
			$arr = array();
	        $arr = array(
		    	'url' => $item['images']['standard_resolution']['url'],
		    	'from' => $item['caption']['from']['username'],
		    	'profile_picture' => $item['caption']['from']['profile_picture'],
		    	'text' => $item['caption']['text'],
		    	'id' => $item['caption']['id'],
		    	'aproved' => null,
		    	'showed' => false,
		    	'created_time' => $item['caption']['created_time'],
	        );
	        
	        array_push($all, $arr);	
		}
    }
    
    storeData($all);
    
    var_dump($all);
