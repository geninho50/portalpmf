<?php
session_start();

include_once("./src/database/conexao.php");
include_once("./src/database/calculaidade.php");
// link geral do gerado de pdf - biblioteca mpdf
include("/home/www/sistemas/mobilidade/bas/pdf/mpdf60/mpdf.php");


$aux = '/bas/qr_img0.50j/php/qr_img.php?';
$aux .= 'd=Criando QrCode no PHP&';
$aux .= 'e=H&';
$aux .= 's=10&';
$aux .= 't=J';
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<style>
    img.top {
        vertical-align: top;
    }

    img.middle {
        vertical-align: middle;
    }

    img.bottom {
        vertical-align: bottom;
    }
</style>
<?php




$id_viagem = $_GET['id_viagem']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM turismo.viagens WHERE id_viagem  = '$id_viagem'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();




if (($resultado_02_count != 0)) {

    while ($row = $resultado_02->fetch()) {

        $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
        $data_chegada = date('d-m-Y', strtotime($row['data_chegada']));
        $data_saida = date('d-m-Y', strtotime($row['data_saida']));

        // dados do veiculo
        $modelo = $row['modelo'];
        $placa = $row['placa'];
        $tipo = $row['tipo'];
        // dados da origem da viagem
        $logradouro_origem = $row['logradouro_origem'];
        $bairro_origem = $row['bairro_origem'];
        $cidade_origem = $row['cidade_origem'];
        $estado_origem = $row['estado_origem'];
        $pais_origem = $row['pais_origem'];
        $demais_referencias = $row['demais_referencias'];
        // decode json Contratantes
        $contratantes = $row['contratantes'];
        $array_contratantes = json_decode($contratantes, true);
        // decode json Motoristas
        $motoristas = $row['motoristas'];
        $array_motoristas = json_decode($motoristas, true);
        // decode json Rotas
        $rotas = $row['rotas'];
        $array_rotas = json_decode($rotas, true);
        // decode json Passageiros
        $passageiros = $row['passageiros'];
        $array_passageiros = json_decode($passageiros, true);

        $endereco = "http://redemobilidade.pmf.sc.gov.br/turismo/imprimir.php?id_viagem=".$id_viagem;

        $aux = '/bas/qr_img0.50j/php/qr_img.php?';
        $aux .= 'd=' . $endereco . '&';
        $aux .= 'e=H&';
        $aux .= 's=10&';
        $aux .= 't=J';




        $cabecalho = "
        <table style=\"height:200px\" width=\"100%\">
            <tr valign=\"bottom\">
            <td width=\"30%\"><img src=\"/home/www/sistemas/mobilidade/bas/img/PMFSMPU.jpg\" ></td>
            <td width=\"30%\"></td>
            <td width=\"15%\"><img align=\"right\" src=\"/home/www/sistemas/mobilidade/bas/img/REMOB_COR.jpg\" width=\"50%\"></td>
            </tr>
        </table>
        <br>
        ";


        $ficha_viagem = "
        
        <table height=\"500px\" width=\"100%\">
        <tr>
        <th><br>
     <h3> VIAGEM TURISMO: " .  $row['id_viagem'] . "<br>
        CÓDIGO DE REGISTRO: " .  $row['codigo_registro'] . "<br><br></h3> 
        Data de Chegada:" .  $data_chegada . "<br>
         Data de Retorno:" .  $data_saida . "<br>
        Data de Cadastro:" . $data_cadastro . "
        
        </th>
        
        <td width=\"180px\" align=\"center\" style=\"text-align:right vertical-align:bottom\">
<img width=\"170px\" src=\"" . $aux . "\" />
</td>
        
        </tr>

        </table>

        ";


        $ficha = "

        <fieldset>
        <h3 align=\"left\">Contratante</h3 > 
        <table width=\"100%\">
        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Nome: </b> </h4></td>
        <td width=\"80%\" align=\"left\">" . $array_contratantes['contratantes_nome'] . "</td>
        </tr>
        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Email: </b> </h4></td>
        <td width=\"80%\" align=\"left\">" . $array_contratantes['contratantes_email'] . "</td>
        </tr>

        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Telefone: </b></h4></td>
        <td width=\"80%\" align=\"left\">" . $array_contratantes['contratantes_telefone_com_ddd'] . "</td>
        </tr>
        
        <tr style=\"text-align:left vertical-align:top\">
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Endereço:</b></h4></td>
        <td width=\"80%\" align=\"left\">"
            . $array_contratantes['contratantes_logradouro'] . "<br>"
            . $array_contratantes['contratantes_bairro'] . " - "
            . $array_contratantes['contratantes_cidade'] . " - "
            . $array_contratantes['contratantes_pais'] . " - "
            . $array_contratantes['contratantes_estado'] . "<br>  
        </td>
        </tr>
        </table>

        <hr>

        <h3 align=\"left\">Origem</h3 > 
        <table width=\"100%\">
           
        <tr >
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Endereço:</b></h4></td>
        <td width=\"80%\" align=\"left\">"
            . $logradouro_origem . "<br>"
            . $bairro_origem . " - "
            . $cidade_origem . " - "
            . $estado_origem . " - "
            . $pais_origem . "<br>"
            . $demais_referencias . "<br>  
        </td>
        </tr>
        </table>
    
        <hr>
        <h3 align=\"left\">Veículo</h3 > 
        <table width=\"100%\">
        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Modelo: </b> </h4></td>
        <td width=\"80%\" align=\"left\">" . $modelo . "</td>
        </tr>
        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Placa: </b> </h4></td>
        <td width=\"80%\" align=\"left\">" . $placa . "</td>
        </tr>

        <tr>
        <td width=\"20%\" align=\"right\"><h4 align=\"center\" ><b class=\"text-muted\">Tipo: </b></h4></td>
        <td width=\"80%\" align=\"left\">" . $tipo . "</td>
        </tr>
        </table>
        <hr>
        <h3 align=\"left\">Motoristas</h3 > 

<table width=\"100%\" align=\"left\">
<tr style=\"text-align:left vertical-align:top\">
<td width=\"30%\" align=\"left\"><b class=\"text-muted\">Nome: </b></td>
<td width=\"20%\" align=\"left\"><b class=\"text-muted\">Documento: </b> </td>
<td width=\"20%\" align=\"left\"><b class=\"text-muted\">Telefone: </b> </td>
</tr>
</table>


";
        $ficha2 .= "<table width=\"100%\" border=\"1\">";

        foreach ($array_motoristas as $key => $value) {
            $ficha2 .= "
    
    <tr align=\"left\" style=\"text-align:left vertical-align:top\">
    <td width=\"30%\" align=\"left\">" . $value['motoristas_nome'] . "</td>
    <td width=\"20%\" align=\"left\">" . $value['motoristas_documento_habilitacao'] . " - " . $value['motoristas_orgao_emissor'] . " </td>
    <td width=\"20%\" align=\"left\">" . $value['motoristas_telefone_ddd'] . "</td>
    </tr>
    ";
        };
        $ficha2 .= "</table>";


        $fichapax = "

 <fieldset>

 
 <h3 align=\"left\">Lista de Passageiros</h3 > 

<table width=\"100%\" align=\"left\">
<tr style=\"text-align:left vertical-align:top\">
<td width=\"40%\" align=\"left\"><b class=\"text-muted\">Nome: </b></td>
<td width=\"20%\" align=\"left\"><b class=\"text-muted\">Data de Nascimento: </b> </td>
<td width=\"20%\" align=\"left\"><b class=\"text-muted\">Documento: </b> </td>
</tr>
</table>


";
        $fichapax2 .= "<table width=\"100%\" border=\"1\">";
        foreach ($array_passageiros as $key => $value) {
            $data = date('d-m-Y', strtotime($value['data_nascimento']));
            $fichapax2 .= "
<tr align=\"left\" style=\"text-align:left vertical-align:top\">
<td  width=\"40%\" align=\"left\"><b class=\"text-muted\">" . $value['nome'] . "</b></td>
<td align=\"left\" width=\"20%\">" . $value['data_nascimento'] . "</td>
<td align=\"left\" width=\"20%\">" . $value['tipo_documento'] . " - " . $value['documento'] . " - " . $value['orgao_emissor'] . " </td>
</tr>";
        };
        $fichapax2 .= "</table>";

        $fichaclose = "
</table>
</fieldset>
";

        $codigo =  "
<table width=\"100%\">
<tr>
<td>
<div style=\"float: left; border: 0px solid #100;\">
<img width=\"100%\" src=\"" . $aux . "\" />
</div></td>
</tr>
</table>   
   ";
    }

    // 6. GERA o arquivo PDF encadeando as partes definidas       

    $html = $cabecalho . $ficha_viagem . $ficha . $ficha2 . $fichaclose;
    $html2 = $cabecalho . $ficha_viagem . $fichapax . $fichapax2 . $fichaclose;
    $html3 = $cabecalho . $codigo . $ficha_viagem . $fichaclose;

    $mpdf = new mPDF();
    $mpdf->SetDisplayMode('fullpage');
    $css = file_get_contents("/home/www/sistemas/mobilidade/bas/pdf/css/mpdfestilo.css");
    $mpdf->WriteHTML($css, 1);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html2);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html3);

    $mpdf->Output();
    exit;
} else {
    echo "<div class='alert alert-danger' role='alert'>Não foi possível encontrar o cadastro!</div>";
} ?>