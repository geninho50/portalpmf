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
//if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['gera']['perfil'])){
//    header('Location: opcoes.php');
//}

if (!isset($_GET['idAluno'])) {
    header("Location: opcoes.php");
}

/*if($_SESSION['usuario']['permissoes'][12][1] != 1){
    header('Location: opcoes.php');
}*/

if (count($_POST)) {
//Caso nacionalidade for brasileira (nacionalidade = 30), naturalidade (uf) e naturalidade (municipio)
//devem estar selecionados. Se nacionalidade não for brasileira, nao devera ter informacao nos campos.
    if (isset($_POST['nacionalidade'])) {
        if ($_POST['nacionalidade'] == 30) {
            if (!isset($_POST['naturalidade'])) {
                $erro['naturalidade'] = true;
            } else {
                if ($_POST['naturalidade'] == '') {
                    $erro['naturalidade'] = true;
                }
            }
            if (!isset($_POST['naturalidadeM'])) {
                $erro['naturalidadeM'] = true;
            } else {
                if ($_POST['naturalidadeM'] == '') {
                    $erro['naturalidadeM'] = true;
                }
            }
        } else {
            $_POST['naturalidade'] = '';
            $_POST['naturalidadeM'] = '';
        }
    }

//Existe a obrigatoriedade da entrada de pelo menos 1 telefone

    if ((!isset($_POST['telefone'])) && (!isset($_POST['comercial'])) && (!isset($_POST['celular']))) {
        $erro['telefones'] = true;
    } else {
        if (($_POST['telefone'] == '') && ($_POST['comercial'] == '') && ($_POST['celular'] == '')) {
            $erro['telefones'] = true;
        }
    }

    if($_POST['telefone'])

//O aluno tem que morar com pelo menos 1 pessoa (Mae, Pai ou outro)
        if (!isset($_POST['comQuemMora'])) {
            $erro['comQuemMora'] = true;
        } else {
            if ($_POST['comQuemMora'] == '') {
                $erro['comQuemMora'] = true;
            }
        }
//Pelo menos uma pessoa deve acompanhar o aluno
        if (!isset($_POST['quemAcompanha'])) {
            $erro['quemAcompanha'] = true;
        } else {
            if ($_POST['quemAcompanha'] == '') {
                $erro['quemAcompanha'] = true;
            }
        }
    }

//VALIDAR CAMPOS NAO OBRIGATORIOS
//se o rg foi passado, data, orgao emissor e estado do orgao emissor sao obrigatorios
    if (isset($_POST['possuiRG'])) {
        if ($_POST['possuiRG'] == 'sim') {
            include 'fnc/verificaDataPassado.php';
            if (!isset($_POST['dataRG'])) {
                $erro['dataRG'] = true;
            } elseif ($_POST['dataRG'] == '') {
                $erro['dataRG'] = true;
            } elseif ($_POST['dataRG'] == '__/__/____') {
                $erro['dataRG'] = true;
            } elseif (!verificaDataPassado($_POST['dataRG'])) {
                $erro['dataRgInvalida'] = true;
            }
            if (!isset($_POST['orgaoRG'])) {
                $erro['orgaoRG'] = true;
            } elseif ($_POST['orgaoRG'] == '') {
                $erro['orgaoRG'] = true;
            }
            if (!isset($_POST['uf_rg'])) {
                $erro['uf_rg'] = true;
            } elseif ($_POST['uf_rg'] == '') {
                $erro['uf_rg'] = true;
            }
            if (!isset($_POST['rg'])) {
                $erro['rg'] = true;
            } elseif ($_POST['rg'] == '') {
                $erro['rg'] = true;
            }
        }
    }
    if (isset($_POST['etnia'])) {
        if ($_POST['etnia'] == 'Selecione um...') {
            $erro['etnia'] = true;
        }
    }
//nova certidao
    if (isset($_POST['tipoCertidao'])) {
        if ($_POST['tipoCertidao'] == 'novo') {
            if (isset($_POST['novaCertidao'])) {
                include 'fnc/verificaNovaCertidao.php';
                if (!verificaNovaCertidao($_POST['novaCertidao'])) {
                    $erro['novaCertidao'] = true;
                }
            }
        }
    }
