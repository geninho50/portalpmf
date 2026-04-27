// Função para abrir o modal

function openModalEscolha() {
    closeModalReservar();  // Fechar o modal de reserva antes de abrir o de cadastro
    document.getElementById("modalEscolha").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function openModalCadastro() {
    closeModalEscolha(); // Fechar o modal de escolha
    document.getElementById("modalCadastro").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function openCadastroEstrangeiro() {
    closeModalEscolha(); // Fechar o modal de escolha
    document.getElementById("modalEstrangeiro").style.display = "block";
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

function closeModalEstrangeiro() {
    document.getElementById("modalEstrangeiro").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function closeModalEscolha() {
    document.getElementById("modalEscolha").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

// Função para abrir o modal
function abrirModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'block';
}

// Função para fechar o modal
function fecharModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'none';
}

// Função para redirecionar para index.php
function redirecionar() {
    history.back(-3);
}


// função para combobox
document.addEventListener("DOMContentLoaded", function() {
    const paises = [
      "Afeganistão", "África do Sul", "Albânia", "Alemanha", "Andorra", "Angola", "Antígua e Barbuda", "Arábia Saudita", "Argélia", "Argentina", "Armênia", "Austrália", "Áustria", "Azerbaijão", "Bahamas", "Bangladexe", "Barbados", "Barém", "Bélgica", "Belize", "Benim", "Bielorrússia", "Bolívia", "Bósnia e Herzegovina", "Botsuana", "Brasil", "Brunei", "Bulgária", "Burquina Faso", "Burúndi", "Butão", "Cabo Verde", "Camarões", "Camboja", "Canadá", "Catar", "Cazaquistão", "Chade", "Chile", "China", "Chipre", "Cingapura", "Colômbia", "Comores", "Congo", "Coreia do Norte", "Coreia do Sul", "Costa do Marfim", "Costa Rica", "Croácia", "Cuba", "Dinamarca", "Djibouti", "Dominica", "Egito", "Emirados Árabes Unidos", "Equador", "Eritreia", "Eslováquia", "Eslovênia", "Espanha", "Estados Unidos", "Estônia", "Eswatini", "Etiópia", "Fiji", "Filipinas", "Finlândia", "França", "Gabão", "Gâmbia", "Gana", "Geórgia", "Granada", "Grécia", "Guatemala", "Guiana", "Guiné", "Guiné Equatorial", "Guiné-Bissau", "Haiti", "Honduras", "Hungria", "Iémen", "Ilhas Marshall", "Ilhas Salomão", "Índia", "Indonésia", "Irã", "Iraque", "Irlanda", "Islândia", "Israel", "Itália", "Jamaica", "Japão", "Jordânia", "Kiribati", "Kosovo", "Kuwait", "Laos", "Lesoto", "Letônia", "Líbano", "Libéria", "Líbia", "Liechtenstein", "Lituânia", "Luxemburgo", "Macedônia do Norte", "Madagascar", "Malásia", "Malaui", "Maldivas", "Mali", "Malta", "Marrocos", "Maurícia", "Mauritânia", "México", "Micronésia", "Moçambique", "Moldávia", "Mônaco", "Mongólia", "Montenegro", "Myanmar", "Namíbia", "Nauru", "Nepal", "Nicarágua", "Níger", "Nigéria", "Niue", "Noruega", "Nova Zelândia", "Omã", "Países Baixos", "Palau", "Panamá", "Papua-Nova Guiné", "Paquistão", "Paraguai", "Peru", "Polônia", "Portugal", "Quênia", "Quirguistão", "Reino Unido", "República Centro-Africana", "República Checa", "República Democrática do Congo", "República Dominicana", "Romênia", "Ruanda", "Rússia", "Samoa", "San Marino", "Santa Lúcia", "São Cristóvão e Nevis", "São Tomé e Príncipe", "São Vicente e Granadinas", "Seicheles", "Senegal", "Serra Leoa", "Sérvia", "Síria", "Somália", "Sri Lanka", "Suazilândia", "Sudão", "Sudão do Sul", "Suécia", "Suíça", "Suriname", "Tailândia", "Taiwan", "Tajiquistão", "Tanzânia", "Timor-Leste", "Togo", "Tonga", "Trinidad e Tobago", "Tunísia", "Turcomenistão", "Turquia", "Tuvalu", "Ucrânia", "Uganda", "Uruguai", "Uzbequistão", "Vanuatu", "Vaticano", "Venezuela", "Vietnã", "Zâmbia", "Zimbábue"
    ];
  
    const selectPaises = document.getElementById('paises');
  
    // Preenchendo a combobox com os países
    paises.forEach(pais => {
      const option = document.createElement('option');
      option.text = pais;
      selectPaises.appendChild(option);
    });
  
    // Adicionando o evento de envio do formulário
    const form = document.getElementById('form');
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Impede o envio padrão do formulário
      const selectedCountry = selectPaises.value;
      alert("Você selecionou o país: " + selectedCountry);
      // Aqui você pode fazer qualquer outra ação com o nome do país selecionado
    });
  });
  