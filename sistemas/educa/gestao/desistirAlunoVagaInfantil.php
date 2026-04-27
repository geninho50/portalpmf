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

if (isset($_POST['idVaga'])) {
    if(isset($_POST['id'])){

        include_once('fnc/connect.php');

        $sql = sprintf("select a.Tipo_Vaga_id_tipo_vaga, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa,
            a.Fase_Periodo_Periodo_id_periodo, a.Fase_Periodo_Fase_id_ano_serie,
            a.Fase_Periodo_Fase_Curso_id_curso, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa from matricula.vaga a
            where a.id_vaga = %s", mysql_real_escape_string($_POST['idVaga']));

        $resultado = mysql_query($sql);

        $row = true;

        while ($row != FALSE) {
            $row = mysql_fetch_row($resultado);
            if ($row[0] != '') {
                $dados = $row;
            }
        }

        $sql = sprintf("delete from matricula.lista_aluno_atendidas where id_aluno = %s", mysql_real_escape_string($_POST['id']));
        $resultado = mysql_query($sql);

        $sql = sprintf("delete from matricula.vaga where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($_POST['id']));
        $resultado = mysql_query($sql);

        if($resultado == true){
            $sql = sprintf("INSERT INTO `matricula`.`auditoria_vaga_infantil_remover`
                (`id_aluno`,
                    `id_tipo_vaga`,
                    `id_ano`,
                    `id_periodo`,
                    `id_ano_serie`,
                    `id_curso`,
                    `id_escola`,
                    `id_pessoa_alterou`,
                    `id_motivo`,
                    `dt_alteracao`)
            VALUES
            (%s,
                %s,
                %s,
                %s,
                %s,
                %s,
                %s,
                %s,
                '%s',
                sysdate())", mysql_real_escape_string($_POST['id'])
            , mysql_real_escape_string($dados[0])
            , mysql_real_escape_string($dados[1])
            , mysql_real_escape_string($dados[2])
            , mysql_real_escape_string($dados[3])
            , mysql_real_escape_string($dados[4])
            , mysql_real_escape_string($dados[5])
            , mysql_real_escape_string($_SESSION['usuario']['id'])
            , mysql_real_escape_string($_POST['motivo']));

$resultado = mysql_query($sql);

header("Location: pesquisarInfantilComVaga.php?desistir=true&escola=".$dados[5]."&ano=2014&fase=".$dados[3]);
}
}else {
    header("Location: opcoes.php");
}

} else {
    header("Location: opcoes.php");
}
?>
