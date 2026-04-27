<?php
//https://pt.stackoverflow.com/questions/197656/validar-se-j%C3%A1-existe-registro-no-banco-antes-de-preencher-formulario
session_start();
include_once("conexao.php");

//teste de email na base

if (isset($_POST['operador_email'])) {

    #Recebe o email Postado
    $emailPostado = $_POST['operador_email'];

    $result_usuario = $conn->prepare("SELECT operador_email FROM turismo.operadores WHERE operador_email = :email LIMIT 1");
    $result_usuario->bindParam(':email', $emailPostado);
    $result_usuario->execute();
    $count = $result_usuario->rowCount();
    /* Exercise PDOStatement::fetch styles */
    $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

    if ($count != 0) {
        echo json_encode(array('operador_email' => TRUE));
    } else {
        echo json_encode(array('operador_email' => FALSE));
    }
}
