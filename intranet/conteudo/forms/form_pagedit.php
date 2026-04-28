<?php 
if(!isset($_POST['btSalvPag_x'])){
include("../scripts/php/funcoes.php");
$TidPag = $_GET['idPag'];	

$sqlPag 	= "SELECT * FROM intranet_pagina WHERE intranet_pagina_id = $TidPag";
$Treturn 	= $drive->pedido($sqlPag);
$Tpag 		= pg_fetch_object($Treturn);	
	
?>
<script>
function verificaForm(){
	document.getElementById('Fdata').disabled=false;
}

</script>


<form method="post" onsubmit="return verificaForm()">
	<div class="texto_formulario">Entidade:</div> 
	<?php	
	/*print "<pre>";
	print_r( $_SESSION );
	print "</pre>";
	*/
	if( $_SESSION['SuserId'] == '3224' ){
		include("../scripts/php/funcoes.php");					
		combo_entidades($drive, "Fentidade",$_SESSION['SuserEnt'],"Fentidade");
	}else{
		print '<input type="hidden" name="Fentidade" id="Fentidade" value="">';
	}
	?>
	<input type="hidden" name="FpagId" value="<?=$Tpag->intranet_pagina_id?>" />
    <div class="texto_formulario">Título:</div>
    <input name="Ftitulo" type="text" class="componente_miolo" maxlength="100" value="<?=$Tpag->intranet_pagina_titulo?>" /><br>
    <div class="texto_formulario">Texto:</div>
    <label>
    <textarea name="Ftexto" class="componente_miolo_grande" cols="45" rows="25"><?=$Tpag->intranet_pagina_texto?></textarea>
    </label>
    <br> 
    <div class="texto_formulario">Tags de Busca:</div>
	<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Tpag->intranet_pagina_palavra_chave?>"/>Dica: cadastre tamb&eacute;m o t&iacute;tulo da p&aacute;gina como TAG de busca. 
    <div class="texto_formulario">Data:</div>
    <?php 
		$Tdata = explode("-",$Tpag->intranet_pagina_data);
		$Tdata = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
		?>
    <input name="Fdata" id="Fdata" type="text" class="componente_miolo_medio" value="<?=$Tdata?>" disabled="disabled" />
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
    <input name="Fhora" type="text" class="componente_miolo_medio" value="<?=$Tpag->intranet_pagina_hora?>" maxlength="5" />
    <br> <br>  
    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalvPag" id="btSalvPag" value="btSalvPag" />
</form>
<?php
}else{
	
	require_once("../scripts/php/funcoes.php");
	
	$TpaginaId 	 = $_POST['FpagId'];
	$Ttitulo 	 = $_POST['Ftitulo'];
	$Ttexto 	 = $_POST['Ftexto'];
	$Ttags 		 = $_POST['Ftags'];
	$Tdata 		 = inverteDate($_POST['Fdata']);
	$Thora 		 = $_POST['Fhora'];
	
	$sqlPagina	= "UPDATE
						intranet_pagina
				   SET
						intranet_pagina_titulo = '$Ttitulo',
						intranet_pagina_texto = '$Ttexto',
						intranet_pagina_palavra_chave = '$Ttags',
						intranet_pagina_data = '$Tdata',
						intranet_pagina_hora = '$Thora'
					WHERE
						intranet_pagina_id = $TpaginaId";
						  
	$Treturn = $drive->pedido($sqlPagina);
		
	if ($Treturn == true){
		echo"<script>alert(\"Pagina alterada com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$TpaginaId."\";</script>");
	}else{		
		echo"<script>alert(\"Não foi possível alterar a Pagina.\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$TpaginaId."\";</script>");
	}	
}
?>