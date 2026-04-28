$(document).ready(function() {
    var count_rotas = 1
    var count_motoristas = 1
    count_passageiros = 1

    $('form').on('click', '.btn-add-motorista', function () 
    {
        count_motoristas++;
        var button_id = $(this).attr("id");
        $('.motoristas-local-scope').append(`
        <div class="input-block grid" id="cadastro_motorista_${count_motoristas}">
        <br><hr><br>       
            <div class="input-block grid grid-tree" >
                <div class="input-block">
                    <label for="cadastro_motorista">Motorista</label>
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
                <button type="button" class="btn-remove-motorista" id="${count_motoristas}">Remover</button>
            </div>  
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
        $('.rotas-local-scope').append(`
       
        <div class="grid" id="cadastro_rota_${count_rotas}">
        <br><hr><br>
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
            <button class="btn-remove-rotas" id="${count_rotas}">Remover</button>                               
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
        $('.passageiros-local-scope').append(`
        <div class="input-block grid" id="cadastro_passageiro_${count_passageiros}">
        <br><hr><br>
            <div class="grid ">
                <div class="grid grid-tree-passageiros">
                    <div class="input-block">
                        <label for="cadastro_passageiro_cadastro_passageiro_">Passageiro</label>
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
                        <small id="operador_nome_helpId" class="form-text text-muted">Digite o nome ou razão social do operador</small>
                        <small id="orgao${count_passageiros}" class="small-message form-text text-muted"></small>
                                       
                        </div>
                </div>
            </div>
            <button class="btn-remove-passageiros" id="${count_passageiros}">Remover</button>  
        </div>



           
        `)
    });
    $('form').on('click', '.btn-remove-passageiros', function(){
        var button_id = $(this).attr("id");
        $('#cadastro_passageiro_'+ button_id).remove();
        count_passageiros--;
    })

})

