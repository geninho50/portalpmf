
function validarViagem() {
   
var data_atual= testform.data_atual.value;
var data_chegada = testform.data_chegada.value;
var data_saida = testform.data_saida.value;
var cidade_origem = testform.cidade_origem.value;
var cidade_estado_origem = testform.estado_origem.value;
var pais_origem = testform.pais_origem.value;
var demais_referencias = testform.demais_referencias.value;

const date1_atual = new Date(data_atual);
const date2_chegada = new Date(data_chegada + " 00:00:00");
const date3_saida = new Date(data_saida + " 00:00:00");

if (data_chegada == "") {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar a <strong>data de chegada</strong> em Florianópolis</div>');
    //show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
    testform.data_chegada.focus();
    return false;
}

if (date1_atual.getTime() > date2_chegada.getTime()) {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Data invalida. Não é possível data anterior a hoje!</div>');
    testform.data_chegada.focus();
    return false;
}

if (data_saida == "") {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar a <strong>data de saída</strong> de Florianópolis</div>');
    //show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
    testform.data_saida.focus();
    return false;
}

if (date3_saida.getTime() < date2_chegada.getTime()) {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Data invalida. A data de retorno não pode ser anterior a chegada!</div>');
    testform.data_saida.focus();
    return false;
}

if (pais_origem == "") {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>país</strong> de origem </div>');
   // show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
    testform.pais_origem.focus();
    return false;
}

if (cidade_estado_origem == "") {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>estado</strong> de origem </div>');
   // show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
    testform.estado_origem.focus();
    return false;
}

if (cidade_origem == "") {
    $("#msg-error-informacoes_viagem").html('<div class="alert alert-danger" role="alert">Informar o <strong>cidade</strong> de origem </div>');
   // show('informacoes_viagem_show', 'button_Mudarestado_informacoes_viagem');
    testform.cidade_origem.focus();
    return false;
}

//  teste de veiculo

var placa_veiculo = testform.placa_veiculo.value;
var tipo_veiculo = testform.tipo_veiculo.value;

if (tipo_veiculo == "") {
    $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Informe o <strong>tipo</strong> do veículo</div>');
    //show('cadastro_veiculo_show', 'button_Mudarestado_cadastro_veiculo');
    testform.tipo_veiculo.focus();
    return false;
}

if (placa_veiculo == "") {
    $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Informe a <strong>placa</strong> do veículo</div>');
    //show('cadastro_veiculo_show', 'button_Mudarestado_cadastro_veiculo');
    testform.placa_veiculo.focus();
    return false;
}

};

function validarMotoristas(rv) {

var rv = true; 

$('.verificar_motoristas').each(function (rv) {
    if (this.value == '') {
        $(this).css('border', '1px solid blue');
        //$("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Preencher todos os campos</div>');
       // show('cadastro_motoristas_show', 'button_Mudarestado_cadastro_motoristas');
        this.focus();
        return rv = false;
    };

    if (this.value != '') {
        $(this).css('border', '1px solid blue');
      //  $("#msg-error-cadastro_veiculo").html('<div class="alert alert-danger" role="alert">Ok!</div>');
        return rv = true; // <
    };
   
    if (!rv) {
        return false
    }

})
}

function validarRotas(rv) {
var rv = true; // <=== Default return value

$('.verificar_rotas').each(function (rv) {
    if (this.value == '') {
        $(this).css('border', '1px solid red');
     //   $("#msg-error-cadastro_rotas").html('<div class="alert alert-danger" role="alert">Preencher todos os campos</div>');
   //     show('cadastro_rotas_show', 'button_Mudarestado_cadastro_rotas');
        this.focus();
        return rv = false; // <
    };
    if (this.value != '') {
        $(this).css('border', '1px solid');
  //      $("#msg-error-cadastro_rotas").html('<div class="alert alert-danger" role="alert">Ok!</div>');
        return rv = true; // <
    };

    if (!rv) {
        return false
    }
})
}


