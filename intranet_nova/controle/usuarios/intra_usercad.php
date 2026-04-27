<?php
//------------------------------------------
// Página implementada em : 30/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt; </div>
	<div id="titulo_pagina">permissões de usuário</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">  
			<div id="conteudo_localizar" style="display:inline">
				<form method="post">
                <div class="texto_formulario">Entre com o nome do usuário a ser habilitado:</div>
				<table border="0" cellpadding="0" cellspacing="0"><tr><td width="450">
                <input name="Fuser" type="text" class="componente_miolo" maxlength="100" value="<?=$_POST['Fuser']?>" />
                deixe o campo em branco para consultar todos.
				</td><td valign="top">
                <input type="image" src="../layout/imagens/intra_btn_localizar.png" name="btLoc" id="btLoc" value="btLoc" />
                </td></tr></table>
                </form>    
			</div>
		</div>
		<?php
        if(isset($_POST['btLoc_x'])){
		
		$TuserNome   = $_POST['Fuser'];
		$sqlUser	 = "SELECT USR.*, ENT.entidade_sigla 
		                  FROM uni_usuarios AS USR 
					INNER JOIN entidades AS ENT 
					        ON USR.user_entidade_id = ENT.entidade_id 
						 WHERE USR.user_nome ILIKE '%$TuserNome%' 
						  --AND USR.user_login <> ''
						  AND CHAR_LENGTH( USR.user_login )<30
						 ORDER BY Trim(USR.user_nome) ASC";
		
		$TreturnUser = $drive->pedido($sqlUser);
		
		?>
		
        <div class="tag_result_busca">resultados da busca</div> 
        <div class="container_6">
                         
            <div class="container_2">  
                <br />
                <?php
				while( $TuserDados  = pg_fetch_object($TreturnUser) ){
				?>             
                <table width="700" border="0" cellspacing="0" cellpadding="0">
               		<tr>
					   <td width="180"   class="container_item_result"><strong><?=trim( $TuserDados->user_login ) ?></strong></td>
                		<td width="375" class="container_item_result"><strong><?=Trim(utf8_encode($TuserDados->user_nome) )?></strong></td>
                        <td width="55"  class="container_item_result" style="background-color:#F4F2EC; padding-left:5px;"><?=$TuserDados->entidade_sigla?></td>
                		<td width="90"  class="container_item_result" style="text-align:right;">
                    		<a href="inicio.php?pagina=useredit&menu=<?=$_GET['menu']?>&us=<?=$TuserDados->user_id?>" class="toggleopacity">
                        		<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
                            </a>
                        </td>
                      	<td width="80" class="container_item_result" style="text-align:center;">
                            <a href="javascript:del(<?=$TuserDados->user_id?>);" class="toggleopacity"> 
	                            <img src="../layout/imagens/atualiza_btn_excluir.png" alt="Excluir" width="54" height="19" border="0" align="absmiddle" />                    		
    						</a>
                		</td>
                	</tr>
                </table>   
            	<?php } ?>
            </div>
		</div> 
		<?php } ?>
    </div>
</div>
<script language="javascript">
function del(valor){
	if(confirm("Tem certeza que deseja EXCLUIR o usuário?")){
		location.href = '?pagina=<?=$_GET['pagina']?>&ac=ex&exc='+valor+'&menu=<?=$_GET['menu']?>';
	}
}
</script>
<?php
if($_GET['ac'] == "ex"){

	$TuserId = $_GET['exc'];
	
	//---------------------
	// apaga as permissões
	//---------------------
	$sql = "DELETE FROM intranet_permissoes WHERE intranet_user_id = ".$TuserId;	
	$Tresult = $drive->pedido($sql);	
	if($Tresult){
		//-----------------
		// apaga o usuário
		//-----------------
		$sql2 = "DELETE FROM uni_usuarios WHERE user_id = ".$TuserId;	
		$Tresult2 = $drive->pedido($sql2);
		if($Tresult2){
			echo("<script>alert('Usuário Excluido com Sucesso!')</script>");
		}else{
			echo("<script>alert('Não Foi Possível Excluir o Usuário!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		}	
	}else{
		echo("<script>alert('Não Foi Possível Excluir o Usuário!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
	}
}
?>