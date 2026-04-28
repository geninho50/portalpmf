<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Aviso?')){
		return true;
	}else{
		return false;
	}
}

function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar avisos</div>
	<div id="margem_direita"><br>
		
		<div id="coluna_intranet_unica">
       <div class="box_busca">
			<form method="post" action="inicio.php?pagina=avisocad&menu=<?=$_GET['menu']?>" onsubmit="return verificaForm()">
            <div id="conteudo_localizar" style="display:inline">
			
                <div class="texto_formulario">
                <input name="Ftipo_busca" type="radio" value="completa" checked="checked" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa </div>
				<div class="texto_formulario">
                <input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?>/>Buscar por:</div> 
                <div class="container_6">
                	
                    <?php
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags
					?>
					
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma.<br />          
                	<br /><b>Per&iacute;odo:</b><br>
                	<input name="Fdata1" id="Fdata1" type="text" class="componente_miolo_menor" disabled="disabled" />
                	<a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
				    
					<script>
                        Calendar.setup({					
                            inputField : "Fdata1",						 
                            trigger    : "calendar-trigger",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                	a 
                    <input name="Fdata2" id="Fdata2" type="text" class="componente_miolo_menor" disabled="disabled" />
                    <a id="calendar-trigger-2"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
                        
                    <script>
                        Calendar.setup({					
                            inputField : "Fdata2",						 
                            trigger    : "calendar-trigger-2",
                            onSelect   : function() { this.hide() }
                        });
                    </script>                              
				</div>
               <br />
                <input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />
            </div>
            </form>
		</div> 
		<?php
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){	
			require_once("../scripts/php/funcoes.php");
			require_once("../scripts/php/paginacao.php");			
			
			$TidEntidade = $_SESSION['SuserEnt'];
			$TuserId	 = $_SESSION['SuserId'];
		
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];	
			}	
			$inicio = ($pg * 10) - 10; 
			
			//----------------
			// Busca Completa
			//----------------
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				$numSql   = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND intranet_avisos_user_id = $TuserId";
				$entSql   = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND intranet_avisos_user_id = $TuserId ORDER BY intranet_avisos_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=avisocad&menu=".$_GET['menu']."&tp=cp";
			}
			
			//---------------------
			// Busca Personalizada
			//---------------------
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
				if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("intranet_avisos_palavra_chave", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags AND intranet_avisos_user_id = $TuserId";
					$entSql  	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags AND intranet_avisos_user_id = $TuserId ORDER BY intranet_avisos_data DESC LIMIT 10 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=avisocad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
				}			
			}
		
			$TreturnSqlEnt = $drive->pedido($entSql);
			$TreturnSqlNum = $drive->pedido($numSql);

		?>
        <div class="tag_result_busca">resultados da busca</div>	
				<?php 
					$i = 0;
					//---------------------
					// Listagem dos avisos
					//---------------------
					while($linha = pg_fetch_object($TreturnSqlEnt)){				
					echo "
						<form name=\"form\" method=\"post\">
						<input type=\"hidden\" name=\"Fid\" value=\"".$linha->intranet_avisos_id."\" /> 
							<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
									<td class=\"container_item_result\">".inverteDateBd($linha->intranet_avisos_data)." - <span class=\"titulo_linkserv\">".$linha->intranet_avisos_titulo."</span><br>
									".subString($linha->intranet_avisos_texto, 150)."
									<br><span><a href=\"inicio.php?pagina=avisoedit&menu=".$_GET['menu']."&id=".$linha->intranet_avisos_id."\" class=\"toggleopacity\">
									<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\"  border=\"0\" align=\"absmiddle\" /></a></span>
									<span><input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" value=\"btExcluir\" id=\"btExcluir\" align=\"absmiddle\" onclick=\"return verificaExclusao()\" /></span>
									
									</td>
									
								</tr>
							</table>
						</form>";
					 $i++;
					}
					if($i == 0){
						echo "<b>Nenhum Aviso Encontrado.</b>";	
					}   
                    ?> 
                   
                  	<div id="area_paginacao">
					<?php
                    if($i != 0){
					//------------------------------------
					// Imprime numumero de paginas rodapé 
					//------------------------------------
                        $numPagTotal = pg_fetch_object($TreturnSqlNum);
                        echo "<p align=\"center\">";
                        $TnumPag = $numPagTotal->count;
                        if($TnumPag < 10){
                            $TnumPag = 10;
                        }
                        mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
                        echo "<p>";				
                    }	
                    ?> 
                    </div>
	
        <?php } ?>  
	</div>
</div>
</div>
<?php
//-------------------------
// Faz a exclusão do aviso
//-------------------------
if(isset($_POST['btExcluir_x'])){

	$TaviId = $_POST['Fid'];	
	
	$sql = "DELETE FROM intranet_avisos WHERE intranet_avisos_id = $TaviId";
	
	$Tresult 	= $drive->pedido($sql);
	
	if($Tresult){
		echo("<script>alert('Aviso Excluido com Sucesso!')</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Excluir o Aviso!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
	}
}
?>