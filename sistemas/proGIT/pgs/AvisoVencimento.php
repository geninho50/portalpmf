<?php
ob_start(); // Inicia o buffer de saída

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include 'db/connect.php'; 
include_once('db/gdb_mysql.php'); 
require_once('db/gmailSender.class.php'); 

$gdb = new gdb(); 
$response = []; 

$gdb->open('SELECT nomeUsual as nome, vigenciaFinal as final, dias_para_vencer, siglaSecretaria FROM contratos_vigencia ORDER BY vigenciaFinal ASC');

if ($gdb->linhas > 0) {
    $resultadosContratosAVencer = $gdb->gs;
}

$contrato = $resultadosContratosAVencer
foreach ($contrato['NOME'] as $i => $value) {
    $gdb->open("SELECT supervisores.emailSupervisor, contratos.infoContratuais 
                FROM contratos
                    JOIN 
                        contratoXsupervisor ON contratos.idContrato = contratoXsupervisor.idContrato
                    JOIN 
                        supervisores ON contratoXsupervisor.idSupervisor = supervisores.idSupervisor
                    WHERE 
                        contratos.nomeUsual = '$i'");
    $emailSupervisores = $gdb->$gs['EMAILSUPERVISOR'];
    $emailSupervisores[] = 'suporte.pgs@pmf.sc.gov.br';
    $emailSupervisores = array_filter($emailSupervisores, function($value) {
        return $value !== 'Sem E-mail';
    });
    
    $infoContratuais = $gdb->$gs['INFOCONTRATUAIS'][0];

    $gdb->open("SELECT avisoEmail, aditivo FROM contratos WHERE nomeUsual = '$value'");
    if ($gdb->linhas > 0){
        $resultadoAvisoEmail = $gdb->$gs['AVISOEMAIL'][0];
        $resultadoAditivo = $gdb->$gs['ADITIVO'][0];
    }

    if ($resultadoAditivo) {
        if ($contrato['DIAS_PARA_VENCER'][$i] <= 180 && $resultadoAvisoEmail = 0) {
            // Email de contrato vencendo dentro de 180 dias ou menos
            foreach ($emailSupervisores as $email => $value) {
                $email = "$email"
                $nomeDestinatario = 'Gestão de Sistemas';
                $de = 'pgs.egov@pmf.sc.gov.br';
                $assunto = "Vencimento do contrato $i";
                $corpo = "Olá, o contrato $i com Info. Contratuais: $infoContratuais está a 180 dias de seu vencimento";

                if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
                    $response['success'] = true;
                    $response['message'] = 'E-mail enviado com sucesso.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Erro ao enviar e-mail.';
                }

                $gdb->opne("UPDATE contratos SET avisoEmail = 1 WHERE nomeUsual = '$i'");
            }
    
        } elseif ($contrato['DIAS_PARA_VENCER'][$i] <= 60 && $resultadoAvisoEmail = 1) {
            //Email de contrato vencendo dentro de 90 dias ou menos
            foreach ($emailSupervisores as $email => $value) {
                $email = "$email"
                $nomeDestinatario = 'Gestão de Sistemas';
                $de = 'pgs.egov@pmf.sc.gov.br';
                $assunto = "Vencimento do contrato $i";
                $corpo = "Olá, o contrato $i com Info. Contratuais: $infoContratuais está a 90 dias de seu vencimento";

                if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
                    $response['success'] = true;
                    $response['message'] = 'E-mail enviado com sucesso.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Erro ao enviar e-mail.';
                }

                $gdb->opne("UPDATE contratos SET avisoEmail = 2 WHERE nomeUsual = '$i'");
            }
    
        } elseif ($contrato['DIAS_PARA_VENCER'][$i] <= 30 && $resultadoAvisoEmail = 2) {
            //Email de contrato vencendo dentro de 30 dias ou menos
            foreach ($emailSupervisores as $email => $value) {
                $email = "$email"
                $nomeDestinatario = 'Gestão de Sistemas';
                $de = 'pgs.egov@pmf.sc.gov.br';
                $assunto = "Vencimento do contrato $i";
                $corpo = "Olá, o contrato $i com Info. Contratuais: $infoContratuais está a 30 dias de seu vencimento";

                if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
                    $response['success'] = true;
                    $response['message'] = 'E-mail enviado com sucesso.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Erro ao enviar e-mail.';
                }

                $gdb->opne("UPDATE contratos SET avisoEmail = 3 WHERE nomeUsual = '$i'");
            }

        } elseif ($contrato['DIAS_PARA_VENCER'][$i] <= 1 && $resultadoAvisoEmail = 3) {
            //Email de contrato vencendo dentro de 1 dias ou menos
            foreach ($emailSupervisores as $email => $value) {
                $email = "$email"
                $nomeDestinatario = 'Gestão de Sistemas';
                $de = 'pgs.egov@pmf.sc.gov.br';
                $assunto = "Vencimento do contrato $i";
                $corpo = "Olá, o contrato $i com Info. Contratuais: $infoContratuais está a 30 dias de seu vencimento";

                if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
                    $response['success'] = true;
                    $response['message'] = 'E-mail enviado com sucesso.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Erro ao enviar e-mail.';
                }

                $gdb->opne("UPDATE contratos SET avisoEmail = 3 WHERE nomeUsual = '$i'");
            }
        }
    } else {
        echo("Erro");
    }
   
    
    // echo "<td>" . $value . "</td>";
    // echo "<td>" . $contrato['SIGLASECRETARIA'][$i] . "</td>";
    // // Formatação da data para dd-mm-yyyy
    // $vigenciaFinalFormatted = date('d/m/Y', strtotime($contrato['FINAL'][$i]));
    // echo "<td>" . $vigenciaFinalFormatted . "</td>";
    // echo "<td>" . $contrato['DIAS_PARA_VENCER'][$i] . "</td>";
    // echo "</tr>";
}







// $email = 'guilherme.egov@pmf.sc.gov.br'
// $nomeDestinatario = 'Gestão de Sistemas';
// $de = 'pgs.egov@pmf.sc.gov.br';
// $assunto = 'Código de Redefinição de Senha';
// $corpo = "Olá, seu código de redefinição de senha é: $codeReset \n
//             Para redefinir senha, clique <a href='http://pgs.pmf.sc.gov.br/TelaReset.php'>AQUI</a>";

// if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
//     $response['success'] = true;
//     $response['message'] = 'E-mail enviado com sucesso.';
// } else {
//     $response['success'] = false;
//     $response['message'] = 'Erro ao enviar e-mail.';
// }

// ob_end_clean(); // Limpa o buffer de saída novamente antes de enviar a resposta JSON
// echo json_encode($response); 
// exit(); 


?>
