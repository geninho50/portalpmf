<? 
require_once("backend/db.php");  

$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `IsnardAzevedo`.`dadosCadastro` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){

        $nome               = utf8_encode($data['nome']);
        $endereco           = utf8_encode($data['endereco']);
        $cidade             = utf8_encode($data['cidade']);
        $bairro             = utf8_encode($data['bairro']);
        $cep                = utf8_encode($data['cep']);
        $cnpj               = utf8_encode($data['cnpj']);
        $telefone           = utf8_encode($data['telefone']);
        $email              = utf8_encode($data['email']);
        $responsavel        = utf8_encode($data['responsavel']);
        $cpfResponsa        = utf8_encode($data['cpfResponsa']);
        $produtor           = utf8_encode($data['produtor']);
        $foneProd           = utf8_encode($data['foneProd']);
        $foneProdCel        = utf8_encode($data['foneProdCel']);
        $emailProd          = utf8_encode($data['emailProd']);
        $espetaculo         = utf8_encode($data['espetaculo']);
        $autor              = utf8_encode($data['autor']);
        $direcao            = utf8_encode($data['direcao']);
        $cenografia         = utf8_encode($data['cenografia']);
        $iluminacao         = utf8_encode($data['iluminacao']);
        $figurino           = utf8_encode($data['figurino']);
        $maquiagem          = utf8_encode($data['maquiagem']);
        $tempoDuracao       = utf8_encode($data['tempoDuracao']);
        $tempoMontagem      = utf8_encode($data['tempoMontagem']);
        $TempoDesmonta      = utf8_encode($data['TempoDesmonta']);
        $genero             = utf8_encode($data['genero']);
        $classificacao      = utf8_encode($data['classificacao']);
        $categoria          = utf8_encode($data['categoria']);
        $possibi            = utf8_encode($data['possibi']);
        $espacoEncena       = utf8_encode($data['espacoEncena']);
        $citarOutros        = utf8_encode($data['citarOutros']);
        $sinopseEspeta      = utf8_encode($data['sinopseEspeta']);
        $medidasPalcoBoca   = utf8_encode($data['medidasPalcoBoca']);
        $medidasPalcoBocaMin = utf8_encode($data['medidasPalcoBocaMin']);
        $profundidade       = utf8_encode($data['profundidade']);
        $profundidadeMin    = utf8_encode($data['profundidadeMin']);
        $numeroPessoas      = utf8_encode($data['numeroPessoas']);
        $siteBlog           = utf8_encode($data['siteBlog']);
        $linksVideo         = utf8_encode($data['linksVideo']);
        $idadeIJ            = utf8_encode($data['idadeIJ']);
        $idadeA             = utf8_encode($data['idadeA']);
        $tipo             = utf8_encode($data['tipo']);

        $link_historico_grupo         = utf8_encode($data['link_historico_grupo']);
        $link_curriculo_grupo         = utf8_encode($data['link_curriculo_grupo']);
        $link_link_curriculo_direcao  = utf8_encode($data['link_link_curriculo_direcao']);
        $link_fotos                   = utf8_encode($data['link_fotos']);
        $link_mapa_iluminacao         = utf8_encode($data['link_mapa_iluminacao']);
        $link_mapa_sonorizacao        = utf8_encode($data['link_mapa_sonorizacao']);

    }

    $idBotSub = "update";
}
?>


<!doctype html>
<html lang='pt-BR'>

  <head>
    <meta charset="UTF-8">
    <title>2° Mostra Quintais Cênicos</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>


<body>
    
    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-6">
                <img src="img/logo.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>
<br>

        <h1>2ª Mostra Quintais Cênicos</h1>
<br>        
        <p>Faça o download do <a href="edital.pdf" target="_blank"> Edital</a>, ou leia abaixo.</p>

        <div class="responsabilidade">

