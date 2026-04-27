<?php 

print '	
			<div id="busca-home" class="search-bar search-bar--home column6-lg column10-sm column10-xs">
		        <h1 class="hidden-sm hidden-xs">Fa&ccedil;a aqui a sua reclamação</h1><br>

	            <div class="row">
				    <h2 class="hidden-sm hidden-xs"><b>Cadastro do Fornecedor</b></h2>
				</div><br>	           	
		 		<div class="row">
		            <div class="col-md-3">
		                <label>Nome:</label><input value="" id="nome" name="nome" maxlength="100" class="form-control" type="text"/>
		            </div>

		             <div class="col-md-3">
		                <label>CPF\CNPJ:</label><input value="" id="cpf" name="cpf" maxlength="14" class="form-control" type="text" />
		            </div>   

		             <div class="col-md-3">
		                <label>Celular:</label><input value="" id="celular" name="celular" class="form-control" maxlength="14" type="text" />
		            </div>   
					
		             <div class="col-md-3">
		                <label>Telefone:</label><input value="" id="telefone" name="telefone" class="form-control" maxlength="14" type="text" />
		            </div>   
				</div><br>		
				
			    <div class="row">    
					<div class="col-md-3">
		                <label>CEP:</label><input id="cep" name="cep"  class="form-control" type="text"/>	
						<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8" onclick="buscarCEP();" />	
		            </div>			

					<div class="col-md-3">
		                <label>Rua:</label><input id="logradouro" name="logradouro" class="form-control" type="text" maxlength="80" />		          
		            </div>			

					<div class="col-md-3">
		                <label>N&uacute;mero:</label><input id="numero" name="numero" class="form-control" type="text" maxlength="10"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Complemento:</label><input id="complemento" name="complemento" class="form-control" type="text" maxlength="20" />		          
		            </div>			
				</div><br>
				
			    <div class="row">    
					<div class="col-md-3">
		                <label>Bairro:</label><input id="bairro" name="bairro" class="form-control" maxlength="50" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Mun&iacute;cipio:</label><input id="municipio" name="municipio" class="form-control" maxlength="50" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Estado:</label>
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
		            </div>			
   	               
				   <div class="col-md-3">
		                <label>Email:</label><input value="" id="email" name="email" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
		            </div>
				</div><br><br>				

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Salvar" onclick="salvarFornecedor();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(7);" />
			</div>
			</div>
		</div>
	

 <script type="text/javascript">
	$("#telefone").mask("(99)9999-9999");
	$("#celular").mask("(99)99999-9999");
	$("#cep").mask("99.999-999");
</script>';
?>