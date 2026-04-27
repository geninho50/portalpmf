<?php

session_start();
include_once("conexao.php");

header('Content-type: text/html; charset=UTF-8');

if (isset($_POST['nome'])) {
    $nome =  $_POST['nome'];
    $nome = mb_strtoupper($nome, 'UTF-8');// troca tudo por maiusculo
} 

$cpf = $_POST['cpf'];
$cpf = (preg_replace("/[^0-9]/", "", $cpf));
$cnh = $_POST['cnh'];
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
$status = 1;
$data_criado = date("Y-m-d H:i:s");
$codigo_registro = substr(md5(mt_Rand()), 0, 4);
$data_nascimento = date('Y-m-d', strtotime($_POST['data_nascimento']));


//se o cadastro tem validade especifica - estudante e gestante - assume o que vem do formulario senao adiciona um ano
/*--------------------------------------------------------------------------------*
 * CRIA PROXIMO ID
 * ler da base o ultimo id
 * seta id + 1
/*--------------------------------------------------------------------------------*/

$sql = "SELECT id FROM sim.motofrete_profissional WHERE id=(select max(id) from sim.motofrete_profissional)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch();
$id = $row["id"] + 1;

$id_cadastro = "MTXP" . str_pad($id, 5, '0', STR_PAD_LEFT);

//$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_EMAIL); // sera anotado pelo validador SMPU em proximo passo

$query_03 = "SELECT * FROM sim.motofrete_profissional where id_cadastro = '$id_cadastro'";
$resultado_03 = $conn->query($query_03);
$count03 = $resultado_03->rowCount();

if ($count03 != 0) {
    "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mtp.php'>
	        ";
} else {

    $sql = 'INSERT INTO sim.motofrete_profissional
		(
			nome, 
            cpf,
            cnh,
			email,
            data_nascimento,
            cep, 
            rua, 
			complemento, 
			bairro, 
			cidade,
			uf, 
            id_cadastro,
            codigo_registro,
            data_criado,
            status

			 )
			
		VALUES 
		(
			:nome,
            :cpf,
            :cnh,
			:email, 
            :data_nascimento,
            :cep, 
            :rua, 
			:complemento, 
			:bairro, 
			:cidade,
			:uf, 
			:id_cadastro,
            :codigo_registro,
            :data_criado,
            :status
			
		)';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':cnh', $cnh);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':data_nascimento', $data_nascimento);
    $stmt->bindValue(':cep', $cep, PDO::PARAM_INT);
    $stmt->bindValue(':rua', $rua);
    $stmt->bindValue(':complemento', $complemento);
    $stmt->bindValue(':bairro', $bairro);
    $stmt->bindValue(':cidade', $cidade);
    $stmt->bindValue(':uf', $uf);
    $stmt->bindValue(':id_cadastro', $id_cadastro);
    $stmt->bindValue(':codigo_registro', $codigo_registro);
    $stmt->bindValue(':data_criado', $data_criado);
    $stmt->bindValue(':status', $status, PDO::PARAM_INT);

    $stmt->execute();

    $query_02 = "SELECT * FROM sim.motofrete_profissional where data_criado = '$data_criado' ";
    $resultado_02 = $conn->query($query_02);
    $count = $resultado_02->rowCount();

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
    </head>

    <body> <?php
            if ($count != 0) {
                echo "   
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mtp_ficha.php?id_cadastro=" . $id_cadastro . "' > 
                    ";
            } else {
                echo " 
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mtp.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>			
			";
            } ?>
    </body>

    </html>

<?php
} ?>