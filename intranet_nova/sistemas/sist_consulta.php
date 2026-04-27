
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">localizar sistema</div>
	<div>
	
    
       <div id="coluna_intranet_unica">
       <div class="box_busca">
    
    
        <form name="form" method="post">
        <div><br>
		<?php 
		require_once("../scripts/php/funcoes.php");
		combo_entidades($drive, "entidade", $_POST['entidade']);
		?>
        </div> <br><br>
		<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="completa" checked="checked" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")){echo('checked="checked"');  $_POST['Ftags'] = ""; }?>/>Listagem completa </div>
     	<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?> />Buscar por palavra chave
     	</div>     
		<div class="container_6">
			<?php
					
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags 	
		
					?>
					
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espaço após cada palavra, mesmo que seja apenas uma. <br />
                    <br />
      		<input type="image" name="btLoc" id="btLoc" value="btLoc" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle"/>
		</div>
        </form>
        
     </div><!-- fim box_busca -->
     
		<?php 
			if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){	
				require_once("../scripts/php/funcoes.php");
				require_once("../scripts/php/paginacao.php");
				$Tuser_id = $_SESSION['SuserId'];
							
				if(!isset($_GET['pg'])){
					$pg = 1;
				}else{
					$pg = $_GET['pg'];	
				}	
				$inicio = ($pg * 10) - 10; 				
				
				//############################# BUSCA COMPLETA ###########################
				if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				
					if($_POST['entidade'] != ""){
						$entidade = $_POST['entidade'];
						$complementaPesquisa = " WHERE SIST.intranet_sistemas_entidade_id = $entidade";	
					}else{
						$complementaPesquisa = "";	
					}
					
					$numSql   	= "SELECT COUNT(*) FROM intranet_sistemas $complementaPesquisa";//usada somente para paginacao				
					$entSql 	= "	SELECT SIST.*, ENT.entidade_nome FROM intranet_sistemas AS SIST INNER JOIN entidades AS ENT ON ENT.entidade_id = SIST.intranet_sistemas_entidade_id $complementaPesquisa ORDER BY SIST.intranet_sistemas_nome ASC LIMIT 10 OFFSET $inicio";//lista os sistemas que NAO sao favoritos				
					$Tcaminho 	= "?pagina=sistconsulta&menu=".$_GET['menu']."&tp=cp";
				}
				//############################# BUSCA PERSONALIZADA #######################
				if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
					if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
						if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}					
							if($_POST['entidade'] != ""){
								$entidade = $_POST['entidade'];
								$complementaPesquisa = " AND intranet_sistemas_entidade_id = $entidade";	
							}else{
								$complementaPesquisa = "";	
							}							
						$TarrayTags  = $drive->arrayTags("intranet_sistemas_tags", $Ttags); //funcao de tags
						$numSql   	 = "SELECT COUNT(*) FROM intranet_sistemas WHERE $TarrayTags $complementaPesquisa";//usada somente para paginacao											
						$entSql 	 = "SELECT SIST.*, ENT.entidade_nome FROM intranet_sistemas AS SIST INNER JOIN entidades AS ENT ON ENT.entidade_id = SIST.intranet_sistemas_entidade_id WHERE $TarrayTags $complementaPesquisa ORDER BY intranet_sistemas_nome ASC LIMIT 10 OFFSET $inicio";//lista os sistemas que NAO sao favoritos
						$Tcaminho	 = "?pagina=sistconsulta&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";	
					}			
				}
				//############################# RETORNOS ####################################
				
				$TreturnSqlEnt = $drive->pedido($entSql);
				$TreturnSqlNum = $drive->pedido($numSql);
				$i = 0;
				echo'<div class="tag_result_busca">resultados da busca</div><br><table width="650" border="0" cellspacing="0" cellpadding="0">';
				
				//#################################### SISTEMAS NAO FAVORITOS #######################
				// mostra os botoes ACESSAR e INCLUIR
				while($linha2 = pg_fetch_object($TreturnSqlEnt)){
					$sistId		= $linha2->intranet_sistemas_id;
					$favUser	= "SELECT * FROM intranet_favoritos WHERE intranet_favoritos_user_id = $Tuser_id AND intranet_favoritos_sistema_id = $sistId";
					$Tfavuser	= $drive->pedido($favUser);					
					$TFavoritos = pg_fetch_object($Tfavuser);
						echo'				
							<tr>
								<td valign="top" width="530" class="result_busca_intranet"><a href="inicio.php?pagina=sistdesc&menu='.$_GET['menu'].'&sistid='.$linha2->intranet_sistemas_id.'"><span class="titulo_linkserv">'.$linha2->intranet_sistemas_nome.'</span></a><p>
								<b>'.$linha2->entidade_nome.'</b><br><a href="inicio.php?pagina=sistdesc&menu='.$_GET['menu'].'&sistid='.$linha2->intranet_sistemas_id.'">'.subString($linha2->intranet_sistemas_descricao, 180).'</a>';
								
								echo '
								</td>
								<td valign="top" width="60" class="result_busca_intranet">';
								if($linha2->intranet_sistemas_exibirweb =='t'){
									echo '<a href="'.$linha2->intranet_sistemas_endereco.'"><img src="../layout/imagens/intra_btn_acessar.png" alt="online" border="0" align="left" valign="top" /></a>';
								}								
								echo '</td>
								<td valign="top" width="105" class="result_busca_intranet">';
								if($TFavoritos->intranet_favoritos_id == false){									
									echo '<a href="inicio.php?pagina=sistfavs&menu='.$_GET['menu'].'&id='.$linha2->intranet_sistemas_id.'"class="toggleopacity"><img src="../layout/imagens/intra_btn_inclui_fav.png" border="0" align="right" valign="top" />';
								}
								echo'
								</td>
								
							</tr>'; 
					$i++;
				}
				if($i == 0){
					echo "<br /><br /><b>Nenhum Sistema Encontrado.</b>";
				}
				echo '</table>';
				?>	
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
       	<?php 
	   	}
	   	?>
       </div><!-- fim coluna_home_1 -->
	</div>
</div><!-- fim coluna_C2 -->   