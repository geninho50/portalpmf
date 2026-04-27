<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jogos Escolares</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="shortcut icon" href="icon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
  <?php

    include_once("../banco/gdb.php");
    include_once("../banco/sessao.php");              

    $gdb = new gdb();  
    $sessao = new sessao();
    
    $codigo = base64_decode( $gdb->vargetpost('codigo') );

    if( $codigo !='' ){
        $sessao->encerrar_sessao('JEM', $codigo );
    }    
    
  ?>
	<div id="menu" class="container">
		<ul>
			<li class="current_page_item" ><a href="index.php">Início</a></li>
			<li><a href="escola.html">Inscrição</a></li>
			<li><a href="login.html">Entrar</a></li>
			<li ><a href="contato.html">Contato</a></li>
		</ul>
	</div>

	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/fundo1.jpeg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">Jogos Escolares</a></h1>
			<p>Fundação Municipal de Esportes</a></p>
		</div>
	</div>
	<div id="page" class="container">
		<div class="title">
			<h2>Conheça o evento</h2>
			<span class="byline"></span></div>

			<p>Os Jogos Escolares de Florianópolis (JESF) tem por objetivos fomentar a prática do esporte nas instituições de ensino, promover o intercâmbio esportivo e educacional e garantir um maior conhecimento e prática do esporte no cotidiano pedagógico dos estudantes.</p>
			<p>Inscreva sua escola e seus alunos, caso já tenha feito a inscrição clique em Acessar para incluir os times.</p>

			<li><a href="regulamentos/RG JESF 2019.pdf">Regulamento Geral</a></li>

			<li><a href="regulamentos/RT JESF 2019.pdf">Regulamento Técnico</a></li><br>
	
			<!--<h2>Inscrições ENCERRADAS, somente poderão ser inscritos ALUNOS nas modalidades já cadastradas.</h2>-->

	<br>
		
		<div class="row">
			 <div class="col-md-1"><a href="escola.html"><button class="btn btn-default">Cadastrar</button></a></div>
			 <div class="col-md-1"><a href="login.html"><button class="btn btn-default">Acessar</button></a></div>
		</div>
	</div>
</form>
</div>

<div id="footer-wrapper" style="background-color: #696969">
	<div id="footer" class="container" >
		<h2>Fundação Municipal de Esportes</h2>
		<span class="byline" style="color: #FFFFFF"></span>
		<ul class="contact">
			<li><img src="images/logo.png" width="20%"></li>
		</ul>
	</div>
</div>

<div id="copyright" class="container">
	<p><img src="images/pmf.png" width="20%"><a href="http://www.pmf.sc.gov.br"></a></p>
	</div>

</body>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>

<script type="text/javascript">
		    $('#telefone').mask("(99) 999999999");
		    $('#celular').mask("(99) 999999999");	    
		    $('#cep').mask("99.999-999");


function buscarCEP() {


				var cep = $("#cep").val().replace(/\D/g, '');
			   
				if ( cep !== "" && $("#logradouro").val() === "" )  {
				 
					 $("#btnCEP").val("Processando ..."); 
				 
					var validacep = /^[0-9]{8}$/;
					 
					if(validacep.test(cep)) {
						 
						var urlCEP = "https://viacep.com.br/ws/" + cep + "/json/";
						$.ajax( {
							type: "POST",
							dataType: "jsonp",
							url: urlCEP,
							crossDomain: true,
							contentType:"application/json",
							success: function( dados )  {
								$("#logradouro").val(dados.logradouro + " " + dados.complemento);
								$("#bairro").val(dados.bairro);
								$("#municipio").val(dados.localidade);
								$("#estado").val(dados.uf);              
							},
							error : function(dados){
								alert("Erro no retorno de dados !");
							}
						} );
					 
						$("#btnCEP").val("Buscar");
					 
					}
				} 
			 }

</script>
</html>
