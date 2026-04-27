// Função para abrir o modal
function openModalCadastro() {
    closeModalReservar();  // Fechar o modal de reserva antes de abrir o de cadastro
    document.getElementById("modalCadastro").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function openModalReservar() {
    closeModalCadastro();  // Fechar o modal de cadastro antes de abrir o de reserva
    document.getElementById("modalReservar").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

// Função para fechar o modal
function closeModalCadastro() {
    document.getElementById("modalCadastro").style.display = "none";
    document.getElementById("overlay").style.display = "none";
    $('#nomeCadastro').val("");
    $('#cpfCadastro').val("");
    $('#dataNascimentoCadastro').val("");
    $('#emailCadastro').val("");
    $('#telefoneCadastro').val("");
    $('#cepCadastro').val("");
    $('#numeroResidencial').val("");
    $('#complemento').val("");
    $('#senha').val("");
    $('#senhaConf').val("");
}

function closeModalReservar() {
    document.getElementById("modalReservar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}
