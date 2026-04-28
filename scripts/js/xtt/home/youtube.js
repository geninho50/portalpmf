var $modal = $("#youtube-modal");
var $closeModal = $modal.find(".close");
var $youtubeComponentDiv = $("#youtube");

var API_KEY = "AIzaSyBBe1_WdDzkncDXCIKKqEDxxN4g7MzehSg";
var PLAYLIST_ID = "PLtMqi7ZE12w47_sSQyGFdKg-mP_H0JRTK";
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
      console.log(eachVideo);
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
  button.href = "https://www.youtube.com/playlist?list=PLtMqi7ZE12w47_sSQyGFdKg-mP_H0JRTK";
  button.text = "Ver mais vídeos";
  button.target = "_blank";
  card.appendChild(button);
  $youtubeComponentDiv.append(card);
}

loadScript("https://www.youtube.com/iframe_api",function(){
  youTubeIframeAPIReady();
});
