<?php

// ini_set("display_errors", "on");
// error_reporting(E_ALL);

function geraxml($valor,$drive)
{


	if($valor == 0)
	{
		$diretorio = fopen("../banners.xml","w");

		$sqlxml = "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = $valor ORDER BY cms_banner_ordem ASC";

		$resultadoxml = $drive->pedido($sqlxml);
		$quantidadexml = pg_num_rows($resultadoxml);


		$xml  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
		$xml .= "<rotator isRandom=\"false\">\n";
		$xml .= "<bannerTime>7</bannerTime>\n";
		$xml .= "<numberOfBanners>$quantidadexml</numberOfBanners>\n";
		$xml .= "<banners showHeader=\"true\">\n";


		while($objxml = pg_fetch_object($resultadoxml))
		{
			$xml .= "<banner>\n";
			$xml .= "<title>$objxml->cms_banner_titulo</title>\n";
			$xml .= "<subtitle>$objxml->cms_banner_subtitulo</subtitle>\n";
			$xml .= "<imagePath>arquivos/banners/$objxml->cms_banner_path</imagePath>\n";
			$xml .= "<link>$objxml->cms_banner_link</link>\n";
			$xml .= "</banner>\n\n";
		}

		$xml .= "</banners>\n";
		$xml .= "</rotator>\n";

		$sqlpasta = "SELECT entidade_path FROM entidades WHERE entidade_id = $valor";
		$resultadoPasta = $drive->pedido($sqlpasta);
		$objPasta = pg_fetch_object($resultadoPasta);
		fwrite($diretorio,$xml);
		fclose($diretorio);
	}

	else
	{
			$sqlxml = "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = $valor ORDER BY cms_banner_ordem ASC";

			$resultadoxml = $drive->pedido($sqlxml);
			$quantidadexml = pg_num_rows($resultadoxml);

			$xml  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
			$xml .= "<rotator isRandom=\"false\">\n";
			$xml .= "<bannerTime>7</bannerTime>\n";
			$xml .= "<numberOfBanners>$quantidadexml</numberOfBanners>\n";
			$xml .= "<banners showHeader=\"true\">\n";


			while($objxml = pg_fetch_object($resultadoxml))
			{
				$xml .= "<banner>\n";
				$xml .= "<title>$objxml->cms_banner_titulo</title>\n";
				$xml .= "<subtitle>$objxml->cms_banner_subtitulo</subtitle>\n";
				$xml .= "<imagePath>../../arquivos/banners/$objxml->cms_banner_path</imagePath>\n";
				$xml .= "<link>$objxml->cms_banner_link</link>\n";
				$xml .= "</banner>\n\n";
			}

			$xml .= "</banners>\n";
			$xml .= "</rotator>\n";

			$sqlpasta = "SELECT entidade_path,entidade_tipo FROM entidades WHERE entidade_id = $valor";
			$resultadoPasta = $drive->pedido($sqlpasta);

			$objPasta = pg_fetch_object($resultadoPasta);

			switch($objPasta->entidade_tipo)
			{
				case 7  : $pastaEntidade = "sites";
				break;
				default : $pastaEntidade = "entidades";
			}

			$diretorio = fopen("../".$pastaEntidade."/".$objPasta->entidade_path."/banners.xml","w");
			fwrite($diretorio,$xml);
			fclose($diretorio);
	}

}


function reduz_imagem($img, $max_x, $max_y, $nome_foto, $type = 'jpg') {
	if($type == 'jpeg') $type = 'jpg';
	switch($type){
		case 'bmp': $image = imagecreatefromwbmp($img); break;
		case 'gif': $image = imagecreatefromgif($img); break;
		case 'jpg': $image = imagecreatefromjpeg($img); break;
		case 'png': $image = imagecreatefrompng($img); break;
		default : return "Unsupported picture type!";
	}

	//pega o tamanho da imagem ($original_x, $original_y)
	list($width, $height) = getimagesize($img);

	$image_p = imagecreatetruecolor($max_x, $max_y);
	if ( $type == "gif" || $type == "png" ) {
		imagecolortransparent($image_p, imagecolorallocatealpha($image_p,0,0,0,127));
		imagealphablending($image_p, false);
		imagesavealpha($image_p,true);
	}

	//gera tamanho reduzido
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $max_x, $max_y, $width, $height);

	switch($type){
		case 'bmp': $image_final = imagewbmp($image_p, $nome_foto); break;
		case 'gif': $image_final = imagegif($image_p, $nome_foto); break;
		case 'jpg': $image_final = imagejpeg($image_p, $nome_foto); break;
		case 'png': $image_final = imagepng($image_p, $nome_foto); break;
	}

	return $image_final;

}


