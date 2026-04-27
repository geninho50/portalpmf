<?php
session_start();
include_once("conexao.php");
include("mpdf60/mpdf.php");
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<?php
$id_cadastro = 200002;
//$id_cadastro = $_GET['id_cadastro']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM sim.moradores_costa where id_cadastro  = '$id_cadastro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

if ($resultado_02_count != 0) {
    while ($row = $resultado_02->fetch()) {
        $cabecalho = "
        <table style=\"height:200px\" width=\"100%\">
            <tr valign=\"bottom\">
            <td width=\"30%\"><img src=\"http://redemobilidade.pmf.sc.gov.br/bas/img/PMFSMPU.jpg\" ></td>
            <td width=\"30%\"></td>
            <td width=\"15%\"><img align=\"right\" src=\"http://redemobilidade.pmf.sc.gov.br/bas/img/REMOB_COR.jpg\" width=\"50%\"></td>
            </tr>
        </table>
        <br>
        ";
        $cadastro =
        "
        <fieldset>
        <h2 align=\"center\" >ANÁLISE CADASTRO: " .  $row['id_cadastro'] . " - Morador " . $row['categoria'] . " </h2>
        <table width=\"100%\">
            <tr>
                <th width=auto> NOME:</th> 
                <td>".$row['nome_passageiro']."</td>
            </tr>
            <tr>
                <th>CPF: </th>
                <td>".$row['cpf']."</td>
            </tr>
            <tr> 
                <th>RG: </th>
                <td>".$row['rg']."</td> 
            </tr>
            <tr>
                <th>E-mail: </th>
                <td>".$row['email']."</td>
            </tr>
            <tr> 
                <th>Telefone: </th>
                <td>".$row['telefone01']."</td> 
            </tr>
            <tr>
                <th>Endereço: </th>
                <td>".$row['rua'].", ".$row['complemento']."<br>".$row['bairro'].", ".$row['cidade']." - ".$row['uf']."
                </td>
            </tr>
        </table>
        <hr>
        <h3>Documentos para cadastro Morador:</h3>
        <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Documento de identidade<br>
        <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante de residência<br>
        ";
        $atestadogeral =
        "
        <fieldset><h3>Atesto que conferi e autorizo o cadastro de " . $row['nome_passageiro'] . " como:</h3>
        <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Moradora da Costa da Lagoa com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )). " <br>
        ";

        if ($row['categoria'] == "Estudante") {
            $complemento = "
           <h3>Documentos para cadastro Estudante:</h3>
            <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante de matrícula com validade até " . date ( "d/m/Y", strtotime( $row['data_validade_especial'] )). " 
            </fieldset>
            ";
            $atestado = "<img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Categoria Estudante com validade até " . date ( "d/m/Y", strtotime( $row['data_validade_especial'] )). "<br>";
            } 
        
        elseif ($row['categoria'] == "PCD com acompanhante") {
            $complemento = "
            <h3>Documentos para cadastro PCD:</h3>
            <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante ....
            </fieldset>
            ";
            $atestado = "<img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Categoria PCD com acompanhante<br>";
            } 
                        
        elseif ($row['categoria'] == "PCD") {
            $complemento = "
            <h3>Documentos para cadastro PCD:</h3>
            <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante ....
            </fieldset>
            ";
            }
        
        elseif ($row['categoria'] == "Gestante") {
            $complemento = "
            <h3>Documentos para cadastro Gestante:</h3>
            <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante ....
            </fieldset>
            ";
        }
        
        elseif ($row['categoria'] == "Idoso") {
            $complemento = "
            <h3>Documentos para cadastro Idoso:</h3>
            <img src=\"retangulo.jpg\" width=\"15\" height=\"15\"> Comprovante ....
            </fieldset>
            ";
        }
        
        else {
            $complemento = "
            </fieldset>
            ";
        }

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
        </fieldset>";
        
        $html = $cabecalho .  $cadastro  . $complemento  .$atestadogeral. $atestado  . $assinatura;

        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("css/estilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    };
};
