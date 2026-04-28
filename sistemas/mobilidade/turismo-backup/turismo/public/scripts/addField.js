$(document).ready(function() {
    var count_rotas = 1
    var count_motoristas = 1
    var count_passageiros = 1
    
    var cont_nomes = 1;
    var cont_rotas = 1;
    var data = 1;

    $('form').on('click', '.btn-add-motorista', function () 
    {
        count_motoristas++;
        var button_id = $(this).attr("id");
        $('#cadastro_motoristas').append(`
        <div class="form-inline" id="cadastro_motorista_${count_motoristas}">
            <label class="my-1 mr-2" for="cadastro_motorista_${count_motoristas}">Motorista ${count_motoristas}</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome" required>
            <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao" placeholder="Documento de habilitação" required>
            <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_orgao_emissor[]" id="motoristas_orgao_emissor" placeholder="Órgão emissor" required>
            <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD" required>
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
        $('#cadastro_rotas').append(`
            <div class="form-inline" id="cadastro_rota_${count_rotas}">
                <label class="my-1 mr-2">Rota ${count_rotas}:</label>
                <input type="date" class="form-control mb-2 mr-sm-2" name="rota_data[]" id="rota_data" placeholder="Data" required>
                <input type="text" class="form-control mb-2 mr-sm-2" name="rota_endereco_partida[]" id="rota_endereco_saida" placeholder="Saída" required>
                <input type="text" class="form-control mb-2 mr-sm-2" name="rota_endereco_destino[]" id="rota_endereco_chegada" placeholder="Chegada" required>
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
        $('#cadastro_passageiros').append(`
        <div class="form-inline" id="cadastro_passageiro_${count_passageiros}">
            <label class="my-1 mr-2">Passageiro ${count_passageiros}:</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_nome[]" id="passageiros_nome_" placeholder="Nome" required>
            <input type="date" class="form-control mb-2 mr-sm-2" name="passageiros_data_nascimento[]" id="passageiros_data_nascimento" placeholder="Data de nascimento" required> 
            <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_tipo_documento[]" id="passageiros_tipo_documento" placeholder="Tipo Documento" required>
            <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_documento[]" id="passageiros_documento" placeholder="Documento" required>
            <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_orgao_emissor[]" id="passageiros_orgao_emissor" placeholder="Órgão emissor" required>
            <button type="button" class="btn-add-passageiros btn btn-secondary" id="add_passageiros">+</button>
            <button type="button" class="btn-remove-passageiros btn btn-secondary" id="${count_passageiros}"> - </button>
        </div>
        `)
    });
    $('form').on('click', '.btn-remove-passageiros', function(){
        var button_id = $(this).attr("id");
        $('#cadastro_passageiro_'+ button_id).remove();
        count_passageiros--;
    })
 

});


function sendToInsertViagem() {
    //Receber os dados do formulário
    var dados = $("#cadastro-viagens").serialize();

    $.post("./src/database/insertViagem.php", dados, function(retorna) {
        $("#msg").slideDown('slow').html(retorna);

        //Limpar os campos
        //$('#add-Nome')[0].reset();

        //Apresentar a mensagem leve
        // retirarMsg();
    });
}

// ////////////////////////////

        




