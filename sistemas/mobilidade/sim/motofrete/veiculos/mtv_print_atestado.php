<?php
session_start();
include_once("conexao.php");

// link geral do gerado de pdf - biblioteca mpdf
include("/home/www/sistemas/mobilidade/bas/pdf/mpdf60/mpdf.php");


?>
<!DOCTYPE HTML>
<html lang="pt-br">
<?php

$id_cadastro = $_GET['id_cadastro']; //recebe da pagina anterior o numero do cadastro 
$nome_fiscal = $_GET['nome_fiscal']; //recebe da pagina anterior o numero do cadastro 
//$matricula_fiscal = $_GET['matricula_fiscal']; //recebe da pagina anterior o numero do cadastro 
$data_criado = date("Y-m-d H:i:s");

// Cria código de registro a ser validado (sempre que pedir para imprimir nova ficha um novo código será gerado)
$codigo_registro = substr(md5($id_cadastro . $data_criado), -17, 10);
$endereco="http://redemobilidade.pmf.sc.gov.br/sim/motofrete/empresas/mte_ficha.php?id_cadastro=MTE00004";

$aux = '/bas/qr_img0.50j/php/qr_img.php?';
			$aux .= 'd='. $endereco . '&';
			$aux .= 'e=H&';
			$aux .= 's=10&';
			$aux .= 't=J';


// Atualiza o código de registro na base - codigo_registro
$sql = "UPDATE sim.motofrete_empresas SET codigo_registro = :codigo_registro WHERE id_cadastro=:id_cadastro";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_cadastro', $id_cadastro);
$stmt->bindValue(':codigo_registro', $codigo_registro);
$stmt->execute();
$count = $stmt->rowCount();

$query_02 = "SELECT * FROM sim.motofrete_empresas where id_cadastro  = '$id_cadastro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

// Se existe resultado da pesquisa contagem do número de linhas roda a rotina !=0 (diferente de zero)

if ($resultado_02_count != 0) {
    while ($row = $resultado_02->fetch()) {

        // Pega a data e transfere para variável com formato dia-mes-ano (d-m-Y)

        $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));

        $cnpj_view1 = substr($row['cnpj'], -12, 2);
        $cnpj_view2 = substr($row['cnpj'], -10, 3);
        $cnpj_view3 = substr($row['cnpj'], -7, 3);
        $cnpj_view3 = substr($row['cnpj'], -3, 4);
        $cnpj_view4 = substr($row['cnpj'], -6, 4);
        $cnpj_view5 = substr($row['cnpj'], -2);
        $cnpj =  $cnpj_view1 . "." . $cnpj_view2 . "." . $cnpj_view3 . "/" . $cnpj_view4 . "-" . $cnpj_view5;;





        // GERANDO OS ELEMENTOS DA FICHA .pdf 
        // 1. GERA cabeçalho da ficha 

        $cabecalho = "
        <table style=\"height:200px\" width=\"100%\">
            <tr valign=\"bottom\">
            <td width=\"20%\"><img src=\"/home/www/sistemas/mobilidade/bas/img/PMFSMPU.jpg\" ></td>
            <td width=\"60%\"></td>
            <td width=\"10%\"><img align=\"right\" src=\"/home/www/sistemas/mobilidade/bas//img/REMOB_COR.jpg\" width=\"50%\"></td>
            </tr>
        </table>
        ";

        // 2. GERA dados gerais do cadastro a serem impressos na ficha 

        $cadastro =
            "
        <table width=\"100%\">
        <tr>
        <td align=\"center\"><h2 align=\"center\" >ATESTADO DE CADASTRO DE EMPRESA <br> MOTOFRETE/MOTOBOY " .  $row['id_cadastro'] . "</h2> </td>
        </tr>
        </table>
               

        ";

        // 3. GERA trecho de atestado igual para todos 

        $atestadogeral = " <h3>Atesto que a empresa " . $row['razao_social'] . " , CNPJ: " . $cnpj . ", está cadastrada na Secretaria Municipal de Mobilidade e Planejamento Urbano 
        , de acordo com a lei ____, DECRETO N° ____, como empresa de Motofrete.</h3>
        <br>
        <h2 align=\"center\" > DADOS DA EMPRESA</h2> 
       
        <table width=\"100%\">
        <tr>
            <th width=auto> RAZÃO SOCIAL:</th> 
            <td >" . $row['razao_social'] . "</td>
        </tr>


        <tr> 
        <th width=auto> CNPJ:</th> 
        <td>" . $row['cnpj'] . "</td>
    </tr>
        <tr>
            <th width=\"20%\">Data de Abertura: </th>
            <td>" .  $data_abertura . "</td> 
        </tr>
        <tr>
            <th width=\"20%\">Data de Cadastro: </th>
            <td>" .  $data_criado . "</td> 
        </tr>
      
        <tr>
            <th>Endereço: </th>
            <td>" . $row['rua'] . ", " . $row['complemento'] . ". " . $row['bairro'] . ", " . $row['cidade'] . " - " . $row['uf'] . "
            </td>
        </tr>
    </table>"
        
        
        ;



        // 5. GERA o campo assinatura
        // 5.1. Analisa se não existe fiscal indicado para a ficha (SE IGUAL A "" - VAZIO) cria campo de assinatura para preencher a mão

        if ($nome_fiscal == "") {
            $assinatura = "
            <br><br><br>
            <table align=\"center\">
                <tr>
                <td align=\"center\" colspan=\"2\">__________________________________________ <br>Assinatura do Fiscal</td>
                <br><br>
                </tr>
                <br>
                <tr>
                <td align=\"center\">_______________________________________________ <br> Nome do fiscal</td>
                <td align=\"center\">_________________________________ <br> Matrícula</td>
                </tr>
             
            </table>
            ";
        }

        // 5.2. Senão (EXISTE) cria campo de assinatura com o nome e matrícula passada pelo formuário (no futuro vincular com base de dados de funcionários e fiscais)

        else {
            $assinatura = "
            <br><br>
            <table align=\"center\">
                <tr>
                <td align=\"center\">__________________________________________ <br>" . $nome_fiscal . "</td>
                </tr>
              
            </table>
         ";
        }

        $codigo =  "
        <table width=\"100%\">
        <tr>
        <td align=\"right\"><h3 align=\"right\" >CÓDIGO DA EMPRESA: " .  $row['id_cadastro'] . "</h3> 
        <h3 align=\"right\">Chave de verificação: " . $codigo_registro . "</h3></td>
       
        <td width=\"auto\">
        <div style=\"float: left; border: 0px solid #000;\">
        <img width=\"300 px%\" src=\"". $aux . "\" />
    </div></td>
        </tr>
        </table>   
           ";

        // 6. GERA o arquivo PDF encadeando as partes definidas       

        $html =  $cabecalho . "<fieldset>" . $cadastro  . $atestadogeral . $atestado  . $assinatura . "</fieldset>" . "<fieldset>" .   $codigo . "</fieldset>" ;

        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("/home/www/sistemas/mobilidade/bas/pdf/css/mpdfestilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    };
};
