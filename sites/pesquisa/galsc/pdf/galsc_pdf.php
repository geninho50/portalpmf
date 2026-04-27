<?php

error_reporting( E_ALL );
ini_set('display_errors', '1' );  

include_once("/home/www/sistemas/Biblioteca/FPDF/fpdf.php");
include_once("/home/www/sistemas/Biblioteca/soap/nusoap.php");

$nu_docm 	= $_POST['nu_docm'];
$cd_hash 	=  $_POST['cd_hash'];
$token 	  = 'e4e05#cup4'; 
  
$clienteSoap = new soapclient('http://adm.pmf.sc.gov.br/siseve/ws/wsGALSCvalidacao.php?wsdl','wsdl');
   
$clienteSoap->useHTTPPersistentConnection();
   
$clienteSoap->soap_defencoding = 'utf-8';
  
$parametros = array( 'nu_docm' => $nu_docm,
                     'cd_hash' => $cd_hash,
                     'Token' => $token );

$resultado = $clienteSoap->call('enviarDadosGALSC', $parametros );

/*
print "<pre>";
print_r( $resultado );
print_r( $_POST );
print "</pre>";
die();
*/

if( isset( $resultado[0]['TIPOGALSC'] ) ){

    $pdf = new FPDF("P"); // relat rio em orienta  o "portrait"
    $pdf->Header("");
    $pdf->Footer(False);
    // $pdf->Open();    
    $hoje  = date("d/m/Y");
    $data  = $hoje;
    $texto = "";    
    $tipo  = trim( $resultado[0]['TIPOGALSC'] );

    for( $i=0; $i<5; $i++ ){
         $guia = substr( $tipo,$i,1);
         if( !empty( $guia ) ){
             Dados( $pdf, $resultado, $guia );
         }
    }

    $pdf->Output('PDF', 'I');

}else{
    erroGalsc( $resultado );
}