<h4>EDITAL Nº 002/FCFFC/2017 </h4><br>

            <p> <STRONG>  A SECRETARIA MUNICIPAL DE CULTURA, ESPORTE E JUVENTUDE DE FLORIANÓPOLIS </STRONG> através da FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN CASCAES - FCFFC, no uso de suas atribuições e CONSIDERANDO a necessidade de estabelecer procedimento a ser adotado na abertura de inscrições e seleção pública de propostas para a 2ª Mostra Quintais Cênicos a ser realizada no período de <strong>16 a 24 de setembro de 2017, em Florianópolis/SC,</strong> torna público, para conhecimento dos interessados, o presente edital de inscrição e seleção de propostas de espetáculos. A FCFFC instituirá, através de portaria, a Comissão Organizadora da 2ª Mostra Quintais Cênicos. Os recursos do presente Edital correrão por conta do orçamento da FCFFC e demais parceiros. </p>
            <p><strong>I - DAS DISPOSIÇÕES PRELIMINARES</strong></p> 
            <p><strong>Art. 1º - A 2ª Mostra Quintais Cênicos</strong> é uma mostra da diversidade teatral de Florianópolis, que contempla apresentações teatrais de espetáculos de teatro adulto, infantojuvenil e de rua dos mais variados gêneros e formatos, inéditos ou não, para público adulto e infantojuvenil, em espaços fechados (teatros, salas alternativas e auditórios) ou ao ar livre (praças, parques, largos e ruas), com apresentações gratuitas para um público de aproximadamente 20 mil espectadores, compreendendo:</p>
            <p><strong> * Cena Oficial - Programação nos Teatros </strong>(apresentações teatrais nas principais casas de espetáculos teatrais de Florianópolis)</p>
            <p><strong> * Cena Oficial - Programação nas Comunidades </strong>(apresentações teatrais em espaços comunitários e ao ar livre (praças, parques, largos e ruas);</p>
            <p><strong> * Cena Universitária </strong>(mostra de espetáculos produzidos por alunos dos cursos de teatro das universidades com sede em Florianópolis);</p>
            <p><strong> * Ações Formativas </strong>(Palestras, oficinas, lançamento de livros e debates de espetáculos);</p>
            <p><strong> * Roda de Negócios Teatrais </strong>(participação de curadores de Festivais de Teatro);</p>
            <p><strong>II - DAS CONDIÇÕES DE PARTICIPAÇÃO </strong></p>
            <p><strong>Art. 2º -</strong> Poderão se inscrever pessoas jurídicas (grupos, companhias, produtoras teatrais e micro-empreendedores) com sede no município de Florianópolis.</p>
           <p><strong> Art. 3º -</strong> Os inscritos deverão assumir compromisso de disponibilidade para o período de realização da Mostra. </p>
            <p><strong>III - DAS INSCRIÇÕES </strong></p>
            <p><strong>Art. 4º </strong>- A inscrição para a <strong> 2ª Mostra Quintais Cênicos</strong> será realizada através do preenchimento do formulário online, disponível no site oficial da FCFFC <strong>  http://www.pmf.sc.gov.br/entidades/franklincascaes/ até às 23h59, do dia 30 de junho de 2017.</strong></p>
            <p><strong>Art. 5º </strong>- Os interessados poderão inscrever mais de uma proposta de espetáculo, sendo que cada inscrição deverá ser feita separadamente com o preenchimento de todos os campos do formulário e a apresentação de todos os anexos solicitados, conforme segue:</p>
            <p><strong> * Para a Cena Oficial:</strong> Currículo do grupo/proponente, currículo da direção do espetáculo, release, sinopse, ficha técnica, clipagem e fotografias, bem como a informação de links para vídeo completo do espetáculo e conteúdos digitais do grupo;</p>
            <p><strong> * Para a Cena Universitária: </strong> currículo do proponente e proposta de programação com os respectivos históricos, releases, clipagens, ficha técnica e fotografias dos espetáculos;</p>
            <p><strong>PARÁGRAFO ÚNICO:</strong> Os responsáveis pelas propostas da <strong>Cena Universitária</strong>, deverão se responsabilizar pela coordenação de sua programação, garantindo logística e equipe técnica necessária à realização da programação proposta, garantindo o cumprimento integral da proposta selecionada.</p>
            <p><strong>IV - DA SELEÇÃO </strong></p>
            <p><strong>Art. 6º </strong>- A FCFFC nomeará uma Comissão Selecionadora composta por profissionais de reconhecida atuação na área das artes cênicas, indicados pela Comissão Organizadora da Mostra para selecionar, conforme critérios estabelecidos no artigo 7º, dentre as propostas inscritas, aquelas que participarão da 2ª Mostra Quintais Cênicos.</p>
            <p><strong>Art. 7º </strong>- Serão selecionados espetáculos de <strong>teatro adulto, infanto-juvenil e rua </strong> de acordo com os seguintes critérios:
           <p><strong> * Relevância do grupo</strong>, considerando seu histórico e representatividade no cenário teatral;</p> 
           <p><strong> *  Excelência artística do espetáculo</strong>, considerando seu currículo, clipagem e registro em vídeo;</strong>
           <p><strong> *  Diversidade e originalidade</strong>, considerando a singularidade de linguagem proposta dentro da encenação;</p>
           <p><strong> *  Adequação aos espaços</strong> que receberão a programação de apresentações de espetáculos da Mostra (conforme Art. 1º), considerando o formato da encenação.</p>
            <p><strong>Art. 8º </strong>- O número de propostas selecionadas e a composição da programação atenderá critérios artísticos, técnicos e financeiros do evento.</p>
            <p><strong>Art. 9º </strong>- As propostas selecionados poderão realizar 01 (uma) ou mais apresentações na programação e este número, bem como os locais de realização, serão definidos pela Comissão Organizadora da Mostra, considerando o formato de cada proposta, as indicações no cadastro e a logística de produção. </p>
            <p><strong>Art. 10º </strong>- A divulgação das propostas selecionadas será realizada em <strong> até 20 (vinte) dias após o término das inscrições da Mostra</strong>, por meio de mensagem enviada ao e-mail cadastrado no ato da inscrição e no site oficial da FCFFC / Prefeitura Municipal de Florianópolis http://www.pmf.sc.gov.br/entidades/franklincascaes/; </p>
            <p><strong>V – DA INFRAESTRUTURA </strong></p>
            <p><strong>Art. 11º </strong>- Os grupos teatrais selecionados contarão com: </p>
            <p> *  Serviço técnico e equipamento básico de iluminação e sonorização nos locais das apresentações.</p>
            <p> *  Serviço de camarim nos locais das apresentações (água, suco, frutas, sanduíches e biscoitos), a ser providenciada pela produtora contratada, conforme artigo 25º deste edital.</p>
            <p><strong>PARÁGRAFO ÚNICO:</strong> A FCFFC oferecerá aos integrantes dos grupos e profissionais convidados (artistas, oficineiros, palestrantes, debatedores e curadores), oriundos de outras cidades, hospedagem e alimentação, a ser providenciada pela produtora contratada, conforme artigo 25º deste edital.</p>
            <p><strong>Art. 12º </strong>- As propostas selecionadas receberão cachê de participação ou ajuda de custo, cujo pagamento será realizado pela FCFFC conforme artigo 24º, considerando os seguintes valores: </p>
            <p> *  As propostas selecionadas para apresentações teatrais na Cena Oficial receberão um cachê de participação no valor de R$ 2.000,00 (dois mil reais) para a primeira apresentação e R$ 1.000,00 (hum mil reais) para cada apresentação extra a ser definida pela Comissão Organizadora da Mostra.</p>
            <p> *  As propostas selecionadas para a Cena Universitária receberão ajuda de custo no valor total de R$ 400,00 por espetáculo.</p>
            <p><strong>Parágrafo único:</strong> O pagamento estará condicionado à contratação das propostas, conforme Art. 21º deste edital, e a comprovada realização do objeto contratado.</p>
            <p><strong>VI - DAS RESPONSABILIDADES DA PRODUÇÃO DOS ESPETÁCULOS</strong></p> 
            <p><strong>Art. 13º</strong> - Os grupos participantes se responsabilizarão por qualquer incidência de ação fiscal que possa haver por parte dos órgãos SBAT, ABRAMUS, ECAD e Autores Independentes. Devendo regularizar o uso das obras utilizadas em seu espetáculo junto às instituições responsáveis e comprovar a esta Comissão Organizadora a liberação do espetáculo por estas instituições com antecedência de 20 dias ao início da Mostra.</p>
            <p><strong>Art. 14º </strong>- Em caso dos grupos possuírem menores de idade como integrantes, deverá ser apresentada a autorização dos pais ou responsáveis legais, assim como da Vara de Infância e da Juventude.</p> 
            <p><strong>Art. 15º </strong>- O resguardo de materiais cênicos e técnicos necessários à apresentação antes, durante e após a Mostra também são de responsabilidade dos grupos.</p> 
            <p><strong>Art. 16º </strong>- As montagens e apresentações dos espetáculos, assim como os debates deverão ocorrer rigorosamente nos dias, locais e horários preestabelecidos pela organização da Mostra, não sendo permitidos atrasos e mudanças. </p>
            <p><strong>Art. 17º </strong>- Cada grupo, após a sua apresentação, deverá retirar todo seu material dos espaços. A Mostra não se responsabilizará por materiais/equipamentos deixados em camarins, vans e/ou espaços cênicos. </p>
            <p><strong>Art. 18º </strong>- Caberá ao grupo selecionado providenciar o material cênico e técnico necessário ao seu espetáculo, incluindo as gelatinas necessárias ao seu plano de luz, com exceção da estrutura técnica de base de iluminação e sonorização oferecida pela Mostra.</p>
            <p><strong>Art. 19º</strong> - Os grupos selecionados deverão estar à disposição da organização da Mostra para participar de entrevistas à imprensa, bem como enviar imagens e informações para material gráfico e divulgação sempre que solicitado.</p>
            <p><strong>Art. 20º</strong> - Caso haja cancelamento de participação, após o período de confirmação, por parte de algum grupo selecionado, o mesmo será automaticamente impedido de se inscrever nas duas edições subsequentes da Mostra. </p>
            <p><strong>PARÁGRAFO ÚNICO:</strong> As alterações de releases e fichas técnicas deverão ser informadas à Mostra no prazo máximo de 20 (vinte) dias após a divulgação dos selecionados, em conformidade com os dados da ficha de inscrição. Após este período, a Mostra não se responsabilizará por retificações de informações em materiais gráficos de divulgação e de registro do evento. </p>
            <p><strong>VII – DA CONTRATAÇÃO DOS SELECIONADOS </strong></p>
            <p><strong>Art. 21º</strong> – Para fins de contratação, os grupos/propostas selecionados deverão enviar para a Comissão Organizadora da Mostra no prazo máximo de 10(dez) dias úteis, após o recebimento de comunicado de confirmação de participação emitido pela Comissão Organizadora, a documentação relacionada a seguir: </p> 
            <p><strong>a) Documentos com registro/autenticação em cartório do grupo selecionado ou empresa que o representa: </strong></p>
            <p>1. Contrato Social da Empresa ou Estatuto da Associação, cujo objetivo seja coerente com o evento (Artístico, Artes Cênicas, Teatro);</p> 
            <p>2. Em caso de Estatuto, Ata de posse da última diretoria;</p> 
            <p>3. Cópia do RG e CPF do representante legal da Pessoa Jurídica a ser contratada;</p> 
            <p>4. Proposta Comercial assinada;</p>
            <p>5. Declaração de Exclusividade, com firma reconhecida (para artistas/grupos representados por outra empresa);</p>
            <p>6. Cópia do Contrato de Representação. (para artistas/grupos representados por outra empresa).</p>
            <p>7. Procuração com poderes para representação (para artistas/grupos representados por outra empresa);</p>
            <p>8. Cópia do RG do representado (para artistas/grupos representados por outra empresa).</p>
            <p><strong>Documentos sem necessidade de registro em cartório do grupo selecionado ou empresa que o representa:</strong></p> 
            <p>9. Cadastro Nacional de Pessoa Jurídica – CNPJ;</p>
            <p>10. Certidão Negativa de Débitos de Tributos e Contribuições Federais e Previdenciários; </p>
            <p>11. Certidão Negativa de Débitos da União;</p> 
            <p>12. Certidão Negativa de Débitos Estadual;</p> 
            <p>13. Certidão Negativa de Débitos Municipal;</p> 
            <p>14. Certidão Negativa de Débitos do Fundo de Garantia por Tempo de Serviço (FGTS);</p>
            <p>15. Certidão Negativa de Débitos Trabalhistas (CNDT);</p>
            <p>16. Declaração de que a empresa não emprega menores;</p>
            <p>17. Dados Bancários (nome do banco, número da agência e conta bancária em nome da Pessoa Jurídica que firmará o contrato com a FCFFC);</p>
            <p>18. Currículo/Histórico e clipagem do Grupo/Espetáculo.</p>
            <p><strong>PARÁGRAFO ÚNICO:</strong> Na falta de documentação total ou parcial após o prazo acima estabelecido, o grupo será desclassificado deste edital.</p>
            <p><strong>Art. 22º </strong>– A referida documentação deverá ser entregue pessoalmente ou enviada via SEDEX em envelope lacrado com a seguinte especificação:</p> 
            <p><strong>FUNDAÇÃO CULTURAL DE FLORIANÓPOLIS FRANKLIN CASCAES</strong></p> 
            <p>Diretoria de Artes</p> 
            <p>2ª Mostra Quintais Cênicos (Documentação Contratação)</p>
            <p>Rua Trajano, 168, Edifício Berenhauser, 4º andar - Centro - Florianópolis/ SC - CEP 88010-010</p>
            <p><strong>Art. 23º </strong>- Após o recebimento dos documentos, a Comissão Organizadora convocará os grupos para comparecerem à sede da FCFFC para a assinatura do Contrato de Participação.</p> 
            <p><strong>VIII – DO PAGAMENTO DOS SELECIONADOS</strong></p> 
            <p><strong>Art. 24º </strong>- O pagamento dos grupos selecionados será efetuado de acordo com o Art. 12º, através da apresentação de Nota Fiscal da Pessoa Jurídica contratada, e seguirá o seguinte procedimento: </p>
            <p> *  O cachê de cada grupo será totalizado, caso a caso, pelo valor da primeira apresentação e das apresentações extras definidas pela Comissão Organizadora da Mostra.</p>
            <p> *  O pagamento dos cachês será efetuado em parcela única, em até 30 dias após a realização das apresentações teatrais e apresentação de Nota Fiscal.</p>
            <p> *  O participante selecionado é responsável pelo adimplemento dos respectivos créditos tributários incidentes e ciente das retenções obrigatórias.</p> 
            <p><strong>IX - DAS DISPOSIÇÕES FINAIS</strong></p> 
            <p><strong>Art. 25º </strong>- A FCFFC realizará processo de licitação para contratação de Produtora Cultural, que se responsabilizará pela prestação de todos os serviços técnicos da Mostra, incluindo o atendimento de logística de transporte local dos cenários dos grupos selecionados da Mostra, bem como hospedagem, alimentação e transporte local dos grupos convidados e profissionais contratados para palestras, debates, oficinas e curadores oriundos de outras cidades.</p>
            <p><strong>Art. 26º </strong>- A FCFFC poderá utilizar imagens dos artistas e espetáculos selecionados para promoção do evento nesta e em outras edições. </p>
            <p><strong>Art. 27º </strong>– As despesas com o presente edital correm por conta de dotação orçamentária bem como de fontes de recursos estadual e federal. </p>
            <p><strong>Art. 28º </strong>– Visando complementar a programação do evento, a Comissão Organizadora da Mostra poderá convidar grupos teatrais de outras cidades especialmente para a abertura e encerramento do evento.</p>
            <p><strong>Art. 29º </strong>- Fica terminantemente proibida a participação de grupos/espetáculos/propostas que tenham a participação de funcionários da Secretaria Municipal de Cultura, Esporte e Juventude de Florianópolis e da Fundação Cultural de Florianópolis Franklin Cascaes até o terceiro grau de parentesco.</p> 
            <p><strong>Art. 30º</strong> - As decisões da Comissão Selecionadora são irrevogáveis e irrecorríveis. </p>
            <p><strong>Art. 31º</strong> - A simples inscrição na 2ª Mostra Quintais Cênicos presume a aceitação e concordância com todos os termos do presente regulamento e das decisões da Comissão Organizadora da Mostra. </p>
            <p><strong>Art. 32º </strong>- A Fundação Cultural de Florianópolis Franklin Cascaes reserva-se o direito de realizar a Mostra em partes ou no todo, bem como anular parcial e/ou totalmente o presente edital a qualquer tempo, em defesa de seus interesses.  </p>
            <p>Florianópolis, 01 de junho de 2017.</p>
            <p><strong>Roseli Maria da Silva Pereira</strong></p>
            <p>Superintendente da Fundação Cultural de Florianópolis Franklin Cascaes</p>
            <p><strong>Márcio Luiz Alves</strong></p>
            <p>Secretario Municipal de Cultura, Esporte e Juventude de Florianópolis</p>

        </div>

        <div class="lembrete">
            
            <p>Lembramos que, conforme previsto no edital, as inscrições se darão através deste site, <STRONG>preenchendo o formulário abaixo.</STRONG> </p>
            <p>O encerramento das inscrições será no dia <STRONG>30/06/2017 as 23:59h.</STRONG> </p>
            <p>Todos os campos referentes aos<Strong> Dados Cadastrais do Proponente são obrigatórios</Strong></p>
            <p>Ao clicar em enviar será gerado uma mensagem com o seu<STRONG> número de inscrição.</STRONG></p>
            <p>Lembramos que os interessados <STRONG>poderão inscrever mais de um espetáculo</STRONG>, sendo que cada inscrição deverá ser feita <STRONG>separadamente e gerará um novo nº de cadastro.</STRONG> </p>
            <p>Qualquer necessidade de <STRONG>alteração na ficha de inscrição</STRONG> deve ser solicitada através do email <STRONG>deptoteatro.fcffc@pmf.sc.gov.br </STRONG>.</p>
        </div>

