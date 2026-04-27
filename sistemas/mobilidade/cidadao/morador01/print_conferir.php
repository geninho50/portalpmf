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
$sql = "UPDATE sim.moradores_costa SET codigo_registro = :codigo_registro WHERE id_cadastro=:id_cadastro";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_cadastro', $id_cadastro);
$stmt->bindValue(':codigo_registro', $codigo_registro);
$stmt->execute();
$count = $stmt->rowCount();

$query_02 = "SELECT * FROM sim.moradores_costa where id_cadastro  = '$id_cadastro'";
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
        <h2 align=\"center\" >ANÁLISE CADASTRO: " .  $row['id_cadastro'] . "- ". $row['categoria'] . " </h2>
        <table width=\"100%\">
            <tr>
                <th width=auto> NOME:</th> 
                <td>".$row['nome_passageiro']."</td>
            </tr>
            <tr>
                <th>CPF: </th>
                <td>".$cpf."</td>
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
            <th>Nascimento: </th>
            <td>".  $data_nascimento ."</td> 
        </tr>
            <tr>
                <th>Endereço: </th>
                <td>".$row['rua'].", ".$row['complemento']."<br>".$row['bairro'].", ".$row['cidade']." - ".$row['uf']."
                </td>
            </tr>
        </table>
        <hr>
        <h3>Documentos para cadastro Morador:</h3>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\" width=\"15\" height=\"15\"> Cópia do Documento de identidade com foto<br>
        <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Comprovante de residência<br>
        ";

    // 3. GERA trecho de atestado igual para todos 

        $atestadogeral = " <fieldset><h3>Atesto que conferi e autorizo, de acordo com o DECRETO N° 21.960, de 04 de setembro de 2020, o cadastro de " . $row['nome_passageiro'] . ", CPF: " . $cpf .", como Morador da Costa da Lagoa";

    // 4. GERA de compleemento de acordo com a categoria e respectiva validade

        if ($row['categoria'] == "Morador") {
            $complemento = "";
            $atestado = " com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )). ".</h3><br>";
            } 

        elseif ($row['categoria'] == "Estudante") {
            $complemento = "
           <h3>Documentos para cadastro Estudante:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Atestado de matrícula atualizada com validade até " . date ( "d/m/Y", strtotime( $row['data_validade_especial'] )). " 
            </fieldset>
            ";
            $atestado = " na Categoria Estudante com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )). ".</h3><br>";
            } 
        
        elseif ($row['categoria'] == "PCD com acompanhante") {
            $complemento = "
            <h3>Documentos para cadastro PCD:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Atestado médico que comprove a deficiência permanente, obrigatoriamente contendo número da Classificação Internacional de Doenças-CID
            </fieldset>
            ";
            $atestado = " na Categoria <b>PCD com acompanhante</b> com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )).".</h3><br>";            
            } 
                        
        elseif ($row['categoria'] == "PCD") {
            $complemento = "
            <h3>Documentos para cadastro PCD:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Atestado médico que comprove a deficiência permanente, obrigatoriamente contendo número da Classificação Internacional de Doenças-CID
            </fieldset>
            ";
            $atestado = " na Categoria <b>PCD</b> com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )).".</h3><br>";  
            }
        
        elseif ($row['categoria'] == "Gestante") {
            $complemento = "
            <h3>Documentos para cadastro Gestante:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Atestado médico informando a data final do pré-natal
            </fieldset>
            ";
            $atestado = " na Categoria <b>Gestante</b> com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )).".</h3><br>";  
        }
        
        elseif ($row['categoria'] == "Idoso") {
            $complemento = "
            <h3>Documentos para cadastro Idoso:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Aferi, conforme a data de nascimento que tem mais de 65 anos.
            </fieldset>
            ";
            $atestado = " na Categoria <b>Idoso</b> com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )).".</h3><br>";  

        }

        elseif ($row['categoria'] == "Acompanhante Aluno Infantil") {
            $complemento = "
            <h3>Documentos para cadastro Mãe de Aluno do Ensino Infantil Municipal:</h3>
            <img src=\"/home/www/sistemas/redemobilidade/bas/img/form/quadrado_round.png\"  width=\"15\" height=\"15\"> Atestado de matrícula do filho matriculado em escola do Ensino Infantil Municipal com vigência até 31 de dezembro do ano corrente
            </fieldset>
            ";
            $atestado = " na Categoria <b>Mãe de Aluno do Ensino Infantil Municipal meno de 5 anos,</b> com validade até " . date ( "d/m/Y", strtotime( $row['data_validade'] )).".</h3><br>";  

        }

        else {
            $complemento = "
            </fieldset>
            ";
        }


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
                <tr>
                <td colspan=\"2\" align=\"center\"><br><h3>CÓDIGO DE REGISTRO<h3><h1> ".$codigo_registro."</h1></td>
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
                
                <tr>
                <td colspan=\"2\" align=\"center\"><br><h3>CÓDIGO DE REGISTRO<h3><h1> ".$codigo_registro."</h1></td>
                </tr>
            </table>
            </fieldset>       
            ";
        }
    
    // 6. GERA o arquivo PDF encadeando as partes definidas       
        
        $html = $cabecalho .  $cadastro  . $complemento  .$atestadogeral. $atestado  . $assinatura;

        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("/home/www/sistemas/redemobilidade/bas/pdf/css/mpdfestilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    };
};
