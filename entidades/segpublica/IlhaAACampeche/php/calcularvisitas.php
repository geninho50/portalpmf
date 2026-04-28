<?php 
header('Content-Type: application/json');
// header("Cache-Control: no-cache, no-store, must-revalidate"); // Desativa o cache
// header("Pragma: no-cache");

session_start();

$area = json_decode(file_get_contents('php://input'), true);

// include("/var/www/html/Biblioteca/db/gdbMinhoca.php");
include("/var/www/html/desenvolvimento/desenv1/IlhaCampeche/banco/gdb.php");

$gdb = new gdb();

$mes = $_POST['mes'] + 1;
$ano = $_POST['ano'];

$gdb->open(" select count(voudata) ocupacao,
                    voudata   
               from voucher vou, 
                    acompanhante aco
              where vou.voucodigo = aco.acovoucodigo
                and month( voudata ) = $mes
                and year( voudata ) = $ano               
          group by voudata");

$dados = array();

foreach( $gdb->gs['VOUDATA'] as $i=>$value ){
    $indice = substr($value,8,2);
    $dados[ $indice ] = $gdb->gs['OCUPACAO'][$i];
}

echo json_encode($dados);

?>