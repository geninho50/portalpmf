<?php

require_once('../Biblioteca/FPDF/fpdf.php');

class pdf extends FPDF
{
	function PDFTermo( $pdf, $gdb, $id_pessoa ) {

        $pdf->SetMargins(40,40);	
    
        $gdb->open("SELECT p.id_pessoa, p.nome, p.email, DATE_FORMAT(p.data_inscricao,'%d/%m/%Y') AS data_e FROM minhocaCabeca.pessoa p  
                        WHERE p.id_pessoa = $id_pessoa");
        
        $pdf->AddPage();
        
        $hoje = date("d/m/Y");
    
        $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/img/comprovanteInscricao.png',02, 02, 290 ,205);// importa uma imagem  
 
        $id_pessoa = iconv('utf-8','iso-8859-1', $gdb->gs['ID_PESSOA'][0] );
        $pdf->SetXY(55,90);
        $pdf->SetFont('Arial','',32);   
        $pdf->Cell(180,1, $id_pessoa,0,0,'C');
        
        $nome = iconv('utf-8','iso-8859-1', $gdb->gs['NOME'][0] );
        $pdf->SetXY(55,115);
        $pdf->SetFont('Arial','',32);   
        $pdf->Cell(180,1, $nome,0,0,'C');

        $email = iconv('utf-8','iso-8859-1', $gdb->gs['EMAIL'][0] );
        $pdf->SetXY(55,143);
        $pdf->SetFont('Arial','',32);   
        $pdf->Cell(180,1, $email,0,0,'C');
        
        /*$pdf->SetXY(49,125);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1, date("d"),0,0,'C');	 */
        
        $pdf->SetXY(55,170);
        $pdf->SetFont('Arial','',32);   
        $pdf->Cell(180,1,$gdb->gs['DATA_E'][0],0,0,'C');	 
        /*
        $pdf->SetXY(58,106);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1,'20 de Janeiro a 27 de Mar�o de 2018',0,0,'L');	 	 
        */
    } 
}
?>
