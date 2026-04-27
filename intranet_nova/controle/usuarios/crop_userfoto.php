<?php
//------------------------------------------
// Página implementada em : 30/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['imagemReal']) and (!empty($_FILES['Ffoto']['tmp_name']))){

	$TuserNome		= $_POST['Fnome'];
	$TuserSetor		= $_POST['Fsetor'];
	$TuserCargo		= $_POST['Fcargo'];
	$TuserFone		= $_POST['Ffone'];
	$TuserDataNasc	= $_POST['Fnascimento'];
	$TuserCurriculo = $_POST['Fcurriculo'];

	$img 			= $_FILES['Ffoto']['tmp_name'];
	$nImg 			= date("d_m_Y").date("_H_i_").md5($_FILES['arquivo']['name']);
	$nomeImg 		= $nImg.".jpg";
	$diretorio 		= "../arquivos/imagens/".$nomeImg;
	
	list($width, $height, $type, $attr) = getimagesize($img);
	
	if($width >= $heigth){
		$altura = round(($height/$width) * 800);
		reduz_imagem($img,800,$altura,$diretorio);
		
		$imgTemp = "../arquivos/imagens/imgTemp/$nImg.jpg";
		
		$altura2 = round(($height/$width) * 500);
		$largura2 = 500;
		reduz_imagem($img,$largura2,$altura2,$imgTemp);
	
	}else{
		$altura = round(($height/$width) * 600);
		reduz_imagem($img,800,$altura,$diretorio);
		
		$imgTemp = "../arquivos/imagens/imgTemp/$nImg.jpg";
		
		$altura2 = round(($height/$width) * 375);
		$largura2 = 500;
		reduz_imagem($img,$largura2,$altura2,$imgTemp);
	
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
		
		
		function showPreview(coords)
		{
		
			if (parseInt(coords.w) > 0)
			{
				var rx = 120/ coords.w;
				var ry = 170 / coords.h;
				
				var largura = <?php echo($largura2) ?>;
				var altura = <?php echo($altura2)?>;
				
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
    
    <div class="centro">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">atualizar dados de usu&aacute;rio</div>
        <div id="margem_direita">
    		<div class="conteudo_abas">
            	<div class="texto_formulario">Sistema de corte de imagem, selecione o rosto e clique em salvar.</div><br />
                <div id="outer">
                    <div class="jcExample">
                        <div class="article">
                        	<table>
                                <tr>
                                    <td colspan="3">
                                        <div style="text-align:center; border:1px dashed #666666; background-color:#FFFFFF; vertical-align:middle; display:table-cell; padding:5px 5px 5px 5px; overflow:hidden;">
                                        	<img src="<?=$imgTemp?>"  id="cropbox" />			
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        Visualização:
                                        <div style="width:125px; height:180px; text-align:center; border:1px solid #CCCCCC; background-color:#FFFFFF; vertical-align:middle; display:table-cell; padding-left:5px; overflow:hidden;">
                                            <div style="width:120px;height:170px;overflow:hidden;">
                                                <img src="<?=$imgTemp ?>" id="preview" />
                                            </div>
                                    	</div>
                                    </td>
                                </tr>		
                            </table>
                            <br />                
                            <form method="post" >
                                <input type="hidden" name="btEditar" value="editar" />                                                      
                                <input type="hidden" name="Fnome" value="<?=$TuserNome?>" />
                                <input type="hidden" name="Fsetor" value="<?=$TuserSetor?>" />
                                <input type="hidden" name="Fcargo" value="<?=$TuserCargo?>" />
                                <input type="hidden" name="Ffone" value="<?=$TuserFone?>" />
                                <input type="hidden" name="Fnascimento" value="<?=$TuserDataNasc?>" />
                                <input type="hidden" name="Fcurriculo" value="<?=$TuserCurriculo?>" />                                                                
                                <input type="hidden" name="nomeImg" value="<?=$nImg?>" />
                                <input type="hidden" name="imagemReal" value="<?=$diretorio?>" />
                                <input type="hidden" name="imagemTemp" value="<?=$imgTemp?>" />
                                <label><input type="hidden" size="4" id="x" name="x1" /></label>
                                <label><input type="hidden" size="4" id="y" name="y1" /></label>
                                <label><input type="hidden" size="4" id="x2" name="x2" /></label>
                                <label><input type="hidden" size="4" id="y2" name="y2" /></label>
                                <label><input type="hidden" size="4" id="w" name="w" /></label>
                                <label><input type="hidden" size="4" id="h" name="h" /></label>
                                
                                <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="btInclui" />	
                            </form>
                    	</div>
					</div>
				</div>
      		</div>
 		</div>
	</div>

	<?php
	
}else{

	//----------------------------------------
	// Variáveis gerais passadas pelo sistema
	//----------------------------------------
	$TuserNome		= $_POST['Fnome'];
	$TuserSetor		= $_POST['Fsetor'];
	$TuserCargo		= $_POST['Fcargo'];
	$TuserFone		= $_POST['Ffone'];
	$TuserDataNasc	= inverteDate($_POST['Fnascimento']);
	$TuserMatricula = $_SESSION['SuserLogin'];
	$TuserEntidade	= $_SESSION['SuserEnt'];
	$TuserId		= $_SESSION['SuserId'];
	$TuserCurriculo = $_POST['Fcurriculo'];
	
	//------------------------------------------------
	// verifica se foi solicitado a alteração da foto
	//------------------------------------------------
	$sqlFoto 	 = "SELECT * FROM uni_usuarios WHERE user_id = $TuserId";	
	$TresultFoto = $drive->pedido($sqlFoto);
	$TfotoAntiga = pg_fetch_object($TresultFoto);
		
	if(isset($_POST['nomeImg'])){
		include "../scripts/php/wideimage/WideImage.inc.php";
		
		//----------------------------------------
		// se existir foto antiga exlcui a antiga
		//----------------------------------------
		if($TfotoAntiga->user_foto != ""){
			@unlink($TfotoAntiga->user_foto);
		}
		
		//----------------------------------
		// dados para adicionar a nova foto
		//----------------------------------
		$sizes['x1'] = $_POST['x1'];
		$sizes['y1'] = $_POST['y1'];
		$sizes['x2'] = $_POST['x2'];
		$sizes['y2'] = $_POST['y2'];
		$sizes['w']  = $_POST['w'];
		$sizes['h']  = $_POST['h'];		
		$nomeImg 	 = $_POST['nomeImg'];
		$imagemTemp  = $_POST['imagemTemp'];
		$imagemReal  = $_POST['imagemReal'];
		$preview 	 = "../arquivos/imagens/$nomeImg"."_EXIBICAO.jpg";
		
		//-----------------------------
		// Faz o corte final na imagem 
		//----------------------------- 
		if(!$sizes['x1']==0 or !$sizes['y1']==0){	
			$img 	 = wiImage::load($imagemTemp);			
			$res 	 = $img->crop($sizes['x1'],$sizes['y1'],$sizes['w'],$sizes['h']);			
			$imgCrop = "../arquivos/imagens/cropada.jpg";			
			$res->saveToFile($imgCrop , null, 100);			
			reduz_imagem($imgCrop ,120, 170, $preview);			
			@unlink($imgCrop);
			@unlink($imagemTemp);
			@unlink($imagemReal);
		}
	}else{
		$preview = $TfotoAntiga->user_foto;
	}
	
	//-------------------------------------------------------
	// Atualiza os dados na base da INTRANET
	//-------------------------------------------------------
	$sqlUser = "UPDATE 
						uni_usuarios
				SET 					  	
						user_nome			  = '$TuserNome',
						user_setor_id		  = $TuserSetor,
						user_cargo_id		  = $TuserCargo,
						user_fone			  = '$TuserFone',
						user_data_nascimento  = '$TuserDataNasc',
						user_curriculo		  = '$TuserCurriculo',
						user_foto			  = '$preview'
				WHERE
				        user_id = $TuserId";

	$TresUser = $drive->pedido($sqlUser);
	
	/*########################################### L D A P ###################################################
	
	//-------------------------------------------------------
	// Atualiza os dados na base do LDAP
	//-------------------------------------------------------
	
	//recupera nome da entitdade a qual pertence o usuário
	$sqlEntId 	= "SELECT entidade_nome FROM entidades WHERE entidade_id = $TuserEntidade";
	$TresulTEn 	= $drive->pedido($sqlEntId);
	$TobjEntId  = pg_fetch_object($TresulTEn);
	$TentName	= $TobjEntId->entidade_nome;
	
	//recupera ao qual setor o usuário esta subordinado
	$sqlSetId 	= "SELECT setor_nome FROM setores WHERE setor_id = $TuserSetor";
	$TresulTSt 	= $drive->pedido($sqlSetId);
	$TobjSetNo  = pg_fetch_object($TresulTSt);
	$TsetName	= $TobjSetNo->setor_nome;
	
	//recupera o cargo que o usuário exerce
	$sqlCartId 	= "SELECT cargo_nome FROM cargos WHERE cargo_id = $TuserCargo";
	$TresulTCa 	= $drive->pedido($sqlCartId);
	$TobjCarId  = pg_fetch_object($TresulTCa);
	$TcarName	= $TobjCarId->cargo_nome;	
	

	$TnomeUser	= $_SESSION['SuserLogin'];
	$sdn		= "uid=$TnomeUser,ou=People,dc=pmf.sc.gov.br";
	$serv_ldap 	= "ldap.pmf.sc.gov.br";
	$filter 	= "(objectclass=*)";
	$ldap 		= ldap_connect($serv_ldap);
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	$res		= ldap_bind($ldap, "uid=admin,ou=People,dc=pmf.sc.gov.br", "CafenoBule");
	
	$uid 		= "uid=$TnomeUser,ou=People,dc=pmf.sc.gov.br";
	
	$entry[cn]					= $_POST['Fnome'];
	$entry[uidPortalEntidade]	= $TentName;
	$entry[uidPortalSetor]		= $TsetName;
	$entry[uidPortalCargo]		= $TcarName;
	$entry[telephoneNumber] 	= $_POST['Ffone'];
	
	$res 		= ldap_modify( $ldap, $uid, $entry );
	
	########################################### L D A P ###################################################*/
	
	print "Resultado do  $TresUser ";

	if($TresUser != false ){
		echo("<script>alert(\"Dados atualizados com sucesso!\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=userdados&menu=".$_GET['menu']."\";</script>");	
	}else{
		echo("<script>alert(\"Servidor Ocupado\\n\\nTente novamente dentro de alguns instantes\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=userdados&menu=".$_GET['menu']."\";</script>");
	}	
}
?>