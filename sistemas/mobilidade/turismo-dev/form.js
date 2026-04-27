$(document).ready(function () {

    $("input.cpf").mask("999.999.999-99", {
        reverse: true
    });

    $("input.rg").mask("999999999", {
        reverse: true
    });
    $("input.cnpj").mask("22.222.222/2222-22", {
        reverse: true
    });
    $("input.cep").mask("99999-999", {
        reverse: true
    });
    $("input.telefone").mask("99-9999999999", {
        reverse: true
    });

});


function validarContratantes() {

  //   somente aceita se tiver id unico mesmo que esteja algum invisivel .none
         var contratantes_nome = testform.contratantes_nome.value;
         var contratantes_logradouro = testform.contratantes_logradouro.value;
         var contratantes_bairro = testform.contratantes_bairro.value;
         var contratantes_cidade = testform.contratantes_cidade.value;
         var contratantes_estado = testform.contratantes_estado.value;
         var contratantes_pais = testform.contratantes_pais.value;
         var contratantes_documento = testform.contratantes_documento.value;
         var contratantes_email = testform.contratantes_email.value;
         var contratantes_email_rep = testform.contratantes_email_rep.value;
         var contratantes_telefone_ddi = testform.contratantes_ddi.value;
         var contratantes_telefone_ddd = testform.contratantes_ddd.value;
         var contratantes_telefone_numero = testform.contratantes_numero.value;


         if (contratantes_nome == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Nome</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_nome.focus();
            return false;
         }
         if (contratantes_logradouro == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Logradouro</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_logradouro.focus();
             return false;
         }
         if (contratantes_bairro == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Bairro</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_bairro.focus();
             return false;
         }
         if (contratantes_cidade == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Cidade</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_cidade.focus();
             return false;
         }
         if (contratantes_estado == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Estado</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_estado.focus();
             return false;
         }
         if (contratantes_pais == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Escolha o <strong>Pais</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_pais.focus();
             return false;
         }
         if (contratantes_documento == "") {
             $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Documentos</strong></div>');
             show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
             testform.contratantes_documento.focus();
             return false;
         }

         if (contratantes_email == "" || contratantes_email.indexOf('@') == -1 || contratantes_email.indexOf('.') == -1) {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>E-mail</strong></div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_email.focus();
            return false;
        }

        if (contratantes_email_rep == "" || contratantes_email_rep.indexOf('@') == -1 || contratantes_email_rep.indexOf('.') == -1) {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Confirmar o <strong>E-mail</strong></div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_email_rep.focus();
            return false;
        }

        if (contratantes_email != contratantes_email_rep) {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Os <strong>E-mails</strong> devem ser iguais E-mail</div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_email.focus();
            return false;
        }    

        if (contratantes_telefone_ddi == "") {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>DDI</strong></div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_ddi.focus();
            return false;
        }   

        if (contratantes_telefone_ddd == "") {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>DDD</strong></div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_ddd.focus();
            return false;
        }   

        if (contratantes_telefone_numero == "") {
            $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Numero</strong></div>');
            show('cadastro_contratantes_show','button_Mudarestado_cadastro_contratantes');
            testform.contratantes_numero.focus();
            return false;
        }   

 };

function validarViagem() {

    //   somente aceita se tiver id unico mesmo que esteja algum invisivel .none

    var data_chegada = testform.data_chegada.value;
    var data_saida = testform.data_saida.value;
    var logradouro_origem = testform.logradouro_origem.value;
    var bairro_origem = testform.bairro_origem.value;
    var cidade_origem = testform.cidade_origem.value;
    var cidade_estado_origem = testform.estado_origem.value;
    var pais_origem = testform.pais_origem.value;
    var demais_referencias = testform.demais_referencias.value;

    if (data_chegada == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar a <strong>data de chegada</strong> em Florianópolis</div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.data_chegada.focus();
        return false;
    }

    if (data_saida == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar a <strong>data de saída</strong> de Florianópolis</div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.data_saida.focus();
        return false;
    }

    if (logradouro_origem == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>Logradouro</strong> de origem </div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.logradouro_origem.focus();
        return false;
    }

    if (bairro_origem == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>bairro</strong> de origem </div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.bairro_origem.focus();
        return false;
    }

    if (cidade_origem == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>cidade</strong> de origem </div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.cidade_origem.focus();
        return false;
    }

    if (cidade_estado_origem == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>estado</strong> de origem </div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.estado_origem.focus();
        return false;
    }

    if (pais_origem == "") {
        $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>país</strong> de origem </div>');
        show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
        testform.pais_origem.focus();
        return false;
    }

};

