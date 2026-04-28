<?php
if(isset($_POST['btNoticias_x'])){

//---------------------------------------------------
// Recupera as notícias selecionadas na para o envio
//---------------------------------------------------
$sqlNoticias 	 = "SELECT noti_id FROM noticias";
$TreturnNoticias = $drive->pedido($sqlNoticias);
$TnotEnvio		 = "";
while($Tnoticia = pg_fetch_object($TreturnNoticias)){
	$Ttemp_name = 'N' . $Tnoticia->noti_id;
	$TnotId     = (int)$Tnoticia->noti_id;
	if(isset($_POST[$Ttemp_name])){
		$TnotEnvio .= $TnotId."#";			
	}
}

//--------------------------------------------------
// Imprime a lista de contatos para enviar o maling
//--------------------------------------------------
require_once("../scripts/php/funcoes.php");
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">enviar mailing</div>
	<div id="margem_direita">
    	<br />
		<img src="../layout/imagens/intra_mailing_passo2.png" alt="passo 2" border="0" align="absmiddle" />
		<div class="conteudo_abas">  
			<div id="conteudo_localizar" style="display:inline">
				<p><h3>Selecione os destinatários que devem receber o mailing.</h3></p>
				Basta navegar na árvore abaixo e marcar os contatos desejados. <br />
				Para enviar para todos os contatos de uma categoria basta marcar a própria categoria.
				<br /><br /><br />                
				<form action="?pagina=mailenvioliberar&menu=<?=$_GET['menu']?>" method="post" >
                <input type="hidden" name="Fnoticias" value="<?=$TnotEnvio?>" />
                <ul id="tree">
					<li><input type="checkbox"> <img src="../layout/imagens/intra_icon_categorias2.png" border="0" align="absmiddle" /> <strong>CATEGORIAS</strong>
						<br /><?php
						$Traiz = 0;                
						mostraArvore($Traiz, $drive);
                        ?>                       	
                	</li>
                </ul>
                <br />
                <input type="image" src="../layout/imagens/intra_btn_avancar.png" name="btLiberar" id="btLiberar" align="absmiddle" />
                </form>
			</div>
		</div>
	</div>
</div>
<?php
}else{
	echo("<script>window.location = \"inicio.php?pagina=mailenvionot\"</script>");	
}
?>