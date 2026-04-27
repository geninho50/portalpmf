<?php
/*header('location:http://www.pmf.sc.gov.br/sistemas/maratonafotografica/home.php#incricao');
die();*/


require_once("backend/db.php"); 

$id = $_GET['id'];
$idBotSub = "submit";
if($id != null){
	$sql = $db->prepare("SELECT * FROM filmeEdigital where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);

	if($data != ''){
		$nome             = utf8_encode($data['nome']);
		$nacionalidade    = utf8_encode($data['nacionalidade']);
		$rg               = utf8_encode($data['rg']);
		$cpf              = utf8_encode($data['cpf']);
		$dataNasc         = utf8_encode($data['dataNasc']);
		$modalidade       = utf8_encode($data['modalidade']);
		$email            = utf8_encode($data['email']);
		$telefone         = utf8_encode($data['telefone']);
		$celular          = utf8_encode($data['celular']);
		$equipamento      = utf8_encode($data['equipamento']);
		$endereco         = utf8_encode($data['endereco']);
		$cidade           = utf8_encode($data['cidade']);
		$bairro           = utf8_encode($data['bairro']);
		$cep              = utf8_encode($data['cep']);
		$profissao        = utf8_encode($data['profissao']);
		$localTrabalho    = utf8_encode($data['localTrabalho']);
		$banco            = utf8_encode($data['banco']);
		$bancoNum         = utf8_encode($data['bancoNum']);
		$agencia          = utf8_encode($data['agencia']);
		$contaNum         = utf8_encode($data['ContaNum']);

        $dataNasc = explode('-', $dataNasc);     // transforma em array
        $dataNasc = array_reverse($dataNasc);    // inverte posicoes do array
        $dataNasc = implode('/', $dataNasc);     // transforma em string novamente


	}
	$idBotSub = "update";


}
?>

<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta charset="UTF-8">
    <title>Maratona Fotográfica</title>
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
                <img src="img/fcc.png" class="fcc"> 
            </div> 
            <div class="col-md-6">
                <img src="img/thumbs/28/logoMaratonaPreta.png" class="pmf"> 
            </div>
        </div>

        <h1>Inscrição Analógica e Digital</h1>

        <div class="row">

            <div class="col-md-6">
                <label>Nome Completo:</label><input value="<?=$nome?>" id="nome" class="form-control" type="text"/>
            </div>

            <div class="col-md-6">
                <label>Nacionalidade:</label><input value="<?=$nacionalidade?>" id="nacionalidade" class="form-control" type="text"></input>
            </div>

            
            <div class="col-md-6"><label>RG: </label><input value="<?=$rg?>" id="rg" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>CPF:</label><input value="<?=$cpf?>" id="cpf" class="form-control" type="text"/></div>
            

            <div class="col-md-6">
                 <label>Data de Nascimento:</label><input value="<?=$dataNasc?>" id="dataNasc" class="form-control" type="text"/>
            </div>

            <script>
                $(document).ready(function(){
                    var modalidade = "<?=$modalidade?>";
                    if(modalidade != ""){
                        document.getElementsByName("modalidade")[modalidade].checked = true;
                    }
                });
            </script>

            <div class="col-md-6">
                <label>Modalidade:</label><br>
                <!-- <p style="color: red;font-size:12px;"><strong>Todas as vagas para a modalidade analógica foram preenchidas.</strong></p> -->

                <label class="radio-inline">
                  <!-- <input type="radio" name="modalidade" value="0" class="modalidade" disabled> Analógica -->
                  <input type="radio" name="modalidade" value="0" class="modalidade"> Analógica
                </label>
                <label class="radio-inline">
                  <input type="radio" name="modalidade" value="1" class="modalidade"> Câmeras Digitais
                </label>
                <!-- <label class="radio-inline">
                  <input type="radio" name="modalidade" value="2" class="modalidade"> Digital 2
                </label> -->
                <label class="radio-inline">
                  <input type="radio" name="modalidade" value="3" class="modalidade"> Digital Mobile
                </label>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>E-Mail:</label><input value="<?=$email?>" id="email" class="form-control" type="email"/></div>
            <div class="col-md-6"><label>Equipamento (Câmera-Marca/Modelo) :</label><input value="<?=$equipamento?>" id="equipamento" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>Celular:</label><input value="<?=$celular?>" id="celular" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Telefone:</label><input value="<?=$telefone?>" id="telefone" class="form-control" type="text"/></div>
        </div>

        <script>
            $(document).ready(function(){
                $("#cep").change(function () {
                    $.get( "https://viacep.com.br/ws/"+$("#cep")[0].value+"/json/").done(function( data ) {
                        $("#endereco")[0].value = data.logradouro;
                        $("#bairro")[0].value = data.bairro;
                        $("#cidade")[0].value = data.localidade;
                    }).fail(function () {
                        alert("CEP não encontrado.");
                    });
                });
            });
        </script>
        <div class="row">
            <div class="col-md-6"><label>CEP:</label><input value="<?=$cep?>" id="cep" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Endereço Completo:</label><input value="<?=$endereco?>" id="endereco" class="form-control" type="text"/></div>
        </div>

        <div class="row">     
            <div class="col-md-6"><label>Bairro:</label><input value="<?=$bairro?>" id="bairro" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Cidade:</label><input value="<?=$cidade?>" id="cidade" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>Profissão:</label><input value="<?=$profissao?>" id="profissao" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Local de Trabalho:</label><input value="<?=$localTrabalho?>" id="localTrabalho" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-3"><label>Banco:</label><input value="<?=$banco?>" id="banco" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Nº do Pix:</label><input value="<?=$bancoNum?>" id="bancoNum" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Agência:</label><input value="<?=$agencia?>" id="agencia" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Nº da Conta:</label><input value="<?=$contaNum?>" id="contaNum" class="form-control" type="text"/></div>
        </div>

        <?php if($id != null){?>
       		     <input type="button" name="update" onclick="update()" id="update" class="btn btn-primary botao" value="Atualizar" />
	 	    <?php } else{?>
	 	<div class="responsabilidade">
            <p>*Todos os campos são obrigatórios</p>
            <p>**Ao clicar em enviar será gerado um termo de responsabilidade para <b>impressão e entrega</b> no dia e local da abertura do concurso, das 9h às 12h.</p>
            <p>***Solicitamos que o preenchimento da ficha de inscrição seja feito após a leitura do Regulamento da 28ª Maratona Fotográfica de Florianópolis, pois é permitido somente uma inscrição por CPF.</p>
            <p>****Qualquer necessidade de alteração na ficha de inscrição deve ser solicitada através do email (artesvisuais.ffc@gmail.com).</p>
        </div>

        <div class="responsabilidade">
                    <p><strong>DECLARO</strong> que a <strong>FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN CASCAES e organizadores</strong> da <strong>“28ª Maratona Fotográfica de Florianópolis”</strong>  estão isentos integralmente de toda e qualquer responsabilidade advinda da conduta do Participante deste Concurso e das implicações que dela advirem, inclusive, quanto à responsabilidade pelo uso indevido ou pela violação de quaisquer direitos de terceiros, sem prejuízo do direito de regresso que possui.</p>

                    <p><strong>DECLARO</strong> também que estou ciente de que a <strong>FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN
                    CASCAES e organizadores</strong> não se responsabilizam por danos de qualquer natureza, incluídos danos à integridade física, danos materiais e morais ou prejuízo oriundo da participação neste Concurso ou da aceitação do Prêmio, e ainda, que aos organizadores é reservado, a qualquer momento, o direito de cancelar ou suspender, bem como interromper o Concurso, caso ocorram fraudes, dificuldades técnicas ou qualquer outro impedimento causado por força maior que comprometa a integridade do Concurso, de forma que não possa ser conduzido como originalmente planejado, não lhes cabendo qualquer responsabilidade advinda deste cancelamento ou tampouco deva indenizações de quaisquer tipos e a quaisquer títulos.</p>

                    <p><strong>CONCORDO</strong> com o Termo de Cessão e Autorização de Uso de Imagem (Fotografia) que consta no Regulamento da
                     <strong>“28ª Maratona Fotográfica de Florianópolis”</strong> (Anexo 1) e me <strong>COMPROMETO</strong> a entregá-lo impresso e assinado, caso venha a ser premiado pelo Concurso, em local a ser definido eno prazo determinado pela Comissão Organizadora.</p>

                    <p><strong>DECLARO, nesta data, ter lido, compreendido e estar de acordo com todos os itens do Regulamento da “28ª Maratona
                    Fotográfica de Florianópolis”</strong> que está disponível <a href="pdf/regulamento28pronto.pdf" target="_blank">AQUI</a>.</p>

                    <p>Sendo esta a expressão da verdade, o (a) <strong>PARTICIPANTE</strong> firma o presente, em caráter irrevogável e irretratável, na forma da lei.</p>
                </div>
                
	 	    <div class="check">
			  <input type="checkbox" id="check">
				DECLARO, nesta data, ter lido, compreendido e estar de acordo com todos os itens do Regulamento da “28ª Maratona Fotográfica de Florianópolis” que esta disponível <a href="pdf/regulamento28pronto.pdf" target="_blank"> AQUI.</a>
				<br>
			  <input type="button" disabled name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
            </div>
    </div>

    <div class='notice'>
        <h1>Inscrições encerradas!</h1>
        <h4>Limites máximo de vagas atingido.</h4>
    </div>

    <div class="overlay"></div>

	<?php }?>

    </div>

  </body>
    <script>
    $('#telefone').mask("(99) 9999-9999");
    $('#celular').mask("(99) 99999-9999");
    $('#dataNasc').mask("99/99/9999");
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");

    $.get( "backend/verificarFilmeEdigital.php").done(function( data ) { 
        var retorno = jQuery.parseJSON(data);
        if(retorno.sucesso == 0){
            $('.overlay, .notice').fadeIn();
        }
    });


    $('#check').bind('click',function(){
        if($(this).is(':checked') ){
            $('#submit').prop( "disabled", false );
        }else{
            $('#submit').prop( "disabled", true );
        }
    });


    $('#submit').bind('click',function(){
        $('#error').addClass('hide');
            var err = '';
            var obj = {
            nome           : $('#nome').val(),
            nacionalidade  : $('#nacionalidade').val(),
            rg             : $('#rg').val(),
            cpf            : $('#cpf').val(),
            dataNasc       : $('#dataNasc').val(),
            modalidade     : $('.modalidade:checked').val(),
            email          : $('#email').val(),
            telefone       : $('#telefone').val(),
            celular        : $('#celular').val(),
            equipamento    : $('#equipamento').val(),
            endereco       : $('#endereco').val(),
            cidade         : $('#cidade').val(),
            bairro         : $('#bairro').val(),
            cep            : $('#cep').val(),
            profissao      : $('#profissao').val(),
            localTrabalho  : $('#localTrabalho').val(),
            banco          : $('#banco').val(),
            bancoNum       : $('#bancoNum').val(),
            agencia        : $('#agencia').val(),
            contaNum       : $('#contaNum').val()
        };

        $.post( "backend/cadastrarFilmeEdigital.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "backend/pdfFilmeEdigital.php";
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                window.scrollTo(0, 0);
            }

        });
    });

    function update(){
        location.reload();
        $('#error').addClass('hide');
        var err = '';
        var id  = "<?=$id?>";
        var obj = {
            id             : id,
            nome           : $('#nome').val(),
            nacionalidade  : $('#nacionalidade').val(),
            rg             : $('#rg').val(),
            cpf            : $('#cpf').val(),
            dataNasc       : $('#dataNasc').val(),
            modalidade     : $('.modalidade:checked').val(),
            email          : $('#email').val(),
            telefone       : $('#telefone').val(),
            celular        : $('#celular').val(),
            equipamento    : $('#equipamento').val(),
            endereco       : $('#endereco').val(),
            cidade         : $('#cidade').val(),
            bairro         : $('#bairro').val(),
            cep            : $('#cep').val(),
            profissao      : $('#profissao').val(),
            localTrabalho  : $('#localTrabalho').val(),
            banco          : $('#banco').val(),
            bancoNum       : $('#bancoNum').val(),
            agencia        : $('#agencia').val(),
            contaNum       : $('#contaNum').val()
        };
        
        $.post( "backend/editarFilmeEdigital.php", obj).done(function( data ) {   
            var retorno = jQuery.parseJSON(data);

            if(retorno.successo == 0){
                $('#error').text(retorno.error).removeClass('hide');
            }else{
                location.href = "http://www.pmf.sc.gov.br/sistemas/maratonafotografica/gerenciamento.php";
            }
        });  
    }
    </script>

</html>