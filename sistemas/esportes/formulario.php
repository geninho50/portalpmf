<html>
	<head>
		<title>1ª Conferência Municipal de Esporte</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo"></a>
					<nav id="nav">
						<a href="index.html">Início</a>
						<a href="http://www.pmf.sc.gov.br/arquivos/documentos/pdf/REGIMENTO_DA_PRIMEIRA_CONFERENCIA_MUNICIPAL_DE_ESPORTE.pdf" target="blank">Regimento</a>
						<a href="formulario.php">Inscreva-se</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main">
				<div class="inner">
					<header class="major special">
						<h1>Formulário de inscrição</h1>
						<p>Todos os campos são obrigatórios.</p>
					</header>

					<!-- Form -->
						<section>
					
							<form id="frm" name="frm" method="post" action="" enctype="multipart/form-data">
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">Nome</label><input type="text" name="nome" id="nome" value="" placeholder="Nome" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">Email</label><input type="email" name="email" id="email" value="" placeholder="Email" />
									</div>
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">CPF</label><input type="text" onChange="validarCPF();" name="cpf" id="cpf" value="" placeholder="CPF" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">Telefone</label><input type="text" name="telefone" id="telefone" value="" placeholder="Telefone" />
									</div>
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">Instituição</label><input type="text" name="instituicao" id="instituicao" value="" placeholder="Instituição" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">Profissão</label><input type="text" name="profissao" id="profissao" value="" placeholder="Profissão" />
									</div>
									<div class="6u 12u(xsmall)">
										<label style="color:#4682B4;">Nascimento</label><input type="date" name="nascimento" id="nascimento" value="" placeholder="Nascimento" />
									</div>
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="generoM" name="genero" class="genero" value="M" checked>
										<label for="generoM">Masculino</label>
									</div>
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="generoF" name="genero" class="genero" value="F">
										<label for="generoF">Feminino</label>
									</div>
									
									<div class="12u$">
										<ul class="actions">
											<li><input type="button" value="Enviar" class="special" onClick="salvar();"/></li>
										</ul>
									</div>
								</div>
							</form>
						</section>
			</section>
						

		<!-- Footer -->
			<section id="footer">
				<div class="inner">
					<div class="copyright" align="center">
						<img src="images/pmf.png" >
						<img src="images/logo.png" width="170px" height="150px">
					</div>
				</div>
			</section>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>  
			<script src="../../MinhocaCabeca/assets/js/jquery.min.js"></script>
			<script src="../../MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>  
			
<script>

 $('#cpf').mask("999.999.999-99");
 $("#telefone").mask("(99) 99999999?9");

  
 function validarCPF(){
   	 
   var nCPF = $("#cpf").val();
   nCPF = nCPF.replace('-','');   
   nCPF = nCPF.replace('.','');	   
   nCPF = nCPF.replace('.','');	      
   
   if ( !eCPF(nCPF) ) {
 	   alert("CPF inválido");
 	   $("#cpf").val('');
 	   $("#cpf").focus();
 	}
}

   function salvar(){
		if( $('#cpf').val() == "" ){
			alert("Informe o CPF!");
			$('#cpf').focus();
			return false;
		}else if( $('#nome').val() == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" ){
			alert("Informe o telefone!");
			$('#telefone').focus();
			return false;
		}else if( $('#instituicao').val() == "" ){
			alert("Informe a instituição!");
			$('#instituicao').focus();
			return false;
		}else if( $('#profissao').val() == "" ){
			alert("Informe o profissão!");
			$('#profissao').focus();
			return false;
		}else if( $('#genero').val() == "" ){
			alert("Informe o seu gênero!");
			$('#genero').focus();
			return false;
		}else if( $('#nascimento').val() == "" ){
			alert("Informe sua data de nascimento!");
			$('#nascimento').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = '';
		
			
			 var nCPF = $("#cpf").val();
			   nCPF = nCPF.replace('-','');   
			   nCPF = nCPF.replace('.','');	   
			   nCPF = nCPF.replace('.','');

			var obj = {
				nome                : $('#nome').val(),
				cpf                 : nCPF,
				email               : $('#email').val(),
				telefone            : $('#telefone').val(),
				instituicao         : $('#instituicao').val(),
				profissao           : $('#profissao').val(),
				genero             : $('.genero:checked').val(),
				datanascimento      : $('#nascimento').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../../banco/cadastrarESPORTES.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
					   if( data['success'] != 188 && data['success'] != 0 ){
						   // alert("Informações enviadas com SUCESSO.");
						   $('#nome').val("");
						   $('#cpf').val("");
						   $('#email').val("");						  
						   $('#telefone').val("");						  
						   $('#instituicao').val("");						  
						   $('#profissao').val("");		
						   $('#genero').val("");				  
						   $('#dataNascimento').val("");
						   document.getElementById("frm").action ="../../banco/sucessoCMEsposte.php?codigo=" + data['success'];
						   document.getElementById("frm").submit( );
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

	</script>
	</body>
</html>