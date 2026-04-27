<?php	
if(isset($_GET['idsubmenu']) && !empty($_GET['idsubmenu'])){
	$idsubmenu 	   = (int)$_GET['idsubmenu'];		
	$queryControl  = "SELECT * FROM intranet_submenu WHERE intranet_submenu_id = $idsubmenu";
	$rqueryControl = $drive->pedido($queryControl);
	if(pg_num_rows($rqueryControl) > 0){
		$oquery 	 = pg_fetch_object($rqueryControl);
		$txtTitulo 	 = $oquery->intranet_submenu_titulo;
		$txtEndereco = $oquery->intranet_submenu_endereco_fisico;
		$txtAtalho   = $oquery->intranet_submenu_atalho;
		$menuPai	 = $oquery->intranet_submenu_pai_id;			
	}
}else{
	$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");	
}

if(isset($_GET['acao'])){
	include("includes/delete_submenurel.php");
	exit();	 
}	

//-------------------------------------------------------------------------
// busca todas as tags de atalho pra não deixar cadastrar duas tags iguais
//-------------------------------------------------------------------------
$TvalidaAtalhho = "";
for($i=0; $i < count($_SESSION['SmenuAtalho'])-1; $i++){
	if($txtAtalho != $_SESSION['SmenuAtalho'][$i]){
		$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i]."' , ";
	}
}
if($txtAtalho != $_SESSION['SmenuAtalho'][$i]){
	$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i++]."' ";
}
		
//-------------------------------------------
// busca por páginas associadas as este menu
//-------------------------------------------

$TmenuId   = $_GET['idsubmenu'];
$sqlAssoc  = "SELECT * FROM intranet_menu_relacionado WHERE intranet_menu_rel_menu_id = $TmenuId";
$TretAssoc = $drive->pedido($sqlAssoc);  
?>  
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
   	<div id="titulo_pagina">dados do submenu</div>
    <div id="margem_direita"><br>
    	<div class="conteudo_abas">         
 			<h2>submenu: <?=$txtTitulo?></h2><br>
            <form action="?pagina=submenucad&menu=<?=$_GET['menu']?>" method="post" >
                <input type="hidden" id="txtsubmenuid" name="txtsubmenuid" value="<?=$idsubmenu?>" />	
                <input type="hidden" id="txtmenuid"	name="txtmenuid"	value="<?=$menuPai?>" />               
                <div class="texto_formulario">Nome do Menu:</div>
                <input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="200" value="<?=$txtTitulo?>" />
                <script type="text/javascript">
                    var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
                    txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <br><br>        	 
                <b>Endereço:</b> (ex: controle/entidade/entidcad.php)<br>
                <input name="txtEndereco" id="txtEndereco" type="text" class="componente_miolo" maxlength="500" value="<?=$txtEndereco?>"/><br><br />
                <script type="text/javascript">
                    var txtEndereco = new LiveValidation('txtEndereco'); 
                    txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <b>Atalho para abrir página:</b> (ex: entidedit)<br>
                <input name="txtAtalho" id="txtAtalho" type="text" class="componente_miolo" maxlength="20" value="<?=$txtAtalho?>" /><br>
                <script type="text/javascript">
                    var txtAtalho = new LiveValidation('txtAtalho'); 
                    txtAtalho.add( Validate.Exclusion, { within: [ <?=$TvalidaAtalho?> ], failureMessage: "Já existe" } ); 
                    txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
                </script>             
                <br />
                <br />            
                <input type="image" id="btn_editar_menu" name="btn_editar_menu" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/>         
                <a href="?pagina=submenucad&menuid=<?=$_GET['menuid']?>&menu=<?=$_GET['menu']?>">
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a> 
                            
        	</form>
			<br /><br />    
	  		<table width="600" border="0" cellspacing="0" cellpadding="0">       
       	 		<tr>
         			<td class="result_busca_adm" colspan="2"><h3>SubTelas associadas a este submenu:</h3></td>         
       			</tr>
				<?php
          		while($TmenuAssoc = pg_fetch_object($TretAssoc)){?>
        		<tr>  
         			<td class="result_busca_admB" width="480"><strong><?=$TmenuAssoc->intranet_menu_rel_nome?></strong></td>
         			<td class="result_busca_admB" width="120">
            			<a href="?pagina=submenureledit&menu=<?=$_GET['menu']?>&assid=<?=$TmenuAssoc->intranet_menu_rel_id?>&menuid=<?=$_GET['menuid']?>" class="toggleopacity">
                			<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
            			</a>
           				<a href="javascript:excluiassoc(<?=$TmenuAssoc->intranet_menu_rel_id?>,<?=$idsubmenu?>)" class="toggleopacity">
               				<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle" />
            			</a>
         			</td>
      			</tr>
      			<?php 
				} 
				?>
      		</table><br>
            <a href="inicio.php?pagina=submenurelpag&menupai=<?=$_GET['menuid']?>&menu=<?=$_GET['menu']?>&idsubmenu=<?=$oquery->intranet_submenu_id?>" class="toggleopacity">
                    <img src="../layout/imagens/intra_btn_subtela2.png" alt="relacionar menu" border="0" align="absmiddle" />
                </a>       
      	</div>
  	</div>
</div>  
<script language="JavaScript" type="text/JavaScript">
function excluiassoc(associd,idsubmenu){
	if(confirm('Tem certeza que deseja Excluir?')){		
		location.href = '?pagina=submenuedit&acao=excluir&idsubmenu='+idsubmenu+'&assid='+associd+'&menu=<?=$_GET['menu']?>';
	}
}
</script>