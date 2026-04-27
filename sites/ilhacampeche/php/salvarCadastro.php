<?php 

header("Cache-Control: no-cache, no-store, must-revalidate"); // Desativa o cache
header("Pragma: no-cache");

session_start();

$area = json_decode(file_get_contents('php://input'), true);


// include("/var/www/html/Biblioteca/db/gdbMinhoca.php");
include("/var/www/html/desenvolvimento/desenv1/IlhaCampeche/banco/gdb.php");


$gdb = new gdb();

$nome           = $area['nome'];
$cpf            = $area['cpf'];
$data           = $area['data'];
$email          = $area['email'];
$telefone       = $area['telefone'];
$cep            = str_replace('-','', $area['cep'] );
$municipio      = $area['municipio'];
$bairro         = $area['bairro'];
$endereco       = $area['endereco'];
$numero         = $area['numero'];
$complemento    = $area['complemento'];
$senha          = md5( $area['senha'] );

$sql = "INSERT INTO pessoa( pesnome,pescpf,pesnascimento,pesemail,pestelefone,peslogradouro,pesnumero,pescomplemento,pesbairro,Pesmunicipio,pescep,Pessenha) 
               VALUES('$nome' ,'$cpf', '$data', '$email', '$telefone', '$endereco','$numero', '$complemento','$bairro','$municipio' , '$cep', '$senha')";

if( $gdb->open($sql) ) {
    echo "1";    
} else {
    echo "Ocorreu algum erro da Gravacao !";    
}
/**/
?>