<!DOCTYPE HTML>
<html>
	<head>
		<title>Seminário</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


	</head>
	<body>
		<div class="page-wrap">

			<nav id="nav">
				<ul>
					<li><a href="index.php"><span class="icon fa-home"></span></a></li>
					<li><a href="inscricao.php" class="active"><span class="icon fa-file-text-o"></span></a></li>
					<li><a href="documento.pdf" class="active"><span class="icon fa-file-text"></span></a></li>
				</ul>
			</nav>

				<section id="main" >
					<section id="banner">
						<div class="inner">
							<p>Consulta pública sobre a Política Municipal de</p>
							<h2>Gestão de Resíduos da Construção Civil, Vegetais e Volumosos no Município de Florianópolis.</h2>
					</div>
				</section>

				<section>
					<div class="inner">
						<header>
							<h2>Consulta Pública</h2><br />
							<p>* Todos os campos são obrigatórios.</p>
						</header>

						<div class="column">
							<form action="#" method="post">
								<div class="row">
		        					<div class="col-md-4">
											<label>Nome:</label><input value="" id="nome" class="form-control" type="text"/>
											</div>
										<div class="col-md-2">
  											 <label>CPF:</label><input value="" id="cpf" class="form-control" type="text" onChange="validarCPF();"/>
										</div>
										<div class="col-md-3">
  											 <label>Email:</label><input value="" id="email" class="form-control" type="text"/>
										</div>
										<div class="col-md-3">
  											 <label>Telefone:</label><input value="" id="telefone" class="form-control" type="text"/>
										</div>
										
								</div><br>

									<div class="row">
										<div class="col-md-6">
  											 <label>Entidade:</label><input value="" id="entidade" class="form-control" type="text"/>
										</div>
										<div class="col-md-6">
											<label>Identificação do artigo da minuta em questão:</label><input value="" id="artigo" class="form-control" type="text"/>
										</div>
									</div><br>

									<div class="row">
										<div class="col-md-6">
											<label>Sugestão:</label><textarea value="" id="sugestao" class="form-control" type="text" cols="100" rows="5"></textarea>
										</div>
										<div class="col-md-6">
											<label>Justificativa:</label><textarea value="" id="justificativa" class="form-control" type="text" cols="100" rows="5"></textarea>
										</div>
									</div>

										<ul class="actions">
											<li><input value="Enviar" class="button" type="button" name="submit" id="submit" onClick="salvar();"></li>
										</ul>
									</form>
								</div>
						</section>

					<!-- Footer -->
						<footer id="footer" style="background-color: #0D1217;">
							<div class="copyright">
							<a href="http://www.pmf.sc.gov.br"><img src="images/Prefeitura.png"></a>.
							</div>
						</footer>
				</section>
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>  
			<script src="assets/js/jquery.min.js"></script>
  			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>  

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
		if( $('#nome').val() == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o CPF!");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" ){
			alert("Informe o Telefone!");
			$('#telefone').focus();
			return false;
		}else if( $('#entidade').val() == "" ){
			alert("Informe a Entidade!");
			$('#entidade').focus();
			return false;
		}else if( $('#artigo').val() == "" ){
			alert("Informe a Identificação do Artigo em questão!");
			$('#artigo').focus();
			return false;
		}else if( $('#sugestao').val() == "" ){
			alert("Informe a Sugestão!");
			$('#sugestao').focus();
			return false;
		}else if( $('#justificativa').val() == "" ){
			alert("Informe a Justificativa!");
			$('#justificativa').focus();
			return false;
		}else{
		
			$('#error').addClass('hide');
			var err = '';
			

			var obj = {
				nome                : $('#nome').val(),
				cpf                 : $('#cpf').val(),
				email               : $('#email').val(),
				telefone            : $('#telefone').val(),
				entidade         	: $('#entidade').val(),
				artigo         		: $('#artigo').val(),
				sugestao            : $('#sugestao').val(),
				justificativa       : $('#justificativa').val()
			};
            
			$.ajax({			
				   type: "POST",
				   url: "../banco/cadastrarCONSULTA.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						   $('#nome').val("");
					       $('#cpf').val("");	
					       $('#email').val("");
					       $('#telefone').val("");
						   $('#entidade').val("");	   					  
						   $('#artigo').val("");	
						   $('#sugestao').val("");	
						   $('#justificativa').val("");			
					   }else{
						   alert(data['error']);   
					   }			  			   	
					},				   
				   error: function ( data ) {
					   alert( data['error'] );
					   console.log(data);
				   }
				
			});
			
		}
    }

</script>

	</body>
</html>