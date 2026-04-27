<?php

function inserirOutrosDados($outrosDados, $id_pessoa) {

    include_once('connect.php');


    if ($outrosDados['autoriza_uso'] == 'sim') {
        $autoriza_uso = 1;
    } else {
        if ($outrosDados['autoriza_uso'] == 'nao') {
            $autoriza_uso = 0;
        } else {
            $autoriza_uso = 2;
        }
    }

    if ($outrosDados['bolsa_familia'] == 'sim') {
        $bolsa_familia = 1;
    } else {
        if ($outrosDados['bolsa_familia'] == 'nao') {
            $bolsa_familia = 0;
        } else {
            $bolsa_familia = 2;
        }
    }


    if ($outrosDados['pensao'] == 'sim') {
        $pensao = 1;
    } else {
        if ($outrosDados['pensao'] == 'nao') {
            $pensao = 0;
        } else {
            $pensao = 2;
        }
    }

    if ($outrosDados['precisara_transporte'] == 'sim') {
        $precisaraTransporte = 1;
    } else {
        if ($outrosDados['precisara_transporte'] == 'nao') {
            $precisaraTransporte = 0;
        } else {
            $precisaraTransporte = 2;
        }
    }

    if ($outrosDados['possui_computador'] == 'sim') {
        $computador = 1;
    } else {
        if ($outrosDados['possui_computador'] == 'nao') {
            $computador = 0;
        } else {
            $computador = 2;
        }
    }

    if ($outrosDados['local_permanencia'] == 'casa') {
        $local_permanencia = 'Casa';
    } else {
        if ($outrosDados['local_permanencia'] == 'ue') {
            $local_permanencia = ('Unidade de Educação');
        } else {
            $local_permanencia = $outrosDados['local_permanencia'];
        }
    }
    if ($outrosDados['acesso_internet'] == 'casa') {
        $acesso_internet = 'Casa';
    } else {
        if ($outrosDados['acesso_internet'] == 'escola') {
            $acesso_internet = 'Escola';
        } else {
            if ($outrosDados['acesso_internet'] == 'trabalho') {
                $acesso_internet = 'Trabalho';
            } else {
                if ($outrosDados['acesso_internet'] == 'outro') {
                    $acesso_internet = 'Outro';
                }
            }
        }
    }

    if ($outrosDados['zona_moradia'] == 'rural') {
        $zona_moradia = 'Rural';
    } else {
        $zona_moradia = 'Urbana';
    }

    if ($outrosDados['moradia'] == 'propria') {
        $moradia = ('Propria');
    } elseif ($outrosDados['moradia'] == 'alugada') {
        $moradia = 'Alugada';
    } else {
        $moradia = 'Outros';
    }

    if ($outrosDados['carro'] == 'sim') {
        $carro = 1;
    } else {
        $carro = 0;
    }

    if (isset($outrosDados['numero_cartao_transporte'])) {
        $numeroTransporte = $outrosDados['numero_cartao_transporte'];
    } else {
        $numeroTransporte = 'null';
    }

    if (isset($outrosDados['tempo_residencia'])) {
        $tempoRes = $outrosDados['tempo_residencia'];
    } else {
        $tempoRes = '1';
    }

    $sql = sprintf("UPDATE `matricula`.`aluno`
                    SET
                    `id_precisa_transporte_proximo_periodo` = %s,
                    `nr_cartao_transporte` = %s,
                    `Tempo_Residencia_id_tempo_residencia` = %s,
                    `en_zona_moradia` = '%s',
                    `id_autoriza_uso` = %s,
                    `id_bolsa_familia` = %s,
                    `ds_local_permanencia` = '%s',
                    `id_possui_computador` = %s,
                    `en_local_acesso_internet` = '%s',
                    `id_possui_carro` = %s,
                    `en_tipo_moradia` = '%s',
                    `id_pensao`= %s,
                    `ds_nome_mae` = '%s',
                    `ds_nome_pai` = '%s'
                    WHERE `Pessoa_Fisica_Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($precisaraTransporte)
            , mysql_real_escape_string($numeroTransporte)
            , mysql_real_escape_string($tempoRes)
            , mysql_real_escape_string($zona_moradia)
            , mysql_real_escape_string($autoriza_uso)
            , mysql_real_escape_string($bolsa_familia)
            , mysql_real_escape_string($local_permanencia)
            , mysql_real_escape_string($computador)
            , mysql_real_escape_string($acesso_internet)
            , mysql_real_escape_string($carro)
            , mysql_real_escape_string($moradia)
            , mysql_real_escape_string($pensao)
            , mysql_real_escape_string($outrosDados['nome_mae'])
            , mysql_real_escape_string($outrosDados['nome_pai'])
            , mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>