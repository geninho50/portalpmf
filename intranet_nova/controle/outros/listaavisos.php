<?php

if(isset($_GET['ac']) && $_GET['ac'] == 'ex'){
	require_once("../scripts/php/funcoes.php");
	require_once("../scripts/php/funcoes_bd.php");
	$sql  = "DELETE FROM telao WHERE telao_id = ".$_GET['exc'];
	$resultado = $drive->pedido($sql);
	if($resultado){
		$Tmsg = "
		<form method=\"post\" action=\"?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."\">
			<br />
			<br />
			Notícia excluída com Sucesso!	
			<br />
			<br />

			<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
		</form>";			
		MsgSql($Tmsg, 100, 400);
	}else{	
		$Tmsg = "
		<form method=\"post\" action=\"?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."\">
			<br />
			<br />
			Não foi possível excluir a Notícia!
			<br />
			<br />
			<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
		</form>";			
		MsgSql($Tmsg, 100, 400);	
	}
}

$hoje = date("Y-m-d");

$sql 		= "SELECT * FROM telao where inicio <= '$hoje' and fim >= '$hoje' ";
$result		= $drive->pedido($sql);
$avisosAtuais = pg_fetch_all($result);

$sql 		= "SELECT * FROM telao where inicio > '$hoje' ";
$result		= $drive->pedido($sql);
$avisosFuturos = pg_fetch_all($result);

$sql 		       = "SELECT * FROM telao where fim < '$hoje' ";
$result			   = $drive->pedido($sql);
$avisosFinalizados = pg_fetch_all($result);

function formataData($data){
	$dataArr = explode("-", $data);
	$dataFinal = $dataArr[2] . "/" . $dataArr[1] . "/" . $dataArr[0];
	return $dataFinal;
}

?>

<div class="centro">
	<div id="margem_direita">
		<div class="conteudo_abas">

			<h1>Avisos Atuais</h1>
			<?if($avisosAtuais != null){?>
				<? for($i = 0; $i < count($avisosAtuais); $i++ ){ 
					$avisosAtuais[$i]["inicio"] = formataData($avisosAtuais[$i]["inicio"]);
					$avisosAtuais[$i]["fim"] = formataData($avisosAtuais[$i]["fim"]);

				?>
				<div class="container_item_result">
					<span class="titulo_linkserv">
						De <?=$avisosAtuais[$i]["inicio"]." a ".$avisosAtuais[$i]["fim"]. " - ".$avisosAtuais[$i]["manchete"];?>
					</span>
					<br>
					<?="<a href=\"?pagina=quadroavisos&menu=12&ac=edit&edit=".$avisosAtuais[$i]["telao_id"]."\" class=\"toggleopacity\">" ?>
					<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
					</a>
					<?="<a href=\"javascript:del(".$avisosAtuais[$i]["telao_id"].");\" class=\"toggleopacity\">" ?>
					<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle\" />
					</a>
				</div>

			<?php }}else{ ?>
				<div class="container_item_result">
					<p>Nenhum aviso Atual</p>
				</div>
			<? } ?>

			<h1>Avisos Futuros</h1>
				<?if($avisosFuturos != null){?>
					<? for($i = 0; $i < count($avisosFuturos); $i++ ){ 
						$avisosFuturos[$i]["inicio"] = formataData($avisosFuturos[$i]["inicio"]);
						$avisosFuturos[$i]["fim"] = formataData($avisosFuturos[$i]["fim"]);

					?>
					<div class="container_item_result">
						<span class="titulo_linkserv">
							De <?=$avisosFuturos[$i]["inicio"]." a ".$avisosFuturos[$i]["fim"]. " - ".$avisosFuturos[$i]["manchete"];?>
						</span>
						<br>
						<?="<a href=\"?pagina=quadroavisos&menu=12&ac=edit&edit=".$avisosFuturos[$i]["telao_id"]."\" class=\"toggleopacity\">" ?>
						<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
						</a>
						<?="<a href=\"javascript:del(".$avisosFuturos[$i]["telao_id"].");\" class=\"toggleopacity\">" ?>
						<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle\" />
						</a>
					</div>
				<?php }}else{ ?>
					<div class="container_item_result">
					<p>Nenhum aviso Futuro</p>
					</div>
				<? } ?>

			<h1>Avisos Finalizados</h1>
				<?if($avisosFinalizados != null){?>
					<? for($i = 0; $i < count($avisosFinalizados); $i++ ){ 
						$avisosFinalizados[$i]["inicio"] = formataData($avisosFinalizados[$i]["inicio"]);
						$avisosFinalizados[$i]["fim"] = formataData($avisosFinalizados[$i]["fim"]);
					?>
					<div class="container_item_result">
						<span class="titulo_linkserv">
							De <?=$avisosFinalizados[$i]["inicio"]." a ".$avisosFinalizados[$i]["fim"]. " - ".$avisosFinalizados[$i]["manchete"];?>
						</span>
						<br>
						<?="<a href=\"?pagina=quadroavisos&menu=12&ac=edit&edit=".$avisosFinalizados[$i]["telao_id"]."\" class=\"toggleopacity\">" ?>
						<img src="../layout/imagens/atualiza_btn_editar.png" alt="editar" width="50" height="18" border="0" align="absmiddle" />
						</a>
						<?="<a href=\"javascript:del(".$avisosFinalizados[$i]["telao_id"].");\" class=\"toggleopacity\">" ?>
						<img src="../layout/imagens/atualiza_btn_excluir.png" alt="excluir" width="54" height="19" border="0" align="absmiddle\" />
						</a>
					</div>
				<?php }}else{ ?>
					<div class="container_item_result">
					<p>Nenhum aviso Finalizado</p>
					</div>
				<? } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
function del(valor){
	if(confirm("Tem certeza que deseja EXCLUIR?")){
		location.href = '?pagina=<?=$_GET['pagina']?>&ac=ex&exc='+valor+'&menu=<?=$_GET['menu']?>';
	}
}
</script>
