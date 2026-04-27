<?php
//https://pt.stackoverflow.com/questions/197656/validar-se-j%C3%A1-existe-registro-no-banco-antes-de-preencher-formulario
session_start();
include_once("conexao.php");

if (isset($_POST['cnpj'])) {
    #Recebe o cnpj Postado
    $cnpjPostado = $_POST['cnpj'];
    $cnpjquery = preg_replace( '/[^0-9]/is', '', $cnpjPostado );
    
        $result_usuario = $conn->prepare("SELECT * FROM sim.motofrete_empresas WHERE cnpj = :cnpj LIMIT 1");
        $result_usuario->bindParam(':cnpj', $cnpjquery, PDO::PARAM_INT);
        $result_usuario->execute();
        $count = $result_usuario->rowCount();
        $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

        if ($count != 0) {
            echo json_encode(array('cnpj' => TRUE));
        } 

        else {
            
            echo json_encode(array('cnpj' => FALSE));
        }
}
