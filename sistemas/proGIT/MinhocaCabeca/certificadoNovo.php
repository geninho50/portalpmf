<?php
include_once("banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT ID_PESSOA FROM usuario WHERE login = '$user' AND senha = '$pass'");

if(empty($gdb->gs["ID_PESSOA"][0])) {
    header('Location: minhocacabeca.php');
} else {
    $id_pessoa = $gdb->gs["ID_PESSOA"][0];

    require_once('fpdf.class.php');
    $pdf = new pdf('L');

    $pdf->Header("");
    $pdf->Footer("");
    $pdf->PDFTermo( $pdf, $gdb, $id_pessoa );
    $pdf->Output('certificadoMNC'.$id_pessoa.'.pdf', 'I');      
}
?>