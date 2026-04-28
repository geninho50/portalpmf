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

(function(){
  "use strict";
  var path = window.location.search;
  if(path.indexOf("submenuid=")){
    var idSubmenu = path.split("submenuid=")[1];
    $("#nav-" + idSubmenu).addClass("open");
  }
})();
