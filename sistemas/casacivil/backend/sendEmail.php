<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
include_once("../../Biblioteca/email/enviarEmailPROCON.php"); 

$recaptcha_url      = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret   = '6LdMh58UAAAAAPIb6OU-JYB2op-el3tUW8HBY3ZP';
$recaptcha_response = $_POST['g-recaptcha-response'];

$recaptcha          = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
$recaptcha          = json_decode($recaptcha, true);


if (!$recaptcha['success']) {
    http_response_code(500);
    die();
}

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "suporteemail@pmf.sc.gov.br";
    $email_subject = "Solicitação de E-mail PMF";
    // $email_to = "suporteemail@pmf.sc.gov.br";

    function died($error) {
        // your error code can go here
        echo "Ocorreu um problema na submissão do formulário. ";
        echo "Os erros estão abaixo:<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor corrija esses erros.<br /><br />";
        die();
    }


    // validation expected data exists
    if( !isset($_POST['nome']) ||
        !isset($_POST['email']) ||
        !isset($_POST['emailPessoal']) ||
        !isset($_POST['telefone']) ||
        !isset($_POST['setor']) ||
        !isset($_POST['secretaria']) ||
        !isset($_POST['tipo']) ||
        !isset($_POST['matricula']))
    {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $nome                 = $_POST['nome'];
    $email                = $_POST['email'];
    $emailPessoal         = $_POST['emailPessoal'];
    $telefone             = $_POST['telefone'];
    $setor                = $_POST['setor'];
    $secretaria           = $_POST['secretaria'];
    $tipo                 = $_POST['tipo'];
    $matricula            = $_POST['matricula'];
    $email_message        = "";
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $email_from = "dgov@pmf.sc.gov.br";

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }

    $email_message .= "Nome: ".clean_string($nome)."<br>\n";
    $email_message .= "Setor: ".clean_string($setor)."<br>\n";
    $email_message .= "Secretaria: ".clean_string($secretaria)."<br>\n";
    $email_message .= "E-mail Pessoal: ".clean_string($emailPessoal)."<br>\n";
    $email_message .= "Telefone: ".clean_string($telefone)."<br>\n";
    $email_message .= "Matricula: ".clean_string($matricula)."<br>\n";
    $email_message .= "E-mail PMF: ".clean_string($email)."<br>\n";
    $email_message .= "Tipo: ".clean_string($tipo)."<br>\n";

    /* create email headers
    $headers = 'From: '.$email_from."\r\n".
               'Reply-To: '.$email_from."\r\n" .
               'X-Mailer: PHP/' . phpversion();
     */ 

    // $result_envio = mail($email_to, $email_subject, $email_message, $headers);
    
    $result_envio = smtpmailer($email_to,$email_from ,iconv('utf-8','iso-8859-1',"Sistema DGOV VPN"),  iconv('utf-8','iso-8859-1//TRANSLIT',$email_subject ), iconv('utf-8','iso-8859-1//TRANSLIT',$email_message) );					
    
    if( !$result_envio ){
        $errorMessage = error_get_last()['message'];
        print $errorMessage;
    }else print 'Resultado do envio : '.$result_envio.'Header : '.$headers;
} 
?>