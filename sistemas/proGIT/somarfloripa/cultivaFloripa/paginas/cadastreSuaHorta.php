<?php 

print '
<section>

			<div class="full-title6">
				<div class="container">
					<!-- Page Heading/Breadcrumbs -->
					<h1 class="mt-4 mb-3">CADASTRE SUA HORTA</h1>
				</div>
			</div>

			<br>
           <div class="container">
					<ul  class="nav nav-tabs">	
						<li  id="li3" Class="active" ><a onclick="" onmouseover="" style="cursor:pointer;" ></a></li>
					</ul><br>

				<div class="row">
				  <div class="col-md-5 col-xs-5">
						<div class="form-group">
						  <label for="text">Nome da Horta/Projeto</label>
						  <input type="text" id="nomeHorta" class="form-control" data-live-search="true" data-width="100%" name="Nome da Horta/Projeto" required>
						</div>
				  </div>
				  
				  <div class="col-md-5 col-xs-5">
						<div class="form-group">
						  <label for="text">Nome do Responsável</label>
						  <input type="text" id="nomeResponsavelHorta" class="form-control" name="Nome do Responsável" placeholder="" required>
						</div>
				  </div>
				  
				   <div class="col-md-2 col-xs-2">
						<div class="form-group">
						  <label for="text">Telefone</label>
						  <input type="tel" id="telefoneHorta" class="form-control" name="Telefone" placeholder="" required>
						</div>
				  </div>
				  
				  <div class="col-md-4 col-xs-4">
					    <div class="form-group">
						  <label for="text">Endereço:</label>
						  <input type="text" id="enderecoHorta" class="form-control" name="volumeBolsa" placeholder="" required>
					    </div>
				  </div>
				  
				  
						  <div class="col-md-3" style="background-color:white;">
							   <label>Bairro</label><input id="bairroHorta" name="bairro" class="form-control" maxlength="50" type="text"/>		          
						  </div>			
						  <div class="col-md-3" style="background-color:white;">
							   <label>Mun&iacute;cipio</label>	
							   <select id="municipioHorta" name="municipio" class="form-control">
							   <option value="Fpolis"  Selected = "Selected" >Florianópolis</option>
							   </select>	          
						  </div>			
						  <div class="col-md-2" style="background-color:white;">
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
				
							<div class="col-md-12 col-xs-12"><br><hr>
								<div class="form-group">
								  <label for="text">A horta é:</label>
								  <form><br> <fieldset>
								  <input type="radio" id="tipoHorta" onclick="validarTipoHorta();" name="tipoHorta" value="I">
								  <label for="male">Institucional</label><br>
								  <input type="radio" id="tipoHorta" onclick="validarTipoHorta();" name="tipoHorta" value="C">
								  

								  
								  <label for="female">Comunitária</label> </fieldset>
								</form> 
								</div>
							</div>
			
			
			
							<div class="col-md-12 col-xs-12"><hr><br>
								<label for="Telefone">Caso seja institucional, indique o tipo:</label>
									<form><br>
										<input type="radio" id="tipoHortaInst" name="tipoHortaInst" value="UM">
										<label for="male">Unidade Escolar Municipal</label><br>
										  
										<input type="radio" id="tipoHortaInst" name="tipoHortaInst" value="UE">
										<label for="female">Unidade Escolar Estadual</label><br>
										  
										<input type="radio" id="tipoHortaInst" name="tipoHortaInst" value="CS">
										<label for="other">Centro de Saúde</label><br>
										  
										<input type="radio" id="tipoHortaInst" name="tipoHortaInst" value="AS">
										<label for="other">Centro de Referência de Assistência Social</label><br>
										  
										<input type="radio" id="tipoHortaInst" name="tipoHortaInst" value="FV">
										<label for="other">Centro de Convivência e Fortalec. de Vínculo</label>
									</form> 
								</div>
							</div>
			
			
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Local é área pública? Caso "SIM" - Anexar cópia do Termo de Autorização de uso</label>
								  <form><br> 
								  <input type="radio" id="hortaPublica" onclick="validarHortaPublica();" name="hortaPublica" value="S">
								  <label for="male">Sim</label> &nbsp;&nbsp;&nbsp;
								  <input type="radio" id="hortaPublica" onclick="validarHortaPublica();" name="hortaPublica" value="N">
								  <label for="female">Não</label><br> 
								</form> 
								Anexar arquivo &nbsp;&nbsp;&nbsp;<input type="file" id="myfile" name="myfile"><br>
								</div>
							</div>
			
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Local é área pública? Caso "SIM" - Anexar cópia do Termo de cessão de uso</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">Sim</label> &nbsp;&nbsp; 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Não</label><br> 
								</form> 
								Anexar arquivo &nbsp;&nbsp;&nbsp;<input type="file" id="myfile" name="myfile"><br>
								</div>
							</div>
			
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Pertence a alguma organização comunitária?</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">Sim</label> &nbsp;&nbsp; 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Não</label><br> 
								</form>
								Se a resposta anterior for sim, qual o nome da organização?<br>
								<textarea name="message" rows="1%" cols="30"></textarea>
								</div>
							</div>
					
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Qual tamanho da área utilizada para a horta? Ex: 100m²= 10mx10m </label>
								  <form> 
								   <textarea name="message" rows="1%" cols="30">
								   </textarea> 
								</form>
								</div>
							</div>

				  			<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Quantidade de canteiros no espaço?</label>
								  <form> 
								   <textarea name="message" rows="1%" cols="30">
								   </textarea> 
								</form>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Tipos de canteiros no espaço? Ex: Rasteiros, elevados, espirais, etc... </label>
								  <form> 
								   <textarea name="message" rows="1%" cols="30">
								   </textarea> 
								</form>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Possui ponto de água no local?</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">Sim</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Não</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Próximo, temos mangueira para acesso</label><br> 
								</form>
								Se a resposta anterior for SIM, qual tipo de captação de água? <br><textarea name="message" rows="1%" cols="30">
								   </textarea>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Possui ponto de luz no local?</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">Sim</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Não</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Próximo, temos extensão para acesso</label><br> 
								</form>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Possui algum tipo de compostagem?</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">Sim</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">Não</label><br>  
								</form>
								Se a resposta anterior for SIM, qual tipo de compostagem? Ex: Leira, vermicompostagem<br><textarea name="message" rows="1%" cols="30"></textarea>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Qual o tipo de cultivo? Ex: Hortaliças, pancs, medicinais</label>
								  <form> 
								   <textarea name="message" rows="1%" cols="30">
								   </textarea> 
								</form>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Quantas pessoas, aproximadamente, estão envolvidas na Horta/Projeto?</label>
								  <form><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">&nbsp;01-05</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">&nbsp;06-10</label><br> 
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">&nbsp;11-15</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">&nbsp;16-20</label><br>
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">&nbsp;21-30</label><br> 
								  <input type="radio" id="female" name="gender" value="female">
								  <label for="female">&nbsp;31-40</label><br>
								  <input type="radio" id="male" name="gender" value="male">
								  <label for="male">&nbsp;Mais de 40</label><br> 
								</form>
								</div>
							</div>
							
							<div class="col-md-13 col-xs-13"><hr><br>
								<div class="form-group">
								  <label for="text">Qual a faixa etária aproximada das pessoas envolvidas?</label>
								  <form><br> 
								  <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="INF">
								  <label for="male">&nbsp;Menores de 6 anos acompanhado dos pais</label><br> 
								  
								  <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="CRI">
								  <label for="female">&nbsp;6 a 15 anos</label><br> 
								  
								  <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="ADO">
								  <label for="male">&nbsp;15 a 20 anos</label><br> 
								  
								  <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="JOV">
								  <label for="female">&nbsp;20 a 40 anos</label><br>
								 
								 <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="ADU">
								  <label for="male">&nbsp;40 a 60 anos</label><br> 
								 
								 <input type="radio" id="tipoIdade" onclick="validarTipoIdade();" name="tipoIdade" value="IDO">
								  <label for="female">&nbsp;acima de 60 anos</label><br>
								</form>
								</div>
							</div>
		
							<div class="col-md-12"><br>
							<div class="col-md-3">
								<input type="button" onclick="salvarNovaHorta();" value="Salvar Informações" class="btn btn-success btn-medium">
							</div><br>
						</div>
			
				<br><br>
			 </div>
	
</section>';		

?>

<!--

	function validarTipoHortaInst(){
				var tipoHortaInst = document.getElementsByName('tipoHortaInst');
				var genValue = false;

				for(var i=0; i<tipoHortaInst.length;i++){
					if(tipoHortaInst[i].checked == true){
						genValue = true;
						alert("papolaa");
					}
				}
				if(!genValue){
					alert("Especifique o tipo da horta!");
					return false;
				}
		}

-->