function reduz_imagem2($img, $nome_foto) {


			//pega o tamanho da imagem ($original_x, $original_y)
			list($largura, $altura) = getimagesize($img);

			$imagem_alta 		= imagecreatetruecolor();
			$imagem_media 		= imagecreatetruecolor();
			$imagem_preview 	= imagecreatetruecolor();
			$imagem_pequena 	= imagecreatetruecolor();

			$image_p = imagecreatetruecolor($max_x, $max_y);
			$image   = imagecreatefromjpeg($img);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $max_x, $max_y, $width, $height);


			return imagejpeg($image_p, $nome_foto, 100);

		}

function videoPlayer($video, $width, $height,$player){


	/*
	$video="<object type=\"application/x-shockwave-flash\" data=\"$player/player.swf\" width=\"$width\" height=\"$height\">
			<param name=\"movie\" value=\"$player/player.swf\" />
			<param name=\"allowfullscreen\" value=\"true\" />
			<param name=\"allowscriptaccess\" value=\"always\" />
			<param name=\"flashvars\" value=\"file=$video&image=$player/brasao.jpg\" />
			</object>";
    */
	$video="<video width=\"$width\" height=\"$height\" controls>
	<source src=\"$video\" type=\"video/FLV\"></video>";

	return $video;

}
function audioPlayer($audio, $width, $height, $player){

$audio = "
<object type=\"application/x-shockwave-flash\" data=\"$player/player.swf\" id=\"audioplayer1\" height=\"$height\" width=\"$width\">
<param name=\"movie\" value=\"$player/player.swf\">
<param name=\"FlashVars\" value=\"playerID=1&amp;soundFile=$audio\">
<param name=\"quality\" value=\"high\">
<param name=\"menu\" value=\"false\">
<param name=\"wmode\" value=\"transparent\">
</object> ";

return $audio;

}

function inverteData($data){

$dataFinal=  explode("/",$data,3);
$data = $dataFinal[2]."/".$dataFinal[1]."/".$dataFinal[0];
return $data;
}

function transformaData($data){

$dataFinal=  explode("-",$data,3);
$data = $dataFinal[2]."/".$dataFinal[1]."/".$dataFinal[0];
return $data;
}

