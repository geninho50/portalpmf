<?php

include_once './conexao.php';

//viagem

if ($_REQUEST["operador_email"]) {
  $operador_email = $_REQUEST['operador_email'];
};

//$operador_email = "michelmittmann@gmail.com";

if ($_REQUEST["data_chegada"]) {
  $data_chegada = $_REQUEST['data_chegada'];
};
if ($_REQUEST["data_saida"]) {
  $data_saida = $_REQUEST['data_saida'];
};
if ($_REQUEST["logradouro_origem"]) {
  $logradouro_origem = $_REQUEST['logradouro_origem'];
};
if ($_REQUEST["bairro_origem"]) {
  $bairro_origem = $_REQUEST['bairro_origem'];
};
if ($_REQUEST["cidade_origem"]) {
  $cidade_origem = $_REQUEST['cidade_origem'];
};
if ($_REQUEST["estado_origem"]) {
  $estado_origem = $_REQUEST['estado_origem'];
};
if ($_REQUEST["pais_origem"]) {
  $pais_origem = $_REQUEST['pais_origem'];
};
if ($_REQUEST["demais_referencias"]) {
  $demais_referencias = $_REQUEST['demais_referencias'];
};
//veiculo
if ($_REQUEST["placa_veiculo"]) {
  $placa = $_REQUEST['placa_veiculo'];
};
if ($_REQUEST["tipo_veiculo"]) {
  $tipo = $_REQUEST['tipo_veiculo'];
};


echo "helo";
//contratantes array e json

//  motoristas 
if ($_REQUEST['motoristas_nome'] && $_REQUEST['motoristas_documento_habilitacao'] && $_REQUEST['motoristas_orgao_emissor'] && $_REQUEST['motoristas_telefone_ddd']) {
  $motoristas_nome = $_REQUEST['motoristas_nome'];
  $motoristas_documento_habilitacao = $_REQUEST['motoristas_documento_habilitacao'];
  $motoristas_telefone_ddd = $_REQUEST['motoristas_telefone_ddd'];

  foreach ($motoristas_nome as $key => $value) {
    $values[] = $value;
    $i_motoristas_max++;
  }

  for ($i = 0; $i < $i_motoristas_max; $i++) {
    $result_motoristas[$i] =   array(
      'motoristas_nome' => $motoristas_nome[$i],
      'motoristas_documento_habilitacao' => $motoristas_documento_habilitacao[$i],
      'motoristas_telefone_ddd' => $motoristas_telefone_ddd[$i]
    );
  };
};

$motoristas = json_encode($result_motoristas);

//  rotas 
if ($_REQUEST['rota_data'] && $_REQUEST['rota_endereco_partida'] && $_REQUEST['rota_endereco_destino']) {
  $rota_data = $_REQUEST['rota_data'];
  $rota_endereco_partida = $_REQUEST['rota_endereco_partida'];
  $rota_endereco_destino = $_REQUEST['rota_endereco_destino'];


  foreach ($rota_data as $key => $value) {
    $values[] = $value;
    $i_rotas_max++;
  }

  for ($i = 0; $i < $i_rotas_max; $i++) {
    $result_rotas[$i] =   array(
      'data' => $rota_data[$i],
      'endereco_partida' => $rota_endereco_partida[$i],
      'endereco_destino' => $rota_endereco_destino[$i]
    );
  };
};
$rotas = json_encode($result_rotas);


//teste pax 
if ($_REQUEST['passageiros_nome'] && $_REQUEST['passageiros_data_nascimento'] && $_REQUEST['passageiros_tipo_documento'] && $_REQUEST['passageiros_documento'] && $_REQUEST['passageiros_orgao_emissor']) {
  $passageiros_nome = $_REQUEST['passageiros_nome'];
  $passageiros_data_nascimento = $_REQUEST['passageiros_data_nascimento'];
  $passageiros_tipo_documento = $_REQUEST['passageiros_tipo_documento'];
  $passageiros_documento = $_REQUEST['passageiros_documento'];
  $passageiros_orgao_emissor = $_REQUEST['passageiros_orgao_emissor'];

  foreach ($passageiros_nome as $key => $value) {
    $values[] = $value;
    $i_pax_max++;
  }

  for ($i = 0; $i < $i_pax_max; $i++) {
    $result_pax[$i] =   array(
      'nome' => $passageiros_nome[$i],
      'data_nascimento' => $passageiros_data_nascimento[$i],
      'tipo_documento' => $passageiros_tipo_documento[$i],
      'documento' => $passageiros_documento[$i],
      'orgao_emissor' => $passageiros_orgao_emissor[$i]
    );
  };
};

