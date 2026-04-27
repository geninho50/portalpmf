<? 
require_once("backend/db.php"); 

$id = $_GET['id'];
$idBotSub = "submit";
if($id != null){
	$sql = $db->prepare("SELECT * FROM agendamentoGrupos where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);

	if($data != ''){
		$nome                 = utf8_encode($data['nome']);
		$logradouro           = utf8_encode($data['logradouro']);
        $numero               = utf8_encode($data['numero']);
        $complemento          = utf8_encode($data['complemento']);
		$municipio  		  = utf8_encode($data['municipio']);
		$bairro               = utf8_encode($data['bairro']);
		$cep                  = utf8_encode($data['cep']);
		$telefone             = utf8_encode($data['telefone']);
		$celular              = utf8_encode($data['celular']);
		$email1               = utf8_encode($data['email1']);
		$email2               = utf8_encode($data['email2']);
		$turma                = utf8_encode($data['turma']);
		$faixaEtaria          = utf8_encode($data['faixaEtaria']);
		$titulo               = utf8_encode($data['titulo']);
		$data      		      = utf8_encode($data['data']);
		$horario              = utf8_encode($data['horario']);
		$local                = utf8_encode($data['local']);
		$ingressosEstudantes 	 = utf8_encode($data['ingressosEstudantes']);
		$ingressosProfissionais  = utf8_encode($data['ingressosProfissionais']);
		$nomeResponsa     		 = utf8_encode($data['nomeResponsavel']);
		$foneResponsa    		 = utf8_encode($data['foneResponsa']);
		$emailResponsa     		 = utf8_encode($data['emailResponsa']);

	}

	$idBotSub = "update";

}
?>

<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta charset="UTF-8" />
    <title>Agendamento para Grupos</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>
  	
  <body>
    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-6">
                <img src="img/pmf.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>

        <h1>Formulário de Agendamento para Grupos</h1>
        <p>A confirmação do agendamento será feita pela comissão organizadora por meio do e-mail informado no ato da solicitação</p>

        <h3>1- Dados da instituição solicitante</h3>

        <div class="row">
            <div class="col-md-6"><label>Nome:</label><input value="<?=$nome?>" id="nome" class="form-control" type="text"/></div>
	        <div class="col-md-2"><label>CEP:</label><input value="<?=$cep?>" id="cep" name="cep" class="form-control" type="text"/>
					 <span>
		                <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
		            </span>
	        </div>
	        <div class="col-md-4"><label>Endereço:</label><input value="<?=$logradouro?>" id="logradouro" name="logradouro" class="form-control" type="text"/></div>
	    </div><br>

 		<div class="row">
	        <div class="col-md-3"><label>Número:</label><input value="<?=$numero?>" id="numero" name="numero" class="form-control" type="text"/></div>
	        <div class="col-md-3"><label>Complemento:</label><input value="<?=$complemento?>" id="complemento" name="complemento" class="form-control" type="text"/></div>
	        <div class="col-md-3"><label>Bairro:</label><input value="<?=$bairro?>" id="bairro" name="bairro" class="form-control" type="text"/></div>
	        <div class="col-md-3"><label>Cidade:</label><input value="<?=$municipio?>" id="municipio" name="municipio" class="form-control" type="text" /></div>
 		</div>

         <div class="row">
            <div class="col-md-3"><label>Telefone: </label><input value="<?=$telefone?>" id="telefone" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Celular:</label><input value="<?=$celular?>" id="celular" class="form-control" type="text"/></div>

            <div class="col-md-3"><label>Email 1:</label><input value="<?=$email1?>" id="email1" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Email 2:</label><input value="<?=$email2?>" id="email2" class="form-control" type="text"/></div>
        </div>


		<div class="row">
            <div class="col-md-6"><label>Turma/Grupo:</label><input value="<?=$turma?>" id="turma" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Faixa etária do grupo a ser agendado:</label><input value="<?=$faixaEtaria?>" id="faixaEtaria" class="form-control" type="text"/></div>
        </div>


         <h3>2-  Espetáculo a ser agendado</h3>

        <div class="row">
            <div class="col-md-6"><label>Nome/Título:</label><input value="<?=$titulo?>" id="titulo" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Data:</label><input value="<?=$data?>" id="data" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>Horário:</label><input value="<?=$horario?>" id="horario" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Local:</label><input value="<?=$local?>" id="local" class="form-control" type="text"/></div>
        </div>
            
       
        <div class="row">
            <div class="col-md-6"><label>Número de ingressos solicitado para estudantes:</label><input value="<?=$ingressosEstudantes?>" id="ingressosEstudantes" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Número de ingressos solicitado para profissionais:</label><input value="<?=$ingressosProfissionais?>" id="ingressosProfissionais" class="form-control" type="text"/></div>
        </div>

         <h3>3-  Dados do responsável pelo acompanhamento do grupo:</h3>

        <div class="row">
            <div class="col-md-6"><label>Nome:</label><input value="<?=$nomeResponsavel?>" id="nomeResponsavel" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Telefone:</label><input value="<?=$foneResponsa?>" id="foneResponsa" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>E-mail:</label><input value="<?=$emailResponsa?>" id="emailResponsa" class="form-control" type="text"/></div>
        </div>

	 	<div class="responsabilidade">
            <p>*Todos os campos são obrigatórios</p>
            <p>**Qualquer necessidade de alteração na ficha de inscrição deve ser solicitada através do email (artesvisuais.ffc@gmail.com).</p>
        </div>

 		 <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
      
    </div>

    <div class="overlay"></div>


  </div>
  
 </body>
    <script>
				 

    $.get( "backend/verificarGrupo.php").done(function( data ) { 
        var retorno = jQuery.parseJSON(data);
        if(retorno.sucesso == 0){
            $('.overlay, .notice').fadeIn();
        }
    });


    $('#submit').bind('click',function(){
        $('#error').addClass('hide');
            var err = '';
            var obj = {
            nome           : $('#nome').val(),
            logradouro     : $('#logradouro').val(),
            numero         : $('#numero').val(),
            complemento    : $('#complemento').val(),
            municipio      : $('#municipio').val(),
            bairro         : $('#bairro').val(),
            cep            : $('#cep').val(),
            telefone       : $('#telefone').val(),
            celular        : $('#celular').val(),
            email1         : $('#email1').val(),
            email2         : $('#email2').val(),
            turma          : $('#turma').val(),
            faixaEtaria    : $('#faixaEtaria').val(),
            titulo         : $('#titulo').val(),
            data           : $('#data').val(),
            horario        : $('#horario').val(),
            local          : $('#local').val(),
            ingressosProfissionais  : $('#ingressosProfissionais').val(),
            ingressosEstudantes     : $('#ingressosEstudantes').val(),
            nomeResponsavel         : $('#nomeResponsavel').val(),
            foneResponsa            : $('#foneResponsa').val(),
            emailResponsa           : $('#emailResponsa').val()
        };

        $.post( "backend/cadastrarGrupo.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "sucesso.html";
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                window.scrollTo(0, 0);
            }

        });
    });

    function update(){
        $('#error').addClass('hide');
        var err = '';
        var id  = "<?=$id?>";
        var obj = {
            id             : id,
            nome           : $('#nome').val(),
            logradouro     : $('#logradouro').val(),
            numero         : $('#numero').val(),
            complemento    : $('#complemento').val(),
            municipio      : $('#municipio').val(),
            bairro         : $('#bairro').val(),
            cep            : $('#cep').val(),
            telefone       : $('#telefone').val(),
            celular        : $('#celular').val(),
            email1         : $('#email1').val(),
            email2         : $('#email2').val(),
            turma          : $('#turma').val(),
            faixaEtaria    : $('#faixaEtaria').val(),
            titulo         : $('#titulo').val(),
            data           : $('#data').val(),
            horario        : $('#horario').val(),
            local          : $('#local').val(),
            ingressosProfissionais  : $('#ingressosProfissionais').val(),
            ingressosEstudantes     : $('#ingressosEstudantes').val(),
            nomeResponsavel         : $('#nomeResponsavel').val(),
            foneResponsa            : $('#foneResponsa').val(),
            emailResponsa           : $('#emailResponsa').val()
        };
        
        $.post( "backend/editarGrupo.php", obj).done(function( data ) {   
            var retorno = jQuery.parseJSON(data);
            if(retorno.success == 1){
                location.href = "gerenciamento.php";
            }else{
                $('#error').text(retorno.error).removeClass('hide');
            }
        });  
    }
    </script>

</html>