<?php

session_start();
include_once("conexao.php");

header('Content-type: text/html; charset=UTF-8');
$razao_social = $_POST['razao_social'];

$razao_social = mb_strtoupper($razao_social, 'UTF-8');// troca tudo por maiusculo

$cnpj = $_POST['cnpj'];
$cnpj = (preg_replace("/[^0-9]/", "", $cnpj));
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
$data_abertura = date('Y-m-d', strtotime($_POST['data_abertura']));


//se o cadastro tem validade especifica - estudante e gestante - assume o que vem do formulario senao adiciona um ano
/*--------------------------------------------------------------------------------*
 * CRIA PROXIMO ID
 * ler da base o ultimo id
 * seta id + 1
/*--------------------------------------------------------------------------------*/

$sql = "SELECT id FROM sim.motofrete_empresas WHERE id=(select max(id) from sim.motofrete_empresas)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch();
$id = $row["id"] + 1;


$id_cadastro = "MTE" . str_pad($id, 5, '0', STR_PAD_LEFT);
echo $id_cadastro;

//$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_EMAIL); // sera anotado pelo validador SMPU em proximo passo

$query_03 = "SELECT * FROM sim.motofrete_empresas where id_cadastro = '$id_cadastro'";
$resultado_03 = $conn->query($query_03);
$count03 = $resultado_03->rowCount();

if ($count03 != 0) {
    "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mte.php'>
	        ";
} else {

    $sql = 'INSERT INTO sim.motofrete_empresas
		(
			razao_social, 
            cnpj,
			email,
            data_abertura,
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
			:razao_social,
            :cnpj,
			:email, 
            :data_abertura,
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
    $stmt->bindValue(':razao_social', $razao_social);
    $stmt->bindValue(':cnpj', $cnpj);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':data_abertura', $data_abertura);
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

    $query_02 = "SELECT * FROM sim.motofrete_empresas where data_criado = '$data_criado' ";
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
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mte_ficha.php?id_cadastro=" . $id_cadastro . "' > 
                    ";
            } else {
                echo " 
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mte.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>			
			";
            } ?>
    </body>

    </html>

<?php
} ?>