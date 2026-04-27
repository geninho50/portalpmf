<?php
session_start();

include_once('conexao.php');

// print "<pre>";
// print_r($_POST);
// print "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["matricula"];
    $opcao1 = $_POST["opcao1"];
    $opcao2 = $_POST["opcao2"];
    $opcao3 = $_POST["opcao3"];
    $opcao4 = $_POST["opcao4"];
    $opcao5 = $_POST["opcao5"];
    $opcao6 = $_POST["opcao6"];
    $opcao7 = $_POST["opcao7"];
    $opcao8 = $_POST["opcao8"];
    $opcao9 = $_POST["opcao9"];
    $opcao10 = $_POST["opcao10"];
    $comentario = $_POST["comentarios"];



    // Certifique-se de escapar os valores para evitar injeção de SQL
    // $username = mysqli_real_escape_string($conn, $username, $opcao1, $opcao2, $opcao3, $opcao4, $opcao5, $opcao6, $opcao7, $opcao8, $opcao9, $opcao10);


    // Hash a senha antes de salvar no banco de dados (recomendado)
    // print "variavel: ". $username;

    $sql = "INSERT INTO cadastro_sma (matricula, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8, pergunta9, pergunta10, comentarios) 
            VALUES ('$username', '$opcao1', '$opcao2', '$opcao3', '$opcao4', '$opcao5', '$opcao6', '$opcao7', '$opcao8', '$opcao9', '$opcao10', '$comentario' )";


    if ($conn->query($sql) === TRUE) {
        echo "Registro criado com sucesso";
        echo "<form name='form' action='index.html' >";
        echo "<input type='submit' value= 'Voltar' >";
        echo "</form>";
    } else {
        $mensagem = "Voce já Respondeu o questionario!";
        echo "<script>alert('$mensagem');</script>";
    }
}

$conn->close();
?>