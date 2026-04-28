<?php

// Dados de autenticação
$client_id       = '1190';
$client_secret   = 'kadg4762';
$tipoRetorno     = $_GET['tipoRetorno'];
$codigoManifesto = $_GET['codigoManifesto'];

/*
print "<pre>";
print_r($_GET);
print "</pre>";
*/

// URL do endpoint para obter o token de autenticação
$auth_url = 'https://treinafalabr.cgu.gov.br/oauth/token';

// Dados para a solicitação do token
$auth_data = array(
    'grant_type' => 'password',
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'username' => 'ws_observ_pmf',
    'password' => 'Marina040693'
);

// Inicializar a sessão cURL para obter o token
$ch = curl_init($auth_url);

// Definir as opções da requisição para obter o token
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($auth_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executar a requisição para obter o token
$auth_response = curl_exec($ch);

// Decodificar a resposta JSON
$auth_data = json_decode($auth_response, true);

// Verificar se o token foi obtido com sucesso
if (isset($auth_data['access_token'])) {
    // Token de autenticação
    // URL do endpoint para obter a lista da ouvidoria
    $access_token = $auth_data['access_token'];
    switch ( $tipoRetorno ) {
    case   11:    
        $dadosConsulta = 'manifestacoes?DataCadastroInicio=01/01/2020&DataCadastroFim=01/09/2023';
        break;

    case    21:    
        $dadosConsulta = 'manifestacoes/$codigoManifesto';
        break;

    default:    
        $dadosConsulta = 'manifestacoes?DataCadastroInicio=01/01/2020&DataCadastroFim=01/09/2023';

    }


    $ouvidoria_url = "https://treinafalabr.cgu.gov.br/api/$dadosConsulta";

    // Inicializar a sessão cURL para obter a lista da ouvidoria
    $ch = curl_init($ouvidoria_url);

    // Definir as opções da requisição para obter a lista da ouvidoria
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));

    // Executar a requisição para obter a lista da ouvidoria
    $ouvidoria_response = curl_exec($ch);

    // Exibir a lista da ouvidoria (pode ser necessário ajustar para a estrutura real da resposta)
    switch ( $tipoRetorno ) {
        case 11:    
            generateTableFromJSON( $ouvidoria_response ); 
            break;
    
        case 21:    
            $tablePrint = gerarTabelaManifesto($ouvidoria_response);
            print $tablePrint;
            break;    
        }

    // Fechar a sessão cURL
    curl_close($ch);
} else {
    echo 'Erro ao obter o token de autenticação.';
}



function generateTableFromJSON($jsonString) {
    $data = json_decode($jsonString, true);

    if ($data === null) {
        return "Erro ao decodificar JSON.";
    }

    $table = '
    <div class="row">
        <div class="col-lg-8">
            <h3 class="page-header">Consulta de Reclamacoes</h3>
            <ol class="breadcrumb">
            <li>Ouvidoria</li>
            <li>Reclamacoes</li>
            </ol>
        </div>
    </div>
    <section class="panel">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><center><Manifestacao</center></th>
                <th><center>Protocolo</center></th>
                <th><center>Destino</center></th>
                <th><center>Assunto</center></th>
                <th><center>Tipo</center></th>
                <th><center>Email</center></th>
                <th><center>Data</center></th>
                <th><center>Limite</center></th>
                <th><center>Situacao</center></th>
            </tr>
        </thead>
        <tbody>';
    
    foreach ($data as $item) {
        $codigo = $item['IdManifestacao'];        
        $table .= '<tr>';        
        $table .= '<td><a class="" onclick="moduloConsulta(21,' . $codigo . ');" href="#">' . $codigo . '</a></td>';
        $table .= '<td>' . $item['NumerosProtocolo'][0] . '</td>';
        $table .= '<td>' . $item['OuvidoriaDestino']['NomOuvidoria'] . '</td>';
        $table .= '<td>' . $item['Assunto']['DescAssunto'] . '</td>';
        $table .= '<td>' . $item['TipoManifestacao']['DescTipoManifestacao'] . '</td>';
        $table .= '<td>' . $item['EmailManifestante'] . '</td>';
        $table .= '<td>' . $item['DataCadastro'] . '</td>';
        $table .= '<td>' . $item['PrazoAtendimento'] . '</td>';
        $table .= '<td>' . $item['Situacao']['DescSituacaoManifestacao'] . '</td>';
        $table .= '</tr>';
    }
    
    $table .= '</tbody>
        </table>
        </section>';

    print $table;
} 

function gerarTabelaManifesto($vetorString) {
    $data = json_decode($vetorString, true);

    $table = '
    <div class="row">
        <div class="col-lg-8">
            <h3 class="page-header">Dados da Manifestacao</h3>
            <ol class="breadcrumb">
            <li>Ouvidoria</li>
            <li>Reclamacoes</li>
            </ol>
        </div>
    </div>
    <section class="panel">
    <table class="table table-bordered"><tbody>';

    foreach ($data as $key => $value) {
        if (is_array($value) && empty($value)) {
            continue; // Pula subvetores vazios
        }
        
        $table .= '<tr>';
        $table .= '<td>' . htmlspecialchars($key) . '</td>';
        $table .= '<td>' . htmlspecialchars($value) . '</td>';
        /*
        if (is_array($value)) {
            $table .= '<td>' . gerarTabelaManifesto2($value) . '</td>';
        } else {
            $table .= '<td>' . htmlspecialchars($value) . '</td>';
        }
        */
        $table .= '</tr>';
    }
    $table .= '</tbody></table></section>';

    return $table;
}

function gerarTabelaManifesto2($vetorString) {
    $data = $vetorString;

    $table = '
    <table class="table table-bordered"><tbody>';

            foreach ($data as $key => $value) {
                if (is_array($value) && empty($value)) {
                    continue; // Pula subvetores vazios
                }
                
                $table .= '<tr>';
                $table .= '<td>' . htmlspecialchars($key) . '</td>';
                if (is_array($value)) {
                    $table .= '<td>' . gerarTabelaManifesto2($value) . '</td>';
                } else {
                    $table .= '<td>' . htmlspecialchars($value) . '</td>';
                }
                $table .= '</tr>';
            }
            $table .= '</tbody></table></section>';

    return $table;
}


?>