<?php

session_start();
include_once 'conexao.php';

//operador
header('Content-type: text/html; charset=UTF-8');
$operador_nome = $_POST['operador_nome'];
$operador_nome = mb_strtoupper($operador_nome, 'UTF-8'); // troca tudo por maiusculo
$operador_email = $_POST['operador_email'];
$operador_pais = $_POST['operador_pais'];
$operador_logradouro = $_POST['operador_logradouro'];
$operador_bairro = $_POST['operador_bairro'];
$operador_cidade = $_POST['operador_cidade'];
$operador_estado = $_POST['operador_estado'];
$operador_pais = $_POST['operador_pais'];
$operador_tipo_documento = $_POST['operador_tipo_documento'];
$operador_documento = $_POST['operador_documento'];
$senha = $_POST['operador_senha'];


if ($_REQUEST["operador_ddi"] && $_REQUEST["operador_ddd"] && $_REQUEST["operador_numero"]) {
  $operador_telefone = "+" . $_REQUEST["operador_ddi"] . " " . $_REQUEST['operador_ddd'] . " " . $_REQUEST['operador_numero'];
};

$data_cadastro = date("Y-m-d H:i:s");
$nivel_acesso = 1;

$sql = "INSERT INTO turismo.operadores
   (
    operador_nome,
    operador_logradouro,
    operador_bairro,
    operador_cidade,
    operador_estado,
    operador_pais,
    operador_tipo_documento,
    operador_documento,
    operador_email,
    operador_telefone_com_ddd,
    data_cadastro,
    nivel_acesso,
    senha
   
   )
   VALUES
   (
    :operador_nome,
    :operador_logradouro,
    :operador_bairro,
    :operador_cidade,
    :operador_estado,
    :operador_pais,
    :operador_tipo_documento,
    :operador_documento,
    :operador_email,
    :operador_telefone,
    :data_cadastro,
    :nivel_acesso,
    :senha
    
   )";


$stmt = $conn->prepare($sql);

//contratante individual

$stmt->bindValue(':operador_nome', $operador_nome);
$stmt->bindValue(':operador_logradouro', $operador_logradouro);
$stmt->bindValue(':operador_bairro', $operador_bairro);
$stmt->bindValue(':operador_cidade', $operador_cidade);
$stmt->bindValue(':operador_estado', $operador_estado);
$stmt->bindValue(':operador_pais', $operador_pais);
$stmt->bindValue(':operador_tipo_documento', $operador_tipo_documento);
$stmt->bindValue(':operador_documento', $operador_documento);
$stmt->bindValue(':operador_email', $operador_email);
$stmt->bindValue(':operador_telefone', $operador_telefone);
$stmt->bindValue(':data_cadastro', $data_cadastro);
$stmt->bindValue(':nivel_acesso', $nivel_acesso);
$stmt->bindValue(':senha', MD5($senha));

$stmt->execute();
$count = $stmt->rowCount();

$query_02 = "SELECT * FROM turismo.operadores where data_cadastro = '$data_cadastro' ";
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
          <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
          <script src='sweetalert2/dist/sweetalert2.all.min.js'></script>
          <script>Swal.fire(
            'Operadora cadastrada!',
            'Seu cadastro foi finalizado, você será redirecionado para a página de login',
            'success'
          ) 
          </script>";
          echo " 
          <META HTTP-EQUIV=REFRESH CONTENT = '5;URL=../login.php'>";


          // echo "Cadastrado" . "<br>"
          //   . $operador_nome . "<br>"
          //   . $operador_pais . "<br>"
          //   . $operador_email . "<br>";
        } else {
          echo " 
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
    <script type=\"text/javascript\">
      alert(\"Erro ao cadastrar.\");
    </script>			
  ";
        } ?>
</body>

</html>