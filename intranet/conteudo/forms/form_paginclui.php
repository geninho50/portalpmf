<?php if(!isset($_POST['btSalvPag_x'])){?>
<script>
function verificaForm(){
	document.getElementById('Fdata').disabled=false;
}
</script>
<form method="post" onsubmit="return verificaForm()">
    <div class="texto_formulario">Status da Página:</div>
    <input name="Fstatus" type="radio" value="0" checked="checked" />Em edição
    <input name="Fstatus" type="radio" value="1" />Publicar<br>
    <div class="texto_formulario">Título:</div>
    <input name="Ftitulo" id="Ftitulo" type="text" class="componente_miolo" maxlength="100" /><br>
    <script type="text/javascript">
		var Ftitulo = new LiveValidation('Ftitulo'); 
		Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
	</script> 
    <div class="texto_formulario">Texto:</div>
    <label>
    <textarea name="Ftexto" id="Ftexto" class="componente_miolo_grande" cols="45" rows="25"></textarea>
    </label>
    <script type="text/javascript">
		var Ftexto = new LiveValidation('Ftexto'); 
		Ftexto.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
	</script>
    <br> 
    <div class="texto_formulario">Tags de Busca:</div>
	<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>Dica: cadastre tamb&eacute;m o t&iacute;tulo da p&aacute;gina como TAG de busca. 
    <script type="text/javascript">
		var Ftags = new LiveValidation('Ftags'); 
		Ftags.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
	</script>
    <div class="texto_formulario">Data:</div>
    <?php $data = date("d/m/Y")?>
    <input name="Fdata" id="Fdata" type="text" class="componente_miolo_medio" value="<?=$data?>" disabled="disabled" />
    <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>				    
	<script>
        Calendar.setup({					
            inputField : "Fdata",						 
            trigger    : "calendar-trigger",
            onSelect   : function() { this.hide() }
        });
    </script>
    <div class="texto_formulario">Hora:</div>
    <?php $Thora = date("H:i", time()); ?>
    <input name="Fhora" type="text" class="componente_miolo_medio" value="<?=$Thora?>" maxlength="5" />
    <br> <br>  
    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalvPag" id="btSalvPag" value="btSalvPag" />
</form>
<?php
}else{
	require_once("../scripts/php/funcoes.php");
	
	$TentidadeId = $_SESSION['SuserEnt'];
	$Tstatus 	 = $_POST['Fstatus'];
	$Ttitulo 	 = $_POST['Ftitulo'];
	$Ttexto 	 = $_POST['Ftexto'];
	$Ttags 		 = $_POST['Ftags'];
	$Tdata 		 = inverteDate($_POST['Fdata']);
	$Thora 		 = $_POST['Fhora'];
	
	$sqlPagina	= "INSERT INTO
						intranet_pagina(
							intranet_pagina_id,
							intranet_pagina_titulo,
							intranet_pagina_texto,
							intranet_pagina_palavra_chave,
							intranet_pagina_data,
							intranet_pagina_hora,
							intranet_pagina_status,
							intranet_pagina_entidade_id
					)VALUES(
						  default,
						 '$Ttitulo',
						 '$Ttexto',
						 '$Ttags',
						 '$Tdata',
						 '$Thora',
						 '$Tstatus',
						  $TentidadeId)";
						  
	$Treturn = $drive->pedido($sqlPagina);
	if ($Treturn == true){
		
		echo"<script>alert(\"Pagina incluida com Sucesso!\");</script>";
		$sql = "SELECT intranet_pagina_id FROM intranet_pagina ORDER BY intranet_pagina_id DESC LIMIT 1";
		
		$Treturn = $drive->pedido($sql);
		
		$TobjPag   = pg_fetch_object($Treturn);
		$TidPagina = $TobjPag->intranet_pagina_id;
		
		$drive->redirect("inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=$TidPagina");
		
	}else{		
		echo"<script>alert(\"Não foi possível incluir a Pagina.\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=paginclui&menu=".$_GET['menu']."\";</script>");
	}	
}
?>