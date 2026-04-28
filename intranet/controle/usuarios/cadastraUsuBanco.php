<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
<!-- Optional theme -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">-->
<!--Latest compiled and minified JavaScript -->
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->

<?php
	require_once("valida_session.php");
	require_once("../scripts/php/funcoes_bd.php"); 
	require_once("../scripts/php/config.php");	
?>

<style type="text/css">
.hidden {
  display: none !important;
  visibility: hidden !important;
}
</style>
	<div class="centro">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">Cadastrar Usuario</div>
		<div id="margem_direita"><br>
			<div class="conteudo_abas">
				<div role="form">
					<div id="conteudo_dados" style="display:inline">
						<div class="texto_formulario">Nome:</div>
						<input name="nome" id="nome" type="text" class="componente_miolo" maxlength="200"/><br> 
						<div class="texto_formulario">E-mail:</div>
						<input name="email" id="email" type="text" class="componente_miolo" maxlength="200" /><br>
						<div class="texto_formulario">Matricula:</div>
						<input name="matricula" id="matricula" type="text" class="componente_miolo_menor" maxlength="2100" /><br>
						<div class="texto_formulario">CPF:</div>
						<input name="cpf" id="cpf" type="text" class="componente_miolo_menor" maxlength="2100" /><br>
						<div class="texto_formulario">Login:</div>
						<input name="login" id="login" type="text" class="componente_miolo_menor" maxlength="100"/><br> 
						<div class="texto_formulario">Telefone PMF:</div>
						<input name="fone" id="fone" type="text" class="componente_miolo_menor" maxlength="9"/> Ex: 3251-0000<br> 
	                    <div class="texto_formulario">Nascimento:</div>
						<input name="nascimento" id="nascimento" type="text" class="componente_miolo_menor" maxlength="10"> Ex: 30/12/1975

						<div class="texto_formulario">Entidade</div> 
						<select name="entidades" id="entidades" class="componente_miolo">
							<?php
								$sqlEntidade	= "SELECT * FROM entidades ORDER BY entidade_nome";
								$TresultEnt  	= $drive->pedido($sqlEntidade);
								$Tentidade 	 	= pg_fetch_all($TresultEnt);	
								
								foreach($Tentidade as $value ){
									echo "<option value='".$value['entidade_id']."'>".$value['entidade_nome']."</option>";
								}
							?>
						</select>

						<div class="texto_formulario hidden" id="setor_nome">Setor</div> 
						<select name="setor" id="setor" class="componente_miolo hidden"></select>

						<div class="texto_formulario hidden" id="cargo_nome">Cargo</div> 
						<select name="cargo" id="cargo" class="componente_miolo hidden"></select>

						<div class="texto_formulario">Grupo</div> 
						<select name="grupo" id="grupo" class="componente_miolo" >
						<?php	
							$sqlGrupo	= "SELECT * FROM grupo ORDER BY grupo_nome";
							$TresultGrup  	= $drive->pedido($sqlGrupo);
							$Grupo 	 	= pg_fetch_all($TresultGrup);	
							foreach($Grupo  as $value ){
								echo "<option value='".$value['grupo_id']."'>".$value['grupo_nome']."</option>";
							}
						?>
						</select>
						<?php
							echo "<br /><div class=\"texto_formulario\">Perfil:</div>"; 
		                    
							$sqlPerfil = "SELECT * FROM intranet_perfil ORDER BY intranet_perfil_nome ";
							
							$drive->conecta();
							$Tresult = $drive->pedido($sqlPerfil);
							$drive->close();
							
		                    echo "<select name=\"perfil\" id=\"perfil\" class=\"componente_miolo\">";
							while($Tperfil = pg_fetch_object($Tresult)){
		                    	echo "<option value=\"".$Tperfil->intranet_perfil_id."\">".$Tperfil->intranet_perfil_nome."</option>";
							}
		                    echo "</select >";
		                    ?>
	                    <br><br />

					<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="cadastrarUsuario" id="cadastrarUsuario" value="cadastrarUsuario"/> 
					</div>
				</div>
			</div>
		</div>
	</div>  
	<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
	<script> 
	
