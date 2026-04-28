(function(){
  "use strict";

  $(".category-tab").on("click", function(){
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

var $modal = $("#youtube-modal");
var $closeModal = $modal.find(".close");
var $youtubeComponentDiv = $("#youtube");

var API_KEY = "AIzaSyBBe1_WdDzkncDXCIKKqEDxxN4g7MzehSg";
var PLAYLIST_ID = "PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU";
var YT_API_URL = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=5&playlistId=" + PLAYLIST_ID + "&key=" + API_KEY;

var PLAYER;

$closeModal.on("click",function(){
  $modal.removeClass("open");
  PLAYER.stopVideo();
});

function youTubeIframeAPIReady() {
  getVideosFromList();
}

function getVideosFromList(){
  $.ajax({
    url: YT_API_URL,
    method: "GET",
    success: function(response){
      extractVideoIds(response);
    }
  });
}

function extractVideoIds(response){
  var videos = response.items.map(function(eachVideo){
    return {videoId: eachVideo.snippet.resourceId.videoId, thumbnails: eachVideo.snippet.thumbnails, title: eachVideo.snippet.title};
  });
  createImagesToOpenModal(videos);
}

function openModalWithVideo(videoId){
  if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    var url = "https://www.youtube.com/watch?v=" + videoId;
    window.open(url, '_blank');
  } else {
    $modal.addClass("open");
    if(PLAYER){
      PLAYER.cueVideoById(videoId);
    }else{
      PLAYER = new YT.Player('youtube-body', {
        videoId: videoId,
        events: {
          'onReady' : function onPlayerReady(event) {
            event.target.playVideo();
          }
        }
      });
    }
  }
}

function getThumbImageURL(thumbs){
  if (thumbs.maxres) return thumbs.maxres.url;
  else if (thumbs.high) return thumbs.high.url;
  else if (thumbs.medium) return thumbs.medium.url;
  else if (thumbs.standard) return thumbs.standard.url;
  else if (thumbs.default) return thumbs.default.url;
  else return '';
}

function createImagesToOpenModal(videos){
  var card = document.createElement("div");
  card.className = "canal-pmf__list";
  videos.forEach(function(eachVideo, key){
    var imgWrapper = document.createElement("div");
    imgWrapper.className = "canal-pmf__thumb";
    imgWrapper.style.backgroundImage = "url("+getThumbImageURL(eachVideo.thumbnails)+")";
    imgWrapper.onclick = function(){
      openModalWithVideo(eachVideo.videoId);
    };
    var p = document.createElement("p");
    p.innerHTML = eachVideo.title;

    if(key === 0){
      $youtubeComponentDiv.append(imgWrapper);
      imgWrapper.appendChild(p);
    }else{
      card.appendChild(imgWrapper);
    }
  });
  var button = document.createElement("a");
  button.className = "btn-block btn-primary btn-sm";
  button.href = "https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU";
  button.text = "Ver mais vídeos";
  button.target = "_blank";
  card.appendChild(button);
  $youtubeComponentDiv.append(card);
}

loadScript("https://www.youtube.com/iframe_api",function(){
  youTubeIframeAPIReady();
});
