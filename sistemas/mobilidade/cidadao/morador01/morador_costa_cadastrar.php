<?php

session_start();
include_once("conexao.php");

header ('Content-type: text/html; charset=UTF-8');

$nome_passageiro =  $_POST['nome'];
$nome_passageiro = mb_strtoupper($nome_passageiro,'UTF-8'); // troca tudo por maiusculo

$cpf = $_POST['cpf'];
$cpf = (preg_replace("/[^0-9]/", "", $cpf));

$rg = $_POST['rg'] . "-" . strtoupper($_POST['rg_orgao']);

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
$data_nascimento = date('Y-m-d', strtotime($_POST['data_nascimento']));


//se o cadastro tem validade especifica - estudante e gestante - assume o que vem do formulario senao adiciona um ano
/*--------------------------------------------------------------------------------*
 * CRIA PROXIMO ID
 * ler da base o ultimo id
 * seta id + 1
/*--------------------------------------------------------------------------------*/

$sql = "SELECT id FROM sim.moradores_costa  WHERE id=(select max(id) from sim.moradores_costa)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch();
$id = $row["id"] + 1;

if ($categoria == "Morador") {
    $id_sufix = 1;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
   $data_validade_especial = $data_validade;
};
if ($categoria == "Estudante") {
    $id_sufix = 2;
    $data_validade_especial = date('Y-m-d', strtotime($_POST['validade1']));
    $data_validade = $data_validade_especial;

};
if ($categoria == "PCD") {
    $id_sufix = 3;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    $data_validade_especial = $data_validade;

};
if ($categoria == "PCD com acompanhante") {
    $id_sufix = 4;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    $data_validade_especial = $data_validade;

};
if ($categoria == "Gestante") {
    $id_sufix = 5;
    $data_validade_especial = date('Y-m-d', strtotime($_POST['validade2']));
    $data_validade = $data_validade_especial;

};
if ($categoria == "Idoso") {
    $id_sufix = 6;
    $data_validade = date('Y-m-d', strtotime('+1 year', strtotime($data_criado)));
    $data_validade_especial = $data_validade;
};

if ($categoria == "Acompanhante Aluno Infantil") {
    $id_sufix = 7;
        $data_validade_especial = date('Y-m-d', strtotime($_POST['validade1']));
        $data_validade = $data_validade_especial;
};

$id_cadastro = $id_sufix . str_pad($id, 5, '0', STR_PAD_LEFT);

//$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_EMAIL); // sera anotado pelo validador SMPU em proximo passo

$query_03 = "SELECT * FROM sim.moradores_costa where id_cadastro = '$id_cadastro'";
$resultado_03 = $conn->query($query_03);
$count03 = $resultado_03->rowCount();

if ($count03 != 0) {
    "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
	        ";
} else {


    $sql = 'INSERT INTO sim.moradores_costa 
		(
			nome_passageiro,
			cpf,
            rg,
			cep,
			rua, 
			complemento, 
			bairro, 
			cidade,
			uf, 
			telefone01, 
			email, 
			categoria,
			data_criado,
            data_validade,
            data_validade_especial,
            data_nascimento,
			id_cadastro,
            codigo_registro,

			status
			 )
			
		VALUES 
		(
			:nome_passageiro,
			:cpf,
            :rg,
			:cep,
			:rua, 
			:complemento, 
			:bairro, 
			:cidade,
			:uf, 
			:telefone01, 
			:email, 
			:categoria,
			:data_criado,
            :data_validade,
            :data_validade_especial,
            :data_nascimento,
			:id_cadastro,
            :codigo_registro,
			:status
			
		)';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nome_passageiro', $nome_passageiro);
    $stmt->bindValue(':rg', $rg);
    $stmt->bindValue(':cpf', $cpf, PDO::PARAM_INT);
    $stmt->bindValue(':cep', $cep, PDO::PARAM_INT);
    $stmt->bindValue(':rua', $rua);
    $stmt->bindValue(':complemento', $complemento);
    $stmt->bindValue(':bairro', $bairro);
    $stmt->bindValue(':cidade', $cidade);
    $stmt->bindValue(':uf', $uf);
    $stmt->bindValue(':telefone01', $telefone01);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':categoria', $categoria);
    $stmt->bindValue(':status', $status, PDO::PARAM_INT);
    $stmt->bindValue(':codigo_registro', $codigo_registro);
    $stmt->bindValue(':data_criado', $data_criado);
    $stmt->bindValue(':data_validade', $data_validade);
    $stmt->bindValue(':data_validade_especial', $data_validade_especial);
    $stmt->bindValue(':data_nascimento', $data_nascimento);
    $stmt->bindValue(':id_cadastro', $id_cadastro);

    $stmt->execute();

    $query_02 = "SELECT * FROM sim.moradores_costa where data_criado = '$data_criado'";
    $resultado_02 = $conn->query($query_02);
    $count = $resultado_02->rowCount();

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
    </head>

    <body> <?php
            if ($count != 0) {echo
                " 
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_ficha.php?id_cadastro=" . $id_cadastro . "' > 
	        ";
            } else {
                echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>
			";
            } ?>
    </body>

    </html>

<?php
} ?>

















