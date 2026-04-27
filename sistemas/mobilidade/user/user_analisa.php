<?php
//https://pt.stackoverflow.com/questions/197656/validar-se-j%C3%A1-existe-registro-no-banco-antes-de-preencher-formulario
session_start();
include_once("conexao.php");

if (isset($_POST['cpf'])) {
    #Recebe o cpf Postado
    $cpfPostado = $_POST['cpf'];
    $cpfquery = preg_replace( '/[^0-9]/is', '', $cpfPostado );
    
        $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE cpf = :cpf LIMIT 1");
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

if (isset($_POST['email'])) {

    #Recebe o email Postado
    $emailPostado = $_POST['email'];

    $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE email = :email LIMIT 1");
    $result_usuario->bindParam(':email', $emailPostado);
    $result_usuario->execute();
    $count = $result_usuario->rowCount();
    /* Exercise PDOStatement::fetch styles */
    $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

    if ($count != 0) {
        echo json_encode(array('email' => TRUE));
    } else {
        echo json_encode(array('email' => FALSE));
    }
}

if (isset($_POST['usuario'])) {

    #Recebe o usuario Postado
    $usuarioPostado = $_POST['usuario'];

    $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE usuario = :usuario LIMIT 1");
    $result_usuario->bindParam(':usuario', $usuarioPostado);
    $result_usuario->execute();
    $count = $result_usuario->rowCount();
    /* Exercise PDOStatement::fetch styles */
    $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

    if ($count != 0) {
        echo json_encode(array('usuario' => TRUE));
    } else {
        echo json_encode(array('usuario' => FALSE));
    }
}

if (isset($_POST['nome'])) {

    #Recebe o nome Postado
    $nomePostado = $_POST['nome'];
    $nomePostado = strtoupper($nomePostado);

    $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE nome = :nome LIMIT 1");
    $result_usuario->bindParam(':nome', $nomePostado);
    $result_usuario->execute();
    $count = $result_usuario->rowCount();
    /* Exercise PDOStatement::fetch styles */
    $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

    if ($count != 0) {
        echo json_encode(array('nome' => TRUE));
    } else {
        echo json_encode(array('nome' => FALSE));
    }
}

if (isset($_POST['matricula'])) {
    #Recebe o cpf Postado
    $matriculaPostado = $_POST['matricula'];
   
        $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE matricula = :matricula LIMIT 1");
        $result_usuario->bindParam(':matricula', $matriculaPostado);
        $result_usuario->execute();
        $count = $result_usuario->rowCount();
        $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

        if ($count != 0) {
            echo json_encode(array('matricula' => TRUE));
        } 

        else {
            
            echo json_encode(array('matricula' => FALSE));
        }
}
// if (isset($_POST['smpusetor'] || $_POST['ipufsetor'] || $_POST['SECpmf'] || $_POST['entidade'])) {
//     $setorPostado = $_POST['smpusetor'] || $_POST['ipufsetor'] || $_POST['SECpmf'] || $_POST['entidade'];


//         $result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE setor = :setor LIMIT 1");
//         $result_usuario->bindParam(':setor', $setorPostado);
//         $result_usuario->execute();
//         $count = $result_usuario->rowCount();
//         $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);

//         if ($count != 0) {
//             echo json_encode(array('setor' => TRUE));
//         } 

//         else {
            
//             echo json_encode(array('setor' => FALSE));
//         }

// }