<?php

function insereNovoAlunoRematricula($dt_nasc, $matricula, $ano, $fase, $escola, $nome) {


    include_once('connect.php');

    $sql = sprintf('select Pessoa_Fisica_Pessoa_id_pessoa from matricula.aluno
            where id_inscricao = %s', mysql_real_escape_string($matricula));

    $resultado = mysql_query($sql);

    $row = mysql_fetch_row($resultado);
    unset($id);
    while ($row != FALSE) {
        if (isset($row)) {
            if ($row[0] != '') {
                $id = $row[0];
            }
        }
        $row = mysql_fetch_row($resultado);
    }

    if (isset($id)) {
        
        $sql = sprintf("update matricula.pessoa_fisica
                        set dt_nascimento = STR_TO_DATE('%s', '%s'),
                        ds_nome = %s
                        where Pessoa_id_pessoa = %s"
                , mysql_real_escape_string($dt_nasc)
                , mysql_real_escape_string("%d/%m/%Y")
                , mysql_real_escape_string($nome)
                , mysql_real_escape_string($id));

        $resultado = mysql_query($sql);
        

        $sql3 = sprintf("update `matricula`.`login`
                         set ds_senha = '%s'
                         where Pessoa_Fisica_Pessoa_id_pessoa = %s"
                , mysql_real_escape_string($id)
                , mysql_real_escape_string(str_replace('/', '', $dt_nasc)));

        $resultado = mysql_query($sql3);
    } else {

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
        $id_todos = mysql_fetch_row(mysql_query("select last_insert_id()"));
        $id = $id_todos[0];

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
                , mysql_real_escape_string($nome)
                , mysql_real_escape_string($dt_nasc)
                , mysql_real_escape_string("%d/%m/%Y"));

        $resultado = mysql_query($sql2);
        
        if (!$resultado) {
            mysql_query($release);
            return false;
        }

//cria aluno
        $sql3 = sprintf('INSERT INTO `matricula`.`aluno`
(`Pessoa_Fisica_Pessoa_id_pessoa`, `id_inscricao`)
VALUES
(%s, %s)', mysql_real_escape_string($id), mysql_real_escape_string($matricula));

        $resultado = mysql_query($sql3);
        
        if (!$resultado) {
            mysql_query($release);
            return false;
        }
        mysql_query($release);


        $sql3 = sprintf("INSERT INTO `matricula`.`login`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `ds_usuario`,
                    `ds_senha`,
                    `Perfil_id_perfil`)
                    VALUES
                    (%s,
                    '%s',
                    '%s',
                    %s)"
                , mysql_real_escape_string($id)
                , mysql_real_escape_string($matricula)
                , mysql_real_escape_string(str_replace('/', '', $dt_nasc))
                , mysql_real_escape_string(2));

        $resultado = mysql_query($sql3);
    }

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
                        %s,
                        1,
                        %s,
                        1,
                        %d)"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($escola));
    //A CORRIGIR -> PERIODO E CURSO COMO PARAMETROS

    $resultado = mysql_query($sql);
    
    return $resultado;
}

?>
