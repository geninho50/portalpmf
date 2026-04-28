<?php
  include ("JSON.php");

  if( !function_exists('json_encode') ) {
      function json_encode($data) {
          $json = new Services_JSON();
          return( $json->encode($data) );
      }
  }

  if( !function_exists('json_decode') ) {
      function json_decode($data) {
          $json = new Services_JSON();
          return( $json->decode($data) );
      }
  }

  $conf = "host = localhost
    port=5432
    dbname=portal_pmf
    user=postgres
    password=postgres";
  $conection = pg_connect($conf) or die('\n Falha de conexão com o banco de dados \n');
  $userId = "5723348535";

  //$clientId  = "3f144466d15d44d5a769b68f8b60f7f3";
  // $secret = "14c97e62f1784e94bb313de208aeea16";
  // $redirectUrl = "http://pmf.sc.gov.br/?instagram_redirect=1";
  // $urlGetApiKey = "https://api.instagram.com/oauth/authorize/?client_id=$clientId&redirect_uri=$redirectUrl&response_type=code";

  $accessToken = "5723348535.3f14446.0b9bb36a2aba403ab07fcd4d08ffa9be";
  $urlGetRecentMedia = "https://api.instagram.com/v1/users/$userId/media/recent/?count=5&access_token=$accessToken";


  $contents = file_get_contents($urlGetRecentMedia);
  $results = json_decode($contents);

  if($results !== false){
    $insertQuery = "INSERT INTO instagram (image_url, link) values ";
    $count = 0;
    foreach($results->data as $i => $post){
      $count++;
      $escapedLink = pg_escape_string($post->images->standard_resolution->url);
      $insertQuery .= "('" . $escapedLink . "', '". $post->link ."')";
      if(array_key_exists($i + 1, $results->data)){
        $insertQuery .=",";
      }
    }
    $insertQuery .= ";";
    if($count >= 5){
      $emptyQuery = "DELETE FROM instagram *;";
      pg_query($conection, $emptyQuery);
      pg_query($conection, $insertQuery);

    } else {
      echo "[ERRO] - Não retornou 5 posts -> " . var_dump($http_response_header) ." \n ------------------------- \n";
    }
  }else{
    echo "[ERROR] -> " . var_dump($http_response_header) ." \n ------------------------- \n" ;
  }

  pg_close($conection);
?>
