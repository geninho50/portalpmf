<!--**
 	*  SMPU - BASE DE DADOS CONTROLE DE VIAGENS LACUSTRE
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->

<?php
include_once("conexao.php");
$current_page = pathinfo(__FILE__);
$current_page = $current_page['basename'];


$data = (isset($_REQUEST['data'])) ? $_REQUEST['data'] : date("Y-m-d");
$viagens_dia = (isset($_GET['viagens_dia'])) ? $_GET['viagens_dia'] : 0;


$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$numresultados = (isset($_GET['numresultados'])) ? $_GET['numresultados'] : 1000; //Número inicial de resultados por página
unset($_GET);

$data = (isset($_REQUEST['data'])) ? $_REQUEST['data'] : date("Y-m-d");
$data_ant = null;
$select_data_operacao = $data;
$select_data_anterior = strtotime('-1 days', strtotime($data));
$select_data_posterior = strtotime('+1 days', strtotime($data));

//Selecionar todos os itens da tabela para contagem inicial
$query_01 = "SELECT * FROM lacustre.viagens";
$resultado_01 = $conn->query($query_01);
$total_01 = $resultado_01->rowCount(); //contagens query inicial

//calcular o número de pagina necessárias para apresentar os resultados
$num_pagina = ceil($total_01 / $numresultados);
$total = $total_01;
$quantidadeDeLinks = ceil($total / $numresultados);
//Calcular o inicio da visualizacao
$inicio = ($numresultados * $pagina) - $numresultados;

