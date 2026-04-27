<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">consultar avisos</div>
	<div>       
       <div id="coluna_intranet_unica">
       <div class="box">
        
        <form method="post" action="inicio.php?pagina=avisoconsulta&menu=<?=$_GET['menu']?>" onsubmit="return verificaForm()">  
		<div class="texto_formulario">
        <input name="Ftipo_busca" type="radio"  value="completa" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")or(!isset($_POST['Ftipo_busca']))){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa </div>
        <div class="texto_formulario">
        <input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?>/>Buscar por:<br/>
		</div>
		<div class="container_6">
                    <?php
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags				
					?>
					
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma.<br /><br/>              
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
                    </script> <br><br />
                     <input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />
		</div>
        </form>
		
     
     </div>
             
    
        
        <?php
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){	
			require_once("../scripts/php/funcoes.php");
			require_once("../scripts/php/paginacao.php");			
			
			$TidEntidade = $_SESSION['SuserEnt'];
			
			//-----------------------
			// Controle de Paginação
			//-----------------------	
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
				$numSql   = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade";
				$entSql   = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade ORDER BY intranet_avisos_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=avisoconsulta&menu=".$_GET['menu']."&tp=cp";
			}
			
			//---------------------
			// Busca Personalizada
			//---------------------
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
				if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("intranet_avisos_palavra_chave", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags";
					$entSql  	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = $TidEntidade AND $TarrayTags ORDER BY intranet_avisos_data DESC LIMIT 10 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=avisoconsulta&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
				}			
			}
		
			$TreturnSqlEnt = $drive->pedido($entSql);
			$TreturnSqlNum = $drive->pedido($numSql);
					
			$i = 0;
			
			//-------------------
			// Imprime os avisos
			//-------------------
			echo'<div class="tag_result_busca">resultados da busca</div>';
			while($linha = pg_fetch_object($TreturnSqlEnt)){
				$dataini=explode("-", $linha->intranet_avisos_data);
				$data=$dataini[2]."/".$dataini[1]."/".$dataini[0];
				echo '
					<table width="550" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td valign="top" class="result_busca_intranet">	
							<strong >'.$data.'</strong> - 	 
							<a href="inicio.php?pagina=aviso&aviso_id='.$linha->intranet_avisos_id.'&menu='.$_GET['menu'].'"><span class="titulo_linkserv">'.$linha->intranet_avisos_titulo.'</span><br>
							'.subString($linha->intranet_avisos_texto, 150).'</a>
							</td>
						</tr>           
					</table>';
				 $i++;
			}
			if($i == 0){
				echo "<b>Nenhum Aviso Encontrado.</b>";	
			}   
			?> 
			<br />
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
		} ?>  
        </div>
	</div> 
</div>