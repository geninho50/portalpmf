<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
include ("../scripts/php/wideimage/WideImage.inc.php");
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();

//----------------------------------------------------------
// Recebe os valores passados pelo formulário e pela sessão
//----------------------------------------------------------
$Tentidade		= (int)$_SESSION['SuserEnt'];
$Tsetor			= (int)$_POST['Fsetor'];
$Tcargo			= (int)$_POST['Fcargo'];
$Tnome			= utf8_decode($_POST['Fnome']);
$Tchars 		= array(')','(',' ','-');
$Tsubs 			= array('','','','');
$Tfone			= $_POST['Ffone'];
// $Tfone			= str_replace($Tchars,$Tsubs,$_POST['Ffone']);
//$Temail			= explode("@", $_POST['Femail']);
$Temail			= $_POST['Femail'];
$Tquem			= $_POST['Fquem'];
$Tgabinete		= $_POST['Fgabinete'];
$Tcurriculo		= $_POST['Fcurriculo'];

//-------------------------------------------------
// Verifica se foi enviada uma foto do colaborador
//-------------------------------------------------
if(!empty($_FILES['Ffoto']['tmp_name'])){
	//---------------------------------------------------------
	// Verifica se já existe uma foto antiga, se existir apaga
	//---------------------------------------------------------
	if($_GET['pagina'] == "colabedit"){
		$sql 		= "SELECT * FROM uni_usuarios WHERE user_id = ".$_GET['colabId'];
		$TretUser 	= $drive->pedido($sql);
		$Tuser 		= pg_fetch_object($TretUser);
		if(!empty($Tuser->user_foto_link)){
			@unlink($Tuser->user_foto_link);		
		}
	}
	//---------------------------------------
	// Faz o tratamento para recorte da foto
	//---------------------------------------
	echo"
	<div class=\"centro\">
		<div id=\"caminho_migalhas\">atualiza&ccedil;&atilde;o do portal &gt; estrutura da prefeitura</div>
		<div id=\"titulo_pagina\">incluir colaborador</div>
		<div>
			<div class=\"painel_abas\">
				<div id=\"aba_dados\" class=\"aba_sel\"><span>Editar Foto</span></div>
			</div>  
			<div class=\"conteudo_abas\">	  
				<div class=\"texto_formulario\">Editar foto do perfil, que será exibida na página do gabinete.</div><br />";	
				$Timg 		= $_FILES['Ffoto']['tmp_name'];
				$TnomeImg 	= date("d_m_Y").date("_H_i_s_").md5($_FILES['Ffoto']['name']).".jpg";
				$Tdiretorio = "../arquivos/imagens/".$TnomeImg;
				list($width, $height, $type, $attr) = getimagesize($Timg);	
				if($width >= $heigth){
					$Taltura = round(($height/$width) * 800);
					reduz_imagem($Timg,800,$Taltura,$Tdiretorio);		
					$TimgTemp  = "../arquivos/imagens/imgTemp/$TnomeImg";		
					$Taltura2  = round(($height/$width) * 500);
					$Tlargura2 = 500;
					reduz_imagem($Timg,$Tlargura2,$Taltura2,$TimgTemp);	
				}else{
					$Taltura = round(($height/$width) * 600);
					reduz_imagem($Timg,800,$Taltura,$Tdiretorio);		
					$TimgTemp = "../arquivos/imagens/imgTemp/$nImg.jpg";		
					$Taltura2 = round(($height/$width) * 375);
					$Tlargura2 = 500;
					reduz_imagem($Timg,$Tlargura2,$Taltura2,$TimgTemp);	
				}	
				?>
				<script src="../scripts/jcropper/js/jquery.Jcrop.js"></script>
				<link rel="stylesheet" href="../scripts/jcropper/css/jquery.Jcrop.css" type="text/css" />
				<script language="Javascript">
				jQuery(window).load(function(){
					jQuery('#cropbox').Jcrop({
						onChange: showPreview,
						onSelect: showPreview,
						aspectRatio: 0.7
					});
				});		
				
				function showPreview(coords){		
					if (parseInt(coords.w) > 0){
						var rx = 120/ coords.w;
						var ry = 170 / coords.h;
						
						var largura = <?=$Tlargura2?>;
						var altura = <?=$Taltura2?>;				
						
						jQuery('#preview').css({
							width: Math.round(rx * largura) + 'px',
							height: Math.round(ry * altura) + 'px',
							marginLeft: '-' + Math.round(rx * coords.x) + 'px',
							marginTop: '-' + Math.round(ry * coords.y) + 'px'
						});			
						
					jQuery('#x').val(coords.x);
					jQuery('#y').val(coords.y);
					jQuery('#x2').val(coords.x2);
					jQuery('#y2').val(coords.y2);
					jQuery('#w').val(coords.w);
					jQuery('#h').val(coords.h);
					}
				}
				</script>
				<div id="outer">
					<div class="jcExample">
						<div class="article">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="100%">
                                    	<div style="width:<?=$Tlargura2?>px;height:<?=$Taltura2?>px;border:4px solid #333;">
											<img src="<?=$TimgTemp?>"  id="cropbox" />
										</div>
                                    </td>
								</tr>
								<tr>
									<td valign="top" width="100%">
										Visualização:
										<div style="width:120px;height:170px;overflow:hidden; border:4px solid #333;">
											<img src="<?=$TimgTemp ?>" id="preview" />
										</div>
									</td>		
								</tr>
							</table>
							<br />
                            <form method="post" >
                                <input type="hidden" name="Fnome" value="<?=$Tnome?>"/>
                                <input type="hidden" name="Femail" value="<?=$Temail?>"/>
                                <input type="hidden" name="Ffone" value="<?=$Tfone?>"/>
                                <input type="hidden" name="Fcargo" value="<?=$Tcargo?>"/>
                                <input type="hidden" name="Fquem" value="<?=$Tquem?>"/>
                                <input type="hidden" name="Fsetor" value="<?=$Tsetor?>"/>
                                <input type="hidden" name="Fgabinete" value="<?=$Tgabinete?>"/>
                                <input type="hidden" name="Fcurriculo" value="<?=$Tcurriculo?>"/>       
                                <input type="hidden" name="FnomeImg" value="<?=$TnomeImg?>"/>
                                <input type="hidden" name="FimagemReal" value="<?=$Tdiretorio?>"/>
                                <input type="hidden" name="FimagemTemp" value="<?=$TimgTemp?>"/>
                                <label><input type="hidden" size="4" id="x" name="x1" /></label>
                                <label><input type="hidden" size="4" id="y" name="y1" /></label>
                                <label><input type="hidden" size="4" id="x2" name="x2" /></label>
                                <label><input type="hidden" size="4" id="y2" name="y2" /></label>
                                <label><input type="hidden" size="4" id="w" name="w" /></label>
                                <label><input type="hidden" size="4" id="h" name="h" /></label>                                
                                <input type="image" src="../layout/imagens/atualiza_btn_salvar.png" name="btSalvar" id="btSalvar" value="btSalvar" />
                        	</form>
						</div>
					</div>
				</div>
       		</div>
     	</div>
   	</div>
<?php	
}else{
	//------------------------------------
	// Finaliza o cadastro do colaborador
	//------------------------------------
	// $Tfone = "48".$Tfone;
	if(isset($_POST['FnomeImg'])){
		$sizes['x1'] = $_POST['x1'];
		$sizes['y1'] = $_POST['y1'];
		$sizes['x2'] = $_POST['x2'];
		$sizes['y2'] = $_POST['y2'];
		$sizes['w']  = $_POST['w'];
		$sizes['h']  = $_POST['h'];
		
		$TnomeImg 	 = $_POST['FnomeImg'];
		$TimagemReal = $_POST['FimagemReal'];
		$TimagemTemp = $_POST['FimagemTemp'];
		$Tfoto		 = "../arquivos/imagens/$TnomeImg";
		
		if(!$sizes['x1']==0 or !$sizes['y1']==0){
			$Timg = wiImage::load($TimagemTemp);
			$Tres = $Timg->crop($sizes['x1'],$sizes['y1'],$sizes['w'],$sizes['h']);
			$TimgCrop = '../arquivos/imagens/cropada.jpg';
			$Tres->saveToFile($TimgCrop , null, 100);
			reduz_imagem($TimgCrop ,120, 170, $Tfoto);
			@unlink($TimgCrop);
			@unlink($TimagemTemp);
		}else{
			reduz_imagem($TimagemReal, 120, 170, $Tfoto);
		}
	}else{
		$Tfoto = "";
	}
	
	//----------------------------------------------------------
	// Verifica se o colaborador esta sendo incluido ou editado
	//----------------------------------------------------------
	if($_GET['pagina'] == "colabinclui"){
		$Tmsg1		= "Colaborador cadastrado com Sucesso!";	
		
		$Tretorno	= "?pagina=colabinclui&menu=".$_GET['menu'];
		//-----------------------------------------------------
		// Monta o sql para inserir os dados no banco de dados
		//-----------------------------------------------------
		$sql = "INSERT INTO 
					uni_usuarios(
						user_id, 
						user_nome, 
						user_fone, 
						user_email, 
						user_entidade_id, 
						user_cargo_id, 
						user_foto_link, 
						user_quem,
						user_setor_id,
						user_gab,
						user_curriculo) 
				VALUES(
					default, 
					'$Tnome', 
					'$Tfone', 
					'$Temail', 
				    	$Tentidade, 
				   	$Tcargo, 
					'$Tfoto',
					'$Tquem',
					'$Tsetor',
					'$Tgabinete',
					'$Tcurriculo')";
$Tmsg2		= "Não foi possível cadastrar o Colaborador!".$sql;
	}else{
		$Tmsg1	  = "Colaborador editado com Sucesso!";	
		$Tmsg2	  = "Não foi possível editar o Colaborador!";
		$Tretorno = "?pagina=colabcad&menu=".$_GET['menu'];
		if($Tfoto == ''){
			$sql	  = "UPDATE 
						uni_usuarios 
					SET 
						user_nome = '".$Tnome."', 
						user_fone = '".$Tfone."', 
						user_email = '".$Temail."', 
						user_entidade_id = ".$Tentidade.", 
						user_cargo_id = ".$Tcargo.", 
						user_quem = '".$Tquem."',
						user_setor_id = ".$Tsetor.",
						user_gab = '".$Tgabinete."',
						user_curriculo = '".$Tcurriculo."'
					WHERE
						user_id = ".$_GET['colabId'];
		}else {
			$sql	  = "UPDATE 
						uni_usuarios 
					SET 
						user_nome = '".$Tnome."', 
						user_fone = '".$Tfone."', 
						user_email = '".$Temail."', 
						user_entidade_id = ".$Tentidade.", 
						user_cargo_id = ".$Tcargo.", 
						user_quem = '".$Tquem."',
						user_setor_id = ".$Tsetor.",
						user_gab = '".$Tgabinete."',
						user_curriculo = '".$Tcurriculo."',
						user_foto_link = '".$Tfoto."'
					WHERE
						user_id = ".$_GET['colabId'];
		}

	}	
		
	//-----------------------------------
	// Insere os dados no banco de dados
	//-----------------------------------
	$Tinsert = $drive->pedido($sql);
	$drive->close();
	
	if($Tinsert){
		//------------------------------------------------
		// Imprime mensagem de de confirmação de inclusão
		//------------------------------------------------
		$Tmsg = "
		<form method=\"post\" action=\"".$Tretorno."\" >
			<br />
			<br />
			".$Tmsg1."	
			<br />
			<br />
			<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
		</form>";			
		MsgSql($Tmsg, 100, 400);
	}else{
		//------------------------------------------------
		// Imprime mensagem de de confirmação de inclusão
		//------------------------------------------------
		$Tmsg = "
		<form method=\"post\" action=\"?pagina=colabcad&menu=".$_GET['menu']."\">
			<br />
			<br />
			".$Tmsg2."	
			<br />
			<br />
			<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
		</form>";			
		MsgSql($Tmsg, 100, 400);	
	}	
}
?>