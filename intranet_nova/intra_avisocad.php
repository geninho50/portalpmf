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
	<div id="caminho_migalhas">intranet &gt; notícias e avisos</div>
	<div id="titulo_pagina">editar avisos</div>
	<div>
		<div class="painel_abas">
			<div id="aba_dados" class="aba_sel"><span>avisos disponíveis</span></div>
		</div> 
		<div class="conteudo_abas">  
			<form method="post" action="inicio.php?pagina=avisocad&menu=3" onsubmit="return verificaForm()">
            <div id="conteudo_localizar" style="display:inline">
				Utilize as opções abaixo para acesar os arquivos do repositório. Faça a pesquisa por palavra-chave (tag), data de postagem do arquivo ou consulte a listagem completa de arquivos.<br><br>
                <div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="completa" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa </div>
				<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?> />Buscar por:</div> 
                <div class="container_6">
                	palavra-chave:<br />
                    <?php
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags 
					?>
					
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>              
                	Per&iacute;odo:<br>
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
                <input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />               
				</div>
            </div>
            </form>
		</div> 
		<?php 
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){
			require_once("../scripts/php/funcoes.php");
			require_once("../scripts/php/paginacao.php");
			$TidEntidade= $_SESSION['SuserEnt'];
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];	
			}	
			$inicio = ($pg * 10) - 10; 
		
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				$numSql   = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade";
				$entSql   = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade ORDER BY intranet_avisos_titulo ASC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=avisocad&menu=3&tp=cp";
			}
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
				if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("intranet_avisos_palavra_chave", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags";
					$entSql  	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags ORDER BY intranet_avisos_titulo ASC LIMIT 10 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=avisocad&menu=3&tp=ps&Gtags=".$Ttags."";
				}			
			}
			$TreturnSqlEnt = $drive->pedido($entSql);
			$TreturnSqlNum = $drive->pedido($numSql);
			?>
        	<div class="container_5">
				<div id="resultado" style="display:inline"><img src="../layout/imagens/serv_tit_resultado.png" alt="resultado"  />'
					<div class="container_2">
						<?php
						$i=0;
						while($linha=pg_fetch_object($TreturnSqlEnt)){
							echo '
								<div class="container_2">  
									<table width="620" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="500" class="container_item_result"><span class="titulo_linkserv">'.$linha->intranet_avisos_titulo.'</span><br>
											'.$linha->intranet_avisos_texto.'
											</td>
											<td width="120" class="container_item_result" valign="bottom">
											<a href="inicio.php?pagina=sistedit&menu=3&id='.$linha->intranet_avisos_id.'" class="toggleopacity">
											<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar"  border="0" align="absmiddle" /></a>
											<a href="" class="toggleopacity">
											<img src="../layout/imagens/atualiza_btn_excluir.png" alt="editar" border="0" align="absmiddle" /></a>
											</td>
										</tr>
									</table>
								</div>';
						$i++;
						}
						if($i=="0"){
							echo "<b>Nenhum arquivo encontrado.</br>";
						}
						?>
                        <br />
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
                        mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho);
                        echo "<p>";				
// ========================= fim imprime num de páginas  =========================
                    	}	
                    	?> 
                    </div>
				</div>
			</div>
		</div>
        <?php } ?>  
	</div>
</div>
