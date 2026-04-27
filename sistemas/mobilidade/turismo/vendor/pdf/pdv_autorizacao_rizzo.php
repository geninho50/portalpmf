<?php
include("mpdf60/mpdf.php");
include_once("conexao.php");

$id = $_POST['id'];

$query_02 = "SELECT * FROM rotativo.pdv WHERE id='$id'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

echo $resultado_02_count;

if ($resultado_02_count != 0) {
    while ($row = $resultado_02->fetch()) {

        $row['cnpj'];


        $teste = "
 <fieldset>
 <h2 class='center titulo'>AUTORIZAÇÃO PARA TRÂMITE DE DOCUMENTOS - CADASTRO: " .  $row['id'] . "
  <strong>" .  $row['nome_empresa'] . " - </strong>  <strong> " .  $row['cnpj'] . "</strong> </h2>
 <p>
 
 
 Eu, ".  $row['nome'] .",  representante da empresa " .  $row['nome_empresa'] . ", CNPj " .  $row['cnpj'] . ",
 autorizo a RIZZO PARKING AND
 MOBILITY S/A, CNPJ: 24.940.805/0001-83 proceder o encaminhamento da documentação exigida pela Chamada Pública 001/SMPU/2020, a qual será encaminhada para a análise da Secretaria Municipal de Mobilidade e Planejamento Urbano (SMPU), com vista ao credenciamento da referida empresa  para realizar a distribuição de Tickets/Cartão aos usuários através da instalação de PONTO DE VENDA (PDV)
 do sistema de estacionamento rotativo nas vias, logradouros e áreas públicas do município de Florianópolis. </p><br>
<br>
 <p>Florianópolis,  " .  $row['data_documentos_rizzo'] . ". </p>

 <br>
 <br>




<p>_________________________________________</p>
<p>".  $row['nome'] ."<br>
Representante da Empresa " .  $row['nome_empresa'] . "<br>
CNPj " .  $row['cnpj'] . "

</fieldset>

 ";
        $html = $teste;
        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("css/estilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();

        exit;
    };
};