function validarVeiculo() {

    //   somente aceita se tiver id unico mesmo que esteja algum invisivel .none

    var modelo_veiculo = testform.modelo_veiculo.value;
    var placa_veiculo = testform.placa_veiculo.value;
    var tipo_veiculo = testform.tipo_veiculo.value;


    if (modelo_veiculo == "") {
        $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Informe o <strong>modelo</strong> do veículo</div>');
        show('cadastro_veiculo_show', 'button_Mudarestado_cadastro_veiculo');
        testform.modelo_veiculo.focus();
        return false;
    }
    if (placa_veiculo == "") {
        $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Informe a <strong>placa</strong> do veículo</div>');
        show('cadastro_veiculo_show', 'button_Mudarestado_cadastro_veiculo');
        testform.placa_veiculo.focus();
        return false;
    }
    if (tipo_veiculo == "") {
        $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Informe o <strong>tipo</strong> do veículo</div>');
        show('cadastro_veiculo_show', 'button_Mudarestado_cadastro_veiculo');
        testform.tipo_veiculo.focus();
        return false;
    }


};

function validarMotoristas() {
    var rv = true; // <=== Default return value

    $("#msg-error-cadastro_motoristas").html('<div class="alert alert-danger" role="alert"></div>');


    $('.verificar_motoristas').each(function () {
        if (this.value == '') {
            $(this).css('border', '1px solid red');
            $("#msg-error-cadastro_motoristas").html('<div class="alert alert-danger" role="alert">Preencher todos os campos</div>');
            show('cadastro_motoristas_show', 'button_Mudarestado_cadastro_motoristas');
            this.focus();
            return rv = false; // <
        };
        if (this.value != '') {
            $(this).css('border', '1px solid');
            $("#msg-error-cadastro_motoristas").html('<div class="alert alert-danger" role="alert">Ok!</div>');
            return rv = true; // <
        };

        if (!rv) {
            return false
        }
    })
}

function validarRotas() {
    var rv = true; // <=== Default return value

    $("#msg-error-cadastro_rotas").html('<div class="alert alert-danger" role="alert"></div>');


    $('.verificar_rotas').each(function () {
        if (this.value == '') {
            $(this).css('border', '1px solid red');
            $("#msg-error-cadastro_rotas").html('<div class="alert alert-danger" role="alert">Preencher todos os campos</div>');
            show('cadastro_rotas_show', 'button_Mudarestado_cadastro_rotas');
            this.focus();
            return rv = false; // <
        };
        if (this.value != '') {
            $(this).css('border', '1px solid');
            $("#msg-error-cadastro_rotas").html('<div class="alert alert-danger" role="alert">Ok!</div>');
            return rv = true; // <
        };

        if (!rv) {
            return false
        }
    })
}

function validarPassageiros() {
    var rv = true; // <=== Default return value

    $("#msg-error-cadastro_passageiros").html('<div class="alert alert-danger" role="alert"></div>');


    $('.verificar_passageiros').each(function () {
        if (this.value == '') {
            $(this).css('border', '1px solid red');
            $("#msg-error-cadastro_passageiros").html('<div class="alert alert-danger" role="alert">Preencher todos os campos</div>');
            show('cadastro_passageiros_show', 'button_Mudarestado_cadastro_passageiros');
            this.focus();
            return rv = false; // <
        };
        if (this.value != '') {
            $(this).css('border', '1px solid');
            $("#msg-error-cadastro_passageiros").html('<div class="alert alert-danger" role="alert">Ok!</div>');
            return rv = true; // <
        };

        if (!rv) {
            return false
        }
    })
}

