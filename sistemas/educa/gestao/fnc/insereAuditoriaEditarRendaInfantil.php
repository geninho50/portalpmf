<?php

function insereAuditoriaEditarRendaInfantil($renda, $id_pessoa, $id_usuario) {

    include_once('connect.php');

    foreach ($renda as $key => $value) {

        if(!isset($value[5])){
            $value[5] = 'null';
        }    
        if(!isset($value[1])){
            $value[1] = 'null';
        }    
        if(!isset($value[2])){
            $value[2] = 'null';
        }    
        if(!isset($value[3])){
            $value[3] = 'null';
        }    
        if(!isset($value[4])){
            $value[4] = 'null';
        }    
        if(!isset($value[0])){
            $value[0] = 'null';
        }    

        $sql = sprintf("INSERT INTO `matricula`.`auditoria_renda_infantil`
            (`id_aluno`,
                `tipo_renda`,
                `comprovacao`,
                `situacao_ocupacional`,
                `qt_renda`,
                `dt_nascimento`,
                `nome`,
                `ds_parentesco`,
                `id_usuario_alterou`,
                `dt_alteracao`)
        VALUES
        (%s,
         1,
         %s,
         %s,
         %s,
         '%s',
         '%s',
         '%s',
         %s,
         sysdate());"
        , mysql_real_escape_string($id_pessoa)
        , mysql_real_escape_string($value[5])
        , mysql_real_escape_string($value[1])
        , mysql_real_escape_string($value[2])
        , mysql_real_escape_string($value[3])
        , mysql_real_escape_string($value[0])
        , mysql_real_escape_string($value[4])
        , mysql_real_escape_string($id_usuario));

        $resultado = mysql_query($sql);

    }

}


function insereAuditoriaEditarRendaInfantilOutras($renda, $id_pessoa, $id_usuario, $tipo) {

    include_once('connect.php');

        if(!isset($renda)){
            $renda = 'null';
        }     

        $sql = sprintf("INSERT INTO `matricula`.`auditoria_renda_infantil`
            (`id_aluno`,
                `tipo_renda`,
                `qt_renda`,
                `id_usuario_alterou`,
                `dt_alteracao`)
        VALUES
        (%s,
         %s,
         %s,
         %s,
         sysdate());"
        , mysql_real_escape_string($id_pessoa)
        , mysql_real_escape_string($tipo)
        , mysql_real_escape_string($renda)
        , mysql_real_escape_string($id_usuario));

        $resultado = mysql_query($sql);   

}



?>