<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->

<?php
include_once("conexao.php");

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
$data = (isset($_REQUEST['data'])) ? $_REQUEST['data'] : date("Y-m-d");
unset($_POST);
unset($_REQUEST);
$select_data_operacao = $data; //utilizado para pesquisa no banco de dados
$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : 1;
$orderdir = (isset($_GET['orderdir'])) ? $_GET['orderdir'] : 'DESC';
$viagens_dia = (isset($_GET['viagens_dia'])) ? $_GET['viagens_dia'] : 0;
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$numresultados = (isset($_GET['numresultados'])) ? $_GET['numresultados'] : 50; //Número inicial de resultados por página
unset($_GET);
//Seta variáveis usadas
$tabela01 = 'sim.viagensextras';
$tabela02 = 'sim.frota';

$data_ant = null;

//paginador por datas
$select_data_operacao = $data;
$select_data_anterior = strtotime('-1 days', strtotime($data));
$select_data_posterior = strtotime('+1 days', strtotime($data));

//INNER JOIN sim.setores c ON b.num = c.num

//Selecionar todos os itens da tabela 
$query_01 = "SELECT * FROM lacustre.viagens WHERE data_operacao ='$select_data_operacao'";
$resultado_01 = $conn->query($query_01);
$total_01 = $resultado_01->rowCount(); //contagens query inicial]

//calcular o número de pagina necessárias para apresentar os resultados
$num_pagina = ceil($total_01 / $numresultados);
$total = $total_01;
$quantidadeDeLinks = ceil($total / $numresultados);

//Calcular o inicio da visualizacao
$inicio = ($numresultados * $pagina) - $numresultados;

//Selecionar os resultados a serem apresentado para cada página 
$query_02 = "SELECT * FROM lacustre.viagens";
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
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="remob.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="javascriptpersonalizado.js"></script>
	<script type="text/javascript" src="javascript_frota.js"></script>
	<script src="sorttable.js"></script>
	<script type="text/javascript" src="jquery.quick.search.js"></script>

	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/tempusdominus-bootstrap-4.min.js"></script>

	<link href="css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.pt-BR.min.js"></script>

	<style>
		.pequeno {
			width: 40px;
			margin: 0 5px 0 0;
			align-content: center;
		}

		.medio {
			margin: 0 5px 0 0;
			align-content: center;
			width: 50%;
		}
	</style>

	<title>Base de Dados SIM - Dash Viagens Lacustre</title>
</head>

<body>

			<table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">
			<tr>
				<td>#</td>
				<td>Data</td>
				<td>Horário</td>
				<td>Modalidade</td>
				<td>Sentido</td>
				<td>Embarcação</td>
				<td>Status</td>
				<td>morador_cadastrado</td>
				<td>morador_gestante</td>
				<td>pcd</td>
				<td>pcd_acompanhante</td>
				<td>estudante_menor</td>
				<td>mae_estudante</td>
				<td>estudante</td>
				<td>idoso</td>
				<td>nao_cadastrado</td>

				<?php
				$i = 1;
				for ($i = 1; $i <= 23; $i++) {?>
					<td><?php echo $i?>e</td>
					<?php
				};
				
				$j = 1;
				for ($j = 1; $j <= 23; $j++) {?>
					<td><?php echo $j?>d</td>

					<?php
				};
				?>
			</tr>

