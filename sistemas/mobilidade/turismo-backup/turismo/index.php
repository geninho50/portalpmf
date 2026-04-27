<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastro de viagens</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&display=swap" rel="stylesheet">
    <!-- own CSS -->
    <link rel="stylesheet" href="./public/styles/main.css">
    <script src="./public/scripts/addField.js"></script>

</head>

<body>
    <div class="container">
        <h1>Cadastro de Viagens</h1>

        <!-- <form id="cadastro-viagens" action="./src/database/insertViagem.php" method="POST"> -->
        <form id="cadastro-viagens" method="POST">
           

        <span id="msg"></span>
            <fieldset class="form-group" id="formulario_contratantes">
                <legend>Dados do Contratante</legend>
                        <!-- michel - msg formulario -->

                <div class="form-group">
                    <label for="contratantes_nome">Nome</label>
                    <input type="text" class="form-control contratantes_nome" name="contratantes_nome" id="contratantes_nome" placeholder="Nome do contratante" >
                </div>
                <div class="form-group">
                    <label for="contratantes_logradouro">Logradouro</label>
                    <input type="text" class="form-control contratantes_logradouro" name="contratantes_logradouro" id="contratantes_logradouro" placeholder="Logradouro" >
                </div>
                <div class="form-group">
                    <label for="contratantes_bairro">Bairro</label>
                    <input type="text" class="form-control contratantes_bairro" name="contratantes_bairro" id="contratantes_bairro" placeholder="Bairro" >
                </div>
                <div class="form-group">
                    <label for="contratantes_cidade">Cidade</label>
                    <input type="text" class="form-control contratantes_cidade" name="contratantes_cidade" id="contratantes_cidade" placeholder="Cidade" >
                </div>
                <div class="form-group">
                    <label for="contratantes_estado">Estado</label>
                    <input type="text" class="form-control contratantes_estado" name="contratantes_estado" id="contratantes_estado" placeholder="Estado" >
                </div>
                <div class="form-group">
                    <label for="contratantes_pais">País</label>
                    <input type="text" class="form-control contratantes_pais" name="contratantes_pais" id="contratantes_pais" placeholder="País" >
                </div>
                <div class="form-group">
                    <label for="contratantes_tipo_documento">Tipo de documento</label>
                    <select class="form-control" name="contratantes_tipo_documento" id="contratantes_tipo_documento" >
                        <option disabled selected value>Selecione uma opção</option>
                        <option value="RG">RG</option>
                        <option value="CPF">CPF</option>
                        <option value="CNH">CNH</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contratantes_documento">Número do documento</label>
                    <input type="text" class="form-control" name="contratantes_documento" id="contratantes_documento" placeholder="Número do documento" >
                </div>
                <div class="form-group">
                    <label for="contratantes_email">E-mail</label>
                    <input type="email" class="form-control" name="contratantes_email" id="contratantes_email" placeholder="E-mail" >
                </div>
                <div class="form-group">
                    <label for="contratantes_telefone_com_ddd">Telefone</label>
                    <input type="text" class="form-control" name="contratantes_telefone_com_ddd" id="contratantes_telefone_com_ddd" placeholder="Telefone com DDD" >
                </div>
            </fieldset>

            <hr>

            <fieldset class="form-group" id="informacoes_viagem">
                <legend>Informações Sobre a Viagem</legend>
                <div class="form-group">
                    <label for="data_chegada">Data de Chegada</label>
                    <input type="date" class="form-control" name="data_chegada" id="data_chegada" placeholder="Chegada" >
                </div>
                <div class="form-group">
                    <label for="data_saida">Data de Retorno</label>
                    <input type="date" class="form-control" name="data_saida" id="data_saida" placeholder="Saída" >
                </div>
                <div class="form-group">
                    <label for="logradouro_origem">Logradouro de origem</label>
                    <input type="text" class="form-control" name="logradouro_origem" id="logradouro_origem" placeholder="Logradouro de origem" >
                </div>
                <div class="form-group">
                    <label for="bairro_origem">Bairro de origem</label>
                    <input type="text" class="form-control" name="bairro_origem" id="bairro_origem" placeholder="Bairro" >
                </div>
                <div class="form-group">
                    <label for="cidade_origem">Cidade de origem</label>
                    <input type="text" class="form-control" name="cidade_origem" id="cidade_origem" placeholder="Cidade" >
                </div>
                <div class="form-group">
                    <label for="estado_origem">Estado de origem</label>
                    <input type="text" class="form-control" name="estado_origem" id="estado_origem" placeholder="Estado" >
                </div>
                <div class="form-group">
                    <label for="pais_origem">País de origem</label>
                    <input type="text" class="form-control" name="pais_origem" id="pais_origem" placeholder="País de origem" >
                </div>
                <div class="form-group">
                    <label for="demais_referencias">Demais referências</label>
                    <input type="text" class="form-control" name="demais_referencias" id="demais_referencias" placeholder="Demais referências" >
                </div>
            </fieldset>

            <hr>

            <fieldset class="form-group" id="cadastro_veiculo">
                <legend>Cadastro do Veículo</legend>
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" name="modelo_veiculo" id="modelo_veiculo" placeholder="Modelo" >
                </div>
                <div class="form-group">
                    <label for="placa">Placa</label>
                    <input type="text" class="form-control" name="placa_veiculo" id="placa_veiculo" placeholder="Placa" >
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" name="tipo_veiculo" id="tipo_veiculo" >
                        <label for="tipo">Tipo</label>
                        <option disabled selected value>Selecione um tipo</option>
                        <option value="Ônibus">Ônibus</option>
                        <option value="Micro-ônibus">Micro-ônibus</option>
                        <option value="Van">Van</option>
                    </select>   
                </div>
            </fieldset>

            <hr>
            
            <fieldset class="form-inline" id="cadastro_motoristas">
                <legend>Cadastro de Motoristas</legend>
                <div class="form-inline" id="cadastro_motorista_1">
                    <label class="my-1 mr-2" for="cadastro_motorista_1">Motorista 1</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_nome[]" id="motoristas_nome" placeholder="Nome" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_documento_habilitacao[]" id="motoristas_documento_habilitacao" placeholder="Documento de habilitação" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_orgao_emissor[]" id="motoristas_orgao_emissor" placeholder="Órgão emissor" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="motoristas_telefone_ddd[]" id="motoristas_telefone_ddd" placeholder="Telefone com DDD" >
                    <button type="button" class="btn-add-motorista btn btn-secondary"  id="add_morotistas">+</button>
                </div>
            </fieldset>  
           
            <hr>
            <fieldset class="form-inline" id="cadastro_rotas">
                <legend>Cadastro de Trajetos</legend>
                <div class="form-inline" id="cadastro_rota_1">
                    <label class="my-1 mr-2">Rota 1:</label>
                    <input type="date" class="form-control mb-2 mr-sm-2" name="rota_data[]" id="rota_data" placeholder="Data" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="rota_endereco_partida[]" id="rota_endereco_saida" placeholder="Saída" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="rota_endereco_destino[]" id="rota_endereco_chegada" placeholder="Chegada" >
                    <button type="button" class="btn-add-rotas btn btn-secondary" id="add_rotas">+</button>
                </div>
            </fieldset>

             <hr>

            <fieldset class="form-inline" id="cadastro_passageiros">
                <legend>Lista de Passageiros</legend>
                <div class="form-inline" id="cadastro_passageiro_1">
                    <label class="my-1 mr-2">Passageiro 1:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_nome[]" id="passageiros_nome" placeholder="Nome" >
                    <input type="date" class="form-control mb-2 mr-sm-2" name="passageiros_data_nascimento[]" id="passageiros_data_nascimento" placeholder="Data de nascimento" > 
                    <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_tipo_documento[]" id="passageiros_tipo_documento" placeholder="Tipo Documento" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_documento[]" id="passageiros_documento" placeholder="Documento" >
                    <input type="text" class="form-control mb-2 mr-sm-2" name="passageiros_orgao_emissor[]" id="passageiros_orgao_emissor" placeholder="Órgão emissor" >
                    <button type="button" class="btn-add-passageiros btn btn-secondary" id="add_passageiros">+</button>
                </div>
            </fieldset>



            <div class="form-group">
                <input 
                type="button"
                              onclick="sendToInsertViagem()"
                value="Cadastrar">
            </div>
        </form>

    </div>



</body>

</html>