</p>
</p>
</div>
</div>
</div>

<div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">


<form id="frm1" name="frm1" method="post" action="backend/cadastrardadosCadastro.php"; enctype="multipart/form-data">
        <h2>Formulário de Cadastro</h2>
<br>

      <div class="row">
            <label class="col-md-6">
                <input type="radio" name="tipo" id="tipo" value="1" class="tipo"> Mostra Oficial 
                </label>
            <label class="col-md-6">
                <input type="radio" name="tipo" id="tipo" value="2" class="tipo"> Cena Universitária
                </label>
     </div>


<br>
        <label>Dados Cadastrais do Proponente:</label><br>
        <div class="row">
            <div class="col-md-6"><label for:"nome">Nome da Entidade/Grupo:</label><input value="<?=$nome?>" id="nome" name="nome" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"cnpj">CNPJ:</label><input value="<?=$cnpj?>" id="cnpj" name="cnpj" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"endereco">Endereço:</label><input value="<?=$endereco?>" id="endereco" name="endereco" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"bairro">Bairro:</label><input value="<?=$bairro?>" id="bairro" name="bairro" class="form-control" type="text"/></div>    
            <div class="col-md-6"><label for:"cidade">Cidade:</label><input value="<?=$cidade?>" id="cidade" name="cidade" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"cep">CEP:</label><input value="<?=$cep?>" id="cep" name="cep" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"telefone">Telefone:</label><input value="<?=$telefone?>" id="telefone" name="telefone" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"email">EMail:</label><input value="<?=$email?>" id="email" name="email" class="form-control" type="email"/></div>
        </div>

