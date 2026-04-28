<?php
//######################### pega o sistema pelo ID enviado por GET #################### 
	if(!isset($_POST['btInc_x'])){
		$id = $_GET['id'];
		$sql="SELECT * FROM intranet_sistemas WHERE intranet_sistemas_id=$id";
		$Tretorno=$drive->pedido($sql);
		$editar = pg_fetch_object($Tretorno);
?>
<!-- script de verificacao dos campos !-->
<script language="javascript" type="text/javascript">
	//script para validacao do preenchimento dos campos
	function validaForm(){
    	d = document.cadastro;
        //validar nome
        if (d.fnome.value == ""){
        	alert("O campo Nome deve ser preenchido!");
			d.fnome.focus();
			return false;
		}
		//validar tags de busca
		if (d.ftagBusca.value == ""){
			alert("O campo Tags de Busca deve ser preenchido!");
			d.ftagBusca.focus();
			return false;
		}
         //validar descricao
		if (d.fdescricao.value == ""){
			alert("O campo Descrição deve ser preenchido!");
			d.fdescricao.focus();
			return false;
		}
		//validar email(verificao de endereco eletrônico)
		if (d.fendereco.value == ""){
				alert ("O campo Endereco Online deve ser conter um endereco eletronico!");
				d.fendereco.focus();
				return false;
			}
		//validar exibir na intranet
		if (d.fexibirServico.checked && d.fendereco.value ==""){
			alert("Voce deve preencher o seu endereco online!");
			d.fendereco.focus();
			return false;
		}
		else{
         return true;
                }
            }
</script>
<div class="centro">
   	<div id="caminho_migalhas">intranet &gt; </div>
	<div id="titulo_pagina">editar sistema</div>
	<div id="margem_direita"><br>
     
      	<div class="conteudo_abas">
			<div id="conteudo_dados" style="display:inline">
       			<form method="POST" onSubmit="return validaForm()">
					<input type="hidden" name="FsistId" value="<?=$id?>" />
					</select><br>
                    <div class="texto_formulario">Nome:</div>
                    <input name="fnome" type="text" class="componente_miolo" value="<?php echo $editar->intranet_sistemas_nome; ?>" maxlength="100" /><br> 
					<div class="texto_formulario">Tags de Busca:</div>
					<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?php echo $editar->intranet_sistemas_tags; ?>"/>Dica: cadastre tamb&eacute;m o nome do sistema como TAG de busca. <br>
                    <div class="texto_formulario">Descrição:</div>
                    <label>
                    	<textarea name="fdescricao" id="textarea" class="componente_miolo" cols="45" rows="7" > <?php echo $editar->intranet_sistemas_descricao; ?> </textarea>
                    </label>
                    <br><br> 
                    <span class="texto_formulario">
                    Endereço on-line:
                    </span>(padrão: http://www.meuendereco.dominio)
                    <input name="fendereco" type="text" value="<?php echo $editar->intranet_sistemas_endereco; ?>" class="componente_miolo" maxlength="100" /><br>
          			<div class="texto_formulario"><input name="fexibirServico" type="checkbox" <?php if($editar->intranet_sistemas_exibirweb == 't'){echo"checked=\"checked\"";} ?> value="1" />Exibir Serviço na Intranet ?</div>
          			(Caso não esteja pronto, o serviço pode ficar em modo de edição)
          			<br><br>
                    <hr size="1" />
                    Dados Suporte:<br />
                    <div class="texto_formulario">Respons&aacute;vel pelo Sistema:</div>
                    <input name="fresponsavel" type="text" class="componente_miolo" maxlength="200" value="<?php echo $editar->intranet_sistemas_resp_nome; ?>" /><br />     
                    <div class="texto_formulario">Telefone do Respons&aacute;vel:</div>
                    <input name="ftelresponsavel" type="text" class="componente_pequeno" maxlength="9" value="<?php echo $editar->intranet_sistemas_resp_fone; ?>"/> Ex.: 3251-0000<br /> 
                    <div class="texto_formulario">E-mail do Respons&aacute;vel:</div>
                    <input name="femailresponsavel" type="text" class="componente_miolo" maxlength="200" value="<?php echo $editar->intranet_sistemas_resp_mail; ?>" /><br /> <br />  
                    <hr size="1" /> <br />
					<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" /> 
				</form>
			</div>
		</div>
	</div>
</div><!-- fim coluna_C2 -->  
<?php
	}
	else{
		$id=				$_POST['FsistId'];
		$Tresponsavel=      $_POST["fresponsavel"];
		$TtelResponsavel=   $_POST["ftelresponsavel"];
		$TemailResponsavel= $_POST["femailresponsavel"];	
		$Tentidade=			$_POST["fentidade"];
		$Tnome=				$_POST["fnome"];
		$TtagBusca=			$_POST["Ftags"];
		$Tdescricao=		$_POST["fdescricao"];
		$Tendereco=			$_POST["fendereco"];
		if ($_POST["fexibirServico"]==0){
		$TexibirServico='f';
		}
		if ($_POST["fexibirServico"]==1){
		$TexibirServico='t';
		}
		//########################## insere os valores novos nos campos ####################
		$sql="UPDATE intranet_sistemas
						SET
							   intranet_sistemas_id='$id',
							   intranet_sistemas_nome='$Tnome',
							   intranet_sistemas_tags='$TtagBusca',
							   intranet_sistemas_descricao='$Tdescricao',
							   intranet_sistemas_endereco='$Tendereco',
							   intranet_sistemas_exibirweb='$TexibirServico',
							   intranet_sistemas_resp_nome='$Tresponsavel',
							   intranet_sistemas_resp_fone='$TtelResponsavel',
							   intranet_sistemas_resp_mail='$TemailResponsavel'
						WHERE  
								intranet_sistemas_id=$id";
		//########################## retorno ##########################		
		$Tretorno=$drive->pedido($sql);
		
		if($Tretorno == true){
			echo"<script>alert(\"Sistema Editado com Sucesso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=sistedit&menu=".$_GET['menu']."&id=".$id."\";</script>");
		}else{
			echo"<script>alert(\"Nao foi possivel Editar o Sistema!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=sistedit&menu=".$_GET['menu']."&id=".$id."\";</script>");
		}
	}
?>
