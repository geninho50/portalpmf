<?php
if(!empty($_POST)){	
	if(isset($_POST['btn_incluir_menu_x'])){	
		require_once("includes/include_submenu_post_events.php");
	}else if(isset($_POST['btn_editar_menu_x'])){
		require_once("includes/edit_submenu_post_events.php");
	}
}else{
	if(isset($_GET['menuid']) && !empty($_GET['menuid'])){
		$menuid = (int)$_GET['menuid'];	
		if( 	(isset($_GET['acao']) 		&& !empty($_GET['acao'])) 
			&&  (isset($_GET['submenuid'])  && !empty($_GET['submenuid'])) 
		  ){			
			$submenuid 	   = (int)$_GET['submenuid'];
			$QueryControl  = "SELECT intranet_submenu_id, intranet_submenu_posicao, intranet_submenu_pai_id FROM intranet_submenu WHERE intranet_submenu_id = $submenuid";
			$rQueryControl = $drive->pedido($QueryControl);
			$oQueryControl = pg_fetch_object($rQueryControl);
			
			if($oQueryControl->intranet_submenu_pai_id == $menuid){
				switch($_GET['acao']){
					case "up"		: require_once("includes/change_submenu_position_events.php");	break;
					case "down"		: require_once("includes/change_submenu_position_events.php");	break;
					case "excluir"	: require_once("includes/delete_submenu.php");					break;
				}
			}			
		}	
	}
}

$queryPai  = "SELECT intranet_menu_id, intranet_menu_tipo_pai, intranet_menu_titulo, intranet_menu_tipo FROM intranet_menu WHERE intranet_menu_id = $menuid";
$rQueryPai = $drive->pedido($queryPai);
if(pg_num_rows($rQueryPai) > 0){
	$oQueryPai = pg_fetch_object($rQueryPai);
	if($oQueryPai->intranet_menu_tipo_pai == 't'){
		$querySb 	= "SELECT * FROM intranet_submenu WHERE intranet_submenu_pai_id = $menuid ORDER BY intranet_submenu_posicao";
		$rquerySb	= $drive->pedido($querySb); 
	}else{
		$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");	
	}
}else{
	$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");
}
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
   	<div id="titulo_pagina">submenu</div>
   	<div id="margem_direita"><br>
	    <div class="conteudo_abas">          
    		<div id="conteudo_menu" style="display:inline">
     			<table width="600" border="0" cellspacing="0" cellpadding="0">
       				<tr>
         				<td class="result_busca_adm" colspan="2"><h3>Menu Pai: <?=$oQueryPai->intranet_menu_titulo?></h3></td>
       				</tr>
			       	<?php
	   				if(pg_num_rows($rquerySb) == 0){
						echo("<tr><td width=\"100%\"><center><b>Nenhum Sub-Menu Registrado...</b></center></td></tr>");
					}else{
						while($oquerySb = pg_fetch_object($rquerySb)){
						?>
      					<tr>
        		 			<td width="420" class="result_busca_admB"><strong><?=$oquerySb->intranet_submenu_titulo?></strong></td>
         		 			<td width="180" class="result_busca_admB">
         	                	<a href="?pagina=submenucad&acao=up&menuid=<?=$menuid?>&submenuid=<?=$oquerySb->intranet_submenu_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                     				<img src="../layout/imagens/atualiza_btn_up3.png" alt="subir" width="19" height="19" border="0" align="absmiddle" />
                     			</a>                             
                     			<a href="?pagina=submenucad&acao=down&menuid=<?=$menuid?>&submenuid=<?=$oquerySb->intranet_submenu_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                        			<img src="../layout/imagens/atualiza_btn_down3.png" alt="descer" width="19" height="19" border="0" align="absmiddle" />
                     			</a>
                                <a href="?pagina=submenuedit&idsubmenu=<?=$oquerySb->intranet_submenu_id?>&menu=<?=$_GET['menu']?>&menuid=<?=$_GET['menuid']?>" class="toggleopacity">
                        			<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
                     			</a>                            
                     			<a href="javascript:exclui(<?=$menuid?>,<?=$oquerySb->intranet_submenu_id?>)" class="toggleopacity">
                        			<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle" />
                     			</a>
		         			</td>
      					</tr>      
						<?php
						}//while
					}//else
					?>      
      			</table>
       			<br />       
       			<a href="inicio.php?pagina=submenuins&menupai=<?=$menuid?>&menu=<?=$_GET['menu']?>">
       				<img src="../layout/imagens/intra_btn_submenu.png" alt="incluir menu" align="absmiddle"  border="0"/>
       			</a>
                <a href="inicio.php?pagina=menucad&sistema=<?=$oQueryPai->intranet_menu_tipo?>&menu=<?=$_GET['menu']?>">
       				<img src="../layout/imagens/intra_btn_voltar.png"  border="0" align="absmiddle" />
       			</a>
       		</div>
      	</div>
	</div>
</div>

<script language="JavaScript" type="text/JavaScript">
function change(targ,selObj,restore){ 
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function exclui(menuid,submenuid){
	if(confirm("Excluir ?")){		
		location.href = '?pagina=submenucad&acao=excluir&acao=excluir&menuid='+menuid+'&submenuid='+submenuid+'&menu=<?=$_GET['menu']?>';
	}
}
</script>