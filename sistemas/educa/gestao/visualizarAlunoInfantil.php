<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

if (!isset($_GET['idAluno'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    include 'fnc/buscaAluno.php';
    $aluno = buscaAluno($_GET['idAluno']);
    if ($aluno != false) {
        include 'fnc/buscaInfoAluno.php';
        $infoAluno = buscaInfoAluno($_GET['idAluno']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Visualizar Aluno</title>
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
          <style>
            .controls {
                text-align: left;
                padding-left: 40px;
            }
            .control-group {
                padding-left: 120px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>

                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Visualizar Aluno</h2>
                    <h4><?php echo ($aluno[2]).' &middot; '.($aluno[0]); ?></h4>
                </div>
                <hr>
                <div class="bs-docs-example">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#aluno" data-toggle="tab">Aluno</a></li>
                        <li><a href="#responsaveis" data-toggle="tab">Responsáveis</a></li>
                        <li><a href="#saude" data-toggle="tab">Saúde</a></li>
                        <li><a href="#outros" data-toggle="tab">Outros Dados</a></li>
                        <li><a href="#renda" data-toggle="tab">Renda</a></li>
                        <li><a href="#escolar" data-toggle="tab">Dados Escolares</a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="aluno">
                            <div class="row-fluid">
                                <div class="span12" style='padding: 20px; padding-top: 0px;'>
                                    <?php
                                    if ($aluno == false) {
                                        echo "<h3>Aluno não encontrado.</h3>";
                                    } else {
                                        $data = explode('-', $aluno[1]);
                                        $data = $data[2] . '/' . $data[1] . '/' . $data[0];

                                        if ($infoAluno[0] == 'M') {
                                            $sexo = 'Masculino';
                                        } else if ($infoAluno[0] == 'F') {
                                            $sexo = 'Feminino';
                                        } else {
                                            $sexo = 'Não informado';
                                        }

                                        include 'fnc/buscaEtnia.php';
										$etnia = buscaEtnia($infoAluno[1]);
                                        $etnia = $etnia[1];

                                        include 'fnc/buscaNacionalidade.php';
										$nacionalidade = buscaNacionalidade($infoAluno[2]);
                                        $nacionalidade = $nacionalidade[1][1];

                                        if(isset($infoAluno[2])){}
                                        include 'fnc/buscaMunicipio.php';
                                            $cidadet = 
                                        include 'fnc/buscaEstado.php';
                                        if ($infoAluno[2] == 30) {
                                            $municipio = buscaMunicipio($infoAluno[3]);
                                            $cidade = $municipio[1][1];
                                            $nomeEstado =  buscaNomeEstado($municipio[1][3]);
                                            $estado = $nomeEstado[1];
                                        }

                                        include_once 'fnc/buscaDocumento.php';
                                        $rg = buscaDocumento($_GET['idAluno'], 1);
                                        $certNova = buscaDocumento($_GET['idAluno'], 2);

                                        if($certNova == false){
                                            $cert = buscaDocumento($_GET['idAluno'], 4);
                                        }
                                        
                                        include 'fnc/buscaAlunoEndereco.php';
                                        $endAluno = buscaAlunoEndereco($_GET['idAluno']);
                                        if(isset($endAluno[4])){
                                        include 'fnc/buscaBairro.php';
                                        $cep = substr($endAluno[11], 0, 2) . '.' . substr($endAluno[11], 2, 3) . '-' . substr($endAluno[11], 5, 3);

                                        $municipioEnd = buscaMunicipio($endAluno[4]);
                                        $cidadeEnd = $municipioEnd[1][1];
										$nomeEstado = buscaNomeEstado($municipioEnd[1][3]);
                                        $estadoEnd = $nomeEstado[1];
                                        }else{
                                        $municipioEnd = "";
                                        $cidadeEnd = "";
                                        $estadoEnd = "";
                                        }
                                        ?>
                                        <h3>Dados Pessoais</h3>
                                        <h5>&middot; Matrícula: <?php echo ($aluno[2]); ?></h5>
                                        <h5>&middot; Nome: <?php echo ($aluno[0]); ?></h5>
                                        <h5>&middot; Data de Nascimento: <?php echo $data; ?></h5>
                                        <h5>&middot; Sexo: <?php echo $sexo; ?></h5>
                                        <h5>&middot; Etnia: <?php if ($etnia != false) echo $etnia; ?></h5>

                                        <?php
                                        if($rg != false){
                                            $temp = explode('/', $rg[4]);
                                            $data = explode('-', $rg[5]);
                                            $dataEmissao = $data[2].'/'.$data[1].'/'.$data[0];
                                            ?>

                                            <h5>&middot; RG: <?php echo $rg[3]; ?></h5>
                                           <?php $nomeEstado2 = buscaNomeEstado($temp[1]); ?>
                                            <h5>&middot; Órgão Emissor do RG: <?php echo $temp[0].'/'.$nomeEstado2[2]; ?></h5>
                                            <h5>&middot; Data de Emissão do RG: <?php echo $dataEmissao; ?></h5>

                                            <?php
                                        }
                                        if($certNova != false){
                                            ?>

                                            <h5>&middot; Certidão (Modelo Novo): <?php echo $certNova[3]; ?></h5>

                                            <?php
                                        } else {
                                            if($cert != false){
                                                ?>

                                                <h5>&middot; Certidão (Modelo Antigo): <?php echo $cert[3]; ?></h5>
                                                <h5>&middot; Folha: <?php echo $cert[6]; ?></h5>
                                                <h5>&middot; Livro: <?php echo $cert[7]; ?></h5>
                                                <h5>&middot; Cartório: <?php echo $cert[8]; ?></h5>
                                                <?php $nomeEstado3 = buscaNomeEstado($cert[9]); ?>
                                                <h5>&middot; UF do Cartório: <?php echo $nomeEstado3[1]; ?></h5>

                                                <?php
                                            }
                                        }
                                        ?>

                                        <h5>&middot; País de Nacionalidade: <?php echo ($nacionalidade); ?></h5>
                                        <h5>&middot; Naturalidade: 
                                            <?php
                                            if (isset($cidade)) {
                                                echo ($cidade);
                                            }
                                            ?></h5>
                                            <h5>&middot; Naturalidade (UF): 
                                                <?php
                                                if (isset($estado)) {
                                                    echo ($estado);

                                                    if(isset($endAluno[6])){
                                                }
                                                ?></h5>
                                                <h3>Localização</h3>
                                                <h5>&middot; Logradouro: <?php echo $endAluno[6]; ?></h5>
                                                <h5>&middot; Número: <?php echo $endAluno[7]; ?></h5>
                                                 <?php $bairro = buscaBairro($endAluno[3]); ?>
                                                <h5>&middot; Bairro: <?php echo ($bairro[$endAluno[3]][1]); ?></h5>
                                                <h5>&middot; CEP: <?php echo $cep; ?></h5>
                                                <h5>&middot; Cidade: <?php echo ($cidadeEnd); ?></h5>
                                                <h5>&middot; Estado: <?php echo ($estadoEnd); ?></h5>
                                                <?php } else{?>
                                                <h3>Localização</h3>
                                                <h5>&middot; Logradouro: </h5>
                                                <h5>&middot; Número: </h5>
                                                <h5>&middot; Bairro: </h5>
                                                <h5>&middot; CEP: </h5>
                                                <h5>&middot; Cidade: </h5>
                                                <h5>&middot; Estado: </h5>
                                                <?php 
                                            } }
                                                include_once 'fnc/buscaTel.php';
                                                $telefones2 = buscaTel($_GET['idAluno']);
                                                if (isset($telefones2[1])) {
                                                    $tempTel['celular'] = $telefones2[1][3] . $telefones2[1][4];
                                                }
                                                if (isset($telefones2[2])) {
                                                    $tempTel['comercial'] = $telefones2[2][3] . $telefones2[2][4];
                                                }
                                                if (isset($telefones2[3])) {
                                                    $tempTel['residencial'] = $telefones2[3][3] . $telefones2[3][4];
                                                }

                                                if (isset($tempTel['residencial'])) {
                                                    $residencialAluno = '(' .substr($tempTel['residencial'], 0, 2) . ')' .substr($tempTel['residencial'], 2);
                                                } else {
                                                    $residencialAluno = '';
                                                }
                                                if (isset($tempTel['comercial'])) {
                                                    $comercialAluno = '(' .substr($tempTel['comercial'], 0, 2) . ')' .substr($tempTel['comercial'], 2);
                                                } else {
                                                    $comercialAluno = '';
                                                }
                                                if (isset($tempTel['celular'])) {
                                                    $celularAluno = '(' .substr($tempTel['celular'], 0, 2) . ')' .substr($tempTel['celular'], 2);
                                                } else {
                                                    $celularAluno = '';
                                                }
                                                ?>

                                                <h3>Telefones</h3>
                                                <h5>&middot; Residencial: <?php echo $residencialAluno; ?></h5>
                                                <h5>&middot; Comercial: <?php echo $comercialAluno; ?></h5>
                                                <h5>&middot; Celular: <?php echo $celularAluno; ?></h5>

                                                <hr>
                                                <a class='btn pull-right' onclick="history.go(-1);">Voltar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="responsaveis">

                                        <?php 

                                        include_once 'fnc/buscaResponsavel.php';
                                        $mae = buscaResponsavelAluno($_GET['idAluno'], 1);
                                        include_once 'fnc/buscaTurnosTrabalho.php';
                                        ?>
                                        <div style='padding-left: 30px;'>
                                            <h3>Dados da Mãe</h3>
                                            <?php

                                            if($mae != false){
                                                include_once 'fnc/buscaPessoaFisica.php';
                                                $dadosMae = buscaPessoaFisicaTotal($mae[0]);

                                                include_once 'fnc/buscaReligiao.php';
                                                include_once 'fnc/buscaProfissao.php';
                                                include_once 'fnc/buscaEstadoCivil.php';
                                                include_once 'fnc/buscaEscolaridade.php';
                                                include_once 'fnc/buscaEndereco.php';


                                                if($dadosMae != false){
                                                    if($dadosMae[8] == 'F'){
                                                        $sexo = 'Feminino';
                                                    } else {
                                                        if($dadosMae[8] == 'M'){
                                                            $sexo = 'Masculino';
                                                        } else {
                                                            $sexo = 'Não informado';
                                                        }
                                                    }

                                                    $cpf = buscaDocumento($mae[0], 3);

                                                    $data = explode('-', $dadosMae[10]);

                                                    $dataNascimento = $data[2].'/'.$data[1].'/'.$data[0];

                                                    ?>
                                                    <h5>&middot; Nome: <?php echo $dadosMae[9]; ?></h5>
                                                    <h5>&middot; Sexo: <?php echo $sexo; ?></h5>
                                                    <h5>&middot; Data de Nascimento: <?php echo $dataNascimento; ?></h5>
                                                    <?php
                                                    if($cpf != false){
                                                        ?>
                                                        <h5>&middot; CPF: <?php echo $cpf[3]; ?></h5>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    <?php 
	                                                    $etnia = buscaEtnia($dadosMae[1]);
	                                                    $religiao = buscaReligiao($dadosMae[2]);
														$escolaridade = buscaEscolaridade($dadosMae[7]);
														$profissao = buscaProfissao($dadosMae[3]);
														$estadoCivil = buscaEstadoCivil($dadosMae[4]);
	                                                    $nacionalidade = buscaNacionalidade($dadosMae[5]);
                                                    ?>
                                                    
                                                    <h5>&middot; Etnia: <?php echo $etnia[1]; ?></h5>
                                                    <h5>&middot; Religião: <?php echo $religiao[1]; ?></h5>
                                                    <h5>&middot; Escolaridade: <?php echo $escolaridade[1]; ?></h5>
                                                    <h5>&middot; Profissão: <?php echo $profissao[1]; ?></h5>
                                                    <h5>&middot; Estado Civil: <?php echo $estadoCivil[1]; ?></h5>
                                                    <h5>&middot; País de Nacionalidade: <?php echo $nacionalidade[1][1]; ?></h5>
                                                    <?php
                                                    if($dadosMae[5] == 30){
                                                        include_once 'fnc/buscaNaturalidade.php';
                                                        $naturalidade = buscaNaturalidade($dadosMae[0]);
                                                        ?>
                                                        
                                                        <?php 
                                                        	$municipio = buscaMunicipio($naturalidade[0]);
															$nomeEstado = buscaNomeEstado($naturalidade[1]);
															$enderecoResidencial = buscaEnderecoResidencial($mae[0]);
                                                        ?>
                                                        
                                                        <h5>&middot; Naturalidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Naturalidade (UF): <?php echo $nomeEstado[1]; ?></h5>
                                                        <?php
                                                    }

                                                    $end = $enderecoResidencial[1];

                                                    $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                    ?>
													
													<?php 
														
													$bairro = buscaBairro($end[3]);
													$municipio = buscaMunicipio($end[4]);
													$nomeEstado = buscaNomeEstado($end[5]);
													
													?>
													
													
                                                    <h4>Endereço Residencial</h4>
                                                    <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                    <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                    <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                    <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                    <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                    <h5>&middot; Estado: <?php echo $nomeEstado[1]; ?></h5>

                                                    <?php
                                                    $EnderecoTrabalho = buscaEnderecoTrabalho($mae[0]);
                                                    $end = $EnderecoTrabalho[1];

                                                    if($end != false){
                                                        $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                        
                                                        $bairro = buscaBairro($end[3]);
														$municipio = buscaMunicipio($end[4]);
														$nomeEstado = buscaNomeEstado($end[5]);
                                                        ?>

                                                        <h4>Endereço Trabalho</h4>
                                                        <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                        <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                        <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                        <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                        <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Estado: <?php echo $nomeEstado[1]; ?></h5>

                                                        <?php
                                                    }

                                                    unset($telefones2);
                                                    unset($tempTel);
                                                    $telefones2 = buscaTel($mae[0]);

                                                    if (isset($telefones2[1])) {
                                                        $tempTel['celular'] = $telefones2[1][3] . $telefones2[1][4];
                                                    }
                                                    if (isset($telefones2[2])) {
                                                        $tempTel['comercial'] = $telefones2[2][3] . $telefones2[2][4];
                                                    }
                                                    if (isset($telefones2[3])) {
                                                        $tempTel['residencial'] = $telefones2[3][3] . $telefones2[3][4];
                                                    }

                                                    if (isset($tempTel['residencial'])) {
                                                        $residencialMae = '(' .substr($tempTel['residencial'], 0, 2) . ')' .substr($tempTel['residencial'], 2);
                                                    } else {
                                                        $residencialMae = '';
                                                    }
                                                    if (isset($tempTel['comercial'])) {
                                                        $comercialMae = '(' .substr($tempTel['comercial'], 0, 2) . ')' .substr($tempTel['comercial'], 2);
                                                    } else {
                                                        $comercialMae = '';
                                                    }
                                                    if (isset($tempTel['celular'])) {
                                                        $celularMae = '(' .substr($tempTel['celular'], 0, 2) . ')' .substr($tempTel['celular'], 2);
                                                    } else {
                                                        $celularMae = '';
                                                    }

                                                    ?>                                                    

                                                <h4>Telefones</h4>
                                                <h5>&middot; Residencial: <?php echo $residencialMae; ?></h5>
                                                <h5>&middot; Comercial: <?php echo $comercialMae; ?></h5>
                                                <h5>&middot; Celular: <?php echo $celularMae; ?></h5>

                                                <?php

                                                    $turnos = buscaTurnosTrabalho($mae[0]);
                                                    if($turnos != false) {
                                                        echo '<h4>Turnos de Trabalho</h4>';
                                                        if($turnos[1] == 1){
                                                            echo '<h5>&middot; Matutino</h5>';
                                                        }
                                                        if($turnos[2] == 1){
                                                            echo '<h5>&middot; Vespertino</h5>';
                                                        }
                                                        if($turnos[3] == 1){
                                                            echo '<h5>&middot; Noturno</h5>';
                                                        }
                                                        if($turnos[1] == 0 && $turnos[2] == 0 && $turnos[3] == 0){
                                                            echo '<h5>&middot; Nenhum / Não Informado';
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>

                                                <h5>&middot; Não informado</h5>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $pai = buscaResponsavelAluno($_GET['idAluno'], 2);
                                        ?>
                                        <br>
                                        <div style='padding-left: 30px;'>
                                            <h3>Dados do Pai</h3>
                                            <?php

                                            if($pai != false){
                                                include_once 'fnc/buscaPessoaFisica.php';
                                                $dadosPai = buscaPessoaFisicaTotal($pai[0]);

                                                include_once 'fnc/buscaReligiao.php';
                                                include_once 'fnc/buscaProfissao.php';
                                                include_once 'fnc/buscaEstadoCivil.php';
                                                include_once 'fnc/buscaEscolaridade.php';

                                                if($dadosPai != false){
                                                    if($dadosPai[8] == 'F'){
                                                        $sexo = 'Feminino';
                                                    } else {
                                                        if($dadosPai[8] == 'M'){
                                                            $sexo = 'Masculino';
                                                        } else {
                                                            $sexo = 'Não informado';
                                                        }
                                                    }
                                                    $cpf = buscaDocumento($pai[0], 3);

                                                    $data = explode('-', $dadosPai[10]);

                                                    $dataNascimento = $data[2].'/'.$data[1].'/'.$data[0];

                                                    ?>
                                                    <h5>&middot; Nome: <?php echo $dadosPai[9]; ?></h5>
                                                    <h5>&middot; Sexo: <?php echo $sexo; ?></h5>
                                                    <h5>&middot; Data de Nascimento: <?php echo $dataNascimento; ?></h5>
                                                    <?php
                                                    if($cpf != false){
                                                        ?>
                                                        <h5>&middot; CPF: <?php echo $cpf[3]; ?></h5>
                                                        <?php
                                                    }
													
													
													$etnia = buscaEtnia($dadosPai[1]);
													$religiao = buscaReligiao($dadosPai[2]);
													$escolaridade = buscaEscolaridade($dadosPai[7]);
													$profissao = buscaProfissao($dadosPai[3]);
													$estadoCivil = buscaEstadoCivil($dadosPai[4]);
													$nacionalidade = buscaNacionalidade($dadosPai[5]);
													
                                                    ?>
                                                    <h5>&middot; Etnia: <?php echo $etnia[1]; ?></h5>
                                                    <h5>&middot; Religião: <?php echo $religiao[1]; ?></h5>
                                                    <h5>&middot; Escolaridade: <?php echo $escolaridade[1]; ?></h5>
                                                    <h5>&middot; Profissão: <?php echo $profissao[1]; ?></h5>
                                                    <h5>&middot; Estado Civil: <?php echo $estadoCivil[1]; ?></h5>
                                                    <h5>&middot; País de Nacionalidade: <?php echo $nacionalidade[1][1]; ?></h5>
                                                    <?php
                                                    if($dadosPai[5] == 30){
                                                        include_once 'fnc/buscaNaturalidade.php';
                                                        $naturalidade = buscaNaturalidade($dadosPai[0]);
                                                       
													  	$municipio = buscaMunicipio($naturalidade[0]);
													    $nomeEstado = buscaNomeEstado($naturalidade[1]);
														
													    ?>
                                                        <h5>&middot; Naturalidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Naturalidade (UF): <?php echo $nomeEstado[1]; ?></h5>
                                                        <?php
                                                    }

													$enderecoResidencial = buscaEnderecoResidencial($pai[0]);
                                                    $end = $enderecoResidencial[1];

                                                    $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                    
                                                    $bairro = buscaBairro($end[3]);
                                                    $municipio = buscaMunicipio($end[4]);
                                                    $nomeEstado = buscaNomeEstado($end[5]);
													$enderecoTrabalho = buscaEnderecoTrabalho($pai[0]);
													
                                                    ?>

                                                    <h4>Endereço Residencial</h4>
                                                    <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                    <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                    <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                    <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                    <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                    <h5>&middot; Estado: <?php echo $nomeEstado[1]; ?></h5>

                                                    <?php
                                                    $end = $enderecoTrabalho[1];

                                                    if($end != false){
                                                        $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                        
                                                        $bairro = buscaBairro($end[3]);
                                                        $municipio = buscaMunicipio($end[4]);
														$nomeEstado = buscaNomeEstado($end[5]);
														
                                                        ?>

                                                        <h4>Endereço Trabalho</h4>
                                                        <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                        <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                        <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                        <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                        <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Estado: <?php echo $nomeEstado[1]; ?></h5>

                                                        <?php
                                                    }

                                                    unset($telefones2);
                                                    unset($tempTel);
                                                    $telefones2 = buscaTel($pai[0]);

                                                    if (isset($telefones2[1])) {
                                                        $tempTel['celular'] = $telefones2[1][3] . $telefones2[1][4];
                                                    }
                                                    if (isset($telefones2[2])) {
                                                        $tempTel['comercial'] = $telefones2[2][3] . $telefones2[2][4];
                                                    }
                                                    if (isset($telefones2[3])) {
                                                        $tempTel['residencial'] = $telefones2[3][3] . $telefones2[3][4];
                                                    }

                                                    if (isset($tempTel['residencial'])) {
                                                        $residencialPai = '(' .substr($tempTel['residencial'], 0, 2) . ')' .substr($tempTel['residencial'], 2);
                                                    } else {
                                                        $residencialPai = '';
                                                    }
                                                    if (isset($tempTel['comercial'])) {
                                                        $comercialPai = '(' .substr($tempTel['comercial'], 0, 2) . ')' .substr($tempTel['comercial'], 2);
                                                    } else {
                                                        $comercialPai = '';
                                                    }
                                                    if (isset($tempTel['celular'])) {
                                                        $celularPai = '(' .substr($tempTel['celular'], 0, 2) . ')' .substr($tempTel['celular'], 2);
                                                    } else {
                                                        $celularPai = '';
                                                    }

                                                    ?>                                                    

                                                <h4>Telefones</h4>
                                                <h5>&middot; Residencial: <?php echo $residencialPai; ?></h5>
                                                <h5>&middot; Comercial: <?php echo $comercialPai; ?></h5>
                                                <h5>&middot; Celular: <?php echo $celularPai; ?></h5>

                                                <?php

                                                    $turnos = buscaTurnosTrabalho($pai[0]);
                                                    if($turnos != false) {
                                                        echo '<h4>Turnos de Trabalho</h4>';
                                                        if($turnos[1] == 1){
                                                            echo '<h5>&middot; Matutino</h5>';
                                                        }
                                                        if($turnos[2] == 1){
                                                            echo '<h5>&middot; Vespertino</h5>';
                                                        }
                                                        if($turnos[3] == 1){
                                                            echo '<h5>&middot; Noturno</h5>';
                                                        }
                                                        if($turnos[1] == 0 && $turnos[2] == 0 && $turnos[3] == 0){
                                                            echo '<h5>&middot; Nenhum / Não Informado';
                                                        }
                                                    }

                                                }
                                            } else {
                                                ?>

                                                <h5>&middot; Não informado</h5>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $resp = buscaResponsavelAluno($_GET['idAluno'], 3);
                                        ?>
                                        <br>
                                        <div style='padding-left: 30px;'>
                                            <h3>Dados do Responsável</h3>
                                            <?php

                                            if($resp != false){
                                                include_once 'fnc/buscaPessoaFisica.php';
                                                $dadosResp = buscaPessoaFisicaTotal($resp[0]);

                                                include_once 'fnc/buscaReligiao.php';
                                                include_once 'fnc/buscaProfissao.php';
                                                include_once 'fnc/buscaEstadoCivil.php';
                                                include_once 'fnc/buscaEscolaridade.php';

                                                if($dadosResp != false){
                                                    if($dadosResp[8] == 'F'){
                                                        $sexo = 'Feminino';
                                                    } else {
                                                        if($dadosResp[8] == 'M'){
                                                            $sexo = 'Masculino';
                                                        } else {
                                                            $sexo = 'Não informado';
                                                        }
                                                    }
                                                    $cpf = buscaDocumento($resp[0], 3);

                                                    $data = explode('-', $dadosResp[10]);

                                                    $dataNascimento = $data[2].'/'.$data[1].'/'.$data[0];

                                                    ?>
                                                    <h5>&middot; Nome: <?php echo $dadosResp[9]; ?></h5>
                                                    <h5>&middot; Sexo: <?php echo $sexo; ?></h5>
                                                    <h5>&middot; Data de Nascimento: <?php echo $dataNascimento; ?></h5>
                                                    <?php
                                                    if($cpf != false){
                                                        ?>
                                                        <h5>&middot; CPF: <?php echo $cpf[3]; ?></h5>
                                                        <?php
                                                    }
                                                    
                                                    
                                                   $etnia =  buscaEtnia($dadosResp[1]);
                                                   $religiao = buscaReligiao($dadosResp[2]);
                                                   $escolaridade = buscaEscolaridade($dadosResp[7]);
												   $profissao = buscaProfissao($dadosResp[3]);
                                                   $estadoCivil = buscaEstadoCivil($dadosResp[4]);
												   $nacionalidade = buscaNacionalidade($dadosResp[5]);
													
                                                    ?>
                                                    <h5>&middot; Etnia: <?php echo $etnia[1]; ?></h5>
                                                    <h5>&middot; Religião: <?php echo $religiao[1]; ?></h5>
                                                    <h5>&middot; Escolaridade: <?php echo $escolaridade[1]; ?></h5>
                                                    <h5>&middot; Profissão: <?php echo $profissao[1]; ?></h5>
                                                    <h5>&middot; Estado Civil: <?php echo $estadoCivil[1]; ?></h5>
                                                    <h5>&middot; País de Nacionalidade: <?php echo $nacionalidade[1][1]; ?></h5>
                                                    <?php
                                                    if($dadosResp[5] == 30){
                                                        include_once 'fnc/buscaNaturalidade.php';
                                                        $naturalidade = buscaNaturalidade($dadosResp[0]);
                                                        $municipio = buscaMunicipio($naturalidade[0]);
                                                        $nomeEstado = buscaNomeEstado($naturalidade[1]);
                                                        
                                                        ?>
                                                        <h5>&middot; Naturalidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Naturalidade (UF): <?php echo $nomeEstado[1]; ?></h5>
                                                        <?php
                                                    }
													$enderecoResidencial = buscaEnderecoResidencial($resp[0]);
                                                    $end = $enderecoResidencial[1];

                                                    $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                    
                                                    
                                                    $bairro = buscaBairro($end[3]);
                                                    $municipio = buscaMunicipio($end[4]);
                                                    $nomeEstado = buscaNomeEstado($end[5]);
                                                    
                                                    ?>

                                                    <h4>Endereço Residencial</h4>
                                                    <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                    <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                    <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                    <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                    <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                    <h5>&middot; Estado: <?php echo $nomeEstado[1]; ?></h5>

                                                    <?php
                                                    $enderecoTrabalho = buscaEnderecoTrabalho($resp[0]);
                                                    $end = $enderecoTrabalho[1];

                                                    if($end != false){
                                                        $cepT = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
                                                        
                                                        $bairro = buscaBairro($end[3]);
                                                        $municipio = buscaMunicipio($end[4]);
														$estado = buscaNomeEstado($end[5]);
														
                                                        ?>

                                                        <h4>Endereço Trabalho</h4>
                                                        <h5>&middot; Logradouro: <?php echo $end[6]; ?></h5>
                                                        <h5>&middot; Número: <?php echo $end[7]; ?></h5>
                                                        <h5>&middot; Bairro: <?php echo ($bairro[$end[3]][1]); ?></h5>
                                                        <h5>&middot; CEP: <?php echo $cepT; ?></h5>
                                                        <h5>&middot; Cidade: <?php echo $municipio[1][1]; ?></h5>
                                                        <h5>&middot; Estado: <?php echo $estado[1]; ?></h5>

                                                        <?php
                                                    }

                                                    unset($telefones2);
                                                    unset($tempTel);
                                                    $telefones2 = buscaTel($pai[0]);

                                                    if (isset($telefones2[1])) {
                                                        $tempTel['celular'] = $telefones2[1][3] . $telefones2[1][4];
                                                    }
                                                    if (isset($telefones2[2])) {
                                                        $tempTel['comercial'] = $telefones2[2][3] . $telefones2[2][4];
                                                    }
                                                    if (isset($telefones2[3])) {
                                                        $tempTel['residencial'] = $telefones2[3][3] . $telefones2[3][4];
                                                    }

                                                    if (isset($tempTel['residencial'])) {
                                                        $residencialResp = '(' .substr($tempTel['residencial'], 0, 2) . ')' .substr($tempTel['residencial'], 2);
                                                    } else {
                                                        $residencialResp = '';
                                                    }
                                                    if (isset($tempTel['comercial'])) {
                                                        $comercialResp = '(' .substr($tempTel['comercial'], 0, 2) . ')' .substr($tempTel['comercial'], 2);
                                                    } else {
                                                        $comercialResp = '';
                                                    }
                                                    if (isset($tempTel['celular'])) {
                                                        $celularResp = '(' .substr($tempTel['celular'], 0, 2) . ')' .substr($tempTel['celular'], 2);
                                                    } else {
                                                        $celularResp = '';
                                                    }

                                                    ?>                                                    

                                                <h4>Telefones</h4>
                                                <h5>&middot; Residencial: <?php echo $residencialResp; ?></h5>
                                                <h5>&middot; Comercial: <?php echo $comercialResp; ?></h5>
                                                <h5>&middot; Celular: <?php echo $celularResp; ?></h5>

                                                <?php

                                                    $turnos = buscaTurnosTrabalho($resp[0]);
                                                    if($turnos != false) {
                                                        echo '<h4>Turnos de Trabalho</h4>';
                                                        if($turnos[1] == 1){
                                                            echo '<h5>&middot; Matutino</h5>';
                                                        }
                                                        if($turnos[2] == 1){
                                                            echo '<h5>&middot; Vespertino</h5>';
                                                        }
                                                        if($turnos[3] == 1){
                                                            echo '<h5>&middot; Noturno</h5>';
                                                        }
                                                        if($turnos[1] == 0 && $turnos[2] == 0 && $turnos[3] == 0){
                                                            echo '<h5>&middot; Nenhum / Não Informado';
                                                        }
                                                    }


                                                }
                                            } else {
                                                ?>

                                                <h5>&middot; Não informado</h5>

                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <a class='btn pull-right' style='margin-right: 20px;' onclick="history.go(-1);">Voltar</a>
                                    </div>
                                    <div class="tab-pane fade" id="saude">
                                        <div style='padding-left:30px;'>
                                            <h4>Dados de Saúde</h4>

                                            <?php

                                            include_once 'fnc/buscaDadosSaude.php';
                                            $dadosSaude = buscaDadosSaude($_GET['idAluno']);

                                            if(isset($dadosSaude)){
                                                if($dadosSaude[2] == 0){
                                                    $anemia = 'Não';
                                                } else {
                                                    if($dadosSaude[2] == 1){
                                                        $anemia = 'Sim';
                                                    } else {
                                                        $anemia = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[3] == 0){
                                                    $diabetes = 'Não';
                                                } else {
                                                    if($dadosSaude[3] == 1){
                                                        $diabetes = 'Sim';
                                                    } else {
                                                        $diabetes = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[4] == 0){
                                                    $lactose = 'Não';
                                                } else {
                                                    if($dadosSaude[4] == 1){
                                                        $lactose = 'Sim';
                                                    } else {
                                                        $lactose = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[5] == 0){
                                                    $gluten = 'Não';
                                                } else {
                                                    if($dadosSaude[5] == 1){
                                                        $gluten = 'Sim';
                                                    } else {
                                                        $gluten = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[6] == 0){
                                                    $refluxo = 'Não';
                                                } else {
                                                    if($dadosSaude[6] == 1){
                                                        $refluxo = 'Sim';
                                                    } else {
                                                        $refluxo = 'Não sei';
                                                    }
                                                }
                                                ?>

                                                <h5>&middot; Possui Anemia: <?php echo $anemia; ?></h5>
                                                <h5>&middot; Possui Diabetes: <?php echo $diabetes; ?></h5>
                                                <h5>&middot; Possui Intolerância à Lactose: <?php echo $diabetes; ?></h5>
                                                <h5>&middot; Possui Intolerância à Glúten: <?php echo $diabetes; ?></h5>
                                                <h5>&middot; Possui Refluxo: <?php echo $diabetes; ?></h5>
                                                <br>
                                                <h4>Deficiências, transtorno globais do desenvolvimento ou altas habilidades/superdotação</h4>
                                                <?php

                                                if($dadosSaude[7] == 0){
                                                    $cegueira = 'Não';
                                                } else {
                                                    if($dadosSaude[7] == 1){
                                                        $cegueira = 'Sim';
                                                    } else {
                                                        $cegueira = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[8] == 0){
                                                    $baixaVisao = 'Não';
                                                } else {
                                                    if($dadosSaude[8] == 1){
                                                        $baixaVisao = 'Sim';
                                                    } else {
                                                        $baixaVisao = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[9] == 0){
                                                    $surdez = 'Não';
                                                } else {
                                                    if($dadosSaude[9] == 1){
                                                        $surdez = 'Sim';
                                                    } else {
                                                        $surdez = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[10] == 0){
                                                    $auditiva = 'Não';
                                                } else {
                                                    if($dadosSaude[10] == 1){
                                                        $auditiva = 'Sim';
                                                    } else {
                                                        $auditiva = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[11] == 0){
                                                    $fisica = 'Não';
                                                } else {
                                                    if($dadosSaude[11] == 1){
                                                        $fisica = 'Sim';
                                                    } else {
                                                        $fisica = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[12] == 0){
                                                    $intelectual = 'Não';
                                                } else {
                                                    if($dadosSaude[12] == 1){
                                                        $intelectual = 'Sim';
                                                    } else {
                                                        $intelectual = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[13] == 0){
                                                    $multipla = 'Não';
                                                } else {
                                                    if($dadosSaude[13] == 1){
                                                        $multipla = 'Sim';
                                                    } else {
                                                        $multipla = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[14] == 0){
                                                    $refluxo = 'Não';
                                                } else {
                                                    if($dadosSaude[14] == 1){
                                                        $refluxo = 'Sim';
                                                    } else {
                                                        $refluxo = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[15] == 0){
                                                    $autismo = 'Não';
                                                } else {
                                                    if($dadosSaude[15] == 1){
                                                        $autismo = 'Sim';
                                                    } else {
                                                        $autismo = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[16] == 0){
                                                    $asperger = 'Não';
                                                } else {
                                                    if($dadosSaude[16] == 1){
                                                        $asperger = 'Sim';
                                                    } else {
                                                        $asperger = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[17] == 0){
                                                    $rett = 'Não';
                                                } else {
                                                    if($dadosSaude[17] == 1){
                                                        $rett = 'Sim';
                                                    } else {
                                                        $rett = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[18] == 0){
                                                    $transtorno = 'Não';
                                                } else {
                                                    if($dadosSaude[18] == 1){
                                                        $transtorno = 'Sim';
                                                    } else {
                                                        $transtorno = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[19] == 0){
                                                    $altasHab = 'Não';
                                                } else {
                                                    if($dadosSaude[19] == 1){
                                                        $altasHab = 'Sim';
                                                    } else {
                                                        $altasHab = 'Não sei';
                                                    }
                                                }

                                                ?>

                                                <h5>&middot; Cegueira: <?php echo $cegueira; ?></h5>
                                                <h5>&middot; Baixa Visão: <?php echo $baixaVisao; ?></h5>
                                                <h5>&middot; Surdez: <?php echo $surdez; ?></h5>
                                                <h5>&middot; Deficiência Auditiva: <?php echo $auditiva; ?></h5>
                                                <h5>&middot; Deficiência Física: <?php echo $fisica; ?></h5>
                                                <h5>&middot; Deficiência Intelectual: <?php echo $intelectual; ?></h5>
                                                <h5>&middot; Deficiência Múltipla: <?php echo $multipla; ?></h5>
                                                <h5>&middot; Autismo Infantil: <?php echo $refluxo; ?></h5>
                                                <h5>&middot; Síndrome de Asperger: <?php echo $autismo; ?></h5>
                                                <h5>&middot; Síndrome de Rett: <?php echo $asperger; ?></h5>
                                                <h5>&middot; Transtorno Desintregativo da Infância: <?php echo $rett; ?></h5>
                                                <h5>&middot; Síndrome de Rett: <?php echo $transtorno; ?></h5>
                                                <h5>&middot; Altas Habilidades: <?php echo $altasHab; ?></h5>
                                                <?php

                                                ?>
                                                <br>
                                                <h4>Recursos necessários para a participação do aluno em avaliações do Inep</h4>
                                                <?php

                                                if($dadosSaude[20] == 0){
                                                    $ledor = 'Não';
                                                } else {
                                                    if($dadosSaude[20] == 1){
                                                        $ledor = 'Sim';
                                                    } else {
                                                        $ledor = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[21] == 0){
                                                    $transcricao = 'Não';
                                                } else {
                                                    if($dadosSaude[21] == 1){
                                                        $transcricao = 'Sim';
                                                    } else {
                                                        $transcricao = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[22] == 0){
                                                    $guia = 'Não';
                                                } else {
                                                    if($dadosSaude[22] == 1){
                                                        $guia = 'Sim';
                                                    } else {
                                                        $guia = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[23] == 0){
                                                    $libras = 'Não';
                                                } else {
                                                    if($dadosSaude[23] == 1){
                                                        $libras = 'Sim';
                                                    } else {
                                                        $libras = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[24] == 0){
                                                    $labial = 'Não';
                                                } else {
                                                    if($dadosSaude[24] == 1){
                                                        $labial = 'Sim';
                                                    } else {
                                                        $labial = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[25] == 0){
                                                    $braile = 'Não';
                                                } else {
                                                    if($dadosSaude[25] == 1){
                                                        $braile = 'Sim';
                                                    } else {
                                                        $braile = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[26] == 0){
                                                    $amp16 = 'Não';
                                                } else {
                                                    if($dadosSaude[26] == 1){
                                                        $amp16 = 'Sim';
                                                    } else {
                                                        $amp16 = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[27] == 0){
                                                    $amp20 = 'Não';
                                                } else {
                                                    if($dadosSaude[27] == 1){
                                                        $amp20 = 'Sim';
                                                    } else {
                                                        $amp20 = 'Não sei';
                                                    }
                                                }

                                                if($dadosSaude[28] == 0){
                                                    $amp24 = 'Não';
                                                } else {
                                                    if($dadosSaude[28] == 1){
                                                        $amp24 = 'Sim';
                                                    } else {
                                                        $amp24 = 'Não sei';
                                                    }
                                                }

                                                ?>

                                                <h5>&middot; Auxílio Ledor: <?php echo $ledor; ?></h5>
                                                <h5>&middot; Auxílio Transcrição: <?php echo $transcricao; ?></h5>
                                                <h5>&middot; Guia Intérprete: <?php echo $guia; ?></h5>
                                                <h5>&middot; Intérprete Libras: <?php echo $libras; ?></h5>
                                                <h5>&middot; Leitura Labial: <?php echo $labial; ?></h5>
                                                <h5>&middot; Prova em Braile: <?php echo $braile; ?></h5>
                                                <h5>&middot; Prova Amplificada (Tamanho 16): <?php echo $amp16; ?></h5>
                                                <h5>&middot; Prova Amplificada (Tamanho 20): <?php echo $amp20; ?></h5>
                                                <h5>&middot; Prova Amplificada (Tamanho 24): <?php echo $amp24; ?></h5>
                                                <?php

                                            } else {

                                                ?>
                                                <h4>Não Informado.</h4>
                                                <?php 

                                            }

                                            ?>
                                        </div>
                                        <a class='btn pull-right' style='margin-right: 20px;' onclick="history.go(-1);">Voltar</a>
                                    </div>
                                    <div class="tab-pane fade" id="outros">
                                        <div style='padding-left: 30px;'>
                                            <h4>Outros Dados</h4>
                                            <?php

                                            include_once 'fnc/buscaOutrosDados.php';
                                            $outrosDados = buscaOutrosDados($_GET['idAluno']);

                                            if($outrosDados != false){
                                                if($outrosDados[3] == 1){
                                                    $autoriza = 'Sim';
                                                } else {
                                                    if($outrosDados[3] == 0){
                                                        $autoriza = 'Não';
                                                    } else {
                                                        $autoriza = 'Não sei';
                                                    }
                                                }

                                                if($outrosDados[4] == 1){
                                                    $bolsa = 'Sim';
                                                } else {
                                                    if($outrosDados[4] == 0){
                                                        $bolsa = 'Não';
                                                    } 
                                                }

                                                if($outrosDados[6] == 1){
                                                    $computador = 'Sim';
                                                } else {
                                                    if($outrosDados[6] == 0){
                                                        $computador = 'Não';
                                                    } 
                                                }

                                                if($outrosDados[8] == 5){
                                                    $tempo = 'Mais de 12 meses';
                                                } else {
                                                    if($outrosDados[8] == 4){
                                                        $tempo = 'De 9 à 12 meses';
                                                    }  else {
                                                        if($outrosDados[8] == 3){
                                                            $tempo = 'De 6 à 9 meses';
                                                        }  else {
                                                            if($outrosDados[8] == 2){
                                                                $tempo = 'De 3 à 6 meses';
                                                            }  else {
                                                                if($outrosDados[8] == 1){
                                                                    $tempo = 'De 0 à 3 meses';
                                                                } 
                                                            }
                                                        }
                                                    }
                                                }

                                                if($outrosDados[9] == 1){
                                                    $carro = 'Sim';
                                                } else {
                                                    if($outrosDados[9] == 0){
                                                        $carro = 'Não';
                                                    } 
                                                }

                                                if($outrosDados[11] == 1){
                                                    $pensao = 'Sim';
                                                } else {
                                                    if($outrosDados[11] == 0){
                                                        $pensao = 'Não';
                                                    } 
                                                }

                                                ?>

                                                <h5>&middot; Zona de Moradia: <?php echo $outrosDados[2]; ?></h5>
                                                <h5>&middot; Autoriza Uso de Imagem e Produção: <?php echo $autoriza; ?></h5>
                                                <h5>&middot; Recebe Bolsa Família: <?php echo $bolsa; ?></h5>
                                                <h5>&middot; Recebe Pensão: <?php echo $bolsa; ?></h5>
                                                <h5>&middot; Local de Permanência no contra-turno: <?php echo $outrosDados[5]; ?></h5>
                                                <h5>&middot; Possui Computador: <?php echo $computador; ?></h5>
                                                <h5>&middot; Local de Acesso à Internet: <?php echo $outrosDados[7]; ?></h5>
                                                <h5>&middot; Tempo de Residência no Município: <?php echo $tempo; ?></h5>
                                                <h5>&middot; Possui Carro: <?php echo $carro; ?></h5>
                                                <h5>&middot; Tipo de Moradia: <?php echo $outrosDados[10]; ?></h5>

                                                <?php

                                            } else {
                                                ?>

                                                <h5>&middot; Não informado.</h5>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <a class='btn pull-right' style='margin-right: 20px;' onclick="history.go(-1);">Voltar</a>
                                    </div>
                                    <div class="tab-pane fade" id="renda">

                                        <div style='padding-left: 30px;'>
                                            <h4>Dados de Renda</h4>

                                            <?php

                                            include_once 'fnc/buscaIndividuoRenda.php';
                                            $inds = buscaIndividuoRenda($_GET['idAluno']);
                                            include_once 'fnc/buscaOutrasRendas.php';
                                            $outras = buscaOutrasRendas($_GET['idAluno']);

                                            if($outras != false){
                                                $valorPensao = 0;
                                                $valorBolsa = 0;
                                                ?>
                                                <?php 
                                                if(isset($outras[0][6])){ 
                                                    $valorPensao = $outras[0][6];
                                                } 
                                                if(isset($outras[1][6])){ 
                                                    $valorBolsa = $outras[1][6];
                                                } 
                                                ?>
                                                <h5>&middot; Pensão: <?php echo $valorPensao;?></h5>
                                                <h5>&middot; Bolsa Família: <?php echo $valorBolsa;?></h5>

                                                <?php
                                            }

                                            if($inds != false){
                                                ?>
                                                <br>
                                                <h4>Indivíduos sob o mesmo teto</h4>
                                                <table class='table table-hover'>
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Dt. Nasc.</th>
                                                            <th>Situação Ocupacional</th>
                                                            <th>Parentesco</th>
                                                            <th>Comprovação <br> de Renda</th>
                                                            <th>Renda Mensal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        include_once 'fnc/buscaSituacaoOcupacional.php';
                                                        include_once 'fnc/buscaComprovacao.php';

                                                        $qtdPessoas = 1;
                                                        $rendaTotal = 0;

                                                        foreach ($inds as $key => $value) {
                                                            echo "<tr>";
                                                            echo "<td>".$value[7]."</td>";
                                                            $data = explode('-', $value[5]);
                                                            $dtNasc = $data[2].'/'.$data[1].'/'.$data[0];
                                                            echo "<td>".$dtNasc."</td>";
															$situacaoOpcupacional = buscaSituacaoOcupacional($value[4]);
                                                            echo "<td>".$situacaoOpcupacional[1]."</td>";
                                                            echo "<td>".$value[8]."</td>";
															$comprovacao = buscaComprovacao($value[3]);
                                                            echo "<td>".$comprovacao[1]."</td>";
                                                            echo "<td>".$value[6]."</td>";
                                                            echo "</tr>";
                                                            $qtdPessoas = $qtdPessoas + 1;
                                                            $rendaTotal = $rendaTotal + $value[6];
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>

                                                <?php

                                                $rendaTotal = $rendaTotal + $valorPensao + $valorBolsa;

                                                ?>

                                                <h4>Síntese</h4>
                                                <h5>&middot; Número de Pessoas: <?php echo $qtdPessoas; ?></h5>
                                                <h5>&middot; Renda Total: <?php echo $rendaTotal; ?></h5>
                                                <h5>&middot; Total Per Capita: <?php echo $rendaTotal/$qtdPessoas; ?></h5>
                                                <br>
                                                <a class='btn pull-right' style='margin-right: 20px;' onclick="history.go(-1);">Voltar</a>


                                                <?php


                                            }

                                            ?>

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="escolar">

                                        <div style='padding-left: 30px;'>
                                            <h3>Dados Escolares</h3>

                                            <?php
                                            include_once 'fnc/buscaEscola.php';

                                            include_once 'fnc/buscaVagasAluno.php';
                                            $vagas = buscaVagasAluno($_GET['idAluno']);
                                            if(isset($vagas)){
                                                if($vagas != false){
                                                    foreach ($vagas as $key => $value) {
                                                        if($value[1] == 10){
                                                            $etapa = 'Grupo 1';
                                                        } else {
                                                            if($value[1] == 11){
                                                                $etapa = 'Grupo 2';
                                                            } else {
                                                                if($value[1] == 12){
                                                                    $etapa = 'Grupo 3';
                                                                } else {
                                                                    if($value[1] == 13){
                                                                        $etapa = 'Grupo 4';
                                                                    } else {
                                                                        if($value[1] == 14){
                                                                            $etapa = 'Grupo 5';
                                                                        } else {
                                                                            if($value[1] == 15){
                                                                                $etapa = 'Grupo 6';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }


                                                        ?>
                                                        <h4>Vaga: </h4>
                                                        <?php $escola = buscaEscola($value[0]); ?>
                                                        <h5>&middot; Escola: <?php echo $escola[1][1]; ?> </h5>
                                                        <h5>&middot; Etapa: <?php echo $etapa; ?> </h5>
                                                        <?php
                                                    }
                                                }
                                            }

                                            ?>

                                            <?php

                                            include_once 'fnc/buscaIntencaoAlunoInfantil.php';
                                            $intencoes = buscaIntencaoAlunoInfantil($_GET['idAluno']);
                                            include_once 'fnc/buscaFases.php';
                                            $fases = buscaFases(2);

                                            if($intencoes != false){

                                                ?>
                                                <h4>Intenções</h4>
                                                <?php 
                                                foreach ($intencoes as $key => $value) {

                                                    if($value[2] == 1){
                                                    	$escola = buscaEscola($value[1]);
                                                        echo '<h5>&middot; Primeira Opção: '.$escola[1][1].' ('.$fases[$value[0]][1].')</h5>';
                                                    } else {
                                                        if($value[2] == 2){
                                                        	$escola = buscaEscola($value[1]);
                                                            echo '<h5>&middot; Segunda Opção: '.$escola[1][1].' ('.$fases[$value[0]][1].')</h5>';
                                                        }
                                                    }
                                                    ?>

                                                    <?php
                                                }
                                                ?>

                                                <?php
                                            }

                                            ?>
                                            <br>
                                            <a class='btn pull-right' style='margin-right: 20px;' onclick="history.go(-1);">Voltar</a>


                                            <?php




                                            ?>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>    

    </body>
    </html>
