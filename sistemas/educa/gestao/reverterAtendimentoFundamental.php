<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

if (isset($_POST['id_aluno'])) {

    include_once('fnc/connect.php');

    $sql = sprintf("insert into matricula.lista_aluno (select * from matricula.lista_aluno_atendidas
        where id_aluno = %s)", mysql_real_escape_string($_POST['id_aluno']));
    $resultado = mysql_query($sql);

    $sql = sprintf("delete from matricula.lista_aluno_atendidas where id_aluno = %s", mysql_real_escape_string($_POST['id_aluno']));
    $resultado = mysql_query($sql);

    $sql = sprintf("delete from matricula.vaga where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($_POST['id_aluno']));
    $resultado = mysql_query($sql);

    $sql = sprintf("insert into matricula.reverteu_atendimento values (%s, %s, sysdate())", mysql_real_escape_string($_POST['id_aluno']
        ), mysql_real_escape_string($_SESSION['usuario']['id']));
    $resultado = mysql_query($sql);

    header("Location: listaDeMatriculados.php?reverter=true");

} else {
    header("Location: opcoes.php");
}
?>
