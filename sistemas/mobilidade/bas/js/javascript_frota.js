$(function(){
	//Pesquisar os cursos sem refresh na página
	$("#pesquisa_frota").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('pesquisar_linhas_cadastrar_estras.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".resultado_frota").html(retorna);
			});
		}else{
			$(".resultado_frota").html('');
		}		
	});
});