//todo

    if (count($_POST) > 0) {
        if (!isset($erro)) {
            $dadosAluno['identificacao']['nome_aluno'] = $_POST['nome'];
            $dadosAluno['identificacao']['data_nascimento'] = $_POST['dataNascimento'];
            $dadosAluno['dados_pessoais']['nome_aluno'] = $_POST['nome'];
            $dadosAluno['dados_pessoais']['data_nascimento'] = $_POST['dataNascimento'];
            $dadosAluno['dados_pessoais']['sexo'] = $_POST['sexo'];
            $dadosAluno['dados_pessoais']['etnia'] = $_POST['etnia'];
            $dadosAluno['dados_pessoais']['rg']['possui'] = $_POST['possuiRG'];
            if ($dadosAluno['dados_pessoais']['rg']['possui'] == 'sim') {
                $dadosAluno['dados_pessoais']['rg']['numero'] = $_POST['rg'];
                $dadosAluno['dados_pessoais']['rg']['orgao_rg'] = $_POST['orgaoRG'];
                $dadosAluno['dados_pessoais']['rg']['uf_rg'] = $_POST['uf_rg'];
                $dadosAluno['dados_pessoais']['rg']['data_rg'] = $_POST['dataRG'];
            } else {            
                $dadosAluno['dados_pessoais']['rg']['numero'] = '';
                $dadosAluno['dados_pessoais']['rg']['orgao_rg'] = '';
                $dadosAluno['dados_pessoais']['rg']['uf_rg'] = '';
                $dadosAluno['dados_pessoais']['rg']['data_rg'] = '';
            }

            $dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] = $_POST['tipoCertidao'];
            if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
                $dadosAluno['dados_pessoais']['certidao']['termo'] = $_POST['certidao'];
                $dadosAluno['dados_pessoais']['certidao']['cartorio'] = $_POST['cartorio'];
                $dadosAluno['dados_pessoais']['certidao']['uf_cart'] = $_POST['uf_cart'];
                $dadosAluno['dados_pessoais']['certidao']['livro'] = $_POST['livro'];
                $dadosAluno['dados_pessoais']['certidao']['folha'] = $_POST['folha'];
            } elseif ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
                $dadosAluno['dados_pessoais']['certidao']['termo'] = '';
                $dadosAluno['dados_pessoais']['certidao']['cartorio'] = '';
                $dadosAluno['dados_pessoais']['certidao']['uf_cart'] = '';
                $dadosAluno['dados_pessoais']['certidao']['livro'] = '';
                $dadosAluno['dados_pessoais']['certidao']['folha'] = '';

                $dadosAluno['dados_pessoais']['certidao']['numero'] = $_POST['novaCertidao'];
            } else {
                $dadosAluno['dados_pessoais']['certidao']['termo'] = '';
                $dadosAluno['dados_pessoais']['certidao']['cartorio'] = '';
                $dadosAluno['dados_pessoais']['certidao']['uf_cart'] = '';
                $dadosAluno['dados_pessoais']['certidao']['livro'] = '';
                $dadosAluno['dados_pessoais']['certidao']['folha'] = '';

                $dadosAluno['dados_pessoais']['certidao']['numero'] = '';
            }

            $dadosAluno['dados_pessoais']['nacionalidade'] = $_POST['nacionalidade'];
            $dadosAluno['dados_pessoais']['naturalidade']['uf'] = $_POST['naturalidade'];
            $dadosAluno['dados_pessoais']['naturalidade']['municipio'] = $_POST['naturalidadeM'];

            $dadosAluno['dados_pessoais']['telefones']['residencial'] = $_POST['telefone'];
            $dadosAluno['dados_pessoais']['telefones']['ufResidencial'] = $_POST['ufTelefone'];
            $dadosAluno['dados_pessoais']['telefones']['comercial'] = $_POST['comercial'];
            $dadosAluno['dados_pessoais']['telefones']['ufComercial'] = $_POST['ufComercial'];
            $dadosAluno['dados_pessoais']['telefones']['celular'] = $_POST['celular'];
            $dadosAluno['dados_pessoais']['telefones']['ufCelular'] = $_POST['ufCelular'];

            $dadosAluno['dados_pessoais']['com_quem_mora'] = $_POST['comQuemMora'];
            $dadosAluno['dados_pessoais']['quem_acompanha'] = $_POST['quemAcompanha'];

            $dadosAluno['preenchido']['dados_pessoais'] = true;

            include_once 'fnc/inserirDadosPessoais.php';
            $inseriuDados = inserirDadosPessoaisEditar($dadosAluno['dados_pessoais'], $_GET['idAluno']);
            include_once 'fnc/atualizarCqmQA.php';
            if(in_array('pai', $dadosAluno['dados_pessoais']['com_quem_mora'])){
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'pai'){
                    atualizarCqmQA($_GET['idAluno'], 2, 1, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 2, 1, 0);
                }
            } else {
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'pai'){
                    atualizarCqmQA($_GET['idAluno'], 2, 0, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 2, 0, 0);
                }
            }

            if(in_array('mae', $dadosAluno['dados_pessoais']['com_quem_mora'])){
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'mae'){
                    atualizarCqmQA($_GET['idAluno'], 1, 1, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 1, 1, 0);
                }
            } else {
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'mae'){
                    atualizarCqmQA($_GET['idAluno'], 1, 0, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 1, 0, 0);
                }
            }

            if(in_array('outro', $dadosAluno['dados_pessoais']['com_quem_mora'])){
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'outro'){
                    atualizarCqmQA($_GET['idAluno'], 3, 1, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 3, 1, 0);
                }
            } else {
                if($dadosAluno['dados_pessoais']['quem_acompanha'] == 'outro'){
                    atualizarCqmQA($_GET['idAluno'], 3, 0, 1);
                } else {
                    atualizarCqmQA($_GET['idAluno'], 3, 0, 0);
                }
            }

        //ATUALIZAR COM QUEM MORA, QUEM ACOMPANHA
            if($inseriuDados == true){
                $sucesso = true;
                include_once 'fnc/insereAuditoriaEditarDadosPessoaisInfantil.php';
                insereAuditoriaEditarDadosPessoaisInfantil($dadosAluno['dados_pessoais'], $_GET['idAluno'], $_SESSION['usuario']['id']);
            } else {
                $sucesso = false;
            }
        }
    }


    include 'fnc/buscaInfoAluno.php';
    $infoAluno = buscaInfoAluno($_GET['idAluno']);
    include 'fnc/buscaAluno.php';
    $aluno = buscaAluno($_GET['idAluno']);

    $dadosAluno['dados_pessoais']['sexo'] = strtolower($infoAluno[0]);
    $dadosAluno['dados_pessoais']['etnia'] = $infoAluno[1];
    if (isset($infoAluno[2])) {
        $dadosAluno['dados_pessoais']['nacionalidade'] = $infoAluno[2];
    }
    if (isset($infoAluno[4])) {
        $dadosAluno['dados_pessoais']['naturalidade']['uf'] = $infoAluno[4];
    }
    if (isset($infoAluno[3])) {
        $dadosAluno['dados_pessoais']['naturalidade']['municipio'] = $infoAluno[3];
    }

    include 'fnc/buscaTel.php';
    $telefones = buscaTel($_GET['idAluno']);
    if (isset($telefones[1])) {
        $dadosAluno['dados_pessoais']['telefones']['celular'] = $telefones[1][4];
    }
    if (isset($telefones[2])) {
        $dadosAluno['dados_pessoais']['telefones']['residencial'] = $telefones[2][4];
    }
    if (isset($telefones[3])) {
        $dadosAluno['dados_pessoais']['telefones']['comercial'] = $telefones[3][4];
    }

    include 'fnc/buscaDocumento.php';
    include 'fnc/buscaEstado.php';
    $rg = buscaDocumento($_GET['idAluno'], 1);
    if ($rg != false) {
        $dadosAluno['dados_pessoais']['rg']['possui'] = 'sim';
        $dadosAluno['dados_pessoais']['rg']['numero'] = $rg[3];
        $temp = explode('/', $rg[4]);
        $id_estado = buscaEstado($temp[1]);
        $dadosAluno['dados_pessoais']['rg']['orgao_rg'] = $temp[0];
        $dadosAluno['dados_pessoais']['rg']['uf_rg'] = $id_estado;
        $temp = explode('-', $rg['5']);
        $data = $temp[2] . '/' . $temp[1] . '/' . $temp[0];
        $dadosAluno['dados_pessoais']['rg']['data_rg'] = $data;
    }

    $certidao = buscaDocumento($_GET['idAluno'], 2);

    if ($certidao != false) {
        $dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] = 'novo';
        $dadosAluno['dados_pessoais']['certidao']['numero'] = $certidao[3];
    } else {
        $certidao = buscaDocumento($_GET['idAluno'], 4);
        if ($certidao != false) {
            $dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] = 'antigo';
            $dadosAluno['dados_pessoais']['certidao']['termo'] = $certidao[3];
            $dadosAluno['dados_pessoais']['certidao']['cartorio'] = $certidao[8];
            $dadosAluno['dados_pessoais']['certidao']['uf_cart'] = buscaEstado($certidao[9]);
            $dadosAluno['dados_pessoais']['certidao']['livro'] = $certidao[7];
            $dadosAluno['dados_pessoais']['certidao']['folha'] = $certidao[6];
        } else {
            $dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] = 'naoPossui';
        }
    }

    include 'fnc/buscaComQuemMora.php';
    $comQuemMora = buscaComQuemMora($_GET['idAluno']);
    if (isset($comQuemMora)) {
        if ($comQuemMora != false) {
            $dadosAluno['dados_pessoais']['com_quem_mora'] = array();
            foreach ($comQuemMora as $key => $value) {
                if ($value[2] == 1) {
                    array_push($dadosAluno['dados_pessoais']['com_quem_mora'], 'mae');
                }
                if ($value[2] == 2) {
                    array_push($dadosAluno['dados_pessoais']['com_quem_mora'], 'pai');
                }
                if ($value[2] == 3) {
                    array_push($dadosAluno['dados_pessoais']['com_quem_mora'], 'outro');
                }
            }
        }
    }


    include 'fnc/buscaQuemAcompanha.php';
    $quemAcompanha = buscaQuemAcompanha($_GET['idAluno']);
    if (isset($quemAcompanha)) {
        if ($quemAcompanha != false) {
            foreach ($quemAcompanha as $key => $value) {
                if ($value[2] == 1) {
                    $dadosAluno['dados_pessoais']['quem_acompanha'] = 'mae';
                } else {
                    if ($value[2] == 2) {
                        $dadosAluno['dados_pessoais']['quem_acompanha'] = 'pai';
                    } else {
                        if ($value[2] == 3) {
                            $dadosAluno['dados_pessoais']['quem_acompanha'] = 'outro';
                        }
                    }
                }
            }
        }
    }


    if (isset($dadosAluno['dados_pessoais']['sexo'])) {
        $_POST['sexo'] = $dadosAluno['dados_pessoais']['sexo'];
    }
    if (isset($dadosAluno['dados_pessoais']['estado_civil'])) {
        $_POST['estadoCivil'] = $dadosAluno['dados_pessoais']['estado_civil'];
    }
    if (isset($dadosAluno['dados_pessoais']['etnia'])) {
        $_POST['etnia'] = $dadosAluno['dados_pessoais']['etnia'];
    }
    if (isset($dadosAluno['dados_pessoais']['rg']['possui'])) {
        $_POST['possuiRG'] = $dadosAluno['dados_pessoais']['rg']['possui'];
    }
    if (isset($dadosAluno['dados_pessoais']['rg']['numero'])) {
        $_POST['rg'] = $dadosAluno['dados_pessoais']['rg']['numero'];
    }
    if (isset($dadosAluno['dados_pessoais']['rg']['orgao_rg'])) {
        $_POST['orgaoRG'] = $dadosAluno['dados_pessoais']['rg']['orgao_rg'];
    }
    if (isset($dadosAluno['dados_pessoais']['rg']['uf_rg'])) {
        $_POST['uf_rg'] = $dadosAluno['dados_pessoais']['rg']['uf_rg'];
    }
    if (isset($dadosAluno['dados_pessoais']['rg']['data_rg'])) {
        $_POST['dataRG'] = $dadosAluno['dados_pessoais']['rg']['data_rg'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
        $_POST['tipoCertidao'] = $dadosAluno['dados_pessoais']['certidao']['tipo_certidao'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['termo'])) {
        $_POST['certidao'] = $dadosAluno['dados_pessoais']['certidao']['termo'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['livro'])) {
        $_POST['livro'] = $dadosAluno['dados_pessoais']['certidao']['livro'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['folha'])) {
        $_POST['folha'] = $dadosAluno['dados_pessoais']['certidao']['folha'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['cartorio'])) {
        $_POST['cartorio'] = $dadosAluno['dados_pessoais']['certidao']['cartorio'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['uf_cart'])) {
        $_POST['uf_cart'] = $dadosAluno['dados_pessoais']['certidao']['uf_cart'];
    }
    if (isset($dadosAluno['dados_pessoais']['certidao']['numero'])) {
        $_POST['novaCertidao'] = $dadosAluno['dados_pessoais']['certidao']['numero'];
    }
    if (isset($dadosAluno['dados_pessoais']['nacionalidade'])) {
        $_POST['nacionalidade'] = $dadosAluno['dados_pessoais']['nacionalidade'];
    }
    if (isset($dadosAluno['dados_pessoais']['naturalidade']['uf'])) {
        $_POST['naturalidade'] = $dadosAluno['dados_pessoais']['naturalidade']['uf'];
    }
    if (isset($dadosAluno['dados_pessoais']['naturalidade']['municipio'])) {
        $_POST['naturalidadeM'] = $dadosAluno['dados_pessoais']['naturalidade']['municipio'];
    }
    if (isset($dadosAluno['dados_pessoais']['telefones']['residencial'])) {
        if (isset($telefones[2][3])) {
            $_POST['ufTelefone'] = $telefones[2][3];
        }
        $_POST['telefone'] = $dadosAluno['dados_pessoais']['telefones']['residencial'];
    }
    if (isset($dadosAluno['dados_pessoais']['telefones']['comercial'])) {
        if (isset($telefones[3][3])) {
            $_POST['ufComercial'] = $telefones[3][3];
        }
        $_POST['comercial'] = $dadosAluno['dados_pessoais']['telefones']['comercial'];
    }
    if (isset($dadosAluno['dados_pessoais']['telefones']['celular'])) {
        if (isset($telefones[1][3])) {
            $_POST['ufCelular'] = $telefones[1][3];
        }
        $_POST['celular'] = $dadosAluno['dados_pessoais']['telefones']['celular'];
    }
    if (isset($dadosAluno['dados_pessoais']['com_quem_mora'])) {
        $_POST['comQuemMora'] = $dadosAluno['dados_pessoais']['com_quem_mora'];
    }
    if (isset($dadosAluno['dados_pessoais']['quem_acompanha'])) {
        $_POST['quemAcompanha'] = $dadosAluno['dados_pessoais']['quem_acompanha'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Dados Pessoais do Aluno</title>
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
            <?php
            include 'shared/barraTopo.php';
            ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Editar Aluno</h1>
                        <h4><?php echo $aluno[2] . ' &middot ' . ($aluno[0]); ?></h4>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <h3>Dados Pessoais</h3>
                            <?php
                            if(isset($sucesso)){
                                if($sucesso){
                                    ?>
                                    <div class="sucesso">
                                        <strong>Sucesso!</strong> Dados Pessoais atualizados!
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Um erro ocorreu, tente novamente!
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <form id='form1' class = "form-horizontal" method = "post" 
                            onsubmit='$("#inputEstado").removeAttr("disabled");
                            $("#inputMunicipio").removeAttr("disabled");
                            $("#inputNaturalidade").removeAttr("disabled");'>
                            <div class = "control-group">
                                <label class = "control-label" for = "inputNome">Nome Completo</label>
                                <div class = "controls">
                                    <input name = 'nome' type = "text" id = "inputNome" placeholder = "Nome Completo do Aluno" value = '<?php
                                    echo ($aluno[0]);
                                    ?>'>
                                </div>
                                <label class = "control-label" for = "inputDataNasc">Data de Nascimento</label>
                                <div class = "controls">
                                    <input name = 'dataNascimento' type = "text" value = '<?php
                                    $data = explode("-", $aluno[1]);
                                    echo $data[2] . '/' . $data[1] . '/' . $data[0];
                                    ?>' class = 'datepicker' id = "inputDataNasc" placeholder = "dd/mm/aaaa" data-mask = '99/99/9999' onselect = "setCaretPosition($(this), 0);" required>
                                </div>
                                <label class = "control-label" for = "inputSexo">Sexo</label>
                                <div class = "controls">
                                    <select name = 'sexo' onchange='$("#opt1").remove();'>
                                        <option id='opt1'>Selecione um...</option>
                                        <option
                                        <?php
                                        if (isset($dadosAluno['dados_pessoais']['sexo'])) {
                                            if ($dadosAluno['dados_pessoais']['sexo'] == 'm') {
                                                echo 'selected';
                                            }
                                        }
                                        ?> value='m'>Masculino</option>
                                        <option 
                                        <?php
                                        if (isset($dadosAluno['dados_pessoais']['sexo'])) {
                                            if ($dadosAluno['dados_pessoais']['sexo'] == 'f') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>
                                        value='f'>Feminino</option>
                                    </select>
                                </div>

                                <label class="control-label" for="inputEtnia">Cor/Raça</label>
                                <div class="controls">
                                    <select name='etnia' onchange='$("#opt2").remove();'>
                                        <option id='opt2'>Selecione um...</option>
                                        <?php
                                        include '../Matricula/fnc/listaDeEtnias.php';
                                        $etnias = listaDeEtnias();
                                        foreach ($etnias as $key => $value) {
                                            if (isset($dadosAluno['dados_pessoais']['etnia'])) {
                                                if ($dadosAluno['dados_pessoais']['etnia'] == $key) {
                                                    echo "<option value='" . ($value[0]) . "' selected>" . ($value[1]) . "</option>";
                                                } else {
                                                    echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <label class="control-label">Possui RG</label>
                                <div class="controls">                
                                    <input type="radio" name='possuiRG' value='sim' 
                                    <?php
                                    if (isset($dadosAluno['dados_pessoais']['rg']['possui'])) {
                                        if ($dadosAluno['dados_pessoais']['rg']['possui'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?> 
                                    onclick="$('#divRG').css('display', 'inherit');">Sim<br>
                                    <input type="radio" name='possuiRG' value='nao'                 
                                    <?php
                                    if (isset($dadosAluno['dados_pessoais']['rg']['possui'])) {
                                        if ($dadosAluno['dados_pessoais']['rg']['possui'] == 'nao') {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> 
                                    onclick="$('#divRG').css('display', 'none');">Não
                                </div>
                                <div id='divRG'                 
                                <?php
                                if (isset($dadosAluno['dados_pessoais']['rg']['possui'])) {
                                    if ($dadosAluno['dados_pessoais']['rg']['possui'] == 'nao') {
                                        echo 'style="display: none;"';
                                    }
                                } else {
                                    echo 'style="display: none;"';
                                }
                                ?> >
                                <label class="control-label" for="inputRG" style="padding-top: 8px;">Registro Geral (RG)</label>
                                <div class="controls">
                                    <input name='rg' type='text' placeholder='RG' style='margin-top: 5px;' value='<?php
                                    if (isset($dadosAluno['dados_pessoais']['rg']['numero'])) {
                                        echo $dadosAluno['dados_pessoais']['rg']['numero'];
                                    }
                                    ?>'/>
                                </div>
                                <?php if (isset($erro['rg'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Número de RG vazio!
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputOrgaoRG" style="padding-top: 8px;">Órgão Emissor</label>
                                <div class="controls">
                                    <input name='orgaoRG' type='text' id='inputOrgaoRG' onkeypress='verificaMaiusculo("#inputOrgaoRG");' onkeyup='verificaMaiusculo("#inputOrgaoRG");'  placeholder='Órgão Emissor'  style='margin-top: 5px; width:130px;'  value='<?php
                                    if (isset($dadosAluno['dados_pessoais']['rg']['orgao_rg'])) {
                                        echo $dadosAluno['dados_pessoais']['rg']['orgao_rg'];
                                    }
                                    ?>'/>
                                    <select name='uf_rg' style='margin-top: 5px; width:60px;'>
                                        <option></option>
                                        <?php
                                        include '../Matricula/fnc/listaDeEstados.php';
                                        $estados = listaDeEstados();
                                        foreach ($estados as $key => $value) {
                                            if (isset($dadosAluno['dados_pessoais']['rg']['uf_rg'])) {
                                                if ($dadosAluno['dados_pessoais']['rg']['uf_rg'] == $key) {
                                                    echo "<option value='" . $key . "' selected>" . ($value[2]) . "</option>";
                                                } else {
                                                    echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if (isset($erro['orgaoRG'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Órgão Emissor do RG vazio!
                                </div>
                                <?php } ?>
                                <?php if (isset($erro['uf_rg'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Estado do Órgão Emissor do RG vazio!
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputDataRG">Data de Expedição</label>
                                <div class="controls">
                                    <input name='dataRG' type="text" id="inputDataRG" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);"
                                    value='<?php
                                    if (isset($dadosAluno['dados_pessoais']['rg']['data_rg'])) {
                                     echo $dadosAluno['dados_pessoais']['rg']['data_rg'];
                                 }
                                 ?>'
                                 >
                             </div>
                             <?php if (isset($erro['dataRG'])) { ?>
                             <div class="erro">
                                <strong>Erro!</strong> Data de expedição do RG vazio!
                            </div>
                            <?php } ?>
                            <?php if (isset($erro['dataRgInvalida'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> Data de expedição do RG inválida!
                            </div>
                            <?php } ?>
                        </div>

                        <label class="control-label">Certidão de Nascimento</label>
                        <div class="controls">                
                            <input type="radio" name='tipoCertidao' value='antigo'               
                            <?php
                            if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
                                if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
                                    echo 'checked';
                                }
                            }
                            ?> 
                            onclick="$('#divCertidaoAntiga').css('display', 'inherit');
                            $('#divCertidaoNova').css('display', 'none')">Modelo Antigo<br>
                            <input type="radio" name='tipoCertidao' value='novo'                
                            <?php
                            if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
                                if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
                                    echo 'checked';
                                }
                            } else {
                                echo 'checked';
                            }
                            ?> 
                            onclick="$('#divCertidaoNova').css('display', 'inherit');
                            $('#divCertidaoAntiga').css('display', 'none')">Modelo Novo<br>
                            <input type="radio" name='tipoCertidao' value='naoPossui'           
                            <?php
                            if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
                                if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] == 'naoPossui') {
                                    echo 'checked';
                                }
                            }
                            ?> 
                            onclick="$('#divCertidaoNova').css('display', 'none');
                            $('#divCertidaoAntiga').css('display', 'none')">Não Possui Informação<br>
                        </div>

                        <div id='divCertidaoAntiga' 
                        <?php
                        if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
                            if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] != 'antigo') {
                                echo 'style="display: none;"';
                            }
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                        <label class="control-label" for="inputCertidao">Certidão de Nascimento</label>
                        <div class="controls">
                            <input value='<?php if (isset($dadosAluno['dados_pessoais']['certidao']['termo'])) echo $dadosAluno['dados_pessoais']['certidao']['termo']; ?>' title='Preencha este campo caso o aluno tenha sua certidão no modelo antigo' placeholder='Somente números' name='certidao' type="text" id="inputCertidao">
                        </div>
                        <div class="controls" style='margin-left: 144px;'>
                            <div style='display: inline; text-align: right'>
                                <label for="inputFolha" style='display: inline;'>Folha</label>
                                <input value='<?php if (isset($dadosAluno['dados_pessoais']['certidao']['folha'])) echo $dadosAluno['dados_pessoais']['certidao']['folha']; ?>' name='folha' type="text" id="inputLivro" style='margin-top: 5px; width:74px;'>
                            </div>
                            <div style='display: inline; text-align: right'>
                                <label for="inputLivro" style='display: inline;'>Livro</label>
                                <input value='<?php if (isset($dadosAluno['dados_pessoais']['certidao']['livro'])) echo $dadosAluno['dados_pessoais']['certidao']['livro']; ?>' name='livro' type="text" id="inputFolha" style='margin-top: 5px; width:74px; display: inline;'>
                            </div>
                        </div>                    
                        <label class="control-label" for="inputCartorio">Cartório</label>
                        <div class="controls">
                            <input onkeypress='verificaMaiusculo("#inputCartorio");' onkeyup='verificaMaiusculo("#inputCartorio");' value='<?php if (isset($dadosAluno['dados_pessoais']['certidao']['cartorio'])) echo $dadosAluno['dados_pessoais']['certidao']['cartorio']; ?>' name='cartorio' type="text" id="inputCartorio">
                        </div>                    
                        <label class="control-label" for="inputCartorioUF">UF Cartório</label>
                        <div class="controls">
                            <select name='uf_cart' style='margin-top: 5px;'>
                                <option></option>
                                <?php
                                $estados = listaDeEstados();
                                foreach ($estados as $key => $value) {
                                    if (isset($dadosAluno['dados_pessoais']['certidao']['uf_cart'])) {
                                        if ($dadosAluno['dados_pessoais']['certidao']['uf_cart'] == $key) {
                                            echo "<option value='" . $key . "' selected>" . ($value[2]) . "</option>";
                                        } else {
                                            echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                        }
                                    } else {
                                        echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div id='divCertidaoNova'              
                    <?php
                    if (isset($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'])) {
                        if ($dadosAluno['dados_pessoais']['certidao']['tipo_certidao'] != 'novo') {
                            echo 'style="display: none;"';
                        }
                    }
                    ?>>
                    <label class="control-label" title='Somente números' for="inputNovaCertidao">Nova Certidão</label>
                    <div class="controls">
                        <input name='novaCertidao' 
                        value='<?php
                        if (isset($dadosAluno['dados_pessoais']['certidao']['numero'])) {
                         echo $dadosAluno['dados_pessoais']['certidao']['numero'];
                     }
                     ?>'
                     title='Somente números' maxlength="32" title='Preencha este campo caso o aluno tenha sua certidão no novo modelo' placeholder='Somente números' type="text" id="inputNovaCertidao">
                 </div>
                 <?php if (isset($erro['novaCertidao'])) { ?>
                 <div class="erro">
                    <strong>Erro!</strong> Número inválido!
                </div>
                <?php } ?>
            </div>

            <label class="control-label" for="inputNacionalidade">País da Nacionalidade</label>
            <div class="controls">
                <select id='inputNacionalidade' name='nacionalidade' 
                onchange='if ($(this).val() == 30) {
                $("#inputNaturalidade").removeAttr("disabled");
                $("#inputNaturalidade").removeAttr("title");
            }
            else {
            $("#inputNaturalidade").attr("disabled", "");
            $("#inputNaturalidade").attr("title", "Preenchimento obrigatório somente para brasileiros.");
        }'

        >
        <?php
        include '../Matricula/fnc/listaDePaises.php';
        $paises = listaDePaises();
        foreach ($paises as $key => $value) {
            if (isset($dadosAluno['dados_pessoais']['nacionalidade'])) {
                if ($dadosAluno['dados_pessoais']['nacionalidade'] == $key) {
                    echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                }
                else
                    echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
            } else {
                if ($key == 30) {
                    echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                }
            }
        }
        ?>
    </select>
</div>

<label class="control-label" for="inputNaturalidade">Naturalidade (UF)</label>
<div class="controls">
    <select name='naturalidade' id="inputNaturalidade" onchange="buscaMunicipio($(this).val(), 'inputNaturalidadeM'); $('#inputNaturalidadeM').removeAttr('disabled');" 
    <?php
    if (isset($dadosAluno['dados_pessoais']['nacionalidade'])) {
        if ($dadosAluno['dados_pessoais']['nacionalidade'] != '30') {
            echo 'disabled';
        }
    }
    ?>>
    <option></option>
    <?php
    $estados = listaDeEstados();
    foreach ($estados as $key => $value) {
        if (isset($dadosAluno['dados_pessoais']['naturalidade']['uf'])) {
            if ($dadosAluno['dados_pessoais']['naturalidade']['uf'] == $value[0]) {
                echo "<option value='" . $value[0] . "' selected>" . ($value[1]) . "</option>";
            } else {
                echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
            }
        } else {
            echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['naturalidade'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Unidade Federal da Naturalidade vazio!
</div>
<?php } ?>

<label class="control-label" for="inputNaturalidadeM">Naturalidade (Município)</label>
<div class="controls">
    <select required name='naturalidadeM' id="inputNaturalidadeM" <?php
    if (!isset($dadosAluno['dados_pessoais']['naturalidade']['uf'])) {
        echo 'disabled';
    }
    ?>>
    <option></option>
    <?php
    include '../Matricula/fnc/listaDeMunicipios.php';
    if (isset($dadosAluno['dados_pessoais']['naturalidade']['uf'])) {
        $municipios = listaDeMunicipios($dadosAluno['dados_pessoais']['naturalidade']['uf']);
    }
    echo "<option></option>";
    foreach ($municipios as $key => $value) {
        if (isset($dadosAluno['dados_pessoais']['naturalidade']['municipio'])) {
            if ($dadosAluno['dados_pessoais']['naturalidade']['municipio'] == $key) {
                echo "<option value='" . $key . "' selected>" . ($value[1]) . "</option>";
            } else {
                echo "<option value='" . $key . "'>" . ($value[1]) . "</option>";
            }
        } else {
            echo "<option value='" . $key . "'>" . ($value[1]) . "</option>";
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['naturalidadeM'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Município da Naturalidade vazio!
</div>
<?php } ?>


<label class="control-label" for="inputTelResidencial">Telefone Residencial</label>
<div class="controls">
    <select name="ufTelefone" id="inputUfTelefone" style='width: 50px;'
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelResidencial").attr("data-mask", "999999999")
}'>
<?php
include 'fnc/buscaDDD.php';
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='telefone' type="text" id="inputTelResidencial" style='width: 195px;' data-mask='99999999'
<?php
if (isset($_POST['telefone'])) {
    echo 'value="' . $_POST['telefone'] . '"';
}
?>>
</div>

<label class="control-label" for="inputTelCelular">Telefone Celular</label>
<div class="controls">
    <select name="ufCelular" id="inputUfCelular" style='width: 50px;'
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelCelular").attr("data-mask", "999999999")
}'>
<?php
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='celular' type="text" id="inputTelCelular" style='width: 195px;' data-mask='99999999'
<?php
if (isset($_POST['celular'])) {
    echo 'value="' . $_POST['celular'] . '"';
}
?>>
</div>

<label class="control-label" for="inputTelComercial">Telefone Comercial</label>
<div class="controls">
    <select name="ufComercial" id="inputUfComercial" style='width: 50px;' 
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelComercial").attr("data-mask", "999999999")
}'>
<?php
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='comercial' type="text" id="inputTelComercial" style='width: 195px;' data-mask='99999999'
<?php
if (isset($_POST['comercial'])) {
    echo 'value="' . $_POST['comercial'] . '"';
}
?>>
</div>
<?php if (isset($erro['telefones'])) { ?>
<div class="erro">
    <strong>Erro!</strong> No mínimo um telefone deve ser fornecido!
</div>
<?php } ?>

<label class="control-label" for="inputComQuemMora">Com quem o aluno mora?</label>
<div class="controls">    
    <label>
        <input type="checkbox" name="comQuemMora[]" value="pai"
        <?php
        if (isset($dadosAluno['dados_pessoais']['com_quem_mora'])) {
            if (in_array('pai', $dadosAluno['dados_pessoais']['com_quem_mora'])) {
                echo 'checked';
            }
        }
        ?>><font style='position: relative; top: 3px; left: 3px; display: inline;'>Pai</font>
    </label> 
    <label>
        <input type="checkbox" name="comQuemMora[]" value="mae"
        <?php
        if (isset($dadosAluno['dados_pessoais']['com_quem_mora'])) {
            if (in_array('mae', $dadosAluno['dados_pessoais']['com_quem_mora'])) {
                echo 'checked';
            }
        }
        ?>><font style='position: relative; top: 3px; left: 3px; display: inline;'>Mãe</font> 
    </label>
    <input type="checkbox" name="comQuemMora[]" 
    value="outro" id='outroCheckBox'>
    <font id='textoOutroC' style='position: relative; top: 3px; left: 3px; display: inline;'>
        <?php
        echo 'Outro';
        ?></font>
    </div>
    <?php if (isset($erro['comQuemMora'])) { ?>
    <div class="erro">
        <strong>Erro!</strong> Você deve selecionar pelo menos uma das opções!
    </div>
    <?php } ?>
    <label class="control-label" for="inputComQuemMora">Quem acompanha o aluno na vida escolar?</label>
    <div class="controls" style='line-height: 20px;'>
        <label>
            <input type="radio" name="quemAcompanha" value="pai"  required
            <?php
            if (isset($dadosAluno['dados_pessoais']['quem_acompanha'])) {
                if ($dadosAluno['dados_pessoais']['quem_acompanha'] == 'pai') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 3px; left: 0px; display: inline;'>Pai</font>
        </label>
        <label>
            <input type="radio" name="quemAcompanha" value="mae" required
            <?php
            if (isset($dadosAluno['dados_pessoais']['quem_acompanha'])) {
                if ($dadosAluno['dados_pessoais']['quem_acompanha'] == 'mae') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 3px; left: 0px; display: inline;'>Mãe</font>
        </label>
        <label>
            <input type="radio" name="quemAcompanha" value="outro" id='outroRadio' required 
            <?php
            if (isset($dadosAluno['dados_pessoais']['quem_acompanha'])) {
                if ($dadosAluno['dados_pessoais']['quem_acompanha'] == 'outro') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 3px; left: 0px; display: inline;' id='textoOutroR'><?php
            echo "Outro";
            ?></font>
        </label>
    </div>
    <?php if (isset($erro['quemAcompanha'])) { ?>
    <div class="erro">
        <strong>Erro!</strong> Uma das opções deve ser escolhida!
    </div>
    <?php } ?>
</form>
<hr>
<a class='btn btn-primary pull-right' onclick='$("#form1").submit();'>Salvar</a>
<a class='btn pull-right' style='margin-right: 5px;' href='editarAlunoInfantil.php?idAluno=<?php echo $_GET['idAluno']; ?>'>Voltar</a>;
</div>
</div>   
</div>
</div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script> 
<script type="text/javascript">
            function buscaMunicipio(id_estado, id_elemento) {
                id_elemento = '#' + id_elemento.toString();
                if (id_estado != '') {
                    $.get("ajax/municipios.php", {id_estado: id_estado})
                            .done(function(data) {
                        $(id_elemento).html(data);
                        $(id_elemento).removeAttr('disabled');
                    });
                } else {
                    $(id_elemento).html("<select></select>");
                    $(id_elemento).attr('disabled', '');
                }
            }

            function verificaCaracteres(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                var letra = caracter.toUpperCase();
                if (letra < "A" || letra > "Z") {
                    if (letra != " ") {
                        $(elemento).val(string.substr(0, string.length - 1));
                    }
                } else {
                    $(elemento).val(string.substr(0, string.length - 1) + letra);
                }

            }
            function isNumber(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
            function verificaDigitos(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                if (!isNumber(caracter)) {
                    $(elemento).val(string.substr(0, string.length - 1));
                }
            }
        </script>

  </body>
  </html>
