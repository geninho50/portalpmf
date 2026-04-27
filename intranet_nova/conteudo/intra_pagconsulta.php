<script>
function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<div class="centro">
    <div id="caminho_migalhas">intranet &gt;</div>
    <div id="titulo_pagina">localizar página</div>
	<div>

		<div id="coluna_intranet_unica">
			<div class="box_busca">
       			<form method="post" action="inicio.php?pagina=pagconsulta&menu=<?=$_GET['menu']?>" onsubmit="return verificaForm()">
					<div class="texto_formulario">
                    	<input name="Ftipo_busca" type="radio" value="completa" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")or(!isset($_POST['Ftipo_busca']))){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa 
                    </div>
					<div class="texto_formulario">
                    	<input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?> />Buscar por:
					</div>
					<div class="container_6">
						palavra-chave: <br>    
						<?php
						//---------------------------------------
						// reucpera as tags pa exibir ao usuário
						//---------------------------------------
						if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
						?>
                        <input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/><br>
                        período de criação:<br>
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
                        <br /><br />
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
	// Controle de paginação
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
		$numSql   = "SELECT COUNT(*) FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TidEntidade AND intranet_pagina_status='t'";
		$entSql   = "SELECT * FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TidEntidade AND intranet_pagina_status='t' ORDER BY intranet_pagina_titulo ASC LIMIT 10 OFFSET $inicio";
		$Tcaminho = "?pagina=pagconsulta&menu=".$_GET['menu']."&tp=cp";
	}
	
	//---------------------
	// Busca Personalizada	
	//---------------------
	if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){				
		if(($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")){	
			if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
			$TarrayTags  = $drive->arrayTags("intranet_pagina_palavra_chave", $Ttags); 
			$numSql   	 = "SELECT COUNT(*) FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TidEntidade AND $TarrayTags AND intranet_pagina_status='t'";
			$entSql  	 = "SELECT * FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TidEntidade AND intranet_pagina_status='t' AND $TarrayTags ORDER BY intranet_pagina_titulo ASC LIMIT 10 OFFSET $inicio";		
			$Tcaminho	 = "?pagina=pagconsulta&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
		}			
	}
	$TreturnSqlEnt = $drive->pedido($entSql);
	$TreturnSqlNum = $drive->pedido($numSql);
	?>
	<div class="tag_result_busca">resultados da busca</div>
		<table width="620" border="0" cellspacing="0" cellpadding="0">
			<?php	
            $i = 0;
            
            //------------------------------------------
            // Imprime listagem das paginas disponiveis
            //------------------------------------------
            while($linha = pg_fetch_object($TreturnSqlEnt)){
                echo'		
                    <tr>
                        <td valign="top" class="result_busca_intranet"><a href="?pagina=pagina&menu='.$_GET['menu'].'&idPag='.$linha->intranet_pagina_id.'"> <span class="titulo_linkserv"> '.$linha->intranet_pagina_titulo.'</span></a><br>
                        '.substr($linha->intranet_pagina_texto,0,150).'</td>
                    </tr>';			
                $i++;
            }
            if($i == 0){
                echo "<b>Nenhuma P&aacute;gina Encontrada.</b>";	
            }   
            ?> 
    	</table>
	
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
			mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho);
			echo "<p>";				
		}	
		echo "</div>";
		} ?>        
	</div>
</div>
</div>