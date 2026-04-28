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
