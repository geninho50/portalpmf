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
