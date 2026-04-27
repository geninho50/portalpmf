<?php
 
  // @header("Content-Type: text/html; charset=iso-8859-1");
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
  include_once("../banco/gdb.php"); 

  $gdb = new gdb(); 
    
  $data  = date('Y-m-d');
  $nu_ip  =  $_SERVER['REMOTE_ADDR'];
   
  if( isset( $_GET['codigo'] ) ){
		$codigoPessoa   =  $gdb->vargetpost('codigo');
		
		$gdb->open("  select p.codigoPessoa
						From pessoa p, 
						 	 pessoaAuxiliar pa 
					   where p.codigoPessoa = pa.codigoPessoa  
						 and p.codigoPessoa = $codigoPessoa
						 and pa.codigoProjeto = 'PROCON'  ");
}else{
	$codigoPessoa   =  $gdb->vargetpost('codigoPessoa');
		
	$gdb->open("select codigoPessoa 
				from sessao s, 
						usuario u, 
						pessoa p  
				where s.codigoUsuario =  u.codigoUsuario 
					and p.email = u.login
					and sistema='PROCON' 
					and numeroip = '$nu_ip'
					and dataInicial = '$data' 
					and horaFinal is null 
					limit 0,1 ");
}  
?>

<head>

	<!-- Global site tag (gtag.js) - Google Analytics  -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-151895154-1');
	</script> 

<!-- Hotjar Tracking Code for https://www.pmf.sc.gov.br/tutorial.php 
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1562965,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
-->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/scripts/js/ui/jquery-ui.css">
  <link rel="shortcut icon" href="https://www.pmf.sc.gov.br/layout/imagens/brasao.gif" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="https://www.pmf.sc.gov.br/sistemas/Biblioteca/js/validadores.js"			  type="text/javascript" ></script>  
  <script src="https://www.pmf.sc.gov.br/sistemas/Biblioteca/js/jquery.min.js" 			  type="text/javascript" ></script>
  <script src="https://www.pmf.sc.gov.br/sistemas/Biblioteca/js/jquery.maskedinput.min.js" type="text/javascript" ></script> 
  <script src="https://www.pmf.sc.gov.br/sistemas/Biblioteca/js/buscarCep.js"        	  type="text/javascript" ></script>
  <script src="https://www.pmf.sc.gov.br/sistemas/Biblioteca/js/validadores.js"        	  type="text/javascript" ></script>  
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
  <script src='http://momentjs.com/downloads/moment.min.js' 							  type="text/javascript" ></script>
  <script src="https://www.pmf.sc.gov.br/sistemas/procon/js/index.js"					  type="text/javascript" ></script>
  <script src="https://www.pmf.sc.gov.br/layout/themePMF/js/slick.min.js"				  type="text/javascript" ></script>
  <script src="https://www.pmf.sc.gov.br/layout/themePMF/js/main.min.js"				  type="text/javascript" ></script>
  
 
  <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->

</head>
<body>
<script>
 var pessoa = "<?php print $gdb->gs['CODIGOPESSOA'][0]; ?>";
 if( pessoa !="" ){
	 fecharSessao( pessoa );
 }
</script>

<form  id="formulario" name="formulario" method="post" enctype="multipart/form-data" >
   <input type="hidden" name="codigoPessoa"  	 id="codigoPessoa" value="<?php print $codigoPessoa; ?>"  />
   <input type="hidden" name="codigoReclamacao"  id="codigoReclamacao"  />
   <input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" value="400000">

  <div style="display:none">
	    <a href="https://www.pmf.sc.gov.br/mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
  </div>

  	<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/themePMF/css/style.css">

<div class="mini-header">
	<ul class="mini-header__items">
	  <li style="font-size: 18px;"><b>Procon </b></li>
	  <li style="font-size: 11px;">Siga a prefeitura</li>
	  <li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank" alt="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
	  <li><a href="https://www.instagram.com/prefeituradeflorianopolis/" target="_blank" alt="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	  <li><a href="https://twitter.com/scflorianopolis" target="_blank" alt="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
	  <li><a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank" alt="Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
	</ul>
</div>
	
<div class="header">
  <div class="header__brand">
  	<a href="https://www.pmf.sc.gov.br">
  		<img src="https://www.pmf.sc.gov.br/images/marca-pmf.svg">
  	</a>
  </div>
   <!-- Área para colocar menu -->
</div>

 <div class="flex-container hero-wrapper" style="background-image: url(https://www.pmf.sc.gov.br/images/frentePROCONn.jpg);" id="divConteudo" name="divConteudo" >		
 <?php
	if( $codigoPessoa == "" ){
?>
 		<div class="column4-lg column4-md column8-sm" id="divMensagem" style="display:block;" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
			        <h1 class="hidden-sm hidden-xs">FAÇA AQUI A SUA RECLAMAÇÃO!</h1><br>
			        <p style="color: white;"> O PROCON, está recebendo reclamações por meio desta ferramenta online.</p><br>
			        <li style="color: white;"> Caso você não tenha um cadastro de Consumidor, clique no botão ao lado e faça o seu cadastro.</li><br>
			        <li style="color: white;">Caso você já tenha um cadastro, clique em <b>Faça sua Reclamação</b>. Informe o seu usuário ( E-mail ) e a senha, e entre no sistema.</li><br>
					<li style="color: yellow;">O cadastro é permitido somente para <b>Consumidores de Florianópolis.</b></li><br>
				</div>
		</div>
        

		<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; display:block; " id="divMenu">
			<div class="category-list" >
				<div class="category-list">
					<div class="category-citizen active">
						<a class="category active" style="background-color: transparent;"></a>
						<a class="category active" style="background-color: transparent;"></a>
						<a class="category active" style="background-color: transparent;"></a>
						<a class="category active" onclick="montarTela(2);" >Cadastro do Consumidor</a>
						<a class="category active" onclick="montarTela(5);" >Esqueceu a senha</a>
						<a class="category active" onclick="montarTela(4);" >Faça sua Reclamação</a>
						<a class="category active" onclick="montarTela(6);" >Acompanhe sua Reclamação</a>
						<a class="category active" href="https://www.pmf.sc.gov.br/ouvidoria/index.php" target="_blank">Ouvidoria</a>
						<a class="category active" onclick="montarTela(3);">Dúvidas</a>
						<a class="category active" style="background-color: transparent;"></a>
					</div>
				</div>
			</div>
		</div>
       
		<div class="flex-container hero-wrapper" id="loginAcesso" style="display:none;" >
		    <div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Informe os dados para acessar o sistema</h1><br>
				
				<div class="row">
				   <div class="col-md-8">
		                <label>E-mail:</label><input value="" id="login" class="form-control" type="text"/>
		            </div>				
		            <div class="col-md-8">
		                <label>Senha :</label><input id="senha" class="form-control" type="password"/>		          
		            </div>
					<div class="col-md-8">
		                <label> </label>		          
		            </div>
					<div class="col-md-8">
						<div class="g-recaptcha" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div>
					</div>
				</div>								
				<br><br>

				<div class="row">
					<div class="col-md-8">
						<input type="button" class="btn btn-primary botao" value="Entrar" onclick="acessarSistema();" />
						<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1);" />
					</div>					
				</div>
		    </div>
		</div> 
<?php
	}else{
?>
		<div class="flex-container hero-wrapper" id="solicite"  style="display:block;" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
					<h1 class="hidden-sm hidden-xs">Informe os dados abaixo para alterar a sua senha</h1><br>
					
					<div class="row">
						<div class="col-md-12">
							<label>Nova senha:</label><input name="senha" id="senha" class="form-control" type="password"/>
						</div>				
						<div class="col-md-12">
							<label>Repita senha nova:</label><input name="repita" id="repita" class="form-control" type="password"/>		          
						</div>
					</div>				
				<br><br>

				<div class="row">
				 <div class="col-md-12">
					<input type="button" class="btn btn-primary botao" value="Alterar" onclick="alterarSenha();" />
					<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1);" />
				</div>

				<div class="col-md-12">
					<h2 class="hidden-sm hidden-xs"></h2>
					<h2 class="hidden-sm hidden-xs"></h2>
				</div>
				</div>
			</div>
		</div>
<?php 
	}
?>
</div>


</div>

</form>

  <div class="flex-container">
    <div class="column4-lg column4-md column8-sm">
      <div id="fb-root"></div>
    </div>
  </div>
  
<div id="rodape">
  <div class="info">
    <div class="info-column">
      <div class="info-block">
        <h4>E-mail</h4>
        <ul>
          <li><p style="color: white;">procon.online@pmf.sc.gov.br</p></li>
        </ul>
        <!-- <h4>Suporte</h4>
        <ul>
          <li><p style="color: white;">nfa@pmf.sc.gov.br</p></li>
        </ul>		 -->
      </div>
    </div>
     <div class="info-column">
      <div class="info-block">
        <h4>Telefone - Endereço</h4>
        <ul>
          <li><p style="color: white;">0800 000 0844 -  Rua João Pinto n. 156 - Centro - CEP: 88010-301  </p></li>
        </ul>
      </div>

    </div>
    </div>
</div>

<script src="https://www.pmf.sc.gov.br/layout/themePMF/js/home.min.js"></script>


</body>