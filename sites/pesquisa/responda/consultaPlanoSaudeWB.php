<?php

## Request Token

session_start();
include_once('conexao.php'); 

$matricula = $_POST['matricula'];
$senha     = $_POST['senha'];

$sql       = "select * From cadastro_sma where matricula = '$matricula' ";
$result    = $conn->query($sql);

if ( $result->num_rows>0 ){
     $dados = '{"valor":"0","Mensagem":"Voce ja preencheu o Formulario !"}';
     print_r($dados);               
}else{

    $urlToken = 'https://adm.pmf.sc.gov.br/stm-autorizador/oauth/token';

    $paramsToken = array(
      'client_id' => 'egov-client',
      'client_secret' => 'd18531d17208102ce313199e7fc9206b',
      'grant_type' => 'client_credentials'
    );

    $base64Credentials = base64_encode('egov-client:d18531d17208102ce313199e7fc9206b');

    $chToken = curl_init($urlToken);

    curl_setopt($chToken, CURLOPT_POST, 1);
    curl_setopt($chToken, CURLOPT_RETURNTRANSFER, true);

    $headersToken = [
      'Authorization: Basic '.$base64Credentials,
      'Content-Type: application/x-www-form-urlencoded'
    ];

    curl_setopt($chToken, CURLOPT_HTTPHEADER, $headersToken);
    curl_setopt($chToken, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($chToken, CURLOPT_POSTFIELDS, http_build_query($paramsToken));

    $responseToken = curl_exec($chToken);

    if (curl_errno($chToken)) {
        echo 'Erro na requisição cURL: ' . curl_error($chToken);
    }

    curl_close($chToken);

    $responseDataToken = json_decode($responseToken, true);
    /*
    print "<pre>";
    print_r($responseDataToken["access_token"]);
    print "</pre>";
    */

    ## Request Plano Saude

    $urlPlanoSaude = 'https://adm.pmf.sc.gov.br/admin/autentica_adesao_plano_saude.php';

    $paramsPlanoSaude = array(
        'matricula' => $matricula,
        'senha' => $senha
    );

    $chPlanoSaude = curl_init($urlPlanoSaude);

    curl_setopt($chPlanoSaude, CURLOPT_POST, 1);
    curl_setopt($chPlanoSaude, CURLOPT_RETURNTRANSFER, true);
    $headersPlanoSaude = [
        'Authorization: Bearer '.$responseDataToken["access_token"]
    ];
    curl_setopt($chPlanoSaude, CURLOPT_HTTPHEADER, $headersPlanoSaude);
    curl_setopt($chPlanoSaude, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($chPlanoSaude, CURLOPT_POSTFIELDS, http_build_query($paramsPlanoSaude));

    $responsePlanoSaude = curl_exec($chPlanoSaude);

    if (curl_errno($chPlanoSaude)) {
        echo 'Erro na requisição cURL: ' . curl_error($chPlanoSaude);
    }

    curl_close($chPlanoSaude);
    print_r($responsePlanoSaude);
}
?>