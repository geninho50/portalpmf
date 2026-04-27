<?php 
include "backend/db.php"; 


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `juventude`.`juventude` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){
        $nome                = utf8_encode($data['nome']);
        $genero              = utf8_encode($data['genero']);
        $dataNasc            = utf8_encode($data['dataNasc']);
        $rua      			 = utf8_encode($data['rua']);
        $numero              = utf8_encode($data['numero']);
        $bairro              = utf8_encode($data['bairro']);
        $cep                 = utf8_encode($data['cep']);
        $escolaridade        = utf8_encode($escolaridade['escolaridade']);
        $email               = utf8_encode($data['email']);
        $telefone            = utf8_encode($data['telefone']);
        $celular             = utf8_encode($data['celular']);
        $profissional        = utf8_encode($data['profissional']);
        $qual                = utf8_encode($data['qual']);
        $ctps                = utf8_encode($data['ctps']);
        $area                = utf8_encode($data['area']);
        $turno               = utf8_encode($data['turno']);
        $rg                  = utf8_encode($data['rg']);
        $cpf                 = utf8_encode($data['cpf']);

        
    }    
    $idBotSub = "update";
}
?> 

<!DOCTYPE HTML>
<html>
	<head>
		<title>Juventude</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo">
			</header>

		<!-- Nav -->

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<h2>Jovem em Ação Floripa</h2>
					</header>


				</div>
			</section>

		<!-- Main -->
			<div id="main" class="align-center">

				<!-- Elements -->

					<strong>
						<li>Somente jovens de 15 a 29 anos</li>
						<li>Lembrando que a capacitação ocorrerá dia 29/11/2017</li>
						<li>Todos os campos com * são obrigatórios</li>
						<li>Somente um CPF por cadastro</li>
						<li>Dúvidas e informações: juventude@pmf.sc.gov.br</li>
						<li>Telefone: (48) 3333-8862 (RENAPSI-SC) - 13:00 - 18:00</li>
					</strong>

			</div>

			<section id="two" class="wrapper style3">
			</section>

		<section id="two" class="wrapper style2">
                <div class="inner">
                    <div class="box">
                        <div class="content">
                            <header class="align-center">
                            	<h2>Formulário de Inscrição</h2>
                            </header>
				<!-- Form -->

						<form id="frm1" name="frm1" method="post" action="backend/cadastrarJuventude.php"; enctype="multipart/form-data">
								<!-- Break -->
								<div class="8u 12u$(small)"><label>Com relação ao curso, qual turno você deseja se inscrever: * </label>
									<input type="radio" name="turno" value="1" id="matutino" name="priority" checked >
									<label for="matutino">Matutino - 08:30 / 11:30 </label>
								</div>
								<div class="8u 12u$(small)">
									<input type="radio" id="vespertino" name="turno" value="2">
									<label for="vespertino">Vespertino - 14:00 / 17:00 </label>
								</div>
								<div class="8u$ 12u$(small)">
									<input type="radio" id="noturno" name="turno" value="3">
									<label for="noturno">Noturno - 19:00 / 22:00 </label>
								</div><br>

								<div class="row uniform">
										<div class="6u 12u$(xsmall)"><label>Nome</label>
											<input type="text" value="<?=$nome?>" id="nome" placeholder="Nome Completo" />
										</div>
										<div class="6u$ 12u$(xsmall)"><label>Data de Nascimento</label>
											<input value="<?=$dataNasc?>" id="dataNasc" name="dataNasc" class="form-control" type="text" placeholder="Data de Nascimento" />
										</div>

										<div class="6u 12u$(xsmall)"><label>RG</label>
											<input type="text" value="<?=$rg?>" id="rg" placeholder="RG" />
										</div>
										<div class="6u$ 12u$(xsmall)"><label>CPF</label>
											<input value="<?=$dataNasc?>" id="cpf" name="cpf" class="form-control" type="text" placeholder="CPF" />
										</div>

										<div class="6u 12u$(xsmall)"><label>Genêro</label>
											<div class="4u 12u$(small)">
												<input type="radio" name="genero" value="1" id="masculino" name="priority" checked >
												<label for="masculino">Masculino </label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="feminino" name="genero" value="2">
												<label for="feminino">Feminino </label>
											</div>
										</div>
									</div>
									<div class="row uniform">
										<div class="6u 12u$(xsmall)">
											<label>CEP</label><input type="text" name="cep" id="cep" value="<?=$cep?>" />
											 <span class="input-group-btn">
						                        <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
						                    </span>
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>Endereço</label><input type="text" name="logradouro" id="logradouro" value="<?=$rua?>" placeholder="Endereço" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label>Número</label><input type="text" name="numero" id="numero" value="<?=$numero?>" placeholder="Número" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>Bairro</label><input type="text" name="bairro" id="bairro" value="<?=$bairro?>" placeholder="Bairro" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label>Município</label><input type="text" id="municipio" value="Florian&oacute;polis" disabled="disabled"/>
										</div>

										<div class="6u$ 12u$(xsmall)">
												<label>Email</label><input type="text" name="email" id="email" value="<?=$email?>" placeholder="Email" />
											</div>
										<div class="6u 12u$(xsmall)">
												<label>Telefone Fixo</label><input type="text" name="telefone" id="telefone" value="<?=$telefone?>" placeholder="Telefone Fixo" />
											</div>
										<div class="6u$ 12u$(xsmall)">
												<label>Celular</label><input type="text" name="celular" id="celular" value="<?=$celular?>" placeholder="Celular" />
											</div>
								
									</div><br><br>
									<div class="row uniform">
										<div class="8u 12u$(small)"><label>Grau de Escolaridade*: </label>
											<input type="radio" name="escolaridade" value="1" id="completo" checked >
											<label for="completo">2° Grau Completo </label>
										</div>
										<div class="8u$ 12u$(small)">
											<input type="radio" id="segundo" name="escolaridade" value="2">
											<label for="segundo">2° Grau Incompleto </label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="superior" name="escolaridade" value="3">
											<label for="superior">Superior Completo </label>
										</div>
										<div class="8u$ 12u$(small)">
											<input type="radio" id="incompleto" name="escolaridade" value="4">
											<label for="incompleto">Superior Incompleto </label>
										</div><br>

									<div class="8u$ 12u$(small)"><label>Já teve alguma experiência profissional?*  </label>
											<input type="radio" name="profissional" value="1" id="sim" checked >
											<label for="sim">Sim </label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="nao" name="profissional" value="2">
											<label for="nao">Não </label>
										</div>

									<div class="12u$ 12u$(xsmall)">
										<label>Qual?</label><input type="text" name="qual" id="qual" value="<?=$qual?>" placeholder="Qual experiência profissional?" />
									</div>

									<div class="8u$ 12u$(small)"><label>Com Carteira de Trabalho Assinada (CTPS)?*  </label>
											<input type="radio" name="ctps" value="1" id="com" checked >
											<label for="com">Sim </label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="sem" name="ctps" value="2">
											<label for="sem">Não </label>
										</div>

									<div class="12u$ 12u$(xsmall)">
										<label>Qual a área que você gostaria de trabalhar?</label><input type="text" name="area" id="area" value="<?=$area?>" placeholder="Exemplo: Comércio, Bares, Restaurantes, Tecnologia, entre outros." />
									</div>

										<br><br>

								<div class="12u$">
									<ul class="actions">
										<div><input id="id1" name="id1" type="hidden"/></div>
       									 <input type="button" name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-primary botao" value="Enviar" /> 
									</ul>
								</div>
							</div>
						</form>

					<hr />
				</div>
			</div>
		</div>
	</section>

			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					<header class="align-center">
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="assets/js/validacao.js"></script>

	</body>
