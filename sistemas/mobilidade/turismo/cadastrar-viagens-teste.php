<?php
session_start();
require_once('./login/session_status.php');
$operador_email = $_SESSION['usuarioEmail'];
$data_atual = date("Y-m-d");  ;
?>


<!DOCTYPE html>
<html lang="pt-br"><!-- lang é um atributo-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Turismo | Cadastre sua viagem </title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="./public/styles/main.css">
    <link rel="stylesheet" href="./public/styles/partials/header.css">
    <link rel="stylesheet" href="./public/styles/partials/forms.css">
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-viagens.css">
    <link rel="stylesheet" href="./public/styles/partials/step-nav-bar.css">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/addField.js" ></script>
    <script src="./public/scripts/driver1.js"></script>
    <script src="./public/scripts/form.js" defer></script>
    <script src="./public/scripts/on-off.js"></script>
    <script src="./public/scripts/mobile-nav-bar-active.js" defer></script> <!-- Script for mobile nav-bar links-->
    <?php

$teste = "ALO";


?>

</head>
<body id="page-cadastrar-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <nav class="navbar" >
                    <div class="logo-title">
                        <a href="./">SELO TURÍSTICO</a> 
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">
                        <li>
                            <a href="./">Ajuda</a>
                        </li>
                        <li>
                            <a href="./minhas-viagens.php">Minhas viagens</a>
                        </li>
                        <li>
                            <a href="#">Dados da Operadora</a>
                        </li>
                        <li>
                            <a href="./login/sair.php">Sair</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
     
            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">

                <strong>Cadastre uma viagem</strong>
                <p>O veículo não estará autorizado a circular na cidade de Florianópolis com passageiros que não estejam cadastrados neste formulário de viagem.
                Favor preencher as rotas a serem realizadas dentro de Florianópolis.</p>
            </div>
            <div id="stage1" style="background-color:maroon;color:white; display:none">
            </div>
        </header>
        <!-- <nav class="wizard-bar" style="display: block;">
            <ul class="nav-form-step-bar">

                <li>   
                    <button id="button_Mudarestado_informacoes_viagem"
                            onclick="Mudarestado('informacoes_viagem_show','button_Mudarestado_informacoes_viagem')">
                            <img src="./public/images/check_circle.svg" alt="check" style="display: block;">
                            <img src="./public/images/uncheck_circle.svg" alt="uncheck" style="display: none;">
                            Informações Sobre a Viagem
                    </button>
                                           
                </li>
                <li>
                    <button id="button_Mudarestado_cadastro_veiculo"
                        onclick="Mudarestado('cadastro_veiculo_show','button_Mudarestado_cadastro_veiculo')">
                        <img src="./public/images/check_circle.svg" alt="check" style="display: none;">
                        <img src="./public/images/uncheck_circle.svg" alt="uncheck" style="display: block;">
                        Cadastro do Veículo
                </button>
                </li>
                <li>
                    <button id="button_Mudarestado_cadastro_motoristas"
                        onclick="Mudarestado('cadastro_motoristas_show','button_Mudarestado_cadastro_motoristas')">
                        <img src="./public/images/check_circle.svg" alt="check" style="display: none;">
                        <img src="./public/images/uncheck_circle.svg" alt="uncheck" style="display: block;">
                        Cadastro de Motoristas
                </button>
                </li>
                <li>
                    <button id="button_Mudarestado_cadastro_rotas"
                        onclick="Mudarestado('cadastro_rotas_show','button_Mudarestado_cadastro_rotas')">
                        <img src="./public/images/check_circle.svg" alt="check" style="display: none;">
                        <img src="./public/images/uncheck_circle.svg" alt="uncheck" style="display: block;">
                        Cadastro de Trajetos
                </button>
                </li>
                <li>
                    <button id="button_Mudarestado_cadastro_passageiros"
                        onclick="Mudarestado('cadastro_passageiros_show','button_Mudarestado_cadastro_passageiros')">
                        <img src="./public/images/check_circle.svg" alt="check" style="display: none;">
                        <img src="./public/images/uncheck_circle.svg" alt="uncheck" style="display: block;">
                        Lista de Passageiros
                </button>
                </li>
            </ul>
        </nav> -->

        <main style="display: block;">      
      
            <form id="testform">
            <input type="hidden" name="data_atual" id="data_atual" value="<?php echo $data_atual ?> ">

                

                <fieldset id="schedule-items" class="div-show cadastro_passageiros_show" style="display: block;">
                    <legend>
                        Cadastro de Passageiros
                        <button type="button" id="button_Mudarestado_cadastro_passageiros"
                        onclick="Mudarestado('cadastro_passageiros_show','button_Mudarestado_cadastro_passageiros')">+ Abrir</button>
                    </legend>
                    <div class="input-block">
                    <small id="passageiros_msg_1" class="small-message form-text text-muted"></small>
                    </div>
                 
            
                    <div class="input-block passageiros-local-scope"  id="cadastro_passageiros_show" style="display: block;">
                        <div class="input-block grid">
                            <div class="grid ">
                                <div class="grid grid-tree-passageiros">
                                    <div class="input-block">
                                        <label for="cadastro_motorista_1">Passageiro</label>
                                        <input type="text" class="verificar_passageiros" name="passageiros_nome[]" id="passageiros_nome" placeholder="Nome">
                                    </div>

                                    <div class="input-block">
                                        <label for="">Data de nascimento</label>
                                        <input type="date" class="verificar_passageiros" name="passageiros_data_nascimento[]" id="passageiros_data_nascimento" placeholder="Data de nascimento">
                                    </div>    
                                    
                                    <div class="select-block">
                                        <label for="">Nacionalidade</label>
                                        <select class="verificar_passageiros" name="passageiros_nacionalidade[]" id="passageiros_nacionalidade">
                                            <option disabled selected value>Selecione a nacionalidade</option>
                                            <option value="Brasileiro">Brasileiro</option>
                                            <option value="Estrangeiro">Estrangeiro</option>
                                        </select>
                                     
                                    </div>
                                    
                                    <div class="select-block">
                                        <label for="passageiros_tipo_documento">Tipo de documento</label>
                                        <select class="verificar_passageiros" name="passageiros_tipo_documento[]" id="passageiros_tipo_documento">
                                            <option disabled selected value>Tipo de documento</option>
                                            <option value="RG">RG</option>
                                            <option value="CPF">CPF</option>
                                            <option value="CNPJ">CNPJ</option>
                                            <option value="CNH">CNH</option>
                                            <option value="Carteira de Identidade">Carteira de Identidade</option>
                                            <option value="Cédula de Cidadania">Cédula de Cidadania</option>
                                            <option value="Cédula de Estrangeiro">Cédula de Estrangeiro</option>
                                            <option value="Cédula de Identidade">Cédula de Identidade</option>
                                            <option value="Documento Nacional de Identidade">Documento Nacional de Identidade</option>
                                            <option value="Passaporte.">Passaporte.</option>
                                        </select>

                                    </div>                       

                                    <div class="input-block">
                                        <label for="">Documento</label>
                                        <input type="text" class="verificar_passageiros" name="passageiros_documento[]" id="passageiros_documento" placeholder="Documento">
                                    </div>

                                    <div class="input-block">
                                        <label for="">Orgão emissor</label>
                                        <input type="text" class="verificar_passageiros" name="passageiros_orgao_emissor[]" id="passageiros_orgao_emissor" placeholder="Órgão emissor">
                                        <small id="passageiros_orgao_emissor_helpId" class="form-text text-muted">Digite o nome ou razão social do operador</small>
                                  
                                    </div>


                                </div>
                            </div>
                            
                        </div>
                   
                    </div>
                 

                    <button type="button" class="btn-add-passageiros">+ Adicionar passageiros</button>
                </fieldset> 
                
                       
           
                </form>  

          

            <footer>
                <p>
                    Importante! <br>
                    Preencha todos os dados corretamente
                </p>
                <button  onclick="return validar(); envia(); ">Salvar cadastro 1</button>

                <button  onclick="envia(); ">Salvar cadastro 2</button>

                <button  id="driver1">Salvar cadastro</button>
            </footer>
            <!-- onclick="Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                  );" -->

        </main>
        <script>
        
        </script>
    </div>

</body>
</html>