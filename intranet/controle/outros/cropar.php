<?php

echo "<b>Imagem:</b><br /><br />";
require_once("../scripts/php/funcoes.php");

$Ttitulo 	 = $_POST['Ftitulo'];
$Ttexto	 	 = $_POST['Ftexto'];
$TdataFim 	 = $_POST['FdataFim'];
$TtelaCheia  = $_POST['FtelaCheia'] == 'on' ? 1 : 0;

$TdataFimF   = explode('/', $TdataFim);
$TdataFim    = $TdataFimF[2] . $TdataFimF[1] . $TdataFimF[0];

$TdataInicio  = $_POST['FdataInicio'];
$TdataInicioF = explode('/', $TdataInicio);
$TdataInicio  = $TdataInicioF[2] . $TdataInicioF[1] .$TdataInicioF[0];

$Timg 	 	 = $_FILES['Farquivo']['tmp_name'];
$TnImg 	 	 = date("d_m_Y").date("_H_i_").md5($_FILES['Farquivo']['name']);
$TnomeImg  	 = $TnImg.".jpg";
$Tdiretorio  = "../arquivos/imagens/".$TnomeImg;

list($width, $height, $type, $attr) = getimagesize($Timg);

if($width >= $height){

	$altura = round(($height/$width) * 800);
	reduz_imagem($Timg,800,$altura,$Tdiretorio);		
	$imgTemp = "../arquivos/imagens/imgTemp/$TnImg.jpg";		
	$altura2 = round(($height/$width) * 500);
	$largura2 = 500;
	reduz_imagem($Timg,$largura2,$altura2,$imgTemp);		

}else{
	
	$altura = round(($height/$width) * 600);
	reduz_imagem($Timg,800,$altura,$Tdiretorio);	
	$imgTemp = "../arquivos/imagens/imgTemp/$TnImg.jpg";	
	$altura2 = round(($height/$width) * 375);
	$largura2 = 500;
	reduz_imagem($Timg,$largura2,$altura2,$imgTemp);

}					

?>
<script src="../scripts/jcropper/js/jquery.min.js"></script>
<script src="../scripts/jcropper/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="../scripts/jcropper/css/jquery.Jcrop.css" type="text/css" />

<script language="Javascript">
/*
jQuery(window).load(function(){

	jQuery('#cropbox').Jcrop({
		onChange: showPreview,
		onSelect: showPreview,
		aspectRatio: 1.33
	});

});
	
function showPreview(coords)
{

	if (parseInt(coords.w) > 0)
	{
		var rx = 115/ coords.w;
		var ry = 86 / coords.h;
		
		var rx2 = 172 / coords.w;
		var ry2 = 129 / coords.h;
		
		var rx3 = 260 / coords.w;
		var ry3 = 195 / coords.h;
		
		var largura = <? echo($largura2) ?>;
		var altura = <? echo($altura2)?>;
		
		jQuery('#preview').css({
			width: Math.round(rx * largura) + 'px',
			height: Math.round(ry * altura) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
		
		jQuery('#preview2').css({
			width: Math.round(rx2 *largura) + 'px',
			height: Math.round(ry2 * altura) + 'px',
			marginLeft: '-' + Math.round(rx2 * coords.x) + 'px',
			marginTop: '-' + Math.round(ry2 * coords.y) + 'px'
		});
		
		jQuery('#preview3').css({
			width: Math.round(rx3 * largura) + 'px',
			height: Math.round(ry3 * altura) + 'px',
			marginLeft: '-' + Math.round(rx3 * coords.x) + 'px',
			marginTop: '-' + Math.round(ry3 * coords.y) + 'px'
		});			
		
	jQuery('#x').val(coords.x);
	jQuery('#y').val(coords.y);
	jQuery('#x2').val(coords.x2);
	jQuery('#y2').val(coords.y2);
	jQuery('#w').val(coords.w);
	jQuery('#h').val(coords.h);
	}
}
*/
</script>

<div id="outer">
	<div class="jcExample">
		<div class="article">
            <table border="0">
                <tr>
                    <td colspan="3"><img src="<?=$imgTemp?>"  id="cropbox" style="border: solid 5px #FFF" /></td>
                </tr>
                <!--
                <tr>
                    <td valign="top">
                        <br /><b>Preview:</b>
                        <div style="width:260px;height:195px;overflow:hidden;"><img src="<?=$imgTemp ?>" id="preview3" /></div>
                    </td>
                </tr>
                -->
            </table>
			<form method="post" >
            	<input type="hidden" name="passoCrop" value="2" />
                <input type="hidden" name="Ftitulo" value="<?=$Ttitulo?>"/>
                <input type="hidden" name="Ftexto" value="<?=$Ttexto?>"/>
                <input type="hidden" name="FdataFim" value="<?=$TdataFim?>"/>
                <input type="hidden" name="FdataInicio" value="<?=$TdataInicio?>"/>
                <input type="hidden" name="FnomeImg" value="<?=$TnImg?>"/>
                <input type="hidden" name="FimagemReal" value="<?=$Tdiretorio?>"/>
                <input type="hidden" name="FimagemTemp" value="<?=$imgTemp?>"/>
                <input type="hidden" name="FtelaCheia" value="<?=$TtelaCheia?>"/>
               <!--
                <label><input type="hidden" size="4" id="x" name="x1" /></label>
                <label><input type="hidden" size="4" id="y" name="y1" /></label>
                <label><input type="hidden" size="4" id="x2" name="x2" /></label>
                <label><input type="hidden" size="4" id="y2" name="y2" /></label>
                <label><input type="hidden" size="4" id="w" name="w" /></label>
                <label><input type="hidden" size="4" id="h" name="h" /></label>
                -->
				<input type="submit" name="btCrop" id="btCrop" value="Salvar Imagem"/>
			</form>
		</div>
	</div>
</div>