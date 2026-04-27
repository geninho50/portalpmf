
function salvar() {
    // Coloque aqui o código para salvar os dados
    alert("Dados salvos!");
}

function cancelar() {
    // Coloque aqui o código para cancelar
    alert("Operação cancelada!");
}
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
}

function showFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById('file-name').innerText = fileName;
}
function updateFileName(input) {
    var fileName = input.files[0].name;
    var label = input.parentElement.querySelector('.file-upload-label');
    label.textContent = fileName;
}


// function salvar() {
//     // Obtenha os dados do formulário
//     var formData = new FormData(document.querySelector('form'));

//     // Envie os dados para o arquivo PHP usando AJAX
//     fetch('processar_formulario.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => {
//         if (response.ok) {
//             return response.text();
//         }
//         throw new Error('Erro ao salvar os dados.');
//     })
//     .then(data => {
//         // Faça algo com a resposta do servidor, se necessário
//         console.log(data);
//         alert("Dados salvos com sucesso!");
//     })
//     .catch(error => {
//         console.error('Erro:', error);
//         alert("Erro ao salvar os dados. Por favor, tente novamente.");
//     });
// }
// function updateInput() {
//     // Obter o valor digitado no input
//     var nome = document.getElementById('nomeInput').value;

//     // Atualizar o span com o valor digitado
//     document.getElementById('nomeDigitado').textContent = nome;
// }
// Função para processar a área de vigência
function processarVigencia() {
    var vigenciaInput = document.getElementById("vigencia").value;
    var vigenciaArray = vigenciaInput.split(" - "); // Divide a string em duas partes usando o separador " - "
    
    // Verifica se foram fornecidas duas datas
    if (vigenciaArray.length === 2) {
        var dataInicio = vigenciaArray[0];
        var dataFim = vigenciaArray[1];
        console.log("Data de Início:", dataInicio);
        console.log("Data de Término:", dataFim);
        // Aqui você pode adicionar o código para processar as datas conforme necessário
    } else {
        console.log("Formato de vigência inválido. Por favor, insira as datas no formato 'xx/xx/xx - zz/zz/zz'.");
    }
}

// Chamada da função quando o formulário é submetido
document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita o envio do formulário
    processarVigencia(); // Chama a função para processar a área de vigência
});

// Função para salvar os dados do formulário em um arquivo de texto
function salvarFormulario() {
    // Captura o valor de cada campo do formulário
    var titulo = document.getElementsByName("titulo")[0].value;
    var vigencia = document.getElementsByName("vigencia")[0].value;
    var fornecedor = document.getElementsByName("fornecedor")[0].value;
    var cnpj = document.getElementsByName("cnpj")[0].value;
    var sistema = document.getElementsByName("sistema")[0].value;
    var info = document.getElementsByName("info")[0].value;
    var valor = document.getElementsByName("valor")[0].value;
    var dt_input = document.getElementsByClassName("dt-input")[0].value;
    var objeto = document.getElementById("objeto").value;
    var observacoes = document.getElementById("observacoes").value;
    var secretaria = document.getElementsByName("secretaria")[0].value;
    var categoria = document.getElementsByName("categoria")[0].value;
    var nome_comercial = document.getElementsByName("nome_comercial")[0].value;

    // Monta o texto a ser salvo no arquivo
    var texto = "Título: " + titulo + "\n" +
                "Vigência: " + vigencia + "\n" +
                "Fornecedor: " + fornecedor + "\n" +
                "CNPJ: " + cnpj + "\n" +
                "Sistema: " + sistema + "\n" +
                "Info. Contratuais: " + info + "\n" +
                "Valor Anual: " + valor + "\n" +
                "Fiscal e-Gov: " + dt_input + "\n" +
                "Objeto: " + objeto + "\n" +
                "Detalhes e Observações: " + observacoes + "\n" +
                "Secretaria: " + secretaria + "\n" +
                "Categoria: " + categoria + "\n" +
                "Nome Comercial: " + nome_comercial;

    // Cria um objeto Blob com o texto formatado
    var blob = new Blob([texto], { type: "text/plain;charset=utf-8" });

    // Cria um elemento <a> para fazer o download do arquivo
    var link = document.createElement("a");
    link.href = window.URL.createObjectURL(blob);
    link.download = "formulario.txt";

    // Adiciona o link ao corpo do documento e aciona o clique
    document.body.appendChild(link);
    link.click();

    // Remove o link do corpo do documento
    document.body.removeChild(link);
}