<br>


        
        <label>Responsável Legal do Grupo:</label><br>
        <div class="row">
            <div class="col-md-6"><label for:"responsavel">Nome:</label><input value="<?=$responsavel?>" id="responsavel" name="responsavel" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"cpfResponsa">CPF:</label><input value="<?=$cpfResponsa?>" id="cpfResponsa" name="cpfResponsa" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"produtor">Produtor:</label><input value="<?=$produtor?>" id="produtor"  name="produtor" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"foneProd">Telefone Fixo:</label><input value="<?=$foneProd?>" id="foneProd" name="foneProd" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"foneProdCel">Telefone Celular:</label><input value="<?=$foneProdCel?>" id="foneProdCel" name="foneProdCel" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"emailProd">Email:</label><input value="<?=$emailProd?>" id="emailProd" name="emailProd" class="form-control" type="email"/></div>
        </div>

<br>


        <label>Dados Cadastrais do Espetáculo:</label><br>
        <div class="row">
            <div class="col-md-6"><label for:"espetaculo">Espetáculo:</label><input value="<?=$espetaculo?>" id="espetaculo" name="espetaculo" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"autor">Autor:</label><input value="<?=$autor?>" id="autor" name="autor" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"direcao">Direção:</label><input value="<?=$direcao?>" id="direcao" name="direcao" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"cenografia">Cenografia:</label><input value="<?=$cenografia?>" id="cenografia" name="cenografia" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"iluminacao">Iluminação:</label><input value="<?=$iluminacao?>" id="iluminacao" name="iluminacao" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"figurino">Figurino:</label><input value="<?=$figurino?>" id="figurino" name="figurino" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"maquiagem">Maquiagem:</label><input value="<?=$maquiagem?>" id="maquiagem" name="maquiagem" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"tempoDuracao">Tempo de duração do espetáculo:</label><input value="<?=$tempoDuracao?>" id="tempoDuracao" name="tempoDuracao" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"tempoMontagem">Tempo de montagem técnica do espetáculo:</label><input value="<?=$tempoMontagem?>" id="tempoMontagem" name="tempoMontagem" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"tempoDesmota">Tempo de desmontagem do espetáculo:</label><input value="<?=$TempoDesmonta?>" id="TempoDesmonta" name="TempoDesmonta" class="form-control" type="text"/></div>
            <div class="col-md-6"><label for:"genero">Gênero:</label><input value="<?=$genero?>" id="genero" name="genero" class="form-control" type="text"/></div>

        </div>

