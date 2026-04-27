<script language="javascript">
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir a Categoria?')){
		return true;
	}else{
		return false;
	}
}
</script>

<?php
//-------------------------------------
//busca todas as categorias principais
//-------------------------------------
$sqlBuscaCat = "SELECT * FROM mailing_categoria WHERE mailing_categoria_hierarquia = 0 ORDER BY mailing_categoria_nome ASC";
$TresultCat	 = $drive->pedido($sqlBuscaCat);
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<div id="margem_direita">
    	<br />
		<div class="conteudo_abas">        
			<div id="conteudo_menu" style="display:inline">
				<table width="600" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="360" class="result_busca_adm">
							<h2><img src="../layout/imagens/intra_icon_categorias.png" alt="editar" border="0" align="absmiddle" /> <span>categorias principais</span></h2><br>
                        </td>
						<td width="240" class="result_busca_adm"><h2>&nbsp;</h2></td>
					</tr>
					<?php
					while($Tcategoria = pg_fetch_object($TresultCat)){
						
						//---------------------------------------
						//Verifica se a categoria é final ou não
						//---------------------------------------
						if($Tcategoria->mailing_categoria_tipo == 1){
							$Tbotao = 	"<a href=\"inicio.php?pagina=mailsubcategcad&menu=".$_GET['menu']."&catId=".$Tcategoria->mailing_categoria_id."&rz=0\" class=\"toggleopacity\">
										<img src=\"../layout/imagens/intra_btn_categlista.png\" alt=\"editar\" border=\"0\" align=\"absmiddle\" />
										</a>";
						}else{
							$Tbotao = 	"<a href=\"inicio.php?pagina=mailcontatocad&menu=".$_GET['menu']."&catId=".$Tcategoria->mailing_categoria_id."\" class=\"toggleopacity\">
										<img src=\"../layout/imagens/intra_btn_contatolista.png\" alt=\"editar\" border=\"0\" align=\"absmiddle\" />
										</a>";
						}
						
						//----------------------
						//imprime as categorias
						//----------------------
						echo"
						<form method=\"post\">
						<input type=\"hidden\" name=\"FcatId\" value=\"".$Tcategoria->mailing_categoria_id."\" />
						<tr>
							<td class=\"result_busca_admB\">
								<img src=\"../layout/imagens/intra_icon_categorias2.png\" alt=\"editar\" border=\"0\" align=\"absmiddle\" /> <strong>".$Tcategoria->mailing_categoria_nome."</strong>
							</td>
							<td class=\"result_busca_admB\">
								<a href=\"inicio.php?pagina=mailcategedit&menu=".$_GET['menu']."&catId=".$Tcategoria->mailing_categoria_id."\" class=\"toggleopacity\">
									<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" />
								</a>
								<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExclui\" id=\"btExclui\" value=\"btExclui\" align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
								".$Tbotao."
							</td>
						</tr>
						</form>
						";	
					}                    
					?>
				</table>
				<br />
				<a href="inicio.php?pagina=mailcateginclui&menu=<?=$_GET['menu']?>">
                	<img src="../layout/imagens/intra_btn_categprin.png" alt="incluir categoria principal" border="0" />
                </a>
           	</div>
		</div>
	</div>
</div> 
<?php
if(isset($_POST['btExclui_x'])){
	//----------------------------------------------------------------------------------
	//verifica se existe alguma sub-categoria relacionada com a categora a ser excluída
	//----------------------------------------------------------------------------------
	$TcatId		 = $_POST['FcatId'];
	$sqlVerCad = "SELECT COUNT(*) FROM mailing_categoria WHERE mailing_categoria_hierarquia = $TcatId";
	$sqlVerCnt = "SELECT COUNT(*) FROM mailing_contato WHERE mailing_contato_categoria = $TcatId AND mailing_contato_excluido = 'f'";
	$TresultCad	 = $drive->pedido($sqlVerCad);
	$TresultCnt	 = $drive->pedido($sqlVerCnt);
	$TverCad	 = pg_fetch_object($TresultCad);
	$TverCnt	 = pg_fetch_object($TresultCnt);
	if(($TverCad->count > 0)or($TverCnt->count > 0)){
		echo("<script>alert('Nao foi possivel excluir a Categoria\\n\\nExistem Sub-Categorias e/ou Contatos associados a esta Categoria')</script>");	
	}else{
		//--------------------------------------------------------------------
		//se não existit sub-categorias e ou contatos associados entao exclui
		//--------------------------------------------------------------------
		$sqlDelete	= "DELETE FROM mailing_categoria WHERE mailing_categoria_id = $TcatId";
		$TresultDel = $drive->pedido($sqlDelete);
		if($TresultDel){
			echo("<script>alert('Categoria Excluida com Sucesso')</script>");	
			echo("<script>window.location = \"inicio.php?pagina=mailcategcad&menu=".$_GET['menu']."\";</script>");
		}else{
			echo("<script>alert('Nao foi possivel Excluir a Categoria')</script>");
			echo("<script>window.location = \"inicio.php?pagina=mailcategcad&menu=".$_GET['menu']."\";</script>");
		}
	}
}
?>