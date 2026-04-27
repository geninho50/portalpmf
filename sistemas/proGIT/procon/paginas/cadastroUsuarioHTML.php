<?php 

print '

	<div id="busca-home" class="search-bar search-bar--home column6-lg column10-sm column10-xs">
		<h1 class="hidden-sm hidden-xs">Cadasto de Consumidor</h1><br>

						
		<div class="row">
		
			<div class="col-md-3">
				<label>CPF:</label><input value="" id="cpf" name="cpf" maxlength="11" class="form-control" type="text" placeholder="Somente números" />
			</div>   
			
			<div class="col-md-4">
				<label>Nome:</label><input value="" name="nome" id="nome" maxlength="100" class="form-control" type="text"/>
			</div>

			 <div class="col-md-2">
				<label>Identidade:</label><input value="" id="rg" name="rg" maxlength="15" class="form-control" type="text" />
			</div>   
			
			 <div class="col-md-3">
				<label>Profissão:</label><input value="" id="profissao" name="profissao" maxlength="50" class="form-control" type="text" />
			</div>   
		</div><br>		
		
		<div class="row">    
			<div class="col-md-2">
				<label>CEP:</label><input id="cep" name="cep" class="form-control" maxlength="8" type="text" placeholder="Somente números" />	
				<input type="button" class="btn btn-secondary botao" value="Buscar" onclick="filtroCEP( 0 );"  />	
			</div>			

			<div class="col-md-5">
				<label>Logradouro:</label><input id="logradouro" name="logradouro" class="form-control" maxlength="80" type="text"/>		          
			</div>			

			<div class="col-md-2">
				<label>N&uacute;mero:</label><input id="numero" name="numero" maxlength="10" class="form-control" type="text"/>		          
			</div>			

			<div class="col-md-3">
				<label>Complemento:</label><input id="complemento" name="complemento" maxlength="20" class="form-control" type="text"/>		          
			</div>			
		</div><br>
		
		<div class="row">    
			<div class="col-md-3">
				<label>Bairro:</label><input id="bairro" name="bairro" class="form-control" maxlength="50" type="text"/>		          
			</div>			

			<div class="col-md-3">
				<label>Munic&iacute;pio:</label><input id="municipio" name="municipio" class="form-control" maxlength="50" type="text" value="Florianópolis" />		          
			</div>			

			<div class="col-md-3">
				<label>Estado:</label>
				<select id="estado" name="estado" class="form-control" >
					<option value="SC"  Selected = "Selected" >Santa Catarina</option>
				</select>		          
			</div>			
		   
		   <div class="col-md-3">
				<label>E-mail:</label><input value="" id="email" name="email" class="form-control" onblur="validacaoEmail(this)" type="text" maxlength="50" />
			</div>
		</div><br>				
		
		<div class="row">
			<div class="col-md-3">
				<label>Celular:</label><input value="" id="celular" name="celular" class="form-control" type="text" maxlength="14" placeholder="(99)99999-9999" />
			</div>   
			
			 <div class="col-md-3">
				<label>Telefone:</label><input value="" id="telefone" name="telefone" class="form-control" type="text"  maxlength="14" placeholder="(99)9999-9999" />
			</div>   				
		
			<div class="col-md-3">
				<label>*** - Senha: </label><input id="senha" name="senha" class="form-control" type="password" maxlength="8" />		          
			</div>

			<div class="col-md-3">
				<label>*** - Repita a senha:</label><input id="repitaSenha" name="repitaSenha" class="form-control" type="password" maxlength="8" />		          
			</div>
		</div><br>				
		
		<div class="row">
		

			<div class="col-md-6">
			<label>* - Documentos ( Em formato pdf ou jpg / Máximo de 400 KB ):</label><input id="fileDocumento" name="fileDocumento" class="form-control" type="file"  accept="documento/pdf, image/x-png,image/jpeg" />
			</div>
			
			<div class="col-md-6">
				<label>** - Procura&ccedil;&atilde;o ( Em formato pdf ou jpg / Máximo de 400 KB ) :</label><input id="fileProcurador" name="fileProcurador" class="form-control" type="file" accept="documento/pdf, image/x-png,image/jpeg" />
			</div>

		</div>				
	<br><br>

	<div class="row">
	 <div class="col-md-12">
		<input type="button" class="btn btn-primary botao" value="Salvar" onclick="salvarUsuario();" />
		<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1.1);" />
		<input type="button" class="btn btn-secondary botao" value="Limpar" onclick="montarTela(8);" />
	</div>

	<div class="col-md-12">
		<h2 class="hidden-sm hidden-xs">*   - Arquivo com os documentos RG com CPF ou Carteira de Motorista e comprovante de resid&ecirc;ncia(Agua e Luz) </h2>
		<h2 class="hidden-sm hidden-xs">**  - Arquivo com a procura&ccedil;&atilde;o da pessoa autorizando </h2>
		<h2 class="hidden-sm hidden-xs">*** - No máximo 8 (oito) e no minímo 4 (quatro) caracteres </h2>
	</div>
	</div>
</div>

 <script type="text/javascript">  
	/* $("#telefone").mask("(99)9999-9999");
	$("#celular").mask("(99)99999-9999");
	$("#cpf").mask("999.999.999-99");	
	$("#cep").mask("99.999-999");*/
 </script>
 
';
?>	

<!-- 
<select id="estado" name="estado" class="form-control" >
					<option value="AC">Acre</option>
					<option value="AL">Alagoas</option>
					<option value="AP">Amapá</option>
					<option value="AM">Amazonas</option>
					<option value="BA">Bahia</option>
					<option value="CE">Ceará</option>
					<option value="DF">Distrito Federal</option>
					<option value="ES">Espírito Santo</option>
					<option value="GO">Goiás</option>
					<option value="MA">Maranhão</option>
					<option value="MT">Mato Grosso</option>
					<option value="MS">Mato Grosso do Sul</option>
					<option value="MG">Minas Gerais</option>
					<option value="PA">Pará</option>
					<option value="PB">Paraíba</option>
					<option value="PR">Paraná</option>
					<option value="PE">Pernambuco</option>
					<option value="PI">Piauí</option>
					<option value="RJ">Rio de Janeiro</option>
					<option value="RN">Rio Grande do Norte</option>
					<option value="RS">Rio Grande do Sul</option>
					<option value="RO">Rondônia</option>
					<option value="RR">Roraima</option>
					<option value="SC"  Selected = "Selected" >Santa Catarina</option>
					<option value="SP">São Paulo</option>
					<option value="SE">Sergipe</option>
					<option value="TO">Tocantins</option>
				</select>
 -->