//Selecionar os resultados a serem apresentado para cada página 
$query_02 = "  SELECT * FROM lacustre.viagens LIMIT $numresultados OFFSET $inicio";
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
	<style>
		.pequeno {
			width: 40px;
			margin:0 5px 0 0;
			align-content: center;
		}

		.medio {
			margin:0 5px 0 0;
			align-content: center;
			width: 50%;
		}
	</style>

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

                            <div class="button-group mr-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MODALpesquisacadastrar">Cadastrar</button>
                            </div>
                            <div class="button-group mr-2 ">
                                <input type="text" class="input-search btn btn-outline-secondary" alt="lista-clientes" placeholder="Buscar nesta lista" />
                            </div>
                            <div class="btn-group">
                                <input type="date" name="data" class="btn btn-outline-secondary" id="" value="<?php echo $data ?>" placeholder="<?php echo $data ?>">
                                <button class="btn btn-outline-secondary fa fa-search-plus" type="submit"></button>
                                <button type="submit" name="data" class="btn btn-outline-secondary fa fa-arrow-left" value="<?php echo date('Y-m-d', $select_data_anterior) ?>">
                                </button>
                                <button type="submit" name="data" class="btn btn-outline-secondary fa fa-arrow-right" value="<?php echo date('Y-m-d', $select_data_posterior) ?>">
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="3">
                    <a type="button" class="btn btn-outline-info" href="" role="button">DashBoard</a>
                    <a type="button" class="btn btn-outline-info" href="relatorios_extras.php" role="button">Relatórios</a>
                </div>

            </div>
			<br>
			
			<div class="row">
				<?php while ($row = $resultado_02->fetch()) { 
					
						if (date('d-m-Y', strtotime($row['data_viagem'])) != $data_ant) { ?>
						
			</div>
		</div>

		<table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">

			<tr class="table-primary">
				<td><b><a class="text-default">#</a></b></td>
				<td><b><a class="text-default">Data</a></b></td>
				<td><b><a class="text-default">Horário</a></b></td>
				<td><b><a class="text-default">Modalidade</a></b></td>
				<td><b><a class="text-default">Sentido</a></b></td>
				<td><b><a class="text-default">Embarcação</a></b></td>
				<td><b><a class="text-default">Status</a></b></td>
				<td><b><a class="text-default">Ação</a></b></td>
			</tr>


			<?php
                        //reinicia variaveis data e numero de viagens para apresentar na tabela
                        $data_ant = (date('d-m-Y', strtotime($row['data_viagem'])));
                        $totalviagensdia = $viagens_dia;
                        $viagens_dia = 0;
            ?>
			<?php 
								if ($row['status'] == '1')
								$status = 'Pre-cadastro';
							if ($row['status'] == '2')
								$status = 'Validada';
							if ($row['status'] == '3')
								$status = 'Justificar';
						?>

			<tr>
					<td width=5%><?php echo $row['id']; ?></td>
					<td width=12%><?php echo date('d/m/y', strtotime($row['data_viagem'])); ?></td>
					<td width=10%><?php echo date('H:i', strtotime($row['horario']));$row['horario']; ?></td>
					<td width=10%><?php echo $row['modalidade']; ?></td>

					<td width=10%><?php echo $row['sentido']; ?></td>
					<td width=10%><?php echo $row['id_embarcacao']; ?></td>
					<td width=10%><?php echo $status ?></td>
					<td width=auto>
						<button type="button" class="btn btn-outline-info btn-sm fa fa-picture-o pequeno" data-toggle="modal" data-target="#MODALverimagem" data-teid="<?php echo $row['id']; ?>" data-id_embarcacao="<?php echo $row['id_embarcacao']; ?>" data-data_operacao="<?php echo date('d/m/Y', strtotime($row['data_viagem'])); ?>" data-horario_operacao="<?php echo $row['horario']; ?>" data-sentido="<?php echo $row['sentido']; ?>" data-fichadeviagem="<?php echo $row['imagem']; ?>"/>
						<button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALapagar" data-teid="<?php echo $row['id']; ?>" data-id_embarcacao="<?php echo $row['id_embarcacao']; ?>" data-data_operacao="<?php echo date('d/m/Y', strtotime($row['data_viagem'])); ?>" data-horario_operacao="<?php echo $row['horario']; ?>" data-sentido="<?php echo $row['sentido']; ?>" />
					</td>
				</tr>

			<?php } ?>



            <?php } ?>


			</tbody>
        </table>
        <?php } ?>
	</div>

	<!-- MODAL APAGAR Viagem-->
	<div id="MODALapagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Apagar Viagem</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<strong>
						<h5>
							<p id="teid" class="text-muted"></p>
						</h5>
						<h6>
							<p id="edata_operacao" class="text-muted"></p>
							<p id="ehorario_operacao" class="text-muted"></p>
							<p id="esentido" class="text-muted"></p>
							<p id="eembarcacao" class="text-muted"></p>
						</h6>
					</strong>
				</div>
				<div class="modal-footer">
					<form method="POST" action="viagens_apagar.php" enctype="multipart/form-data">
						<input name="eid" type="hidden" id="eid">
						<input type="hidden" id="numresultados" name="numresultados" value="<?php echo $numresultados ?>">
						<input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina ?>">
						<button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-danger">Confirmar</button>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!-- FIM Modal Apagar Viagem-->


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
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=50&pagina=<?php echo $pagina; ?>"> 50</a>
						</li>
						<li class="page-item <?php if ($numresultados == 50) echo 'active';
												else echo ''; ?>">
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=100&pagina=<?php echo $pagina; ?>">100</a>
						</li>
						<li class="page-item <?php if ($numresultados == 5000) echo 'active';
												else echo ''; ?>">
							<a class="page-link" href="<?php echo $current_page ?>?numresultados=1000&pagina=<?php echo $pagina; ?>">1000 de <?php echo $total_01; ?></a>
						</li>
					</ul>
				</nav>
			</div> <!-- paginador -->

			<div class="col-sm"></div> <!-- vazio central -->

			<div class="col-sm">
				<nav class="text-left" aria-label="Paginador_pagina">
					<ul class="pagination justify-content-right">
						<li class="page-item">
							<a class="page-link" href="<?php echo $current_page ?>?pagina=1&numresultados=<?php echo $numresultados; ?>">Primeira</a>
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
									<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>"><?php echo $i; ?></a>
								</li>

							<?php } else { ?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>"><?php echo $i; ?></a>
								</li>
						<?php  }
						} ?>
						<!-- paginador vai ao final-->

						<li class="page-item ">
							<a class="page-link" href="<?php echo $current_page ?>?pagina=<?php echo $quantidadeDeLinks; ?>&numresultados=<?php echo $numresultados; ?>">Última</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<!--FINAL PAGINADOR -->

	<script type="text/javascript">
		//---- MODAL APAGAR

		$('#MODALapagar').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipientid = button.data('teid') // Extract info from data-* attributes
			var recipient_sentido = button.data('sentido') // Extract info from data-* attributes
			var recipientid_embarcacao = button.data('id_embarcacao') // Extract info from data-* attributes
			var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
			var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('#teid').text('Apagar registro ID :' + recipientid)
			modal.find('#edata_operacao').text('Dia: ' + recipientdata_operacao)
			modal.find('#ehorario_operacao').text('Horário: ' + recipienthorario_operacao)
			modal.find('#esentido').text(' Sentido: ' + recipient_sentido)
			modal.find('#eembarcacao').text(' Embarcação: ' + recipientid_embarcacao)
			modal.find('#eid').val(recipientid)
		})


		$('#MODALverimagem').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipientid = button.data('teid') // Extract info from data-* attributes
			var recipient_sentido = button.data('sentido') // Extract info from data-* attributes
			var recipientid_embarcacao = button.data('id_embarcacao') // Extract info from data-* attributes
			var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
			var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes
			var recipientfichadeviagem = button.data('fichadeviagem') // Extract info from data-* attributes



			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('#teid').text('Ficha de Viagem do registro ID: ' + recipientid)
			modal.find('#edata_operacao').text('Dia | Horário: ' + recipientdata_operacao + ' | ' + recipienthorario_operacao)
			modal.find('#esentido').text(' Sentido | Embarcação: ' + recipient_sentido + ' | ' + recipientid_embarcacao )
			$("#previewfichadeviagem").html('<div class="col-sm-12"><img src="http://redemobilidade.pmf.sc.gov.br/' + recipientfichadeviagem + ' " class="img-fluid rounded" alt="Imagem responsiva"></div>');
		})


		//---- MODAL EDITAR

		$('#MODALeditar').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipientid = button.data('id') // Extract info from data-* attributes
			var recipient_num = button.data('num') // Extract info from data-* attributes
			var recipient_nome = button.data('nome') // Extract info from data-* attributes
			var recipientid_validador = button.data('id_validador') // Extract info from data-* attributes
			var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
			var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes
			var recipientid_veiculo = button.data('id_veiculo') // Extract info from data-* attributes
			var recipient_sentido = button.data('sentido') // Extract info from data-* attributes
			var recipient_motivo1 = button.data('motivo1') // Extract info from data-* attributes
			var recipient_solicitacao_user = button.data('solicitacao_user') // Extract info from data-* attributes
			var recipient_obs = button.data('obs') // Extract info from data-* attributes

			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Editar : ' + recipientid + ' | ' + recipient_num)
			modal.find('#edit_id').val(recipientid)
			modal.find('#edit_num').val(recipient_num + ' - ' + recipient_nome)
			modal.find('#edit_nome').val(recipient_nome)
			modal.find('#edit_id_validador').val(recipientid_validador)
			modal.find('#edit_data_operacao').val(recipientdata_operacao)
			modal.find('#edit_horario_operacao').val(recipienthorario_operacao)
			modal.find('#edit_id_veiculo').val(recipientid_veiculo)
			modal.find('#edit_sentido').val(recipient_sentido)
			modal.find('#edit_motivo1').val(recipient_motivo1)
			modal.find('#edit_solicitacao_user').val(recipient_solicitacao_user)
			modal.find('#edit_obs').val(recipient_obs)

		})
	</script>













</body>

</html>