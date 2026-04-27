	function acessarSistema(){
	  
	  if( $("#login").val() =="" ){
		  alert("Informe o login !");	
          $("#login").val("");		  
		  $("#senha").val("");
	  }else if( $("#senha").val() =="" ){
  			    alert("Informe a Senha !");		  
				$("#login").val("");		  
				$("#senha").val("");		  
	  }else{
        data = {
		     "sistema"    : "cliente",
			 "perfil"     : "P",
             "login"      : $("#login").val(),
             "senha"  	  : $("#senha").val(),
			 "recaptcha"  : grecaptcha.getResponse()
			 
        };
		
		data = $( this ).serialize() + "&" + $.param(data);
        
		$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "https://www.pmf.sc.gov.br/sistemas/procon/banco/loginPROCON.php", 
		  data: data,
		  success: function( data ){
					 if( data != '0' && data !='999999'  ){
						 $("#codigoPessoa").val( data );
					     montarTela(7);
					 }else if( data == '999999' ){
							   alert("Este usuário está desativado !"); 
							   $("#login").val("");		  
							   $("#senha").val("");
							   $("#login").focus;  
					 }else{
							alert("O usuário ou senha, esta incorreto! ou é um robo! "); 
							alert( data );
							$("#login").val("");		  
							$("#senha").val("");
							$("#login").focus;
					 }            
				  },
		 error: function( data ){
			console.log( data );
		 }
		} 
		);
	  }	

    }
	
	function filtroCEP(obj){
	if( obj !=0 ){
	    var cep = $("#cep" + num.toString() ).val().replace(/\D/g, '');
	}else{
		var cep = $("#cep").val().replace(/\D/g, '');
	}

	   if( cep.substring(0,3) == "880" ){
		   buscarCEP( obj );
	   }else{
		  alert("Esse CEP não pertence a Florianópolis ");
	   }
	}
	
	function limparCampos(){
		$('#nome').val("");
		$('#cpf').val("");
		$('#email').val("");
		$('#telefone').val("");
		$('#celular').val("");
		$('#cep').val("");
		$('#logradouro').val("");
		$('#numero').val("");
		$('#municipio').val("");
		$('#bairro').val("");
		$('#estado').val("");
		$('#senha').val("");
		$('#rg').val("");				
		$('#fileDocumento').val("");
		$('#fileProcurador').val("");
		$('#complemento').val("");
	}

	function validacaoEmail( field ) {
		if( field.value !="" ){	
			usuario = field.value.substring(0, field.value.indexOf("@"));
			dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
			if ((usuario.length >=1) &&
				(dominio.length >=3) &&
				(usuario.search("@")==-1) &&
				(dominio.search("@")==-1) &&
				(usuario.search(" ")==-1) &&
				(dominio.search(" ")==-1) &&
				(dominio.search(".")!=-1) &&
				(dominio.indexOf(".") >=1)&&
				(dominio.lastIndexOf(".") < dominio.length - 1)) {
				document.getElementById("msgemail").innerHTML="E-mail válido";
				alert("E-mail valido");
			}
			else{
				alert("E-mail invalido");
				field.value = "";
			}
		}
	}

   function alterarSenha(){
	   if( $("#atual").val() =="" && $("#codigoPessoa").val() =="" ){
		  $("#senha").val("");
		  $("#repita").val(""); 
		  alert("Informe a senha atual !");	
		  $("#atual").focus();
	  }else if( $("#repita").val() != $("#senha").val() ){
			  alert("A senha repitida nao e a mesma !");	
			  $("#atual").val("");
			  $("#senha").val("");
			  $("#repita").val("");
			  $("#atual").focus();
	  }else if( $("#atual").val() == $("#senha").val() ){
			  alert("A senha atual e a nova e a mesma !");	
			  $("#atual").val("");
			  $("#senha").val("");
			  $("#repita").val("");
			  $("#atual").focus();
	  }else if ( $('#senha').val().length < 4 ){
				alert("Informe pelo menos 4 (quatro) caracteres na senha !");
				$('#senha').val("");
				$('#repita').val("");
				$("#atual").val("");
				$('#senha').focus();
				return false;
	   }else{
			var arquivoURL = "banco/alterarSenhaBD.php"

			if( confirm("Tem certeza que deseja alterar sua senha ? ") ){
				
				var form = $("#formulario").closest("form");
				var formData = new FormData(form[0]);
						 
				$.ajax({			
					   type: 'POST',
					   url: arquivoURL ,
					   dataType: 'json',
					   data: formData,
					   processData: false,
					   contentType: false,
					   success: function ( data ) {
						   if( data['success'] == 1 ){
							   alert(data['mensagem']);
							   $("#senha").val("");
							   $("#repita").val("");
							   if (typeof atual === 'undefined' || atual === null) {
								   $("#senha").focus();
							   }else{
								   $("#atual").val("");			
								   $("#atual").focus();
							   }
						   }else if( data['success'] == 2 ){
							   alert( data['mensagem'] );
						   }else{
							   alert( data['error'] );
						   }	
						},				   
					   error: function ( data ) {
						  console.log(data);
					   }					
				});
			
			}		  
	  }
   }


    function esqueceuSenha(){

	  if( $("#email").val() =="" ){
		  alert("Informe o email !");	
          $("#email").val("");
	  }else{
        data = {
             "email": $("#email").val(),
        };
		
		data = $( this ).serialize() + "&" + $.param(data);

		$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "banco/esqueceuSenhaBD.php", 
		  data: data,
		  success: function( data ){
					 	if( data['success'] == 1 ){
						   alert( data['mensagem'] );
						   $('#email').val("");					  			  
					   }else{
						   alert(data['mensagem']);
					   }	            
				  },
		 error: function( data ){
			  // alert("Testando : " + data['mensagem']);
			  console.log( data );
		 }
		} 
		);
	  }	

    }

	function Base64Encode(str, encoding = 'utf-8') {
	   var bytes = new (TextEncoder || TextEncoderLite)(encoding).encode(str);        
	   return base64js.fromByteArray(bytes);
	}	

    function enviarDuvida(){
		if( $.trim( $('#nome').val() ) == ""  ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $.trim( $('#email').val() ) == "" ){
			alert("Informe o email!");
			$('#emailD').focus();
			return false;
		}else if( $.trim( $('#duvida').val() ) == "" ){
			alert("Informe a duvida!");
			$('#duvida').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = ''; 
	
			var obj = {
				nome       : $('#nome').val(),
				email      : $('#email').val(),
				duvida     : $('#duvida').val()
			};
			
            if( confirm("Tem certeza deseja enviar ? ") ){
				$.ajax({			
					   type: "POST",
					   url: "banco/enviarDuvidaBD.php",
					   dataType: "json",
					   data: obj,
					   success: function ( data ) {
						   if( data['success'] == 1 ){
							   alert( data['mensagem'] );
							   $('#nome').val("");
							   $('#email').val("");
							   $('#duvida').val("");						  
											  
						   }else{
							   alert(data['error']);
						   }	
						},				   
					   error: function ( data ) {
						  alert( data['error'] );
					   }
					
				});
			}
		
		}
    }
	
	function adicionarFornecedor(){
		if( document.getElementById('divFornecedor2').style.display == 'none' && $('#cpf1').val() !=""  ){
			document.getElementById('divFornecedor2').style.display = 'block';
			$('#cpf2').focus();
		}else if( document.getElementById('divFornecedor3').style.display == 'none' && $('#cpf2').val() !=""  ){
			document.getElementById('divFornecedor3').style.display = 'block';
			$('#cpf3').focus();
		}else if( document.getElementById('divFornecedor4').style.display == 'none' && $('#cpf3').val() !=""  ){
			document.getElementById('divFornecedor4').style.display = 'block';
			$('#cpf4').focus();
		}else if( document.getElementById('divFornecedor5').style.display == 'none' && $('#cpf4').val() !=""  ){
			document.getElementById('divFornecedor5').style.display = 'block';
			$('#cpf5').focus();
		}else if( document.getElementById('divFornecedor6').style.display == 'none' && $('#cpf5').val() !=""  ){
			document.getElementById('divFornecedor6').style.display = 'block';
			$('#cpf6').focus();
		}	
	}
	
	function verificarCPF( ordem ){
		var arquivoURL = "banco/verificaFornecedorBD.php";
		var tam = $("#cpf"+ ordem.toString() ).val().length;
		
		if( tam == 11 || tam == 14 ){
			
			obj = { cpf : $("#cpf"+ ordem.toString() ).val() };
			// alert( $("#cpf"+ ordem.toString() ).val() );
			$.ajax( {
					type:'POST',
					url:arquivoURL,
					dataType: 'json',
					data: obj,
					success: function (data) {
						if( data['MENSAGEM'] !='' ){	
							$("#nome"+ ordem.toString() ).val( data['NOME'] );
							$("#celular"+ ordem.toString() ).val( data['CELULAR'] );
							$("#telefone"+ ordem.toString() ).val( data['TELEFONE'] );
							$("#cep"+ ordem.toString() ).val( data['CEP'] );
							$("#logradouro"+ ordem.toString() ).val( data['LOGRADOURO'] );
							$("#numero"+ ordem.toString() ).val( data['NUMERO'] );
							$("#complemento"+ ordem.toString() ).val( data['COMPLEMENTO'] );
							$("#bairro"+ ordem.toString() ).val( data['BAIRRO'] );
							$("#municipio"+ ordem.toString() ).val( data['MUNICIPIO'] );
							$("#estado"+ ordem.toString() ).val( data['ESTADO'] );
							$("#email"+ ordem.toString() ).val( data['EMAIL'] );
						}
					},
					error: function( data){
						 console.log( data );
					}
				} 
			 );
		}else{
		  if( ordem == 1 ){
			 $("#lb" + ordem.toString() ).html("");
		  }	
		}			
		/**/
	}
	
	function montarTelaLocal(){
		document.getElementById('divMensagem').style.display = 'block';	
		document.getElementById('divMenu').style.display     = 'block';		
		document.getElementById('divUsuario').style.display  = 'none';	
	}
	
	function montarTela(opc){
	 
		var arquivoURL = "";
		var idx        = document.getElementById('loginAcesso');

		if ( opc == 2 ){
			arquivoURL = "paginas/cadastroUsuarioHTML.php";
			limparCampos();
		}else if ( opc == 1.1 ){
			arquivoURL = "../index.php"; 						
			/*document.getElementById('loginAcesso').style.display  = 'none';
			document.getElementById('divMensagem').style.display  = 'block';
			document.getElementById('divMenu').style.display      = 'block';*/
		}else if ( opc == 1 ){
			// arquivoURL = "../index.php"; 
			if ( idx !== null ){			
				 document.getElementById('loginAcesso').style.display  = 'none';
			}
			window.location.href = "https://www.pmf.sc.gov.br/sistemas/procon/index.php";
			// document.getElementById('divMensagem').style.display  = 'block';
			// document.getElementById('divMenu').style.display      = 'block';			
		}else if ( opc == 3 ){
			arquivoURL = "paginas/duvidasHTML.php"; 
		}else if ( opc == 4 ){
			// arquivoURL = "paginas/loginHTML.php";
			document.getElementById('loginAcesso').style.display  = 'block';
			document.getElementById('divMensagem').style.display  = 'none';
			document.getElementById('divMenu').style.display      = 'none';
		}else if ( opc == 5 ){
			arquivoURL = "paginas/esqueceSenhaHTML.php"; 
		}else if ( opc == 6 ){
		    alert("Em beve sera liberado !")
			// arquivoURL = "paginas/acompanharHTML.php"; 
		}else if ( opc == 7 ){
			arquivoURL = "paginas/menuReclamacaoHTML.php";
			document.querySelector("[name='divConteudo']").style.backgroundImage = 'url(images/banner_procon_ponte.jpg)';
		}else if ( opc == 11 ){
			arquivoURL = "paginas/fornecedorHTML.php"; 
		}else if ( opc == 12 ){
			arquivoURL = "paginas/dadosReclamacaoHTML.php"; 
		}else if ( opc == 13 ){
			arquivoURL = "paginas/consultaReclamacaoHTML.php"; 
		}else if ( opc == 14 ){
			arquivoURL = "paginas/alterarSenhaHTML.php"; 
		}else if ( opc == 15 ){
			arquivoURL = "paginas/printReclamacaoHTML.php"; 
		}else if ( opc == 15.1 ){
			arquivoURL = "paginas/menuReclamacaoHTML.php"; 
			$("#codigoReclamacao").val("");
			$("#formulario").attr('action', '');
			$("#formulario").attr('target','_self');
		}else if ( opc == 20 ){
			arquivoURL = "paginas/aberturaHTML.php";
			document.querySelector("[name='divConteudo']").style.backgroundImage = 'url(images/frentePROCONn.jpg)';
			fecharSessao( $("#codigoPessoa").val() );	
			$("#formulario").attr('action', 'https://www.pmf.sc.gov.br/sistemas/procon');
			$("#formulario").attr('target','_self');
			$("codigoPessoa").val("");
			$("codigoReclamacao").val("");			
		}else if ( opc == 8 ){
			if ( confirm("Tem certeza que deseja limpar todos os campos ?") ){
			   limparCampos();
			}
		}
		
		if( opc != 0 && opc != 8 && opc != 6 && opc != 4  && opc != 20 && opc != 1  && opc != 1.1 ){
			if( arquivoURL !="" ){
				$.ajax( {
						type:'GET',
						url:arquivoURL,
						dataType: 'html',
						success: function (data) { 
							$("#divConteudo").html( data );
						},
						error: function( data){
							 console.log( data );
						}
					} 
				);					
				
			}else{ 
			   alert("Não foi informado o arquivo !"); 
		    }
		}

		if( opc == 20 || opc == 1.1 ){
			$("#formulario").submit();
		}
		
		if( opc == 13 ){
			buscaReclamacoes();
		}
   }

   function fecharSessao(codigo ){
		 
	 obj = { codigoPessoa : codigo };
	 
     $.ajax( {
				type:'GET',
				url:'banco/fecharSessaoBD.php',
				data: obj,
				dataType: 'json',
				success: function (data) { 
					return true;
				},
				error: function( data){
					 console.log( data );
				}
			} 
		);
	
   }
   
   function buscaReclamacoes(){
	 
	 obj = { codigoPessoa : $("#codigoPessoa").val() };
	 
     $.ajax( {
				type:'GET',
				url:'banco/consultaReclamacaoBD.php',
				data: obj,
				dataType: 'html',
				success: function (data) { 
					$("#divListaReclamacao").html( data );
				},
				error: function( data){
					 console.log( data );
				}
			} 
		);
   }
   
   function reenviarReclamacao(codigo){
	 
	 obj = { codigoReclamacao : codigo };
	 
     $.ajax( {
				type:'GET',
				url:'banco/reenviarReclamacaoBD.php',
				data: obj,
				dataType: 'json',
				success: function (data) { 
					alert(data['mensagem']);
				},
				error: function( data){
					 console.log( data );
				}
			} 
		);	   
   }
   
   function imprimirComprovante( codigoReclamacao ){
		$("#codigoReclamacao").val( codigoReclamacao );
		$("#formulario").attr('action', 'impressao/reclamacaoPDF.php');
		$("#formulario").attr('target','_blank');
		$("#formulario").submit();
   }
   
   function salvarReclamacao(){
	   
		if( $('#cpf1').val() == "" && $('#cpf2').val() == "" && $('#cpf3').val() == "" && 
		    $('#cpf4').val() == "" && $('#cpf5').val() == "" && $('#cpf6').val() == ""  ){
			alert("Informe 1 (um) fornecedor !");
			$('#cfp1').focus();
			return false;
		}else if( $.trim( $('#assunto').val() ) == "" ){
			alert("Informe o assunto!");
			$('#assunto').focus();
			return false;
		}else if( $.trim( $('#relato').val() ) == "" ){
			alert("Informe o relato!");
			$('#relato').focus();
			return false;
		}else if( $.trim( $('#pedido').val() ) == "" ){
			alert("Informe o pedido!");
			$('#pedido').focus();
			return false;
		}else if( $('#fileDocumento1').val() == "" && $('#fileDocumento2').val() == "" && $('#fileDocumento3').val() == ""  ){
			alert("Informe pelo menos 1 (um) arquivo com os dados da reclamação !");
			$('#fileDocumento1').focus();
			return false;
		}else {
		
			var arquivoURL = "banco/reclamacaoBD.php"

			if( confirm("Tem certeza que deseja finalizar o cadastro ? ") ){
				
				var form = $("#formulario").closest("form");
				var formData = new FormData(form[0]);
						 
				$.ajax({			
					   type: 'POST',
					   url: arquivoURL ,
					   dataType: 'json',
					   data: formData,
					   processData: false,
					   contentType: false,
					   success: function ( data ) {
						   if( data['success'] == 1 ){
							   alert(data['mensagem']);
   							    $("#codigoReclamacao").val( data['codigoReclamacao'] );
							    $("#formulario").attr('action', 'impressao/reclamacaoPDF.php');
							    $("#formulario").attr('target','_blank');
							    montarTela(15);
						   }else if( data['success'] == 2 ){
							   alert( data['mensagem'] );
						   }else{
							   alert( data['error'] );
						   }	
						},				   
					   error: function ( data ) {
						  console.log(data);
					   }					
				});
			
			}
		}
    }
	
     function salvarFornecedor(){
	   
		if( $.trim( $('#nome').val() ) == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o CPF ou CNPJ!");
			$('#cpf').focus();
			return false;
		}else if( $('#cpf').val().length != 11 && $('#cpf').val().length != 14  ){
			alert("Esse número não é CPF e nem CNPJ !");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" && $('#celular').val() == "" ){
			alert("Informe o telefone ou celular!");
			$('#telefone').focus();
			return false;
		}else if( $('#cep').val() == "" ){
			alert("Informe o CEP!");
			$('#cep').focus();
			return false;
		}else if( $('#logradouro').val() == "" ){
			alert("Informe o logradouro!");
			$('#logradouro').focus();
			return false;
		}else {
		
			var arquivoURL = "banco/fornecedorBD.php"

			if( confirm("Tem certeza que deseja finalizar o cadastro ? ") ){
				var form = $("#formulario").closest("form");
				var formData = new FormData(form[0]);
						 
				$.ajax({			
					   type: 'POST',
					   url: arquivoURL ,
					   dataType: 'json',
					   data: formData,
					   processData: false,
					   contentType: false,
					   success: function ( data ) {
						   if( data['success'] == 1 ){
							   alert(data['mensagem']);
								montarTela(7);
						   }else if( data['success'] == 2 ){
							   alert( data['mensagem'] );
						   }else{
							   alert( data['error'] );
						   }	
						},				   
					   error: function ( data ) {
						  console.log(data);
					   }					
				});
			
			}
		}
    }
   
  function salvarUsuario(){
	   
		if( $.trim(  $('#nome').val() ) == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o cpf!");
			$('#cpf').focus();
			return false;
		}else if( !eCPF($('#cpf').val()) ){
			alert("CPF invalido!");
			$('#cpf').focus;
			return false;
		}else if( $.trim( $('#email').val() ) == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" && $('#celular').val() == "" ){
			alert("Informe o telefone ou celular!");
			$('#telefone').focus();
			return false;
		}else if( $('#cep').val() == "" ){
			alert("Informe o CEP!");
			$('#cep').focus();
			return false;
		}else if( $.trim( $('#logradouro').val() ) == "" ){
			alert("Informe o logradouro!");
			$('#logradouro').focus();
			return false;
		}else if( $.trim( $('#senha').val() ) == "" ){
			alert("Informe senha !");
			$('#senha').focus();
			return false;
	   }else if ( $('#senha').val().length < 4 ){
				alert("Informe pelo menos 4 (quatro) caracteres na senha !");
				$('#senha').val("");
				$('#repitaSenha').val("");
				$('#senha').focus();
				return false;
	   }else if( $('#repitaSenha').val() != $('#senha').val() ){
			alert("As senhas são diferentes !");
			$('#repitaSenha').val("");
			$('#senha').val("");
			$('#senha').focus();
			return false;
		}else if( $.trim( $('#profissao').val() ) == "" ){
			alert("Informe a profissão !");
			$('#profissao').focus();
			return false;
		}else if( $('#fileDocumento').val() == "" ){
			alert("Informe o arquivo com os documentos!");
			$('#fileDocumento').focus();
			return false;
		}else {
		
			var arquivoURL = "banco/usuarioBD.php";
			var obj = {
				nome                : $('#nome').val(),
				cpf                 : $('#cpf').val(),
				email               : $('#email').val(),
				telefone            : $('#telefone').val(),
				celular          	: $('#celular').val(),
				cep                 : $('#cep').val(),
				logradouro       	: $('#logradouro').val(),
				numero              : $('#numero').val(),
				municipio           : $('#municipio').val(),
				bairro              : $('#bairro').val(),
				estado              : $('#estado').val(),
				senha               : $('#senha').val(),
				rg                  : $('#rg').val(),				
				fileDocumento       : $('#fileDocumento').val(),
				fileProcurador      : $('#fileProcurador').val(),
				complemento 		: $('#complemento').val()
			};
			
			if( confirm("Tem certeza que deseja finalizar o cadastro ? ") ){
				var form = $("#formulario").closest("form");
				var formData = new FormData(form[0]);
						 
				$.ajax({			
					   type: 'POST',
					   url: arquivoURL ,
					   dataType: 'json',
					   data: formData,
					   processData: false,
					   contentType: false,
					   success: function ( data ) {
						   if( data['success'] == 1 ){
							   alert(data['mensagem']);
								montarTela(1);
						   }else if( data['success'] == 2 ){
							   alert( data['mensagem'] );
						   }else{
							   alert( data['error'] );
						   }	
						},				   
					   error: function ( data ) {
						  console.log(data);
					   }					
				});
			
			}
		}
    }