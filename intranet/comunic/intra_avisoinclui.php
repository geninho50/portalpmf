<?php 
if(!isset($_POST['btInc_x'])){ 
?>

<script>
function verificaForm(){
	document.getElementById('fdataNoticia').disabled=false;
}
</script>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
   	<div id="titulo_pagina">incluir aviso</div>
	<div id="margem_direita"><br>
 	    
		<div class="conteudo_abas">
      		<div id="conteudo_dados" style="display:inline">
            	<form name="form" method="post" onsubmit="return verificaForm()">
                	<div class="texto_formulario">Título:</div>
                    <input name="ftitulo" id="ftitulo" type="text" class="componente_miolo" maxlength="100" /><br>
                    <script type="text/javascript">
						var ftitulo= new LiveValidation('ftitulo');
						ftitulo.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
                    <div class="texto_formulario">Texto:</div>
                    <label><textarea name="ftexto" id="textarea" class="componente_miolo" cols="45" rows="15"></textarea></label><br>                        
                    <div class="texto_formulario">Tags de Busca:</div>				
					<input type="text" name="Ftags" class="ui-widget-content ui-corner-all" id="Ftags"/>Dica: cadastre tamb&eacute;m o t&iacute;tulo do aviso como TAG de busca. <br /><br />
                    <script type="text/javascript">
						var Ftags= new LiveValidation('Ftags');
						Ftags.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
                    <div class="texto_formulario">Data do Aviso:</div>
                    <input name="fdataNoticia" id="fdataNoticia" type="text" class="componente_miolo_medio" value="<?php echo $data=date("d/m/Y");?>" disabled="disabled"/>
                    <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
				    
					<script>
                        Calendar.setup({					
                            inputField : "fdataNoticia",						 
                            trigger    : "calendar-trigger",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                    <div class="texto_formulario">Hora do Aviso:</div>
                    <input name="fhoraNoticia" type="text" class="componente_miolo_medio" value="<?php echo $hora=date("h:i");?>" maxlength="5" />
                    <br> <br>  
                    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" />
                </form>
			</div>
		</div>
	</div>
</div><!-- fim coluna_C2 -->  
<?php
}
else{
	$Tentidade      = $_SESSION['SuserEnt'];
	$Ttitulo        = $_POST['ftitulo'];
	$Ttexto			= $_POST['ftexto'];
	$TtagBusca		= $_POST['Ftags'];
	$data			= explode("/",$_POST['fdataNoticia']);
	$TdataNoticia	= $data[2]."-".$data[1]."-".$data[0];
	$ThoraNoticia	= $_POST['fhoraNoticia'];
	$TuserId		= $_SESSION['SuserId'];
	
	//-------------------------
	// Faz a inserção do aviso
	//-------------------------
	$sql="INSERT INTO intranet_avisos
		VALUES(
			   default,
			   '$TtagBusca',
			   '$Ttexto',
			   '$TdataNoticia',
			   '$ThoraNoticia',
			   '$Tentidade',
			   '$Ttitulo',
			    $TuserId
			   )";

	$retorno=$drive->pedido($sql);
	if($retorno == true){
			echo("<script>alert('Aviso incluido com Sucesso')</script>");	
			echo("<script>window.location = \"inicio.php?pagina=avisoinclui&menu=".$_GET['menu']."\";</script>");
	}else{
			echo("<script>alert('Nao foi possivel incluir o Aviso')</script>");
			echo("<script>window.location = \"inicio.php?pagina=avisoinclui&menu=".$_GET['menu']."\";</script>");
	}
}
?>