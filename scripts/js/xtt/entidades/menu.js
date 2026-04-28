(function(){
  "use strict";
  var path = window.location.search;
  if(path.indexOf("submenuid=")){
    var idSubmenu = path.split("submenuid=")[1];
    $("#nav-" + idSubmenu).addClass("open");
  }
})();
