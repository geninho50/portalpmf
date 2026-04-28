(function(){
  "use strict";

  $(".tabs .category-tab").on("click", function(){
    if(!$(this).hasClass("active")){
      $(".category-tab").toggleClass("active");
      $(".category-list").children("[class*=category-]").toggleClass("active")
      .filter(".active").children(".active").removeClass("active")
      .parent().children(":lt(3)").addClass("active");
    }
  });

  $(".category-list .slider-button-right a").on("click", function(e){
    e.preventDefault();
    var $conteinerActivated = $(".category-list").children(".active");
    var $toRemoveClass = $conteinerActivated.children(".active");

    if($conteinerActivated.children(".active").next(":not(.active)").length > 0){
      $conteinerActivated.children(".active").nextAll(":not(.active):lt(3)").addClass("active");
    }else{
      $conteinerActivated.children(":lt(3)").addClass("active");
    }
    $toRemoveClass.removeClass("active");
  });
})();

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

Inputmask({mask: ['999.999.999-99', '99.999.999/9999-99'], keepStatic: true, disablePredictiveText:true, showMaskOnHover:false, showMaskOnFocus: false}).mask($inputCpfCnpj);
Inputmask({mask: ['999999/9999'], showMaskOnHover:false, disablePredictiveText:true, showMaskOnFocus: false}).mask($inputNmrProcesso);

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

(function(){
  "use strict";
  $(".js-xtt-changerow-service-description").change(function(){
    $(".xtt-hide-js").hide();
    var $opt = $(this).children("option:selected").val();
    $(".js-xtt-changerow-service-description").val($opt);
    if($opt === "descricao"){
      $("#descricao").show();
      scrollToItem("#descricao");
    }else if($opt === "comoSolicitar"){
      $("#comoSolicitar").show();
      scrollToItem("#comoSolicitar");
    } else if($opt === "requisitos"){
      $("#requisitos").show().scroll();
      scrollToItem("#requisitos");
    } else if($opt === "downloads"){
      $("#downloads").show().scroll();
      scrollToItem("#downloads");
    } else if($opt === "ondeEncontrar"){
      $("#ondeEncontrar").show().scroll();
      scrollToItem("#ondeEncontrar");
    }
  });

  function scrollToItem($item){
    var etop = $($item).offset().top;
  	$('html, body').animate({
  	  scrollTop: etop
  	}, 1000);
  }

  $(".anchor .category-tab").on("click", function(){
    $(".anchor .category-tab").removeClass("active");
    $(this).toggleClass("active");
  });
})();

(function ($) {
	'use strict';
	$(document).ready(function(){
	  $('.pmf-highlights-slider').slick({
	  	dots: true,
	  	infinite: true,
	  	slidesToShow: 1,
	  	slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 4500
	  });
	});
})(jQuery);
