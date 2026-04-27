<?php
if(isset($_GET['perfilid']) && !empty($_GET['perfilid'])){
	$perfilid 		= (int)$_GET['perfilid'];
	$queryperfil    = "SELECT * FROM intranet_perfil WHERE intranet_perfil_id = $perfilid";
	$resultperfil   = $drive->pedido($queryperfil);
	if(pg_num_rows($resultperfil) <= 0){
		$drive->redirect("?pagina=perfilcad&menu=".$_GET['menu']."");				
	}else{
		$operfil = pg_fetch_object($resultperfil);	
	}
}else{
	$drive->redirect("?pagina=perfilcad&menu=".$_GET['menu']."");	
}

$queryintranet  = "SELECT  * FROM intranet_menu WHERE intranet_menu_tipo = 'intranet' ORDER BY intranet_menu_posicao ASC";
$queryinternet  = "SELECT  * FROM intranet_menu WHERE intranet_menu_tipo = 'internet' ORDER BY intranet_menu_posicao ASC";
$rqueryintranet = $drive->pedido($queryintranet);
$rqueryinternet = $drive->pedido($queryinternet);
?>
<div class="centro">
    <div id="caminho_migalhas">intranet &gt;</div>
    <div id="titulo_pagina">editar perfil de acesso</div>
    <div id="margem_direita"><br>
    	<div class="conteudo_abas">
       		<div id="conteudo_dados" style="display:inline">              
        		<form action="?pagina=perfilcad&menu=<?=$_GET['menu']?>" method="post">
                	<div class="texto_formulario">Nome do Perfil: </div>
            		<input type="hidden" name="idperfil" value="<?=$operfil->intranet_perfil_id?>" />
            		<input name="txtPerfil" type="text" class="componente_miolo" maxlength="100" value="<?=$operfil->intranet_perfil_nome?>" />
            		<script type="text/javascript">
						var txtPerfil= new LiveValidation('txtPerfil');
						txtPerfil.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
            		<br />
            		<br />	        
            		<table width="600" border="0" cellspacing="0" cellpadding="0">
               			<tr>
                 			<td width="20" class="container_item_result"><h2>&nbsp;</h2></td>
                 			<td width="580" class="container_item_result"><h3>portal da intranet</h3></td>
               			</tr>
            			<?php
						while($ointranet = pg_fetch_object($rqueryintranet)){
		         			switch($ointranet->intranet_menu_tipo_pai){
						 		case "f" : include("includes/print_intranet_menu_edit.php"); break;
						 		case "t" :
									$menuid		  = (int)$ointranet->intranet_menu_id;
									$querysubmenu = "SELECT * FROM intranet_submenu WHERE intranet_submenu_pai_id = $menuid 
													 ORDER BY intranet_submenu_posicao ASC";
									$rquerysubmenu = $drive->pedido($querysubmenu);
									while($oquerysubmenu = pg_fetch_object($rquerysubmenu)){
										include("includes/print_intranet_submenu_edit.php");
									}
								 break;
							 }
            			}
						?>
            		</table>      
          			<br />
                    <table width="610" border="0" cellspacing="0" cellpadding="0">
               			<tr>
                 			<td width="20" class="container_item_result"><h2>&nbsp;</h2></td>
                 			<td width="590" class="container_item_result"><h3>portal da internet</h3></td>
               			</tr>
            			<?php
						while($ointernet = pg_fetch_object($rqueryinternet)){		 
					 		switch($ointernet->intranet_menu_tipo_pai){
						 		case "f" : include("includes/print_internet_menu_edit.php"); break;
						 		case "t" :
						 			$menuid		  = (int)$ointernet->intranet_menu_id;
									$querysubmenu = "SELECT * FROM intranet_submenu WHERE intranet_submenu_pai_id = $menuid 
					 								 ORDER BY intranet_submenu_posicao ASC";
									$rquerysubmenu = $drive->pedido($querysubmenu);
									while($oquerysubmenu = pg_fetch_object($rquerysubmenu)){
										include("includes/print_internet_submenu_edit.php");
									}
						 		break;
					 		}
            			}
						?>
           			</table>
            		<br /><br />
            		<input type="image" name="btn_editar" id="btn_editar" src="../layout/imagens/intra_btn_salvar.png" width="72" height="26" border="0" align="absmiddle" />
            		<a href="?pagina=perfilcad&menu=<?=$_GET['menu']?>">
            			<img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
            		</a> 
        		</form>  
                <br />           
            </div>
        </div>        
	</div>
</div> 