<?php
session_start();
include_once("conexao.php");
//include_once("upload_ftp.php");

$nome_passageiro = $_POST['nome'];
$nome_passageiro = strtoupper($nome_passageiro); // troca tudo por maiusculo

$cpf = $_POST['cpf'];
$cpf = (preg_replace("/[^0-9]/", "", $cpf));

$rg = $_POST['rg'];
$rg = (preg_replace("/[^0-9]/", "", $rg));

$cep = $_POST['cep'];
$cep = (preg_replace("/[^0-9]/", "", $cep));

$rua = $_POST['rua'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];

$telefone01 = $_POST['telefone'];
$telefone01 = preg_replace("/[^0-9]/", "", $telefone01);
$email = $_POST['email'];

$categoria = 'morador costa da lagoa'; // ja vem do formulario padrao que a pessoa usa
$status = 1;
$data_criado = date("Y-m-d H:i:s"); // moradores_costa.data_criacao

//$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_EMAIL); // sera anotado pelo validador SMPU em proximo passo

echo nl2br ($nome_passageiro . "\n");
echo nl2br ($cpf . "\n");
echo nl2br ($cep . "\n");
echo nl2br ($rg . "\n");

echo nl2br ($rua . "\n");
echo nl2br ($complemento . "\n");
echo nl2br ($bairro . "\n");
echo nl2br ($cidade . "\n");
echo nl2br ($uf . "\n");
echo nl2br ($telefone01 . "\n");
echo nl2br ($email . "\n");
echo nl2br ($categoria . "\n");
echo nl2br ($status . "\n");
echo nl2br ($data_criado . "\n");


//$file_imagem = filter_input(INPUT_POST, 'file_imagem');
//$file_documento = filter_input(INPUT_POST, 'file_documento'); 
//$file_comprovante_residencia = filter_input(INPUT_POST, 'file_comprovante_residencia'); 


$sql = 'INSERT INTO sim.moradores_costa
		(
			nome_passageiro, 
			cpf, rg,
			cep,
			rua, 
			complemento, 
			bairro, 
			cidade, 
			uf, 
			telefone01, 
			email, 
			categoria,
			status,
			data_criado
		)
		VALUES 
		(
			:nome_passageiro, 
			:cpf,:rg,
 
			:cep,
			:rua, 
			:complemento, 
			:bairro, 
			:cidade, 
			:uf, 
			:telefone01, 
			:email, 
			:categoria, 
			:status,
			:data_criado
		)';

$stmt = $conn->prepare ($sql);

$stmt->bindValue(':nome_passageiro', $nome_passageiro);
$stmt->bindValue(':cpf', $cpf, PDO::PARAM_INT);
$stmt->bindValue(':rg', $rg, PDO::PARAM_INT);

$stmt->bindValue(':cep', $cep, PDO::PARAM_INT);
$stmt->bindValue(':rua', $rua);
$stmt->bindValue(':complemento', $complemento);
$stmt->bindValue(':bairro', $bairro);
$stmt->bindValue(':cidade', $cidade);
$stmt->bindValue(':uf', $uf);
$stmt->bindValue(':telefone01', PDO::PARAM_INT);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':categoria', $categoria);
$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->bindValue(':data_criado', $data_criado);
$stmt->execute();
$count = $stmt->rowCount();


?>



?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>

    <body> <?php
        if($count != 0){
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=moradores.php'>
                <script type=\"text/javascript\">
                    alert(\"Cadastro efetuado.\");
                </script>    
            ";	
        }else{
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=moradores.php'>
                <script type=\"text/javascript\">
                    alert(\"Erro ao cadastrar.\");
                </script>
            ";	
        }?>
    </body>
</html>