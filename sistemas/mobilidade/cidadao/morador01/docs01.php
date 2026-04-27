<?php
session_start();
include_once("conexao.php");
echo getcwd().'<br>';
echo dirname(__FILE__).'<br>';
echo basename(__DIR__).'<br>';
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
    echo $row['nome_passageiro'];
        
    };
};