</html>

 <script type="text/javascript" src="js/validacao.js"></script>
   <script>
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

        var ano  = document.getElementById("dataNasc").value.substring(6,10);
        var ecpf = $('#cpf').val(); 
        
        // preparando o CPF para validação
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('-','');
       
        if( !ecnpjcpf( ecpf ) ){            
            return false;            
        }

        if( ano>2002 || ano<1987 ){
            alert("Você está fora da faixa etária permitida no projeto! ");
            return false;
        }        

        $('#error').addClass('hide');
            var err = '';

            var obj = {
            nome                 : $('#nome').val(),
            genero               : $('#genero').val(),
            dataNasc             : $('#dataNasc').val(),
            rua                  : $('#rua').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            escolaridade         : $('#escolaridade').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            profissional         : $('#profissional').val(),
            qual                 : $('#qual').val(),
            ctps                 : $('#ctps').val(),
            area                 : $('#area').val(),
            rg                   : $('#rg').val(),
            cpf                  : $('#cpf').val(),
            turno                : $('#turno').val()
          
        };
    

    
           var obj = new FormData($("#frm1").get(0));
           $('#btnSubmit').attr("disabled", true);
                  

           $.ajax({
               type: "POST",
               url: "backend/cadastrarJuventude.php",
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
            genero               : $('#genero').val(),
            dataNasc             : $('#dataNasc').val(),
            rua                  : $('#rua').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            escolaridade         : $('#escolaridade').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            profissional         : $('#profissional').val(),
            qual                 : $('#qual').val(),
            ctps                 : $('#ctps').val(),
            area                 : $('#area').val(),
            rg                   : $('#rg').val(),
            cpf                  : $('#cpf').val(),
            turno                : $('#turno').val()
        };
    }

    function validacao(){
      document.getElementById("cadastro").style.display = "block";
      document.getElementById("btnEntrar").style.display = "none";
    }

    </script>
    </html>