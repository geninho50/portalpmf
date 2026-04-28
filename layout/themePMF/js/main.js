(function(){
  "use strict";
  $(".back-to").click(function(e){
    e.preventDefault();
    if(history.length > 1) {
      window.history.back();
    } else {
      location.href = "/servicos/index.php";
    }
  });
})();

(function(){
  "use strict";
  var $containerCards = $(".quick-access-services");
  $(".js-next-service").on("click", function(e) {
    e.preventDefault();
    var $toRemoveClass = $(".quick-access-services").children(".active");
    if($containerCards.find(".active").next(":not(.active)").length > 0){
      $(".quick-access-services").children(".active").nextAll(":not(.active):lt(2)").addClass("active");
    }else{
      $containerCards.children(":lt(2)").addClass("active");
    }
    $toRemoveClass.removeClass("active");
  });
})();

(function(){
  "use strict";
  var isMobile = $(window).width() <= 768;
	var $menuItem = $('li.has-submenu > a');
	var $menuItemSecondTier = $('.has-second-tier');
	var $backButton = $('.header__submenu-back');

	$menuItemSecondTier.click(function(e) {
		e.preventDefault();
		$(this).siblings('a').removeClass('active');
		$(this).addClass('active');

		var target = $(this).data('target');
		$(this).parent().siblings('.header__submenu-tier-2').addClass('closed').removeClass('open');
		$('div[data-parent='+target+']').addClass('open').removeClass('closed');
	});

	if(!isMobile) {
		$menuItem.parent('li').mouseover(function() {
			$(this).addClass('open');
		});
		$menuItem.parent('li').mouseout(function() {
			$(this).removeClass('open');
		});
	} else {
		$menuItem.click(function(e) {
			e.preventDefault();
			$(this).parent().toggleClass('open');
		});
		$menuItemSecondTier.click(function(e) {
			e.preventDefault();
			$(this).parent('.header__submenu-tier-1').removeClass('open').addClass('closed');
		});
		$backButton.click(function(e) {
			e.preventDefault();
			$(this).parent('.header__submenu-tier-2').removeClass('open').addClass('closed');
			$(this).parent().siblings('.header__submenu-tier-1').removeClass('closed').addClass('open');
		});

		$('.header__mobile-nav').click(function(e) {
			e.preventDefault();
			$('.header__nav').addClass('open');
			$('body').addClass('nav-open');
		});
		$('.header__nav-close').click(function(e) {
			e.preventDefault();
			$('.header__nav').removeClass('open');
			$('body').removeClass('nav-open');
		});
	}

})();

(function() {
  "use strict";
	if($("#autocomplete").length > 0) {
    $("#autocomplete").autocomplete({
      source: '/layout/themePMF/includes/buscaServicos.php',
      appendTo: ".search-bar__auto-complete",
      select: function( event, ui ) {
        window.location.href ='/servicos/index.php?pagina=servpagina&id='+ui.item.id;
        return false;
      }
    });
  }
})();

(function() {
  "use strict";

    $('.page-navigation .has-submenu').click(function(e) {

    	e.preventDefault();
    	var target = $(this).data('target');
    	$('#'+target).addClass('open');

    });

    $('.has-third-level > a').click(function(e) {
        e.preventDefault();
        $(this).next('ul').toggleClass('open');
    });

    $('.page-navigation__back-button').click(function(e) {

    	e.preventDefault();
    	$(this).parent('.page-navigation__sub-nav').removeClass('open');

    });

})();
