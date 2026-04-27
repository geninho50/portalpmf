<!--

<?php 

header('Location: http://www.pmf.sc.gov.br');  

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
        $etnia                 = utf8_encode($data['etnia']);

        
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

            <header id="header">
                <div class="logo"><a href="http://www.pmf.sc.gov.br">Sair</a></div>
            </header>
            
            
		<section id="two" class="wrapper style2">
                <div class="inner">
                    <div class="box">

			            <div align="center">
			               <img src="images/capa.png" width="100%">
			            </div>


                        <div class="content">
                            <header class="align-center">
                            	<h2>Formulário de Inscrição</h2>
                            	  <div style="color: white; background-color: black; font-size: 35px;" align="left" class="alert alert-danger hide" id="error"></div>
                            </header>

				<div align="right">
				<strong>
						<li>Somente jovens de 15 a 29 anos</li>
						<li>Somente moradores do município de Florianópolis</li>
						<li>Todos os campos com * são obrigatórios</li>
						<li>Somente um CPF por cadastro</li>
						<li>Dúvidas e informações: juventude@pmf.sc.gov.br</li>
						
				</strong>
				</div>
						<form id="frm1" name="frm1" method="post" action="backend/cadastrarJuventude.php"; enctype="multipart/form-data">
						
								
									<h4>180 Vagas</h4>
									<ul>
										<li style="color: black;">Imagem Pessoal e Profissional - 60 Vagas</li>
										<li style="color: black;">Secretariado e Rotinas Administrativas - 60 Vagas</li>
										<li style="color: black;">Atendente de Farmácia - 60 Vagas</li>
									</ul>

									<h4 style="color: red;">Capacidade de 30 alunos por turma.</h4>
								
								<br>
	<h3>Escolha o curso e horário: * </h3>
	<div class="row uniform">
		<div class="6u 12u$(xsmall)">
			<h2><strong>Imagem Pessoal e Profissional</strong></h2>
			<input type="radio" name="turno" value="Imagem Pessoal e Profissional - Turma 1 - nov2018" id="imagem1" name="priority"  checked>
			<label for="imagem1"><strong>Turma 1 - 07/11/2018 e 14/11/2018 - Horário das 14h as 17h</strong></label>

			<input type="radio" name="turno" value="Imagem Pessoal e Profissional - Turma 2 - nov2018" id="imagem2" name="priority" >
			<label for="imagem2"><strong>Turma 2  - 21/11/2018 e 28/11/2018 - Horário das 14h as 17h</strong></label>


			<h2><strong>Rotinas Administrativas</strong></h2>
			<input type="radio" name="turno" value="Rotinas Administrativas - Turma 1 - nov2018" id="rotinas1" >
			<label for="rotinas1"><strong>Turma 1 - 09/11/2018 e 16/11/2018 - Horário das 14h as 17h</strong></label>

			<input type="radio" name="turno" value="Rotinas Administrativas - Turma 2 - nov2018" id="rotinas2" >
			<label for="rotinas2"><strong>Turma 2  - 23/11/2018 e 30/11/2018 - Horário das 09h as 12h</strong></label>


			<h2><strong>Atendente de Farmácia</strong></h2>
			<input type="radio" name="turno" value="Atendente de Farmácia  - Turma 1 - nov2018" id="farmacia1"  >
			<label for="farmacia1"><strong>Turma 1 - 01/11/2018 e 08/11/2018 - Horário das 19h as 21h</strong></label>

			<input type="radio" name="turno" value="Atendente de Farmácia  - Turma 2 - nov2018" id="farmacia2"  >
			<label for="farmacia2"><strong>Turma 2 - 22/11/2018 e 29/11/2018 - Horário das 19h as 21h</strong></label>
		</div>	
	</div>	<br>


								<div class="row uniform">
										<div class="6u 12u$(xsmall)"><label>Nome</label>
											<input type="text" value="<?=$nome?>" id="nome" name="nome" placeholder="Nome Completo" />
										</div>
										<div class="6u$ 12u$(xsmall)"><label>Data de Nascimento</label>
											<input value="<?=$dataNasc?>" id="dataNasc" name="dataNasc" class="form-control" type="text" placeholder="Data de Nascimento" />
										</div>

										<div class="6u 12u$(xsmall)"><label>RG</label>
											<input type="text" value="<?=$rg?>" id="rg" name="rg" placeholder="RG" />
										</div>
										<div class="6u$ 12u$(xsmall)"><label>CPF</label>
											<input value="<?=$cpf?>" id="cpf" name="cpf" class="form-control" type="text" placeholder="CPF" />
										</div>

										<div class="6u 12u$(xsmall)"><label>Genêro</label>
											<div class="4u 12u$(small)">
												<input type="radio" name="genero" value="masculino" id="masculino" name="priority" checked >
												<label for="masculino"><strong>Masculino </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="feminino" name="genero" value="feminino">
												<label for="feminino"><strong>Feminino </strong></label>
											</div>
										</div>
										<div class="6u 12u$(xsmall)"><label>Etnia/Raça</label>
											<div class="4u 12u$(small)">
												<input type="radio" name="etnia" value="Branca" id="Branca" name="priority" checked >
												<label for="Branca"><strong>Branca </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="Negra" name="etnia" value="Negra">
												<label for="Negra"><strong>Negra </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="Parda" name="etnia" value="Parda">
												<label for="Parda"><strong>Parda </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="Amarela" name="etnia" value="Amarela">
												<label for="Amarela"><strong>Amarela </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="Indígena" name="etnia" value="Indígena">
												<label for="Indígena"><strong>Indígena </strong></label>
											</div>
											<div class="4u$ 12u$(small)">
												<input type="radio" id="Não declarado" name="etnia" value="Não declarado">
												<label for="Não declarado"><strong>Não declarado </strong></label>
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
											<label>Endereço</label><input type="text" name="logradouro" id="logradouro" value="<?=$logradouro?>" placeholder="Endereço" />
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
											<input type="radio" name="escolaridade" value="2° Grau Completo" id="completo" checked >
											<label for="completo"><strong>2° Grau Completo </strong></label>
										</div>
										<div class="8u$ 12u$(small)">
											<input type="radio" id="segundo" name="escolaridade" value="2° Grau Incompleto">
											<label for="segundo"><strong>2° Grau Incompleto </strong></label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="superior" name="escolaridade" value="Superior Completo">
											<label for="superior"><strong>Superior Completo </strong></label>
										</div>
										<div class="8u$ 12u$(small)">
											<input type="radio" id="incompleto" name="escolaridade" value="Superior Incompleto">
											<label for="incompleto"><strong>Superior Incompleto </strong></label>
										</div><br>

									<div class="8u$ 12u$(small)"><label>Já teve alguma experiência profissional?*  </label>
											<input type="radio" name="profissional" value="Sim" id="sim" checked >
											<label for="sim"><strong>Sim </strong></label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="nao" name="profissional" value="Não">
											<label for="nao"><strong>Não </strong></label>
										</div>

									<div class="12u$ 12u$(xsmall)">
										<label>Qual?</label><input type="text" name="qual" id="qual" value="<?=$qual?>" placeholder="Qual experiência profissional?" />
									</div>

									<div class="8u$ 12u$(small)"><label>Com Carteira de Trabalho Assinada (CTPS)?*  </label>
											<input type="radio" name="ctps" value="Sim" id="com" checked >
											<label for="com"><strong>Sim </strong></label>
										</div>
										<div class="8u 12u$(small)">
											<input type="radio" id="sem" name="ctps" value="Não">
											<label for="sem"><strong>Não </strong></label>
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


			<footer id="footer">
				<div class="copyright">
					<header class="align-center">
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

	
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
    $('#cep').mask("99.999-999");
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

       /* var ano  = document.getElementById("dataNasc").value.substring(6,10);*/
        var ecpf = $('#cpf').val(); 
        
        // preparando o CPF para validação
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('-','');
       
        if( !ecnpjcpf( ecpf ) ){            
            return false;            
        }

      if( $('#cep').val().substr(0,4) !='88.0' ){
					alert("Você não é morador de Florianópolis !");
					document.getElementById("formIndex").reset();
					err = 'Tem';
					$('#cep').focus();					
				}

        $('#error').addClass('hide');
            var err = '';

            var obj = {
            nome                 : $('#nome').val(),
            genero               : $('#genero').val(),
            dataNasc             : $('#dataNasc').val(),
            logradouro           : $('#logradouro').val(),
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
            turno                : $('#turno').val(),
            etnia                : $('#etnia').val()
          
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
            logradouro           : $('#logradouro').val(),
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

    -->