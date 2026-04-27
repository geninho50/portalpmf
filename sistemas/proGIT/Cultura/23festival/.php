<!DOCTYPE HTML>
<html>
	<head>
		<title>23º Festival Isnard Azevedo</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="images/icon2.png" type="image/png">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	</head>
	<body>

	<section id="main">
		<div class="inner">

			<section id="one" class="wrapper style1">

				<div class="image fit flush">
					<img src="images/folder3.jpg" alt="" />
				</div>
				<header>	
					
				<div id='cssmenu'>
					<ul>
					   <li><a href='index.html'>Início</a></li>
					   <li class='active'><a href='#'>O Festival</a>
					      <ul>  
				             <li><a href=''>Edição 2018</a></li>
				             <li><a href=''>Isnard Azevedo</a></li>
				             <li><a href='tecnica.html'>Ficha Técnica do Festival</a></li>
				             <li><a href=''>Informações Importantes</a></li>   
					      </ul>
					   </li>
					   <li class='active'><a href='#'>Programação</a>
					   	  <ul>
					         <li><a href=''>Por Locais</a></li>  
				             <li><a href='programacaoDIA.html'>Por Dia</a></li>
					      </ul>
					    </li>

					   <li class='active'><a href='#'>Espetáculos</a>
					      <ul>
					        <li><a href='#'>Mostra Teatros</a></li>
					   		<li><a href=''>Cena Aberta nas Comunidades</a></li>
					   		<li><a href=''>2ª Mostra Quintais Cênicos</a></li>
					   		<li><a href=''>Cena Universitária</a></li>
					   		<li><a href=''>Mostra Paralela</a></li>
					   		<li><a href=''>Circuito Cidades</a></li>
					   	  </ul>
						</li>
					   <li><a href='#'>2ª Mostra Quintais Cênicos</a>
					   	  <ul>
					   		<li><a href='.html'>Espaços</a></li>
					   		<li><a href='.html'>Espetáculos</a></li>
					   		<li><a href='.html'>Oficinas</a></li>
					      </ul>
					   </li>
					  <li><a href='#'>Ações Formativas</a>
					   	  <ul>
					   		<li><a href='.html'>3ª Roda de Conversas Teatrais</a></li>
					   		<li><a href='.html'>Roda de Conversas Teatrais</a></li>
					   		<li><a href='.html'>Oficinas</a></li>
					      </ul>
					   </li>
					  </ul>
					</div>
				</header>

			<header class="special">

		
      

Experimente:

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calendário em PHP</title>
    <?php 
        date_default_timezone_set('America/Sao_Paulo');

        $hoje = getdate(strtotime($_GET['t']));

        $ultimoDia = cal_days_in_month(CAL_GREGORIAN,
                                       $hoje['mon'],
                                       $hoje['year']);

        $primeiraSemana = (($hoje['wday'] + 1) -
                          ($hoje['mday'] - ((int)($hoje['mday'] / 6) * 7))) % 7;
        // Alternativa:
        /*$primeiroDiaTimestamp = strtotime(sprintf("%d-%0d-01",
                                                  $hoje['year'],
                                                  $hoje['mon']));
        $primeiraSemana = (int)date('w', $primeiroDiaTimestamp);*/
    ?>

    <style>
        td[data-semana="0"] { color: #ff0000; }
    </style>
</head>
<body>
    <h1>Estamos em <?= $hoje['year'] ?></h1>
    <p><?= sprintf('Hoje é dia <strong>%0d / %0d</strong>, agora são %02d horas e %0d minutos.',
                   $hoje['mday'], $hoje['mon'], $hoje['hours'], $hoje['minutes'])
    ?></p>

    <table border="1">
        <tr>
            <th>Dom</th>
            <th>Seg</th>
            <th>Ter</th>
            <th>Qua</th>
            <th>Qui</th>
            <th>Sex</th>
            <th>Sáb</th>
        </tr>
        <tr>
        <?php
        for($semana = 0; $semana < $primeiraSemana; ++$semana) {
            echo '<td>&nbsp;</td>';
        }
        for($dia = 1; $dia < $ultimoDia; ++$dia) {
            if( $semana > 6 ) {
                $semana = 0;
                echo '</tr><tr>';
            }

            echo "<td data-semana=\"$semana\">";
            echo "$dia</td>";
            ++$semana;
        }
        for(; $semana < 7; ++$semana) {
            echo '<td>&nbsp;</td>';
        }
        ?>
        </tr>
    </table>
			</header>

		</section>



		</div>
	</section>

			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<a href="www.pmf.sc.gov.br"><img src="images/pmf.png" width="15%"></a>
					</ul>
				</div>
			</footer>

		
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/script.js"></script>

	</body>
</html>

