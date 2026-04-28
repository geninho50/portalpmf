<?php
if(isset($_POST['btn_salvar_x'])){
	require_once("includes/include_post_events.php");
}else if(isset($_POST['btn_editar_x'])){
	require_once("includes/edit_post_events.php");
}else{
	if((isset($_GET['acao']) && !empty($_GET['acao'])) && (isset($_GET['perfilid']) && !empty($_GET['perfilid']))){
		$acao 		= $_GET['acao'];
		$perfilid	= (int)$_GET['perfilid'];
		switch($acao){
			case 'excluir' : require_once("includes/delete_perfil.php");  break;
			default		   : $drive->redirect("?pagina=perfilcad&menu=1");break;
		}
	}
}

$query  = "SELECT * FROM intranet_perfil ORDER BY intranet_perfil_nome ASC";	
$rquery = $drive->pedido($query); 
?>

<div class="centro">
    <div id="caminho_migalhas">intranet &gt;</div>
    <div id="titulo_pagina">perfis de acesso</div>
    <div id="margem_direita"><br>
		<div class="conteudo_abas">
        	<div id="conteudo_listagem" style="display:inline">
        		<table cellpadding="0" cellspacing="0" border="0">
                <?php
		  		while($oquery = pg_fetch_object($rquery)){
		  		?>
          			<tr>
              			<td width="500" class="container_item_result"><span class="titulo_linkserv"><?=$oquery->intranet_perfil_nome?></span></td>
              			<td width="120" class="container_item_result">
              				<a href="inicio.php?pagina=perfiledit&perfilid=<?=$oquery->intranet_perfil_id?>&menu=<?=$_GET['menu']?>" class="toggleopacity">
                            	<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
                            </a> 
              				<?php 
							if(($oquery->intranet_perfil_id != 1)and($oquery->intranet_perfil_id != 2)){ 
							?>
              					<a href="javascript:del(<?=$oquery->intranet_perfil_id?>);" class="toggleopacity"> 
                                	<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle" />
                                </a>
              				<?php 
							}
							?>
              			</td>
          			</tr>
          			<tr>
		  		<?php		
				}
		  		?>
          		</table>
          		<br>
          		<a href="inicio.php?pagina=perfilinclui&menu=<?=$_GET['menu']?>">
          			<img src="../layout/imagens/intra_btn_incluir.png" alt="incluir" border="0" />  
          		</a> 
         	</div>
     	</div>
  	</div>
</div> 

<script language="javascript">
function del(valor){
	if(confirm("Excluir ?")){
		location.href = '?pagina=perfilcad&acao=excluir&perfilid='+valor+'&menu=<?=$_GET['menu']?>';
	}
}
</script>