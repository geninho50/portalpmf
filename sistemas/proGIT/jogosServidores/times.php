<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JISF</title>
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
    include_once("menu.php");

    $gdb = new gdb();
    $gdbc = new gdb();
    $gdbm = new gdb();

    menu( $gdb->vargetpost('codigo'),'inscricao' );

	$codigo = base64_decode( $gdb->vargetpost('codigo') );
	$gdb->open("select idSecretaria as codigo
	              from secretariaJISF e,
				       usuario u
			     where e.email = u.login
				   and u.codigoUsuario = '$codigo' ");

	$idSecretaria = $gdb->gs['CODIGO'][0];


	$gdbc->open("select nome as secretariaOrigem
	              from secretariaJISF e,
				       usuario u
			     where e.email = u.login
				  and u.codigoUsuario = '$codigo' ");

	$secretariaOrigem = $gdbc->gs['SECORIGEM'][0];

	if($codigo == ''){
      header('Location: /sistemas/jogosServidores/login.html');
        }

	$gdbm->open("select p.idpreEquipeJISF as chave,
	                    p.modalidade,
	                    p.equipe,
	                case when p.genero = 'F' Then 'Feminino' else 'Masculino' end as genero
				   from preEquipeJISF p,
				   		secretariaJISF e,
				   		usuario u
				  where p.idSecretaria = '$idSecretaria'
				    AND p.idSecretaria = e.idSecretaria
					AND u.login = e.email
     				AND u.codigoProjeto = 'JISF'
				    AND ( select count(*) from preEquipeServidor EA where EA.idpreEquipeJISF = p.idpreEquipeJISF   ) < 16
			   ORDER BY modalidade");

  ?>

	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/background-new.jpg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">JISF 2019</a></h1>
			<p>Jogos de Integração dos Servidores Públicos de Florianópolis</p>
		</div>
	</div>

	<div id="page" class="container">
		<div class="title">
			<h2>Inscri&ccedil;&atilde;o dos Times</h2>
			<span class="byline">Inscreva um atleta por vez, selecionando as equipes já inscritas.</span></div>

	<form id="formulario" name="frm">
	   <input type='hidden' name='idSecretaria' id='idSecretaria' value='<?php print $idSecretaria; ?>' >


		<h2>Escolha a Equipe</h2>
		<div class="row">
			<div class="col-md-6">
			    <select class="form-control" id="modalidade">
			      <?php foreach( $gdbm->gs['CHAVE'] as $key=>$value ){
						print "<option value='$value'>".$gdbm->gs['MODALIDADE'][$key]." - ".$gdbm->gs['GENERO'][$key]." - ".$gdbm->gs['EQUIPE'][$key]."</option>";
						}
				   ?>
			    </select>
			</div>
        </div><br>


   		<h2>Time</h2>
   		<div class="row">
   			<div class="col-md-3"><label>Nome do Servidor:</label><input value="" id="nome" name="nome" class="form-control" type="text"/></div>

			<div class="col-md-3"><label>Secretaria que o Servidor Atua:</label>
				<select class="form-control" id="secAtua">
				 <option value="Gabinete">Gabinete do Prefeito e Vice</option>
				 <option value="Administração">Administração</option>
				 <option value="Assistência Social">Assistência Social</option>
				 <option value="Casa Civil">Casa Civil</option>
				 <option value="Continente">Continente</option>
				 <option value="Cultura, Esporte e Juventude">Cultura, Esporte e Juventude</option>
				 <option value="Defesa do Consumidor, Trabalho e Renda">Defesa do Consumidor, Trabalho e Renda</option>
				 <option value="Educação">Educação</option>
				 <option value="Fazenda">Fazenda</option>
				 <option value="Infraestrutura">Infraestrutura</option>
				 <option value="Meio Ambiente, Planejamento e Desenvolvimento Urbano">Meio Ambiente, Planejamento e Desenvolvimento Urbano</option>
				 <option value="Saúde">Saúde</option>
				 <option value="Segurança Pública">Segurança Pública</option>
				 <option value="Transporte e Mobilidade Urbana">Transporte e Mobilidade Urbana</option>
				 <option value="Turismo, Tecnologia e Desenvolvimento Econômico">Turismo, Tecnologia e Desenvolvimento Econômico</option>
				 <option value="Procuradoria">Procuradoria Geral do Município</option>
				 <option value="Autarquia Comcap">Autarquia Comcap</option>
				 <option value="Câmara Municipal de Florianópolis">Câmara Municipal de Florianópolis</option>
				 <option value="Transparencia">Secretaria Municipal da Transparência, Auditoria e Controle</option>
				 <option value="Pro Cidadao">Pró Cidadão</option>
				 <option value="Floram">Floram</option>
  				</select>
			</div>
		</div><br>

		<div class="row">
				<div class="col-md-3"><label>Situação</label>
				    <select class="form-control" id="situacao" onchange="ativacaoDiv(this);">
				      <option value="efetivo">Efetivo/Comissionado</option>
				      <option value="terceirizado">Terceirizado/Estagiário</option>
				    </select>
				</div>

			 	<div class="col-md-3" id="divMatricula" style="display: block;"><label>Matrícula</label><input value="" id="matricula" name="matricula" class="form-control" type="text"/></div>
				<div class="col-md-3" id="divCpf" style="display: none;"><label>CPF</label><input value="" id="cpf" name="cpf" class="form-control" type="text"/></div>
	</div>

   <br>

   	<div class="row">
   		<div class="col-md-6">
		 	<button type="button" class="btn btn-default" onclick="adicionar();">Adicionar Servidor</button>
		 </div>
	</div>


 		<br><br>


	<div class="title">
        <h2>Orienta&ccedil;&otilde;es</h2>
    </div>
    	<p><strong>Cada servidor só poderá jogar por uma única Secretaria.</strong></p>
    	<p><strong>Cada Secretaria só poderá ter 2 servidores emprestados de outra Secretaria.</strong></p>
        <p><strong>Cada Secretaria dever&aacute; se responsabilizar por seu transporte até o local da competi&ccedil;&atilde;o.</strong></p>
</form>


	</div>
</div>



<div id="footer-wrapper" style="background-color: #696969">
	<div id="footer" class="container" >
		<h2>Funda&ccedil;&atilde;o Municipal de Esportes</h2>
		<span class="byline"></span>
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

		$('#matricula').mask("99999-9");
		$('#cpf').mask("999.999.999-99");


	function adicionar(){

		if ( $('#nome').val() == '') {
			alert('Informe o nome do servidor!');
			$('#nome').focus();
		}else if ( $('#situacao').val() == '') {
			alert('Informe a situação do servidor!');
			$('#situacao').focus();
		}else{
			var obj = {

				idpreEquipeJISF     : $('#modalidade').val(),
				nome                : $('#nome').val(),
				matricula           : $('#matricula').val(),
				cpf          		: $('#cpf').val(),
				secAtua         	: $('#secAtua').val(),
				situacao         	: $('#situacao').val(),
				idSecretaria        : $('#idSecretaria').val(),
				secretariaOrigem	: $('#secretariaOrigem').val()
			};

			$.ajax({
				   type: "POST",
				   url: "../banco/cadastrarServidor.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1  ){
						   alert("Servidor cadastrado com SUCESSO.");
						   $('#nome').val('');
						   $('#matricula').val('');
						   $('#cpf').val('');
						   $('#situacao').val('');
					   }else if( data['success'] == 2  ){
						   alert("Esse servidor j&aacute; foi cadastrado nessa modalidade !");
						   $('#nome').val('');
						   $('#matricula').val('');
						   $('#cpf').val('');
						   $('#situacao').val('');
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

	function ativacaoDiv(obj){
		if(obj.value=='efetivo'){
			document.getElementById('divMatricula').style.display = "block";
			document.getElementById('divCpf').style.display = "none";
			} else {
			document.getElementById('divMatricula').style.display = "none";
			document.getElementById('divCpf').style.display = "block";
			}
	}


</script>
</html>
