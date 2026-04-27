<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reservar.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.dsgovserprodesign.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Ilha do Campeche</title>
</head>
<?php 

include_once("banco/gdb.php");

$gdb = new gdb();

$email = $gdb->vargetpost('login');

$gdb->open("select * from pessoa where pesemail = '$email' ");

$nome      = $gdb->gs['PESNOME'][0];
$pescodigo = $gdb->gs['PESCODIGO'][0];

// print '<pre>';
// print_r($_POST);
// print '</pre>';

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);


?>
<body>
    <header>
        <img class="logo-header" src="images/logoPmf.png" alt=" Logo PMF ">
        <img class="" src="" alt="Logo Segurança">
    </header>
     
    <main>   
<div class="divImagem"> 
    <section>
        <form name="frm" id="frm" method="POST"  >
            <input type="hidden" value="<?=$gdb->gs['PESCODIGO'][0]; ?>" name='pescodigo' id='pescodigo' >
        <div class="blocoCentral">
            <div class="infos">
                <h2>Informe os Dados da Visita</h2>
                <h3>Visitante : <?=$nome;?></h3><br>
                  
                <?php                 
                $gdb->open("select voucodigo, 
                                   DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita   from voucher 
                             where voupescodigo = '$pescodigo' 
                               and voudata>=CURDATE()
                          order by voudata ");

                if( isset($gdb->linhas) && $gdb->linhas>0 ){ ?>
                    <div class="divInfo">
                        <div>
                            <input type="button" class="quadroAba" id ="btnAba1" onclick="abaAtiva(1);" value="Nova Visita"/>
                        </div> 
                        <div>   
                            <input type="button" class="quadroAba" id ="btnAba2" onclick="abaAtiva(2);" value="Agendada(s)"/>
                        </div> 
                        <div>
                            <input type="button" class="quadroAba" id ="btnAba3" onclick="abaAtiva(3);" value="REGRAS"/>
                        </div>   
                    </div>
            <?php } ?>

                <div id="novaVisita" name="novaVisita" style="display:block;" >
                    <h3>Nova Visita</h3>
                    <div class="divInfo">
                        <div class="divInfoInterna">
                            <div class="divdados ">
                            
                                <label class="labelInfo" for="dataVisita">Data da Visita:</label><br>
                                <input type="text" readonly id="dataVisita" name="dataVisita" placeholder="">
                            
                            </div>    
                            <div class="divdados">
                                <label class="ocultarLabel">*</label><br>
                                <input type="button" id="quadro" onclick="renderCalendar()" value="Quadro de Reservas"/>
                            </div>
                            <div>
                                <p>*Ao lado da data está a quantidade de vagas Disponiveis!</p>
                            </div>
                        </div>
                        <!--  <div>
                                <label for="formPagto">Forma de Pagamento:</label><br>
                                <select id="formPagto" name="formPagto" class="custom-select">
                                    <option value="0">PIX</option>
                                    <option value="1">Boleto Bancario</option>
                                </select>
                            </div> -->
                    </div>   
                    
                    <div id="divQuadro" style="display:none;">
                        <div class="divButtonQuadro">
                            <h2 id="monthYear">M&ecirc;s Ano</h2>
                            <input type="button" class="inputQuadro" onclick="previousMonth()" value="M&ecirc;s Anterior"></input>
                            <input type="button" class="inputQuadro" onclick="nextMonth()" value="Pr&oacute;ximo M&ecirc;s"></input>
                            <table id="calendar" onclick="selectDate(event)"> </table>
                        </div>
                    </div>

                    <div class="divExplicando">Favor inserir os dados de cada pessoa que vai te acompanhar na visita a ilha:</div>

                    
                        <div class="form-group">
                            <table class="tableAc" id="tabela">                
                                <tr>
                                    <td>
                                        <label for="nome">Nome:</label><br>
                                        <input type="text" class='campo-obrigatorio' name="nomeFirst" maxLength="30" placeholder="Digite o Nome">
                                    </td>    
                                    <td>
                                        <label for="Documento">Documento:( CPF ou RG )</label><br>
                                        <input type="text" class='campo-obrigatorio verificaDoc' name="cpfFirst" maxLength="11" placeholder="Digite o numero">
                                    </td>
                                    <td>
                                        <label for="dataNascimento">Data de Nascimento:</label><br>
                                        <input type="date" class='campo-obrigatorio' name="dataNascimentoFirst" >
                                    </td>
                                    <td>
                                        <br>
                                        <button type="button" class="btnAd" onclick="adicionarLinha();">Adicionar</button>
                                        <!-- <span class="material-symbols-outlined verdeAdd" onclick="adicionarLinha();">add</span> -->
                                    </td>
                                </tr>
                            </table>                
                        </div>
                    
                </div>
                <div id="visitaAgenda" name="visitaAgenda"  style="display:none;" >
                  <?php 
                    $gdb->open("select voucodigo, 
                                        DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita 
                                    from voucher 
                                    where voupescodigo = '$pescodigo' 
                                    and voudata>=CURDATE()
                                order by voudata ");

                    if( isset($gdb->linhas) && $gdb->linhas>0 ){                        
                        print "<h3>Visitas Agendadas</h3>";
                        print "<select name='voucodigo' id='voucodigo'> ";
                        foreach($gdb->gs['VOUCODIGO'] as $i=>$value){
                            $nomeArquivo = "images/qrcode/qrcode".str_pad($value, 8, '0', STR_PAD_LEFT)."A".str_pad(0, 8, '0', STR_PAD_LEFT).".png";
                            if( file_exists($nomeArquivo) ){
                                print "<option value='$value'>".$gdb->gs['DVISITA'][$i]."</option>";
                            }
                        }
                        print "</select> ";
                        print '<input type="button" class="btnGerar" value="Imprimir Voucher"  onclick="ImprimirVoucher();">';
                    }                
                    ?>                    
                </div>

                    <div id="regras" name="regras" style="display:none;">
                        <h2>REGRAS DE VISITAÇÃO</h2>
                        <h4>Não é permitido alimentar os quatis.</h4>
                        <h4>Não é permitido a introdução e/ou a remoção de plantas ou animais.</h4>
                        <h4>Não é permitido o desembarque de animais, exceto cão guia.</h4>
                        <h4>Não é permitido subir em costões rochosos sem permissão.</h4>
                        <h4>Não é permitido fazer trilhas, sem o acompanhamento de monitores credenciados do IPHAN.</h4>
                        <h4>Não é permitido acampar, nem fazer churrasco na praia e no interior da ilha.</h4>
                        <h4>Não é permitido o pernoite de turistas e visitantes, bem como não é permitido adentrar à Ilha sem autorização.</h4>
                        <h4>Não é permitido o uso de aparelhos de som potentes, ou quaisquer outros equipamentos que possam perturbar a tranquilidade do local.</h4>
                    </div>


                    <div id="pelicula" class="pelicula"></div>
                    <div id="minhaDiv" class="hidden">
                        <div class="divSpan">
                            <span onclick="closeModal()">&times;</span>
                        </div>    
                        <div class="divCheck" id="divCheck">
                            <input type="checkbox" id="checkbox">Está de acordo com as Regras referente a visitação da Ilha.
                        </div>
                        <div id="loadingIcon">
                            <img src="images/carregamento2.gif" class="ImagemCarregamento" alt="Carregando...">
                        </div>
                    </div>

                <input type="button" class="btnGerar" id="btnGerar" value="Gerar" onclick="gerarVaucher();">
                <input type="button" class="btnGerar" value="Sair"  onclick="sair();">                
            </div>
        </div>
        </form>    
    </section>
</div> 


</main>

</body>

<script>

// funcao para gerar quadro
let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
let currentOcupacao = null; 

function gerarVaucher() {
    if (frm.dataVisita.value == '') {
        alert("Informe a data da visita !");
        frm.dataVisita.focus();
    } else {
        if (document.getElementById('minhaDiv').offsetParent === null) {
            document.getElementById('minhaDiv').style.display = 'block'; 
        }
        if (document.getElementById('pelicula').offsetParent === null){
            document.getElementById('pelicula').style.display = 'block'
        }
    }
}

const checkbox = document.getElementById('checkbox');

checkbox.addEventListener('change', function() {
    if (checkbox.checked) {
        document.getElementById('loadingIcon').style.display = 'block';
        document.getElementById('divCheck').style.marginBottom = '15px';
        setTimeout(function() {
            document.getElementById('loadingIcon').style.display = 'none';
            document.getElementById('minhaDiv').style.display = 'none';
            document.getElementById('pelicula').style.display = 'none';
            document.getElementById('divCheck').style.marginBottom = '40px';
            document.frm.action = "voucherIlha.php";
            document.frm.submit();
        }, 1280);
        setTimeout(function() {
            checkbox.checked = false;
        }, 1280);   
    }
});



function closeModal() {
    document.getElementById("minhaDiv").style.display = "none";
    document.getElementById('pelicula').style.display = 'none';
}

function renderCalendar(pMes,pAno) {
    var xhttp      = new XMLHttpRequest();
    var ocupacao   = null;
   
    const calendar = document.getElementById("calendar");
    const monthYear = document.getElementById("monthYear");

    calendar.innerHTML = "";
    monthYear.textContent = `${getMonthName(currentMonth)} ${currentYear}`;

    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();

    const daysOfWeek = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"];
    var vetorVagasDias = [];
    var dataAtual        = new Date();
    var dataAtualSemHora = new Date(dataAtual.getFullYear(), dataAtual.getMonth(), dataAtual.getDate());

    // Cabecalho da tabela
    let headerRow = calendar.insertRow();
    for ( let day of daysOfWeek ) {
        let th = document.createElement("th");
        th.textContent = day ;
        th.classList.add("thCalendario");
        headerRow.appendChild(th);
    }
    
    if ( pMes  ===  undefined ){
        var mes        = currentMonth.toString();
        var ano        = currentYear.toString();
    }else{
        var mes        = pMes;
        var ano        = pAno.toString();
    }

    var parametros = "mes="+mes.toString()+"&ano="+ano;
    var url        = "php/calcularvisitas.php";
    //console.log('Parametros :', parametros );


    xhttp.onreadystatechange = function() {
        if ( this.readyState == 4 && this.status == 200 ) {
            // aqui voce pode trabalhar com a resposta da consulta
            ocupacao = JSON.parse( this.responseText );
            //alert(this.responseText);
            // Dias do m s
            let date = 1;
            for (let i = 0; i < 6; i++) {
                let row = calendar.insertRow();

                for (let j = 0; j < 7; j++) {
                if ( i === 0 && j < firstDayIndex ) {

                    // C lulas vazias antes do primeiro dia do m s
                    let cell = row.insertCell();
                    cell.classList.add("cellQuadro");
                    cell.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                } else if (date > daysInMonth) {

                        // C lulas vazias ap s o  ltimo dia do m s
                        let cell = row.insertCell();
                        cell.classList.add("cellQuadro");
                        cell.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                } else {

                        var dateNew = (parseInt(date, 10) < 10) ? '0' + date : date;
                        let mMes  = currentMonth+1;
                        let dataCurrent = new Date(currentYear.toString() + '-' + mMes.toString() + '-' + dateNew );
                        console.log('Data corrente :', currentYear.toString() + '-' + mMes.toString() + '-' + dateNew);
                        console.log('Data atual  :', dataAtualSemHora);
                        let cell = row.insertCell();

                        if( dataCurrent >= dataAtualSemHora ){
                            reservas = 800;
                            if( ocupacao.hasOwnProperty(dateNew) ){
                                reservas = 800 - ( ocupacao[dateNew] );
                            }

                            cell.textContent = dateNew +' ('+ reservas.toString().trim() +')';
                            cell.classList.add("cellQuadro");
                            if (reservas < 800) {
                                cell.style.backgroundColor = '#00b1eb';
                                
                            }
                        }else{
                            
                            cell.textContent = '-';
                            cell.classList.add("cellQuadro");
                            
                        }
                        date++;
                }
                }
            }            
        }
    }
    
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);

    /*
    if ( pMes  ===  undefined ){
        var ocupacao = buscarVetorVagasDias( currentMonth, currentYear );
    }else{
        var ocupacao = buscarVetorVagasDias( pMes, pAno );
    } 
    
    if ( ocupacao === null ){
        ocupacao = [];
    }

    console.log('Dados do vetor 2 :', ocupacao );
    */


    }

    function buscarVetorVagasDias(pMes,pAno){

        var xhttp      = new XMLHttpRequest();
        var mes        = pMes;
        var ano        = pAno.toString();
        var parametros = "mes="+mes.toString()+"&ano="+ano;         
        var url        = "php/calcularvisitas.php";
        
        console.log('Parametros :', parametros );

        xhttp.onreadystatechange = function() {
            if ( this.readyState == 4 && this.status == 200 ) {
                // aqui voce pode trabalhar com a resposta da consulta                
                currentOcupacao = JSON.parse( this.responseText );
                //alert(this.responseText);
            }
        };    
       
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(parametros);          
        return currentOcupacao;
    }

    function getMonthName(month) {
      const monthNames = [
            "Janeiro", "Fevereiro", "Marco", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
      return monthNames[month];
    }

    function nextMonth() {
      currentMonth++;
      if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
      }
      renderCalendar(currentMonth,currentYear);
    }

    function previousMonth() {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      renderCalendar(currentMonth,currentYear);
    }

    function selectDate(event) {
      const target = event.target;

      if (target.tagName === 'TD' && target.textContent.trim() !== '') {
         const selectedDate = new Date(currentYear, currentMonth, parseInt(target.textContent.substring(0, 2) ) );
         const formattedDate = selectedDate.toLocaleDateString('pt-BR'); // Formata a data  
         // alert( formattedDate );
        document.getElementById("dataVisita"). value = formattedDate;
      }
      // Esconder o quadro
        const minhaDiv = document.getElementById('divQuadro');
        minhaDiv.style.display = 'none';
        document.getElementById('quadro').textContent = 'Abrir Div';
    }

// funcao esconder quadro

    // Seleciona o botao e a div
    const meuBotao = document.getElementById('quadro');
    const minhaDiv = document.getElementById('divQuadro');

    // Adiciona um evento de clique ao botao
        meuBotao.addEventListener('click', function() {
          if (minhaDiv.style.display === 'none') {
        // Se estiver escondida, mostra a div
        minhaDiv.style.display = 'block';
        document.getElementById('calendarioHeader').style.display = 'block'; // Mostra o cabe�alho do calend�rio
        meuBotao.textContent = 'Fechar Div';
    } else {
        // Se estiver vis�vel, esconde a div
        minhaDiv.style.display = 'none';
        document.getElementById('calendarioHeader').style.display = 'none'; // Esconde o cabe�alho do calend�rio
        meuBotao.textContent = 'Abrir Div';
    }
    });

// fun��es para adicionar linha

let numeroDeLinhas = 0;

function adicionarLinha() {
  if (verificaDoc() && verificarCampos() && numeroDeLinhas < 4) {
    const tabela = document.getElementById("tabela");
    const novaLinha = tabela.insertRow();

    const colunaNome = novaLinha.insertCell(0);
    const colunaDocumento = novaLinha.insertCell(1);
    const colunaDataNascimento = novaLinha.insertCell(2);
    const colunaAcao = novaLinha.insertCell(3);

    colunaNome.innerHTML = "<label for='nome'>Nome:</label><br> <input type='text' class='campo-obrigatorio' name='nome[]' maxLength='30' placeholder='Digite o Nome'>";
    colunaDocumento.innerHTML = "<label for='Documento'>Documento:</label><br> <input type='text' class='campo-obrigatorio verificaDoc' name='cpf[]' maxLength='11' placeholder='Digite o Numero'>";
    colunaDataNascimento.innerHTML = "<label for='dataNascimento'>Data de Nascimento:</label><br> <input class='campo-obrigatorio' type='date' name='dataNascimento[]'>";
    colunaAcao.innerHTML = "<br> <button type='button' class='btnAd' onclick='adicionarLinha();'>Adicionar</button> <button type='button' class='btnEx' onclick='excluirLinha(this);'>Remover</button>";

    numeroDeLinhas++;
  } else if (numeroDeLinhas >= 4) {
    alert("Você atingiu o limite máximo de linhas.");
  }
}



function verificarCampos() {
    const camposObrigatorios = document.querySelectorAll('.campo-obrigatorio');

    for (let campo of camposObrigatorios) {
        if (campo.value.trim() === '') {
            alert("Por favor, preencha todos os campos.");
            return false;
        }
    }

    return true;
}

function verificaDoc() {
    const valoresDocumento = [];
    const camposDocumento = document.querySelectorAll('.verificaDoc');

    for (let campo of camposDocumento) {
        if (valoresDocumento.includes(campo.value.trim())) {
            alert("Documentos repetidos não são permitidos.");
            return false;
        }
        valoresDocumento.push(campo.value.trim());
    }

    return true;
}

function abaAtiva(opc){
    if(opc == 1){
        document.getElementById('novaVisita').style.display = 'block';
        document.getElementById('visitaAgenda').style.display = 'none';
        document.getElementById('regras').style.display = 'none';
        document.getElementById('btnGerar').style.display = 'block';
        document.getElementById('btnAba1').style.backgroundColor = '#002f66';
        document.getElementById('btnAba1').style.color = 'white';
        document.getElementById('btnAba2').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba2').style.color = 'black';
        document.getElementById('btnAba3').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba3').style.color = 'black';
    } else if(opc == 2){
        document.getElementById('novaVisita').style.display = 'none';
        document.getElementById('visitaAgenda').style.display = 'block';
        document.getElementById('regras').style.display = 'none';
        document.getElementById('btnGerar').style.display = 'none';
        document.getElementById('btnAba1').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba1').style.color = 'black';
        document.getElementById('btnAba2').style.backgroundColor = '#002f66';
        document.getElementById('btnAba2').style.color = 'white';
        document.getElementById('btnAba3').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba3').style.color = 'black';
    } else if(opc == 3){
        document.getElementById('novaVisita').style.display = 'none';
        document.getElementById('visitaAgenda').style.display = 'none';
        document.getElementById('regras').style.display = 'block';
        document.getElementById('btnGerar').style.display = 'none';
        document.getElementById('btnAba1').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba1').style.color = 'black';
        document.getElementById('btnAba2').style.backgroundColor = '#f8f8f8';
        document.getElementById('btnAba2').style.color = 'black';
        document.getElementById('btnAba3').style.backgroundColor = '#002f66';
        document.getElementById('btnAba3').style.color = 'white';
    }
}

function excluirLinha(botao) {
  const linha = botao.parentNode.parentNode;
    linha.parentNode.removeChild(linha);
    numeroDeLinhas--;
}

function ImprimirVoucher(){
   document.frm.action = "imprimirVoucher.php";
   document.frm.target = "blank";
   document.frm.submit();
}

function sair(){    
  document.frm.action = "index.html";
  document.frm.submit();    
}
</script>                