function Dados( $pdf, $resultado, $guia  ) {

    $fones = '';
    
    if( $resultado[0]['FONE1FAMILIAR'] !=='' ){
        $fones = $resultado[0]['FONE1FAMILIAR'];
    }
    if( $resultado[0]['FONE2FAMILIAR'] !=='' ){
        $fones .= ' / '.$resultado[0]['FONE2FAMILIAR'];
    }
    if( $resultado[0]['FONE3FAMILIAR'] !=='' ){
        $fones .= ' / '.$resultado[0]['FONE3FAMILIAR'];
    }
    if( $resultado[0]['FONE4FAMILIAR'] !=='' ){
        $fones .= ' / '.$resultado[0]['FONE4FAMILIAR'];
    }

    $pdf->AddPage();

    $pdf->SetLineWidth(1);
    $pdf->Rect(7, 7, 196, 275);
 
    $pdf->Image('http://192.168.12.4/desenvolvimento/desenv1/FPDF/imgs/icone.png', 10, 9, 40 ,30);// importa uma imagem   

    $pdf->SetXY(60,15);
    $pdf->SetFont('Arial','B',12);   
    $pdf->MultiCell(0,5,utf8_decode("CENTRAL DE ATENDIMENTO DE ÓBITOS DE FLORIANÓPOLIS"),0,"L");

    $pdf->SetXY(115,25);
    $pdf->SetFont('Arial','B',12);   
    $pdf->MultiCell(0,5,utf8_decode("CAOF/PMF"),0,"L");

    $pdf->SetXY(65,35);
    $pdf->SetFont('Arial','B',10);   
    $pdf->MultiCell(0,5,utf8_decode("CONVÊNIO COM A PREFEITURA MUNICIPAL DE FLORIANÓPOLIS/SC"),0,"L");

    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFillColor(220, 220, 220);
    $pdf->SetLineWidth(0.3);
    $pdf->Rect(7.6, 40, 195, 7, 'DF');

    $pdf->SetXY(40,41);
    $pdf->SetFont('Arial','',10);   
    $pdf->MultiCell(0,5,utf8_decode("GUIA DE AUTORIZAÇÃO PARA LIBERAÇÃO E SEPULTAMENTO DE CORPOS"),0,"L");


    $pdf->SetXY(9,53);

    if( $guia == 'H'){
        $pdf->SetTextColor(0,128,128);
        $pdf->SetFont('Arial','B',16);   
        $pdf->MultiCell(0,5,"1ª VIA LIBERAÇÃO HOSPITAL / CLINICAS / DML",0,"L");
    }
    if( $guia == 'T'){
        $pdf->SetTextColor(0,128,128);
        $pdf->SetFont('Arial','B',16);   
        $pdf->MultiCell(0,5,"2ª VIA TRANSLADO / REMOÇÃO ",0,"L");
    }

    if( $guia == 'S'){
        $pdf->SetTextColor(0,128,128);
        $pdf->SetFont('Arial','B',16);   
        $pdf->MultiCell(0,5,"3ª VIA SEPULTAMENTO / CEMIT�RIO ",0,"L");
    }

    if( $guia == 'V'){
        $pdf->SetTextColor(0,128,128);
        $pdf->SetFont('Arial','B',16);   
        $pdf->MultiCell(0,5,"4ª VIA CONTROLE / CENTRAL DE �BITO ",0,"L");
    }

    if( $guia == 'F'){
        $pdf->SetTextColor(0,128,128);
        $pdf->SetFont('Arial','B',16);   
        $pdf->MultiCell(0,5,"5ª VIA FAMILIAR / CART�RIO ",0,"L");
    }

    $pdf->SetXY(9,61);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("NOME: "),0,"L");
    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(25,61);
    $pdf->MultiCell(0,5,utf8_decode( $resultado[0]['NOMEFALECIDO'] ),0,"L"); 

    $pdf->SetXY(145,61);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("GALSC Nº: " ),0,"L");
    $pdf->SetFont('Arial','',11);   
    $pdf->SetXY(167,61);
    $pdf->MultiCell(0,5,utf8_decode( $resultado[0]['CODIGOGALSC'] ),0,"L");

    $pdf->SetXY(9,68);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("DATA DO ÓBITO: ".$resultado[0]['DATAOBITO']),0,"L");

    $pdf->SetXY(130,68);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("D.O. Nº ou C.O.: ".$resultado[0]['DOCUMENTO']),0,"L");
    
    $pdf->SetXY(65,68);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("HORA DO ÓBITO: ".$resultado[0]['HORAOBITO']),0,"L");
    
    $pdf->SetXY(9,75);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("LOCAL DO ÓBITO: ".$resultado[0]['LOCALOBITO']),0,"L");

    $pdf->SetXY(9,82);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("LOCAL ONDE O CORPO SE ENCONTRA: ".$resultado[0]['LOCALDOCORPO']),0,"L");

    $pdf->SetXY(9,89);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("FUNER�RIA: ".$resultado[0]['NOMEFUNERARIA']),0,"L");
    
    $pdf->SetXY(9,96);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("AGENTE FUNERÝRIO: ".$resultado[0]['NOMEAGENTE1FUNERARIA']),0,"L");

    $pdf->SetXY(140,96);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CNH: ".$resultado[0]['CNHAGENTE1FUNERARIA']),0,"L");

    $pdf->SetXY(9,103);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("AGENTE FUNERÝRIO 2: ".$resultado[0]['NOMEAGENTE2FUNERARIA']),0,"L");

    $pdf->SetXY(140,103);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CNH: ".$resultado[0]['CNHAGENTE2FUNERARIA']),0,"L");

    $pdf->SetXY(9,110);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("FUNERÝRIA COMPLEMENTAÇÃO: ".$resultado[0]['CODIGOGALSC']),0,"L");

    $pdf->SetXY(9,117);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("AGENTE FUNERÝRIO: "),0,"L");

    $pdf->SetXY(140,117);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CNH: "),0,"L");

    $pdf->SetXY(9,124);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("LOCAL VELÓRIO: ".$resultado[0]['LOCALVELORIO']),0,"L");

    $pdf->SetXY(9,131);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("LOCAL SEPULTAMENTO: ".$resultado[0]['CIDADESEPULTAMENTO']." / ".$resultado[0]['ESTADOSEPULTAMENTO']),0,"L");

    $pdf->SetXY(9,138);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("DATA SEPULTAMENTO: ".$resultado[0]['DATASEPULTAMENTO']),0,"L");

    $pdf->SetXY(9,145);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CEMITÉRIO SEPULTAMENTO: ".$resultado[0]['CEMITERIOSEPULTAMENTO']),0,"L");

    $pdf->SetXY(9,152);
    $pdf->SetFont('Arial','B',13);   
    $pdf->MultiCell(0,5,utf8_decode("FAMILIAR E/OU RESPONSÝVEL PELO FALECIDO"),0,"L");

    $pdf->SetXY(9,159);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("NOME COMPLETO: ".$resultado[0]['NOMEFAMILIAR']),0,"L");

    $pdf->SetXY(140,159);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("VINCULO: ".$resultado[0]['VINCULOFAMILIAR'] ),0,"L");

    $pdf->SetXY(9,166);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("IDENTIDADE (RG): ".$resultado[0]['RGFAMILIAR'] ),0,"L");

    $pdf->SetXY(100,166);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CPF/CNPJ: ".$resultado[0]['CPFFAMILIAR'] ),0,"L");

    $pdf->SetXY(9,173);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("ENDEREÇO: ".$resultado[0]['ENDERECOFAMILIAR'] ),0,"L");

    $pdf->SetXY(9,180);
    $pdf->SetFont('Arial','B',11); 
    $pdf->MultiCell(0,5,utf8_decode("TELEFONE(S): ".$fones ),0,"L");

    $pdf->SetXY(9,187);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("DATA EMISSÃO GALSC: ".$resultado[0]['DATAEMISSAOGALSC']),0,"L");

    $pdf->SetXY(9,194);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("MEDICO(S): ".$resultado[0]['NOMEMEDICO'] ),0,"L");

    $pdf->SetXY(140,194);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("CRM: ".$resultado[0]['CRMMEDICO']),0,"L");

    $pdf->Line(7.7, 206, 203, 206);

    $pdf->SetXY(120,206);
    $pdf->SetTextColor(255,0,0);
    $pdf->SetFont('Arial','B',8);   
    $pdf->MultiCell(0,5,utf8_decode("Retificação de GALSC somente em 48 horas da criação."),0,"L");


    $pdf->Line(30, 220, 90, 220);
    $pdf->SetXY(40,221);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);   
    $pdf->MultiCell(0,5,utf8_decode("FAMILIAR / RESPONSÝVEL  " ),0,"L");

    $pdf->SetLineWidth(0.3);
    $pdf->Rect(115, 211, 88, 35, 'D');    

    $pdf->Line(15, 245, 60, 245);
    $pdf->SetXY(20,246);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);   
    $pdf->MultiCell(0,5,utf8_decode("AGENTE FUNERÝRIO "),0,"L");

    $pdf->Line(65, 245, 110, 245);
    $pdf->SetXY(82,246);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);   
    $pdf->MultiCell(0,5,utf8_decode("CAOF"),0,"L");

    $pdf->SetXY(82,246);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);   
    $pdf->MultiCell(0,5,utf8_decode("CAOF"),0,"L");

    $pdf->SetXY(15,265);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);   
    $pdf->MultiCell(0,5,utf8_decode("CAOF/PMF - (48)3065-5500 - CEMITERIO SAO FRANCISCO DE ASSIS - ITACORUBI - FLORIANOPOLIS-SC"),0,"L");

    $pdf->SetXY(40,271);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);   
    $pdf->MultiCell(0,5,utf8_decode("Secretaria de Segurança Publica / Prefeitura Municipal de Florianópolis - SC"),0,"L");
  
   
 }

function erroGalsc($resultado){ ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validar Documento</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="https://www.pmf.sc.gov.br/sistemas/Biblioteca/govbr/dist/dsgov.css" /> 
    </head>
    <body>
        <div class="page" id="fade">
            <div id="modal">
                <div class="modal-header">
                    <img src="../pmf.png" alt="" style="width: 250px;">
                </div>
                <div class="modal-body">      
                    <?php if( $resultado == '' ){ ?>
                            <h1>Infelizmente estamos com problemas em nossos servidores! Tente novamente mais tarde.</h1>
                    <?php }else{ ?>
                            <h1>N&atilde;o foi encontrado nenhuma GALSC com os dados enviados !</h1>
                    <?php } ?>                        
                </div>
            </div>
        </div>
    </body>      
<?php
}
?>