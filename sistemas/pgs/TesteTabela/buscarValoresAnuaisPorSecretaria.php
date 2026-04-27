<?php 
include_once ('../db/gdb_mysql.php');

$gdb = new gdb();

$gdb->open('SELECT 
    se.siglaSecretaria AS NOMESECRETARIA, 
    SUM(DISTINCT c.custoAnual) AS TOTALCUSTOANUAL
FROM 
    secretarias se
JOIN 
    contratoXsecretaria cs ON se.idSecretaria = cs.idSecretaria
JOIN 
    contratos c ON cs.idContrato = c.idContrato
WHERE 
    c.arquivado = 0
    AND NOW() BETWEEN c.vigenciaInicial AND c.vigenciaFinal
GROUP BY 
    se.siglaSecretaria');

$json = json_encode($gdb->gs);
echo $json; 
?>
