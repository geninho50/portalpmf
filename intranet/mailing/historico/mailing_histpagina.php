<?php
require_once("../scripts/php/funcoes.php");

//------------------------------------
// Recupera as informações do mailing
//------------------------------------
$TmailingId 	= $_GET['mid'];
$sqlMailing 	= "SELECT * FROM mailing_historico WHERE mailing_historico_id = $TmailingId";
$TreturnMailing = $drive->pedido($sqlMailing);
$Tmailing		= pg_fetch_object($TreturnMailing );
$TNoticiasId	= explode("#", $Tmailing->mailing_historico_noticias_ids);
$TDestId		= explode("#", $Tmailing->mailing_historico_destinatarios_ids);

//---------------------------------------------------
// Recupera o título das notícias enviadas no mailig
//---------------------------------------------------
$sqlNoticias   = "SELECT * FROM noticias WHERE ";
for($i=0;$i<(count($TNoticiasId)-1);$i++){
	$sqlNoticias .= "noti_id = ".$TNoticiasId[$i]." OR ";	
}
$sqlNoticias 	.=" noti_id = ".$TNoticiasId[$i]." ORDER BY noti_data DESC";
$TreturnNoticias = $drive->pedido($sqlNoticias);	

//----------------------------------------------------
// Recupera os emails para quem foi enviado o Mailing 
//----------------------------------------------------
$sqlMailing  = "SELECT * FROM mailing_contato WHERE ";
for($i=0;$i<(count($TDestId)-1);$i++){
	$sqlMailing .= "mailing_contato_id = ".$TDestId[$i]." OR ";	
}
$sqlMailing 	.=" mailing_contato_id = ".$TDestId[$i]." ORDER BY mailing_contato_id ASC";
$TreturnMailing = $drive->pedido($sqlMailing);

//-------------------------------------
// Ordena contatos em ordem alfabetica
//-------------------------------------
$i = 0;
while($Tdestinatario = pg_fetch_object($TreturnMailing)){
	$TarrayDest[$i] = "<strong>".$Tdestinatario->mailing_contato_nome."</strong> - ".$Tdestinatario->mailing_contato_email;	
	$i++;	
}
sort($TarrayDest);

//---------------------------------------
// Busca o nome de quem mandou o Mailing
//---------------------------------------
$sqlUser		= "SELECT * FROM uni_usuarios WHERE user_id = ".$Tmailing->mailing_historico_user_id;
$TreturnUser	= $drive->pedido($sqlUser);
$Tuser			= pg_fetch_object($TreturnUser);

?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">mailing</div>
	<div id="margem_direita"><br />
		<div class="conteudo_abas"> 
			<div id="conteudo_localizar" style="display:inline">
				<p><h3>Envio: <?=inverteDateBd($Tmailing->mailing_historico_data)?></h3></p>
				<span class="titulo_linkserv">Rementente: <?=utf8_encode($Tuser->user_nome)?></span><br><br>
                Abaixo encontram-se listados todas as notícias cujos resumos foram enviados no mailing, 
                bem como a lista completa de destinatários e seus respectivos e-mails, ordenada alfabeticamente.
			</div>
   		</div>
	<div>
	<div id="resultado">   
		<div class="container_2">
			<br /><br />
            <h2>Lista de Notícias Enviadas</h2>
            <br />
			<table width="600" border="0" cellspacing="0" cellpadding="0">
				<?php
               	while($Tnoticias = pg_fetch_object($TreturnNoticias)){
					echo"
					<tr>
						<td class=\"container_item_result\">  
							<a href=\"mailing/envio/mailing_notprev.php?noti=".$Tnoticias->noti_id."&KeepThis=true&TB_iframe=true&height=600&width=520\" class=\"thickbox\">
								<strong>".inverteDateBd($Tnoticias->noti_data)." - ".subString($Tnoticias->noti_titulo, 70)."</strong>
							</a> 
						</td>
					</tr>";	
				}
				?>
			</table>     
			<br /><br /><br />
            <h2>Mailings enviados</h2>
            <br />
			<table width="600" border="0" cellspacing="0" cellpadding="0">
				<?php
                for($i=0;$i<count($TarrayDest);$i++){
					echo"
					<tr>
						<td class=\"container_item_result\">  
							".$TarrayDest[$i]."
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

