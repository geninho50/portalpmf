<?php
include "backend/db.php"; 


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `infraestrutura`.`dados` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){
        $nome            = utf8_encode($data['nome']);
        $localidade      = utf8_encode($data['localidade']);
        $fone            = utf8_encode($data['fone']);
        $email           = utf8_encode($data['email']);
        $proposta        = utf8_encode($data['proposta']);
        $justificativa   = utf8_encode($data['justificativa']);
        $metodologia     = utf8_encode($data['metodologia']);
        $entidade        = utf8_encode($data['entidade']);
    }    
    $idBotSub = "update";
}
?>

<!DOCTYPE HTML> 
<html>
	<head>
		<title>SISTEMA DE ESGOTAMENTO SANITÁRIO</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>


		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<div class="logo">
						<img src="images/Prefeitura.png" alt=""/>
					</div>
					<header class="align-center">
						<h2><Strong>CONSULTA PÚBLICA</Strong></h2>
						<h2>CONCEPÇÃO GERAL DO SISTEMA DE ESGOTAMENTO SANITÁRIO</h2>

					</header>
				</div>
			</section>

		<!-- Main -->
			<div id="main" class="container">
			
							<!-- Form -->
								<h2>Preencha as informações para contribuir com o trabalho em andamento</h2>
								<p>Caso queira inserir um documento, envie-o para o email: <strong>ouvindoasociedade@pmf.sc.gov.br</strong></p>

								<div class="alert alert-danger" id="error" style="background-color:#FF6666; color: white;"></div><br>

								<form method="post" action="backend/cadastrarInfra.php" id="frm1" enctype="multipart/form-data">
									<div class="row uniform">
										<div class="6u 12u$(xsmall)">
											<label>Nome completo</label><input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?=$nome?>" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>Localidade em que reside:</label><input type="text" name="localidade" id="localidade" placeholder="Localidade" value="<?=$localidade?>" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label>Telefone</label><input type="text" name="fone1" id="fone1" placeholder="Telefone" value="<?=$fone?>" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>E-mail</label><input type="text" name="email" id="email" placeholder="E-mail" value="<?=$email?>" />
										</div>

										<div class="6u 12u$(xsmall)">
											<label>Proposta (o que fazer)</label><textarea name="proposta" id="proposta" placeholder="Escreva aqui O QUE fazer" value="<?=$proposta?>" rows="6"></textarea>
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>Justificativa (por que fazer)</label><textarea name="justificativa" id="justificativa" placeholder="Escreva aqui POR QUE fazer" rows="6" value="<?=$justificativa?>"></textarea>
										</div>
										<div class="6u 12u$(xsmall)">
											<label>Metodologia (como fazer)</label><textarea name="metodologia" id="metodologia" placeholder="Escreva aqui COMO fazer" rows="6" value="<?=$metodologia?>"></textarea>
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label>Se representar algum movimento ou entidade, favor informar</label><input type="text" name="entidade" id="entidade" placeholder="Se representar algum movimento ou entidade" value="<?=$entidade?>" />
										</div>

										<input id="estado" class="form-control field" type="hidden" value="SC" />

										<div class="12u$">
											<ul class="actions">
												<li><input type="button" id="btnSubmit" name="btnSubmit" value="Salvar"  onclick=""/></li>
												<li><a href="http://www.pmf.sc.gov.br/sistemas/Infraestrutura" class="button alt">VOLTAR</a></li>
											</ul>
										</div>
									</div>
								</form>


						</div>
					</div>

			</div>


		<!-- Footer -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<script type="text/javascript">

		    $('#fone1').mask("(99) 999999999");

    $('#btnSubmit').bind('click',function(){

        $('#error').addClass('hide');
            var err = '';

            var obj = {
            nome             : $('#nome').val(),
            localidade       : $('#localidade').val(),
            fone1            : $('#fone1').val(),
            email            : $('#email').val(),
            proposta         : $('#proposta').val(),
            justificativa    : $('#justificativa').val(),
            metodologia      : $('#metodologia').val(),
            entidade         : $('#entidade').val()          
        };
    

    
           var obj = new FormData($("#frm1").get(0));
           $('#btnSubmit').attr("disabled", true);
                  

           $.ajax({
               type: "POST",
               url: "backend/cadastrarInfra.php",
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



			   

</script>

	</body>
</html>