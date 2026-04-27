<?
header("Content-Type: application/pdf; charset=utf-8");
require_once ("/usr1/wwwroot/sefin/PhpLibs/pdf/fpdf.php");
class docmpdf extends FPDF {

   var $instituicao = "Prefeitura Municipal de Florian\363polis";
   var $secretaria = "Secretaria Municipal da Fazenda";
   var $diretoria = "Diretoria do Sistema de Receitas e Tributos Municipais";
   var $gerencia = "Ger\352ncia do Cadastro Imobili\341rio";
   var $titulo = "";
   var $subtitulo = "";
   var $headerline = false;
   var $pageno = false;
   
   var $x1 = 0;
   var $x2 = 0;
   var $y1 = 0;
   var $y2 = 0;

   function docmpdf($or = "") {
      $this->FPDF();
      $this->SetFillColor(240, 240, 240);
   }

   function Style($style = "normal") {
      switch (strtoupper($style)) {
         case "H1":
            $this->SetFont('Arial', 'B', 18);
            break;
         case "H2":
            $this->SetFont('Arial', 'BI', 16);
            break;
         case "H3":
            $this->SetFont('Arial', 'B', 14);
            break;
         case "H4":
            $this->SetFont('Arial', 'BI', 12);
            break;
         case "H5":
            $this->SetFont('Arial', 'B', 10);
            break;
         default:
            $this->SetFont('Arial', '', 8);
            break;
      }
   }

   function Header() {
      $this->AliasNbPages();
      $this->Image('pmf.jpg', 8, 8, 20, 23); // importa uma imagem

      $this->SetFont('Arial', 'B', 12);
      $this->Text(30, 14, $this->instituicao);
      $this->Text(30, 18, $this->secretaria);
      $this->Text(30, 22, $this->diretoria);
      $this->Text(30, 26, $this->gerencia);

      $this->x1 = 10;
      $this->y1 = 33;
      $this->SetXY(-10, -20);
      $this->x2 = $this->GetX();
      $this->y2 = $this->GetY();
      
      if ($this->headerline){
         $this->Line($this->x1, $this->y1, $this->x2, $this->y1);   
      }

      $this->SetXY($this->x1, $this->y1);
      $this->CustomHeader();
   }
   
   function Footer() {
      $this->SetXY(-10, -5);
      $this->line(10, $this->GetY()-2, $this->GetX(), $this->GetY()-2);
      $this->SetXY(10, -5);
      $this->SetFont('Courier', 'BI', 8);
      
      if ($this->pageno){
         $this->Cell(0, 0, "Rua Arcipreste Paiva, n\272 107, 7\272 andar, Centro, Florian\363polis, CEP 88010\055530", 0, 0, 'C');
      } else {
         $this->Cell(0, 0, "Rua Arcipreste Paiva, n\272 107, 7\272 andar, Centro, Florian\363polis, CEP 88010\055530", 0, 0, 'C');
      }

      $this->SetXY(10, -3);
      $this->CustomFooter();
   }

   function getOutputFile($nomePdf)
   {
      $this->Output($nomePdf.".pdf","F");
   }

   function CustomHeader() {}
   function CustomFooter() {}
}
?>