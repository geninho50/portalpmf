<?php


include_once("gdb.php");

function montarConsulta($pai, $titulos, $campos, $cabecalho, $tabela, $filtro = "", $visivel = "", $tipo = "", $titulo_cadastro = "")
{ ?>
	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li>
					<?= $pai; ?>
				</li>
				<li>
					<?= $cabecalho; ?>
				</li>
			</ol>
		</div>
	</div>
	<?php

	tabelaOpcoes($titulos, $tabela, $campos, $filtro, $visivel, $tipo, $titulo_cadastro);
}


function tabelaOpcoes($titulos = "", $tabela = "", $campos = "", $filtro = "", $visivel = "", $tipo = "", $titulo_cadastro = "")
{    
	$gdb = new gdb(); 
	$opc = buscarOPC($tabela);
	?>

	<section class="panel">
		<header class="panel-heading">
			Op&ccedil;&otilde;es
		</header>
		<div class="panel-body">
			<form class="form-inline">
				<a id="btnExcel" class="btn btn-default btn-sm" href="javascript:;">Excel</a>
				<a id="btnPDF" class="btn btn-default btn-sm" href="javascript:;">PDF</a>
				<a id="btnNovoRegistro" class="btn btn-default btn-sm" href="#"  onclick="moduloCadastro(<?= $opc; ?>,0);" >Novo Registro</a>
				<?php
				// print "<div class='navbar-form'>";
			
				for ($i = 1; $i <= 15; $i++) {
					print '&nbsp;';
				}

				print "<select name ='buscar' id ='buscar' class='btn btn-default btn-sm' > ";

				foreach ($titulos as $i => $value) {
					$value = trim($value);
					if ($visivel[$i] == 1 && $value != '')
						print "<option value='" . $campos[$i] . "'>" . $value . "</option>";
				}

				print "</select> ";
				print "<input type='text' class='btn btn-default input-sm' id='procurar' name='procurar' value='' placeholder='informe o dado para procura' >";
				print "<a id='btnProcurar' class='btn btn-success btn-sm' href='javascript:;'>Procurar</a>";
				// print "</div'>";
				?>
			</form>
		</div>
	</section><br>

	<section class="panel">
		<header class="panel-heading no-border">
			<?= $titulo_cadastro ?>
		</header>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td align='center'><b>Opera&ccedil;&atilde;o</b></td>
					<?php

					foreach ($titulos as $i => $value) {
						if ($visivel[$i] == 1) {
							print "<th><center><b>$value</b></center></th>";
						}
					}

					?>
				</tr>
			</thead>
			<tbody>

				<?php

				$opc = buscarOPC($tabela);

				$listaCampo = implode(',', $campos);
				$sql = 'SELECT ' . $listaCampo . ' FROM "' . $tabela . '"';
				$gdb->open($sql);
				/*
				print '<pre>';
				print_r($gdb);
				print '</pre>';
				*/

				$index = strtoupper($campos[0]);


				// varendo o vetor de dados
				foreach ($gdb->gs[$index] as $i => $value) { ?>
					<tr>
						<td width='10%' align='Center'>
							<?php
							$value2 = intval($value);
							// print 'op��o : ' . $opc;
							?>
							<a class="btn btn-success" href="#" onclick="moduloCadastro(<?= $opc; ?>,<?= $value2; ?>);">
								<i class="icon_check_alt2"></i>&nbsp;</a>
							<a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i>&nbsp;</a>
						</td>
						<?php

						// varendo o vetor dos nomes do campo 	
						foreach ($campos as $i2 => $value2) {
							$index2 = strtoupper($value2);
							if ($visivel[$i2] == 1) {
								print "<td>" . $gdb->gs[$index2][$i] . "</td>";
							}
						} ?>
					</tr>
					<?php
				} ?>
			</tbody>
		</table>
	</section>

<?php }


function montarCadastro($pai, $NomeCadastro, $tabela, $campos, $titulos,$id )
{       
	$gdb = new gdb();
	?>
	<div class="col-lg-6">
		<section class="panel">
			<header class="panel-heading">
				<?= $NomeCadastro ?>
			</header>
			<div class="panel-body">
				<form class="form-horizontal" role="form">

					<?php

					$listaCampo = implode(',',$campos);										
					$sql = 'SELECT '.$listaCampo.' FROM "'.$tabela.'" WHERE '.$campos[0].' = '.$id;
					$gdb->open( $sql );

					foreach ($campos as $i => $value) { 
						$index = strtoupper( $value );
						$valor = $gdb->gs[$index][0]; ?>

						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">
								<?= $titulos[$i]; ?>
							</label>							
							<div class="col-lg-10">
							    <?php if($i !==0 ){  ?>
										<input type="text" 
											class="form-control" 
											id="<?= $value; ?>" 
											name="<?= $value; ?>"
											placeholder="Infome o <?= $titulos[$i]; ?>" 
											value="<?= $valor; ?>" >
								<?php }else{ ?>	   
									    	<p class="help-block"><?= $valor; ?></p>
								<?php } ?>	   	
								<!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
						</div>

			 <?php } ?>

					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-success">Salvar</button>
							<button type="submit" class="btn btn-danger">Cancelar</button>
						</div>
					</div>

				</form>
			</div>
		</section>
	</div>
	<?php
}

function buscarOPC($tabela){
	$opc = 0;
	switch ($tabela) {
		case "SERVICOEquipamento":
			$opc = 31;
			break;
		default:
			$opc = 0;
	}

	return $opc;
}

?>