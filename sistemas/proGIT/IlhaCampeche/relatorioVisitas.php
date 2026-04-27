

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/reservar.css" /> -->
  <link rel="stylesheet" href="css/graficos.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.dsgovserprodesign.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Ilha do Campeche</title>
</head>
<?php 

include_once("banco/gdb.php");

$gdb = new gdb();

$gdb->open("select count(*) 
                   as total, sum(voudata) 
                   as total_voudata
              from voucher 
         left join acompanhante                     
                on acovoucodigo = voucodigo
             where year(voudata) = 2024
                 ");

$totalVisitasAno = $gdb->gs['TOTAL'][0];

$email   = $gdb->vargetpost('login');
$dia     = "";
$total   = "";
$mes = $gdb->vargetpost('mes');
$vetorMes = array('2024','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
$vetorDiasMes = array('0','31','29','31','30','31','30','31','31','30','31','30','31');

if( $mes == 0 ){
    $gdb->open(" select mes_ano, 
                        count(*) as total
                   from ( select count(*) as total, 
                                 date_format(voudata, '%m/%y') as mes_ano
                            from voucher 
                       left join acompanhante                     
                              on acovoucodigo = voucodigo                            
                           where year( voudata ) = 2024   
                        group by voudata 
                        order by voudata ) as teste 
                        group by mes_ano");

    for( $i;$i<=12;$i++ ){
         $mes .="$i,";
         $tem = 0;
         foreach( $gdb->gs['MES_ANO'] as $i2=>$value ){
             if( intval( substr( $value,0,2) ) == $i ){
                 $total .= strval($gdb->gs['TOTAL'][$i2] ).",";
                 $tem = 1;
             }
         } 
         if($tem == 0 ) $total .= "0,";
    }
    $labels = $mes;       
    $lbMeses = "['Janeiro'],['Fevereiro'],['Março'],['Abril'],['Maio'],['Junho'],['Julho'],['Agosto'],['Setembro'],['Outubro'],['Novembro'],['Dezembro']";
    $lbmes = 'Ano '.$vetorMes[0];
}else{

    $gdb->open("select count(*) as total,
                     voudata 
                from voucher 
           left join acompanhante                     
                  on acovoucodigo = voucodigo
               where month(voudata) = $mes 
                 and year(voudata)=2024 
            group by voudata 
            order by voudata ");

    for($i;$i<=$vetorDiasMes[$mes];$i++){
        $dia .="$i,";
        $tem = 0;
        foreach( $gdb->gs['VOUDATA'] as $i2=>$value ){
            if( intval( substr( $value,8,2) ) == $i ){
                $total .= strval($gdb->gs['TOTAL'][$i2] ).",";
                $tem = 1;
            }
        } 
        if($tem == 0 ) $total .= "0,";
    }       
    $lbMeses = $dia;
    
    $lbmes = 'Total de Reservas do Mês de '.$vetorMes[ ($mes) ];

}   

$data = $total;

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);


?>


<body>
    <header>
        <img class="logo-header" src="images/logoPmf.png" alt=" Logo PMF ">
        <img class="" src="" alt="Logo Segurança">
    </header>
    <form name="frm" id="frm" method="POST">           
        <input type="hidden"  name="mes">

<main>

            <section class="sectionUm">
            <div class="graficoMensal">
                <h4>Saida um</h4>
                <div class="contadorVisitas">
                    <label for="">32564</label>
                </div>

            </div>
            <div class="graficoMensal">
            <h4>Saida Dois</h4>
                <div class="contadorVisitas">
                <label for="">32564</label>
                </div>
            </div>
            <div class="graficoMensal">
            <h4>Saida Tres</h4>
                <div class="contadorVisitas">
                <label for="">32564</label>
                </div>

            </div>
            <div class="graficoMensal">
            <h4>Saida Quatro</h4>
                <div class="contadorVisitas">
                <label for="">32564</label>
                </div>
            </div>

            </section>

            <section class="sectionDois">


                <div class="totalVisitasMes">
                    <canvas id="meuGrafico" width="100%" height="35"></canvas>
                <div class="botoesMeses">
                    <?php foreach($vetorMes as $i=>$value ){?>
                        <input type="button" value="<?=$value; ?>" onclick="selectMes(<?=$i; ?>);">
                    <?php 
                    }?>
                </div>
                </div>
                <div class="graficoTotalVisitas">
                    <canvas id="graficoSoma" width="20" height="10"></canvas>
                    
                <div class="centralizarSoma"><h4><?=$totalVisitasAno;?></h4></div>
                </div>

            </section>
</form>    



</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('meuGrafico').getContext('2d');
    var meuGrafico = new Chart(ctx, {
        type: 'bar',
        data: {
           
            labels: [<?=$lbMeses;?>],
            datasets: [{
                label: ['<?=$lbmes;?>'],
                data: [<?=$data;?>],
                backgroundColor: 'rgba(0, 177, 235, 0.5)',
                borderColor: 'rgba(0, 47, 102, 1)',
                borderWidth: 1
            }]
        },
        options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = 'Total de reservas do dia ' + context.label + ': ' + context.parsed.y;
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



    var ctx = document.getElementById('graficoSoma').getContext('2d');
    var graficoMensal = new Chart(ctx, {
    type: 'doughnut',
    data: {
            labels: ['Um', 'Dois', 'Tres', 'Quatro'],
            datasets: [{
            label: 'Total de Visitas no Ano',
            data: [300, 50, 100, 50],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(0, 177, 235)',
                'rgb(255, 205, 86)',
                'rgb(144, 238, 144)'
            ],
            hoverOffset: 5
                }]
          }
        });

        function selectMes(opc){
           frm.mes.value = opc;
           frm.submit();

        }



        
</script>

</body>
