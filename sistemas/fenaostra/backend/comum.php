<?php
	
	function processURL($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    function storeData($arr){
	    file_put_contents("data.txt", json_encode($arr));
    }
    
    function setNextUrl($next_url){
	    file_put_contents("next_url.txt", $next_url);
    }
    
    function getData(){
	    $getData = file_get_contents("data.txt");
		return (empty($getData)) ? array() : json_decode($getData, true);
    }
    
