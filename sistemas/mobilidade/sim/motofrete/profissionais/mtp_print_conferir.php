<?php
session_start();
include_once("conexao.php");

// link geral do gerado de pdf - biblioteca mpdf
include("/home/www/sistemas/redemobilidade/bas/pdf/mpdf60/mpdf.php");

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<?php

$id_cadastro = $_GET['id_cadastro']; //recebe da pagina anterior o numero do cadastro 
$nome_fiscal = $_GET['nome_fiscal']; //recebe da pagina anterior o numero do cadastro 
//$matricula_fiscal = $_GET['matricula_fiscal']; //recebe da pagina anterior o numero do cadastro 

// Cria código de registro a ser validado (sempre que pedir para imprimir nova ficha um novo código será gerado)
$codigo_registro = substr(md5(mt_Rand()), 0, 4);

// Atualiza o código de registro na base - codigo_registro
$sql = "UPDATE sim.motofrete_profissional SET codigo_registro = :codigo_registro WHERE id_cadastro=:id_cadastro";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_cadastro', $id_cadastro);
$stmt->bindValue(':codigo_registro', $codigo_registro);
$stmt->execute();
$count = $stmt->rowCount();

$query_02 = "SELECT * FROM sim.motofrete_profissional where id_cadastro  = '$id_cadastro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

// Se existe resultado da pesquisa contagem do número de linhas roda a rotina !=0 (diferente de zero)

if ($resultado_02_count != 0) {
    while ($row = $resultado_02->fetch()) {

    // Pega a data e transfere para variável com formato dia-mes-ano (d-m-Y)

        $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));
        $cpf_view1 = substr($row['cpf'], -11,3);
                    $cpf_view2 = substr($row['cpf'], -8,3);
                    $cpf_view3 = substr($row['cpf'], -5,3);
                    $cpf_view4 = substr($row['cpf'], -2);
                    $cpf =  $cpf_view1.".". $cpf_view2.".".$cpf_view3."-". $cpf_view4;
      
    // GERANDO OS ELEMENTOS DA FICHA .pdf 
    // 1. GERA cabeçalho da ficha 

        $cabecalho = "
        <table style=\"height:200px\" width=\"100%\">
            <tr valign=\"bottom\">
            <td width=\"30%\"><img src=\"/home/www/sistemas/redemobilidade/bas/img/PMFSMPU.jpg\" ></td>
            <td width=\"30%\"></td>
            <td width=\"15%\"><img align=\"right\" src=\"/home/www/sistemas/redemobilidade/bas/img/REMOB_COR.jpg\" width=\"50%\"></td>
            </tr>
        </table>
        <br>
        ";

    // 2. GERA dados gerais do cadastro a serem impressos na ficha 

        $cadastro =
        "
        <fieldset>
        
        <table width=\"100%\">
        <tr>
        <td align=\"center\"><h2 align=\"center\" >ANÁLISE CADASTRO: " .  $row['id_cadastro'] ."</h2> </td>
        
        <td align=\"center\"><h2 align=\"center\" >CÓDIGO DE REGISTRO</h2></td>
        <td align=\"center\"><h2 align=\"center\" ><p style=\"color:red;\">".$codigo_registro."</p></h2></td>

        </tr>
        </table>
          
               
        <table width=\"100%\">

       
            <tr>
                <th width=auto> NOME:</th> 
                <td>".$row['nome']."</td>
                <th>Nascimento: </th>
                <td>".  $data_nascimento ."</td> 
            </tr>
           
            <tr> 
            <th width=auto> CPF:</th> 
            <td>".$row['cpf']."</td>
                <th>CNH: </th>
                <td>".$row['CNH']."</td> 
            </tr>
                <tr> 
        
        </tr>
            <tr>
                <th>Endereço: </th>
                <td>".$row['rua'].", ".$row['complemento']."<br>".$row['bairro'].", ".$row['cidade']." - ".$row['uf']."
                </td>
            </tr>
        </table>
        <hr>
        <h3>Documentos para cadastro de Profissional Motoboy/Motofretista:</h3>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\" width=\"15\" height=\"15\"> Cópia do Documento de identidade com foto<br>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Comprovante de residência<br>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\">NONONO<br>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\">NONONO<br>

        ";

    // 3. GERA trecho de atestado igual para todos 

        $atestadogeral = " <fieldset><h3>Atesto que conferi e autorizo, de acordo com a lei ____, DECRETO N° ____ o cadastro de " . $row['nome'] . ", CPF: " . $cpf .", como Profissional Motoboy/Motofretista";
      
    // 5. GERA o campo assinatura
        // 5.1. Analisa se não existe fiscal indicado para a ficha (SE IGUAL A "" - VAZIO) cria campo de assinatura para preencher a mão

        if ($nome_fiscal == "") { $assinatura = "
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
            </fieldset>       
            ";
        } 

        // 5.2. Senão (EXISTE) cria campo de assinatura com o nome e matrícula passada pelo formuário (no futuro vincular com base de dados de funcionários e fiscais)
            
        else {
            $assinatura = "
            <br><br><br>
            <table align=\"center\">
                <tr>
                <td align=\"center\" colspan=\"2\">__________________________________________ <br>".$nome_fiscal."</td>
                <br><br>
                </tr>
                <br>
              
            </table>
            </fieldset>       
            ";
        }
    
    // 6. GERA o arquivo PDF encadeando as partes definidas       
        
        $html = $cabecalho .  $cadastro  .$atestadogeral. $atestado  . $assinatura;

        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("/home/www/sistemas/redemobilidade/bas/pdf/css/mpdfestilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    };
};