<br>

</div>


                  
      <label>Classificação Etária:</label><br>
        <div class="row">      
            <label class="col-md-4" for:"0">
                <input value="IJ" type="radio" name="classificacao" id="classificacao" class="classificacao" onclick="if(document.getElementById('0').disabled==true) {document.getElementById('0').disabled=false; document.getElementById('1').disabled=true}")/> Infantojuvenil
                <input type="text" id="0" name="0" value="Ex.: 07-14" class="form-control" disabled>              
            </label>

            <label class="col-md-4" for:"1">
                  <input value="A" type="radio" name="classificacao" id="classificacao" class="classificacao" onclick="if(document.getElementById('1').disabled==true) {document.getElementById('0').disabled=true; document.getElementById('1').disabled=false}"/> Adulto
                  <input type="text" id="1" name="1" value="Ex.: Acima de 14" class="form-control" disabled>
            </label>
        </div>


<br>

      <label>Categoria:</label><br>
      <div class="row">
            <label class="col-md-4">
                <input type="radio" name="categoria" id="categoria" value="1" class="categoria"> Adulto 
                </label>
            <label class="col-md-4">
                <input type="radio" name="categoria" id="categoria" value="2" class="categoria"> Infantojuvenil 
                </label>
            <label class="col-md-4">
                <input type="radio" name="categoria" id="categoria" value="3" class="categoria"> Rua 
                </label>
     </div>

