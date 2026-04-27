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
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-viagens.css">
    <link rel="stylesheet" href="./public/styles/partials/step-nav-bar.css">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/addField.js" ></script>
    <script src="./public/scripts/jqueyPostToPhp.js"></script>
    <script src="./public/scripts/form.js"></script>
    <script src="./public/scripts/on-off.js"></script>
    <script src="./public/scripts/mobile-nav-bar-active.js" defer></script> <!-- Script for mobile nav-bar links-->


</head>
<body id="page-cadastrar-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <nav class="navbar" >
                    <div class="logo-title">
                        SELO TURÍSTICO
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">
                        <li>
                            <a href="">Ajuda</a>
                        </li>
                        <li>
                            <a href="">Meus dados</a>
                        </li>
                        <li>
                            <a href="">Sair</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
     
            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">

                <strong>Cadastre suas viagens</strong>
                <p>O primeiro passo, é preencher este formulário</p>
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

                <fieldset id="informacoes_viagem" class="div-show" style="display: block;">
                    <legend>Informações Sobre a Viagem
                    <button type="button" id="button_Mudarestado_informacoes_viagem"
                            onclick="Mudarestado('informacoes_viagem_show','button_Mudarestado_informacoes_viagem')">
                           + Abrir</button>
                    </legend>

                    <div id="informacoes_viagem_show" style="display:block">
                        <span id="msg-error-informacoes_viagem"></span>

                        <div class="input-block grid grid-two">
                            <div class="input-block">
                                <label for="data_chegada">Data de Chegada</label>
                                <input type="date" class="form-control" name="data_chegada" id="data_chegada" placeholder="Chegada">
                            </div>
                        
                            <div class="input-block">
                                <label for="data_saida">Data de Retorno</label>
                                <input type="date" class="form-control" name="data_saida" id="data_saida" placeholder="Saída">
                            </div> 
                        </div>

                        <div class="input-block grid grid-tree">
                            <div class="input-block">
                                <label for="cidade_origem">Cidade</label>
                                <input type="text" class="form-control" name="cidade_origem" id="cidade_origem" placeholder="Cidade">
                            </div>
                        
                            <div class="input-block">
                                <label for="estado_origem">Estado/Província</label>
                                <input type="text" class="form-control" name="estado_origem" id="estado_origem" placeholder="Estado">
                            </div>
                            <div class="input-block">
                                <label for="pais_origem">País</label>
                                <input type="text" class="form-control" name="pais_origem" id="pais_origem" placeholder="País">
                            </div>
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
                    <div id="cadastro_veiculo_show" style="display:block">
                        <span id="msg-error-cadastro_veiculo"></span>
                        <div class="input-block grid grid-two">
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
                            <div class="input-block">
                                <label for="placa">Placa</label>
                                <input type="text" class="form-control" name="placa_veiculo" id="placa_veiculo" placeholder="Placa">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset id="cadastro_motoristas" class="div-show cadastro_motoristas_show" style="display: block;">
                    <legend>
                        Cadastro de Motoristas
                        <button type="button"id="button_Mudarestado_cadastro_motoristas"
                        onclick="Mudarestado('cadastro_motoristas_show','button_Mudarestado_cadastro_motoristas')">+ Abrir</button>
                    </legend>
                    <div class="input-block motoristas-global-scope"  id="cadastro_motoristas_show" style="display: block;">
                        <div class="input-block motoristas-local-scope">
                            <div class="input-block grid grid-tree">         

                                <div class="input-block">
                                    <label for="cadastro_motorista_1">Motorista </label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome">
                                </div>               
                                <div class="input-block">
                                    <label for="time_to">Telefone (DDD + DDI)</label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD">                               
                                </div>             
                                <div class="input-block">
                                    <label for="time_to">Habilitação</label>
                                    <input type="text" class="verificar_motoristas" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao"> 
                                </div>
                                
                            </div>
                        </div>

                        

                    </div>
                    <button type="button" class="btn-add-motorista">+ Adicionar motorista</button>
                </fieldset> 

                <fieldset id="cadastro_rotas" class="div-show" style="display: block;">
                    <legend>
                        Cadastro de Rotas
                        <button type="button" id="button_Mudarestado_cadastro_rotas"
                        onclick="Mudarestado('cadastro_rotas_show','button_Mudarestado_cadastro_rotas')">+ Abrir</button>
                    </legend>
                    <div class="input-block grid rotas-local-scope"  id="cadastro_rotas_show" style="display: block;">
                        <div class="grid">
                            <div class="grid grid-tree-rota">
                                <div class="input-block">
                                    <label for="time_from">Data</label>
                                    <input type="date" name="rota_endereco_destino[]">
                                </div>
                                <div class="select-block">
                                    <label for="time_from">Local de partida</label>
                                    <select class="form-control" name="rota_endereco_partida[]" id="rota_endereco_partida" aria-describedby="rota_partida_helpid">
                                        <option disabled selected value>Selecione uma opção</option>
                                        <option value="Abraão">Abraão</option>
                                        <option value="Agronômica">Agronômica</option>
                                        <option value="Balneário">Balneário</option>
                                        <option value="Barra da Lagoa">Barra da Lagoa</option>
                                        <option value="Bom Abrigo">Bom Abrigo</option>
                                        <option value="Cachoeira do Bom Jesus">Cachoeira do Bom Jesus</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Canasvieiras">Canasvieiras</option>
                                        <option value="Canto">Canto</option>
                                        <option value="Capoeiras">Capoeiras</option>
                                        <option value="Carvoeira">Carvoeira</option>
                                        <option value="Centro">Centro</option>
                                        <option value="Coloninha">Coloninha</option>
                                        <option value="Coqueiros">Coqueiros</option>
                                        <option value="Córrego Grande">Córrego Grande</option>
                                        <option value="Costeira do Pirajubaé">Costeira do Pirajubaé</option>
                                        <option value="Estreito">Estreito</option>
                                        <option value="Ingleses">Ingleses</option>
                                        <option value="Itacorubi">Itacorubi</option>
                                        <option value="Itaguaçú">Itaguaçú</option>
                                        <option value="Jardim Atlântico">Jardim Atlântico</option>
                                        <option value="João Paulo">João Paulo</option>
                                        <option value="José Mendes">José Mendes</option>
                                        <option value="Lagoa da Conceição">Lagoa da Conceição</option>
                                        <option value="Monte Cristo">Monte Cristo</option>
                                        <option value="Monte Verde">Monte Verde</option>
                                        <option value="Pantanal">Pantanal</option>
                                        <option value="Pântano do Sul">Pântano do Sul</option>
                                        <option value="Ratones">Ratones</option>
                                        <option value="Ribeirão da Ilha">Ribeirão da Ilha</option>
                                        <option value="Saco dos Limões">Saco dos Limões</option>
                                        <option value="Saco Grande">Saco Grande</option>
                                        <option value="Santa Mônica">Santa Mônica</option>
                                        <option value="Santo Antônio">Santo Antônio</option>
                                        <option value="São João do Rio Vermelho">São João do Rio Vermelho</option>
                                        <option value="Trindade">Trindade</option>
                                        
                                        <option value="Outras cidades">Outras cidades</option>
                                    </select>
                                    <small id="rota_partida_helpid" class="form-text text-muted">Bairro de partida</small>
                                </div>

                                <div class="select-block">
                                    <label for="time_to">Local de chegada</label>
                                    <select class="form-control" name="rota_endereco_chegada[]" id="rota_endereco_chegada">
                                        <option disabled selected value>Selecione uma opção</option>
                                        <option value="Abraão">Abraão</option>
                                        <option value="Agronômica">Agronômica</option>
                                        <option value="Balneário">Balneário</option>
                                        <option value="Barra da Lagoa">Barra da Lagoa</option>
                                        <option value="Bom Abrigo">Bom Abrigo</option>
                                        <option value="Cachoeira do Bom Jesus">Cachoeira do Bom Jesus</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Canasvieiras">Canasvieiras</option>
                                        <option value="Canto">Canto</option>
                                        <option value="Capoeiras">Capoeiras</option>
                                        <option value="Carvoeira">Carvoeira</option>
                                        <option value="Centro">Centro</option>
                                        <option value="Coloninha">Coloninha</option>
                                        <option value="Coqueiros">Coqueiros</option>
                                        <option value="Córrego Grande">Córrego Grande</option>
                                        <option value="Costeira do Pirajubaé">Costeira do Pirajubaé</option>
                                        <option value="Estreito">Estreito</option>
                                        <option value="Ingleses">Ingleses</option>
                                        <option value="Itacorubi">Itacorubi</option>
                                        <option value="Itaguaçú">Itaguaçú</option>
                                        <option value="Jardim Atlântico">Jardim Atlântico</option>
                                        <option value="João Paulo">João Paulo</option>
                                        <option value="José Mendes">José Mendes</option>
                                        <option value="Lagoa da Conceição">Lagoa da Conceição</option>
                                        <option value="Monte Cristo">Monte Cristo</option>
                                        <option value="Monte Verde">Monte Verde</option>
                                        <option value="Pantanal">Pantanal</option>
                                        <option value="Pântano do Sul">Pântano do Sul</option>
                                        <option value="Ratones">Ratones</option>
                                        <option value="Ribeirão da Ilha">Ribeirão da Ilha</option>
                                        <option value="Saco dos Limões">Saco dos Limões</option>
                                        <option value="Saco Grande">Saco Grande</option>
                                        <option value="Santa Mônica">Santa Mônica</option>
                                        <option value="Santo Antônio">Santo Antônio</option>
                                        <option value="São João do Rio Vermelho">São João do Rio Vermelho</option>
                                        <option value="Trindade">Trindade</option>
                                        
                                        <option value="Outras cidades">Outras cidades</option>
                                    </select>
                                    <small id="rota_partida_helpid" class="form-text text-muted">Bairro de chegada</small>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-add-rotas">+ Adicionar rota</button>

                </fieldset> 

                <fieldset id="schedule-items" class="div-show cadastro_passageiros_show" style="display: block;">
                    <legend>
                        Cadastro de Passageiros
                        <button type="button" id="button_Mudarestado_cadastro_passageiros"
                        onclick="Mudarestado('cadastro_passageiros_show','button_Mudarestado_cadastro_passageiros')">+ Abrir</button>
                    </legend>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-add-passageiros">+ Adicionar passageiros</button>
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