<?php 

print '	<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Cadastro reclamação</h1><br>

	            <div class="row">
				    <h2 class="hidden-sm hidden-xs"><b>Informe o(s) dado(s) do(s) Fornecedor(es) abaixo : </b></h2>
				</div><br>	       
				
                <!-- Fornecedor 1 -->				
		 		
				<div class="row">
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:</label><input value="" id="cpf1" name="cpf1" maxlength="14" class="form-control" type="text" placeholder="Somente números" onKeyUp="verificarCPF(1);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome1" name="nome1" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular1" name="celular1"  class="form-control" maxlength="14"  placeholder="Somente números"type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone1" name="telefone1"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep1" name="cep1"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(1);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro1" name="logradouro1" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero1" name="numero1" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento1" name="complemento1" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro1" name="bairro1" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio1" name="municipio1" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado1" name="estado1" class="form-control" >
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
							<label>Email:</label><input value="" id="email1" name="email1" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>
				</div>
				
				<!-- Fornecedor 2 -->
				
				<div class="row" style="display:none;" id="divFornecedor2" >
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:(2)</label><input value="" id="cpf2" name="cpf2" maxlength="14" class="form-control" type="text" placeholder="Somente números"  onKeyUp="verificarCPF(2);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome2" name="nome2" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular2" name="celular2"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone2" name="telefone2"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep2" name="cep2"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(2);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro2" name="logradouro2" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero2" name="numero2" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento2" name="complemento2" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro2" name="bairro2" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio2" name="municipio2" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado2" name="estado2" class="form-control" >
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
							<label>Email:</label><input value="" id="email2" name="email2" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>
				</div>	
				
				<!-- Fornecedor 3 -->
				
				<div class="row" style="display:none;" id="divFornecedor3" >
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:(3)</label><input value="" id="cpf3" name="cpf3" maxlength="14" class="form-control" type="text" placeholder="Somente números"  onKeyUp="verificarCPF(3);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome3" name="nome3" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular3" name="celular3"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone3" name="telefone3"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep3" name="cep3"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(3);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro3" name="logradouro3" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero3" name="numero3" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento3" name="complemento3" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro3" name="bairro3" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio3" name="municipio3" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado3" name="estado3" class="form-control" >
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
							<label>Email:</label><input value="" id="email3" name="email3" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>
				</div>	
				
				<!-- Fornecedor 4 -->
				
				<div class="row" style="display:none;" id="divFornecedor4" >					
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:(4)</label><input value="" id="cpf4" name="cpf4" maxlength="14" class="form-control" type="text" placeholder="Somente números"  onKeyUp="verificarCPF(4);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome4" name="nome4" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular4" name="celular4"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone4" name="telefone4"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep4" name="cep4"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(4);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro4" name="logradouro4" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero4" name="numero4" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento4" name="complemento4" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro4" name="bairro4" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio4" name="municipio4" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado4" name="estado4" class="form-control" >
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
							<label>Email:</label><input value="" id="email4" name="email4" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>			
				</div>
			
				<!-- Fornecedor 5 -->
					
				
				<div class="row" style="display:none;" id="divFornecedor5" >					
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:(5)</label><input value="" id="cpf5" name="cpf5" maxlength="14" class="form-control" type="text" placeholder="Somente números"  onKeyUp="verificarCPF(5);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome5" name="nome5" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular5" name="celular5"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone5" name="telefone5"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep5" name="cep5"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(5);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro5" name="logradouro5" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero5" name="numero5" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento5" name="complemento5" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro5" name="bairro5" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio5" name="municipio5" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado5" name="estado5" class="form-control" >
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
							<label>Email:</label><input value="" id="email5" name="email5" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>			
				</div>				
				
				<!-- Fornecedor 6 -->
				
				<div class="row" style="display:none;" id="divFornecedor6" >					
					<div class="row">
					
						 <div class="col-md-2">
							<label>CPF\CNPJ:(6)</label><input value="" id="cpf6" name="cpf6" maxlength="14" class="form-control" type="text" placeholder="Somente números"  onKeyUp="verificarCPF(6);" />
						</div>   					
						<div class="col-md-6">
							<label>Nome:</label><input value="" id="nome6" name="nome6" maxlength="100" class="form-control" type="text"/>
						</div>

						 <div class="col-md-2">
							<label>Celular:</label><input value="" id="celular6" name="celular6"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
						
						 <div class="col-md-2">
							<label>Telefone:</label><input value="" id="telefone6" name="telefone6"  class="form-control" maxlength="14"  placeholder="Somente números" type="text" />
						</div>   
					</div><br>		
					
					<div class="row">    
						<div class="col-md-2">
							<label>CEP:</label><input  placeholder="Somente números"  id="cep6" name="cep6"  class="form-control" type="text"/>	
							<input type="button" class="btn btn-secondary botao" value="Buscar" maxlength="8"  placeholder="Somente números" onclick="buscarCEP(6);" />	
						</div>			

						<div class="col-md-5">
							<label>Rua:</label><input id="logradouro6" name="logradouro6" class="form-control" type="text" maxlength="80" />		          
						</div>			

						<div class="col-md-2">
							<label>N&uacute;mero:</label><input id="numero6" name="numero6" class="form-control" type="text" maxlength="10"/>		          
						</div>			

						<div class="col-md-3">
							<label>Complemento:</label><input id="complemento6" name="complemento6" class="form-control" type="text" maxlength="20" />		          
						</div>			
					</div><br>
					
					<div class="row">    
						<div class="col-md-3">
							<label>Bairro:</label><input id="bairro6" name="bairro6" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Mun&iacute;cipio:</label><input id="municipio6" name="municipio6" class="form-control" maxlength="50" type="text"/>		          
						</div>			

						<div class="col-md-3">
							<label>Estado:</label>
							<select id="estado6" name="estado6" class="form-control" >
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
							<label>Email:</label><input value="" id="email6" name="email6" class="form-control" maxlength="50" type="text" onblur="validacaoEmail(this)" />
						</div>
					</div>
					<hr>			
				</div><br>
				<div class="row">
					 <div class="col-md-6">
					   <label><input type="button" class="btn btn-primary botao" value="Adicionar outro fornecedor" onclick="adicionarFornecedor();" /></label>
					</div>
				</div>
				<br><br>								
			    <div class="row">
				    <h2 class="hidden-sm hidden-xs"><b>Informe os dados da Reclamação a baixo :</b></h2>
				</div><br>	     
				<div class="row">
		            <div class="col-md-9">
		               <label>Assunto (Ex.: Cobrança indevida, não cumprimento à oferta, produto fora de validade ...... ) :</label>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-9">
						  <input value="" id="assunto" name="assunto" maxlength="100" class="form-control" type="text" /> 
					</div>
				</div><br>				
				<div class="row">
		            <div class="col-md-9">
		               <label>Relato detalhado do que ocorreu:</label>
		            </div>
				</div>							
				<div class="row">	
					<div class="col-md-9">
		                <textarea id="relato" name="relato"  rows="5" cols="100" class="form-control" ></textarea>
		            </div>
				</div><br>

				<div class="row">
		            <div class="col-md-9">
		                <label>Pedido do consumidor (Ex.: Troca do produto, devolução de valor pago, cumprir o contrato, etc.):</label>
		            </div>
				</div>				
				<div class="row">	
					<div class="col-md-9">
		                <textarea id="pedido" name="pedido" rows="5" cols="100" class="form-control" ></textarea>
		            </div>
				</div><br>
				
				<div class="row">
		            <div class="col-md-3">
		                <label>* - Documentos 1 ( Em formato pdf ou jpg / Maxímo de 400 KB ): </label>
						<input value="" id="fileDocumento1" name="fileDocumento1" class="form-control" type="file" accept="documento/pdf, image/x-png,image/jpeg" />
		            </div>

			        <div class="col-md-3">
		                <label>* - Documentos 2 ( Em formato pdf ou jpg / Maxímo de 400 KB ) :</label>
						<input value="" id="fileDocumento2" name="fileDocumento2" class="form-control" type="file" accept="documento/pdf, image/x-png,image/jpeg" />
		            </div>
					
		            <div class="col-md-3">
		                <label>* - Documentos 3 ( Em formato pdf ou jpg / Maxímo de 400 KB ) :</label>
						<input value="" id="fileDocumento3" name="fileDocumento3" class="form-control" type="file" accept="documento/pdf, image/x-png,image/jpeg" />
		            </div>
				</div>				
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Salvar" onclick="salvarReclamacao();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(7);" />
			</div>
			<div class="col-md-12">
				<div class="g-recaptcha" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div>
			</div>
			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs">*  - Documentos da relação de consumo. Exemplos: contrato, nota fiscal, ordem de serviço etc. </h2>				
			</div>
			</div>
		</div>
	</div>
	 <script type="text/javascript">  
	 /* $("#telefone1").mask("(99)9999-9999");
		$("#telefone2").mask("(99)9999-9999");
		$("#telefone3").mask("(99)9999-9999");
		$("#telefone4").mask("(99)9999-9999");
		$("#telefone5").mask("(99)9999-9999");
		$("#telefone6").mask("(99)9999-9999");
		
		$("#celular1").mask("(99)99999-9999");
		$("#celular2").mask("(99)99999-9999");
		$("#celular3").mask("(99)99999-9999");
		$("#celular4").mask("(99)99999-9999");
		$("#celular5").mask("(99)99999-9999");
		$("#celular6").mask("(99)99999-9999");	
		
		$("#cep1").mask("99.999-999");
		$("#cep2").mask("99.999-999");
		$("#cep3").mask("99.999-999");
		$("#cep4").mask("99.999-999");
		$("#cep5").mask("99.999-999");
		$("#cep6").mask("99.999-999"); */
	 </script>	
	
	
	
	';
?>