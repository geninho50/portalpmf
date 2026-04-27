<?php
session_start();
include_once("conexao.php");

$nome = $_POST['nome'];
$nome = strtoupper($nome);

$email = $_POST['email'];
$telefone_contato = $_POST['telefone_contato'];
$senha = $_POST['senha'];

$nome_orgao = $_POST['nome_orgao'];
$nome_orgao = strtoupper($nome_orgao);
$solicitacao = $_POST['solicitacao'];
$cpf = $_POST['cpf'];
$cpf = str_replace('.', '', $cpf);

$rg = $_POST['rg'];

$data_criado = date("Y-m-d H:i:s");

$sql = 'INSERT INTO rotativo.acesso_db
	(
  	nome, email, senha,  
    nome_orgao, telefone_contato,
    rg, 
    cpf, 
    solicitacao,
    status,
    data_criado

	) VALUES (
    :nome, :email, :senha,
    :nome_orgao,:telefone_contato,
    :rg, 
    :cpf, 
    :solicitacao,
    :status,   
    :data_criado
	)';

$stmt = $conn->prepare($sql);
$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':telefone_contato', $telefone_contato);
$stmt->bindValue(':senha', MD5($senha));
$stmt->bindValue(':nome_orgao', $nome_orgao);
$stmt->bindValue(':rg', $rg);
$stmt->bindValue(':cpf', $cpf, PDO::PARAM_INT);
$stmt->bindValue(':status', 1);
$stmt->bindValue(':data_criado', $data_criado);
$stmt->bindValue(':solicitacao', $solicitacao);
$stmt->execute();

$query_02 = "SELECT * FROM rotativo.acesso_db where data_criado = '$data_criado'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="javascript_frota.js"></script>
    <script src="sorttable.js"></script>

    <script type="text/javascript" src="jquery.quick.search.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>

    <!-- máscaras para input formularios !-->

</head>

<body>
    <div class="container" theme-showcase" role="main">
        <br>
        <div class="page-header rounded">
        <img src="http://redemobilidade.pmf.sc.gov.br/bas/img/cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container" role="main">
            <br>
            <h4 class="text-muted" align=center>Requerimento de Cadastramento</h4>
            <?php
            if (($resultado_02_count != 0)) { 
                while ($row_usuario = $resultado_02->fetch()) {
                    if (($row_usuario['status']) == 1) $status = "aguardando a análise. Você receberá confirmação por e-mail";?>


<div class="container border rounded border-primary" role="main">
                        <h3> Dados Cadastrados</h3><br>
                        <h5>Nome:</h5>
                        Nome: <?php echo $row_usuario['nome']; ?><br>
                        E-mail: <?php echo $row_usuario['email']; ?><br>
                        Telefone: <?php echo $row_usuario['telefone_contato']; ?><br>     <br>
                        <h5>Órgão:</h5>
                        Nome do Órgão: <?php echo $row_usuario['nome_orgao']; ?><br>    
                        <br>
                        <div class='alert alert-danger' role='alert'><b>Status do Processo: </b><?php echo $status; ?></div>
                    </div><br>
                            <div align=center><a href="http://redemobilidade.pmf.sc.gov.br/" class="btn btn-warning" align=center>Fechar | Voltar</a></div>
                            <br>
                    <?php
                    } ?>
                    <?php
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Não foi possível efetivar o cadastro!</div>";
                } ?>
                        </div>
                        <br>
                        <div class="p-3 mb-2 bg-primary text-white">
                            <h5> Prefeitura Municipal de Florianópolis</h5>
                            <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
                            Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
                        </div>
                        <br>
                    </div>
        </div>
    </div>
</body>
</html>