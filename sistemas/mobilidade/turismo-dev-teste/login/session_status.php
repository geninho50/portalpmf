<?php
session_start();
if (!isset($_SESSION['usuarioId'])) {
    echo "analise de secao - nao encontrado";
    $_SESSION['logindeslogado'] = "Login Obrigatório";
    //redirecionar o usuario para a página de login
    header("Location: login.php");
    exit; // Encerra a execução do script
} else

if ($_SESSION['usuarioNivelacesso'] == 9) {
$nivel_acesso = "SuperUsuário";

} else

$nivel_acesso = "Definir";
?>

            <b>Usuario:</b> <?php echo $_SESSION['usuarioEmail'] . "<b>  Nível de acesso: </b>" . $nivel_acesso;?>
            <a class="btn btn-outline-light btn-sm" href="./login/sair.php" role="button">Sair</a>
    
</div>