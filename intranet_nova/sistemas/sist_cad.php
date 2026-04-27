<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Sistema?')){
		return true;
	}else{
		return false;
	}
}
</script>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar sistemas</div>
    <div id="margem_direita"><br>
		        
		<div class="conteudo_abas">  
        <form method="post" action="inicio.php?pagina=sistcad&menu=<?=$_GET['menu']?>" onsubmit="return verificaForm()">
            <div id="conteudo_localizar" style="display:inline">
				<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="completa" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa </div>
               	
                <div class="container_tags">
				<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?> />Buscar por Palavra Chave</div> 
                <div class="container_6">
                    <?php
					
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags 	
							
					?>
					
                    
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma.            
                	 </div>             
                	<br /><br />
                </div><br />
           	 	&nbsp;<input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />               
				</div>
            </form>
		</div> 
		<?php 
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){	
			require_once("../scripts/php/funcoes.php");
			require_once("../scripts/php/paginacao.php");			
			
			$TidEntidade = $_SESSION['SuserEnt'];
		
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];	
			}	
			$inicio = ($pg * 10) - 10; 
			//###################### BUSCA COMPLETA #############################
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				$numSql   = "SELECT COUNT(*) FROM intranet_sistemas WHERE intranet_sistemas_entidade_id = $TidEntidade";
				$entSql   = "SELECT * FROM intranet_sistemas WHERE intranet_sistemas_entidade_id = $TidEntidade ORDER BY intranet_sistemas_nome ASC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=sistcad&menu=".$_GET['menu']."&tp=cp";
			}
			//###################### BUSCA PERSONALIZADA ########################
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
				if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("intranet_sistemas_tags", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM intranet_sistemas WHERE intranet_sistemas_entidade_id = $TidEntidade AND $TarrayTags";
					$entSql  	 = "SELECT * FROM intranet_sistemas WHERE intranet_sistemas_entidade_id = $TidEntidade AND $TarrayTags ORDER BY intranet_sistemas_nome ASC LIMIT 10 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=sistcad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
				}			
			}
		//#################### retorno ###################
		$TreturnSqlEnt = $drive->pedido($entSql);
		$TreturnSqlNum = $drive->pedido($numSql);

		?>
        <div class="tag_result_busca">resultados da busca</div>
					<?php 
					$i = 0;
					//#################### imprime os sistemas disponiveis #####################
					while($linha = pg_fetch_object($TreturnSqlEnt)){				
					echo "
						<form name=\"form\" method=\"post\">
						<input type=\"hidden\" name=\"Fid\" value=\"".$linha->intranet_sistemas_id."\" />
						<div class=\"container_2\">  
							<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
									<td width=\"500\" class=\"container_item_result\"><span class=\"titulo_linkserv\">".$linha->intranet_sistemas_nome."</span><br>
									".subString($linha->intranet_sistemas_descricao, 200)."";
									
									echo "
									</td>
									<td width=\"120\" class=\"container_item_result\" valign=\"top\">";
									if($linha->intranet_sistemas_exibirweb == 't'){																
										echo "<a href=\"inicio.php?pagina=sistedit&menu=".$_GET['menu']."&id=".$linha->intranet_sistemas_id."\" class=\"toggleopacity\">
											<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\"  border=\"0\" align=\"top\" /></a>";
									}
									echo "<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"top\" onclick=\"return verificaExclusao()\" />
									</td>
								</tr>
							</table>
						</div>
						</form>";
					 $i++;
					}
					if($i == 0){
						echo "<br /><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nenhum Sistema Encontrado.</b>";	
					}   
                    ?> 
                    <div class="container_2">
                  	<div id="area_paginacao">
					<?php
                    if($i != 0){
// ========================= imprime numumero de paginas rodapé  ========================
                        $numPagTotal = pg_fetch_object($TreturnSqlNum);
                        echo "<p align=\"center\">";
                        $TnumPag = $numPagTotal->count;
                        if($TnumPag < 10){
                            $TnumPag = 10;
                        }
                        mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
                        echo "<p>";				
// ========================= fim imprime num de páginas  =========================
                    }	
                    ?> 
                    
			</div>
		</div>
        <?php } ?>  
	</div>
</div>
<?php
if(isset($_POST['btExcluir_x'])){

	$TsisId = $_POST['Fid'];	
	
	$sql = "DELETE FROM intranet_sistemas WHERE intranet_sistemas_id = $TsisId";
	$sqlb = "DELETE FROM intranet_favoritos WHERE intranet_favoritos_sistema_id = $TsisId";
	
	$Tresult = $drive->pedido($sql);
	$Tresultb = $drive->pedido($sqlb);
	
	if($Tresult AND $Tresultb){
		echo("<script>alert('Sistema Excluido com Sucesso!')</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Excluir o Sistema!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
	}

}
?>