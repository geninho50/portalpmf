<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar p&aacute;ginas</div>
		<div id="margem_direita">
			<div class="painel_abas">            
                <a href="?pagina=pagcad&menu=<?=$_GET['menu']?>&aba=edicao"><div id="aba_edicao" <?php if(($_GET['aba'] == "edicao")or(!isset($_GET['aba']))){echo"class=\"aba_sel\"";}else{echo"class=\"aba_adm\"";}?>><span>edi&ccedil;&atilde;o</span></div></a>
                <a href="?pagina=pagcad&menu=<?=$_GET['menu']?>&aba=publicadas"><div id="aba_publicadas" <?php if($_GET['aba'] == "publicadas"){echo"class=\"aba_sel\"";}else{echo"class=\"aba_adm\"";}?>><span>publicadas</span></div></a>
                <a href="?pagina=pagcad&menu=<?=$_GET['menu']?>&aba=localizar"><div id="aba_localizar" <?php if($_GET['aba'] == "localizar"){echo"class=\"aba_sel\"";}else{echo"class=\"aba_adm\"";}?>><span>localizar</span></div></a>
			</div>            
			<div class="conteudo_abas">        
        	<?php
			switch($_GET['aba']){
				case "edicao": 		require_once("conteudo/abas/pesquisa/pesq_edicao.php"); 	break;
				case "publicadas": 	require_once("conteudo/abas/pesquisa/pesq_publicadas.php"); break;
				case "localizar": 	require_once("conteudo/abas/pesquisa/pesq_localizar.php");	break;
				default: 			require_once("conteudo/abas/pesquisa/pesq_edicao.php"); 	break;
			}
			?>
		</div>
 	</div>
</div>