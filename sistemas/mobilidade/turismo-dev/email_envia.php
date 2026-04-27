<?php

include_once("./src/conexao.php");

// link geral do gerado de pdf - biblioteca mpdf

$cod_registro = $_GET['cod_registro']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM turismo.viagens WHERE cod_registro  = '$cod_registro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

if ($resultado_02_count != 0)

{

    while ($row = $resultado_02->fetch())
    {

        $id_viagem = $row['id_viagem'];
        $cod_registro = $row['cod_registro'];
        $chave_acesso = $row['chave_acesso'];
        $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
        $data_chegada = date('d-m-Y', strtotime($row['data_chegada']));
        $data_saida = date('d-m-Y', strtotime($row['data_saida']));
        $contratantes_email = $row['contratantes_email'];
        $contratantes_nome = $row['contratantes_nome'];
        $contratantes_pais = $row['contratantes_pais'];
    
        $placa = $row['placa'];
        $tipo = $row['tipo'];
          
        $destino =  $contratantes_email;
        $assunto = "Registro de Viagem: $cod_registro";
       
        include ('email_conteudo.php');

      
        // É necessário indicar que o formato do e-mail é html
        $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: redemobilidade@gmail.com<&email>';
        //$headers .= "Bcc: $EmailPadrao\r\n";
        $enviaremail = mail($destino, $assunto, $arquivo, $headers);

         if (!$enviaremail) {
                    echo " 
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
                    <script type=\"text/javascript\">
                      alert(\"Erro ao enviar o email.\");
                    </script>			
                  ";
                } else {
                   
                 echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=ficha.php?cod_registro=" . $cod_registro . "&contratantes_email=" . $contratantes_email . "'>";		
    
                } 

    }
}
 else {
    echo " <meta http-equiv='refresh' content='10;URL=index.php'>";
};

?>