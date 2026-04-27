/* Teste jQuery */

jQuery.noConflict();
		
/* Auto Complete CNAE Inicio */

jQuery( function() {
	
  jQuery("#edCnaeSubclasse").focus(function() {
    var availableTags = [];
    var denom = [];
    ajaxMethod("CnaeRemote", "buscarInformacoesAutoComplete", 
		{competencia : document.getElementById("dataEmissao").value}, 
		function(json) {
			for(var i = 0; i < json.length; i++) {
				availableTags[i] = json[i].informacao + " | " + json[i].denominacao;
				denom[i] = json[i].denominacao;
			}
		}
	);

	jQuery( "#edCnaeSubclasse" ).autocomplete({
			source: availableTags,
	 		minLength: 5,
	 		select: function(event, ui) {
	 					var str = ui.item.value
	 					ajaxMethod("CnaeRemote", "buscarInformacoesAutoComplete", 
						{competencia : document.getElementById("dataEmissao").value}, 
						function(json) {
							for(var i = 0; i < json.length; i++) {
								if(availableTags[i] == str) {
									document.getElementById("edCnaeDescricao").value = denom[i];
									var res = [];
									res = str.split(" | ");
									document.getElementById("edCnaeSubclasse").value = res[0] + " | " + res[1];
									break;
								}
							}
						}
					)
	 				}
	 		});
 	});
 	
 	jQuery("#edCnaeSubclasse").keypress(function() {
	 	if(document.getElementById('edCnaeSubclasse').value.length <= 5) {
 			document.getElementById("edCnaeDescricao").value = "";
 		}
	});
	 	
	jQuery("#edCnaeSubclasse").mousemove(function() {
	 	if(document.getElementById('edCnaeSubclasse').value.length <= 5) {
 			document.getElementById("edCnaeDescricao").value = "";
 		}
	});
	} );


/* Auto Complete CNAE Fim */	    

/* Auto Complete CFPS Inicio */

jQuery( function() {
	ajaxMethod( "CfpsRemote", "buscarInformacoesAutoCompleteDES_SP", 
	{competencia : document.getElementById("dataEmissao").value},
	function(json) {
		$("edCfps").innerHTML = json.optionsCfps;
	}
);

jQuery.widget( "custom.combobox", {
_create: function() {
this.wrapper = jQuery( "<span style='width:100%; white-space:nowrap'>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );

this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},

_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";

this.input = jQuery( "<input id=\"inputCfps\" onClick=\"selecionaTexto(this);\" onChange=\"processaGrade();\" onBlur=\"processaGrade();\" style=\"width:98.4%;\" >" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.autocomplete({
delay: 0,
minLength: 0,
source: jQuery.proxy( this, "_source" )
})
.tooltip({
classes: {
  "ui-tooltip": "ui-state-highlight"
}
});

this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
  item: ui.item.option
});
},

autocompletechange: "_removeIfInvalid"
});
},

_createShowAllButton: function() {
var input = this.input,
wasOpen = false;

jQuery( "<a style='border: 1px solid #524D5F;padding-top: 1px;padding-bottom: 1px;margin-left: -1px;'>" )
.attr( "tabIndex", -1 )
.attr( "title", "Exibir todos os itens" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
  primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.removeClass( "ui-button")
.removeClass( "ui-widget" )
.removeClass( "ui-button-icon-only" )
.on( "mousedown", function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.on( "click", function() {
input.trigger( "focus" );

// Close if already visible
if ( wasOpen ) {
  return;
}

// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},

_source: function( request, response ) {
var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = jQuery( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
  label: text,
  value: text,
  option: this
};
}) );
},

_removeIfInvalid: function( event, ui ) {

// Selected an item, nothing to do
if ( ui.item ) {
return;
}

// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( jQuery( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});

// Found a match, nothing to do
if ( valid ) {
return;
}

// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " não condiz com nenhum item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.autocomplete( "instance" ).term = "";
},

_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});

jQuery( "#edCfps" ).combobox();
} );  

/* Auto Complete CFPS Fim */

/* Auto Complete CST Inicio */


jQuery( function() {
ajaxMethod( "CstRemote", "buscarInformacoesAutoCompleteDES_SP", 
{competencia : document.getElementById("dataEmissao").value},
function(json) {
$("edCst").innerHTML = json.optionsCst;
}
); 

jQuery.widget( "custom.combobox", {
_create: function() {
this.wrapper = jQuery( "<span style='width:100%; white-space:nowrap'>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );

this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},

_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";

this.input = jQuery( "<input id=\"inputCst\" onClick=\"selecionaTexto(this);\" onChange=\"processaGrade();\" onBlur=\"processaGrade();\" style=\"width:98.4%;\">" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.autocomplete({
delay: 0,
minLength: 0,
source: jQuery.proxy( this, "_source" )
})
.tooltip({
classes: {
  "ui-tooltip": "ui-state-highlight"
}
});

this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
  item: ui.item.option
});
},

autocompletechange: "_removeIfInvalid"
});
},

_createShowAllButton: function() {
var input = this.input,
wasOpen = false;

jQuery( "<a style='border: 1px solid #524D5F;padding-top: 1px;padding-bottom: 1px;margin-left: -1px;'>" )
.attr( "tabIndex", -1 )
.attr( "title", "Exibir todos os itens" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
  primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.removeClass( "ui-button")
.removeClass( "ui-widget" )
.removeClass( "ui-button-icon-only" )
.on( "mousedown", function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.on( "click", function() {
input.trigger( "focus" );

// Close if already visible
if ( wasOpen ) {
  return;
}

// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},

_source: function( request, response ) {
var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = jQuery( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
  label: text,
  value: text,
  option: this
};
}) );
},

_removeIfInvalid: function( event, ui ) {

// Selected an item, nothing to do
if ( ui.item ) {
return;
}

// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( jQuery( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});

// Found a match, nothing to do
if ( valid ) {
return;
}

// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " não condiz com nenhum item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.autocomplete( "instance" ).term = "";
},

_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});

jQuery( "#edCst" ).combobox();
} );  
   
/* Auto Complete CST Fim */    

/* Calendario DataPicker Inicio */

	jQuery( function() {
		jQuery("#dataEmissao").datepicker("option", { readonly: true });
	jQuery("#dataEmissao").datepicker({
		dateFormat: "dd/mm/yy",
		dayNames: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado" ],
		dayNamesMin: ["Do", "Se", "Te", "Qa", "Qi", "Sx", "Sa" ],
		dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab" ],
		monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Augosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Aug", "Set", "Out", "Nov", "Dez"]
	});
	jQuery("#dataEmissao").change( function() {
		recarregaCst();
		recarregaCfps();
	});
	} );
	
/* Calendario DataPicker Fim */