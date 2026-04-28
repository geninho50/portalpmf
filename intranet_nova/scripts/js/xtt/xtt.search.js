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
