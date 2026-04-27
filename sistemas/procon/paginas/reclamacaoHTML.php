<?php 

print '	<div class="flex-container hero-wrapper" id="FNCsolicite" >
			<div id="FNCbusca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Fa&ccedil;a aqui a sua reclamação</h1><br>

	            <div class="row">
				    <h2 class="hidden-sm hidden-xs"><b>Cadastro do Fornecedor</b></h2>
				</div><br>	           	
		 		<div class="row">
		            <div class="col-md-3">
		                <label>Nome:</label><input value="" id="FNCnome" class="form-control" type="text"/>
		            </div>

		             <div class="col-md-3">
		                <label>CPF\CNPJ:</label><input value="" id="FNCcpf" name="cpf" class="form-control" type="text" />
		            </div>   

		             <div class="col-md-3">
		                <label>Celular:</label><input value="" id="FNCcelular" class="form-control" type="text" />
		            </div>   
					
		             <div class="col-md-3">
		                <label>Telefone:</label><input value="" id="FNCtelefone" class="form-control" type="text" />
		            </div>   
				</div><br>		
				
			    <div class="row">    
					<div class="col-md-3">
		                <label>CEP:</label><input id="FNCcep" class="form-control" type="text"/>	
						<input type="button" class="btn btn-secondary botao" value="Buscar" onclick="buscarCEPF();" />	
		            </div>			

					<div class="col-md-3">
		                <label>Rua:</label><input id="FNCrua" class="form-control" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>N&uacute;mero:</label><input id="FNCnumero" class="form-control" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Complemento:</label><input id="FNCcomplemento" class="form-control" type="text"/>		          
		            </div>			
				</div><br>
				
			    <div class="row">    
					<div class="col-md-3">
		                <label>Bairro:</label><input id="FNCbairro" class="form-control" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Mun&iacute;cipio:</label><input id="FNCmunicipio" class="form-control" type="text"/>		          
		            </div>			

					<div class="col-md-3">
		                <label>Estado:</label>
						<select id="FNCestado" name="FNCestado" class="form-control" >
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
		                <label>Email:</label><input value="" id="FNCemail" class="form-control" type="text"/>
		            </div>
				</div><br><br>				
			    <div class="row">
				    <h2 class="hidden-sm hidden-xs"><b>Dados da Reclamação</b></h2>
				</div><br>	     
				
				<div class="row">
		            <div class="col-md-9">
		                <label>Relato detalhado do que ocorreu:</label>
		            </div>
				</div>				
				<div class="row">	
					<div class="col-md-9">
		                <textarea id="relato" rows="5" cols="100" class="form-control" ></textarea>
		            </div>
				</div><br>

				<div class="row">
		            <div class="col-md-9">
		                <label>Pedido do consumidor (exemplos: troca do produto, devolução de valor pago, cumprimento do contrato, etc.):</label>
		            </div>
				</div>				
				<div class="row">	
					<div class="col-md-9">
		                <textarea id="pedido" rows="5" cols="100" class="form-control" ></textarea>
		            </div>
				</div><br>
				
				<div class="row">

		            <div class="col-md-3">
		                <label>* - Documentos 1 :</label><input value="" id="FNCfileDocumento1" class="form-control" type="file"/>
		            </div>

			        <div class="col-md-3">
		                <label>* - Documentos 2 :</label><input value="" id="FNCfileDocumento2" class="form-control" type="file"/>
		            </div>
					
		            <div class="col-md-3">
		                <label>* - Documentos 3 :</label><input value="" id="FNCfileDocumento3" class="form-control" type="file"/>
		            </div>
				</div>				
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Salvar" onclick="salvar();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1);" />
			</div>

			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs">*  - Documentos da relação de consumo. Exemplos: contrato, nota fiscal, ordem de serviço etc. </h2>				
			</div>
			</div>
		</div>
	</div>

 <script type="text/javascript">
	$("#FNCtelefone").mask("(99)9999-9999");
	$("#FNCcelular").mask("(99)99999-9999");
	$("#FNCcpf").mask("999.999.999-99");	
	$("#FNCcep").mask("99.999-999");
</script>';
?>