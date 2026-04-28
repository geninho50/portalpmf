<?php
	if(isset($_GET['info']))
	{
		$info = $_GET['info'];
	}else{
		$info = "servicos";
	}
	
?>


<script type="text/javascript">

function stAba(menu,conteudo){
		this.menu = menu;
		this.conteudo = conteudo;
}

var arAbas = new Array();
arAbas[0] = new stAba('aba_servicos','conteudo_servicos');
arAbas[1] = new stAba('aba_documentos','conteudo_documentos');


function AlternarAbas(menu,conteudo){
	for (i=0;i<arAbas.length;i++){
		document.getElementById(arAbas[i].menu).className = 'aba_entid';
		document.getElementById(arAbas[i].conteudo).style.display = 'none';
	}
	document.getElementById(menu).className = 'aba_sel';
	document.getElementById(conteudo).style.display = 'inline';
}

</script>


     <div class="centro">
      <div id="cabecalho_servicos">
      	<div id="caminho_migalhas">home &gt; serviços</div>
     	<div id="titulo_pagina">Listagem de Serviços e Documentos</div>
     
     	<div class="box_msg_baixo">Para obter <strong>informações sobre serviços ou documentos</strong>, clique no botão <strong>Info</strong>. 
        Para os serviços  on-line, está disponível o botão de acesso.</div> 
     	<br>
        
      </div>
	<div id="area_servicos">
         	
        	<?php
				
				switch($info)
				{
					case "servicos": require_once("abas/LServicos.php");
					break;
					case "documentos": require_once("abas/LDocumentos.php");
					break;
					default: require_once("abas/LServicos.php");
					break;
				}
			
			?>
          
      </div>
   </div><!-- fim coluna_C2 -->