function transformDataNewsFormat($data){
  $months = array(1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 5 => "MAIO", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
  $dataFinal=  explode("-",$data,3);
  return $dataFinal[2] . "<span>". $months[(int)$dataFinal[1]] ."</span>" ."<span>". $dataFinal[0] ."</span>";
}

function txt_vetor($texto){

	//* Fun��o desenvolvida por Max Ricardo Benin
	//* Retorna um vetor contendo as em cada posi��o uma
	//* palavra do texto passado como parametro

	//* retira caracteres comuns e
	//* substitui os espa�os dos caracteres especiais por espa�o
	$caracteres = array(",",".",":","!","?",";");
	$txtresultado = str_ireplace($caracteres, " ", $texto);

	//* retira os espa�os e armazena cada express�o em um vetor

	$txtresultado = preg_split("/[\s,]+/", $txtresultado, -1, PREG_SPLIT_NO_EMPTY);
	$txtunique = array_unique($txtresultado);

	return $txtunique;
}

function consultaColab($txt){
	$caracteres 	= array(",",".",":","!","?",";");
	$txtresultado 	= str_ireplace($caracteres, " ", $txt);
	$txtresultado 	= preg_split("/[\s,]+/", $txtresultado, -1, PREG_SPLIT_NO_EMPTY);
	$txtunique 		= array_unique($txtresultado);
	$txttags		= "";
	for($i=0; $i<(count($txtunique)-1); $i++){

	}
	return $txtunique;
}


	//* Função desenvolvida por Rodrigo Rigoni
	//* Retorna uma substring com o tamanho
	//* passado por paramento.
	//* REQUISITOS:
	//*		$texto: vari�vel contendo o texto a ser ajustado
	//* 	$tamanho: tamanho da substring.
	//*
	function tamanho_string($texto, $tamanho)
	{
		$limite = strlen($texto);
		if ($limite > $tamanho)
		{
			$novo_texto = substr($texto, 0, $tamanho);
			echo"$novo_texto...";
		}
		else
		{
			echo"$texto";
		}
	}

	//* Fun��o desenvolvida por Rodrigo Rigoni
	//* Retorna Combo com todas as entidades
	//* REQUISITOS:
	//*		$objeto: Classe do BD ($drive)
	//*		$nome: nome do Select
	//* 	$retorno: caso tenho que manter um option selecionado

	function combo_entidades($objeto, $nome, $retorno, $id){

	$id_entidade = $_SESSION['entidade_id'];
	
	// ======================== Select Entidades PREFEITURA ========================
	$sql2 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 0 AND entidade_excluida = FALSE ORDER BY entidade_linha_1";
	$V_entidades_prefeitura = $objeto->pedido($sql2);
	// ======================== Select Entidades SECRATARIAS MUNICIPAIS ========================
	$sql2 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 4 AND entidade_excluida = FALSE ORDER BY entidade_linha_1";
	$V_entidades_municipais = $objeto->pedido($sql2);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql3 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 5 AND entidade_excluida = FALSE ORDER BY entidade_linha_1";
	$V_entidades_executivas = $objeto->pedido($sql3);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql4 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 6 AND entidade_excluida = FALSE  ORDER BY entidade_linha_1";
	$V_orgaos = $objeto->pedido($sql4);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql5 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 7 AND entidade_excluida = FALSE  ORDER BY entidade_linha_1";
	$V_eventos = $objeto->pedido($sql5);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql9 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 9 AND entidade_excluida = FALSE  ORDER BY entidade_linha_1";
	$V_entidades_conselho = $objeto->pedido($sql9);
	// ======================== Select Entidades SUPERINT�NDENCIA ========================
	$sql8 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 8 AND entidade_excluida = FALSE  ORDER BY entidade_linha_1";
	$V_entidade_superintendencia = $objeto->pedido($sql8);
	

	?>
        <select name="<?=$nome?>" class="combosecretarias" id="<?=$id?>" />
        <option value="">=== Prefeitura === </option>
        <option value=""> </option>
        <?PHP
        while($V_principais = pg_fetch_object($V_entidades_prefeitura)){
        ?>
        <option <?php if($retorno == $V_principais->entidade_id){echo"selected=\"selected\"";} ?> value="<?=$V_principais->entidade_id?>" title="<?=$V_principais->entidade_nome?>"> &nbsp;&nbsp;<?=$V_principais->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Secretarias Municipais ===</option>
        <option value=""> </option>
        <?PHP
        while($V_municipais = pg_fetch_object($V_entidades_municipais)){
        ?>
        <option <?php if($retorno == $V_municipais->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_municipais->entidade_id?>" title="<?=$V_municipais->entidade_nome?>">&nbsp;&nbsp;<?=$V_municipais->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Secretarias Executivas === </option>
        <option value=""> </option>
        <?PHP
        while($V_executivas = pg_fetch_object($V_entidades_executivas)){
        ?>
        <option <?php if($retorno == $V_executivas->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_executivas->entidade_id?>" title="<?=$V_executivas->entidade_nome?>">&nbsp;&nbsp;<?=$V_executivas->entidade_linha_1?> </option>
        <?PHP
        }		
        ?>

		<option value=""> </option>
        <option value="">=== Superintendencia === </option>
        <option value=""> </option>
        <?PHP
        while($V_superintendencia = pg_fetch_object($V_entidade_superintendencia)){
        ?>
        <option <?php if($retorno == $V_superintendencia->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_superintendencia->entidade_id?>" title="<?=$V_superintendencia->entidade_nome?>">&nbsp;&nbsp;<?=$V_superintendencia->entidade_linha_1?> </option>
        <?PHP
        }		
        ?>

		<option value=""> </option>
        <option value="">=== Conselho === </option>
        <option value=""> </option>
        <?PHP
        while($V_conselho = pg_fetch_object($V_entidades_conselho)){
        ?>
        <option <?php if($retorno == $V_conselho->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_conselho->entidade_id?>" title="<?=$V_conselho->entidade_nome?>">&nbsp;&nbsp;<?=$V_conselho->entidade_linha_1?> </option>
        <?PHP
        }		
        ?>

        <option value=""> </option>
        <option value="">=== Org&atilde;os ===</option>
        <option value=""> </option>
        <?PHP
        while($V_org = pg_fetch_object($V_orgaos)){
        ?>
        <option <?php if($retorno == $V_org->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_org->entidade_id?>" title="<?=$V_org->entidade_nome?>">&nbsp;&nbsp;<?=$V_org->entidade_linha_1?> </option>
        <?PHP
        }
		?>
		<option value=""> </option>
        <option value="">=== Eventos ===</option>
        <option value=""> </option>
        <?PHP
        while($V_even = pg_fetch_object($V_eventos)){
        ?>
        <option <?php if($retorno == $V_even->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_even->entidade_id?>" title="<?=$V_even->entidade_nome?>">&nbsp;&nbsp;<?=$V_even->entidade_linha_1?> </option>
        <?PHP
        }
		?>
		<option value=""> </option>
        </select>
		<?php
	}

	//* Fun��o desenvolvida por Rodrigo Rigoni
	//* Retorna Combo com todas as entidades + P�gina Principal
	//* REQUISITOS:
	//*		$objeto: Classe do BD ($drive)
	//*		$nome: nome do Select
	//* 	$retorno: caso tenho que manter um option selecionado

	function combo_entidades_portal($objeto, $nome, $retorno, $id){

	// ======================== Select Entidades PORTAL ========================
	$sql = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_id = 0";
	$V_entidades_portal = $objeto->pedido($sql);
	// ======================== Select Entidades PREFEITURA ========================
	$sql2 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 ORDER BY entidade_linha_1";
	$V_entidades_prefeitura = $objeto->pedido($sql2);
	// ======================== Select Entidades SECRATARIAS MUNICIPAIS ========================
	$sql2 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 4 ORDER BY entidade_linha_1";
	$V_entidades_municipais = $objeto->pedido($sql2);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	//$sql3 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 5 ORDER BY entidade_linha_1";
	//$V_entidades_executivas = $objeto->pedido($sql3);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql4 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 6 ORDER BY entidade_linha_1";
	$V_orgaos = $objeto->pedido($sql4);
	// ======================== Select Entidades SECRETARIAS EXECUTIVAS ========================
	$sql5 = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 7 ORDER BY entidade_linha_1";
	$V_eventos = $objeto->pedido($sql5);

	?>

        <select name="<?=$nome?>" class="componente_grande" id="<?=$id?>" />
        <option value="">=== Portal === </option>
        <option value=""> </option>
        <?PHP
        while($V_portal = pg_fetch_object($V_entidades_portal)){
        ?>
        <option <?php if($retorno == $V_portal->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_portal->entidade_id?>" title="<?=$V_portal->entidade_nome?>"> &nbsp;&nbsp;<?=$V_portal->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Prefeitura === </option>
        <option value=""> </option>
        <?PHP
        while($V_principais = pg_fetch_object($V_entidades_prefeitura)){
        ?>
        <option <?php if($retorno == $V_principais->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_principais->entidade_id?>" title="<?=$V_principais->entidade_nome?>"> &nbsp;&nbsp;<?=$V_principais->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Secretarias Executivas === </option>
        <option value=""> </option>
        <?PHP
        while($V_executivas = pg_fetch_object($V_entidades_executivas)){
        ?>
        <option <?php if($retorno == $V_executivas->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_executivas->entidade_id?>" title="<?=$V_executivas->entidade_nome?>">&nbsp;&nbsp;<?=$V_executivas->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Secretarias Municipais ===</option>
        <option value=""> </option>
        <?PHP
        while($V_municipais = pg_fetch_object($V_entidades_municipais)){
        ?>
        <option <?php if($retorno == $V_municipais->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_municipais->entidade_id?>" title="<?=$V_municipais->entidade_nome?>">&nbsp;&nbsp;<?=$V_municipais->entidade_linha_1?> </option>
        <?PHP
        }
        ?>
        <option value=""> </option>
        <option value="">=== Org&atilde;os ===</option>
        <option value=""> </option>
        <?PHP
        while($V_org = pg_fetch_object($V_orgaos)){
        ?>
        <option <?php if($retorno == $V_org->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_org->entidade_id?>" title="<?=$V_org->entidade_nome?>">&nbsp;&nbsp;<?=$V_org->entidade_linha_1?> </option>
        <?PHP
        }
		?>
		<option value=""> </option>
        <option value="">=== Eventos ===</option>
        <option value=""> </option>
        <?PHP
        while($V_even = pg_fetch_object($V_eventos)){
        ?>
        <option <?php if($retorno == $V_even->entidade_id){echo"selected=\"selected\"";}?> value="<?=$V_even->entidade_id?>" title="<?=$V_even->entidade_nome?>">&nbsp;&nbsp;<?=$V_even->entidade_linha_1?> </option>
        <?PHP
        }
		?>
		<option value=""> </option>
        </select>
		<?php
	}

function retornaMes($mes){

	switch ($mes){
		case '01': $retorno = "Janeiro"; break;
		case '02': $retorno = "Fevereiro"; break;
		case '03': $retorno = "Mar&ccedil;o"; break;
		case '04': $retorno = "Abril"; break;
		case '05': $retorno = "maio"; break;
		case '06': $retorno = "Junho"; break;
		case '07': $retorno = "Julho"; break;
		case '08': $retorno = "Agosto"; break;
		case '09': $retorno = "Setembro"; break;
		case '10': $retorno = "Outubro"; break;
		case '11': $retorno = "Novembro"; break;
		case '12': $retorno = "Dezembro"; break;
	}
	return $retorno;
}

function diasemana($data) {
	$ano =  substr("$data", 0, 4);
	$mes =  substr("$data", 5, -3);
	$dia =  substr("$data", 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "DOM";   break;
		case"1": $diasemana = "SEG";   break;
		case"2": $diasemana = "TER";   break;
		case"3": $diasemana = "QUA";   break;
		case"4": $diasemana = "QUI";   break;
		case"5": $diasemana = "SEX";   break;
		case"6": $diasemana = "SAB";   break;
	}

	echo "$diasemana";
}

// ---------- Inverte Data no Padrao 00/00/00  -----------
// -- REQUISITOS
// --
// -- $data	: data a ser invertida (00/00/00)
// -------------------------------------------------------

function inverteDate($data){

	$dataFinal=  explode("/",$data);
	$data = $dataFinal[2]."/".$dataFinal[1]."/".$dataFinal[0];
	return $data;
}

// ---------- Inverte Data no Padrao 00-00-00  -----------
// -- REQUISITOS
// --
// -- $data	: data a ser invertida (00-00-00)
// -------------------------------------------------------

function inverteDateBd($data){

	$dataFinal=  explode("-",$data);
	$data = $dataFinal[2]."/".$dataFinal[1]."/".$dataFinal[0];
	return $data;
}

// ---------- Corta string e outra maus curta  -----------
// -- REQUISITOS
// --
// -- $texto 	: texto a ser cortado.
// -- $tamanho 	: Tamanho em Caracteres que ter� a nova
// --			  string.
// -------------------------------------------------------

function subString($texto, $tamanho){

	$tamanhoString = strlen($texto);
	if($tamanhoString > $tamanho){
		$novaString = substr($texto, 0, $tamanho)."...";
	}else{
		$novaString = $texto;
	}
	return $novaString;
}

// ---------- Monta a arvore para o mailing  -----------
// -- REQUISITOS
// --
// -- $Traiz 	: raiz da arvore.
// -- $drive 	: varaivel de conex�o com o bd
// --
// -------------------------------------------------------

function mostraArvore($Traiz, $drive){
	$sqlNivel	  = "SELECT * FROM mailing_categoria WHERE mailing_categoria_hierarquia = $Traiz ORDER BY mailing_categoria_nome ASC";
	$TreturnNivel = $drive->pedido($sqlNivel);
	while($Tcategoria = pg_fetch_object($TreturnNivel)){
		echo "<ul><li><input type=\"checkbox\"> <img src=\"../layout/imagens/intra_icon_categorias2.png\" border=\"0\" align=\"absmiddle\" /> <strong>".$Tcategoria->mailing_categoria_nome."</strong>";
		if($Tcategoria->mailing_categoria_tipo == 0){
			$TcategId	= $Tcategoria->mailing_categoria_id;
			$sqlContato = "SELECT * FROM mailing_contato WHERE mailing_contato_categoria = $TcategId AND mailing_contato_excluido = 'f' ORDER BY mailing_contato_nome ASC";
			$TreturnCnt = $drive->pedido($sqlContato);
			echo "<ul>";
			while($Tcontato = pg_fetch_object($TreturnCnt)){
				echo "<li><input type=\"checkbox\" name=\"C".$Tcontato->mailing_contato_id."\" id=\"C".$Tcontato->mailing_contato_id."\"> <img src=\"../layout/imagens/intra_icon_contato3.png\" border=\"0\" align=\"absmiddle\" /> ".$Tcontato->mailing_contato_nome;
			}
			echo"</ul>";
		}
		mostraArvore($Tcategoria->mailing_categoria_id, $drive);
	}
	echo"</ul>";
}

//================================================================================================
//================================================================================================
//* Fun��o desenvolvida por Rodrigo Rigoni
//* Retorna Combo com todas as entidades
//* REQUISITOS:
//*		$drive: Classe do BD
//================================================================================================

function lista_entidades($drive){

	//=============================
	// consultas sql das entidades
	//=============================
	$sqlPmf  = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 ORDER BY entidade_linha_1";
	$sqlMun  = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 4 ORDER BY entidade_linha_1";
	$sqlExec = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 5 ORDER BY entidade_linha_1";
	$sqlOrg  = "SELECT entidade_linha_1, entidade_link_pdf, entidade_id, entidade_nome FROM entidades WHERE entidade_tipo = 6 ORDER BY entidade_linha_1";

	//============================================
	// retorna todas as entidades e �rg�os da PMF
	//============================================
	$TentPmf  = $drive->pedido($sqlPmf);
	$TentMun  = $drive->pedido($sqlMun);
	$TentExec = $drive->pedido($sqlExec);
	$Torg 	  = $drive->pedido($sqlOrg);

	//============================
	// monta lista das entidades
	//============================

	$TlistEnt = "<ul>
					<li>PREFEITURA</li>";
					while($V_principais = pg_fetch_object($V_entidades_prefeitura)){
						$TlistEnt .= "<li>".$V_principais->entidade_linha_1."</li>";
					}
					$TlistEnt .= "<li>SECRETARIAS EXECUTICAS</li>";
					while($V_executivas = pg_fetch_object($V_entidades_executivas)){
						$TlistEnt .= "<li>".$V_executivas->entidade_linha_1."</li>";
					}
					$TlistEnt .= "<li>SECRETARIAS MUNICIPAIS</li>";
					while($V_municipais = pg_fetch_object($V_entidades_municipais)){
						$TlistEnt .= "<li>".$V_municipais->entidade_linha_1."</li>";
					}
					$TlistEnt .= "<li>&Oacute;RG&Atilde;OS</li>";
					while($V_org = pg_fetch_object($V_orgaos)){
						$TlistEnt .= "<li>".$V_org->entidade_linha_1."</li>";
					}
	//===============================
	// retorna a lista das entidades
	//===============================

	return $TlistEnt;
}


function MsgSql($Tmsg, $Talt, $Tcomp){
	echo"
	<div id=\"popup\" style=\"position: absolute; width: 100%; height:100%; top:0px; left:0px; background-image:url(../layout/imagens/overlay.png);  border:2px solid #FFF; background-repeat:repeat; z-index:100; opacity:0.85; filter:alpha(opacity=85)\">
		<center>
			<div style=\"margin-top:145px; width:".$Tcomp."px; height:".$Talt."px; background-color:#000; border:3px solid #FFF; z-index:101; opacity:1; font-family:Verdana; font-size:12px; font-weight:bold; color:#FFF;\">
				".$Tmsg."
			</div>
		</center>
	</div>";
}

//novas funcoes

function validateEmpty($var, $fieldName, $fieldProblem) {
	if(empty($var)){
		$error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
		echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
		die;
	}
}

function validateCPF($cpf, $fieldProblem) {
	if(!validaCPF($cpf)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um CPF valido', 'fieldProblem' => $fieldProblem));
		die;
	}
}

function validateMail($mail, $fieldProblem){
	if(!validMail($mail)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um E-mail valido', 'fieldProblem' => $fieldProblem));
		die;
	}
}

/**
* Verifica se o e-mail e o dominio s�o validos
* @param $mail
* @return bool
*/
function validMail($mail) {
	$isMail = preg_match('/^[\d\w._%-]+@[\d\w.-]+\.[\w]{2,4}$/', $mail);
	$retorno = ((bool) $isMail);

	if($isMail){
		$host = explode("@", $mail);
		$host = $host[1];
		$retorno = getmxrr($host, $mx);

		if (!$retorno) {
	    	$ipaddress = gethostbyname($host);
		    if ($ipaddress != $host) {
		    	$retorno=true;
	    	}
		}
	}

	return $retorno;
}

function validaCPF($cpf = null) {

    // Verifica se um n�mero foi informado
    if(empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados � igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequ�ncias invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF � v�lido
     } else {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

?>