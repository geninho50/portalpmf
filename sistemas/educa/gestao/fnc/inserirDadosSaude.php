<?php

function inserirDadosSaude($saude, $id_pessoa) {

    include_once('connect.php');

    if ($saude['outros']['anemia'] == 'sim') {
        $anemia = 1;
    } else {
        if ($saude['outros']['anemia'] == 'nao') {
            $anemia = 0;
        } else {
            $anemia = 2;
        }
    }

    if ($saude['outros']['diabetes'] == 'sim') {
        $diabetes = 1;
    } else {
        if ($saude['outros']['diabetes'] == 'nao') {
            $diabetes = 0;
        } else {
            $diabetes = 2;
        }
    }

    if ($saude['outros']['intoleranciaLactose'] == 'sim') {
        $intoleranciaLactose = 1;
    } else {
        if ($saude['outros']['intoleranciaLactose'] == 'nao') {
            $intoleranciaLactose = 0;
        } else {
            $intoleranciaLactose = 2;
        }
    }

    if ($saude['outros']['intoleranciaGluten'] == 'sim') {
        $intoleranciaGluten = 1;
    } else {
        if ($saude['outros']['intoleranciaGluten'] == 'nao') {
            $intoleranciaGluten = 0;
        } else {
            $intoleranciaGluten = 2;
        }
    }

    if ($saude['outros']['refluxo'] == 'sim') {
        $refluxo = 1;
    } else {
        if ($saude['outros']['refluxo'] == 'nao') {
            $refluxo = 0;
        } else {
            $refluxo = 2;
        }
    }

    if (isset($saude['deficiencias'])) {
        if (in_array('cegueira', $saude['deficiencias'])) {
            $cegueira = 1;
        } else {
            $cegueira = 0;
        }
        if (in_array('baixaVisao', $saude['deficiencias'])) {
            $baixaVisao = 1;
        } else {
            $baixaVisao = 0;
        }
        if (in_array('surdez', $saude['deficiencias'])) {
            $surdez = 1;
        } else {
            $surdez = 0;
        }
        if (in_array('deficienciaAuditiva', $saude['deficiencias'])) {
            $deficienciaAuditiva = 1;
        } else {
            $deficienciaAuditiva = 0;
        }
        if (in_array('surdocegueira', $saude['deficiencias'])) {
            $surdocegueira = 1;
        } else {
            $surdocegueira = 0;
        }
        if (in_array('deficienciaFisica', $saude['deficiencias'])) {
            $deficienciaFisica = 1;
        } else {
            $deficienciaFisica = 0;
        }
        if (in_array('deficienciaIntelectual', $saude['deficiencias'])) {
            $deficienciaIntelectual = 1;
        } else {
            $deficienciaIntelectual = 0;
        }
        if (in_array('deficienciaMultipla', $saude['deficiencias'])) {
            $deficienciaMultipla = 1;
        } else {
            $deficienciaMultipla = 0;
        }
        if (in_array('autismoInfantil', $saude['deficiencias'])) {
            $autismoInfantil = 1;
        } else {
            $autismoInfantil = 0;
        }
        if (in_array('asperger', $saude['deficiencias'])) {
            $asperger = 1;
        } else {
            $asperger = 0;
        }
        if (in_array('rett', $saude['deficiencias'])) {
            $rett = 1;
        } else {
            $rett = 0;
        }
        if (in_array('tdi', $saude['deficiencias'])) {
            $tdi = 1;
        } else {
            $tdi = 0;
        }
        if (in_array('superdotado', $saude['deficiencias'])) {
            $superdotado = 1;
        } else {
            $superdotado = 0;
        }
    } else {
        $cegueira = 0;
        $baixaVisao = 0;
        $surdez = 0;
        $deficienciaAuditiva = 0;
        $surdocegueira = 0;
        $deficienciaFisica = 0;
        $deficienciaIntelectual = 0;
        $deficienciaMultipla = 0;
        $autismoInfantil = 0;
        $asperger = 0;
        $rett = 0;
        $tdi = 0;
        $superdotado = 0;
    }

    if (isset($saude['recursos'])) {
        if (in_array('auxilioLedor', $saude['recursos'])) {
            $auxilioLedor = 1;
        } else {
            $auxilioLedor = 0;
        }
        if (in_array('auxilioTranscricao', $saude['recursos'])) {
            $auxilioTranscricao = 1;
        } else {
            $auxilioTranscricao = 0;
        }
        if (in_array('guiaInterprete', $saude['recursos'])) {
            $guiaInterprete = 1;
        } else {
            $guiaInterprete = 0;
        }
        if (in_array('interpreteLibras', $saude['recursos'])) {
            $interpreteLibras = 1;
        } else {
            $interpreteLibras = 0;
        }
        if (in_array('leituraLabial', $saude['recursos'])) {
            $leituraLabial = 1;
        } else {
            $leituraLabial = 0;
        }
        if (in_array('braile', $saude['recursos'])) {
            $braile = 1;
        } else {
            $braile = 0;
        }
        if (in_array('ampliada16', $saude['recursos'])) {
            $ampliada16 = 1;
        } else {
            $ampliada16 = 0;
        }
        if (in_array('ampliada20', $saude['recursos'])) {
            $ampliada20 = 1;
        } else {
            $ampliada20 = 0;
        }
        if (in_array('ampliada24', $saude['recursos'])) {
            $ampliada24 = 1;
        } else {
            $ampliada24 = 0;
        }
    } else {
        $auxilioLedor = 0;
        $auxilioTranscricao = 0;
        $guiaInterprete = 0;
        $interpreteLibras = 0;
        $leituraLabial = 0;
        $braile = 0;
        $ampliada16 = 0;
        $ampliada20 = 0;
        $ampliada24 = 0;
    }

    $sql = sprintf("INSERT INTO `matricula`.`dados_saude`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `dt_vencimento_esquema_vacional`,
                    `id_anemia`,
                    `id_diabetes`,
                    `id_intolerancia_lactose`,
                    `id_intolerancia_gluten`,
                    `id_refluxo`,
                    `id_cegueira`,
                    `id_baixa_visao`,
                    `id_surdez`,
                    `id_deficiencia_auditiva`,
                    `id_deficiencia_fisica`,
                    `id_deficiencia_intelectual`,
                    `id_deficiencia_multipla`,
                    `id_autismo_infantil`,
                    `id_asperger`,
                    `id_rett`,
                    `id_transtorno_desintregativo_infancia`,
                    `id_altas_habilidades`,
                    `id_auxilio_ledor`,
                    `id_auxilio_transcricao`,
                    `id_guia_interprete`,
                    `id_interprete_libras`,
                    `id_leitura_labial`,
                    `id_prova_em_braile`,
                    `id_prova_amp_16`,
                    `id_prova_amp_20`,
                    `id_prova_amp_24`)
                    VALUES
                    (%s, str_to_date('%s', '%s'), %s, %s, %s, %s, %s, %s, %s,
                    %s,                    %s,                    %s,
                    %s,                    %s,                    %s,
                    %s,                    %s,                    %s,
                    %s,                    %s,                    %s,
                    %s,                    %s,                    %s,
                    %s,                    %s,                    %s,
                    %s);"
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($saude['data_vencimento_vacina']), mysql_real_escape_string("%d/%m/%Y")
            , mysql_real_escape_string($anemia)
            , mysql_real_escape_string($diabetes)
            , mysql_real_escape_string($intoleranciaLactose)
            , mysql_real_escape_string($intoleranciaGluten)
            , mysql_real_escape_string($refluxo)
            , mysql_real_escape_string($cegueira)
            , mysql_real_escape_string($baixaVisao)
            , mysql_real_escape_string($surdez)
            , mysql_real_escape_string($deficienciaAuditiva)
            , mysql_real_escape_string($deficienciaFisica)
            , mysql_real_escape_string($deficienciaIntelectual)
            , mysql_real_escape_string($deficienciaMultipla)
            , mysql_real_escape_string($autismoInfantil)
            , mysql_real_escape_string($asperger)
            , mysql_real_escape_string($rett)
            , mysql_real_escape_string($tdi)
            , mysql_real_escape_string($superdotado)
            , mysql_real_escape_string($auxilioLedor)
            , mysql_real_escape_string($auxilioTranscricao)
            , mysql_real_escape_string($guiaInterprete)
            , mysql_real_escape_string($interpreteLibras)
            , mysql_real_escape_string($leituraLabial)
            , mysql_real_escape_string($braile)
            , mysql_real_escape_string($ampliada16)
            , mysql_real_escape_string($ampliada20)
            , mysql_real_escape_string($ampliada24));

    $resultado = mysql_query($sql);
    
    $sql = sprintf("insert into matricula.antoprometria 
        (dt_medidas_tomadas, id_pessoa, qt_peso, qt_altura) 
        values (sysdate(), %s, %s, %s)"
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($saude['peso'])
            , mysql_real_escape_string($saude['altura']));
    $resultado = mysql_query($sql);

    return $resultado;
}

?>