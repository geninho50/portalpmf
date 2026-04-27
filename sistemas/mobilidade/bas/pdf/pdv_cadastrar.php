<?php
session_start();
include_once("conexao.php");

$nome = $_POST['nome'];
$nome = strtoupper($nome);

$email = $_POST['email'];
$telefone_contato = $_POST['telefone_contato'];
$senha = $_POST['senha'];


$cnpj = $_POST['cnpj'];
$cnpj = str_replace('.', '', $cnpj); // "bbc" vira "aac"

$nome_empresa = $_POST['nome_empresa'];
$nome_empresa = strtoupper($nome_empresa);

$nome_socio1 = $_POST['nome_socio1'];
$nome_socio1 = strtoupper($nome_socio1);

$nome_socio2 = $_POST['nome_socio2'];
$nome_socio2 = strtoupper($nome_socio2);

$nome_socio3 = $_POST['nome_socio3'];
$nome_socio3 = strtoupper($nome_socio3);

$cpf01 = $_POST['cpf01'];
$cpf01 = str_replace('.', '', $cpf01);

$cpf02 = $_POST['cpf02'];
$cpf02 = str_replace('.', '', $cpf02);

$cpf03 = $_POST['cpf03'];
$cpf03 = str_replace('.', '', $cpf03);

$rg01 = $_POST['rg01'];
$rg02 = $_POST['rg02'];
$rg03 = $_POST['rg03'];

$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$rua = $_POST['rua'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];

$data_criado = date("Y-m-d H:i:s");

$sql = 'INSERT INTO rotativo.pdv
	(
  	nome, email, senha,  
    cnpj,nome_empresa, telefone_contato,
    
    nome_socio1, 
    nome_socio2, 
    nome_socio3,
    
    rg01, 
    rg02, 
    rg03, 

    cpf01, 
    cpf02, 
    cpf03, 

    cep,
    rua, complemento, bairro,    
    cidade,
    uf,
    status,
    data_criado

	) VALUES (

    :nome, :email, :senha,
    
    :cnpj,:nome_empresa,:telefone_contato,

    :nome_socio1, 
    :nome_socio2, 
    :nome_socio3, 

    :rg01, 
    :rg02, 
    :rg03, 

    :cpf01, 
    :cpf02, 
    :cpf03,

    :cep,    
    :rua, :complemento, :bairro,
    :cidade,
    :uf,

    :status,   
    :data_criado

	)';

$stmt = $conn->prepare($sql);

$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':email', $email);

$stmt->bindValue(':telefone_contato', $telefone_contato);
$stmt->bindValue(':senha', MD5($senha));


$stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_INT);
$stmt->bindValue(':nome_empresa', $nome_empresa);

$stmt->bindValue(':nome_socio1', $nome_socio1);
$stmt->bindValue(':nome_socio2', $nome_socio2);
$stmt->bindValue(':nome_socio3', $nome_socio3);

$stmt->bindValue(':rg01', $rg01);
$stmt->bindValue(':rg02', $rg02);
$stmt->bindValue(':rg03', $rg03);

$stmt->bindValue(':cpf01', $cpf01, PDO::PARAM_INT);
$stmt->bindValue(':cpf02', $cpf03, PDO::PARAM_INT);
$stmt->bindValue(':cpf03', $cpf02, PDO::PARAM_INT);


$stmt->bindValue(':cep', $cep);

$stmt->bindValue(':rua', $rua);
$stmt->bindValue(':complemento', $complemento);
$stmt->bindValue(':bairro', $bairro);
$stmt->bindValue(':cidade', $cidade);
$stmt->bindValue(':uf', $uf);
$stmt->bindValue(':status', 1);
$stmt->bindValue(':data_criado', $data_criado);

$stmt->execute();


$query_02 = "SELECT * FROM rotativo.pdv where data_criado = '$data_criado'";
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
            <img src="img\cabecalho_01.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container" role="main">
            <br>
            <h4 class="text-muted" align=center>Requerimento de Cadastramento</h4>

            <?php
            if (($resultado_02_count != 0)) { 
                while ($row_usuario = $resultado_02->fetch()) {
                    if (($row_usuario['status']) == 1) $status = "aguardando entrega de documentação para a análise";?>
                <br>
                    <div class="container border rounded border-primary" role="main">
                        <h3> Dados Cadastrados</h3><br>
                        <h5>Responsável pelo Cadastro:</h5>
                        Nome: <?php echo $row_usuario['nome']; ?><br>
                        E-mail: <?php echo $row_usuario['email']; ?><br>
                        Telefone: <?php echo $row_usuario['telefone_contato']; ?><br>     <br>
                        <h5>Dados da Empresa:</h5>
                        Nome da Empresa: <?php echo $row_usuario['nome_empresa']; ?><br>
                        CNPJ: <?php echo $row_usuario['cnpj']; ?><br>
                        Endereço:<br>
                        <?php echo $row_usuario['rua']; ?>, <?php echo $row_usuario['complemento']; ?> <br>
                        <?php echo $row_usuario['bairro']; ?>, <?php echo $row_usuario['cidade']; ?> - <?php echo $row_usuario['uf']; ?><br>
                        <br>
                        <div class='alert alert-danger' role='alert'><b>Status do Processo: </b><?php echo $status; ?></div>


                        
                </div>  <br>
                            <div align=center><a href="pdv.html" class="btn btn-warning" align=center>Fechar | Voltar</a></div>
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