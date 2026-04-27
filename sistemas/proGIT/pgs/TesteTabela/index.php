<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

include_once ('../db/gdb_mysql.php');

$gdb = new gdb();

// Consulta para obter os dados da view vw_contratos_vencidos
$gdb->open('SELECT nomeUsual as nome, vigenciaFinal as final FROM vw_contratos_vencidos ORDER BY vigenciaFinal DESC');

if ($gdb->linhas > 0) {
    $resultadosContratosVencidos = $gdb->gs;
}

$gdb->open('SELECT nomeUsual as nome, vigenciaFinal as final, dias_para_vencer, siglaSecretaria FROM contratos_vigencia ORDER BY vigenciaFinal ASC');

if ($gdb->linhas > 0) {
    $resultadosContratosAVencer = $gdb->gs;
}

$gdb->open('SELECT COUNT(*) AS TOTAL FROM fornecedor');
$totalFornecedor = $gdb->gs['TOTAL'][0];

$gdb->open('SELECT sum(custoMensal) as totalMensal, sum(custoAnual) as totalAnual FROM contratos WHERE now() BETWEEN vigenciaInicial AND vigenciaFinal');
$totalMensal = $gdb->gs['TOTALMENSAL'][0];
$totalAnual = $gdb->gs['TOTALANUAL'][0];

$gdb->open('SELECT count(idContrato) as total FROM contratos where now() between vigenciaInicial and vigenciaFinal');
$totalAtivos = $gdb->gs['TOTAL'][0];



          
?>
<style>
.table-header {
    background-color: rgb(56, 56, 106);
    color: white; /* Ajuste a cor do texto para contraste, se necessário */
}
</style>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" onclick="toggleSidebar()">☰</a><span class="icon-text">Gestão de Sistemas PMF</span>
    </div>
    <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/#" class="icon-middle"><span class="material-symbols-outlined">grid_view</span><span class="icon-text"> Dashboard</span></a>

    <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaCadastros/#" class="icon-middle"><span class="material-symbols-outlined">how_to_reg</span><span class="icon-text"> Cadastrar</span></a>

    <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/CadastroContratos/#" class="icon-middle"><span class="material-symbols-outlined">add</span><span class="icon-text" >Adicionar</span></a>

    <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaAtivos/#" class="icon-middle"><span class="material-symbols-outlined">contract</span></i><span class="icon-text"> Contratos</span></a>

    <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaArquivados/#" class="icon-middle"><span class="material-symbols-outlined">inventory_2</span><span class="icon-text"> Arquivados</span></a>

    <div class="bottom-icons">
        <a href="http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/Auditoria/" class="icon-bottom"><span class="material-symbols-outlined">update</span><span class="icon-text"> Histórico</span></a>

        <a href="../db/logout.php" onclick="return confirmLogout();" class="icon-text">
          <i class="fa fa-sign-out"></i><span class="material-symbols-outlined">logout</span>
        </a>
    </div>
</div>

<script>
function confirmLogout() {
    if (confirm('Tem certeza que deseja sair?')) {
        return true; // Prossiga com o logout
    } else {
        return false; // Cancela o logout
    }
}
</script>
                   
