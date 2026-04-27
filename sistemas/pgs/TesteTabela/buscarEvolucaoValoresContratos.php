<?php
include_once ('../db/gdb_mysql.php');

$gdb = new gdb();

// Sua consulta SQL
$query = "
SELECT 
    YEAR(dt_referencia) AS ano,
    MONTH(dt_referencia) AS mes,
    SUM(IF(dt_referencia BETWEEN vigenciaInicial AND vigenciaFinal, custoMensal, 0)) AS totalValorMensal,
    COUNT(DISTINCT contratos.idContrato) AS qtdContratos
FROM (
    SELECT 
        LAST_DAY('2024-01-01') AS dt_referencia
    UNION ALL SELECT LAST_DAY('2024-02-01')
    UNION ALL SELECT LAST_DAY('2024-03-01')
    UNION ALL SELECT LAST_DAY('2024-04-01')
    UNION ALL SELECT LAST_DAY('2024-05-01')
    UNION ALL SELECT LAST_DAY('2024-06-01')
    UNION ALL SELECT LAST_DAY('2024-07-01')
    UNION ALL SELECT LAST_DAY('2024-08-01')
    UNION ALL SELECT LAST_DAY('2024-09-01')
    UNION ALL SELECT LAST_DAY('2024-10-01')
    UNION ALL SELECT LAST_DAY('2024-11-01')
    UNION ALL SELECT LAST_DAY('2024-12-01')
) AS datas_referencia
LEFT JOIN contratos
ON dt_referencia BETWEEN vigenciaInicial AND vigenciaFinal
WHERE 
    contratos.arquivado = 0
    AND (
        (YEAR(vigenciaInicial) < 2024 AND YEAR(vigenciaFinal) >= 2024)
        OR (YEAR(vigenciaInicial) = 2024)
    )
GROUP BY 
    YEAR(dt_referencia), MONTH(dt_referencia)
ORDER BY 
    ano, mes;
";

// Executar a consulta
$gdb->open($query);

// Preparar o resultado para ser enviado como JSON
$data = [];
if ($gdb->linhas > 0) {
    foreach ($gdb->gs['ANO'] as $i => $ano) {
        $mes = $gdb->gs['MES'][$i];
        $totalValorMensal = $gdb->gs['TOTALVALORMENSAL'][$i];
        $qtdContratos = $gdb->gs['QTDCONTRATOS'][$i];
        $data[] = [
            'ano' => $ano,
            'mes' => $mes,
            'totalValorMensal' => $totalValorMensal,
            'qtdContratos' => $qtdContratos
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>
