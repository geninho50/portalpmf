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

    $("input.telefone").mask("9999999999", {
        reverse: true
    });

    $("input.telefoneddi").mask("+99", {
        reverse: true
    });

    $("input.telefoneddd").mask("999", {
        reverse: true
    });


});