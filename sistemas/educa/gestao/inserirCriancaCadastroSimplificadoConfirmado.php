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

if (isset($_POST['nome'])) {
    if (isset($_POST['dataNascimento'])) {
        if (isset($_POST['nomeMae']) OR isset($_POST['nomePai'])) {
                if (isset($_POST['idEscola'])) {
                    if (isset($_POST['grupo'])) {
                        if (isset($_POST['logradouro'])) {
                            if (isset($_POST['numero'])) {
                                if (isset($_POST['complemento'])) {

                                        include_once('fnc/connect.php');

                                        $get = "select get_lock('pessoa', 10)";
                                        $release = "do release_lock('pessoa')";

//cria pessoa

                                        $sql = "INSERT INTO `matricula`.`pessoa`
                                        (`criado_em`)
                                        VALUES
                                        (sysdate())";

                                        $resultado = mysql_query($sql);

                                        if (!$resultado) {
                                            mysql_query($release);
                                            return false;
                                        }
                                       $id_last =  mysql_fetch_row(mysql_query("select last_insert_id()"));
                                        $id = $id_last[0];

//cria pessoa fisica
                                        $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
                                            (`Pessoa_id_pessoa`,
                                                `ds_nome`,
                                                `dt_nascimento`)
                                        VALUES
                                        (%s,
                                            '%s',
                                            STR_TO_DATE('%s', '%s'))"
                                        , mysql_real_escape_string($id)
                                        , mysql_real_escape_string($_POST['nome'])
                                        , mysql_real_escape_string($_POST['dataNascimento'])
                                        , mysql_real_escape_string("%d/%m/%Y"));

                                        $resultado = mysql_query($sql2);
                                        
                                        if (!$resultado) {
                                            mysql_query($release);
                                            return false;
                                        }

//cria aluno
                                        $sql3 = sprintf('INSERT INTO `matricula`.`aluno`
                                            (`Pessoa_Fisica_Pessoa_id_pessoa`)
                                            VALUES
                                            (%s)', mysql_real_escape_string($id));

                                        $resultado = mysql_query($sql3);
                                        
                                        if (!$resultado) {
                                            mysql_query($release);
                                            return false;
                                        }
                                        mysql_query($release);    

                                        $sql = sprintf("INSERT INTO `matricula`.`vaga`
                                            (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                                                `Tipo_Vaga_id_tipo_vaga`,
                                                `Fase_Periodo_Periodo_id_ano`,
                                                `Fase_Periodo_Periodo_id_periodo`,
                                                `Fase_Periodo_Fase_id_ano_serie`,
                                                `Fase_Periodo_Fase_Curso_id_curso`,
                                                `Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa`)
                                        VALUES
                                        (%s,
                                            2,
                                            2014,
                                            1,
                                            %s,
                                            2,
                                            %d)"
, mysql_real_escape_string($id)
, mysql_real_escape_string($_POST['grupo'])
, mysql_real_escape_string($_POST['idEscola']));
    //A CORRIGIR -> PERIODO E CURSO COMO PARAMETROS
$resultado = mysql_query($sql);

header("Location: cadastroSimplificadoInfantil.php?sucesso=true");
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
} else {

    header("Location: cadastroSimplificadoInfantil.php?erro=true");
}
}
?>
