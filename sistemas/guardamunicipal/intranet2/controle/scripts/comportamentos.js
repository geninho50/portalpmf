/* Curso iMasters - Criando Web Sites com Ajax - 2006 */
/* Autor: Leandro Vieira Pinho [ leandroimasters@plugsites.net ] */

// Esta função instancia o objeto XMLHttpRequest
function openAjax() {
	var ajax;
	try {
		ajax = new XMLHttpRequest();
	} catch(ee) {
		try {
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(E) {
				ajax = false;
			}
		}
	}
	return ajax;
}

// Chama a função loadFunctions ao carregar a página
window.onload = loadFunctions;

// Função que chama outras funções
function loadFunctions() {
	// focusNome();
	// ativarBtnCadastro();
	// ativarBtnEditarBtnExcluir();
}

// Utilizado para evitar de digitar: document.getElementById toda hora, tornando o processo mais prático
function gE(ID) {
	return document.getElementById(ID);
}

// Utilizado para evitar de digitar: document.getElementsByTagName toda hora, tornando o processo mais prático
function gEs(tag) {
	return document.getElementsByTagName(tag);
}

// Esta função é utilizada para exibir o formulário quando o link/botão Cadastrar novo contato é clicado
function ativarBtnCadastro() {
	// Se não houver o botão/link aborta a função
	if (!gE('btnNovoCadastro')) return false;
	// Ao clicar no botão será realizada uma ação
	gE('btnNovoCadastro').onclick = function() {
		// Executa a função que cria o fundo sobre página
		exibirBgBody();
		// Cria um div - definida como boxCad - que armazenará o formulário de cadastro
		boxCad();
		// Inicia o Ajax, através da variável Ajax
		var ajax = openAjax();
		// A tag bgBody conterá o formulário de cadastro
		var recipiente = gE('boxCad');
		// Informamos o método e a página que será requisitada
		ajax.open('GET', 'formulario.php?ajax=true', true); 
		// bla
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 1) {
				// Cria o efeito de loading
				loading(true);	
			} // if->readyState->1
			if (ajax.readyState == 4) {
				if (ajax.status == 200) {
					// Remove o efeito de loading
					loading(false);
					// Pega o conteúdo - HTML - da página requisitada: formulario.php?ajax=true e coloca dentra da div definida na variável recipiente
					recipiente.innerHTML = ajax.responseText;
					// Chama a função que trabalha sobre os botões de Ok e Cancelar
					btnOkBtnCancelar();
					// Seta o focus no campo nome do cadastro
					focusNome();
				} // if-status->200
			} // if->readyState->4
		} // ajax->onreadystatechange
		// Envia a requisição
		ajax.send(null);
		// Evita o reload da página
		return false;
	}
}

// Funções que será vinculadas ao botão Ok e Cancelar do formulário
function btnOkBtnCancelar() {
	// Se não houver os botões aborta a função
	if (!gE('btnOk')) return false;
	if (!gE('btnCancelar')) return false;

	gE('btnOk').onclick = function() {
		// Valida os dados informado, a função retornará false se houver erro, e true se estiver tudo ok.
		var validacao = validarForm();
		// Verifica o retorno da função
		if (validacao == true) {
			var ajax = openAjax();
			ajax.open('POST', 'actions.php?ajax=true', true);
			ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			ajax.onreadystatechange = function() {
				if (ajax.readyState == 4) {
					if (ajax.status == 200) {
						// Atualiza o relatório com os contatos cadastrados
						atualizaRelatorio();
					} // status ->200
				} // readyState->4
			} // ajax->onreadystatechange
			// Criaremos uma variável que armazenará os dados do formulário
			// Será um cadastro ou edição?
			var tipoAcao = gE('action').value;
			// Se for cadastro ...
			if (tipoAcao == 'cadastrar') {
				var dataPost = 'action=cadastrar';
			} else if (tipoAcao == 'editar') {
				var dataPost = 'action=editar&ID=' + gE('ID').value;
			}
			dataPost += '&nome=' + gE('nome').value;
			dataPost += '&obs=' + gE('obs').value;
			dataPost += '&ddd=' + gE('ddd').value;
			dataPost += '&tel=' + gE('tel').value;
			dataPost += '&cel=' + gE('cel').value;
			dataPost += '&email=' + gE('email').value;
			dataPost += '&blog=' + gE('blog').value;
			dataPost += '&msn=' + gE('msn').value;
			dataPost += '&gtalk=' + gE('gtalk').value;
			dataPost += '&skype=' + gE('skype').value;
			alert(dataPost);
			ajax.send(dataPost);
		} // validacao == true
		// Evita que o form seja enviado e dê o reload na página
		return false;
	}
	
	gE('btnCancelar').onclick = function() {
		// Elimina o fundo criado para o body e a div - boxCad - que contém o formulário de cadastro.
		removerDivs();
		// Cancela a função do botão de 'limpar' os dados preenchidos.
		return false;
	}
}

// Esta função valida os dados do formulário de preenchimento obrigatório
function validarForm() {
	// Se não houver o formulário com o ID frmCad aborta a função
	if (!gE('frmCad')) return false;
	// Relação dos campos que devem ser preenchidos
	var nome = gE('nome');
	var ddd = gE('ddd');
	var tel = gE('tel');
	var email = gE('email');
	// Valida o campo nome, ou seja, ele não pode ficar em branco
	if (nome.value == '' || nome.value == null) {
		// Informa ao usuário o erro ocorrido
		alert('Ops! Informe o seu nome.');
		// Seta o focus no campo com erro
		nome.focus();
		// Retorna false, para a outra saber que algo está errado e não liberar o cadastro
		return false;
	}
	// Valida o DDD e em seguida o telefone
	if (ddd.value == '' || ddd.value == null) {
		alert('Ops! Informe o seu DDD.');
		ddd.focus();
		return false;
	}
	if (tel.value == '' || tel.value == null) {
		alert('Ops! Informe o seu telefone.');
		tel.focus();
		return false;
	}
	// Verifica o e-mail informado, retornando false se ele for inválido e true se for válido
	var verificaEmail = validaEmail(email.value);
	// Se for inválido exibe o erro
	if (verificaEmail == false) {
		alert('Ops! O e-mail informado, ' + email.value + ', é inválido; verifique-o.');
		email.focus();
		return false;
	}
	return true;
}


// Esta função é utilizada para atualizar o relatório com os registrados da agenda
function atualizaRelatorio() {
	var ajax = openAjax();
	ajax.open('GET', 'relatorio.php?ajax=true', true);
	ajax.onreadystatechange = function() {
		var conteudo = gE('conteudo');
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				conteudo.innerHTML = ajax.responseText;
			} 
		}
	}
	ajax.send(null);
}

/* Funções de terceiros */
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 

}