<?php while ($row = $resultado_02->fetch()) {
	$passageiros=$row['passageiros'];
	$passageiros1 = json_decode($passageiros);
	$embarque=$row['embarque'];
	$embarque = json_decode($embarque, true);
	$desembarque=$row['desembarque'];
	$desembarque = json_decode($desembarque, true);

	if ($row['status'] == '1')
	$status = 'Pre-cadastro';
if ($row['status'] == '2')
	$status = 'Validada';
if ($row['status'] == '3')
	$status = 'Justificar';

$horario_operacao = date('H:i', strtotime($row['horario_operacao']));
$data_operacao = date('d-m-Y', strtotime($row['data_operacao']));

		?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $data_operacao ?></td>
			<td><?php echo $horario_operacao ?></td>
			<td><?php echo $row['modalidade']; ?></td>
			<td><?php echo $row['sentido']; ?></td>
			<td><?php echo $row['id_embarcacao']; ?></td>
			<td><?php echo $status ?></td>
			<td><?php echo $passageiros1->morador_cadastrado; ?></td>
			<td><?php echo $passageiros1->morador_gestante; ?></td>
			<td><?php echo $passageiros1->pcd; ?></td>
			<td><?php echo $passageiros1->pcd_acompanhante; ?></td>
			<td><?php echo $passageiros1->estudante_menor; ?></td>
			<td><?php echo $passageiros1->mae_estudante; ?></td>
			<td><?php echo $passageiros1->estudante; ?></td>
			<td><?php echo $passageiros1->idoso; ?></td>
			<td><?php echo $passageiros1->nao_cadastrado; ?></td>
			<?php
				$i = 1;
				for ($i = 1; $i <= 23; $i++) {?>
					<td><?php echo $embarque[$i];?></td>
					<?php
				};
				?>


<?php
				$j = 1;
				for ($j = 1; $j <= 23; $j++) {?>
					<td><?php echo $desembarque[$j];?></td>
					<?php
				};
				?>
		</tr>
	<?php } ?>

		</table>
	</div>


	<!-- MODAL Visualizar Imagem-->
	<div id="MODALverimagem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="MODALverimagem">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Ficha de Viagem</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<strong>
						<h5>
							<p id="teid" class="text-muted"></p>
						</h5>
						<h6>
							<p id="edata_operacao" class="text-muted"></p>
							<p id="esentido" class="text-muted"></p>
							<span id="previewfichadeviagem"></span>

						</h6>
					</strong>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!-- FIM Modal Apagar Viagem-->

	<div class="container">
		<div class="row">
			<div class="col-sm">
				<!-- fixador de quantidade de itens por página -->
				<nav class="text-center" aria-label="Paginador_quantidade">
					<ul class="pagination justify-content-left">
						<li class="page-item <?php if ($numresultados == 50) echo 'active';
												else echo ''; ?>">
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=50&pagina=<?php echo $pagina; ?>&data=<?php echo $data; ?>">50</a>
						</li>
						<li class="page-item <?php if ($numresultados == 100) echo 'active';
												else echo ''; ?>">
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=100&pagina=<?php echo $pagina; ?>&data=<?php echo $data; ?>">100</a>
						</li>
						<li class="page-item <?php if ($numresultados == 200) echo 'active';
												else echo ''; ?>">
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=200&pagina=<?php echo $pagina; ?>&data=<?php echo $data; ?>">200</a>
						</li>
					</ul>
				</nav>
			</div> <!-- paginador -->

			<div class="col-sm"></div> <!-- vazio central -->

			<div class="col-sm">
				<nav class="text-left" aria-label="Paginador_pagina">
					<ul class="pagination justify-content-right">
						<li class="page-item">
							<a class="page-link" href="<?php echo $current_page ?>?pagina=1&numresultados=<?php echo $numresultados; ?>&data=<?php echo $data; ?>">Primeira</a>
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
									<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>&data=<?php echo $data; ?>"><?php echo $i; ?></a>
								</li>

							<?php } else { ?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>&data=<?php echo $data; ?>"><?php echo $i; ?></a>
								</li>
						<?php  }
						} ?>
						<!-- paginador vai ao final-->

						<li class="page-item ">
							<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $quantidadeDeLinks; ?>&numresultados=<?php echo $numresultados; ?>&data=<?php echo $data; ?>">Última</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<!--FINAL PAGINADOR -->


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		//---- MODAL APAGAR

		//---- MODAL VER IMAGEM


		$('#MODALverimagem').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipientid = button.data('teid') // Extract info from data-* attributes
			var recipient_sentido = button.data('sentido') // Extract info from data-* attributes
			var recipientid_embarcacao = button.data('id_embarcacao') // Extract info from data-* attributes
			var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
			var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes
			var recipientfichadeviagem = button.data('fichadeviagem') // Extract info from data-* attributes
			var modal = $(this)
			modal.find('#teid').text('Ficha de Viagem do registro ID: ' + recipientid)
			modal.find('#edata_operacao').text('Dia | Horário: ' + recipientdata_operacao + ' | ' + recipienthorario_operacao)
			modal.find('#esentido').text(' Sentido | Embarcação: ' + recipient_sentido + ' | ' + recipientid_embarcacao)
			$("#previewfichadeviagem").html('<div class="col-sm-12"><img src="http://redemobilidade.pmf.sc.gov.br/' + recipientfichadeviagem + ' " class="img-fluid rounded" alt="Imagem responsiva"></div>');
		})
	</script>
</body>

</html>