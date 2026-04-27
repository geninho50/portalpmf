<div class="centro">

	<div id="caminho_migalhas">home &gt; governo</div>

	<div id="titulo_pagina">diário oficial do município</div>
    
    <div class="box_msg_baixo">Selecione um m&ecirc;s e um ano e clique no bot&atilde;o OK para ter acesso aos arquivos Di&aacute;rio Oficial do Municipio de Florian&oacute;polis.</div> <br>  
	        <div >
    


        <?PHP
		
		session_start();

		if(!isset($_POST['passo'])){

			$V_mes = date("m");

		}else{

			$V_mes = $_POST['mes'];

		}

		?>

		<form name="form" method="post" action="index.php?pagina=govdiariooficial">

        <table><tr><td>

        <input type="hidden" name="passo" value="1" />

        <select name="mes" class="componente_pequeno">

            <option value="1" title="janeiro" <?PHP if($V_mes == 1){echo "selected=\"selected\"";}?>>Janeiro</option>

            <option value="2" title="fevereiro"<?PHP if($V_mes == 2){echo "selected=\"selected\"";}?>>Fevereiro</option>

            <option value="3" title="março"<?PHP if($V_mes == 3){echo "selected=\"selected\"";}?>>Março</option>

            <option value="4" title="abril"<?PHP if($V_mes == 4){echo "selected=\"selected\"";}?>>Abril</option>

            <option value="5" title="maio" <?PHP if($V_mes == 5){echo "selected=\"selected\"";}?>>Maio</option>

            <option value="6" title="junho" <?PHP if($V_mes == 6){echo "selected=\"selected\"";}?>>Junho</option>

            <option value="7" title="julho" <?PHP if($V_mes == 7){echo "selected=\"selected\"";}?>>Julho</option>

            <option value="8" title="agosto" <?PHP if($V_mes == 8){echo "selected=\"selected\"";}?>>Agosto</option>

            <option value="9" title="setembro" <?PHP if($V_mes == 9){echo "selected=\"selected\"";}?>>Setembro</option>

            <option value="10" title="outubro" <?PHP if($V_mes == 10){echo "selected=\"selected\"";}?>>Outubro</option>

            <option value="11" title="novembro" <?PHP if($V_mes == 11){echo "selected=\"selected\"";}?>>Novembro</option>

            <option value="12" title="dezembro" <?PHP if($V_mes == 12){echo "selected=\"selected\"";}?>>Dezembro</option> 

		</select> 

        </td><td>

        <?

        if(!isset($_POST['passo'])){

			$V_ano_atual = date("Y");

		}else{

			$V_ano_atual = $_POST['ano'];

		}

		$V_aux2 = date("Y");

		$V_aux = $V_aux2 - 2008

		?> 			

        <select name="ano" class="componente_pequeno">

			<?PHP

            for($i = 1; $i <= $V_aux; $i++){

			$V_ano = (2008 + $i);

			?>

            <option value="<?=$V_ano?>" title=<?="$V_ano"?> <?PHP if($V_ano == $V_ano_atual){echo "selected=\"selected\"";}?>><?=$V_ano?></option> 

            <?PHP

            }

			?>

		</select> 

        </td><td>

        <input type="image" name="enviar" id="enviar" src="../layout/imagens/atualiza_btn_OK.png" align="absmiddle"/>

        </td></tr></table>

		</form>

        <br><br>
        <ul class="listagem">

        <?PHP 

		require_once("../scripts/php/funcoes_bd.php");

		require_once("../scripts/php/paginacao.php");

		if (!$_GET['pagina_at']){		
		
			if(!isset($_POST['passo'])){
	
				$V_data_1 = date("Y/m/")."01";
	
				$V_data_2 = date("Y/m/t");
	
			}else{
	
				switch ($_POST['mes']){
	
					case 1: $V_dia_fim = 31; break;
	
					case 2:
	
						if ((($_POST['ano'] % 4) == 0 and ($_POST['ano'] % 100)!=0) or ($_POST['ano'] % 400)==0){ // Verifica ano bissexto
	
							$V_dia_fim = 29; break;
	
						}else{
	
							$V_dia_fim = 28; break;
	
						}
	
					case 3: $V_dia_fim = 31; break;
	
					case 4: $V_dia_fim = 30; break;
	
					case 5: $V_dia_fim = 31; break;
	
					case 6: $V_dia_fim = 30; break;
	
					case 7: $V_dia_fim = 31; break;
	
					case 8: $V_dia_fim = 31; break;
	
					case 9: $V_dia_fim = 30; break;
	
					case 10: $V_dia_fim = 31; break;
	
					case 11: $V_dia_fim = 30; break;
	
					case 12: $V_dia_fim = 31; break;
	
				}
				
				$V_data_1 = $_POST['ano']."/".$_POST['mes']."/01";
	
				$V_data_2 = $_POST['ano']."/".$_POST['mes']."/".$V_dia_fim;
	
			}		
			
			$drive->conecta();
	
			$sql = "SELECT 
						* 
					FROM 
						arquivo_diario_oficial 
					WHERE 
						arquivo_diario_oficial_data >= '$V_data_1' 
						AND 
						arquivo_diario_oficial_data <= '$V_data_2'
						AND
						arquivo_diario_oficial_exc = 'f'
					ORDER BY
						arquivo_diario_oficial_data
					DESC";
	
	
			$V_diario1 = $drive->pedido($sql);
			
			$drive->close(); 
			
		}

		while($diario_imp =  pg_fetch_object($V_diario1)) 
		{

		$V_dia = substr($diario_imp->arquivo_diario_oficial_data, 8, 2);

		$V_mes = substr($diario_imp->arquivo_diario_oficial_data, 5, 2);

		$V_ano = substr($diario_imp->arquivo_diario_oficial_data, 0, 4);

		$V_ano1 = substr($diario_imp->arquivo_diario_oficial_data, 2, 2);
		
		switch ($V_mes){
			case 1: $V_mes = "Janeiro"; break;
			case 2: $V_mes = "Fevereiro"; break;
			case 3: $V_mes = "Março"; break;
			case 4: $V_mes = "Abril"; break;
			case 5: $V_mes = "Maio"; break;
			case 6: $V_mes = "Junho"; break;
			case 7: $V_mes = "Julho"; break;
			case 8: $V_mes = "Agosto"; break;
			case 9: $V_mes = "Setembro"; break;
			case 10: $V_mes = "Outubro"; break;
			case 11: $V_mes = "Novembro"; break;
			case 12: $V_mes = "Dezembro"; break;
		}
		
		$V_converte = (string) $diario_imp->arquivo_diario_oficial_edicao;

		$V_num = strlen($V_converte);

		$V_zeros = 3;

		$V_0 = "";

		for ($j = $V_num; $j < $V_zeros; $j++){

			$V_0 = "0".$V_0;

		}

		?>
        
        
        <li>
        		<a href="../../arquivos/diario/<?=$diario_imp->arquivo_diario_oficial_link?>" title="Edição <?=$V_0.$diario_imp->arquivo_diario_oficial_edicao."/".$V_ano1;?> : <?=$V_dia?> de <?=$V_mes?> de <?=$V_ano?>">
              <img src="../layout/imagens/icon_pdf.png" alt="Edição <?=$V_0.$diario_imp->arquivo_diario_oficial_edicao."/".$V_ano1;?> : <?=$V_dia?> de <?=$V_mes?> de <?=$V_ano?>" align="absmiddle" border="0"/>
               <strong>Edição <?=$V_0.$diario_imp->arquivo_diario_oficial_edicao."/".$V_ano1;?> :</strong> <?=$V_dia?> de <?=$V_mes?> de <?=$V_ano?>
        </a></li>
        
       

        <?PHP

		}

		?>
        
     </ul>
	</div>
    
</div><!-- fim coluna_C2 -->            
          
          

