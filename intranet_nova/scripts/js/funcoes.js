tinyMCE.init({
	language : "pt",		 
    mode : "textareas",
    theme : "advanced",
	theme_advanced_disable : "styleselect,hr,sub,sup,removeformat,visualaid,justifyright,justifyfull,justifyleft,justifycenter",
	plugins : "fullscreen,paste,table",
	
	theme_advanced_buttons1_add : "pastetext,pasteword,link,unlink,selectall",
	paste_auto_cleanup_on_paste : true,
	paste_create_paragraphs : false,
	paste_create_linebreaks : true,
	paste_use_dialog : true,
	paste_remove_spans : true,
	paste_remove_styles : true,
    theme_advanced_buttons2 : "tablecontrols",
   	theme_advanced_buttons3 : "fullscreen,charmap,bullist,numlist",

	theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
	fullscreen_new_window : true,
	
	fullscreen_settings : {
		theme_advanced_path_location : "top"
	}

    
});