$('input').bind('click',function(){
	
	$('#nome').siblings('.LV_validation_message').remove();
	$('#nome').removeClass('LV_invalid_field');
	$('#email').removeClass('LV_invalid_field');
	$('#matricula').removeClass('LV_invalid_field');
	$('#cpf').removeClass('LV_invalid_field');
	$('#login').removeClass('LV_invalid_field');
	$('#fone').removeClass('LV_invalid_field');
	$('#nascimento').removeClass('LV_invalid_field');
});

	$('#cadastrarUsuario').bind('click',function(){
		var envia = true;
		if($('#nome').val() == ''){
			 $('#nome').addClass('LV_invalid_field');
			 $('#nome').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		if($('#email').val() == ''){
			 $('#email').addClass('LV_invalid_field');
			 $('#email').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		if($('#matricula').val() == ''){
			 $('#matricula').addClass('LV_invalid_field');
			 $('#matricula').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		if($('#cpf').val() == ''){
			 $('#cpf').addClass('LV_invalid_field');
			 $('#cpf').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		if($('#login').val() == ''){
			 $('#login').addClass('LV_invalid_field');
			 $('#login').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		var str = $('#login').val();
		var res = str.split(" ");
		if (res.length > 1) {
			envia = false;
			$('#login').addClass('LV_invalid_field');
		 	$('#login').after('<span class=" LV_validation_message LV_invalid">Não pode haver espaços</span>');
		};

		if($('#fone').val() == ''){
			 $('#fone').addClass('LV_invalid_field');
			 $('#fone').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}

		if($('#nascimento').val() == ''){
			 $('#nascimento').addClass('LV_invalid_field');
			 $('#nascimento').after('<span class=" LV_validation_message LV_invalid">Obrigatorio</span>');
			 envia = false;
		}		

		if(envia == true){
			var obj = {
						nome : $('#nome').val(),
						email : $('#email').val(),
						matricula : $('#matricula').val(),
						cpf : $('#cpf').val(),
						login : $('#login').val(),
						fone : $('#fone').val(),
						nascimento : $('#nascimento').val(),
						entidades : $('#entidades').val(),
						grupo : $('#grupo').val(),
						setor : $('#setor').val(),
						cargo : $('#cargo').val(),
						perfil : $('#perfil').val()
				};
				console.log(data);
			$.post( "controle/usuarios/cadastraReq.php", obj).done(function( data ) {	
				var retorno = jQuery.parseJSON(data);

				if(retorno.success == 1){
					alert('Usuario cadastrado com senha ' + retorno.senha);
					document.location.reload(true);
				}else{
					if(retorno.success == 0){
				    	alert('Campos em branco');
					}
					if(retorno.success == 2){
				    	$('#cpf').addClass('LV_invalid_field');
			 			$('#cpf').after('<span class=" LV_validation_message LV_invalid">CPF invalido</span>');
					}
					if(retorno.success == 3){
				    	$('#email').addClass('LV_invalid_field');
			 			$('#email').after('<span class=" LV_validation_message LV_invalid">E-mail invalido</span>');
					}
					if(retorno.success == 4){
				    	$('#login').addClass('LV_invalid_field');
			 			$('#login').after('<span class=" LV_validation_message LV_invalid">Não pode haver espaços</span>');
					}
				}
			}); 
		}

	});

	jQuery(function($){
	  	$("#cpf").mask("999.999.999-99");
		$("#fone").mask("9999-9999?9");
		$("#nascimento").mask("99/99/9999");
	});

	$( '#entidades' ).change(function() {	
	 	var obj = {
	 		entidade_id : $( '#entidades' ).val() 
	 	};
		$.post( "controle/usuarios/selectEntidade.php", obj).done(function( data ) {	
			var retorno = jQuery.parseJSON(data);
			$('#setor').addClass("hidden");
			$('#setor_nome').addClass("hidden");
			$('#cargo').addClass("hidden");
			$('#cargo_nome').addClass("hidden");
			if(retorno.setor != ''){
				$('#setor').removeClass("hidden");
				$('#setor_nome').removeClass("hidden");
			}
			if(retorno.setor != ''){
				$('#cargo').removeClass("hidden");
				$('#cargo_nome').removeClass("hidden");
			}
				$('#setor').html(retorno.setor);
				$('#cargo').html(retorno.cargo);
		}); 
	});
	  </script>