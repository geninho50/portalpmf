<?php 
//-------------------------------------------------------------------
// Verifica qual sistema está sendo visualizado Intranet ou Internet
//-------------------------------------------------------------------
require_once('includes/get_tipo_sistema.php'); 

if(!empty($_POST)){
	if(isset($_POST['btn_incluir_menu_x'])){
		require_once("includes/include_menu_post_events.php");
	}else{
		if(isset($_POST['btn_editar_menu_x']))		{
			require_once("includes/edit_post_events.php");
		}
	}	
}else{
	if( (isset($_GET['acao']) && !empty($_GET['acao'])) && (isset($_GET['menuid']) && !empty($_GET['menuid'])) ){
		$menuid 	   = (int)$_GET['menuid'];
		$QueryControl  = "SELECT intranet_menu_id, intranet_menu_posicao, intranet_menu_tipo FROM intranet_menu WHERE intranet_menu_id = $menuid";
		$rQueryControl = $drive->pedido($QueryControl);
		$oQueryControl = pg_fetch_object($rQueryControl);
		
		//----------------------------------------------------------------------
		// Se o id do menu pertencer ao sistema que está sendo listado entao...
		//----------------------------------------------------------------------		
		if($oQueryControl->intranet_menu_tipo == $get_sistema){
			switch($_GET['acao']){
				case "up"		: require_once("includes/change_menu_position_events.php"); break;
				case "down"		: require_once("includes/change_menu_position_events.php"); break;
				case "excluir"	: require_once("includes/delete_menu.php");					break;
			}
		}
	} 
}
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">fun&ccedil;&otilde;es do portal</div>
    <div id="margem_direita">
    	<br>
        <div class="conteudo_abas">        
      		<div id="conteudo_menu" style="display:inline">
				<form name="jumpMenu" id="jumpMenu">
					<span class="texto_formulario">Site:</span>
					<select name="menu" onchange="change('parent',this,0)" class="componente_miolo">
						<option value="?pagina=menucad&sistema=intranet&menu=<?=$_GET['menu']?>" <?=$select_intranet?>>INTRANET</option>
						<option value="?pagina=menucad&sistema=internet&menu=<?=$_GET['menu']?>" <?=$select_internet?>>ADMINISTRA&Ccedil;&Atilde;O DA INTERNET</option>
					</select>
				</form>
                <br />
                         
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                   
                    <?php
                    $qMenu = "SELECT * FROM intranet_menu WHERE intranet_menu_tipo = '$get_sistema' ORDER BY intranet_menu_posicao ASC";
                    $rMenu = $drive->pedido($qMenu);
                    if(pg_num_rows($rMenu) == 0){
                        echo("<tr><td width=\"100%\"><center><b>Nenhum Menu Registrado...</b></center></td></tr>");
                    }else{
                        while($oMenu = pg_fetch_object($rMenu)){
                    ?>                
                        <tr>
                            <td width="340" class="result_busca_admB"><strong><?=$oMenu->intranet_menu_titulo?></strong></td>
                            <td width="260" class="result_busca_admB">
                                <a href="?pagina=menucad&sistema=<?=$get_sistema?>&acao=up&menuid=<?=$oMenu->intranet_menu_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                                    <img src="../layout/imagens/atualiza_btn_up3.png" alt="editar" width="19" height="19" border="0" align="absmiddle" />
                                </a>
                                <a href="?pagina=menucad&sistema=<?=$get_sistema?>&acao=down&menuid=<?=$oMenu->intranet_menu_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                                    <img src="../layout/imagens/atualiza_btn_down3.png" alt="editar" width="19" height="19" border="0" align="absmiddle" />
                                </a>
                                <a href="?pagina=menuedit&menuid=<?=$oMenu->intranet_menu_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                                    <img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
                                </a>
                                <a href="javascript:exclui(<?=$oMenu->intranet_menu_id?>)" class="toggleopacity">
                                    <img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle" />
                                </a>                    
                                <?php
                                switch($oMenu->intranet_menu_tipo_pai){
                                    case 't' : echo "<a href=\"inicio.php?pagina=submenucad&menuid=".$oMenu->intranet_menu_id."&menu=".$_GET['menu']."\" class=\"toggleopacity\">
                                                        <img src=\"../layout/imagens/atualiza_btn_submenu.png\" alt=\"Submenu\" width=\"67\" height=\"19\" border=\"0\" align=\"absmiddle\" />
                                                     </a>";
                                    break;
                                }
                                ?>
                            </td>
                        </tr>
                        <?php	
                        } // end while
                    } // end if
                    ?>
                </table>
                <br />
                <a href="?pagina=menuinsert&sistema=<?=$get_sistema?>&menu=<?=$_GET['menu']?>">
                    <img src="../layout/imagens/intra_btn_menu.png" alt="incluir menu" border="0" />
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
function exclui(menuid){
	if(confirm("Excluir ?")){
		location.href = '?pagina=menucad&sistema=<?=$get_sistema?>&acao=excluir&menuid='+menuid+'&menu=<?=$_GET['menu']?>';
	}	
}
</script>