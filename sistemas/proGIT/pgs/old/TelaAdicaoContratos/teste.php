<?php
include '../db/connect.php';
include_once('../db/gdb_mysql.php');

$gdb = new gdb();

// Validação de dados vazios
// if (empty($_POST['nomeComercial']) || empty($_POST['vigenciaInicial']) || empty($_POST['vigenciaFinal']) || empty($_POST['infoContratuais']) || empty($_POST['classContrato']) || empty($_POST['nomeUsual']) || empty($_POST['objetoContrato']) || empty($_POST['observacaoContrato']) || empty($_POST['fornecedor']) || empty($_POST['custoAnual']) || empty($_POST['secretaria']) || empty($_POST['superEgov']) || empty($_POST['superFiscal']) || empty($_POST['superGestor'])) {
//     echo "Todos os campos com * são obrigatórios";
//     exit;
// }

// Receber dados via POST com sanitização
$nomeComercial = $_POST['nomeComercial'];
$vigenciaInicial = $_POST['vigenciaInicial'];
$vigenciaFinal = $_POST['vigenciaFinal'];
$infoContratuais = $_POST['infoContratuais'];
$classContrato = $_POST['classContrato'];
$nomeUsual = $_POST['nomeUsual'];
$objetoContrato = $_POST['objetoContrato'];
$observacaoContrato = $_POST['observacaoContrato'];
$fornecedor = $_POST['fornecedor'];


//Tratamento do Custo
$custoAnual = $_POST['custoAnual'];
$custoAnualFloat = floatval(str_replace(',', '.', $custoAnual));
$custoMensal = $custoAnualFloat/12;


// //Tratamento de string para arrays
$secretaria = $_POST['secretaria'];
$arraySecretarias = array_map('trim', explode(',', $secretaria));

$superEgov = $_POST['superEgov'];
$arraySuperEgov = array_map('trim', explode(',', $superEgov));

$superFiscal = $_POST['superFiscal'];
$arraySuperFiscal = array_map('trim', explode(',', $superFiscal));

$superGestor = $_POST['superGestor'];
$arraySuperGestor = array_map('trim', explode(',', $superGestor));
print'<pre>';
print_r($_POST);
print_r($custoMensal);
print'<\pre>';
print_r($arraySecretarias);
echo "\n";
print_r($arraySuperEgov);
echo "\n";
print_r($arraySuperFiscal);
echo "\n";
print_r($arraySuperGestor);

function inserirSupervisores($arraySupervisores, $tipo, $conn, $nomeComercial, $idContrato) {
    foreach ($arraySupervisores as $nomeSupervisor) {
        $gdb = new gdb();
        $gdb->open("SELECT idSupervisor 
                    FROM supervisores 
                    WHERE upper(nomeSupervisor) = upper('$nomeSupervisor')");
        if($gdb->linhas == 1 ){
            $idSupervisor = $gdb->gs['IDSUPERVISOR'][0];
            $sql3 = "INSERT INTO contratoXsupervisor (idSupervisor,
                                                      idContrato,
                                                      tipoSupervisor) 
                                             VALUES ('$idSupervisor',  
                                                     '$idContrato',
                                                     '$tipo')";
            
            $gdb->open($sql3,1);
        } 
    }
}


//Pegando id do fornecedor pelo nome
$gdb->open("SELECT idFornecedor 
              FROM fornecedor 
             WHERE upper(nomeFornecedor) = upper('$fornecedor') ",1);

//Salvando dados do contrato no banco 
if($gdb->linhas == 1 ){
        $idFornecedor = $gdb->gs['IDFORNECEDOR'][0];
        $sql = "INSERT INTO contratos (vigenciaInicial, 
                                        vigenciaFinal, 
                                       custoAnual, 
                                       custoMensal, 
                                       infoContratuais, 
                                       observacaoContrato, 
                                       objetoContrato, 
                                       nomeUsual, 
                                       nomeComercial, 
                                       classificacaoContrato,
                                       idFornecedor) 
                              VALUES ('$vigenciaInicial', 
                                      '$vigenciaFinal', 
                                      '$custoAnual', 
                                      '$custoMensal', 
                                      '$infoContratuais', 
                                      '$observacaoContrato', 
                                      '$objetoContrato', 
                                      '$nomeUsual', 
                                      '$nomeComercial', 
                                      '$classContrato',
                                      '$idFornecedor')";
       $gdb->open($sql,1);                               
}

//Pegando ID do ultimo contrato inserido
$gdb->open("SELECT idContrato 
              FROM contratos 
             WHERE upper(nomeComercial) = upper('$nomeComercial') ",1);
$idContrato = $gdb->gs['IDCONTRATO'][0];

//Enviando Documentos para o wincp e criando variaveis de nomes e path
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documentos'])) {
    $uploadDirectory = "/var/www/html/desenvolvimento/desenv4/pgs/cadastroContrato/documentos/";

    foreach ($_FILES['documentos']['name'] as $key => $filename) {
        $fileTmpPath = $_FILES['documentos']['tmp_name'][$key];
        $fileId = bin2hex(random_bytes(16));
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $filePath = $uploadDirectory . $fileId . '.' . $extension;
        print_r("O FILEPATH É: $filePath");

        if ($_FILES['documentos']['error'][$key] == 0 && move_uploaded_file($fileTmpPath, $filePath)) {
            echo "Arquivo $filename enviado com sucesso!<br>";

            //Inserindo dados na tabela documento
            $caminhoArquivo = "/var/www/html/desenvolvimento/desenv4/pgs/cadastroContrato/documentos/" . $fileID;
            print_r($caminhoArquivo);
            $sql2 = "INSERT INTO documentos (idContrato, 
                                            caminhoDocumento, 
                                            nomeDocumento, 
                                            nomeAntigo) 
                                VALUES ('$idContrato', 
                                        '$filePath', 
                                        '$fileId', 
                                        '$filename')";
        
            $gdb->open($sql2,1);
            
        }
    }
}

inserirSupervisores($arraySuperEgov, "Fiscal E-Gov", $conn, $nomeComercial, $idContrato);
inserirSupervisores($arraySuperFiscal, "Fiscal", $conn, $nomeComercial, $idContrato);
inserirSupervisores($arraySuperGestor, "Gestor", $conn, $nomeComercial, $idContrato);
    
foreach ($arraySecretarias as $nomeSecretaria) {
    $gdb->open("SELECT idSecretaria 
                FROM secretarias 
                WHERE upper(siglaSecretaria) = upper('$nomeSecretaria') 
                   OR upper(nomeSecretaria) = upper('$nomeSecretaria')", 1);
                $idSecretaria = $gdb->gs['IDSECRETARIA'][0];
    if($gdb->linhas == 1){
        
        $sql4 = "INSERT INTO contratoXsecretaria (idSecretaria, idContrato) VALUES ('$idSecretaria', '$idContrato')";
        $gdb->open($sql4,1);
    }
}

header('Location: http://192.168.12.4/desenvolvimento/desenv4/pgs/cadastroContrato/');
?>