$passageiros = json_encode($result_pax);

//lê o ultimo id_viagem para calcular o novo id_viagem
$sql = "SELECT id_viagem FROM turismo.viagens WHERE id_viagem=(select max(id_viagem) from turismo.viagens)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch();
$id_viagem = $row["id_viagem"] + 1;
$data_chegada_rev = (preg_replace("/[^0-9]/", "", $data_chegada));
$cod_registro  = $data_chegada_rev.'_'.str_pad($id_viagem, 5, '0', STR_PAD_LEFT);



// verifica se ja existe email registrado e usa a mesma chave de acesso

$sql1 = "SELECT chave_acesso FROM turismo.viagens WHERE operador_email  = '$operador_email' LIMIT 1";
$resultado_sql1 = $conn->query($sql1);
$countsql1 = $resultado_sql1->rowCount();
if ($countsql1!=0){ 
foreach ($conn->query($sql1) as $row1) {
  $chave_acesso = $row1["chave_acesso"];}
} else {$chave_acesso = substr(md5(mt_Rand()), 0, 6);}


$sql = "INSERT INTO turismo.viagens
   (
    
    operador_email,
    contratantes_telefone_com_ddd,
    data_chegada,
    data_saida,
    logradouro_origem,
    bairro_origem,
    cidade_origem,
    estado_origem,
    pais_origem,
    demais_referencias,
    placa,
    tipo,
    motoristas,
    rotas,
    passageiros, 
    cod_registro,
    chave_acesso
   )
   VALUES
   (
     :operador_email,
    :contratantes_telefone,
    :data_chegada,
    :data_saida,
    :logradouro_origem,
    :bairro_origem,
    :cidade_origem,
    :estado_origem,
    :pais_origem,
    :demais_referencias,
    :placa,
    :tipo,
    :motoristas,
    :rotas,
    :passageiros,
    :cod_registro,
    :chave_acesso
   )";


$stmt = $conn->prepare($sql);

//contratante json

$stmt->bindValue(':contratantes', $contratantes);

//contratante individual

$stmt->bindValue(':operador_email', $operador_email);
$stmt->bindValue(':contratantes_telefone', $contratantes_telefone);

//viagem

$stmt->bindValue(':data_chegada', $data_chegada);
$stmt->bindValue(':data_saida', $data_saida);
$stmt->bindValue(':logradouro_origem', $logradouro_origem);
$stmt->bindValue(':bairro_origem', $bairro_origem);
$stmt->bindValue(':cidade_origem', $cidade_origem);
$stmt->bindValue(':estado_origem', $estado_origem);
$stmt->bindValue(':pais_origem', $pais_origem);
$stmt->bindValue(':demais_referencias', $demais_referencias);

// veiculo
$stmt->bindValue(':placa', $placa);
$stmt->bindValue(':tipo', $tipo);

//  motoristas
$stmt->bindValue(':motoristas', $motoristas);

// rotas
$stmt->bindValue(':rotas', $rotas);

// passageiros
$stmt->bindValue(':passageiros', $passageiros);
$stmt->bindValue(':cod_registro', $cod_registro);
$stmt->bindValue(':chave_acesso', $chave_acesso);
$stmt->execute();
$count = $stmt->rowCount();

$query_02 = "SELECT * FROM turismo.viagens where cod_registro = '$cod_registro' ";
$resultado_02 = $conn->query($query_02);
$count = $resultado_02->rowCount();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
</head>

<body> <?php
        if ($count != 0) {
                         echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=minhas-viagens.php'>";

                 //   echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=email_envia.php?cod_registro=" . $cod_registro . "&operador_email=" . $operador_email . "'>";
        } else {
            echo " 
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mtp.php'>
    <script type=\"text/javascript\">
      alert(\"Erro ao cadastrar.\");
    </script>			
  ";
        } ?>
</body>

</html>

