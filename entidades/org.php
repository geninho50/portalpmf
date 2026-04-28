<div class="centro">
	<div id="caminho_migalhas">home &gt; sobre</div>
	<div id="titulo_pagina">organograma</div>
	<div>   
		<?php
        $sql 		= "SELECT * FROM entidades WHERE entidade_id = $IdEntidade";
        $result 	= $drive->pedido($sql);
        $Tentidade  = pg_fetch_object($result);    

		if(isset($Tentidade->entidade_link_pdf) && !empty($Tentidade->entidade_link_pdf)){
			echo "<a href=\"../../arquivos/documentos/$Tentidade->entidade_link_pdf\"> clique aqui para baixar o organograma desta entidade</a>";
		}else{
			echo "O organograma ainda não foi disponibilizado.";
		}      
		?>
	</div>
</div>

<script>  
function popNoticias(noticia){  
document.noticia = noticia;//seto o valor para a window.open();  
window.open ("http://portal.pmf.sc.gov.br/arquivos/documentos/<?=$Tentidade->entidade_link_pdf?>","noticia","toolbar=0,status=no,resizable=0,scrollbars=1,width=700,height=600,screenX="+parseInt((screen.availWidth/2) - (620/2))+",screenY="+parseInt((screen.availHeight/2) - (350/2))+",left="+parseInt((screen.availWidth/2) - (620/2))+",top="+parseInt((screen.availHeight/2) - (550/2)));  
}  
</script>  