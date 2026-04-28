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
