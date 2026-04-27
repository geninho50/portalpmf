<?php
include '../db/connect.php';

// Receber dados via POST com sanitização
$nome = $_POST['nomeComercial'];
$vigenciaInicial = $_POST['vigenciaInicial'];
$vigenciaFinal = $_POST['vigenciaFinal'];
$infoContratuais = $_POST['infoContratuais'];
$custoAnual = $_POST['custoAnual'];
$classContrato = $_POST['classContrato'];
$nomeUsual = $_POST['nomeUsual'];
$objetoContrato = $_POST['objetoContrato'];
$observacaoContrato = $_POST['observacaoContrato'];
$fornecedor = $_POST['fornecedor'];
$secretaria = $_POST['secretaria'];
$superEgov = $_POST['superEgov'];
$superFiscal = $_POST['superFiscal'];
$superGestor = $_POST['superGestor'];

// Checagem de campos obrigatórios
// if (empty($nome) || empty($vigenciaInicial) || empty($vigenciaFinal) || empty($fornecedor) || empty($infoContratuais) || empty($custoAnual) || empty($secretaria) || empty($classContrato)) {
//     echo "Todos os campos com * são obrigatórios e devem ser preenchidos.";
//     exit;
// }


//pegando ultimo id salvo em contratos e salvando como $novoIdContrato
$query = "SELECT MAX(idContrato) AS maxId FROM contratos";
$resultado = $conn->query($query);
$idContratoTemp = $resultado +0;

print_r($_POST);
print_r($idContratoTemp);

// Gerenciamento de transações para operações do banco de dados
$conn->begin_transaction();

try {
    // Cálculo do custo mensal e inserção no banco de dados
    $custoMensal = $custoAnual / 12;
    $stmt = $conn->prepare("INSERT INTO contratos (nomeComercial, vigenciaInicial, vigenciaFinal, custoAnual, custoMensal, infoContratuais, observacaoContrato, objetoContrato, nomeUsual, classificacaoContrato, idFornecedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddsssssi", $nome, $vigenciaInicial, $vigenciaFinal, $custoAnual, $custoMensal, $infoContratuais, $observacaoContrato, $objetoContrato, $nomeUsual, $classContrato, $fornecedor);
    $stmt->execute();
    $stmt->close();

    // Tratamento e inserção de dados de documentos
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documentos'])) {
        $uploadDirectory = "/var/www/html/desenvolvimento/desenv4/pgs/cadastroContrato/documentos/";
        foreach ($_FILES['documentos']['name'] as $key => $filename) {
            $fileTmpPath = $_FILES['documentos']['tmp_name'][$key];
            $fileId = bin2hex(random_bytes(16));
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $filePath = $uploadDirectory . $fileId . '.' . $extension;

            if ($_FILES['documentos']['error'][$key] == 0 && move_uploaded_file($fileTmpPath, $filePath)) {
                echo "Arquivo $filename enviado com sucesso!<br>";

                $stmt = $conn->prepare("INSERT INTO documentos (idContrato, caminhoDocumento, nomeDocumento, nomeAntigo) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $resultado, $filePath, $fileId, $filename);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Erro ao enviar arquivo: $filename");
            }
        }
    }

    // Conversão de string para array e remoção de espaços
    $arraySecretarias = array_map('trim', explode(',', $secretaria));
    $arraySuperEgov = array_map('trim', explode(',', $superEgov));
    $arraySuperFiscal = array_map('trim', explode(',', $superFiscal));
    $arraySuperGestor = array_map('trim', explode(',', $superGestor));

    // Inserção de dados dos supervisores
    inserirSupervisores($arraySuperEgov, "Fiscal E-Gov", $conn);
    inserirSupervisores($arraySuperFiscal, "Fiscal", $conn);
    inserirSupervisores($arraySuperGestor, "Gestor", $conn);

    // Commit das transações
    $conn->commit();
    echo "Registro adicionado com sucesso!";
} catch (Exception $e) {
    $conn->rollback();
    echo "Erro ao processar a requisição: " . $e->getMessage();
}

$conn->close();

function inserirSupervisores($arraySupervisores, $tipo, $conn) {
    foreach ($arraySupervisores as $nomeSupervisor) {
        $query = $conn->prepare("SELECT idSupervisor FROM supervisores WHERE nomeSupervisor = ?");
        $query->bind_param("s", $nomeSupervisor);
        $query->execute();
        $resultado = $query->get_result();
        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            $idSupervisor = $linha['idSupervisor'];
            $query = "SELECT MAX(idContrato) AS maxId FROM contratos";
            $novoIdContrato = $conn->query($query);
            $inserir = $conn->prepare("INSERT INTO contratoXsupervisores (idSupervisor, idContrato, tipoSupervisor) VALUES (?, ?, ?)");
            $inserir->bind_param("iis", $idSupervisor, $novoIdContrato, $tipo);
            $inserir->execute();
        } else {
            echo "Nenhum supervisor encontrado para o nome: $nomeSupervisor\n";
        }
        $query->close();
    }
}
?>
