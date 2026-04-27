<?php

include_once './conexao.php';

$result_contratantes =   array(
    "contratantes_nome" => $_POST['contratantes_nome'], 
    'contratantes_logradouro' => $_POST['contratantes_logradouro'],
    'contratantes_bairro' => $_POST['contratantes_bairro'],
    'contratantes_cidade' => $_POST['contratantes_cidade'],
    'contratantes_estado' => $_POST['contratantes_estado'],
    'contratantes_pais' => $_POST['contratantes_pais'],
    'contratantes_tipo_documento' => $_POST['contratantes_tipo_documento'],
    'contratantes_documento' => $_POST['contratantes_documento'],
    'contratantes_email' => $_POST['contratantes_email'],
    'contratantes_telefone_com_ddd' => $_POST['contratantes_telefone_com_ddd'],
);

$contratantes = json_encode($result_contratantes);

$data_chegada = $_POST['data_chegada'];
$data_saida = $_POST['data_saida'];


$logradouro_origem = $_POST['logradouro_origem'];
$bairro_origem = $_POST['bairro_origem'];
$cidade_origem = $_POST['cidade_origem'];
$estado_origem = $_POST['estado_origem'];
$pais_origem = $_POST['pais_origem'];
$demais_referencias = $_POST['demais_referencias'];

$modelo = $_POST['modelo_veiculo'];
$placa = $_POST['placa_veiculo'];
$tipo = $_POST['tipo_veiculo'];

// Verifica se todos os inputs de motoristas foram preenchidos
$i_motoristas_max = 0;
$array_nomes_motoristas = $_POST['motoristas_nome'];
$array_documento_habilitacao = $_POST['motoristas_documento_habilitacao'];
$array_orgao_emissor = $_POST['motoristas_orgao_emissor'];
$array_telefone_ddd = $_POST['motoristas_telefone_ddd'];

foreach ($array_nomes_motoristas as $key_nomes_motoristas => $value_nomes_motoristas) {
    $values_nomes_motoristas[] = $value_nomes_motoristas;
    $i_motoristas_max +=1;
}


$i = 0;
for ($i = 0; $i < $i_motoristas_max; $i++) {
    $result_motoristas[$i] =  array(
        'motoristas_nome' => $array_nomes_motoristas[$i], 
        'motoristas_documento_habilitacao' => $array_documento_habilitacao[$i],
        'motoristas_orgao_emissor' => $array_orgao_emissor[$i],
        'motoristas_telefone_ddd' => $array_telefone_ddd[$i]
    );
};

$motoristas = json_encode($result_motoristas);

// Verifica se todos os inputs de trajetos foram preenchidos


$i_rotas_max = 0;

$array_rota_data = $_POST['rota_data'];
$array_rota_endereco_saida = $_POST['rota_endereco_partida'];
$rota_endereco_chegada = $_POST['rota_endereco_destino'];

foreach ($array_rota_data as $key_n => $value_rota_data) {
    $values_rota_data[] = $value_rota_data;
    $i_rotas_max += 1;
};

$i = 0;
for ($i = 0; $i < $i_rotas_max; $i++) {
    $result_rotas[$i] =  array(
        'data' => $array_rota_data[$i], 
        'rota_saida' => $array_rota_endereco_saida[$i], 
        'rota_chegada' => $rota_endereco_chegada[$i]
    );
};

$rotas = json_encode($result_rotas);


// Verifica se todos os inputs de passageiros foram preenchidos

$i_pax_max = 0;
$array_passageiros_nome = $_POST['passageiros_nome'];
$array_passageiros_data_nascimento = $_POST['passageiros_data_nascimento'];
$array_passageiros_tipo_documento = $_POST['passageiros_tipo_documento'];
$array_passageiros_documento = $_POST['passageiros_documento'];
$array_passageiros_orgao_emissor = $_POST['passageiros_orgao_emissor'];

foreach ($array_passageiros_nome as $key_passageiros_nome => $value_passageiros_nome) {
    $values_passageiros_nome[] = $value_passageiros_nome;
    $i_pax_max += 1;
}

$i = 0;
for ($i = 0; $i < $i_pax_max; $i++) {
    $result_passageiros[$i] =   array(
        'nome' => $array_passageiros_nome[$i], 
        'data_nascimento' => $array_passageiros_data_nascimento[$i],
        'tipo_documento' => $array_passageiros_tipo_documento[$i], 
        'documento' => $array_passageiros_documento[$i],
        'orgao_emissor' => $array_passageiros_orgao_emissor[$i]
    );
};

$passageiros = json_encode($result_passageiros);


$data_cadastro = date("Y-m-d H:i:s");
//$data_alteracao = date('Y-m-d');
$codigo_registro = substr(md5(mt_Rand()), 0, 4);



$insert_query1 = "INSERT INTO turismo.viagens(
    contratantes,
    data_chegada,
    data_saida,
    logradouro_origem,
    bairro_origem,
    cidade_origem,
    estado_origem,
    pais_origem,
    demais_referencias,
    modelo,
    placa,
    tipo,
    motoristas,
    rotas,
    passageiros,
    data_cadastro,
    codigo_registro
    )
    VALUES (
    :contratantes,
    :data_chegada,
    :data_saida,
    :logradouro_origem,
    :bairro_origem,
    :cidade_origem,
    :estado_origem,
    :pais_origem,
    :demais_referencias,
    :modelo,
    :placa,
    :tipo,
    :motoristas,
    :rotas,
    :passageiros,
    :data_cadastro,
    :codigo_registro
)";

    $stmt = $conn->prepare($insert_query1);
    $stmt->bindValue(':contratantes', $contratantes);
    $stmt->bindValue(':data_chegada', $data_chegada);
    $stmt->bindValue(':data_saida', $data_saida);
    $stmt->bindValue(':logradouro_origem', $logradouro_origem);
    $stmt->bindValue(':bairro_origem', $bairro_origem);
    $stmt->bindValue(':cidade_origem', $cidade_origem);
    $stmt->bindValue(':estado_origem', $estado_origem);
    $stmt->bindValue(':pais_origem', $pais_origem);
    $stmt->bindValue(':demais_referencias', $demais_referencias);
    $stmt->bindValue(':modelo', $modelo);
    $stmt->bindValue(':placa', $placa);
    $stmt->bindValue(':tipo', $tipo);
    $stmt->bindValue(':motoristas', $motoristas);
    $stmt->bindValue(':rotas', $rotas);
    $stmt->bindValue(':passageiros', $passageiros);
    $stmt->bindValue(':data_cadastro', $data_cadastro);
    $stmt->bindValue(':codigo_registro', $codigo_registro);

    $stmt->execute();


    $query_02 = "SELECT id_viagem FROM turismo.viagens WHERE data_cadastro = '$data_cadastro'";
    $stmt = $conn->prepare($query_02);
    $stmt->execute();
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    $id_viagem = $row["id_viagem"];
    echo $id_viagem; 
?>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
    </head>

    <body> <?php 

            if ($count != 0) {echo"
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/turismo/ficha.php?id_viagem=" . $id_viagem . "' > 

	        ";
            } else {
                echo "
                NÂO FOI Criado cadastro 
			";
            }  ?>
    </body>

    </html>*/