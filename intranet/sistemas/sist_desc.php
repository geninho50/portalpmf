<?php
$TsistemaId  = $_GET['sistid'];
$sqlSist	 = "SELECT * FROM intranet_sistemas WHERE intranet_sistemas_id = $TsistemaId";
$TreturnSist = $drive->pedido($sqlSist);
$Tsistema 	 = pg_fetch_object($TreturnSist);
?>
<div class="centro">         
	<div id="caminho_migalhas">intranet > descri&ccedil;&atilde;o sistema</div>
	<div id="titulo_pagina"><?=$Tsistema->intranet_sistemas_nome?></div>
    
    <div>
	  <div id="coluna_intranet_1">
      
      <div id="conteudo_pagina">
		<?=$Tsistema->intranet_sistemas_descricao?><br /><br />
      </div><!-- fim conteudo_pagina -->  
        
      </div><!-- fim coluna_intranet_1 --> 
	  <div id="coluna_intranet_2">
		<div id="painel_lateral">
		 <h1>suporte</h1>
         <ul>
  		 <li><b>Responsável:</b><br> <?=$Tsistema->intranet_sistemas_resp_nome?></li>
		 <li><b>Fone:</b> <?=$Tsistema->intranet_sistemas_resp_fone?></li>
		 <li><b>E-mail:</b> <?=$Tsistema->intranet_sistemas_resp_mail?></li>
        </ul>
         </div><!-- fim box_msg_lateral --> 
       </div><!-- fim coluna_intranet_2 -->  
        
        
    </div>
</div>