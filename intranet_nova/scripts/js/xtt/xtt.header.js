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
