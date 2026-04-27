document.addEventListener('DOMContentLoaded', (event) => {
    buscarTotalPorFornecedor();
    buscarContratosPorSecretaria();
    carregarSecretarias();
    buscarEvolucaoValoresContratos();
    buscarValoresTempoContratos();
    buscarValoresAnuaisPorSecretaria();
});

function buscarEvolucaoValoresContratos() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/buscarEvolucaoValoresContratos.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                let responseData = JSON.parse(xhr.responseText);

                if (responseData && Array.isArray(responseData) && responseData.length > 0) {
                    let datas = responseData.map(item => {
                        let mes = item.mes;
                        return obterNomeMes(mes); // Função para obter o nome do mês em português
                    });

                    let valores = responseData.map(item => parseFloat(item.totalValorMensal));
                    let qtdContratosPorMes = responseData.map(item => item.qtdContratos);

                    const ctx = document.getElementById('grafico3').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: datas,
                            datasets: [{
                                label: 'Evolução dos Valores dos Contratos',
                                data: valores,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                fill: true
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: 'white'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Evolução dos Valores dos Contratos',
                                    color: 'white'
                                },
                                tooltip: {
                                    callbacks: {
                                        afterLabel: function(context) {
                                            const index = context.dataIndex;
                                            const qtdContratos = qtdContratosPorMes[index];
                                            return qtdContratos ? `Contratos: ${qtdContratos}` : 'Sem contratos';
                                        }
                                    }
                                }
                            },
                            layout: {
                                padding: {
                                    left: 50,
                                    right: 50,
                                    top: 0,
                                    bottom: 0
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                } else {
                    console.error('Dados recebidos do servidor estão vazios ou em formato incorreto.');
                }
            } catch (error) {
                console.error('Erro ao processar resposta do servidor:', error);
            }
        }
    };

    xhr.onerror = function () {
        console.error('Erro de conexão ao servidor.');
    };

    xhr.send();
}

// Função para obter o nome do mês em português
function obterNomeMes(numeroMes) {
    const meses = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];
    return meses[numeroMes - 1]; // Arrays são baseados em zero, então subtrai 1 do número do mês
}





// Função para gerar uma cor aleatória
function getRandomColor() {
    let r = Math.floor(Math.random() * 256);
    let g = Math.floor(Math.random() * 256);
    let b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 1)`;
}

// Função para buscar valores anuais por secretaria
function buscarValoresAnuaisPorSecretaria() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/buscarValoresAnuaisPorSecretaria.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                let responseData = JSON.parse(xhr.responseText);

                if (responseData.NOMESECRETARIA && responseData.TOTALCUSTOANUAL) {
                    let labelsBar = responseData.NOMESECRETARIA;
                    let dataBar = responseData.TOTALCUSTOANUAL.map(Number);

                    // Define cores
                    let backgroundColorsBar = [];
                    for (let i = 0; i < labelsBar.length; i++) {
                        if (i === 0) {
                            backgroundColorsBar.push('rgba(175, 188, 207, 1)');
                        } else {
                            backgroundColorsBar.push(getRandomColor());
                        }
                    }

                    const ctx = document.getElementById('graficoValoresAnuais').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labelsBar,
                            datasets: [{
                                label: 'Valores Anuais dos Contratos por Secretaria',
                                data: dataBar,
                                backgroundColor: backgroundColorsBar,
                                borderColor: backgroundColorsBar.map(color => color.replace('0.2', '1')),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: 'white'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Valores Anuais dos Contratos por Secretaria',
                                    color: 'white'
                                }
                            },
                            layout: {
                                padding: {
                                    left: 50,
                                    right: 50,
                                    top: 0,
                                    bottom: 0
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                } else {
                    console.error('Estrutura dos dados recebidos não é esperada:', responseData);
                }
            } catch (e) {
                console.error('Erro ao analisar JSON:', e);
            }
        }
    };

    xhr.send();
}

// Restante do seu código para outras funcionalidades...

// Função para carregar as secretarias no dropdown
function carregarSecretarias() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'buscarSecretarias.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var secretarias = JSON.parse(xhr.responseText);
            var select = document.getElementById('selectSecretaria');
            
            // Limpar opções atuais do select
            select.innerHTML = '<option value="" disabled selected>Selecione a Secretaria</option>';
            
            // Adicionar as opções de secretarias ao select
            secretarias.forEach(function(secretaria) {
                var option = document.createElement('option');
                option.value = secretaria.idSecretaria;
                option.textContent = secretaria.siglaSecretaria;
                select.appendChild(option);
            });

            // Ativar o dropdown após carregar as opções
            select.disabled = false;
        } else {
            console.log('Erro ao carregar secretarias. Status: ' + xhr.status);
        }
    };
    xhr.send();
}

function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
}

function abrirModalSair() {
    document.getElementById("modalExit").style.display = "block";
    document.getElementById("body").style.backgroundColor = "rgba(0, 0, 0, 0.5)";
}

function fecharModal() {
    document.getElementById("modalExit").style.display = "none";
    document.getElementById("body").style.backgroundColor = "rgba(0, 0, 0, 0)";
}

document.querySelectorAll("#voltar").forEach(function (element) {
    element.addEventListener("click", function () {
        fecharModal(element.closest(".modoff").id);
    });
});

// Função para gerar uma cor aleatória
function getRandomColor() {
    let r = Math.floor(Math.random() * 256);
    let g = Math.floor(Math.random() * 256);
    let b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 1)`;
}

