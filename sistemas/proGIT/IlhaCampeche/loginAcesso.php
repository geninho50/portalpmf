<?php 
header('Content-Type: application/json');
header("Cache-Control: no-cache, no-store, must-revalidate"); // Desativa o cache
header("Pragma: no-cache");

include("/home/www/sistemas/IlhaCampeche/banco/gdb.php");

$gdb         = new gdb();
$gdbOperacao = new gdb();

session_start();

$login    = $_POST['login'];
$senha    = $_POST['senha'];
$senhaMD5 = md5( $senha );

$sql = "select *
          from pessoa
         where pesemail   = '$login'           
           and Pessenha   = '$senhaMD5' ";

$gdb->open($sql);


if( isset( $gdb->gs['PESNOME'][0] ) ){

    // Gravando a sess�o inicial
    $userCodigo         = $gdb->gs['PESCODIGO'][0];
    $sessaocodigo       = session_id();
    $timestamp          = time();
    $formattedTimestamp = date("Y-m-d H:i:s", $timestamp);
    $dateAcesso         = date("Y-m-d", $timestamp);
    $ip                 = $_SERVER['REMOTE_ADDR'];
    $url                = 'https://www.pmf.sc.gov.br/IlhaCampeche';
    $sql                =  "insert into admsessao ( sessaocodigo,
                                                    sessaopessoa,
                                                   sessaodatainicial) 
                                          values  ( '$sessaocodigo',
                                                    '$userCodigo',
                                                    '$formattedTimestamp')";  
    $gdbOperacao->open($sql);

    // Gravando o acesso ao sistema
    $sql =  "insert into admacesso ( pescodigo, 
                                     acessodata, 
                                     acessoip, 
                                     acessohora, 
                                     acessourl ) 
                          values  ( '$userCodigo',
                                    '$dateAcesso',
                                    '$ip',
                                    '$formattedTimestamp',
                                    '$url')";  
    $gdbOperacao->open($sql);
    $responseData = array('status' => 1);
}else{
  /*
  print "<pre>";
  print_r( $gdb );
  print "</pre>";
  */
  $responseData = array('status' => 0 );
}

$jsonResponse = json_encode($responseData);  
echo $jsonResponse;

?>
