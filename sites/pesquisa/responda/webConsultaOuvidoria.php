<?php
	
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Dados de autentica��o
$client_id = '1060';
$client_secret = 'anub1236';

// URL do endpoint para obter a lista da ouvidoria
$ouvidoria_url = 'https://falabr.cgu.gov.br/api/manifestacoes?DataCadastroInicio=01/01/2024&DataCadastroFim=01/03/2024';

$objeto = consultaWS( $client_id,$client_secret, $ouvidoria_url );   

//detalhando o que precisa
echo "<pre> Testando : ";
print_r($objeto);
echo "</pre>";


// URL do endpoint para obter a lista da ouvidoria
$ouvidoria_url = 'https://falabr.cgu.gov.br/api/manifestacoes/6719113';

$objeto2 = consultaWS( $client_id,$client_secret, $ouvidoria_url );   


//detalhando o que precisa
echo "<pre> A denuncia ";
print_r($objeto2);
echo "</pre>";



    // Exibir a lista da ouvidoria (pode ser necess�rio ajustar para a estrutura real da resposta)


    
function consultaWS( $client_id,$client_secret, $ouvidoria_url ){

    // criando o objeto
    $objeto = '';

    // URL do endpoint para obter o token de autentica��o
    $auth_url = 'https://falabr.cgu.gov.br/oauth/token';

    // Dados para a solicita��o do token
    $auth_data = array(
        'grant_type' => 'password',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'username' => 'ws_observ_pmf_prod',
        'password' => 'muld5246'
    );

    // Inicializar a sess�o cURL para obter o token
    $ch = curl_init($auth_url);

    // Definir as op��es da requisi��o para obter o token
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($auth_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executar a requisi��o para obter o token
    $auth_response = curl_exec($ch);

    // Decodificar a resposta JSON
    $auth_data = json_decode($auth_response, true);

    // Verificar se o token foi obtido com sucesso
    if ( isset( $auth_data['access_token'] ) ) {
        // Token de autentica��o
        $access_token = $auth_data['access_token'];

        // Inicializar a sess�o cURL para obter a lista da ouvidoria
        $ch = curl_init($ouvidoria_url);

        // Definir as op��es da requisi��o para obter a lista da ouvidoria
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));

        // Executar a requisi��o para obter a lista da ouvidoria
        $ouvidoria_response = curl_exec($ch);
        $objeto = json_decode( $ouvidoria_response,true );

        // Fechar a sess�o cURL
        curl_close($ch);

    }    

    return $objeto;

}    

?>