<?php 

// Permitir acesso de qualquer origem
header("Access-Control-Allow-Origin: *");

// Outros cabeçalhos CORS opcionais
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header("Cache-Control: no-cache, no-store, must-revalidate"); // Desativa o cache
header("Pragma: no-cache");

session_start();

$area = json_decode(file_get_contents('php://input'), true);



include("/home/www/sistemas/IlhaCampeche/banco/gdb.php");


$gdb = new gdb();

$nome           = $area['nome'];
$documento      = $area['documento'];
$data           = $area['data'];
$email          = $area['email'];
$telefone       = $area['telefone'];
$pais           = $area['pais'];
$senha          = md5( $area['senha'] );

// Consulta para verificar se já existe um registro com o mesmo CPF ou e-mail
$sql_verificar = "SELECT COUNT(*) AS total FROM pessoa WHERE pesdocumento = '$documento' OR pesemail = '$email'";
$gdb->open($sql_verificar);

if($gdb->gs['TOTAL'][0] > 0) {
    echo "Já existe um registro com o mesmo Documento ou e-mail.";
} else {
    // Se não houver nenhum registro com o mesmo CPF ou e-mail, insira os dados
    $sql = "INSERT INTO pessoa( pesnome,pesdocumento,pesnascimento,pesemail,pestelefone,pespais,Pessenha) 
                   VALUES     ('$nome' ,'$documento', '$data', '$email','$telefone','$pais','$senha')";
    
    if( $gdb->open($sql,1) ) {
        echo "1";    
    } else {
        echo "Ocorreu algum erro na Gravação!";
    }
}
/**/
?>