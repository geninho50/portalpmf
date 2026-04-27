<?php
session_name('ma_eja');
session_start();

if (!$_SESSION['preenchido']['localizacao']) {
    header('Location: dadosLocalizacaoEJA.php');
}

if (count($_POST) > 0) {
    if(!isset($erro)){

        $_SESSION['renda']['moraFamilia'] = $_POST['moraFamilia'];
        $_SESSION['renda']['numeroFilhos'] = $_POST['numeroFilhos'];
        $_SESSION['renda']['numeroDependentes'] = $_POST['numeroDependentes'];
        $_SESSION['renda']['numeroDependentesTrabalham'] = $_POST['numeroDependentesTrabalham'];
        $_SESSION['renda']['numeroHabitantes'] = $_POST['numeroHabitantes'];
        if(isset($_POST['comQuemDeixara'])){
            $_SESSION['renda']['comQuemDeixara'] = $_POST['comQuemDeixara'];
        }
        if(isset($_POST['empresa'])){
            $_SESSION['renda']['empresa'] = $_POST['empresa'];
        }
        if(isset($_POST['funcao'])){
            $_SESSION['renda']['funcao'] = $_POST['funcao'];
        }
        $_SESSION['renda']['rendaPropria'] = $_POST['rendaPropria'];
        $_SESSION['renda']['rendaFamiliar'] = $_POST['rendaFamiliar'];

        $_SESSION['renda']['recebeAjuda'] = $_POST['recebeAjuda'];
        $_SESSION['renda']['carteira'] = $_POST['carteira'];
        $_SESSION['renda']['jaCarteira'] = $_POST['jaCarteira'];
        $_SESSION['renda']['procuraEmprego'] = $_POST['procuraEmprego'];
        $_SESSION['renda']['pretensao'] = $_POST['pretensao'];
        $_SESSION['renda']['estagio'] = $_POST['estagio'];
        $_SESSION['renda']['voluntario'] = $_POST['voluntario'];
        $_SESSION['renda']['localVoluntario'] = $_POST['localVoluntario'];
        $_SESSION['renda']['habmot'] = $_POST['habmot'];

        $_SESSION['preenchido']['renda'] = true;        

        header("Location: salvaInfoEJA.php");
    }

    
}

