      <?php
      
      require 'mailer/PHPMailerAutoload.php';

       if (isset($_POST['assunto']) && !empty($_POST['assunto'])) {
                  $assunto = $_POST['assunto'];
       }
       if (isset($_POST['mensagem']) && !empty($_POST['mensagem'])) {
                  $mensagem = $_POST['mensagem'];
       }
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'gabinete.smpu@gmail.com';
    $mail->Password = 'gabinetesmpu2020';
    $mail->Port = 465;

    $mail->setFrom('gabinete.smpu@gmail.com', 'Contato');
    $mail->addAddress('michelmittmann@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = $assunto;
    $mail->Body    = nl2br($mensagem);
    $mail->AltBody = nl2br(strip_tags($mensagem));

    if(!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
    } else {
         header('Location: index.php?enviado');
    }

    ?>