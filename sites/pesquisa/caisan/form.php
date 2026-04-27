<?php
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL);

session_start();

include_once('conexao.php');
include_once('/home/www/sistemas/Biblioteca/email/enviarEmailSuporte.php');

// print "<pre>";s
// print_r($_POST);
// print "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeCompleto = $_POST["nomeCompleto"];
    $emailContato = $_POST["emailContato"];
    $enderecoCompleto = $_POST["enderecoCompleto"];
    $inputBairro = $_POST["inputBairro"];
    $comentario = $_POST["comentario"];
    

    $sql = "INSERT INTO cadastro_gapre (nomeCompleto, emailContato, enderecoCompleto, bairro, comentario) 
            VALUES ('$nomeCompleto', '$emailContato', '$enderecoCompleto', '$inputBairro', '$comentario')";


    if ($conn->query($sql) === TRUE) {

     

        // Formatando o Email
        $assunto = 'Respostas do Plano Alimentar';
        $de = 'Sistema E-gov';    
        $corpo = "Segue abaixo os dados de $nomeCompleto:<br><br>".
                "E-mail: $emailContato<br><br>". 
                "Endereço: $enderecoCompleto<br><br>".             
                "Bairro: $inputBairro<br><br>".
                "Comentario:<br><br>".
                "<p>$comentario</p><br><br>";
                $corpo = iconv('utf-8','iso-8859-1', $corpo);

        emailAlimentar('caisan@pmf.sc.gov.br', $de, $nomeCompleto, $assunto, $corpo); 

        echo "Registro criado com sucesso";
        echo "<form name='form' action='index.html' >";
        echo "<input type='submit' value= 'Voltar' >";
        echo "</form>";
    }
}

$conn->close();
?>
