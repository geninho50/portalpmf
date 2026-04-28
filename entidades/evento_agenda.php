  
  <?php
  	 
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");

		$drive->conecta();
		if(empty($_POST['passo'])){
		$sql = "SELECT * FROM eventos 
				WHERE evento_status = 't'  AND  evento_entidade_id = $IdEntidade ORDER BY evento_data_inicio DESC";
		}else
			if($_POST['passo']==1){
			
				if($_POST['mes']==0){
					$dataIncial = $_POST['ano']."/01/01";
					$dataFinal = $_POST['ano']."/12/31";
					
					$sql = "SELECT * FROM eventos 
							WHERE evento_status = 't' AND evento_data_inicio >= '$dataIncial' AND evento_data_inicio <= '$dataFinal'  AND evento_entidade_id = $IdEntidade ORDER BY evento_data_inicio DESC";
				}else
				if(!$_POST['mes']==0){
					$dataIncial = $_POST['ano']."/".$_POST['mes']."/01";
					$ultDia = date("d",mktime(0, 0, 0, ($_POST['mes'] + 1), 0, $_POST['ano']));
					$dataFinal = $_POST['ano']."/".$_POST['mes']."/$ultDia";
									
					$sql = "SELECT * FROM eventos 
							WHERE evento_status = 't' AND evento_data_inicio >= '$dataIncial' AND evento_data_inicio <= '$dataFinal' AND evento_entidade_id = $IdEntidade ORDER BY evento_data_inicio DESC";
				}
								
			}
	  
	  $resultado = $drive->pedido($sql);
	 	
	  if(pg_num_rows($resultado)>0){
	  while($obj = pg_fetch_object($resultado)){
		$i=0;
		$tituloEvento = strip_tags($obj->evento_nome);
		$idEvento = $obj->evento_id;
		
		$data1 = transformaData($obj->evento_data_inicio);
		$data2 = transformaData($obj->evento_data_final);
		
		$textoOrig = strip_tags($obj->evento_texto);
		$texto = substr($textoOrig, 0, 170);
		if (strlen($textoOrig) > 170) {
			$texto = $texto."...";
		}
		
		$sqlImg = "SELECT IMG.*, EIMG.* FROM imagens AS IMG
					JOIN eventos_imagens AS EIMG ON IMG.img_id = EIMG.eimg_img_id
					WHERE EIMG.eimg_evento_id=$idEvento ";
					
		$res = $drive->pedido($sqlImg);
		if(pg_num_rows($res)>0){
			while($objImg = pg_fetch_object($res)){
				$principal = $objImg->eimg_principal;
				
				if($principal=='t'){
					$imgPequena = $objImg->img_link_v_pequena;
					
				}
				if($i==0){
					$imgPequena = $objImg->img_link_v_pequena;
				}
				$i++;
				$imagem="<td width=\"125\">
								<a href=\"index.php?pagina=eventopagina&event=$idEvento&menu=$menuNot\"
									<img src=\"../$imgPequena\" border=\"0\" class=\"foto\" />
								</a>
							</td>";
			}
		}else
			$imagem="";
		$imprimir.="	
				<li>
				<table  width=\"97%\">
					<tr>
						$imagem
						<td>
							<h3><a href=\"index.php?pagina=eventopagina&event=$idEvento&menu=$menuNot\">
							$tituloEvento</a></h3> 
							<strong>
								$data1 à $data2
							</strong>
							<br>
							$texto
							
						</td>
					</tr>
				</table></li>
				";
	  
	  }
	  }else{
	  	$imprimir = "Nenhum Evento Encontrado<br/><br/>";
	  }
   ?>
      <div class="centro">
      <div id="caminho_migalhas">home &gt; not&iacute;cias e eventos</div>
     <div id="titulo_pagina">agenda de eventos</div>
     
     <div class="box_msg_baixo">Abaixo você encontra a lista dos <strong>últimos eventos</strong>. Para consultar por período, selecione-o abaixo e pressione o botão OK.</div><br />     
     <div>      
    	  <form method="post">
          	  <input type="hidden" name="passo" value="1"/>	
                            
              <select name="mes">
              	<option value="0">== Todos os Meses ==</option>
                <option value="1">Janeiro</option> 
                <option value="2">Fevereiro</option> 
                <option value="3">Março</option> 
                <option value="4">Abril</option> 
                <option value="5">Maio</option> 
                <option value="6">Junho</option> 
                <option value="7">Julho</option> 
                <option value="8">Agosto</option> 
                <option value="9">Setembro</option> 
                <option value="10">Outubro</option> 
                <option value="11">Novembro</option> 
                <option value="12">Dezembro</option> 
              </select class="componente_miolo">  
              
              <select name="ano">
				  <?php 
				  	$ano = date("Y");
					$i = $ano-5;
					$z = $ano+5;
                  	for($j=$i; $i<=$z; $i++){
						if($i == $ano){
							$option.=" <option value=\"$i\" selected>$i</option> ";
						}else
							$option.=" <option value=\"$i\">$i</option> ";
					}
               		echo($option);
			      ?>
               
              </select class="componente_miolo">   
              <input type="image" src="../../layout/imagens/btn_ok_azul.png" align="absmiddle"/>  
                          
          </form>
          
          <br>
          <ul class="listagem">
          <?=$imprimir?>
          </ul>  
          <br />
                  
          
      </div>
   </div><!-- fim coluna_C2 -->            
          

