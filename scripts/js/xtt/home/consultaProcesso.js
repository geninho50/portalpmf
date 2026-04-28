var URL_COMPLEMENTO = "/v1/consultas/processo/ano/";
var RECAPTCHA = "";
var $formConsulta = $("#xtt-consulta-processo");
var $inputNmrProcesso = $("#xtt-processo-ano");
var $inputCpfCnpj = $("#xtt-cpf-cnpj");

function formataNumeroProcesso(numero){
  var zerosProcesso = '000000';
  return numero.length > 0 ?
    (zerosProcesso + numero).substr(-zerosProcesso.length) : '';
}

function formataAnoProcesso(ano){
  var zerosAno = '000';
  if (ano.length > 0) {
    if (ano.length < 4) {
      return '2' + (zerosAno + ano).substr(-zerosAno.length);
    } else {
      return ano;
    }
  }
  return '';
}

Inputmask({mask: ['999.999.999-99', '99.999.999/9999-99'], keepStatic: true, showMaskOnHover:false, showMaskOnFocus: false}).mask($inputCpfCnpj);
Inputmask({mask: ['999999/9999'], showMaskOnHover:false, showMaskOnFocus: false}).mask($inputNmrProcesso);

$inputNmrProcesso.keyup(function(e){
  var value = $inputNmrProcesso[0].inputmask.unmaskedvalue();
  if ((e.key === '/') && (value.length < 6)) {
    var inputValue = formataNumeroProcesso(value);
    $(this).val("");
    $(this).val(inputValue);
  }
});
$inputNmrProcesso.focusout(function(){
  var value = $inputNmrProcesso[0].inputmask.unmaskedvalue();
  var processo = value.substring(0, 6);
  if ((value.length > 0)) {
    if(processo.length < 6){
      processo = formataNumeroProcesso(processo);
    }
    var ano = value.length > 6 ? formataAnoProcesso(value.substring(6,10)) : new Date().getFullYear();
    $(this).val("");
    $(this).val(processo + ano);
  }
  validateSubmit();
});

function recaptchaInserted(e){
  RECAPTCHA = e;
  validateSubmit();
}
function validateSubmit(){
  if($inputNmrProcesso[0].inputmask.unmaskedvalue().length == 10 && ($inputCpfCnpj[0].inputmask.unmaskedvalue().length == 11 || $inputCpfCnpj[0].inputmask.unmaskedvalue().length == 14) && RECAPTCHA.length > 0){
    $(".xtt-btn-submit").removeAttr("disabled");
  } else {
    $(".xtt-btn-submit").attr("disabled", "disabled");
  }
}
$inputCpfCnpj.live("focusout", validateSubmit);
$(".xtt-btn-submit").click(function(){
  var processo = $inputNmrProcesso.val().split("/");
  var url = $formConsulta.attr("action") + URL_COMPLEMENTO + processo[1] + "/numero/" + processo[0] + "/requerente/" + $inputCpfCnpj.val().replace(/\.|-|\//g, "");
  $("#consultaProcessoDefault").toggle();
  $("#consultaProcessoLoading").toggle();
  $.ajax({
    type: "POST",
    url: url,
    async : false,
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Accept", "application/json;charset=UTF-8");
        xhr.setRequestHeader("g-recaptcha-response", RECAPTCHA);
    },
    complete: function(response){
      if(response.status === 200) {
          location.href = response.responseText;
      } else {
        var errorMsgm = "Ocorreu um erro ao conectar com o servidor, tente novamente mais tarde.";
        $("#xtt-consulta-processo-error").html(errorMsgm);
        $("#consultaProcessoDefault").toggle();
        $("#consultaProcessoLoading").toggle();
      }
    }
  });
});
