<script>
function verificaForm(){
	var form = document.getElementById('calendario');
	document.getElementById('cal_data').disabled=false;
}
</script>

<div class="center">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">incluir item do calend&aacute;rio</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">
			<?php if(!isset($_POST['btInc_x'])){ ?>            
            <div id="conteudo_dados" style="display:inline"> 
				<form name="calendario" id="calendario" method="post" onsubmit="return verificaForm()">                
				<div class="texto_formulario">Título do Item:</div>
				<input name="titulo" id="titulo" type="text" class="componente_miolo" maxlength="100" />
                <script type="text/javascript">
					var titulo= new LiveValidation('titulo');
					titulo.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script>
                <br />
				<div class="texto_formulario">Data:</div>
				<input id="cal_data" name="cal_data" value="<?=date("d/m/Y")?>" disabled="disabled" >&nbsp;                
                <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>				    
				<script>
					Calendar.setup({					
						inputField : "cal_data",						 
						trigger    : "calendar-trigger",
						onSelect   : function() { this.hide() }
					});
                </script>                
				<br />
                <br />
				<div class="texto_formulario">Evento Relacionado:</div>
                <input name="evento" type="text" class="componente_miolo" maxlength="500" />                
                <br />                
                Ex.: http://portal.pmf.sc.gov.br/...                 
                <br />                                
				<br />
				<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" />                  
                </form>
           	</div>            
            <?php 			
			}			
			if(isset($_POST['btInc_x'])){				
				require_once ("../scripts/php/funcoes.php");								
				$entidade = $_SESSION['SuserEnt'];
				$titulo   = $_POST['titulo'];
				$data 	  = inverteDate($_POST['cal_data']);
				$evento   = $_POST['evento'];
				$tipo 	  = 0;
					
				$sql = "INSERT INTO calendario(
							cal_id,
							cal_entidade_id,
							cal_titulo,
							cal_data,
							cal_evento,
							cal_tipo
						)VALUES(
							default,
							$entidade,
							'$titulo',
							'$data',
							'$evento',
							$tipo)";
				
				$result = $drive->pedido($sql);
				
				if ($result == true){
					echo"<script>alert(\"Data incluida com Sucesso!\");</script>";
					echo("<script>window.location = \"inicio.php?pagina=intracalinclui&menu=".$_GET['menu']."\";</script>");
				}else{				
					echo"<script>alert(\"Não foi possível incluir a Data.\");</script>";
					echo("<script>window.location = \"inicio.php?pagina=intracalinclui&menu=".$_GET['menu']."\";</script>");
				}
			}			
			?>
		</div>
	</div>
</div>
<br class="clearfloat" />