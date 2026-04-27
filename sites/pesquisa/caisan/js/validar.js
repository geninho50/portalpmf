function validarFormulario() {
    var nomeCompleto = document.forms["form"]["nomeCompleto"].value;
    var enderecoCompleto = document.forms["form"]["enderecoCompleto"].value;
    var inputBairro = document.forms["form"]["inputBairro"].value;
    var comentario = document.forms["form"]["comentario"].value;

    if (nomeCompleto == "" || enderecoCompleto == "" || inputBairro == "-- Selecione --" || comentario == "") {
      alert("Por favor, preencha todos os campos obrigatórios.");
      return false; // Impede o envio do formulário
    }else{
        if( confirm('Esta ciente das respostas preenchidas ?')){
            form.submit();
        } 
    };
};

function validarNome(input) {
  input.value = input.value.replace(/[@#%$&*!]/g, '');
}

function validarEmail(input) {
  
  const valorEmail = input.value.trim(); // Remove espaços em branco no início e no final

  // Verifica se o campo está vazio ou se o conteúdo não parece ser um e-mail válido
  if (valorEmail === '' || !/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(valorEmail)) {
    alert('Por favor, insira um endereço de e-mail válido.');
  }
}

  
