<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");

if(isset($_POST['btInc_x'])){
	require_once ("../scripts/php/funcoes.php");	
	$cal_id = $_POST['cal_id'];
	$titulo = $_POST['titulo'];
	$data 	= inverteDate($_POST['cal_data']);
	$evento = $_POST['evento'];
		
	$sql = "UPDATE 
				calendario
			SET			
				cal_titulo = '$titulo',
				cal_data = '$data',
				cal_evento = '$evento'
			WHERE
				cal_id = $cal_id";

	$result = $drive->pedido($sql);
	
	if ($result == true){
		echo"<script>alert(\"Data alterada com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=caledit&menu=".$_GET['menu']."&id=$cal_id\";</script>");
	}else{				
		echo"<script>alert(\"Não foi possível alterar a Data.\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=caledit&menu=".$_GET['menu']."&id=$cal_id\";</script>");
	}
		
}else{
	require_once("../scripts/php/funcoes.php");	
	$id 	= $_GET['id'];	
	$sql 	= "SELECT * FROM calendario WHERE cal_id = $id";	
	$result = $drive->pedido($sql);
	$objCal = pg_fetch_object($result);
	?>
	<script>
	function verificaForm(){
		var form = document.getElementById('calendario');
		document.getElementById('cal_data').disabled=false;
	}
	</script>	
	<div class="center">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">editar item do calend&aacute;rio</div>
		<div id="margem_direita"><br>	
			<div class="conteudo_abas">	
				<div id="conteudo_dados" style="display:inline"> 					
					<form name="edita" method="post" onsubmit="return verificaForm()">                                      
					<input type="hidden" name="cal_id" value="<?=$objCal->cal_id?>"  />			
					<div class="texto_formulario">Título do Item:</div>	
					<input name="titulo" type="text" class="componente_miolo" maxlength="100" value="<?=$objCal->cal_titulo?>" />					
					<br />	
					<div class="texto_formulario">Data:</div>	
					<?php 					
					$V_data_2 = explode("-",$objCal->cal_data, 3);	
					$V_data   = $V_data_2[2]."/".$V_data_2[1]."/".$V_data_2[0];					
					?>					
					<input id="cal_data" name="cal_data" value="<?=$V_data?>" disabled="disabled" >&nbsp;<a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>	
					<script>
					Calendar.setup({					
						inputField : "cal_data",						 
						trigger    : "calendar-trigger",
						onSelect   : function() { this.hide() }
					});
					</script>					
					<br />	
					<div class="texto_formulario">Evento Relacionado:</div>	
					<input name="evento" type="text" class="componente_miolo" maxlength="500" value="<?=$objCal->cal_evento?>" />					
					<br />					
					Ex.: http://portal.pmf.sc.gov.br/...                    
					<br />                					
					<br />	
					<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" />                    
					</form>                    
				</div>	
			</div>      	
		</div>	
	</div>
<?php } ?> 
	
