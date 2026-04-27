<html>

<head>
    <title>Cadastrar Viagens</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/addField.js"></script>
    <script src="./public/scripts/jqueyPostToPhp.js"></script>
    <!-- <link rel="stylesheet" href="./public/styles/main.css"> -->
    <!-- michel -->
    <script src="form.js"></script>
    <script src="on-off.js"></script>
    <!-- michel -->
</head>

<body>
    <div id="stage1" style="background-color:maroon;color:white;">
        STAGE - 2
    </div>

    <form id="testform">

        <fieldset class="form-group" id="cadastro_contratantes">
            <legend>Dados da Operadora&nbsp;
                <button type="button"  class="btn-change" id="button_Mudarestado_cadastro_contratantes" onclick="Mudarestado('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes')">+</button>&nbsp;
            </legend>
            <div id="cadastro_contratantes_show" class="div-show" style="display:none">
                <span id="msg-error-contratantes"></span>

                <div class="form-group">
                    <label for="contratantes_nome">Nome da Operadora</label>
                    <input type="text" class="form-control" name="contratantes_nome" id="contratantes_nome" aria-describedby="contratantes_nome_helpId" placeholder="Digite o nome...">
                </div>

                <div class="form-group">
                    <label for="contratantes_logradouro">Logradouro da Operadora</label>
                    <input type="text" class="form-control" name="contratantes_logradouro" id="contratantes_logradouro" aria-describedby="contratantes_logradouro_helpId" placeholder="">
                    <small id="contratantes_logradouro_helpId" class="form-text text-muted">Ex: Rua Felipe Schimidt</small>
                </div>

                <div class="form-group">
                    <label for="contratantes_bairro">Bairro da Operadora</label>
                    <input type="text" class="form-control" name="contratantes_bairro" id="contratantes_bairro" aria-describedby="contratantes_bairro_helpId" placeholder="">
                    <small id="contratantes_bairro_helpId" class="form-text text-muted">Ex: Centro</small>
                </div>

                <div class="form-group">
                    <label for="contratantes_cidade">Cidade da Operadora</label>
                    <input type="text" class="form-control" name="contratantes_cidade" id="contratantes_cidade" placeholder="Cidade">
                </div>

                <div class="form-group">
                    <label for="contratantes_estado">Estado da Operadora</label>
                    <input type="text" class="form-control" name="contratantes_estado" id="contratantes_estado" placeholder="Estado">
                </div>

                <div class="form-group">
                    <label for="contratantes_pais">País da Operadora</label>
                    <select class="form-control" name="contratantes_pais" id="contratantes_pais">
                        <option disabled selected value>Selecione uma páis</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bolívia">Bolívia</option>
                        <option value="Brasil">Brasil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colômbia">Colômbia</option>
                        <option value="Equador">Equador</option>
                        <option value="Paraguai">Paraguai</option>
                        <option value="Peru">Peru</option>
                        <option value="Uruguai">Uruguai</option>
                        <option value="Venezuela">Venezuela</option>                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="contratantes_tipo_documento">Tipo de documento</label>
                    <select class="form-control" name="contratantes_tipo_documento" id="contratantes_tipo_documento">
                        <option disabled selected value>Selecione uma opção</option>
                        <option value="RG">RG</option>
                        <option value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                        <option value="CNH">CNH</option>
                        <option value="Carteira de Identidade">(Estrangeiro) Carteira de Identidade</option>
                        <option value="Cédula de Cidadania">(Estrangeiro) Cédula de Cidadania</option>
                        <option value="Cédula de Estrangeiro">(Estrangeiro) Cédula de Estrangeiro</option>
                        <option value="Cédula de Identidade">(Estrangeiro) Cédula de Identidade</option>
                        <option value="Documento Nacional de Identidade">(Estrangeiro) Documento Nacional de Identidade</option>
                        <option value="Passaporte.">(Estrangeiro) Passaporte.</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contratantes_documento">Número do documento</label>
                    <input type="text" class="form-control" name="contratantes_documento" id="contratantes_documento" placeholder="Número do documento">
                </div>

                <div class="form-group">
                    <label for="contratantes_email">E-mail</label>
                    <input type="email" class="form-control" name="contratantes_email" id="contratantes_email" placeholder="email@email.com">
                </div>

                <div class="form-group">
                    <label for="contratantes_email_rep">Confirmar E-mail</label>
                    <input type="email" class="form-control" name="contratantes_email_rep" id="contratantes_email_rep" placeholder="email@email.com">
                </div>

                <div class="form-group">
                    <label for="contratantes_telefone">Telefone (DDI + DDD + Número)</label>
                    <div class="form-inline">
                        <label for="contratantes_ddi">DDI</label>
                        <input type="tel" name="contratantes_ddi" id="contratantes_ddi" class="form-control" placeholder="+55" aria-describedby="helpId">
                        <small id="helpId" class="text-muted"></small>
                        <label for="contratantes_ddd">DDD</label>
                        <input type="tel" name="contratantes_ddd" id="contratantes_ddd" class="form-control" placeholder="48" aria-describedby="helpId">
                        <small id="helpId" class="text-muted"></small>
                        <label for="contratantes_numero">Número</label>
                        <input type="tel" name="contratantes_numero" id="contratantes_numero" class="form-control" placeholder="888888888" aria-describedby="helpId">
                        <small id="helpId" class="text-muted"></small>
                    </div>
                </div>

            </div>
        </fieldset>


        <!-- michel botao temporario -->

        <hr>
        <input type="button" id="driver1" value="test form" onclick="return validarContratantes()" />
        <hr>

        <!-- michel -->


        <fieldset class="form-group" id="informacoes_viagem">
            <legend>Informações Sobre a Viagem&nbsp;
                <button type="button" id="button_Mudarestado_informacoes_viagem" onclick="Mudarestado('informacoes_viagem_show','button_Mudarestado_informacoes_viagem')">+</button>&nbsp;
            </legend>
            <div id="informacoes_viagem_show" style="display:none">
            <span id="msg-error-informacoes_viagem"></span>
                <div class="form-group">
                    <label for="data_chegada">Data de Chegada</label>
                    <input type="date" class="form-control" name="data_chegada" id="data_chegada" placeholder="Chegada">
                </div>
                <div class="form-group">
                    <label for="data_saida">Data de Retorno</label>
                    <input type="date" class="form-control" name="data_saida" id="data_saida" placeholder="Saída">
                </div>
                <div class="form-group">
                    <label for="logradouro_origem">Logradouro de origem</label>
                    <input type="text" class="form-control" name="logradouro_origem" id="logradouro_origem" placeholder="Logradouro de origem">
                </div>
                <div class="form-group">
                    <label for="bairro_origem">Bairro de origem</label>
                    <input type="text" class="form-control" name="bairro_origem" id="bairro_origem" placeholder="Bairro">
                </div>
                <div class="form-group">
                    <label for="cidade_origem">Cidade de origem</label>
                    <input type="text" class="form-control" name="cidade_origem" id="cidade_origem" placeholder="Cidade">
                </div>
                <div class="form-group">
                    <label for="estado_origem">Estado de origem</label>
                    <input type="text" class="form-control" name="estado_origem" id="estado_origem" placeholder="Estado">
                </div>
                <div class="form-group">
                    <label for="pais_origem">País de origem</label>
                    <input type="text" class="form-control" name="pais_origem" id="pais_origem" placeholder="País de origem">
                </div>
                <div class="form-group">
                    <label for="demais_referencias">Demais referências</label>
                    <input type="text" class="form-control" name="demais_referencias" id="demais_referencias" placeholder="Demais referências">
                </div>
            </div>
        </fieldset>

          <!-- michel botao temporario -->

          <hr>
        <input type="button" id="driver1" value="test form" onclick="return validarViagem()" />
        <hr>

        <!-- michel -->


        <fieldset class="form-group" id="cadastro_veiculo">
            <legend>Cadastro do Veículo&nbsp;
                <button type="button" id="button_Mudarestado_cadastro_veiculo" onclick="Mudarestado('cadastro_veiculo_show','button_Mudarestado_cadastro_veiculo')">+</button>&nbsp;
            </legend>
            <div id="cadastro_veiculo_show" style="display:none">
            <span id="msg-error-cadastro_veiculo"></span>

                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" name="modelo_veiculo" id="modelo_veiculo" placeholder="Modelo">
                </div>
                <div class="form-group">
                    <label for="placa">Placa</label>
                    <input type="text" class="form-control" name="placa_veiculo" id="placa_veiculo" placeholder="Placa">
                </div>
                <div class="form-group">
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

        <!-- michel botao temporario -->
        <hr>
        <input type="button" id="driver1" value="test form" onclick="return validarVeiculo()" />
        <hr>
        <!-- michel -->

        <fieldset class="form-group" id="cadastro_motoristas">
            <legend>Cadastro de Motoristas&nbsp;
                <button type="button" id="button_Mudarestado_cadastro_motoristas" onclick="Mudarestado('cadastro_motoristas_show','button_Mudarestado_cadastro_motoristas')">+</button>&nbsp;
            </legend>
            <div id="cadastro_motoristas_show" style="display:none">
            <span id="msg-error-cadastro_motoristas"></span>
                <div class="form-inline" id="cadastro_motorista_1">
                    <label class="my-1 mr-2" for="cadastro_motorista_1">Motorista 1</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome">
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao" placeholder="Documento de habilitação">
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_orgao_emissor[]" id="motoristas_orgao_emissor" placeholder="Órgão emissor">
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD">
                    <button type="button" class="btn-add-motorista btn btn-secondary" id="add_morotistas">+</button>
                </div>
            </div>
        </fieldset>
        <!-- lucas botao temporario -->
        <hr>
        <input type="button" id="" value="Validar motoristas" onclick="return validarMotoristas()" />
        <hr>
        <!-- lucas -->


        <fieldset class="form-group" id="cadastro_rotas">
            <legend>Cadastro de Trajetos&nbsp;
                <button type="button" id="button_Mudarestado_cadastro_rotas" onclick="Mudarestado('cadastro_rotas_show','button_Mudarestado_cadastro_rotas')">+</button>&nbsp;
            </legend>
            <div id="cadastro_rotas_show" style="display:none">
            <span id="msg-error-cadastro_rotas"></span>


                <div class="form-inline" id="cadastro_rota_1">
                    <label class="my-1 mr-2">Rota 1:</label>
                    <input type="date" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_data[]" id="rota_data" placeholder="Data">
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_endereco_partida[]" id="rota_endereco_saida" placeholder="Saída">
                    <input type="text" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_endereco_destino[]" id="rota_endereco_chegada" placeholder="Chegada">
                    <button type="button" class="btn-add-rotas btn btn-secondary" id="add_rotas">+</button>
                </div>
            </div>
        </fieldset>

        <!-- michel botao temporario -->
        <hr>
        <input type="button" id="" value="Validar rotas" onclick="return validarRotas()" />
        <hr>
        <!-- michel -->

        <fieldset class="form-group" id="cadastro_passageiros">
            <legend>Lista de Passageiros&nbsp;
                <button type="button" id="button_Mudarestado_cadastro_passageiros" onclick="Mudarestado('cadastro_passageiros_show','button_Mudarestado_cadastro_passageiros')">+</button>&nbsp;
            </legend>
            <div id="cadastro_passageiros_show" style="display:none">
            <span id="msg-error-cadastro_passageiros"></span>
            <div class="form-inline" id="cadastro_passageiro_1">
                <label class="my-1 mr-2">Passageiro 1:</label>
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_nome[]" id="passageiros_nome" placeholder="Nome">
                <input type="date" class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_data_nascimento[]" id="passageiros_data_nascimento" placeholder="Data de nascimento">
                <!-- <input type="text" class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_tipo_documento[]" id="passageiros_tipo_documento" placeholder="Tipo Documento"> -->
                <select class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_nacionalidade[]" id="passageiros_nacionalidade">
                    <option disabled selected value>Selecione a nacionalidade</option>
                    <option value="Brasileiro">Brasileiro</option>
                    <option value="Estrangeiro">Estrangeiro</option>
                </select>
                <select class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_tipo_documento[]" id="passageiros_tipo_documento" >
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
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_documento[]" id="passageiros_documento" placeholder="Documento">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_passageiros" name="passageiros_orgao_emissor[]" id="passageiros_orgao_emissor" placeholder="Órgão emissor">
                <button type="button" class="btn-add-passageiros btn btn-secondary" id="add_passageiros">+</button>
            </div>
        </fieldset>
        <!-- lucas botao temporario -->
        <hr>
        <input type="button" id="" value="Validar passageiros" onclick="return validarPassageiros()" />
        <hr>
        <!-- lucas -->


        <!-- <input type="button" id="driver" value="Load Data" /> -->
    </form>
    <button id="driver">Cadastrar</button>
</body>

</html>