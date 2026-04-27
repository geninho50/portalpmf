<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

require 'http://redemobilidade.pmf.sc.gov.br/mail/PHPMailer/PHPMailerAutoload.php';
echo "email";
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'gabinete.smpu@gmail.com';
$mail->Password = 'gabinentesmpu2020';
//$mail->Port = 587;

$mail->setFrom('gabinete.smpu@gmail.com');
$mail->addReplyTo('gabinete.smpu@gmail.com');
$mail->addAddress('michelmittmann@gmail.com', 'Nome');
$mail->addAddress('michelmittmann@gmail.com', 'Contato');
$mail->addCC('mittmann.smpu@gmail.com', 'Cópia');
$mail->addBCC('mittmann.smpu@gmail.com', 'Cópia Oculta');

$mail->isHTML(true);
$mail->Subject = 'Assunto do email';
$mail->Body    = 'Este é o conteúdo da mensagem em <b>HTML!</b>';
$mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';
//$mail->addAttachment('/tmp/image.jpg', 'nome.jpg');
if(!$mail->send()) {
    echo 'Não foi possível enviar a mensagem.<br>';
    echo 'Erro: ' . $mail->ErrorInfo;
} else {
    echo 'Mensagem enviada.';
}