<?php 
if(!isset($_POST['btInc_x'])){ 
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">incluir sistema</div>
	<div id="margem_direita"><br>
		   
  		<div class="conteudo_abas">
			<div id="conteudo_dados" style="display:inline">
           		<form name="cadastro" method="POST">     
                    <div class="texto_formulario">Nome:</div>
                    <input name="fnome" id="fnome" type="text" class="componente_miolo" maxlength="100" /><br>
                    <script type="text/javascript">
						var fnome = new LiveValidation('fnome'); 
						fnome.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script>  
                    <div class="container_tags">        
                    <div class="texto_formulario">Tags de Busca:</div>					
					<input type="text"id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" />Dica: cadastre tamb&eacute;m o nome do sistema como TAG de busca. <br>  
                    </div>
                    <script type="text/javascript">
						var Ftags = new LiveValidation('Ftags'); 
						Ftags.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script> 
                    <div class="texto_formulario">Descrição:</div>
                    <label>
                    <textarea name="fdescricao" id="textarea" class="componente_miolo" cols="45" rows="7"></textarea>
                    </label>
                    <script type="text/javascript">
						var textarea = new LiveValidation('textarea'); 
						textarea.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script> 
                    <br><br>
                    <span class="texto_formulario">Endereço on-line:</span> <br />
                    <input name="fendereco" id="fendereco" type="text" class="componente_miolo" maxlength="100" /><br>
                    <script type="text/javascript">
						var fendereco = new LiveValidation('fendereco'); 
						fendereco.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script> 
                    Exemplo: http://www.meuendereco.com.br<br />
          			<div class="texto_formulario"><input name="fexibirServico" type="checkbox" value="1"/>Exibir Serviço na Intranet ?</div>
          			(Caso não esteja pronto, o serviço pode ficar em modo de edição)
          			<br><br>
                    <hr size="1" />
                    Dados Suporte:<br />
                    <div class="texto_formulario">Respons&aacute;vel pelo Sistema:</div>
                    <input name="fresponsavel" id="fresponsavel" type="text" class="componente_miolo" maxlength="200" /><br />    
                    <script type="text/javascript">
						var fresponsavel = new LiveValidation('fresponsavel'); 
						fresponsavel.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script>  
                    <div class="texto_formulario">Telefone do Respons&aacute;vel:</div>
                    <input name="ftelresponsavel" id="ftelresponsavel" type="text" class="componente_pequeno" maxlength="9" /> Ex.: 3251-0000<br /> 
                    <script type="text/javascript">
						var ftelresponsavel= new LiveValidation('ftelresponsavel');
						ftelresponsavel.add(Validate.Presence, {failureMessage: "Obrigatorio"});
						ftelresponsavel.add(Validate.Length, {minimum: 9, tooShortMessage: "Telefone Inválido"} );
						ftelresponsavel.add(Validate.Format, {pattern: new RegExp(/^\d{4}-?\d{4}$/), failureMessage: "Telefone Inválido" }); 
					</script> 
                    <div class="texto_formulario">E-mail do Respons&aacute;vel:</div>
                    <input name="femailresponsavel" id="femailresponsavel" type="text" class="componente_miolo" maxlength="200" /><br /> <br />  
                    <script type="text/javascript">
						var femailresponsavel = new LiveValidation('femailresponsavel');
						femailresponsavel.add( Validate.Email, {failureMessage: "E-mail Ibaválido"}  ); 
						femailresponsavel.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
					</script> 
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
	$Tentidade        =$_SESSION['SuserEnt'];
	$Tresponsavel     =$_POST["fresponsavel"];
	$TtelResponsavel  =$_POST["ftelresponsavel"];
	$TemailResponsavel=$_POST["femailresponsavel"];
	$Tnome            =$_POST["fnome"];
	$TtagBusca        =$_POST["Ftags"];
	$Tdescricao       =$_POST["fdescricao"];
	$Tendereco        =$_POST["fendereco"];
	if ($_POST["fexibirServico"]==1){
		$TexibirServico=1;
	}else{
		$TexibirServico=0;
	}
	//------------- faz a inserção no banco ---------------
	$sql="INSERT INTO intranet_sistemas
		VALUES(
			default,
			'$Tnome',
			'$TtagBusca',
			'$Tdescricao',
			'$Tendereco',
			'$TexibirServico',
			'$Tentidade',
			'$Tresponsavel',
			'$TtelResponsavel',
			'$TemailResponsavel'
			)";
	//----------- retorno---------
	$retorno=$drive->pedido($sql);
	if($retorno == true){
			echo("<script>alert('Sistema incluido com Sucesso')</script>");	
			echo("<script>window.location = \"inicio.php?pagina=sistinclui&menu=".$_GET['menu']."\";</script>");
		}else{
			echo("<script>alert('Nao foi possivel incluir o Sistema')</script>");
			echo("<script>window.location = \"inicio.php?pagina=sistinclui&menu=".$_GET['menu']."\";</script>");
		}
};
?>
  

