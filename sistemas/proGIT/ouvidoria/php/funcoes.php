<?php


include_once("../../banco/gdb.php"); 

  function montarModulo( $pai, $titulos, $campos, $cabecalho, $tabela, $filtro = "", $visivel = "", $tipo= "" ){ ?>		
		<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><?=$titulo; ?></h3>
			<ol class="breadcrumb">
			<li><?=$pai; ?></li>
			<li><?=$cabecalho; ?></li>
			</ol>
		</div>
		</div>
    <?php  
	
	tabelaOpcoes($titulos, $tabela, $campos, $filtro, $visivel,$tipo );
  } 


  function tabelaOpcoes($titulos = "", $tabela = "", $campos = "", $filtro = "",  $visivel = "", $tipo = "" ){ 

		$gdb = new gdb();  ?>
	
		<section class="panel">
		<header class="panel-heading">
			Op&ccedil;&otilde;es
		</header>
		<div class="panel-body">
			<form class="form-inline">
				<a id="btnExcel" class="btn btn-default btn-sm" href="javascript:;">Excel</a>
				<a id="btnPDF" 			class="btn btn-default btn-sm" href="javascript:;">PDF</a>
				<a id="btnNovoRegistro" class="btn btn-default btn-sm" href="javascript:;">Novo Registro</a>
				<?php
					// print "<div class='navbar-form'>";

					for( $i = 1; $i<=15 ;$i++  ){
						print '&nbsp;';
					}

					print "<select name ='buscar' id ='buscar' class='btn btn-default btn-sm' > ";

					foreach( $titulos as $i=>$value ){
						$value = trim( $value );	
					    if ( $visivel[$i] == 1 && $value !=''  ) print "<option value='".$campos[$i]."'>". $value ."</option>";	
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
			<?=$titulo?>
		</header>
		<table class="table table-bordered">
			<thead>
			<tr>
			<td align='center' ><b>Opera&ccedil;&atilde;o</b></td>  
				<?php  
				
					foreach( $titulos as $i=>$value  ){
					   if( $visivel[$i] == 1 ){ 
						   print "<th><center><b>$value</b></center></th>";
					   } 
					}
				
				?> 
			</tr>
			</thead>
			<tbody>
			
				<?php
                   
				    switch ($tabela) {
						case 'servicoEquipamento':
							$opc = 31;
							break;
					}		
					
					$listaCampo = implode(',',$campos);
					$sql = " Select $listaCampo from $tabela ";
					$gdb->open( $sql );
					$index = strtoupper( $campos[0] );
					

					// varendo o vetor de dados
					foreach( $gdb->gs[$index] as $i=>$value  ){ ?>
						<tr>
							<td width='10%' align='Center' >
								<a class="btn btn-success" href="#" onclick="moduloCadastro(<?=$opc?>,<?=$value?>); "><i class="icon_check_alt2"></i>&nbsp;</a>
								<a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i>&nbsp;</a></td>
							<?php
							
							// varendo o vetor dos nomes do campo 	
							foreach( $campos as $i2=>$value2 ){ 
										$index2 = strtoupper( $value2 );
										if( $visivel[$i2] == 1 ){
											print "<td>".$gdb->gs[$index2][$i]."</td>";
										}  	   
							}?>
						</tr>
						<?php
					}?>
			</tbody>
		</table>
		</section>
	
<?php } 


function montarCadastro( $pai, $NomeCadastro, $tabela, $campos, $titulos ){ ?>
		<div class="col-lg-6">
            <section class="panel">
              <header class="panel-heading">
			  <?=$NomeCadastro?>
              </header>
              <div class="panel-body">
                <form class="form-horizontal" role="form">

				<?php				    

				  /*$listaCampo = implode(',',$campos);
				  $sql = " Select $listaCampo from $tabela ";
				  $gdb->open( $sql );*/				  
				
				foreach( $campos as $i=>$value ){ ?>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label"><?=$titulos[$i]; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" id="<?=$campos[$i]; ?>"  name="<?=$campos[$i]; ?>" placeholder="Infome o <?=$titulos[$i]; ?>" value="">
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
}?>