<div class="section">
    <div class="primeiraLinha">
        <div class="panel" id="panel2">
            <canvas id="graficoValoresAnuais" width="450" height="450"></canvas>
        </div>
        <div class="panel" id="panel1">
            <canvas id="grafico1" width="400" height="270"></canvas>
        </div>   
    </div>
    <div class="coluna">
            <div class="info-container">
                <div class="info-box">
                    <span class="material-symbols-outlined">
                        pallet
                        </span>
                    <h4>Fornecedores</h4>
                    <p> <?php  echo $totalFornecedor  ?> </p>        
                </div>
                <div class="info-box">
                    <span class="material-symbols-outlined">paid</span>
                    <h4>Gastos</h4>
                    <select id="gasto-select" data-mensal="<?php echo $totalMensal; ?>" data-anual="<?php echo $totalAnual; ?>" onchange="updateGastos()">
                        <option value="mensal">Mensal</option>
                        <option value="anual">Anual</option>
                    </select>
                    <p id="gasto-display"><?php echo "R$ " . number_format($totalMensal, 2, ',', '.'); ?></p>
                </div>
                <div class="info-box">
                    <span class="material-symbols-outlined">
                        contract
                        </span>
                    <h4>Contratos Ativos</h4>
                    <p><?=$totalAtivos; ?></p>
                </div>
            </div>
            <div class="panel" id="panel3">
                <canvas id="grafico3" width="450" height="490"></canvas>
            </div>
            <div class="panel" id="panel4">    
                <canvas id="grafico2" width="450" height="490"></canvas>
            </div>
        </div>

    <div class=terceiraLInha>
        
        <div class="panel" id="panel5">
            <p class="fw-bold" style="position:absolute; margin-left:19%; margin-top:0.5%;">Contratos a Vencer</p>
            <div style="flex-direction:row">
                <table style="width: 99%; margin-left: 0.6%; margin-top:4%;" id="contratos-vencer-table" class="table table-striped">
                    <thead>
                        <tr class="table-header">
                            <th>Nome Usual</th>
                            <th>Sigla Secretaria</th>
                            <th>Vigência Final</th>
                            <th>Dias para Vencer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop para exibir os resultados da consulta na tabela
                        $contrato = $resultadosContratosAVencer;
                        foreach ($contrato['NOME'] as $i => $value) {
                            if ($contrato['DIAS_PARA_VENCER'][$i] > 90) {
                                echo "<tr class='table-success'>";
                            } elseif ($contrato['DIAS_PARA_VENCER'][$i] > 60 && $contrato['DIAS_PARA_VENCER'][$i] <= 90) {
                                echo "<tr class='table-warning'>";
                            } elseif ($contrato['DIAS_PARA_VENCER'][$i] <= 60) {
                                echo "<tr class='table-danger'>";
                            } else {
                                echo "<tr>"; // Caso queira adicionar uma classe padrão para os outros casos
                            }
                            
                            echo "<td>" . $value . "</td>";
                            echo "<td>" . $contrato['SIGLASECRETARIA'][$i] . "</td>";
                            // Formatação da data para dd-mm-yyyy
                            $vigenciaFinalFormatted = date('d/m/Y', strtotime($contrato['FINAL'][$i]));
                            echo "<td>" . $vigenciaFinalFormatted . "</td>";
                            echo "<td>" . $contrato['DIAS_PARA_VENCER'][$i] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel" id="panel6">
                <p class="fw-bold" style="position:absolute; margin-left:13%; margin-top:0.5%;"> Contratos Fora de Vigência</p>
                <div style="flex-direction:row">     
                    <table style="width: 98%; margin-left: 1%; margin-top:5%;" id="contratos-vencidos-table" class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Nome Usual</th>
                                <th>Vigência Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop para exibir os resultados da consulta na tabela
                            $contrato = $resultadosContratosVencidos;
                            foreach ($contrato['NOME'] as $i => $value) {
                                echo "<tr>";
                                echo "<td>" . $value . "</td>";
                                // Formatação da data para dd-mm-yyyy
                                $vigenciaFinalFormatted = date('d/m/Y', strtotime($contrato['FINAL'][$i]));
                                echo "<td>" . $vigenciaFinalFormatted . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
         </div>   
    </div>         
</div>    

    
</div>





<script>
         function numberFormat(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep,
                dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };

            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function updateGastos() {
            const select = document.getElementById('gasto-select');
            const display = document.getElementById('gasto-display');
            const mensal = parseFloat(select.dataset.mensal);
            const anual = parseFloat(select.dataset.anual);
            
            let value = (select.value === 'mensal') ? mensal : anual;
            display.textContent = "R$ " + numberFormat(value, 2, ',', '.');
        }

        // Chama a função ao carregar a página para garantir que o valor inicial esteja correto
        window.onload = function() {
            updateGastos();
        }
</script>


</main>
    <script src="script.js"></script>
</body>
</html>
