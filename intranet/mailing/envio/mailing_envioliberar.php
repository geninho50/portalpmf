<?php
if(isset($_POST['btLiberar_x']) || (isset($_POST['btEnviar_x'])) ){
	
	//--------------------------------------------------
	// Bloqueia a tela enquanto os e-mails são enviados
	//--------------------------------------------------
	if(isset($_POST['btEnviar_x'])){
		$TmsgLoader = "Enviando Mailing.";
		include("../scripts/php/loader.php");
	}
	
	require_once("../scripts/php/funcoes.php");
	
	//----------------------------------------------------
	// Recupera os ids para quem vai ser enviado o maling
	//----------------------------------------------------
	$sqlMaling 	   = "SELECT mailing_contato_id FROM mailing_contato";
	$TreturnMaling = $drive->pedido($sqlMaling);
	$TdestEnvio	   = "";
	while($Tdest = pg_fetch_object($TreturnMaling)){
		$Ttemp_name = 'C' . $Tdest->mailing_contato_id;
		$TdestId    = (int)$Tdest->mailing_contato_id;
		if(isset($_POST[$Ttemp_name])){
			$TdestEnvio .= $TdestId."#";			
		}
	}
	
	//------------------------------------------------
	// Recuperas os IDS das notícias a serem enviadas
	//------------------------------------------------
	$Tnoticias = $_POST['Fnoticias'];
	$TnotIds   = explode("#", $_POST['Fnoticias']);
	?>
    <div class="centro">
        <div id="caminho_migalhas">intranet &gt; mailing</div>
        <div id="titulo_pagina">enviar mailing</div>
        <div id="margem_direita"><br />
            <img src="../layout/imagens/intra_mailing_passo3.png" alt="passo 3" border="0" align="absmiddle" />
            <div class="conteudo_abas">  
                <div id="conteudo_localizar" style="display:inline">
                    <p><h3>Confira o resumo das notícias que você selecionou.</h3></p>
                    Para liberar o mailing, clique no botão enviar mailing e o resumo das notícias será enviado aos destinatários.
                    Caso queira desistir do envio, clique no botão cancelar.<br /><br /><br >
                    <form method="post" action="inicio.php?pagina=mailenvioliberar&menu=<?=$_GET['menu']?>" >
                        <input type="hidden" name="Fnoticias" id="Fnoticias" value="<?=$Tnoticias?>" />
                        <input type="hidden" name="Fdest" id="Fdest" value="<?=$TdestEnvio?>" />
                        <input type="image" name="btEnviar" id="btEnviar" src="../layout/imagens/intra_btn_enviarmail.png" align="absmiddle" />
                        <input type="image" name="btCancelar" id="btCancelar" src="../layout/imagens/intra_btn_cancelar.png" align="absmiddle" />
                    </form>
                </div>
            </div>
        <div>
        <div class="tag_result_busca">Conteúdo do Mailing</div>
        <div id="resultado" style="display:block">   
            <div class="container_2">
                <br />  
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <?php
                    //---------------------------------------------------
                    // Monta SQL para consultar as notícias selecionadas
                    //---------------------------------------------------
                    $sqlNoticias  = "SELECT * FROM noticias WHERE ";
                    for($i=0;$i<(count($TnotIds)-2);$i++){
                        $sqlNoticias .= "noti_id = ".$TnotIds[$i]." OR ";	
                    }
                    $sqlNoticias 	.=" noti_id = ".$TnotIds[$i]." ORDER BY noti_data DESC";
                    $TreturnNoticias = $drive->pedido($sqlNoticias);
                    
                    //-----------------------------
                    // Imprime resumo das notícias 
                    //-----------------------------
                    while($Tnot = pg_fetch_object($TreturnNoticias)){
                        echo "
                        <tr>
                            <td class=\"container_item_result\">
                                <span class=\"titulo_linkserv\">
                                    <a href=\"mailing/envio/mailing_notprev.php?noti=".$Tnot->noti_id."&KeepThis=true&TB_iframe=true&height=600&width=520\" class=\"thickbox\"> 
                                        <span class=\"titulo_linkserv\">".inverteDateBd($Tnot->noti_data)." - ".substr($Tnot->noti_titulo, 0, 60)."...</span><br>
                                        ".strip_tags(substr($Tnot->noti_manchete, 0, 165))."...								
                                    </a>
                                </span> 
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>  
    </div>
    </div>
	<?php

	//---------------------------------------------
	// Envia os emails para todos os destinatarios
	//---------------------------------------------	
	if(isset($_POST['btEnviar_x'])){
		include("includes/mailing_envio.php");	
	}
}else{
	echo("<script>window.location = \"inicio.php?pagina=mailenvionot\"</script>");	
}
?>