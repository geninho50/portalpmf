<?php
//https://pt.stackoverflow.com/questions/197656/validar-se-j%C3%A1-existe-registro-no-banco-antes-de-preencher-formulario
session_start();
include_once("conexao.php");

if (isset($_POST['cpf'])) {
    #Recebe o cpf Postado
    $cpfPostado = $_POST['cpf'];
    $cpfquery = preg_replace( '/[^0-9]/is', '', $cpfPostado );
    
        $result_usuario = $conn->prepare("SELECT * FROM sim.moradores_costa WHERE cpf = :cpf LIMIT 1");
        $result_usuario->bindParam(':cpf', $cpfquery, PDO::PARAM_INT);
        $result_usuario->execute();
        $count = $result_usuario->rowCount();
        $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

        if ($count != 0) {
            echo json_encode(array('cpf' => TRUE));
        } 

        else {
            
            echo json_encode(array('cpf' => FALSE));
        }
}



