<?php 

print '
<section>
	<div class="full-title5">
		<div class="container">
			<!-- Page Heading/Breadcrumbs -->
			<h1 class="mt-4 mb-3">Cadastro do Respons&aacute;vel pela Horta</h1>
		</div>
	</div><br>
	<div class="container">
			<ul  class="nav nav-tabs">	
				<li  id="li3" Class="active" ><a onclick="" onmouseover="" style="cursor:pointer;" >Dados Gerais</a></li>
			</ul><br>
		<br>
			<div class="row">

				<div class="col-md-10 col-xs-10">
					<div class="form-group">
						<label>Nome do Responsável</label><input value="" class="form-control" id="nome" name="nome" data-width="100%" required>
					</div>
				</div>
				<div class="col-md-3 col-xs-3">
					<div class="form-group">
						<label>CPF</label><input value="" class="form-control" id="cpf" name="cpf" data-width="100%" required>
					</div>
				</div>
				<div class="col-md-4 col-xs-4">
					<div class="form-group">
						<label>Identidade</label><input value="" class="form-control" id="rg" name="rg" data-width="100%" required>
					</div>
				</div>				
				<div class="col-md-5 col-xs-5">
					<div class="form-group">
						<label>Email do responsável</label><input value="" class="form-control" id="email" name="email" data-width="100%" required>
					</div>
				</div>				
				<div class="col-md-2 col-xs-2">
					<div class="form-group">
						<label>CEP</label><input value="" class="form-control" id="cep" name="cep" data-width="100%" required>
					</div>
				</div>
			
				<div class="col-md-1" style="background-color:#white;">
					<label>... </label><input type="button" value="Buscar" onclick="filtro()" class="btn btn-info  btn-small ">	
				</div>
				<div class="col-md-4" style="background-color:#white;">
					<label>Logradouro</label><input id="logradouro" name="logradouro" class="form-control" maxlength="80" type="text"/>		          
				</div>			
				<div class="col-md-2" style="background-color:#white;">
					<label>N&uacute;mero</label><input id="numero" name="numero" maxlength="10" class="form-control" type="text"/>		          
				</div>			
				<div class="col-md-3" style="background-color:#white;">
					<label>Complemento</label><input id="complemento" name="complemento" maxlength="20" class="form-control" type="text"/>		          
				</div>			

				<div class="col-md-3" style="background-color:#white;">
					<label>Bairro</label><input id="bairro" name="bairro" class="form-control" maxlength="50" type="text"/>		          
				</div>			
				<div class="col-md-3" style="background-color:#white;">
					<label>Mun&iacute;cipio</label><input id="municipio" name="municipio" class="form-control" maxlength="50" type="text"/>		          
				</div>			
				<div class="col-md-2" style="background-color:#white;">
					<label>Estado</label>
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
				<div class="col-md-2" style="background-color:#white;">
					<label>Celular</label><input value="" id="celular" name="celular"  class="form-control" type="text" maxlength="14" />
				</div>   
					<div class="col-md-2" style="background-color:#white;">
					<label>Telefone</label><input value="" id="telefone" name="telefone" class="form-control" type="text"  maxlength="14" />
				</div>   	

				<div class="col-md-3" style="background-color:#white;">
					<label>Senha (*)  </label><input id="senha" name="senha"  class="form-control" type="password" maxlength="8" />		          
				</div>
				<div class="col-md-3" style="background-color:#white;">
					<label>Repita a senha:</label><input id="repitaSenha" class="form-control" type="password" maxlength="8" />		          
				</div>
				<br><br><div class="col-md-12"><label>* - No mínimo 4 e no máximo 8 caracteres.</label></div><br><br>
							
				<div class="col-md-12"><br>
					<div class="col-md-3">
						<input type="button" onclick="salvarUsuario();" value="Salvar" class="btn btn-success btn-medium">
					</div><br>
				</div>
						    
			</div>
		</div>
	
    </div>
</section>';		

?>