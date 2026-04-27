<div class="centro">
<div id="pagina">
<div id="caminho_migalhas">home &gt;</div>

		<div id="titulo_pagina">galeria de imagens</div>					 
		<div id="conteudo_pagina">
	<?php
	require_once(CAMINHO_SITE."/scripts/php/paginacao.php");
	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}
	$inicio = ($pg * 16) - 16; 
	$Tcaminho = "?pagina=imagens";
		
	$numSql = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $IdEntidade AND img_txt = 'f'";
	$sql 	= "SELECT * FROM imagens WHERE img_entidade_id = $IdEntidade AND img_txt = 'f' ORDER BY img_data DESC LIMIT 16 offset $inicio"; 
	$result = $drive->pedido($sql);
	$TreturnSqlNum = $drive->pedido($numSql);
	?> 
	<div id="galeria" class="sem_margem_topo">   
        
        
          	<ul style="overflow:none;">
            Clique sobre qualquer das imagens para visualiz&aacute;-la em tamanho grande.
            	<?php 
				$i=0;
				while($obj = pg_fetch_object($result)){	
					echo"<a href=\"../$obj->img_link_v_alta\" rel=\"colorbox-galeria\" title=\"$legenda2  $obj->img_legenda\" >
						 <li>
						 <img src=\"../$obj->img_link_v_pequena\" border=\"0\">
						 </li>
						 </a>";
						 $i++;
				}
				?>             
           	</ul>
      	
       	</div>
        
        </div>  
		<?php

		if($i>0){
// ========================= imprime numumero de paginas rodapé  =========================

			$numPagTotal = pg_fetch_object($TreturnSqlNum);
			
			$TnumPag = $numPagTotal->count;
			if($TnumPag < 16){
				$TnumPag = 16;
			}
			mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 16);
				

// ========================= fim imprime num de páginas  =========================

	
	} else {
	?>
        Ainda n&atilde;o foram inclu&iacute;das imagems.
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<?php
    } 
    ?>
    <br class="clearfloat" />  
	</div>    
</div>