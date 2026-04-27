<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "desenvolvimento@pmf.sc.gov.br";
    $email_subject = "Inscrição do Programa Instituição Amiga do Empreendedor";

    function died($error) {
        // your error code can go here
        echo "Ocorreu um problema na submissão do formulário. ";
        echo "Os erros est�o abaixo:<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor corrija esses erros.<br /><br />";
        die();
    }

    // validation expected data exists
    if( !isset($_POST['nome']) ||
        !isset($_POST['sigla']) ||
        !isset($_POST['mantenedora']) ||
        !isset($_POST['endereco']) ||
        !isset($_POST['responsavel']) ||
        !isset($_POST['telefone']) ||
        !isset($_POST['email']))
    {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $nome                 = $_POST['nome'];
    $sigla                = $_POST['sigla'];
    $mantenedora          = $_POST['mantenedora'];
    $endereco             = $_POST['endereco'];
    $responsavel          = $_POST['responsavel'];
    $telefone             = $_POST['telefone'];
    $email                 = $_POST['email'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }

    $email_message .= "Nome da IES: ".clean_string($nome)."\n";
    $email_message .= "Sigla da IES: ".clean_string($sigla)."\n";
    $email_message .= "Mantenedora: ".clean_string($mantenedora)."\n";
    $email_message .= "Endereço: ".clean_string($endereco)."\n";
    $email_message .= "Responsável: ".clean_string($responsavel)."\n";
    $email_message .= "Telefone: ".clean_string($telefone)."\n";
    $email_message .= "E-mail: ".clean_string($email)."\n";

// create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    ?>

    <!-- include your own success html here -->

    Thank you for contacting us. We will be in touch with you very soon.

    <?php

}
?>