<br>

      <label>Possibilidade de mais de uma apresentação:</label><br>
      <div class="row">
            <label class="col-md-4">
                <input type="radio" name="possibi" id="possibi" value="1" class="possibi"> Sim 
                </label>
            <label class="col-md-4">
                <input type="radio" name="possibi" id="possibi" value="2" class="possibi"> Não 
                </label>
     </div>

<br>

      <label>Espaço(s) para encenação (indique 1 ou mais):</label><br>
            <div class="row">
            <label class="col-md-4">
                <input type="checkbox" name="espacoEncena[]" value="2" class="espacoEncena"> Palco italiano 
                </label>
            <label class="col-md-4">
                <input type="checkbox" name="espacoEncena[]" value="11" class="espacoEncena"> Rua 
                </label>            
            <label class="col-md-4">
                <input type="checkbox" name="espacoEncena[]" value="23" class="espacoEncena"> Lona 
                </label>
            <label class="col-md-4">
                <input type="checkbox" name="espacoEncena[]" value="41" class="espacoEncena"> Outros 
                </label>
     </div>
     <br>

        <div class="row">
            <div class="col-md-12"><label>Citar Outros Espaço(s):</label><input value="<?=$citarOutros?>" id="citarOutros" name="citarOutros" class="form-control" type="text"/></div>
            <div class="col-md-12"><label>Sinopse do Espetáculo:</label><textarea value="<?=$sinopseEspeta?>" id="sinopseEspeta" name="sinopseEspeta" class="form-control" row="4" type="text" /></textarea></div>     
<br>
</div>

<br>
    <label>Medidas de Palco:</label><br>
    <div class="row">
            <div class="col-md-6"><label>Boca de Cena (ideal):</label><input value="<?=$medidasPalcoBoca?>" id="medidasPalcoBoca" name="medidasPalcoBoca" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Boca de Cena (mínimo):</label><input value="<?=$medidasPalcoBocaMin?>" id="medidasPalcoBocaMin" name="medidasPalcoBocaMin" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Profundidade (ideal):</label><input value="<?=$profundidade?>" id="profundidade" name="profundidade" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Profundidade (mínimo):</label><input value="<?=$profundidadeMin?>" id="profundidadeMin" name="profundidadeMin" class="form-control" type="text"/></div>
</div>       

<br>

<div class="row">
            <div class="col-md-6"><label>Número de Pessoas (elenco + técnica):</label><input value="<?=$numeroPessoas?>" id="numeroPessoas" name="numeroPessoas" class="form-control" type="text"/></div>
            <div class="col-md-6"><label>Site/Blog/Facebook:</label><input value="<?=$siteBlog?>" id="siteBlog" name="siteBlog" class="form-control" type="text"/></div>
            <div class="col-md-12"><label>Links para vídeo:</label><input value="<?=$linksVideo?>" id="linksVideo" name="linksVideo" class="form-control" type="text"/></div>
            <div><input id="id1" name="id1" type="hidden"/></div>
        </div>
 
