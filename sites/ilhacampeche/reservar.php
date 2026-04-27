<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="reservar.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.dsgovserprodesign.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Ilha do Campeche</title>
</head>

<body>

    <header>
        <img class="logo-header" src="images/logoPmf.png" alt=" Logo PMF ">
        <img class="" src="" alt="Logo Segurança">
    </header>

    <section>
        <div class="blocoCentral">
            <div class="infos">
                <h2>Informe os Dados da Visita</h2>
                
                <div class="divInfo">
                    <div class="divInfoInterna">
                        <label for="dataVisita">Data da Visita:</label><br>
                        <input type="date" id="dataVisita" name="dataVisita">
                    </div>
                    <div>
                        <label for="formPagto">Forma de Pagamento:</label><br>
                        <select id="formPagto" name="formPagto" class="custom-select">
                            <option value="0">PIX</option>
                            <option value="1">Boleto Bancario</option>
                        </select>
                    </div>
                </div>    

                <div class="divExplicando">Favor inserir os dados de cada pessoa que vai te acompanhar na visita a ilha:</div>

                <div>
                    <div class="form-group">
                        <table class="tableAc" id="tabela">                
                            <tr>
                                <td>
                                    <label for="nome">Nome:</label><br>
                                    <input type="text" class="" name="nome" maxLength="30" placeholder="Digite o Nome">
                                </td>    
                                <td>
                                    <label for="cpf">CPF:</label><br>
                                    <input type="text" class="" name="cpf" maxLength="11" placeholder="Digite o CPF">
                                </td>
                                <td>
                                    <label for="dataNascimento">Data de Nascimento:</label><br>
                                    <input type="date" class="" name="dataNascimento" >
                                </td>
                                <td>
                                    <br>
                                    <span class="material-symbols-outlined verdeAdd" onclick="adcionarLinha();">add</span>
                                </td>
                            </tr>
                        </table>                
                    </div>
                </div>

                <input type="submit" class="btnGerar" value="Gerar">

            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <h5>Desenvolvido pela E-gov</h5>
        </div>
    </footer>

<script>
    function adcionarLinha() {
        const tabela = document.getElementById("tabela");
        const novaLinha = tabela.insertRow();

        const colunaNome = novaLinha.insertCell(0);
        const colunaDocumento = novaLinha.insertCell(1);
        const colunaDataNascimento = novaLinha.insertCell(2);
        const colunaAcao = novaLinha.insertCell(3);

        colunaNome.innerHTML = "<label for='nome'>Nome:</label><br> <input type='text' name='nome[]' maxLength='30' placeholder='Digite o Nome'>";
        colunaDocumento.innerHTML = "<label for='cpf'>CPF:</label><br> <input type='text' name='cpf[]' maxLength='11' placeholder='Digite o CPF'>";
        colunaDataNascimento.innerHTML = "<label for='dataNascimento'>Data de Nascimento:</label><br> <input type='date' name='dataNascimento[]'>";
        colunaAcao.innerHTML = "<br> <span class='material-symbols-outlined verdeAdd' onclick='adcionarLinha();'>add</span> <span class='material-symbols-outlined vermelhoCancel' onclick='excluirLinha(this);'>do_not_disturb_on</span>";
    };

    function excluirLinha(botao) {
        const linha = botao.parentNode.parentNode;
        linha.parentNode.removeChild(linha);
    };

</script>

</body>