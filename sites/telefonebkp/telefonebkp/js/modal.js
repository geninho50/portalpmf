function abrirModalProCidadao() {
    document.getElementById('modalProCidadao').style.display = 'block';
  }

// Função para abrir o modal da Ouvidoria
function abrirModalOuvidoria() {
  document.getElementById('modalOuvidoria').style.display = 'block';
}

// Função para fechar qualquer modal
function fecharModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

// Evento de clique nos botões para abrir os modais
document.getElementById('botaoProCidadao').addEventListener('click', abrirModalProCidadao);
document.getElementById('botaoOuvidoria').addEventListener('click', abrirModalOuvidoria);

// Evento de clique no botão de fechar do modal
document.querySelectorAll('.close').forEach(function (element) {
  element.addEventListener('click', function () {
    fecharModal(element.closest('.modal').id);
  });
});



 