if(isset($_SESSION['renda']['empresa'])){
    $_POST['empresa'] = $_SESSION['renda']['empresa'];
}
if(isset($_SESSION['renda']['funcao'])){
    $_POST['funcao'] = $_SESSION['renda']['funcao'];
}
if(isset($_SESSION['renda']['carteira'])){
    $_POST['carteira'] = $_SESSION['renda']['carteira'];
}
if(isset($_SESSION['renda']['jaCarteira'])){
    $_POST['jaCarteira'] = $_SESSION['renda']['jaCarteira'];
}
if(isset($_SESSION['renda']['estagio'])){
    $_POST['estagio'] = $_SESSION['renda']['estagio'];
}
if(isset($_SESSION['renda']['procuraEmprego'])){
    $_POST['procuraEmprego'] = $_SESSION['renda']['procuraEmprego'];
}
if(isset($_SESSION['renda']['pretensao'])){
    $_POST['pretensao'] = $_SESSION['renda']['pretensao'];
}
if(isset($_SESSION['renda']['voluntario'])){
    $_POST['voluntario'] = $_SESSION['renda']['voluntario'];
}
if(isset($_SESSION['renda']['localVoluntario'])){
    $_POST['localVoluntario'] = $_SESSION['renda']['localVoluntario'];
}
if(isset($_SESSION['renda']['recebeAjuda'])){
    $_POST['recebeAjuda'] = $_SESSION['renda']['recebeAjuda'];
}
if(isset($_SESSION['renda']['numeroFilhos'])){
    $_POST['numeroFilhos'] = $_SESSION['renda']['numeroFilhos'];
}
if(isset($_SESSION['renda']['numeroDependentes'])){
    $_POST['numeroDependentes'] = $_SESSION['renda']['numeroDependentes'];
}
if(isset($_SESSION['renda']['numeroDependentesTrabalham'])){
    $_POST['numeroDependentesTrabalham'] = $_SESSION['renda']['numeroDependentesTrabalham'];
}
if(isset($_SESSION['renda']['moraFamilia'])){
    $_POST['moraFamilia'] = $_SESSION['renda']['moraFamilia'];
}
if(isset($_SESSION['renda']['numeroHabitantes'])){
    $_POST['numeroHabitantes'] = $_SESSION['renda']['numeroHabitantes'];
}
if(isset($_SESSION['renda']['habmot'])){
    $_POST['habmot'] = $_SESSION['renda']['habmot'];
}
if(isset($_SESSION['renda']['comQuemDeixara'])){
    $_POST['comQuemDeixara'] = $_SESSION['renda']['comQuemDeixara'];
}
if(isset($_SESSION['renda']['rendaPropria'])){
    $_POST['rendaPropria'] = $_SESSION['renda']['rendaPropria'];
}
if(isset($_SESSION['renda']['rendaFamiliar'])){
    $_POST['rendaFamiliar'] = $_SESSION['renda']['rendaFamiliar'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados Renda</title>
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
                        <h3>Dados de Renda do Aluno</h3>
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
                        <div class='itemOliva ativo'>
                            Dados dos Pais
                        </div>
                        <div class='itemT ativo'>
                            Dados de Renda
                        </div>
                        <div class='itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <form class="form-horizontal" method="post" onsubmit="" id='form1'>
                            <h4>Dados de Renda</h4>
                            
                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputMora">Mora com Família?</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input type="radio" name="moraFamilia" value="sim"  required
                                    <?php
                                    if (isset($_POST['moraFamilia'])) {
                                        if ($_POST['moraFamilia'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="moraFamilia" value="nao" required
                                    <?php
                                    if (isset($_POST['moraFamilia'])) {
                                        if ($_POST['moraFamilia'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['moraFamilia'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se mora com a família.
                            </div>
                            <?php } ?> 

                            <label class="control-label" for="inputFilhos">Número de filhos</label>
                            <div class="controls">
                                <select name='numeroFilhos'>
                                    <option value="0" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 0){ echo 'selected';}} ?>>0</option>
                                    <option value="1" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 1){ echo 'selected';}} ?>>1</option>
                                    <option value="2" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 2){ echo 'selected';}} ?>>2</option>
                                    <option value="3" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 3){ echo 'selected';}} ?>>3</option>
                                    <option value="4" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 4){ echo 'selected';}} ?>>4</option>
                                    <option value="5" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 5){ echo 'selected';}} ?>>5</option>
                                    <option value="6" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 6){ echo 'selected';}} ?>>6</option>
                                    <option value="7" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 7){ echo 'selected';}} ?>>7</option>
                                    <option value="8" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 8){ echo 'selected';}} ?>>8</option>
                                    <option value="9" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 9){ echo 'selected';}} ?>>9</option>
                                    <option value="10" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 10){ echo 'selected';}} ?>>10</option>
                                    <option value="11" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 11){ echo 'selected';}} ?>>11</option>
                                    <option value="12" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 12){ echo 'selected';}} ?>>12</option>
                                    <option value="13" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 13){ echo 'selected';}} ?>>13</option>
                                    <option value="14" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 14){ echo 'selected';}} ?>>14</option>
                                    <option value="15" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 15){ echo 'selected';}} ?>>15</option>
                                    <option value="16" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 16){ echo 'selected';}} ?>>16</option>
                                    <option value="17" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 17){ echo 'selected';}} ?>>17</option>
                                    <option value="18" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 18){ echo 'selected';}} ?>>18</option>
                                    <option value="19" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 19){ echo 'selected';}} ?>>19</option>
                                    <option value="20" <?php if(isset($_POST['numeroFilhos'])) { if($_POST['numeroFilhos'] == 20){ echo 'selected';}} ?>>20</option>
                                </select>
                            </div>     

                            <label class="control-label" for="inputDependentes">Número de dependentes</label>
                            <div class="controls">
                                <select name='numeroDependentes'>
                                    <option value="0" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 0){ echo 'selected';}} ?>>0</option>
                                    <option value="1" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 1){ echo 'selected';}} ?>>1</option>
                                    <option value="2" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 2){ echo 'selected';}} ?>>2</option>
                                    <option value="3" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 3){ echo 'selected';}} ?>>3</option>
                                    <option value="4" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 4){ echo 'selected';}} ?>>4</option>
                                    <option value="5" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 5){ echo 'selected';}} ?>>5</option>
                                    <option value="6" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 6){ echo 'selected';}} ?>>6</option>
                                    <option value="7" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 7){ echo 'selected';}} ?>>7</option>
                                    <option value="8" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 8){ echo 'selected';}} ?>>8</option>
                                    <option value="9" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 9){ echo 'selected';}} ?>>9</option>
                                    <option value="10" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 10){ echo 'selected';}} ?>>10</option>
                                    <option value="11" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 11){ echo 'selected';}} ?>>11</option>
                                    <option value="12" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 12){ echo 'selected';}} ?>>12</option>
                                    <option value="13" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 13){ echo 'selected';}} ?>>13</option>
                                    <option value="14" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 14){ echo 'selected';}} ?>>14</option>
                                    <option value="15" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 15){ echo 'selected';}} ?>>15</option>
                                    <option value="16" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 16){ echo 'selected';}} ?>>16</option>
                                    <option value="17" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 17){ echo 'selected';}} ?>>17</option>
                                    <option value="18" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 18){ echo 'selected';}} ?>>18</option>
                                    <option value="19" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 19){ echo 'selected';}} ?>>19</option>
                                    <option value="20" <?php if(isset($_POST['numeroDependentes'])) { if($_POST['numeroDependentes'] == 20){ echo 'selected';}} ?>>20</option>
                                </select>
                            </div>      

                            <label class="control-label" for="inputDependentesTrabalham">Número de dependentes que trabalham</label>
                            <div class="controls" style='line-height: 40px;'>
                                <select name='numeroDependentesTrabalham'>
                                    <option value="0" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 0){ echo 'selected';}} ?>>0</option>
                                    <option value="1" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 1){ echo 'selected';}} ?>>1</option>
                                    <option value="2" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 2){ echo 'selected';}} ?>>2</option>
                                    <option value="3" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 3){ echo 'selected';}} ?>>3</option>
                                    <option value="4" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 4){ echo 'selected';}} ?>>4</option>
                                    <option value="5" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 5){ echo 'selected';}} ?>>5</option>
                                    <option value="6" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 6){ echo 'selected';}} ?>>6</option>
                                    <option value="7" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 7){ echo 'selected';}} ?>>7</option>
                                    <option value="8" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 8){ echo 'selected';}} ?>>8</option>
                                    <option value="9" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 9){ echo 'selected';}} ?>>9</option>
                                    <option value="10" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 10){ echo 'selected';}} ?>>10</option>
                                    <option value="11" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 11){ echo 'selected';}} ?>>11</option>
                                    <option value="12" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 12){ echo 'selected';}} ?>>12</option>
                                    <option value="13" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 13){ echo 'selected';}} ?>>13</option>
                                    <option value="14" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 14){ echo 'selected';}} ?>>14</option>
                                    <option value="15" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 15){ echo 'selected';}} ?>>15</option>
                                    <option value="16" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 16){ echo 'selected';}} ?>>16</option>
                                    <option value="17" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 17){ echo 'selected';}} ?>>17</option>
                                    <option value="18" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 18){ echo 'selected';}} ?>>18</option>
                                    <option value="19" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 19){ echo 'selected';}} ?>>19</option>
                                    <option value="20" <?php if(isset($_POST['numeroDependentesTrabalham'])) { if($_POST['numeroDependentesTrabalham'] == 20){ echo 'selected';}} ?>>20</option>
                                </select>
                            </div>      
                            <br>
                            <label class="control-label" for="inputHabitantes">Número de habitantes<br> na casa</label>
                            <div class="controls" style='line-height: 40px;'>
                                <select name='numeroHabitantes'>
                                    <option value="0" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 0){ echo 'selected';}} ?>>0</option>
                                    <option value="1" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 1){ echo 'selected';}} ?>>1</option>
                                    <option value="2" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 2){ echo 'selected';}} ?>>2</option>
                                    <option value="3" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 3){ echo 'selected';}} ?>>3</option>
                                    <option value="4" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 4){ echo 'selected';}} ?>>4</option>
                                    <option value="5" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 5){ echo 'selected';}} ?>>5</option>
                                    <option value="6" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 6){ echo 'selected';}} ?>>6</option>
                                    <option value="7" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 7){ echo 'selected';}} ?>>7</option>
                                    <option value="8" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 8){ echo 'selected';}} ?>>8</option>
                                    <option value="9" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 9){ echo 'selected';}} ?>>9</option>
                                    <option value="10" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 10){ echo 'selected';}} ?>>10</option>
                                    <option value="11" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 11){ echo 'selected';}} ?>>11</option>
                                    <option value="12" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 12){ echo 'selected';}} ?>>12</option>
                                    <option value="13" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 13){ echo 'selected';}} ?>>13</option>
                                    <option value="14" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 14){ echo 'selected';}} ?>>14</option>
                                    <option value="15" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 15){ echo 'selected';}} ?>>15</option>
                                    <option value="16" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 16){ echo 'selected';}} ?>>16</option>
                                    <option value="17" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 17){ echo 'selected';}} ?>>17</option>
                                    <option value="18" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 18){ echo 'selected';}} ?>>18</option>
                                    <option value="19" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 19){ echo 'selected';}} ?>>19</option>
                                    <option value="20" <?php if(isset($_POST['numeroHabitantes'])) { if($_POST['numeroHabitantes'] == 20){ echo 'selected';}} ?>>20</option>
                                </select>
                            </div>      
                            <br>


                            <label class="control-label" for="inputComQuemDeixara">Com quem deixará os filhos para estudar</label>
                            <div class="controls" style='line-height: 40px;'>
                                <input id='comQuemDeixara' type='text' name='comQuemDeixara' maxlength="100"  <?php if(isset($_POST['comQuemDeixara'])){ echo "value='".$_POST['comQuemDeixara']."'";} ?>
                                onkeypress="verificaMaiusculo('#comQuemDeixara');" onkeyup="verificaMaiusculo('#comQuemDeixara');">
                            </div>   
                            <br>
                            <label class="control-label" for="inputEmpresa">Empresa que trabalha</label>
                            <div class="controls">
                                <input id='empresa' type='text' name='empresa' maxlength="100" <?php if(isset($_POST['empresa'])){ echo "value='".$_POST['empresa']."'";} ?>
                                onkeypress="verificaMaiusculo('#empresa');" onkeyup="verificaMaiusculo('#empresa');" >
                            </div>      

                            <label class="control-label" for="inputFuncao">Função</label>
                            <div class="controls">
                                <input id='funcao' type='text' name='funcao' maxlength="100" <?php if(isset($_POST['funcao'])){ echo "value='".$_POST['funcao']."'";} ?>
                                onkeypress="verificaMaiusculo('#funcao');" onkeyup="verificaMaiusculo('#funcao');" >
                            </div>   
                            <label class="control-label" for="inputRendaPropria">Renda Própria</label>
                            <div class="controls" style='line-height: 20px'>                
                                <input min="0" step='any' type='number' name='rendaPropria' id='inputRendaPropria' required <?php if(isset($_POST['rendaPropria'])){ echo "value='".$_POST['rendaPropria']."'";} ?>
                                onkeypress="verificaMaiusculo('#rendaPropria');" onkeyup="verificaMaiusculo('#rendaPropria');" id='rendaPropria'>
                            </div>

                            <div id='erroPropria' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve entrar um número. Exemplos: 4 - 2,1 - 2.1 - 1200.
                            </div>
                            <label class="control-label" for="inputRendaFamiliar">Renda Familiar</label>
                            <div class="controls" style='line-height: 20px'>                
                                <input min="0" step='any' type='number' name='rendaFamiliar' id='inputRendaFamiliar' required <?php if(isset($_POST['rendaFamiliar'])){ echo "value='".$_POST['rendaFamiliar']."'";} ?>
                                onkeypress="verificaMaiusculo('#rendaFamiliar');" onkeyup="verificaMaiusculo('#rendaFamiliar');" id='rendaFamiliar'>
                            </div>

                            <div id='erroFamiliar' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve entrar um número. Exemplos: 4 - 2,1 - 2.1 - 1200.
                            </div>
                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputCarteira">Alguém da família recebe ajuda do governo?</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input type="radio" name="recebeAjuda" value="sim" required
                                    <?php
                                    if (isset($_POST['recebeAjuda'])) {
                                        if ($_POST['recebeAjuda'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="recebeAjuda" value="nao" required
                                    <?php
                                    if (isset($_POST['recebeAjuda'])) {
                                        if ($_POST['recebeAjuda'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['recebeAjuda'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se alguém recebe ajuda.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputCarteira">Carteira assinada?</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input type="radio" name="carteira" value="sim" required
                                    <?php
                                    if (isset($_POST['carteira'])) {
                                        if ($_POST['carteira'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="carteira" value="nao" required
                                    <?php
                                    if (isset($_POST['carteira'])) {
                                        if ($_POST['carteira'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['carteira'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se possui carteira assinada.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputJaCarteira">Já trabalhou com carteira assinada?</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input type="radio" name="jaCarteira" value="sim" required
                                    <?php
                                    if (isset($_POST['jaCarteira'])) {
                                        if ($_POST['jaCarteira'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="jaCarteira" value="nao" required
                                    <?php
                                    if (isset($_POST['jaCarteira'])) {
                                        if ($_POST['jaCarteira'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['jaCarteira'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se já trabalhou com carteira assinada.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputProcura">Procura Emprego?</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input type="radio" name="procuraEmprego" value="sim"  required
                                    <?php
                                    if (isset($_POST['procuraEmprego'])) {
                                        if ($_POST['procuraEmprego'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="procuraEmprego" value="nao" required
                                    <?php
                                    if (isset($_POST['procuraEmprego'])) {
                                        if ($_POST['procuraEmprego'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['procuraEmprego'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se está à procura de um emprego.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputPretensao">Pretensão Profissional</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input type="text" name="pretensao" maxlength="100" <?php if(isset($_POST['pretensao'])){ echo "value='".$_POST['pretensao']."'";} ?>
                                    onkeypress="verificaMaiusculo('#pretensao');" onkeyup="verificaMaiusculo('#pretensao');" id='pretensao'>
                                </div>
                            </div>    

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputEstagio">Já realizou estágio remunerado?</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input type="radio" name="estagio" value="sim" required
                                    <?php
                                    if (isset($_POST['estagio'])) {
                                        if ($_POST['estagio'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="estagio" value="nao" required
                                    <?php
                                    if (isset($_POST['estagio'])) {
                                        if ($_POST['estagio'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['estagio'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se já realizou estágio temporário.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputVoluntario">Já exerceu trabalho voluntário?</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input type="radio" name="voluntario" value="sim" required
                                    <?php
                                    if (isset($_POST['voluntario'])) {
                                        if ($_POST['voluntario'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="radio" name="voluntario" value="nao" required
                                    <?php
                                    if (isset($_POST['voluntario'])) {
                                        if ($_POST['voluntario'] == 'nao') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                </div>
                            </div>      
                            <?php if (isset($erro['voluntario'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar se já realizou trabalho voluntário.
                            </div>
                            <?php } ?> 

                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputLocalVoluntário">Onde exerceu trabalho<br> voluntário</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <input id='localVoluntario' type="text" name="localVoluntario" maxlength="100" <?php if(isset($_POST['localVoluntario'])){ echo "value='".$_POST['localVoluntario']."'";} ?> 
                                    onkeypress="verificaMaiusculo('#localVoluntario');" onkeyup="verificaMaiusculo('#localVoluntario');">
                                </div>
                            </div>    

                            <label class="control-label" for="inputHabmot">Habilidade Motora</label>
                            <div class="controls">
                                <select name='habmot'>
                                    <option value="0" <?php if(isset($_POST['habmot'])) { if($_POST['habmot'] == 0){ echo 'selected';}} ?>>Destro(a)</option>
                                    <option value="1" <?php if(isset($_POST['habmot'])) { if($_POST['habmot'] == 1){ echo 'selected';}} ?>>Canhoto(a)</option>
                                    <option value="2" <?php if(isset($_POST['habmot'])) { if($_POST['habmot'] == 2){ echo 'selected';}} ?>>Ambidestro(a)</option>
                                    <option value="3" <?php if(isset($_POST['habmot'])) { if($_POST['habmot'] == 3){ echo 'selected';}} ?>>Nenhuma</option>
                                </select>
                            </div>     

                        </form>
                        <br>
                        <a class='btn' href='dadosPaisEJA.php'>Voltar</a>
                        <button class='btn btn-primary' onclick="if(validaCamposDois() == true){ $('#form1').submit(); }">Avan&ccedil;ar</button>
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
        <script>
            function verificaMaiusculo(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                if(caracter == 'ç' || caracter == 'Ç'){
                    $(elemento).val(string.substr(0, string.length - 1));  
                } else {
                    var letra = caracter.toUpperCase();
                    if (letra < "A" || letra > "Z") {


                    } else { 
                        if(letra != 'Ç'){
                            $(elemento).val(string.substr(0, string.length - 1) + letra);                    
                        }
                    }
                }
            }                                        
            function validaCamposDois() {
                var result = true;
                $('#erroPensao').css('display', 'none');
                $('#erroBolsa').css('display', 'none');
                if (isNaN(parseFloat($('#inputRendaPropria').val()))) {
                    $('#erroPropria').css('display', 'inherit');
                    result = false;
                }
                if (isNaN(parseFloat($('#inputRendaFamiliar').val()))) {
                    $('#erroFamiliar').css('display', 'inherit');
                    result = false;
                }

                return result;
            }

            $('#conteudo').css('display', 'inherit');
        </script>

    </body>
    </html>
