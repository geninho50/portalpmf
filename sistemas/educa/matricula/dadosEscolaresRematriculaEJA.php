<?php
session_name('re_eja');
session_start();

if (!isset($_SESSION['autenticado_rematricula_eja'])){
    header("Location: index.php");
}

if (!$_SESSION['preenchido']['localizacao']) {
    header('Location: dadosLocalizacaoRematriculaEJA.php');
}


include_once 'fnc/buscaDadosEscolaresEJA.php';

$escolar = buscaDadosEscolaresEJA($_SESSION['id']);

if(isset($escolar[0])){
    $_SESSION['dados_escolares']['segmento'] = $escolar[0];
}
if(isset($escolar[1])){
    $_SESSION['dados_escolares']['nucleo'] = $escolar[1];
}
if(isset($escolar[2])){
    $_SESSION['dados_escolares']['serie_parou'] = $escolar[2];
}

if (count($_POST) > 0) {

    $_SESSION['dados_escolares']['serie_parou'] = $_POST['serieQueParou'];
    $_SESSION['dados_escolares']['nucleo'] = $_POST['nucleo'];
    $_SESSION['dados_escolares']['segmento'] = $_POST['segmento'];

    $_SESSION['preenchido']['dados_escolares'] = true;        

    header("Location: dadosPaisRematriculaEJA.php");
    
}

