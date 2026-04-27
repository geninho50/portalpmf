<!--**
 	*  SMPU - BASE DE DADOS client_report
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->

 <?php
include_once("conexao.php");
$current_page = pathinfo(__FILE__);
$current_page = $current_page['basename'];

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$numresultados = (isset($_GET['numresultados'])) ? $_GET['numresultados'] : 1000; //Número inicial de resultados por página
unset($_GET);

//Selecionar todos os itens da tabela para contagem inicial
$query_01 = "SELECT * FROM public.clients_report";
$resultado_01 = $conn->query($query_01);
$total_01 = $resultado_01->rowCount(); //contagens query inicial

//calcular o número de pagina necessárias para apresentar os resultados
$num_pagina = ceil($total_01 / $numresultados);
$total = $total_01;
$quantidadeDeLinks = ceil($total / $numresultados);
//Calcular o inicio da visualizacao
$inicio = ($numresultados * $pagina) - $numresultados;

//Selecionar os resultados a serem apresentado para cada página 
$query_02 = "SELECT * FROM public.clients_report LIMIT $numresultados OFFSET $inicio";
$resultado_02 = $conn->query($query_02);
$total_02 = $resultado_02->rowCount();

?>

<!DOCTYPE HTML>
<html lang="pt-br">




<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="javascriptpersonalizado.js"></script>
	<script type="text/javascript" src="javascript_frota.js"></script>
	<script src="sorttable.js"></script>

	<script type="text/javascript" src="jquery.quick.search.js"></script>
	<script type="text/javascript" src="/js/jquery.js"></script>

	<!-- máscaras para input formularios !-->
	<script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
	<script src="formrules.js"></script>

</head>

<body>
	<!--CABECALHO -->
	<div class="container" theme-showcase" role="main">
		<br>




		<div class="page-header rounded">
			<img src="http://redemobilidade.pmf.sc.gov.br/bas/img/cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
		</div>
		<div class="container" role="main">
			<br>
			<!-- Fim imagem cabeçalho -->
			<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
				<div class="btn-group mr-2" role="group" aria-label="1 group">
					<form method="POST" action="" enctype="multipart/form-data">
						<div class="botton-group row">
							<div class="button-group mr-2 ">
								<input type="text" class="input-search btn btn-outline-secondary" alt="lista-clientes" placeholder="Buscar nesta lista" />
							</div>
						</div>
					</form>
				</div>

			</div>
			<br>
		</div>
	</div>
	<!--FIM CABECALHO -->
	<div class="container" theme-showcase" role="main">

		<table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">

		<tr class="table-primary">
					<td><b><a class="text-default">#</a></b></td>
					<td><b><a class="text-default">Nome</a></b></td>
					<td><b><a class="text-default">Documento</a></b></td>
					<td><b><a class="text-default">Saldo</a></b></td>
					<td><b><a class="text-default">Origem</a></b></td>
				</tr>
			<?php while ($row = $resultado_02->fetch()) { ?>

		<tr>
					<td width=7%><?php echo $row['id']; ?></td>
						<td width=30%><?php echo $row['Nome']; ?></td>
						<td width=20%><?php echo $row['Documento']; ?></td>
						<td width=10%><?php echo $row['Saldo']; ?></td>
						<td width=auto><?php echo $row['Cadastro_Origem']; ?></td>
					</tr>







	<?php } ?>

	</tbody>
		</table>
	</div>






		</div>
		</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	
<!--PAGINADOR -->


<div class="container">
			<div class="row">
				<div class="col-sm">
					<!-- fixador de quantidade de itens por página -->
					<nav class="text-center" aria-label="Paginador_quantidade">
						<ul class="pagination justify-content-left">
							<li class="page-item <?php if ($numresultados == 50) echo 'active';
													else echo ''; ?>">
								<a class="page-link" href="clients_report_db.php?numresultados=50&pagina=<?php echo $pagina; ?>"> 50</a>
							</li>
							<li class="page-item <?php if ($numresultados == 50) echo 'active';
													else echo ''; ?>">
								<a class="page-link" href="clients_report_db.php?numresultados=100&pagina=<?php echo $pagina; ?>">100</a>
							</li>
							<li class="page-item <?php if ($numresultados == 5000) echo 'active';
													else echo ''; ?>">
								<a class="page-link" href="clients_report_db.php?numresultados=1000&pagina=<?php echo $pagina; ?>">1000 de <?php echo $total_01; ?></a>
							</li>
						</ul>
					</nav>
				</div> <!-- paginador -->

				<div class="col-sm"></div> <!-- vazio central -->

				<div class="col-sm">
					<nav class="text-left" aria-label="Paginador_pagina">
						<ul class="pagination justify-content-right">
							<li class="page-item">
								<a class="page-link" href="clients_report_db.php?pagina=1&numresultados=<?php echo $numresultados; ?>">Primeira</a>
							</li>

							<!-- paginador numerador-->
							<?php
							for ($i = $pagina - 2, $limiteDeLinks = $i + 4; $i <= $limiteDeLinks; $i++) {
								if ($i < 1) {
									$i = 1;
									$limiteDeLinks = 5;
								}
								if ($limiteDeLinks > $quantidadeDeLinks) {
									$limiteDeLinks = $quantidadeDeLinks;
									$i = $limiteDeLinks - 4;
								}
								if ($i < 1) {
									$i = 1;
									$limiteDeLinks = $quantidadeDeLinks;
								}

								if ($i == $pagina) { ?>

									<li class="page-item active">
										<a class="page-link" href="clients_report_db.php?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>"><?php echo $i; ?></a>
									</li>

								<?php } else { ?>
									<li class="page-item">
										<a class="page-link" href="clients_report_db.php?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>"><?php echo $i; ?></a>
									</li>
							<?php  }
							} ?>
							<!-- paginador vai ao final-->

							<li class="page-item ">
								<a class="page-link" href="clients_report_db.php?pagina=<?php echo $quantidadeDeLinks; ?>&numresultados=<?php echo $numresultados; ?>">Última</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<!--FINAL PAGINADOR -->




</body>

</html>