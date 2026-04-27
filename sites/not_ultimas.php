<script>
function verificaForm (form){
	if(form.entidade.value==0){
		alert("Selecione a Entidade");
		return false;
	}else
	return true;
}
</script>

<?php
session_start();
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");

?>

<div id="pagina">
	<div id="caminho_migalhas">home &gt;</div>
	<div id="titulo_pagina">&uacute;ltimas not&iacute;cias</div><div>

   <br>
    <ul class="listagem">

 		<?php

		if(!isset($_GET['pg'])){
			$pg = 1;
		}else{
			$pg = $_GET['pg'];
		}

		$inicio = ($pg * 10) - 10;
		$dataAtual = date("Y/m/d");
		$Tcaminho = "?pagina=noticias";
		$noti_id = $IdEntidade;

		//-------------------------------------------------
		//Busca todas as noticias importadas pela entidade
		//-------------------------------------------------
		$sqlImport 	 = "SELECT * FROM import_noticias WHERE id_import_noticia_id_entidade = $noti_id";
		$return 	 = $drive->pedido($sqlImport);
		$complemento = "";
		while($comp = pg_fetch_object($return)){
			$complemento .=" OR noti_id = ".$comp->id_import_noticia_noti_id;
		}
		$numSql = "SELECT COUNT(*) FROM noticias INNER JOIN entidades ON noticias.noti_entidade_id = entidades.entidade_id WHERE noticias.noti_status = 't' AND noticias.noti_data <= '$dataAtual' AND noticias.noti_entidade_id = $noti_id $complemento";

		$notSql = "SELECT
				entidades.entidade_sigla,
				noticias.noti_id,
				noticias.noti_titulo,
				noticias.noti_manchete,
				noticias.noti_hora,
				noticias.noti_data
			FROM
				noticias
			INNER JOIN
				entidades
			ON
				noticias.noti_entidade_id = entidades.entidade_id
			WHERE
				noticias.noti_status = 't'
			AND
				noticias.noti_entidade_id = $noti_id
			AND
				noticias.noti_data <= '$dataAtual'
			$complemento
			ORDER BY
				noticias.noti_data
			DESC,
				noticias.noti_hora
			DESC LIMIT 10 OFFSET $inicio";


			$TreturnSqlNot = $drive->pedido($notSql);
			$TreturnSqlNum = $drive->pedido($numSql);



		$j = 0;
		while ($Tnoticias = pg_fetch_object($TreturnSqlNot)){ // povoa uma matriz com os dados a serem impressos
			$matrizNoticia[$j]['entidade_sigla'] = $Tnoticias->entidade_sigla;
			$matrizNoticia[$j]['noti_id'] = $Tnoticias->noti_id;
			$matrizNoticia[$j]['noti_titulo'] = $Tnoticias->noti_titulo;
			$matrizNoticia[$j]['noti_manchete'] = $Tnoticias->noti_manchete;
			$matrizNoticia[$j]['noti_hora'] = $Tnoticias->noti_hora;
			$matrizNoticia[$j]['noti_data'] = $Tnoticias->noti_data;
			$j++;
		}

 		if($j == 0){
			echo"Nenhuma notícia entcontrada.";
		}

		for($i=0; $i < pg_num_rows($TreturnSqlNot); $i++) // inicia impressão da pagina
		{

		$Tdata = $matrizNoticia[$i]['noti_data'];
		$Tdate = explode("-", $Tdata, 3);
		$TdataFinal = $Tdate[2]."/".$Tdate[1]."/".$Tdate[0];

		$id_not = $matrizNoticia[$i]['noti_id'];
		$sql_img = "SELECT
						imagens.img_link_v_alta
					FROM
						noticias_imagens
					INNER JOIN
						imagens
					ON
						noticias_imagens.nimg_img_id = imagens.img_id
					WHERE
						noticias_imagens.nimg_noti_id = $id_not
					AND
						noticias_imagens.nimg_principal = 't'

					";

		$result = $drive->pedido($sql_img);
		$image = pg_fetch_object($result);

		$mancheteOrig = strip_tags($matrizNoticia[$i]['noti_manchete']);
		$manchete = substr($mancheteOrig, 0, 170);
		if (strlen($mancheteOrig) > 170) {
			$manchete = $manchete."...";
		}


		if ($image->img_link_v_alta != ""){
		?>
        <li>
		<table>
        	<tr>
				<td width="125">
                	<a href="index.php?pagina=notpagina&noti=<?=$matrizNoticia[$i]['noti_id']?>">
						<img src="../<?=$image->img_link_v_alta?>" border="0" class="foto" />
                    </a>
               	</td>
				<td>
					<h3><a href="index.php?pagina=notpagina&noti=<?=$matrizNoticia[$i]['noti_id']?>">
                        <?=strip_tags($matrizNoticia[$i]['noti_titulo'])?></a></h3>
                        <?php echo($manchete);?>
                        <h5><?php echo ($TdataFinal." ".$matrizNoticia[$i]['noti_hora']." - ".$matrizNoticia[$i]['entidade_sigla']);?></h5>

				</td>
        	</tr>
     	</table>
        </li>
		<?PHP
		}else{
		?>
        <li>
		<table>
        	<tr>
				<td>
					<h3><a href="index.php?pagina=notpagina&noti=<?=$matrizNoticia[$i]['noti_id']?>">
                        <?=$matrizNoticia[$i]['noti_titulo']?></a></h3>
                        <?php echo($manchete);?>
                        <h5><?php echo ($TdataFinal." ".$matrizNoticia[$i]['noti_hora']." - ".$matrizNoticia[$i]['entidade_sigla']);?></h5>

				</td>
        	</tr>
     	</table>
        </li>

		<?php
			}//fim if verifica existe foto
		}
		echo("</ul><br />");

// ========================= imprime numumero de paginas rodapé  =========================

			$numPagTotal = pg_fetch_object($TreturnSqlNum);
			echo "<p align=\"center\">";
			$TnumPag = $numPagTotal->count;
			if($TnumPag < 10){
				$TnumPag = 10;
			}
			mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
			echo "<p>";

// ========================= fim imprime num de páginas  =========================

		?>
	</div>
</div><!-- fim coluna_C2 -->
