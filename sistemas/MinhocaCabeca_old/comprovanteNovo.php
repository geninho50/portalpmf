<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("banco/gdb.php");
$gdb = new gdb();

print "<pre>"; 
print_r($_GET);
print_r($_POST);
print "</pre>";
dead();

$id_pessoa = $gdb->vargetpost('id_pessoa');

print "numero pessoa".$id_pessoa;

    require_once('fpdf.class.comprovante.php');
    $pdf = new pdf('L');

    $pdf->Header("");
    $pdf->Footer("");
    $pdf->PDFTermo( $pdf, $gdb, $id_pessoa );
    $pdf->Output('certificadoMNC'.$id_pessoa.'.pdf', 'I');      

?>