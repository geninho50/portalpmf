
//<script src ="scripts/scripts_geral.js"></script>
// <script src="assets/js/modern.js"></script>
//Ativa e Desativa menu lateral



function toggleSidebar( ) {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const headerToggle = document.getElementById('headerToggle');

    if (!sidebar || !mainContent || !headerToggle) {
        console.log('Elementos não encontrados');
        return;
    }

    // Verificar se a sidebar está fechada
    const isClosed = sidebar.classList.contains('sidebar-closed');
    console.log('Sidebar fechada:', isClosed);

    if (isClosed) {
        // Abrir sidebar
        console.log('Abrindo sidebar...');
        sidebar.classList.remove('sidebar-closed');
        mainContent.classList.remove('main-expanded');
        headerToggle.style.display = 'none';
    } else {
        // Fechar sidebar
        console.log('Fechando sidebar...');
        sidebar.classList.add('sidebar-closed');
        mainContent.classList.add('main-expanded');
        headerToggle.style.display = 'inline-block';
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const headerToggle = document.getElementById('headerToggle');
    const userMenu = document.getElementById('userMenu');

    // Toggle sidebar (botão da sidebar)
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Botão sidebar clicado');
            toggleSidebar();
        });
    }

// Toggle sidebar (botão do header)
    if (headerToggle) {
        headerToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Botão header clicado');
            toggleSidebar();
        });
}
    // User menu toggle
    if (userMenu) {
        userMenu.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }

    // Fechar sidebar ao redimensionar a tela para desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const headerToggle = document.getElementById('headerToggle');

            if (sidebar) {
                // Forçar sidebar aberta em desktop
                sidebar.classList.remove('sidebar-closed');
                mainContent.classList.remove('main-expanded');
                headerToggle.style.display = 'none';
            }
        } else {
            // Em mobile, fechar sidebar
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const headerToggle = document.getElementById('headerToggle');

        if (sidebar) {
        sidebar.classList.add('sidebar-closed');
            mainContent.classList.add('main-expanded');
            headerToggle.style.display = 'inline-block';
            }
        }
    });
});


// function trocaMenu(local, tamanho) {
//         var oLoop = tamanho;
//         const menu = document.getElementById(local + 'menu');
//         const newMenu = document.getElementById(local + 'new-menu');

//         //limpa todas as seleções e displays
//         for (let i = 1; i <= oLoop; i++) {
//             document.getElementById(i + 'menu').classList.remove('active');
//             document.getElementById(i + 'new-menu').style.display = 'none';
//         }
//         //ativa quem for selecionado
//         menu.classList.add('active');
//         newMenu.style.display = 'block';
//     }


//trocar valor de troca
function clickSite(valor) {

    if (valor == true ){
        document.getElementById('yesImput').style.display = "block";
        document.getElementById('noImput').style.display = "none";

    }else{
        document.getElementById('noImput').style.display = "block";
        document.getElementById('yesImput').style.display = "none";
    }
}

function tabelaOn (){
    const tabela = document.querySelector("#tabela1");
    tabela.classList.remove("hidden");

}



function toggleInputLink(select) {
    const valorSelecionado = select.value;
    const inputLI = document.getElementById('LI');
    const selectLE = document.getElementById('LE');

    if (inputLI) inputLI.style.display = 'none'; if (selectLE) selectLE.style.display = 'none';
    switch (valorSelecionado){
        case 'LInterno': inputLI.style.display = 'block';
        break;

        case 'LExterno': selectLE.style.display = 'block';
        break;
    }
}
function mostraNiveis(valor){ //true or false, se true, mostra um e apaga outro, se false o opsto
    const base1 = document.getElementById("base_um");
    const base2 = document.getElementById("base_dois");

    if (valor == true){
        base2.style.display = "block";
        base1.style.display = "none";
    } else {
        base1.style.display = "block";
        base2.style.display = "none";
    }
}

function adicionarPermissao(valor){
    const base1 = document.getElementById("permissao_um");
    const base2 = document.getElementById("permissao_dois");

    if (valor == true){
        base2.style.display = "block";
        base1.style.display = "none";
    } else {
        base1.style.display = "block";
        base2.style.display = "none";
    }

}


function mostraUsuarios(){
    document.getElementById("lista_usuarios").style.display = "block";;
}

//trocar modal

const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");

function openModal() {
    modal.classList.remove("hidden");
    overlay.classList.remove("hidden");
}

const closeModal = function () {
    modal.classList.add("hidden");
    overlay.classList.add("hidden");
};

function alertaExcluit(){
    alert ('Protocolo incorreto, favor informar um valido.');
    //window.location.replace('consulta.php');
}


//modal 
function showAddNewsModal() {
    document.getElementById('addNewsModal').classList.add('active');
}

function viewNews(newsId) {
// Implementar visualização
alert('Visualizar notícia ' + newsId);
}

function editNews(newsId) {
// Implementar edição
alert('Editar notícia ' + newsId);
}

function deleteNews(newsId) {
if (confirm('Tem certeza que deseja excluir esta notícia?')) {
window.location.href = '?action=delete&id=' + newsId;
}
}

// Busca em tempo real
document.getElementById('searchNews').addEventListener('input', function(e) {
const searchTerm = e.target.value.toLowerCase();
const rows = document.querySelectorAll('tbody tr');

rows.forEach(row => {
const text = row.textContent.toLowerCase();
row.style.display = text.includes(searchTerm) ? '' : 'none';
});
});


function trocarMidia() {
// Esconde todos os campos de mídia
document.getElementById('image').parentElement.style.display = 'none';
document.getElementById('audio').parentElement.style.display = 'none';
document.getElementById('video').parentElement.style.display = 'none';

// Pega o valor selecionado
var tipo = document.querySelector('select[name="status"]').value;

// Mostra apenas o campo correspondente
if (tipo === 'image') {
document.getElementById('image').parentElement.style.display = 'block';
} else if (tipo === 'audio') {
document.getElementById('audio').parentElement.style.display = 'block';
} else if (tipo === 'video') {
document.getElementById('video').parentElement.style.display = 'block';
}
}

