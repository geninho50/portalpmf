<?php
//------------------------------------------
// Página implementada em : 09/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>

<script>

function mascara_fone(form){
	if(form.Ffone.value.length==4){
		form.Ffone.value=form.Ffone.value + "-";
	}
	if(form.Ffone.value.length==9){
		form.Ffone.value=form.Ffone.value;
	}
} 

function mascara_data(form){
	if(form.Fnascimento.value.length==2){
		form.Fnascimento.value=form.Fnascimento.value + "/";
	}
	if(form.Fnascimento.value.length==5){
		form.Fnascimento.value=form.Fnascimento.value + "/";
	}
} 

</script>

<?php
include"../scripts/php/funcoes.php";

if(!isset($_POST['btInclui_x'])){
	
	$TuserId 	= $_SESSION['SuserId'];
	$sqlUser 	= "SELECT * FROM uni_usuarios WHERE user_id = $TuserId";
	$TresUser	= $drive->pedido($sqlUser);
	$TuserDados = pg_fetch_object($TresUser);

	$TuserEnt	= $_SESSION['SuserEntDefault'];

	// $sqlSetor	= "SELECT * FROM setores WHERE setor_entidade_id = '$TuserEnt' ORDER BY setor_posicao ASC";
	$sqlSetor	= "SELECT distinct setor_id, setor_nome FROM setores ORDER BY setor_nome ASC";
	$TresSetor	= $drive->pedido($sqlSetor);
	
	// $sqlCargo	= "SELECT * FROM cargos WHERE cargo_entidade_id = '$TuserEnt' ORDER BY cargo_posicao ASC";
	$sqlCargo	= "SELECT distinct cargo_id, cargo_nome FROM cargos ORDER BY cargo_nome ASC";
	$TresCargo	= $drive->pedido($sqlCargo);
	
	?>
	
	<div class="centro">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">alterar perfil</div>
		<div id="margem_direita"><br>
			<div class="conteudo_abas">
				<form method="post" enctype="multipart/form-data">
				<div id="conteudo_dados" style="display:inline">
					<div class="texto_formulario">Nome:</div>
					<input name="Fnome" id="Fnome" type="text" class="componente_miolo" maxlength="200" value="<?=utf8_encode($TuserDados->user_nome)?>" /><br> 
                    <script type="text/javascript">
                    	var Fnome = new LiveValidation('Fnome'); 
                    	Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                	</script>  
					<div class="texto_formulario">Setor:</div>	
					<select name="Fsetor" id="Fsetor" class="componente_miolo">
					<option value=0>nenhum</option>
						 <?php
						 while($Tsetor = pg_fetch_object($TresSetor)){
							echo "<option value=\"".$Tsetor->setor_id."\" ";
							if($Tsetor->setor_id == $TuserDados->user_setor_id){
								echo "selected=\"selected\"";
							}
							echo ">".$Tsetor->setor_nome."</option>";
						 }
						 ?>                      
					</select><br>  
					<div class="texto_formulario">Cargo:</div>
					<select name="Fcargo" id="Fcargo" class="componente_miolo">
			        <option value=0>nenhum</option>
						 <?php
						 while($Tcargo = pg_fetch_object($TresCargo)){
							echo "<option value=\"".$Tcargo->cargo_id."\" ";
							if($Tcargo->cargo_id == $TuserDados->user_cargo_id){
								echo "selected=\"selected\"";
							}
							echo ">".utf8_encode($Tcargo->cargo_nome)."</option>";
						 }
						 ?>
					</select><br>
					<div class="texto_formulario">E-mail:</div>
					<input name="Femail" type="text" class="componente_miolo" maxlength="100" disabled="disabled" value="<?=$TuserDados->user_email?>" /><br>
					<div class="texto_formulario">Telefone PMF:</div>
					<input name="Ffone" id="Ffone" type="text" class="componente_miolo_menor" maxlength="9" value="<?=$TuserDados->user_fone?>" onkeyup="mascara_fone(form)" /> Ex: 3251-0000<br> 
					<script type="text/javascript">
					
					</script> 
                    <div class="texto_formulario">Nascimento:</div>
					<input name="Fnascimento" id="Fnascimento" type="text" class="componente_miolo_menor" maxlength="10" value="<?=inverteDateBd($TuserDados->user_data_nascimento)?>" onkeyup="mascara_data(form)" /> Ex: 30/12/1975
					<script type="text/javascript">
						var Fnascimento= new LiveValidation('Fnascimento');
						Fnascimento.add(Validate.Presence, {failureMessage: "Obrigatorio"});
						Fnascimento.add(Validate.Length, {minimum: 10, tooShortMessage: "Data Inválida"} );
						Fnascimento.add(Validate.Format, {pattern: new RegExp(/^([0-9]|[0,1,2][0-9]|3[0,1])\/([0][1-9]|[1][0-2])\/\d{4}$/), failureMessage: "Data Inválida" }); 
					</script> 
                    <br><br /><hr size="1" />
                    <div class="texto_formulario">Foto Atual:</div>              
                    <div style="width:130px; height:180px; text-align:center; border:1px solid #CCCCCC; background-image:url(../layout/imagens/nofot.jpg); vertical-align:middle; display:table-cell;">                    
                        <img src="<?=$TuserDados->user_foto?>" border="0" width="120" height="170" />                     
                    </div>   
                    <div class="texto_formulario">Alterar Foto:</div>
                    <input type="file" size="21" name="Ffoto" /><br />
                    <div class="texto_formulario">Curr&iacute;culo:</div>
                    <label>
                    <textarea name="Fcurriculo" cols="52" rows="4"><?=$TuserDados->user_curriculo?></textarea>
                    </label>
                    <br><br />
					<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="btInclui" />
				</div>
				</form>
			</div>
		</div>
	</div>  
<?php
}else{
	//--------------------------------------------------
	// Faz o corte da imagem e insere no banco de dados
	//--------------------------------------------------
	include "crop_userfoto.php";
}
?>	
	