// Dados para o gráfico de pizza
let labelsPie = [];
let dataPie = [];
let backgroundColorsPie = [];

// Função para buscar dados do servidor
function buscarTotalPorFornecedor() {
    var xhr3 = new XMLHttpRequest();
    xhr3.open('POST', 'http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/buscarTotalPorFornecedor.php', true);

    xhr3.onreadystatechange = function () {
        if (xhr3.readyState === 4 && xhr3.status === 200) {
            try {
                let responseData = JSON.parse(xhr3.responseText);

                if (responseData.NOME && responseData.VALOR) {
                    for (let i = 0; i < responseData.NOME.length; i++) {
                        labelsPie.push(responseData.NOME[i]);
                        dataPie.push(parseFloat(responseData.VALOR[i]));

                        let color = i === 0 ? 'rgba(175, 188, 207, 1)' : getRandomColor();
                        backgroundColorsPie.push(color);
                    }

                    const ctx2 = document.getElementById('grafico2').getContext('2d');
                    new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: labelsPie,
                            datasets: [{
                                label: 'Contrato',
                                data: dataPie,
                                backgroundColor: backgroundColorsPie,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: 'white'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Distribuição dos Valores dos Contratos por Fornecedor',
                                    color: 'white',
                                    fontSize: 0
                                }
                            },
                            layout: {
                                padding: {
                                    left: 50,
                                    right: 50,
                                    top: 0,
                                    bottom: 0
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                } else {
                    console.error('Estrutura dos dados recebidos não é esperada:', responseData);
                }
            } catch (e) {
                console.error('Erro ao analisar JSON:', e);
            }
        }
    };

    xhr3.send();
}

// Função para buscar dados dos contratos por secretaria
function buscarContratosPorSecretaria() {
    var xhr4 = new XMLHttpRequest();
    xhr4.open('POST', 'http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/buscarContratosPorSecretaria.php', true);

    xhr4.onreadystatechange = function () {
        if (xhr4.readyState === 4 && xhr4.status === 200) {
            try {
                let responseData = JSON.parse(xhr4.responseText);

                if (responseData.SIGLASECRETARIA && responseData.QUANTIDADECONTRATOS) {
                    let labelsBar = responseData.SIGLASECRETARIA;
                    let dataBar = responseData.QUANTIDADECONTRATOS.map(Number);

                    // Define cores
                    let backgroundColorsBar = dataBar.map((_, index) => index === 0 ? 'rgba(175, 188, 207, 1)' : getRandomColor());

                    const ctx1 = document.getElementById('grafico1').getContext('2d');
                    new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: labelsBar,
                            datasets: [{
                                label: 'Quantidade de Contratos por Secretaria',
                                data: dataBar,
                                borderWidth: 1,
                                backgroundColor: backgroundColorsBar,
                                borderColor: 'rgba(54, 162, 235, 1)'
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: 'white'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white'
                                    }
                                }
                            }
                        }
                    });

                } else {
                    console.error('Estrutura dos dados recebidos não é esperada:', responseData);
                }
            } catch (e) {
                console.error('Erro ao analisar JSON:', e);
            }
        }
    };

    xhr4.send();
}

function buscarValoresTempoContratos() {
    var xhr5 = new XMLHttpRequest();
    xhr5.open('POST', 'http://192.168.12.4/desenvolvimento/desenv4/pgs_fim/TelaDashboard/buscarValoresTempoContratos.php', true);

    xhr5.onreadystatechange = function () {
        if (xhr5.readyState === 4 && xhr5.status === 200) {
            try {
                let responseData = JSON.parse(xhr5.responseText);

                if (Array.isArray(responseData) && responseData.length > 0) {
                    // Inicializa os arrays para labels e valores
                    let tempos = [];
                    let valores = [];

                    // Preenche os arrays com os dados do servidor
                    responseData.forEach(item => {
                        if (item.vigenciaInicial && item.valor) {
                            tempos.push(item.vigenciaInicial);
                            valores.push(parseFloat(item.valor));
                        }
                    });

                    const ctx4 = document.getElementById('grafico4').getContext('2d');
                    new Chart(ctx4, {
                        type: 'line',
                        data: {
                            labels: tempos,
                            datasets: [{
                                label: 'Valores dos Contratos ao Longo do Tempo',
                                data: valores,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                fill: true,
                                lineTension: 0.1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: 'white'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: 'white'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Valores dos Contratos ao Longo do Tempo',
                                    color: 'white'
                                }
                            },
                            layout: {
                                padding: {
                                    left: 50,
                                    right: 50,
                                    top: 0,
                                    bottom: 0
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                } else {
                    console.error('Estrutura dos dados recebidos não é esperada:', responseData);
                }
            } catch (e) {
                console.error('Erro ao analisar JSON:', e);
            }
        } else if (xhr5.readyState === 4) {
            console.error('Erro na requisição:', xhr5.status, xhr5.statusText);
        }
    };

    xhr5.send();
}
