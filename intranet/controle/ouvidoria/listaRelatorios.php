
<?php
	require_once("valida_session.php");
	require_once("../scripts/php/funcoes_bd.php"); 
	require_once("../scripts/php/config.php");	

	$sql = "SELECT * FROM relatorios_ouvidoria ORDER BY ano DESC, mes ASC, titulo ASC";
	$result		= $drive->pedido($sql);
	$resultado 	= pg_fetch_all($result);
	
?>

<style type="text/css">
.hidden {
  display: none !important;
  visibility: hidden !important;
}

.alert{
	text-align: center;
	font-weight: bold;
	padding: 5px !important;
}

.warning{
	color: red;
}

.success{
	color: green;
}

.table{
	width: 90%;
	margin: auto;
	padding: 10px;
	background-color: #EFEEE0;
	border: 1px solid #CCCBBD;

}

.table th{
	font-weight: bold;
	text-align: center;
	padding: 10px 3px;
	border: 1px solid #CCCBBD;
	background-color: #f8f8f8;
}
.table td{
	padding: 10px 3px;
	border: 1px solid #CCCBBD;
	background-color: #FFF;
	text-align: center;
}

a:visited, a:focus{
	color: black;
}

</style>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">Listagem relatorios</div>
	<div id="margem_direita"><br>
	<?php if($resultado){?>
			<table class="table">
				<tr>
					<th>Arquivo</th>
					<th>Ano</th>
					<th>Mês</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			<?php
				foreach ($resultado as $relatorio) {
			?>
				<tr>
					<td>
						<a href="http://www.pmf.sc.gov.br/ouvidoria/pdf/<?=$relatorio['arquivo']?>" target="_blank"><?=$relatorio['titulo']?>
					</td>
					<td><?=$relatorio['ano']?></td>
					<td><?=$relatorio['mes']?></td>
					<td> 
						<a href="http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&edit=<?=$relatorio['id']?>" class='toggleopacity'>
						<img src='../layout/imagens/atualiza_btn_editar.png' alt='editar' width='50' height='18' border='0' align='absmiddle' />
						</a>
					</td>
					<td> 
						<a href="controle/ouvidoria/deletarRel.php?del=<?=$relatorio['id']?>" class='toggleopacity'>
						<img src='../layout/imagens/atualiza_btn_excluir.png' alt='excluir' width='50' height='18' border='0' align='absmiddle' />
						</a>
					</td>
				</tr>
			<?php } ?>
			
			</table>
	<?php }else{ echo "<h2>Nenhum arquivo para listar</h2>"; } ?>
	</div>
</div>
