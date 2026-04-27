<?php
include_once ('connect.php');

$name = $_POST['name'];
$value = strtoupper($_POST['value']);

// Mapeamento de queries apenas para os campos relevantes
$queryMap = [
    'fornecedor' => "SELECT 1 FROM fornecedor WHERE UPPER(nomeFornecedor) = ? OR UPPER(razaoFornecedor) = ?",
    'supResponsavel' => "SELECT 1 FROM supervisores WHERE UPPER(nomeSupervisor) = ? OR matriculaSupervisor = ?",
    'secretaria' => "SELECT 1 FROM secretarias WHERE UPPER(nomeSecretaria) = ? OR UPPER(siglaSecretaria) = ?"

];

if (array_key_exists($name, $queryMap)) {
    $query = $queryMap[$name];
    $stmt = $conn->prepare($query);

    // Bind dos parâmetros de acordo com o tipo de campo
    if ($name === 'fornecedor' || $name === 'secretaria') {
        $stmt->bind_param('ss', $value, $value);
    } elseif ($name === 'supResponsavel') {
        if (is_numeric($value)) {
            $stmt->bind_param('si', $value, $value);
        } else {
            $stmt->bind_param('ss', $value, $value);
        }
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o registro existe
    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    $stmt->close();
} else {
    echo json_encode(['exists' => false, 'error' => 'Invalid input name']);
}

$conn->close();
?>
