<?php 

if( !($IdEntidade != 37 && $IdEntidade != 14 && $IdEntidade != 13) ):



$sqltrans = "SELECT * FROM 
				tipo_relatorio 
			 WHERE 
				tiporel_entidade_id = $IdEntidade
			 ORDER BY 
				tiporel_nome";
					
$rtrans = $drive->pedido($sqltrans);
require_once("../../scripts/php/funcoes.php");
require_once("../../scripts/php/paginacao.php");
?>
<div class="centro">
	<div id="caminho_migalhas">home &gt; gestão e transparência</div>
	<div id="titulo_pagina">gestão e transparência</div>
	<div>
		<div class="box_msg_baixo">
        	Para acessar relat&oacute;rios de presta&ccedil;&atilde;o de contas da <strong><?php echo $NomeEntidade; ?></strong>, selecione uma das opções abaixo e pressione o botão OK.
        </div>   
   	<div >
    <br />
    <form name="form" method="post" onsubmit="return verificaForm(this)" action="?pagina=govgestao&menu=<?=$_GET['menu']?>">
    	<select name="tprel" class="componente_grande">
            <option value="0" style="height:16px;">=== relatórios disponíveis ===</option>
            <option value="0" style="height:16px;"></option>
			<?php									
			while($objrel = pg_fetch_object($rtrans)){	
			?>								
           		<option 
				<?php if(($objrel->tiporel_id == $_POST['tprel']) or ($objrel->tiporel_id == $_GET['tprel'])){ 
					echo"selected=\"selected\""; 
				}
				?> 
                value="<?=$objrel->tiporel_id?>" style="height:16px;">
					<?=$objrel->tiporel_nome?>
                </option>
           	<?php
            }
			?>               
		</select >
    	<input type="image" name="enviar" id="enviar" value="enviar" src="../../layout/imagens/atualiza_btn_OK.png" align="absmiddle"/>
    	<input type="hidden" name="passo" value="1" />
    </form> 
    
    <br>
     <ul class="listagem">
	<?php
	
    if((isset($_POST['enviar_x'])) or (isset($_GET['pg']))){
		
		//------------------------------------------------------------
		// verifica se é a primeira página para controle da paginação
		//------------------------------------------------------------
		if(!isset($_GET['pg'])){
			$pg 	= 1;
			$Tprel 	= $_POST['tprel'];
		}else{
			$pg 	= $_GET['pg'];
			$Tprel 	= $_GET['tprel'];	
		}		
		$inicio = ($pg * 10) - 10; 
		
		//------------------------------------------------------------
		// Busca no BD as informações do Tipo de Relatório solicitado
		//------------------------------------------------------------		
		$numSql = "SELECT COUNT(*) FROM arquivo_relatorio WHERE arqrel_tiporel_id = $Tprel";
		$relSql = "SELECT arqrel_id, arqrel_periodo, arqrel_link FROM arquivo_relatorio WHERE arqrel_tiporel_id = $Tprel ORDER BY arqrel_id DESC LIMIT 10 OFFSET $inicio";
		$TreturnSqlRel = $drive->pedido($relSql);
		$TreturnSqlNum = $drive->pedido($numSql);
		$Tcaminho	   = "?pagina=govgestao&menu=".$_GET['menu']."&tprel=".$Tprel;			

		$k = 0;
		while($Trelatorio = pg_fetch_object($TreturnSqlRel)){
			$Tperiodo = $Trelatorio->arqrel_periodo;
			$Tdata[0] = substr($Tperiodo,2,2);
			$Tdata[1] = substr($Tperiodo,4,4);					
			$Tdata[2] = substr($Tperiodo,10,2);
			$Tdata[3] = substr($Tperiodo,12,4);

			for ($j=0; $j<=2; $j++){ // imprime mes 
				switch ($Tdata[$j]){
					case 1: $Tmes[$j] = "Janeiro"; break;
					case 2: $Tmes[$j] = "Fevereiro"; break;
					case 3: $Tmes[$j] = "Março"; break;
					case 4: $Tmes[$j] = "Abril"; break;
					case 5: $Tmes[$j] = "Maio"; break;
					case 6: $Tmes[$j] = "Junho"; break;
					case 7: $Tmes[$j] = "Julho"; break;
					case 8: $Tmes[$j] = "Agosto"; break;
					case 9: $Tmes[$j] = "Setembro"; break;
					case 10: $Tmes[$j] = "Outubro"; break;
					case 11: $Tmes[$j] = "Novembro"; break;
					case 12: $Tmes[$j] = "Dezembro"; break;
				}
			$j++;
			}
			echo"
			<li>
				<a href=\"../../../arquivos/documentos/".$Trelatorio->arqrel_link."\"  title=\"<?=$V_mes[0]?> de <?=$V_data[1]?> a <?=$V_mes[2]?> de <?=$V_data[3]?>\">
					<img src=\"../../../layout/imagens/icon_pdf.png\" alt=\"pdf\" align=\"absmiddle\" border=\"0\" />
					<strong>$Tmes[0] de $Tdata[1] a $Tmes[2] de $Tdata[3]</strong>
				</a>
			</li>";			
			$k++;
		}
					
		if($k == 0){
			echo"<b>Nenhum arquivo encontrado para download</b>";
		}
		?>
        
        
        </ul>
        
        <?php
		
		//------------------------------------
		// Imprime numumero de paginas rodapé 
		//------------------------------------
			$numPagTotal = pg_fetch_object($TreturnSqlNum);
			echo "<p align=\"center\">";						
			mostra_paginas($numPagTotal->count, $pg, $Tcaminho, 10);
			echo "<p>";				
		//----------------------------
		// Fim imprime num de páginas 
		//----------------------------
	}
	?>
		</div>    	
	</div>
</div>
 
<script language="javascript">
function submitForm(){

document.form.submit();
}

function verificaForm (form){	
	if(form.tprel.value==0){
		alert("Selecione um relatório");
		return false;
	}else	
	return true;	
}
</script>

<?php endif; ?>