<br>

        
          <table width="200%" border="0">
            <tr> 
              <td> </td>
            </tr>
            <tr>
              <td> 
                <table width="100%" border="0">
                <p><strong>Todos</strong> os arquivos deverão ter a extensão<strong> PDF</strong> (com no máximo 10MB por arquivo)</p>
                  <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Histórico do Grupo:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_historico_grupo?>" id="link_historico_grupo" name="arquivo[]"/>
                      </td>
                  </tr>

                    <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Currículo do Grupo:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_curriculo_grupo?>" id="link_curriculo_grupo" name="arquivo[]" />
                    </td>
                  </tr>

                    <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Currículo da Direção:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_curriculo_grupo_direcao?>" id="link_curriculo_grupo_direcao" name="arquivo[]"/>
                    </td>
                  </tr>

                    <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">PDF com fotos do Espetáculo:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_fotos?>" id="link_fotos" name="arquivo[]"/>
                    </td>
                  </tr>

                    <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Mapa de Iluminação:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_mapa_iluminacao?>" id="link_mapa_iluminacao" name="arquivo[]"/>
                    </td>
                  </tr>


                    <tr>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Mapa de Sonorização:</font></td>
                    <td width="80%">
                      <input type="file" value="<?=$link_mapa_sonorizacao?>" id="link_mapa_sonorizacao" name="arquivo[]"/>
                    </td>
                      
                  </tr>

                </table>
              </td>
            </tr>
            <tr>
              <td>  </td>
            </tr>
          </table>
     


        <?php if($id != null){?>
                <input type="button" name="update" onclick="update()" id="update" class="btn btn-primary botao" value="Atualizar" />
        <?php } else{?>

<br>
<br>

        
        <div class="check">
          <input type="checkbox" id="check-1">
            Declaro para os devidos fins que li e concordo integralmente com o Edital da 2° Mostra Quintais Cênicos. <a href="edital.pdf" target="_blank"> Edital.</a>
            <br>
          <input type="checkbox" id="check-2">
            Declaro também que assumo compromisso de disponibilidade para o período de realização da 2° Mostra Quintais Cênicos.
            <br>
          <input type="button" disabled name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-primary botao" value="Enviar" />
          <img id="loader" src="./img/loader.gif" style="display:none;width:40px;height:40px;">
        </div>
    </div>

</form>    
    <div class="overlay"></div>

        <?php
    }?>

    </div>

  </body>

    <script>
    $('#foneProd').mask("(99) 9999-9999");
    $('#foneProdCel').mask("(99) 99999-9999");
    $('#cep').mask("99999-999");
    $('#cpfResponsa').mask("999.999.999-99");
    $('#tempoDuracao').mask("99:99");
    $('#tempoMontagem').mask("99:99");
    $('#TempoDesmonta').mask("99:99");
    $('#cnpj').mask("99.999.999/9999-99");
    

    $.get( "backend/verificarDadosCadastro.php").done(function( data ) { 
        var retorno = jQuery.parseJSON(data);
        if(retorno.sucesso == 0){
            $('.overlay').fadeIn();
        }
    });

    $('#check-1, #check-2').bind('click',function(){
        if($('#check-1').is(':checked') ){
            if($('#check-2').is(':checked') ){
                $('#btnSubmit').prop( "disabled", false );
            }else{
                $('#btnSubmit').prop( "disabled", true );
            }
        }else{
            $('#btnSubmit').prop( "disabled", true );
        }
    });    

    $('#btnSubmit').bind('click',function(){
        $('#error').addClass('hide');
            var err = '';

            var totalEspacoEncena = 0;
            $(".espacoEncena:checked").each(function() {
              totalEspacoEncena += parseInt($(this).val());
            });


            var obj = {
                               
            nome                  : $('#nome').val(),
            endereco              : $('#endereco').val(),
            cidade                : $('#cidade').val(),
            bairro                : $('#bairro').val(),
            cep                   : $('#cep').val(),
            cnpj                  : $('#cnpj').val(),
            telefone              : $('#telefone').val(),
            email                 : $('#email').val(),
            responsavel           : $('#responsavel').val(),
            cpfResponsa           : $('#cpfResponsa').val(),
            produtor              : $('#produtor').val(),
            foneProd              : $('#foneProd').val(),
            foneProdCel           : $('#foneProdCel').val(),
            emailProd             : $('#emailProd').val(),
            espetaculo            : $('#espetaculo').val(),
            autor                 : $('#autor').val(),
            direcao               : $('#direcao').val(),
            cenografia            : $('#cenografia').val(),
            iluminacao            : $('#iluminacao').val(),
            figurino              : $('#figurino').val(),
            maquiagem             : $('#maquiagem').val(),
            tempoDuracao          : $('#tempoDuracao').val(),
            tempoMontagem         : $('#tempoMontagem').val(),
            TempoDesmonta         : $('#TempoDesmonta').val(),
            genero                : $('#genero').val(),
            classificacao         : $('.classificacao:checked').val(),
            categoria             : $('.categoria:checked').val(),
            possibi               : $('.possibi:checked').val(),
            espacoEncena          : totalEspacoEncena,
            citarOutros           : $('#citarOutros').val(),
            sinopseEspeta         : $('#sinopseEspeta').val(),
            medidasPalcoBoca      : $('#medidasPalcoBoca').val(),
            medidasPalcoBocaMin   : $('#medidasPalcoBocaMin').val(),
            profundidade          : $('#profundidade').val(),
            profundidadeMin       : $('#profundidadeMin').val(),
            numeroPessoas         : $('#numeroPessoas').val(),
            siteBlog              : $('#siteBlog').val(),
            linksVideo            : $('#linksVideo').val(),
            idadeIJ               : $('#0').val(),
            idadeA                : $('#1').val(),
            link_historico_grupo  : $('#link_historico_grupo').val(),
            link_curriculo_grupo  : $('#link_curriculo_grupo').val(),
            link_curriculo_grupo_direcao  : $('#link_curriculo_grupo_direcao').val(),
            link_fotos            : $('#link_fotos').val(),
            link_mapa_iluminacao  : $('#link_mapa_iluminacao').val(),
            link_mapa_sonorizacao : $('#link_mapa_sonorizacao').val(),
            tipo                  : $('.tipo:checked').val()

            };

           var obj = new FormData($("#frm1").get(0));
           $('#btnSubmit').attr("disabled", true);
           $('#loader').show();          

           $.ajax({
               type: "POST",
               url: "backend/cadastrardadosCadastro.php",
               //dataType: "json",
               contentType: false,
          	   processData:false,
               data: obj,
               success: function (obj1) {
               		//console.log(obj1);
                    var oRetorno = JSON.parse(obj1);                    
                    if(oRetorno.sucesso == 1){
                      	$('#error').addClass('hide');                      	

                      	document.getElementById("frm1").action = "inclui.php";
                    	$('#id1').val(oRetorno.id);
                    	document.getElementById("frm1").submit();                       	  
                    }else{  
                       //console.log(oRetorno);
                       $('#error').text(oRetorno.error).removeClass('hide');
                       $('.error').removeClass('error');
                       $('#' + oRetorno.fieldProblem).addClass('error');
                       window.scrollTo(0, 0);
                       $('#btnSubmit').removeAttr("disabled");
                    	$('#loader').hide();
           			}


               },
               error: function (obj1) {
               	    $('#btnSubmit').removeAttr("disabled");
               	    $('#loader').hide();
                    console.log("erro:"+obj1);
               }
            });

            
                 
/* 
        $.post( "backend/cadastrardadosCadastro.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                frm.action = 'inclui.php';
                frm.submit();  
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                window.scrollTo(0, 0);
            }

        });
*/


 //console.log(obj);
    });



    function update(){
        $('#error').addClass('hide');
        var err = '';
        var id  = "<?=$id?>";
        var obj = {
            id             : id,

            nome                  : $('#nome').val(),
            endereco              : $('#endereco').val(),
            cidade                : $('#cidade').val(),
            bairro                : $('#bairro').val(),
            cep                   : $('#cep').val(),
            cnpj                  : $('#cnpj').val(),
            telefone              : $('#telefone').val(),
            email                 : $('#email').val(),
            responsavel           : $('#responsavel').val(),
            cpfResponsa           : $('#cpfResponsa').val(),
            produtor              : $('#produtor').val(),
            foneProd              : $('#foneProd').val(),
            foneProdCel           : $('#foneProdCel').val(),
            emailProd             : $('#emailProd').val(),
            espetaculo            : $('#espetaculo').val(),
            autor                 : $('#autor').val(),
            direcao               : $('#direcao').val(),
            cenografia            : $('#cenografia').val(),
            iluminacao            : $('#iluminacao').val(),
            figurino              : $('#figurino').val(),
            maquiagem             : $('#maquiagem').val(),
            tempoDuracao          : $('#tempoDuracao').val(),
            tempoMontagem         : $('#tempoMontagem').val(),
            TempoDesmonta         : $('#TempoDesmonta').val(),
            genero                : $('#genero').val(),
            classificacao         : $('.classificacao:checked').val(),
            categoria             : $('.categoria:checked').val(),
            possibi               : $('.possibi:checked').val(),
            espacoEncena          : $('.espacoEncena:checked').val(),
            citarOutros           : $('#citarOutros').val(),
            sinopseEspeta         : $('#sinopseEspeta').val(),
            medidasPalcoBoca      : $('#medidasPalcoBoca').val(),
            medidasPalcoBocaMin   : $('#medidasPalcoBocaMin').val(),
            profundidade          : $('#profundidade').val(),
            profundidadeMin       : $('#profundidadeMin').val(),
            numeroPessoas         : $('#numeroPessoas').val(),
            siteBlog              : $('#siteBlog').val(),
            linksVideo            : $('#linksVideo').val(),
            idadeIJ               : $('#0').val(),
            idadeA                : $('#1').val(),
            link_historico_grupo  : $('#link_historico_grupo').val(),
            link_curriculo_grupo  : $('#link_curriculo_grupo').val(),
            link_curriculo_grupo_direcao  : $('#link_curriculo_grupo_direcao').val(),
            link_fotos            : $('#link_fotos').val(),
            link_mapa_iluminacao  : $('#link_mapa_iluminacao').val(),
            link_mapa_sonorizacao : $('#link_mapa_sonorizacao').val(),
            tipo                  : $('.tipo:checked').val(),
        };
        

        $(document).ready(function(){
		$('.div-ajax-carregamento-pagina').fadeOut('fast');
	});
         
    }

    </script>
   
</html>