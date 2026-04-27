<?php
include_once('db/connect.php');
include_once('db/gdb_mysql.php');

$gdb = new gdb();

if (isset($_POST['code']) && isset($_POST['senhaNova']) && isset($_POST['senhaRepetida'])) {
    $senha = $conn->real_escape_string($_POST['senhaNova']);
    $senhaRepetida = $conn->real_escape_string($_POST['senhaRepetida']);
    $code = $_POST['code'];

    if ($senha == $senhaRepetida) {
        $resultado = $gdb->open("SELECT * FROM usuario WHERE upper(codeReset) = upper('$code')");
        $idUsuario = $gdb->gs['IDUSUARIO'][0];
        $resetSenha = $gdb->gs['RESETSENHA'][0];
        $nomeUsuario = $gdb->gs['NOMEUSUARIO'][0];

        if (!$resultado || !isset($gdb->gs['IDUSUARIO'][0])) {
            echo "<script>alert('Código Errado'); window.history.back();</script>";
            exit;
        } else if ($resetSenha == 0) {
            echo "<script>alert('Este Usuário Não Pediu Reset de Senha'); window.history.back();</script>";
            exit;
        } else {
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            date_default_timezone_set('America/Sao_Paulo');
            $current_time = date('d-m-Y H:i:s');

            try {
                $gdb->open("START TRANSACTION");

                // atualiza a senha do usuário
                $resultadoUpdate = $gdb->open("UPDATE usuario SET senhaUsuario = '$senhaCriptografada' WHERE idUsuario = $idUsuario");
                if (!$resultadoUpdate) {
                    throw new Exception("Erro ao atualizar a senha");
                }

                // atualiza os campos de reset de senha
                $gdb->open("UPDATE usuario SET codeReset = NULL, resetSenha = 0 WHERE idUsuario = $idUsuario");

                // registro de auditoria
                $auditoriaSql = "INSERT INTO auditoria (tipoInteracao, horaAuditoria, nomeDoAlvo)
                                 VALUES ('Senha Alterada do Usuário', '$current_time', '$nomeUsuario')";
                if (!$gdb->open($auditoriaSql)) {
                    throw new Exception("Erro ao registrar auditoria");
                }

                // Commit da transação
                $gdb->open("COMMIT");

                echo "<script>alert('Senha atualizada com sucesso'); window.location.href = 'http://pgs.pmf.sc.gov.br';</script>";
            } catch (Exception $e) {
                // Rollback da transação em caso de erro
                $gdb->open("ROLLBACK");
                echo "<script>alert('" . $e->getMessage() . "'); window.history.back();</script>";
            }
        }
    } else {
        echo "<script>alert('As senhas não coincidem'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <title>Reset Senha</title>
</head>
<body>
    <div class="background"></div>

        <div>
            <form action="" method="POST">
                <h3>Reset de Senha</h3>

                <label for="code">Código</label>
                <input name="code" type="text" placeholder="Digite aqui" id="code">

                <label for="senhaNova">Nova Senha</label>
                <input name="senhaNova" type="password" placeholder="Nova Senha" id="senhaNova">

                <label for="senhaRepetida">Repita a Senha</label>
                <input name="senhaRepetida" type="password" placeholder="Repita a Nova Senha" id="senhaRepetida">

                <input type="submit" value="Registar">
                </div>
            </form>
        </div>

</body>
</html>