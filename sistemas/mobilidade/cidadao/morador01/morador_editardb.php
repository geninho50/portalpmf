<?php
session_start();
include_once("conexao.php");
header('Content-type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'pt_BR.UTF8');
$nome_passageiro =  $_POST['nome'];
$nome_passageiro = mb_strtoupper($nome_passageiro, 'UTF-8'); // troca tudo por maiusculo
$rg = $_POST['rg'] . "-" . strtoupper($_POST['rg_orgao']);
$data_nascimento = date('Y-m-d', strtotime($_POST['data_nascimento']));

$cep = $_POST['cep'];
$cep = (preg_replace("/[^0-9]/", "", $cep));
$rua = $_POST['rua'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];

$telefone01 = $_POST['telefone01'];
$telefone01 = preg_replace("/[^0-9]/", "", $telefone01);
$email = $_POST['email'];
$categoria = $_POST['categoria']; // ja vem do formulario padrao que a pessoa usa
$status = 1;
$data_criado = date("Y-m-d H:i:s");
$codigo_registro = substr(md5(mt_Rand()), 0, 4);
$id_cadastro = $_POST['id_cadastro'];

if ($categoria == "Morador") {
    $id_sufix = 1;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    // $data_validade_especial = $data_validade;
};
if ($categoria == "Estudante") {
    $id_sufix = 2;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    $data_validade_especial = date('Y-m-d', strtotime($_POST['validade1']));
};
if ($categoria == "PCD") {
    $id_sufix = 3;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    //$data_validade_especial = $data_validade;

};
if ($categoria == "PCD com acompanhante") {
    $id_sufix = 4;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    //$data_validade_especial = $data_validade;

};
if ($categoria == "Gestante") {
    $id_sufix = 5;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    $data_validade_especial = date('Y-m-d', strtotime($_POST['validade2']));
};
if ($categoria == "Idoso") {
    $id_sufix = 6;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    // $data_validade_especial = $data_validade;

};


//$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_EMAIL); // sera anotado pelo validador SMPU em proximo passo

$sql = "UPDATE sim.moradores_costa SET  
nome_passageiro = :nome_passageiro,
rg = :rg,
cep = :cep,
rua = :rua,
complemento = :complemento,
bairro = :bairro,
cidade = :cidade,
uf = :uf,
telefone01 = :telefone01,
email = :email,
data_criado = :data_criado,
data_validade_especial = :data_validade_especial,
data_nascimento = :data_nascimento

WHERE id_cadastro=:id_cadastro";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':nome_passageiro', $nome_passageiro);
$stmt->bindValue(':rg', $rg);
$stmt->bindValue(':cep', $cep, PDO::PARAM_INT);
$stmt->bindValue(':rua', $rua);
$stmt->bindValue(':complemento', $complemento);
$stmt->bindValue(':bairro', $bairro);
$stmt->bindValue(':cidade', $cidade);
$stmt->bindValue(':uf', $uf);
$stmt->bindValue(':telefone01', $telefone01);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->bindValue(':data_criado', $data_criado);
//$stmt->bindValue(':data_validade', $data_validade);
$stmt->bindValue(':data_validade_especial', $data_validade_especial);
$stmt->bindValue(':data_nascimento', $data_nascimento);

$stmt->bindValue(':id_cadastro', $id_cadastro);
$stmt->execute();

$query_03 = "SELECT * FROM sim.moradores_costa where id_cadastro = '$id_cadastro'";
$resultado_03 = $conn->query($query_03);
$count3 = $resultado_03->rowCount();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body> <?php
        if ($count != 3) {
            echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
                    <script type=\"text/javascript\">
                        alert(\"Cadastro Atualizado: " . $id_cadastro . "\");
                    </script>
                ";
        } else {
            echo "
                   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
                    <script type=\"text/javascript\">
                        alert(\"Erro ao tentar editar " . $id_cadastro . "\"\");
                    </script>
                ";
        } ?>
</body>
</html>