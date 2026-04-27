<?php 
if(!isset($_POST['btInc_x'])){
	$id 	  = $_GET['id'];
	$sql	  = "SELECT * FROM intranet_avisos WHERE intranet_avisos_id=$id";
	$Tretorno = $drive->pedido($sql);
	$editar   = pg_fetch_object($Tretorno);
?>
<script>
function verificaForm(){
	document.getElementById('fdataNoticia').disabled=false;
}
</script>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar aviso</div>
	<div id="margem_direita"><br>
		    
		<div class="conteudo_abas">
        	<form name="form" method="post" onsubmit="return verificaForm()">
                <div id="conteudo_dados" style="display:inline">
                    <input type="hidden" name="FavisoId" value="<?=$id?>" />
                    <div class="texto_formulario">Título:</div>
                    <input name="ftitulo" type="text" value="<?php echo $editar->intranet_avisos_titulo; ?>" class="componente_miolo" maxlength="100" /><br>
                    <div class="texto_formulario">Texto:</div>
                    <label>
                    <textarea name="ftexto" id="textarea" class="componente_miolo" cols="45" rows="15"><?php echo $editar->intranet_avisos_texto; ?></textarea>
                    </label>
                    <br>                    
                    <div class="texto_formulario">Tags de Busca:</div>					
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?php echo $editar->intranet_avisos_palavra_chave; ?>"/>Dica: cadastre tamb&eacute;m o t&iacute;tulo do aviso como TAG de busca. <br /><br />
                	<script type="text/javascript">
						var Ftags= new LiveValidation('Ftags');
						Ftags.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
                    <div class="texto_formulario">Data do Aviso:</div>
                    <input name="fdataNoticia" id="fdataNoticia" type="text" class="componente_miolo_medio" value="<?php $data=explode("-",$editar->intranet_avisos_data); $datafim=$data[2]."/".$data[1]."/".$data[0]; echo $datafim; ?>" disabled="disabled"/>
                    <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
				    
					<script>
                        Calendar.setup({					
                            inputField : "fdataNoticia",						 
                            trigger    : "calendar-trigger",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                    <div class="texto_formulario">Hora do Aviso:</div>
                    <input name="fhoraNoticia" type="text" class="componente_miolo_medio" value="<?php echo $editar->intranet_avisos_hora; ?>" maxlength="5" />
                    <br> <br>  
                    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" />
                </div>
       		</form>
		</div>
	</div>
</div><!-- fim coluna_C2 -->  
<?php
	}
	else{
		$id			  = $_POST['FavisoId'];
		$Tentidade	  = $_SESSION['SuserEnt'];
		$Ttitulo	  = $_POST['ftitulo'];
		$Ttexto		  = $_POST['ftexto'];
		$TtagBusca	  = $_POST['Ftags'];
		$data		  = explode("/",$_POST['fdataNoticia']);
		$TdataNoticia = $data[2]."-".$data[1]."-".$data[0];
		$ThoraNoticia = $_POST['fhoraNoticia'];
		
		//---------------------------------
		// Faz a inserção dos campos novos
		//---------------------------------
		$sql="UPDATE 
				intranet_avisos
			SET
				   intranet_avisos_id='$id',
				   intranet_avisos_palavra_chave='$TtagBusca',
				   intranet_avisos_texto='$Ttexto',
				   intranet_avisos_data='$TdataNoticia',
				   intranet_avisos_hora='$ThoraNoticia',
				   intranet_avisos_titulo='$Ttitulo'
			WHERE  
					intranet_avisos_id=$id";
		
		$Tretorno=$drive->pedido($sql);
		if($Tretorno == true){
			echo"<script>alert(\"Aviso Editado com Sucesso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=avisoedit&menu=".$_GET['menu']."&id=".$id."\";</script>");
		}else{
			echo"<script>alert(\"Nao foi possivel Editar o Aviso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=avisoedit&menu=".$_GET['menu']."&id=".$id."\";</script>");
		}
	}
?>