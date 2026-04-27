<?php
session_start();
require_once('./login/session_status.php');
$operador_email = $_SESSION['usuarioEmail'];
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
    <link rel="stylesheet" href="./public/styles/partials/step-nav-bar.css">
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-viagens.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/addField.js" ></script>
    <script src="./public/scripts/jqueyPostToPhp.js"></script>
    <script src="./public/scripts/form.js"></script>
    <script src="./public/scripts/on-off.js"></script>


</head>
<body id="page-cadastrar-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <a href="/">
                <img src="./public/images/icons/seta_esquerda.svg" alt="Voltar">
                </a>
                 <!-- <img src="./public/images/logo.svg" alt="PMF"> -->
            </div>
     
            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">

                <strong>Cadastre suas viagens</strong>
                <p>O primeiro passo, é preencher este formulário</p>
            </div>
            <div id="stage1" style="display:none;"> 
            </div>
        </header>
        <nav style="display: none;">
            <ul class="nav-form-setp-bar">

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
        </nav>

        <main style="display: block;">            
            <form id="testform">

                <fieldset id="informacoes_viagem" class="div-show" style="display: block;">
                    <legend>Informações Sobre a Viagem
                    <button type="button" id="button_Mudarestado_informacoes_viagem"
                            onclick="Mudarestado('informacoes_viagem_show','button_Mudarestado_informacoes_viagem')">
                           + Abrir</button>
                    </legend>
                    <div id="informacoes_viagem_show" style="display:none">
                    <span id="msg-error-informacoes_viagem"></span>
                        <div class="input-block">
                            <label for="data_chegada">Data de Chegada</label>
                            <input type="date" class="form-control" name="data_chegada" id="data_chegada" placeholder="Chegada">
                        </div>
                        <div class="input-block">
                            <label for="data_saida">Data de Retorno</label>
                            <input type="date" class="form-control" name="data_saida" id="data_saida" placeholder="Saída">
                        </div>
                        <div class="input-block">
                            <label for="logradouro_origem">Logradouro de origem</label>
                            <input type="text" class="form-control" name="logradouro_origem" id="logradouro_origem" placeholder="Logradouro de origem">
                        </div>
                        <div class="input-block">
                            <label for="bairro_origem">Bairro de origem</label>
                            <input type="text" class="form-control" name="bairro_origem" id="bairro_origem" placeholder="Bairro">
                        </div>
                        <div class="input-block">
                            <label for="cidade_origem">Cidade de origem</label>
                            <input type="text" class="form-control" name="cidade_origem" id="cidade_origem" placeholder="Cidade">
                        </div>
                        <div class="input-block">
                            <label for="estado_origem">Estado de origem</label>
                            <input type="text" class="form-control" name="estado_origem" id="estado_origem" placeholder="Estado">
                        </div>
                        <div class="input-block">
                            <label for="pais_origem">País de origem</label>
                            <input type="text" class="form-control" name="pais_origem" id="pais_origem" placeholder="País de origem">
                        </div>
                        <div class="input-block">
                            <label for="demais_referencias">Demais referências</label>
                            <input type="text" class="form-control" name="demais_referencias" id="demais_referencias" placeholder="Demais referências">
                        </div>
                    </div>
                </fieldset>

                <fieldset id="cadastro_veiculo" class="div-show" style="display: block;">
                    <legend>Cadastro do Veículo
                    <button type="button" id="button_Mudarestado_cadastro_veiculo"
                        onclick="Mudarestado('cadastro_veiculo_show','button_Mudarestado_cadastro_veiculo')">
                        + Abrir </button>
                    </legend>
                    <div id="cadastro_veiculo_show" style="display:none">
                        <span id="msg-error-cadastro_veiculo"></span>
        
                        <div class="input-block">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" name="placa_veiculo" id="placa_veiculo" placeholder="Placa">
                        </div>
                        <div class="select-block">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo_veiculo" id="tipo_veiculo">
                                <label for="tipo">Tipo</label>
                                <option disabled selected value>Selecione um tipo</option>
                                <option value="Ônibus">Ônibus</option>
                                <option value="Micro-ônibus">Micro-ônibus</option>
                                <option value="Van">Van</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset id="schedule-items" class="div-show cadastro_motoristas_show" style="display: block;">
                    <legend>
                        Cadastro de Motoristas
                        <button type="button"id="button_Mudarestado_cadastro_motoristas"
                        onclick="Mudarestado('cadastro_motoristas_show','button_Mudarestado_cadastro_motoristas')">+ Abrir</button>
                    </legend>
                    <div class="motoristas-global-scope"  id="cadastro_motoristas_show" style="display: none;">
                        <div class="motoristas-local-scope">
                            <div class="schedule-item-motorista">
                                
                                <div class="input-block">
                                    <label for="cadastro_motorista_1">Motorista</label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome">
                                </div>                           
                                <div class="input-block">
                                    <label for="time_to">Habilitação</label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao"> 
                                </div>
                                <div class="input-block">
                                    <label for="time_to">Telefone (DDD + DDI)</label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD">                               
                                </div> 
                                
                            </div>
                        </div>
                        <button type="button" class="btn-add-motorista">+ Adicionar motorista</button>
                    </div>
                </fieldset> 

                <fieldset id="schedule-items" class="div-show" style="display: block;">
                    <legend>
                        Cadastro de Rotas
                        <button type="button" id="button_Mudarestado_cadastro_rotas"
                        onclick="Mudarestado('cadastro_rotas_show','button_Mudarestado_cadastro_rotas')">+ Abrir</button>
                    </legend>
                    <div class="rotas-scope-global"  id="cadastro_rotas_show" style="display: none;">
                        <div class="rotas-local-scope">
                            <div class="schedule-item">

                                <div class="input-block">
                                    <label for="time_from">Chegada</label>
                                    <input type="text" name="rota_data[]">
                                </div>

                                <div class="input-block">
                                    <label for="time_to">Saída</label>
                                    <input type="text" name="rota_endereco_partida[]">
                                </div>
                            
                                <div class="input-block">
                                    <label for="time_from">Data</label>
                                    <input type="date" name="rota_endereco_destino[]">
                                </div>
                                
                            </div>
                        </div>
                        <button type="button" class="btn-add-rotas">+ Adicionar rota</button>
                    </div>

                </fieldset> 

                <fieldset id="schedule-items" class="div-show cadastro_passageiros_show" style="display: block;">
                    <legend>
                        Cadastro de Passageiros
                        <button type="button" id="button_Mudarestado_cadastro_passageiros"
                        onclick="Mudarestado('cadastro_passageiros_show','button_Mudarestado_cadastro_passageiros')">+ Abrir</button>
                    </legend>

                    <div class="passageiros-global-scope"  id="cadastro_passageiros_show" style="display: none;">
                        <div class="passageiros-local-scope">
                            <div class="schedule-item-passageiros">
                                <div class="schedule-item-passageiros-inputs">
                                    <div class="input-block">
                                        <label for="cadastro_motorista_1">Passageiro 1</label>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-add-passageiros">+ Adicionar passageiros</button>
                    </div>
                </fieldset> 
                <input type="hidden" name="operador_email" value="<?php echo $operador_email?>">

            </form>

            <footer>
                <p>
                    Importante! <br>
                    Preencha todos os dados corretamente
                </p>
                <button id="driver">Salvar cadastro</button>
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