<?php
/*header('location:http://www.pmf.sc.gov.br/sistemas/maratonafotografica/home.php#incricao');
die();*/
include "backend/db.php";

$id = $_GET['id'];
$idBotSub = "submit";

if($id != null){
    $sql = $db->prepare("SELECT * FROM infantoJuvenil where id = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if ($data != '') {
        $nome                = utf8_encode($data['nome']);
        $dataNasc            = utf8_encode($data['dataNasc']);
        $nacionalidade       = utf8_encode($data['nacionalidade']);
        $faixaEtaria         = utf8_encode($data['faixaEtaria']);
        $email               = utf8_encode($data['email']);
        $telefone            = utf8_encode($data['telefone']);
        $celular             = utf8_encode($data['celular']);
        $equipamento         = utf8_encode($data['equipamento']);
        $endereco            = utf8_encode($data['endereco']);
        $bairro              = utf8_encode($data['bairro']);
        $cidade              = utf8_encode($data['cidade']);
        $cep                 = utf8_encode($data['cep']);
        $instituicaoEnsino   = utf8_encode($data['instituicaoEnsino']);
        $instituicaoTelefone = utf8_encode($data['instituicaoTelefone']);
        $responsavelNome     = utf8_encode($data['responsavelNome']);
        $responsavelProfissao= utf8_encode($data['responsavelProfissao']);
        $responsavelRG       = utf8_encode($data['responsavelRG']);
        $responsavelCPF      = utf8_encode($data['responsavelCPF']);
        $banco               = utf8_encode($data['banco']);
        $agencia             = utf8_encode($data['agencia']);
        $bancoNum            = utf8_encode($data['bancoNum']);
        $contaNum            = utf8_encode($data['ContaNum']);
		$parentesco          = utf8_encode($data['parentesco']);
        $cpf                 = utf8_encode(($data['cpf']) ? $data['cpf'] : "");

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


        <h1>Inscrição Infantojuvenil</h1>

        <div class="row">
            <div class="col-md-6">
                <label>Nome Completo:</label><input value="<?=$nome?>" id="nome" class="form-control" type="text"/>
            </div>
            <div class="col-md-6">
                <label>CPF do menor:</label><input value="<?=$cpf?>" id="cpf" class="form-control" type="text"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Nacionalidade:</label><input value="<?=$nacionalidade?>"id="nacionalidade" class="form-control" type="text" />
            </div>
            <div class="col-md-6">
                <label>Data de Nascimento:</label><input value="<?=$dataNasc?>" id="dataNasc" class="form-control" type="text"/>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                var faixaEtaria = "<?=$faixaEtaria?>";
                if(faixaEtaria != "") {
                    document.getElementsByName("idade")[faixaEtaria - 1].checked = true;
                }
            });
        </script>

        <div class="row">
            <div class="col-md-6">
                        
                <label>Faixa Etária:</label><br>
                
                <label class="radio-inline">
                    <input type="radio" name="idade"  value="1" class="faixaEtaria"> 06 aos 09 anos
                </label>
               
                <label class="radio-inline">
                  <input type="radio" name="idade"  value="2" class="faixaEtaria"> 10 aos 12 anos 
                </label>
               
                <label class="radio-inline" id="semMargem">
                  <input type="radio" name="idade"  value="3" class="faixaEtaria"> 13 aos 15 anos
                </label>

                <label class="radio-inline">
                  <input type="radio" name="idade"  value="4" class="faixaEtaria"> 16 aos 17 anos
                </label>

            </div>
                <div class="col-md-6"><label>Equipamento (Câmera-Marca/Modelo) :</label><input value="<?=$equipamento?>" id="equipamento" class="form-control" type="text"/></div>
            </div>
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
            <div class="col-md-6"><label>Instituição de ensino que estuda: </label><input value="<?=$instituicaoEnsino?>" id="instituicaoEnsino" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Telefone da instituição:</label><input value="<?=$instituicaoTelefone?>" id="instituicaoTelefone" class="form-control" type="text"/></div>
        </div>

        <div class="row">
        <hr>

            <h4>Dados do responsável</h4>
            <div class="col-md-6">
                <label>Nome:</label> <input value="<?=$responsavelNome?>" id="responsavelNome" class="form-control" type="text"></input>
            </div>
            <div class="col-md-6">
                <label>Profissão:</label> <input value="<?=$responsavelProfissao?>" id="responsavelProfissao" class="form-control" type="text"></input>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>Parentesco:</label><input value="<?=$parentesco?>" id="parentesco" class="form-control" type="text"></input></div>
            <div class="col-md-6"><label>E-Mail:</label><input value="<?=$email?>" id="email" class="form-control" type="email"/></div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>Celular:</label><input value="<?=$celular?>" id="celular" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Telefone:</label><input value="<?=$telefone?>" id="telefone" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-6"><label>RG: </label><input value="<?=$responsavelRG?>"id="responsavelRG" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>CPF:</label><input value="<?=$responsavelCPF?>"id="responsavelCPF" class="form-control" type="text"/></div>
        </div>

        <div class="row">
            <div class="col-md-3"><label>Banco:</label><input value="<?=$banco?>" id="banco" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Nº do Pix:</label><input value="<?=$bancoNum?>" id="bancoNum" class="form-control" type="text" /></div>
            <div class="col-md-3"><label>Agência:</label><input value="<?=$agencia?>" id="agencia" class="form-control" type="text"/></div>
            <div class="col-md-3"><label>Nº da Conta:</label><input value="<?=$contaNum?>" id="contaNum" class="form-control" type="text"/></div>
        </div>
		
		 

        <?php if($id != null){?>
            <input type="button" name="update" onclick="update()" id="update" class="btn btn-primary botao" value="Atualizar" 
        <?php } else{?>

       <div class="responsabilidade">
            <p>*Todos os campos são obrigatórios</p>
            <p>**Ao clicar em enviar será gerado um termo de responsabilidade para <b>impressão e entrega</b> no dia e local da abertura do concurso, das 9h às 12h.</p>
            <p>***Solicitamos que o preenchimento da ficha de inscrição seja feito após a leitura do Regulamento da 28ª Maratona Fotográfica de Florianópolis, pois é permitido somente uma inscrição por CPF.
            </p>
            <p>****Qualquer necessidade de alteração na ficha de inscrição deve ser solicitada através do email (artesvisuais.ffc@gmail.com).</p>
        </div>
        
        <div class="responsabilidade">
            <p><strong>DECLARO</strong> para os devidos fins e sob as penas da Lei que sou responsável ou representante legal menor inscrito.</p>

             <p><strong>DECLARO</strong> que a <strong>FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN CASCAES e organizadores</strong> da <strong>“28ª Maratona Fotográfica de Florianópolis”</strong>  estão isentos integralmente de toda e qualquer responsabilidade advinda da conduta do Participante deste Concurso e das implicações que dela advirem, inclusive, quanto à responsabilidade pelo uso indevido ou pela violação de quaisquer direitos de terceiros, sem prejuízo do direito de regresso que possui.</p>

            <p><strong>DECLARO</strong> também que estou ciente de que a <strong>FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN
            CASCAES e organizadores</strong> não se responsabilizam por danos de qualquer natureza, incluídos danos à integridade física, danos materiais e morais ou prejuízo oriundo da participação neste Concurso ou da aceitação do Prêmio, e ainda, que aos organizadores é reservado, a qualquer momento, o direito de cancelar ou suspender, bem como interromper o Concurso, caso ocorram fraudes, dificuldades técnicas ou qualquer outro impedimento causado por força maior que comprometa a integridade do Concurso, de forma que não possa ser conduzido como originalmente planejado, não lhes cabendo qualquer responsabilidade advinda deste cancelamento ou tampouco deva indenizações de quaisquer tipos e a quaisquer títulos.</p>

            <p><strong>CONCORDO</strong> com o Termo de Cessão e Autorização de Uso de Imagem (Fotografia) que consta no Regulamento da
             <strong>“28ª Maratona Fotográfica de Florianópolis”</strong> (Anexo 1) e me <strong>COMPROMETO</strong> a entregá-lo impresso e assinado, caso venha a ser premiado pelo Concurso, em local a ser definido eno prazo determinado pela Comissão Organizadora.</p>

            <p><strong>DECLARO, nesta data, ter lido, compreendido e estar de acordo com todos os itens do Regulamento da “28ª Maratona
            Fotográfica de Florianópolis”</strong> que está disponível <a href="pdf/regulamento28pronto.pdf" target="_blank">AQUI</a>.
            </p>

            <p>Sendo esta a expressão da verdade, o (a) <strong>RESPONSÁVEL PELO MENOR</strong> firma o presente, em caráter irrevogável e irretratável, na forma da Lei.</p>
            </div>

        <div class="check">
            <input type="checkbox" id="check">
			DECLARO, nesta data, ter lido, compreendido e estar de acordo com todos os itens do Regulamento da “28ª Maratona Fotográfica de Florianópolis” que esta disponível <a href="pdf/regulamento28pronto.pdf" target="_blank">AQUI.</a>
            <br>
            <input type="button" disabled name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
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
    $('#telefoneColegio').mask("(99) 9999-9999");
    $('#celular').mask("(99) 99999-9999");
    $('#dataNasc').mask("99/99/9999");
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");
    $('#responsavelCPF').mask("999.999.999-99");
    $('#instituicaoTelefone').mask("(99) 9999-9999");

    $.get( "backend/verificarInfantoJuvenil.php").done(function( data ) { 
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
            nome                 : $('#nome').val(),
            nacionalidade        : $('#nacionalidade').val(),
            dataNasc             : $('#dataNasc').val(),
            faixaEtaria          : $('.faixaEtaria:checked').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            equipamento          : $('#equipamento').val(),
            endereco             : $('#endereco').val(),
            cidade               : $('#cidade').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            parentesco           : $('#parentesco').val(),
            instituicaoEnsino    : $('#instituicaoEnsino').val(),
            instituicaoTelefone  : $('#instituicaoTelefone').val(),
            responsavelNome      : $('#responsavelNome').val(),
            responsavelProfissao : $('#responsavelProfissao').val(),
            responsavelRG        : $('#responsavelRG').val(),
            responsavelCPF       : $('#responsavelCPF').val(),
            banco                : $('#banco').val(),
            bancoNum             : $('#bancoNum').val(),
            agencia              : $('#agencia').val(),
            contaNum             : $('#contaNum').val(),
            cpf                  : $('#cpf').val()
        };

        $.post( "backend/cadastrarInfantoJuvenil.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "backend/pdfInfantoJuvenil.php";
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
        	id                   : id,
            nome                 : $('#nome').val(),
            nacionalidade        : $('#nacionalidade').val(),
            dataNasc             : $('#dataNasc').val(),
            faixaEtaria          : $('.faixaEtaria:checked').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            equipamento          : $('#equipamento').val(),
            endereco             : $('#endereco').val(),
            cidade               : $('#cidade').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            parentesco           : $('#parentesco').val(),
            instituicaoEnsino    : $('#instituicaoEnsino').val(),
            instituicaoTelefone  : $('#instituicaoTelefone').val(),
            responsavelNome      : $('#responsavelNome').val(),
            responsavelProfissao : $('#responsavelProfissao').val(),
            responsavelRG        : $('#responsavelRG').val(),
            responsavelCPF       : $('#responsavelCPF').val(),
            banco                : $('#banco').val(),
            bancoNum             : $('#bancoNum').val(),
            agencia              : $('#agencia').val(),
            contaNum             : $('#contaNum').val(),
            cpf                  : $('#cpf').val()
        };
        
        $.post( "backend/editarInfantoJuvenil.php", obj).done(function( data ) {
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