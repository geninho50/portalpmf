<?php

require_once('../Biblioteca/FPDF/fpdf.php');

class pdf extends FPDF
{
	function PDFTermo( $pdf, $gdb, $id_pessoa ) {

        $pdf->SetMargins(40,40);	
    
        $gdb->open("SELECT p.id_pessoa, p.nome, DATE_FORMAT(e.data,'%d/%m/%Y') AS data_e FROM minhocaCabeca.pessoa p 
                        LEFT JOIN minhocaCabeca.eventoInscricao ei ON p.id_pessoa = ei.id_pessoa
                        LEFT JOIN minhocaCabeca.evento e ON ei.id_evento = e.id_evento 
                        WHERE p.id_pessoa = $id_pessoa");
        /*Frente*/
        $pdf->AddPage();
        
        $hoje = date("d/m/Y");
    
        $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/img/certificadoFrente.png',02, 02, 290 ,205);// importa uma imagem  
        
        
        $nome = iconv('utf-8','iso-8859-1', $gdb->gs['NOME'][0] );
        $pdf->SetXY(57,110);
        $pdf->SetFont('Arial','',32);   
        $pdf->Cell(180,1, $nome,0,0,'C');
        
        $pdf->SetXY(42,155);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1, date("d"),0,0,'C');	 
        
        $mes = Array("Janeiro","Fevereiro","Mar�o","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
        
        $pdf->SetXY(70,155);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1, $mes[(date("m")-1)],0,0,'C');	
                
        $pdf->SetXY(20,155);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1, date("Y"),0,0,0,0,'C');
        /*verso*/
        $pdf->AddPage();
        
        $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/img/certificadoVerso.png',02, 02, 290 ,205);// importa uma imagem  

        $pdf->SetXY(77,98);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1,$gdb->gs['DATA_E'][0],0,0,'L');	 	 
        /*
        $pdf->SetXY(58,106);
        $pdf->SetFont('Arial','',11);   
        $pdf->Cell(180,1,'20 de Janeiro a 27 de Mar�o de 2018',0,0,'L');	 	 
        */
    } 
}
?>
