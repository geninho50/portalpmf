<?php
$submenu 		= (int)$_GET['idsubmenu'];
$sqlControl  	= "SELECT * FROM intranet_submenu WHERE intranet_submenu_id = $submenu"; 
$rsqlControl 	= $drive->pedido($sqlControl);
$oSqlControl 	= pg_fetch_object($rsqlControl);	
$txtTituloMenu  = $oSqlControl->intranet_submenu_titulo;
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">associar p&aacute;gina</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">        
			<h2>submenu: <?=$txtTituloMenu?></h2><br>
			<form method="post">
                <input type="hidden" id="txtmenupai" name="txtmenupai" value="<?=$menupai?>" />	
                <div class="texto_formulario">Nome da p&aacute;gina:</div>
                <input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="200" />
                <script type="text/javascript">
                    var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
                    txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <br><br>
                <b>Endereço:</b> (ex: controle/entidade/entidcad.php)<br>
                <input name="txtEndereco" id="txtEndereco" type="text" class="componente_miolo" maxlength="500" /><br><br />
                <script type="text/javascript">
                    var txtEndereco = new LiveValidation('txtEndereco'); 
                    txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
                </script> 
                <b>Atalho para abrir página:</b> (ex: entidedit)<br>
                <input name="txtAtalho" id="txtAtalho" type="text" class="componente_miolo" maxlength="20" /><br><br />
                <script type="text/javascript">
                var txtAtalho = new LiveValidation('txtAtalho'); 
                    txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
                </script> 
                <input type="hidden" name="Frelacao" value="<?=$oSqlControl->intranet_submenu_id;?>" />
                <br />
                <input type="image" id="btn_incluir_menu" name="btn_incluir_menu" value="btn_incluir_menu" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/> 
                <a href="?pagina=submenuedit&idsubmenu=<?=$_GET['idsubmenu']?>&menu=<?=$_GET['menu']?>&menuid=<?=$_GET['menupai']?>">
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a> 
			</form>
		</div>
	</div>
</div>  

<?php
if(isset($_POST['btn_incluir_menu_x'])){
	
	$TassocNome 	 = $_POST['txtNomeMenu'];
	$TassocAtalho 	 = $_POST['txtAtalho'];
	$TassocCaminho 	 = $_POST['txtEndereco'];
	$TassocSubmenuId = $_POST['Frelacao'];
	
	$sqlAssoc 		 = "INSERT INTO
							intranet_menu_relacionado(
								intranet_menu_rel_id,
								intranet_menu_rel_atalho,
								intranet_menu_rel_caminho_fisico,
								intranet_menu_rel_menu_id,
								intranet_menu_rel_nome
						)VALUES(
							default,
							'$TassocAtalho',
							'$TassocCaminho',
							$TassocSubmenuId,
							'$TassocNome')";
							
	$TreturnAssoc	 = $drive->pedido($sqlAssoc);

	if($TreturnAssoc == true){
			echo("<script>alert('Pagina associada com Sucesso')</script>");	
			echo("<script>window.location = \"inicio.php?pagina=submenurelpag&menupai=".$_GET['menupai']."&menu=".$_GET['menu']."\";</script>");
	}else{
			echo("<script>alert('Nao foi possivel Associar a Pagina')</script>");
			echo("<script>window.location = \"inicio.php?pagina=submenurelpag&menupai=".$_GET['menupai']."&menu=".$_GET['menu']."\";</script>");
	}
}
?>
