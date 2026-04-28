$(document).ready(function() {
    var count_rotas = 1
    var count_motoristas = 1
    var count_passageiros = 1

    $('form').on('click', '.btn-add-motorista', function () 
    {
        count_motoristas++;
        var button_id = $(this).attr("id");
        $('#cadastro_motoristas_show').append(`
            <div class="form-inline" id="cadastro_motorista_${count_motoristas}">
                <label class="my-1 mr-2" for="cadastro_motorista_${count_motoristas}">Motorista ${count_motoristas}</label>
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao" placeholder="Documento de habilitação">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_orgao_emissor[]" id="motoristas_orgao_emissor" placeholder="Órgão emissor">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_motoristas" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD">
                <button type="button" class="btn-add-motorista btn btn-secondary"  id="${count_motoristas}">+</button>
                <button type="button" class="btn-remove-motorista btn btn-secondary" id="${count_motoristas}"> - </button>
            </div>
        `)
    });
    $('form').on('click', '.btn-remove-motorista', function(){
        var button_id = $(this).attr("id");
        $('#cadastro_motorista_'+ button_id).remove();
        count_motoristas--;
    })
    
    $('form').on('click', '.btn-add-rotas', function () 
    {
        count_rotas++;
        var button_id = $(this).attr("id");
        $('#cadastro_rotas_show').append(`
            <div class="form-inline" id="cadastro_rota_${count_rotas}">
                <label class="my-1 mr-2">Rota ${count_rotas}:</label>
                <input type="date" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_data[]" id="rota_data" placeholder="Data">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_endereco_partida[]" id="rota_endereco_saida" placeholder="Saída">
                <input type="text" class="form-control mb-2 mr-sm-2 verificar_rotas" name="rota_endereco_destino[]" id="rota_endereco_chegada" placeholder="Chegada">
                <button type="button" class="btn-add-rotas btn btn-secondary" id="${count_rotas}"> + </button> 
                <button type="button" class="btn-remove-rotas btn btn-secondary" id="${count_rotas}"> - </button>
            </div>
        `)
    });
    $('form').on('click', '.btn-remove-rotas', function(){
        var button_id = $(this).attr("id");
        $('#cadastro_rota_'+ button_id).remove();
        count_rotas--;
    })

    $('form').on('click', '.btn-add-passageiros', function () 
    {
        count_passageiros++;
        var button_id = $(this).attr("id");
        $('#cadastro_passageiros_show').append(`
            <div class="form-inline" id="cadastro_passageiro_${count_passageiros}">
                <label class="my-1 mr-2">Passageiro ${count_passageiros}:</label>
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
                <button type="button" class="btn-remove-passageiros btn btn-secondary" id="${count_passageiros}"> - </button>
            </div>
        `)
    });
    $('form').on('click', '.btn-remove-passageiros', function(){
        var button_id = $(this).attr("id");
        $('#cadastro_passageiro_'+ button_id).remove();
        count_passageiros--;
    })

})

