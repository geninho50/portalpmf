<?php
include("mpdf60/mpdf.php");
include_once("conexao.php");

$id = $_POST['id'];
$codigo = rand ( 100 , 999 );
echo $id;
echo $id;


$query_02 = "SELECT * FROM rotativo.pdv WHERE id='$id'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

echo $resultado_02_count;






if ($resultado_02_count != 0) {
    echo "alo mundo um codigo encontrado";

    while ($row = $resultado_02->fetch()) {

        $row['cnpj'];


        $teste = "
 <fieldset>
 <h2 class='center titulo'>RECIBO DE DOCUMENTOS - CADASTRO: " .  $row['id'] . "
  <strong>" .  $row['nome_empresa'] . " - </strong>  <strong> " .  $row['cnpj'] . "</strong> </h2>
 <p>Recebemos os documentos abaixo relacionados como parte da documentação exigida na Chamada Pública 001/SMPU/2020 que objetiva o 
 credenciamento da empresa <strong>" .  $row['nome_empresa'] . ", CNPJ  " .  $row['cnpj'] . "</strong>, com vista a realizar a distribuição de Tickets/Cartão aos usuários através da instalação de PONTO DE VENDA (PDV) do sistema de estacionamento rotativo nas vias, logradouros e áreas públicas do município de Florianópolis:

</p>        

<p> - Cópia da Cédula de identidade e Cadastro de Pessoa Física (CPF) do sócio ou representante legal.<br>
            - Cópia do Registro Comercial, no caso de empresa individual.:<br>
            - Cópia do Ato constitutivo, estatuto ou contrato social em vigor, devidamente registrado, em se tratando de sociedades comerciais, e, no caso de sociedades por ações, acompanhado de documentos de eleição de seus administradores.<br>
            - Cópia da Inscrição do ato constitutivo, no caso de sociedades civis, acompanhada de prova de diretoria em exercício.<br>
            - Prova de inscrição no Cadastro Nacional de Pessoa Jurídica (CNPJ).<br>
            - Prova de regularidade junto ao Fundo de Garantia por Tempo de Serviços (FGTS).<br>
            - Certidão Negativa de Débitos relativos aos Tributos Federais e a Dívida Ativa da União, inclusive os decorrentes da Lei Federal nº. 8.112/90;<br>
            - Certidão Negativa de Débito Estadual;<br>
            - Certidão Negativa de Débito Municipal.<br>
            - Declaração de que a empresa não emprega menores salvo na condição de aprendiz (inciso XXXIII do art. 7º da CF/88);<br>
            - Declaração negativa de vínculo empregatício com órgão ou entidade pública.<br>
</p>
<p> A RIZZO PARKING AND MOBILITY S/A,CNPJ: <strong>24.940.805/0001-83</strong> neste ato recebe os documentos apresentados e se compromete com a devida guarda e adequado encaminhamento para a apreciação da Secretaria de Mobilidade e Planejamento Urbano a qual emitirá deferimento ou indeferimento do processo.</p><p class='esquerda'>Florianópolis, </p>
<br>
Florianópolis,  " .  $row['data_documentos'] . "
<p>_________________________________________</p>
<p>RIZZO PARKING AND
MOBILITY S/A<br>CNPJ: <strong>24.940.805/0001-83</strong></p>

</fieldset>
<fieldset>
O resultado será publicado no DOM e o processo poderá ser acompanhado no site  http://espacospublicos.pmf.sc.gov.br/rotativo/pdv.html no link - <b> credenciado</b>:<br>

login: <strong>" .  $row['cnpj'] . "</strong> | código de acesso:  <strong>" .  $row['codigoacesso'] . "</strong><br>poderá ser utilizada senha cadastrada no pré-cadastro.


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
