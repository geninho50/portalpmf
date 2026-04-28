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
