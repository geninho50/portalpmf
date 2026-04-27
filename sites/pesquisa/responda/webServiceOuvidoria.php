<?php
	
ini_set('display_errors', 1);
error_reporting(E_ALL);

// criando o Objeto gdb
include_once('banco/gdb.php');

$gdb = new gdb();


// Dados de autentica��o
$client_id = '1060';
$client_secret = 'anub1236';

// URL do endpoint para obter a lista da ouvidoria
$ouvidoria_url = 'https://falabr.cgu.gov.br/api/manifestacoes?DataCadastroInicio=01/01/2024&DataCadastroFim=01/03/2024';

$objeto = consultaWS( $client_id,$client_secret, $ouvidoria_url );   

//detalhando o que precisa
/*
    echo "<pre>";
    print_r($objeto);
    echo "</pre>";
*/

foreach($objeto as $i=>$value){
    
    print "protocolo : ".$value['NumerosProtocolo'][0]."<br>";
    print "Código Tipo : ".$value['TipoManifestacao']['IdTipoManifestacao']."<br>";
    print "Tipo Descrição : ".$value['TipoManifestacao']['DescTipoManifestacao']."<br>";
    print "Assunto : ".$value['Assunto']['DescAssunto']."<br>";
    

    $numero       = $value['IdManifestacao'];        
    
    $select = "select * from manifestacao where idmanifestacao = '$numero' ";
    $gdb->open( $select );

    if( $gdb->linhas == 0 ){

        $IdOrgaoSiorg       = "";
        $dataCadastro       = substr($value['DataCadastro'],6,4).'-'.substr($value['DataCadastro'],3,2).'-'.substr($value['DataCadastro'],0,2);
        $PrazoAtendimento   = substr($value['PrazoAtendimento'],6,4).'-'.substr($value['PrazoAtendimento'],3,2).'-'.substr($value['PrazoAtendimento'],0,2);
        $EmailManifestante  = $value['EmailManifestante'];
        $ResponsavelAnalise = $value['ResponsavelAnalise'];
        $NumerosProtocolo   = $value['NumerosProtocolo'][0];
        $IdTipoManifestacao = $value['TipoManifestacao']['IdTipoManifestacao'];
        $DescTipoManifestacao = $value['TipoManifestacao']['DescTipoManifestacao'];
        $DescAssunto          = $value['Assunto']['DescAssunto'];
        $IdAssunto            = $value['Assunto']['IdAssunto'];
        if( isset( $value['OuvidoriaDestino']['IdOrgaoSiorg'] ) ){
            $IdOrgaoSiorg         = $value['OuvidoriaDestino']['IdOrgaoSiorg'];
        }        
        $IdOuvidoria          = $value['OuvidoriaDestino']['IdOuvidoria'];
        $NomeOrgao            = $value['OuvidoriaDestino']['NomOuvidoria'];
        

        if( $value['IndPossuiIdentidadePreservada'] ){
            $IndPossuiIdentidadePreservada = '1';
        }else{
            $IndPossuiIdentidadePreservada = '0';
        }
        
        // Fazenod a inclusão do manifesto
        $gdb->open("insert into manifestacao( IdManifestacao, 
                                                DataCadastro, 
                                                PrazoAtendimento, 
                                                EmailManifestante,
                                                ResponsavelAnalise,
                                                IndPossuiIdentidadePreservada )
                                        values ('$numero', 
                                                '$dataCadastro', 
                                                '$PrazoAtendimento',
                                                '$EmailManifestante',
                                                '$ResponsavelAnalise',
                                                '$IndPossuiIdentidadePreservada' ) ");
        // Verificando se a manifestação foi inserida
        $gdb->open("select * from manifestacao where idmanifestacao = '$numero' ");

        if( $gdb->linhas > 0 ){
            // Inserindo o protocolo
            $gdb->open("insert into manifestacaoprotocolo( IdManifestacaoPro, NumerosProtocolo ) values ( '$numero', '$NumerosProtocolo' ) ");

            // Inserindo o tipo de manifestação    
            $gdb->open("insert into tipoManifestacao( IdManifestacaoMan, IdTipoManifestacao, DescTipoManifestacao )  values ( '$numero', '$IdTipoManifestacao','$DescTipoManifestacao' ) ");

            // Inserindo o Assunto da manifestação
            $gdb->open("insert into manifestacaoassunto( IdManifestacao, IdAssunto, DescAssunto ) values ( '$numero', '$IdAssunto', '$DescAssunto' ) ");


            // Inserindo o Orgão da manifestação
           /// $gdb->open("insert into manifestacaoorgao( IdManifestacaoOrgao, IdOrgaoSiorg, IdOuvidoria, NomeOrgao ) values ( '$numero', '$IdOrgaoSiorg', '$IdOuvidoria', '$NomeOrgao' ) ");

           
            // Buscando o Teor da manifestação                                                
            $ouvidoria_url = "https://falabr.cgu.gov.br/api/manifestacoes/$numero";
            $objeto2       = consultaWS( $client_id,$client_secret, $ouvidoria_url );   
           
            if( isset( $objeto2['Teor']['DescricaoAtosOuFatos'] ) ){                
                // Inserindo o teor da manifestação
                $Idteor               =  novoCodigo('teor', $gdb );                
                $DescricaoAtosOuFatos = $objeto2['Teor']['DescricaoAtosOuFatos'];
                $PropostaMelhoria     = $objeto2['Teor']['PropostaMelhoria'];
                $gdb->open("insert into manifestacaoteor( IdManifestacaoTeror,
                                                        Idteor,
                                                        DescricaoAtosOuFatos,
                                                        PropostaMelhoria ) 
                                                values ( '$numero', 
                                                         '$Idteor',
                                                         '$DescricaoAtosOuFatos',
                                                         '$PropostaMelhoria' ) ");
            }                                             

            if( isset( $objeto2['CanalEntrada']['DescCanalEntrada'] ) ){
                // Inserindo o Canal de Entrada
                $IdCanalEntrada       = $objeto2['CanalEntrada']['IdCanalEntrada'];
                $DescCanalEntrada     = $objeto2['CanalEntrada']['DescCanalEntrada'];                
                $gdb->open("insert into manifestacaoCanalEntrada( IdManifestacaoCE, 
                                                                  IdCanalEntrada, 
                                                                  DescCanalEntrada ) 
                                                         values ( '$numero', 
                                                                  '$IdCanalEntrada', 
                                                                  '$DescCanalEntrada' ) ");
            }    

            if( isset( $objeto2['ModoResposta']['DescModoResposta'] ) ){
                // Inserindo o modo de resposta
                $IdModoResposta       = $objeto2['ModoResposta']['IdModoResposta'];
                $DescModoResposta     = $objeto2['ModoResposta']['DescModoResposta'];                
                $IndModoRespostaAtivo = $objeto2['ModoResposta']['IndModoRespostaAtivo'];                
                
                $gdb->open("insert into manifestacaomodoresposta( IdmanifestacaoMR, 
                                                                  IdModoResposta, 
                                                                  DescModoResposta,
                                                                  IndModoRespostaAtivo ) 
                                                         values ( '$numero', 
                                                                  '$IdModoResposta', 
                                                                  '$DescModoResposta',
            }                                                      '$IndModoRespostaAtivo') ");

            if( isset( $objeto2['LocalFato']['DescricaoLocalFato'] ) ){
                // Inserindo o local fato
                $Municipio            = $objeto2['LocalFato']['Municipio'];
                $DescricaoLocalFato   = $objeto2['LocalFato']['DescricaoLocalFato'];                               
                $GeoReferencia        = $objeto2['LocalFato']['GeoReferencia'];                

                $gdb->open("insert into manifestacaolocalFato(    IdManifestacaoLocalFato, 
                                                                  Municipio, 
                                                                  DescricaoLocalFato,
                                                                  GeoReferencia ) 
                                                         values ( '$numero', 
                                                                  '$Municipio', 
                                                                  '$DescricaoLocalFato',
                                                                  '$GeoReferencia') ");
            }                                         

            if( isset( $objeto2['InformacoesAdicionais']['EnvolveEmpresa'] ) ){
                // Inserindo informações Adicionais
                $Apta                                    = $objeto2['InformacoesAdicionais']['Apta'];
                $EnvolveEmpresa                          = $objeto2['InformacoesAdicionais']['EnvolveEmpresa'];                               
                $EnvolveServidorPublico                  = $objeto2['InformacoesAdicionais']['EnvolveServidorPublico'];                
                $EnvolveCargoComissionadoDAS4OuSuperior  = $objeto2['InformacoesAdicionais']['EnvolveCargoComissionadoDAS4OuSuperior'];                

                $gdb->open("insert into manifestacaoInformacoesAdicionais( IdManifestacaoIA, 
                                                                           Apta, 
                                                                           EnvolveEmpresa,
                                                                           EnvolveServidorPublico,
                                                                           EnvolveCargoComissionadoDAS4OuSuperior ) 
                                                                  values ( '$numero', 
                                                                           '$Apta', 
                                                                           '$EnvolveEmpresa',
                                                                           '$EnvolveServidorPublico',
                                                                           '$EnvolveCargoComissionadoDAS4OuSuperior') ");
            }                                         
            print "Integra da Manifestação : <pre>".$objeto2['Teor']['DescricaoAtosOuFatos']."</pre><br><br>";                                                            
        }
    }   

    }
}
      
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

function novoCodigo($base, $gdb ){

    $retorno = 0;
    
    if( $base == 'teor' ){
        $gdb->open('SELECT COALESCE(MAX(Idteor), 0) + 1 AS codigo FROM manifestacaoteor');
        $retorno = $gdb->gs['CODIGO'][0];

    }        

    return $retorno;
}

?>