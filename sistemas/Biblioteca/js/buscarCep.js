
function buscarCEP( num ){
	//Nova variável "cep" somente com dígitos.
	if( num !=0 ){
	    var cep = $("#cep" + num.toString() ).val().replace(/\D/g, '');
	}else{
		var cep = $("#cep").val().replace(/\D/g, '');
	}
	
	//Verifica se campo cep possui valor informado
	if ( cep != ""  ){
	 
		 $("#btnCEP").val("Processando ..."); 
	 
		//Expressão regular para validar o CEP.
		var validacep = /^[0-9]{8}$/;
		 
		//Valida o formato do CEP.
		if(validacep.test(cep)) {
			 
			//Consulta o webservice viacep.com.br
			var urlCEP = "https://viacep.com.br/ws/" + cep + "/json/";
			$.ajax( {
				type: "POST",
				dataType: "jsonp",
				url: urlCEP,
				crossDomain: true,
				contentType:"application/json",
				success: function( dados )  {
					if( num !=0 ){
						$("#logradouro" + num.toString() ).val(dados.logradouro + " " + dados.complemento);
						$("#bairro" + num.toString() ).val(dados.bairro);
						$("#municipio" + num.toString() ).val(dados.localidade);
						$("#estado" + num.toString() ).val(dados.uf);
					}else{
						$("#logradouro").val(dados.logradouro + " " + dados.complemento);
						$("#bairro").val(dados.bairro);
						$("#municipio").val(dados.localidade);
						$("#estado").val(dados.uf);						
					}	
				},
				error : function(dados){
					alert("Erro no retorno de dados !");
				}
			} );
		 
			$("#btnCEP").val("Buscar");
		 
		}
	} //end if.
}