if(isset($_SESSION['dados_escolares']['serie_parou'])){
    $_POST['serieQueParou'] = $_SESSION['dados_escolares']['serie_parou'];
}
if(isset($_SESSION['dados_escolares']['nucleo'])){
    $_POST['nucleo'] = $_SESSION['dados_escolares']['nucleo'];
}
if(isset($_SESSION['dados_escolares']['segmento'])){
    $_POST['segmento'] = $_SESSION['dados_escolares']['segmento'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados Escolares</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <![endif]-->

          <!-- Fav and touch icons -->
          <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
          <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
          <link rel="shortcut icon" href="ico/favicon.png">
      </head>

      <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Dados de Localização do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <div class="span3" style="padding-left: 10px;">
                        <div class='itemLaranja ativo'>
                            Dados de Identificação  
                        </div>
                        <div class='itemVerde ativo'>
                            Dados Pessoais  
                        </div>
                        <div class='itemRoxo ativo'>
                            Outros Dados
                        </div>
                        <div class='itemAzul ativo'>
                            Dados de Localização
                        </div>
                        <div class='itemMarrom ativo'>
                            Dados Escolares
                        </div>
                        <div class='itemCinza oliva'>
                            Dados dos Pais
                        </div>
                        <div class='itemCinza t'>
                            Dados de Renda
                        </div>
                        <div class='itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <form class="form-horizontal" method="post" onsubmit="">
                            <h4>Dados Escolares</h4>
                            <h5>COORDENADORIA DE EDUCAÇÃO DE JOVENS E ADULTOS</h5>
                            
                            <label class="control-label" for="inputSerie">Série em que <br>parou de estudar</label>
                            <div class="controls" style="line-height: 40px;">
                                <select name='serieQueParou' id="inputSerie" onchange="">
                                    <option value='Nenhuma das opções' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Nenhuma das opções') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Nenhuma das opções</option>
                                    <option value='Primeiro Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Primeiro Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Primeiro Ano</option>
                                    <option value='Segundo Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Segundo Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Segundo Ano</option>
                                    <option value='Terceiro Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Terceiro Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Terceiro Ano</option>
                                    <option value='Quarto Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Quarto Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Quarto Ano</option>
                                    <option value='Quinto Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Quinto Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Quinto Ano</option>
                                    <option value='Sexto Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Sexto Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Sexto Ano</option>
                                    <option value='Sétimo Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Sétimo Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Sétimo Ano</option>
                                    <option value='Oitavo Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Oitavo Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Oitavo Ano</option>
                                    <option value='Nono Ano' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'Nono Ano') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Nono Ano</option>
                                    <option value='EJA Municipal' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'EJA Municipal') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>EJA Municipal</option>
                                    <option value='EJA Estadual' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'EJA Estadual') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>EJA Estadual</option>
                                    <option value='EJA Federal' <?php 
                                    if(isset($_POST['serieQueParou'])){ 
                                        if($_POST['serieQueParou'] == 'EJA Federal') {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>EJA Federal</option>

                                </select>
                            </div>
                            <br>
                            <label class="control-label" for="inputNucleo">Núcleo/Polo</label>
                            <div class="controls" style="line-height: 20px;">
                                <select name='nucleo' id="inputNucleo" onchange="">
                                    <option value='1' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 1) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Centro 1 - Escola Silveira de Souza</option>
                                    <option value='2' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 2) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Centro 2 - EB Donícia Maria da Costa</option>
                                    <option value='3' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 3) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Sul 1 - EB Anísio Teixeira</option>
                                    <option value='4' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 4) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Sul 2 - EB Batista Pereira</option>
                                    <option value='5' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 5) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Norte 1 - EB Profª Herondina Medeiros Zeferino</option>
                                    <option value='6' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 6) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Norte 2 - EB Osmar Cunha</option>
                                    <option value='7' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 7) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Leste 1 - EB João Gonçalves Pinheiro</option>
                                    <option value='8' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 8) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Leste 3 - EB Maria Conceição Nunes</option>
                                    <option value='9' <?php 
                                    if(isset($_POST['nucleo'])){ 
                                        if($_POST['nucleo'] == 9) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Continente 1 - EB Almirante Carvalhal</option>

                                </select>
                            </div>

                            <label class="control-label" for="inputSegmento">Segmento</label>
                            <div class="controls" style="line-height: 20px;">
                                <select name='segmento' id="inputSegmento" onchange="">
                                    <option value='16' <?php 
                                    if(isset($_POST['segmento'])){ 
                                        if($_POST['segmento'] == 16) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>
                                    >Segmento 1</option>
                                    <option value='17'<?php 
                                    if(isset($_POST['segmento'])){ 
                                        if($_POST['segmento'] == 17) {
                                            echo 'selected';
                                        } 
                                    }
                                    ?>>Segmento 2</option>

                                </select>
                            </div>

                            <br>
                            <a class='btn' href='dadosLocalizacaoRematriculaEJA.php'>Voltar</a>
                            <button class='btn btn-primary'>Avan&ccedil;ar</button>
                        </form>
                    </div>   


                    <noscript>
                        <div class="span8" style='padding-left: 10px;'>
                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>AVISO!</strong> Você está com o JavaScript desabilitado. 
                                <bR> Para continuar baixe o navegador Google Chrome <a href='http://www.google.com/intl/pt-BR/chrome/'>aqui</a>
                                    <br> ou habilite o JavaScript em seu navegador seguindo <a href='http://www.enable-javascript.com/pt/'>estas instruções</a>.
                                </div>
                            </div>
                        </noscript>
                    </div>
                </div>

            </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
            function buscaEndereco(cd_cep, id_elemento_logradouro, id_elemento_bairro, id_elemento_localidade, id_elemento_estado) {

                $.get("ajax/endereco.php", {cd_cep: cd_cep})
                .done(function(data) {

                    var ar = JSON.parse(data);
                    $('#foraDaArea').css('display', 'none');
                    $('#CepNaoEncontrado').css('display', 'none');

                    if (ar.length === 8) {
                        if (ar[4] != '8452') {
                            $('#foraDaArea').css('display', 'inherit');
                            $("#" + id_elemento_logradouro).val('');
                            $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                        } else {
                                            //$("#" + id_elemento_estado + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_estado + ">option[value='" + ar[6] + "']").attr('selected', '');
                                            $("#" + id_elemento_estado).attr('disabled', '');
                                            //$("#" + id_elemento_localidade + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_localidade + ">option[value='" + ar[4] + "']").attr('selected', '');
                                            $("#" + id_elemento_localidade).attr('disabled', '');
                                            $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_bairro + ">option[value='" + ar[2] + "']").attr('selected', '');
                                            $("#" + id_elemento_logradouro).val(ar[1]);
                                        }
                                    } else {
                                        $('#CepNaoEncontrado').css('display', 'inherit');
                                    }
                                });

}
$('.dica').tooltip();
$('#conteudo').css('display', 'inherit');
</script>

</body>
</html>
