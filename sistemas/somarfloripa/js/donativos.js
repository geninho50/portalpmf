function limparCampos(){
	$('#nome').val("");
	$('#email').val("");
	$('#celular').val("");
	$('#projeto').val("");
}

function salvarDoacao(){
	
   	if( $.trim(  $('#nome').val() ) == "" ){
		alert("Informe o nome!");
		$('#nome').focus();
		return false;
	}else if( $.trim( $('#email').val() ) == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
	}else if( $('#celular').val() == "" ){
			alert("Informe o celular!");
			$('#celular').focus();
			return false;
	}else if( $('#projeto').val() == ""){
			alert("Informe seu projeto");
			$('#projeto').focus();
			return false;
	}
}