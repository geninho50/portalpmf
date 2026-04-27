<?
include "backend/db.php"; 


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `minicurso` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){
        $nome                = utf8_encode($data['nome']);
        $idade               = utf8_encode($data['idade']);
        $responsavel         = utf8_encode($data['responsavel']);
		$cpf                 = utf8_encode($data['cpf']);
		$telefone            = utf8_encode($data['telefone']);
		$email               = utf8_encode($data['email']);
		$cep                 = utf8_encode($data['cep']);
		$logradouro          = utf8_encode($data['logradouro']);
        $numero              = utf8_encode($data['numero']);
        $bairro              = utf8_encode($data['bairro']);
        $municipio           = utf8_encode($data['municipio']);
        
    }    
    $idBotSub = "update";
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Minicurso de Fotografia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					
					<nav id="nav">
						<a href="http://www.pmf.sc.gov.br">Sair</a>
						<div class="alert alert-danger hide" id="error"></div>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main">
				<div class="inner">
					<header class="major special">
						<h1 style="color:#4682B4;">Minicurso de Fotografia - Noções Básicas</h1>
						<img src="images/fcc.png" width="20%" align="right">
						<h3 style="color:#4682B4;">Público Infantojuvenil - 6 a 17 anos</h3>
						<p >Inscrições de <strong style="color:#8B2323;">16 a 24 de julho/2018</strong><br>
						   </p>
					</header>

					<h2>As vagas se esgotaram.<br>
					Dúvidas ou informações através do e-mail: artesvisuais.ffc@gmail.com</h2>
					<!-- Form 
						<section>
					
						<form id="frm1" name="frm1" method="post" action="backend/cadastrar.php"; enctype="multipart/form-data">
								<h3>Dados do Participante</h3>
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">Nome completo</label><input type="text" name="nome" id="nome" value="" placeholder="Nome" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">Idade</label><input type="text" name="idade" id="idade" value="" placeholder="Idade" />
									</div>
								</div><br>

								<h3>Dados do Responsável</h3>
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">Nome Completo</label><input type="text" name="responsavel" id="responsavel" value="" placeholder="Nome" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">CPF</label><input type="text" name="cpf" id="cpf" value="" placeholder="CPF" />
									</div>
									<div class="6u 12u$(xsmall)">
										<label style="color:#4682B4;">Telefone</label><input type="text" name="telefone" id="telefone" value="" placeholder="Telefone" />
									</div>

									<div class="6u$ 12u$(xsmall)">
										<label style="color:#4682B4;">Email</label><input type="text" name="email" id="email" value="" placeholder="Email" />
									</div>
								</div>
								

								<div class="row uniform 50%">
										<div class="6u 12u$(xsmall)">
											<label>CEP</label><input type="text" name="cep" id="cep" value="<?=$cep?>" />
											 <span class="input-group-btn">
						                        <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
						                    </span>
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label style="color:#4682B4;">Endereço</label><input type="text" name="logradouro" id="logradouro" value="<?=$rua?>" placeholder="Endereço" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label style="color:#4682B4;">Número</label><input type="text" name="numero" id="numero" value="<?=$numero?>" placeholder="Número" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label style="color:#4682B4;">Bairro</label><input type="text" name="bairro" id="bairro" value="<?=$bairro?>" placeholder="Bairro" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label style="color:#4682B4;">Município</label><input type="text" name="municipio" id="municipio" value="<?=$municipio?>" placeholder="Município"/>
										</div>
								</div>

								<br /> 
									
									<div class="12u$">
										<ul class="actions">
											<div><input id="id1" name="id1" type="hidden"/></div>
											<li><input type="button" name="btnSubmit" onclick="update()" id="btnSubmit" value="Enviar" class="special" /></li>
										</ul>
										<h3 style="color:#8B2323;">Não esqueça de levar sua câmera fotográfica.</h3>
									</div>
								</div>
							</form>
						</section>-->
			</section>
						

		<!-- Footer -->
		<section id="footer" style="background-color: #4682B4;">
				<div class="inner">
					<div class="copyright" align="center" >
						<img src="images/pmf2.png" width="25%" >
						<img src="images/fcc.png" width="15%">
					</div>
				</div>
			</section>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/js/validacao.js"></script>

<script type="text/javascript">
	$('#telefone').mask("(99) 9999-9999");
    $('#celular').mask("(99) 99999-9999");
    $('#dataNasc').mask("99/99/9999");
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");    

	function buscarCEP() {

				    //Nova variável "cep" somente com dígitos.
				    var cep = $("#cep").val().replace(/\D/g, '');
				   
				    //Verifica se campo cep possui valor informado
				    if ( cep !== "" && $("#logradouro").val() === "" )  {
				     
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
				    } //end if.
				 }

	 $('#btnSubmit').bind('click',function(){

        var ecpf = $('#cpf').val(); 
        
        // preparando o CPF para validação
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('-','');
       
        if( !ecnpjcpf( ecpf ) ){            
            return false;            
        }   

        $('#error').addClass('hide');
            var err = '';

            var obj = {
            nome                 : $('#nome').val(),
            idade                : $('#idade').val(),
            responsavel          : $('#responsavel').val(),
            cpf                  : $('#cpf').val(),
            telefone             : $('#telefone').val(),
            email                : $('#email').val(),
            cep                  : $('#cep').val(),
            logradouro           : $('#logradouro').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),   
            municipio            : $('#municipio').val()
            

          
        };
    

    
           var obj = new FormData($("#frm1").get(0));
           $('#btnSubmit').attr("disabled", true);
                  

           $.ajax({
               type: "POST",
               url: "backend/cadastrar.php",
               //dataType: "json",
               contentType: false,
               processData:false,
               data: obj,
               success: function (obj1) {
                    //console.log(obj1);
                    var oRetorno = JSON.parse(obj1);                    
                    if(oRetorno.sucesso == 1){
                        $('#error').addClass('hide');     
                        document.getElementById("frm1").action = "sucesso.php";
                        $('#id1').val(oRetorno.id);                  
                        document.getElementById("frm1").submit();                             
                    }else{  
                       //console.log(oRetorno);
                       $('#error').text(oRetorno.error).removeClass('hide');
                       $('.error').removeClass('error');
                       if ('fieldProblem' in oRetorno){
                        $('#' + oRetorno.fieldProblem).addClass('error');
                       }
                       window.scrollTo(0, 0);
                       $('#btnSubmit').removeAttr("disabled");
                    }

                },
               

               error: function (obj1) {
                    $('#btnSubmit').removeAttr("disabled");
                    console.log("erro:"+obj1);
               }
            
        });
    });      

	 function update(){
        $('#error').addClass('hide');
        var err = '';
        var id  = "<?=$id?>";
        var obj = {
            id                   : id,
            nome                 : $('#nome').val(),
            idade                : $('#idade').val(),
            responsavel          : $('#responsavel').val(),
            cpf                  : $('#cpf').val(),
            telefone             : $('#telefone').val(),
            email                : $('#email').val(),
            cep                  : $('#cep').val(),
            logradouro           : $('#logradouro').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),
            municipio            : $('#municipio').val()
        };
    }

    function validacao(){
      document.getElementById("cadastro").style.display = "block";
      document.getElementById("btnEntrar").style.display = "none";
    }

    </script>

	</body>
</html>