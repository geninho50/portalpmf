<?php

if(!isset($_POST['btn_editar_menu_x'])){
	
	$TassocId = $_GET['assid'];
	$sqlAss = "SELECT * FROM intranet_menu_relacionado WHERE intranet_menu_rel_id = $TassocId";
	$TreturnAss = $drive->pedido($sqlAss);
	$TassDados = pg_fetch_object($TreturnAss);
	
	//-------------------------------------------------------------------------
	// busca todas as tags de atalho pra não deixar cadastrar duas tags iguais
	//-------------------------------------------------------------------------
	$TvalidaAtalhho = "";
	for($i=0; $i < count($_SESSION['SmenuAtalho'])-1; $i++){
		if($TassDados->intranet_menu_rel_atalho != $_SESSION['SmenuAtalho'][$i]){
			$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i]."' , ";
		}
	}
	if($TassDados->intranet_menu_rel_atalho != $_SESSION['SmenuAtalho'][$i]){
		$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i++]."' ";
	}

?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">dados da associa&ccedil;&atilde;o</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">        
			<form method="post">
				<input type="hidden" id="txtassocid" name="txtassocid" value="<?=$TassDados->intranet_menu_rel_id?>" />	
				<div class="texto_formulario">Nome do Menu:</div>
				<input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="200" value="<?=$TassDados->intranet_menu_rel_nome?>" /><br><br>
				<script type="text/javascript">
					 var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
					 txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script> 
                <b>Endereço:</b> (ex: controle/entidade/entidcad.php)<br>
                <input name="txtEndereco" id="txtEndereco" type="text" class="componente_miolo" maxlength="500" value="<?=$TassDados->intranet_menu_rel_caminho_fisico?>"/><br><br />
                <script type="text/javascript">
					 var txtEndereco = new LiveValidation('txtEndereco'); 
					 txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script> 
                <b>Atalho para abrir página:</b> (ex: entidedit)<br>
                <input name="txtAtalho" id="txtAtalho" type="text" class="componente_miolo" maxlength="20" value="<?=$TassDados->intranet_menu_rel_atalho?>" /><br>
				<script type="text/javascript">
					var txtAtalho = new LiveValidation('txtAtalho'); 
					txtAtalho.add( Validate.Exclusion, { within: [ <?=$TvalidaAtalho?> ], failureMessage: "Já existe" } ); 
					txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
				</script> 
                <br /><br />
				<input type="image" id="btn_editar_menu" name="btn_editar_menu" value="editar" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/> 
				<a href="?pagina=submenucad&menuid=<?=$_GET['menuid']?>&menu=<?=$_GET['menu']?>"><img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" /></a> 
			</form>        
		</div>
	</div>
</div>
<?php
}else{

	$Tcaminho 	  = "inicio.php?pagina=submenucad&menuid=".$_GET['menuid']."&menu=".$_GET['menu']."";
	$TassId 	  = $_POST['txtassocid'];
	$TassNome 	  = $_POST['txtNomeMenu'];
	$TassCaminhho = $_POST['txtEndereco'];
	$TassAtalho   = $_POST['txtAtalho'];
	
	$sqlUpdate 	  = "UPDATE 
						intranet_menu_relacionado 
					SET
						intranet_menu_rel_nome = '$TassNome',
						intranet_menu_rel_caminho_fisico = '$TassCaminhho',
						intranet_menu_rel_atalho = '$TassAtalho'
					WHERE
						intranet_menu_rel_id = $TassId";
	$TreturnUp	  = $drive->pedido($sqlUpdate);

	if($TreturnUp){
		echo"<script>alert(\"Dados alterados com sucesso!!\");</script>";
		echo("<script>window.location = \"".$Tcaminho."\";</script>");
	}else{
		echo"<script>alert(\"Servidor ocupado, tente novamente dentro de alguns instantes.\");</script>";
		echo("<script>window.location = \"".$Tcaminho."\";</script>");
	}
}

?>
