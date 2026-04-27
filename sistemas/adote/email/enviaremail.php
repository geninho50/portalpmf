<?php
include('gmailSender.class.php');
include('../banco/gdb.php');

$gmailSender = new gmailSender();
$gdb = new gdb();

$para = $gdb->vargetpost('para');

$nomeDestinatario = 'DIBEA - Diretoria de Bem-Estar Animal';
$de = 'adote.pmf@gmail.com';
$assunto = utf8_decode('Ficha de Requisição de Adoção');
$corpo = utf8_decode('<p>Olá, ficamos muito felizes com seu ato de interesse em adotar um animal do Abrigo Municipal de Florianópolis - DIBEA.</p>
Após o envio de interesse no animal escolhido você precisa seguir alguns passos que estão descritos abaixo:</p>
<ol>
    <li>Comparecer a Diretoria de Bem Estar Animal o quanto antes com a ficha de requisição impressa e preenchida.</li>
    <li>Trazer Documento oficial com foto Identidade/CNH/Carteira Profissional, comprovante de residencia atualizado em seu nome.</li>
    <li>Ao chegar na recepção da Diretoria de Bem Estar Animal - DIBEA, informar que você se interessou por um animal escolhido na plataforma de adoção.</li>  
    <li>Apresentar os documentos do item 2 ao funcionário que irá atende-lo.</li>
    <li>Após análise dos documentos e entrevista você irá conhecer o animal escolhido.</li>
    <li>Iniciando o processo de adoção será agendado uma visita em sua residência que na oportunidade o animal escolhido irá junto para agilizar o processo de adoção.</li>
    <li>Aprovado todos requisitos da adoção incluindo a vistoria da residência o candidato a adoção assina o termo de responsabilidade e o animal já fica na sua nova casa.</li>
</ol>
<p>ATENÇÃO:<br>O processo de adoção só será concluso após vistoria na residência e assinatura do termo de responsabilidade. Caso a vistoria não seja aprovada o animal retorna ao órgão público e o processo de adoção será INDEFERIDO.<br> 
Adoções apenas para maiores de 18 anos e moradores do município de Florianópolis.<br>
O processo de adoção passa por cadastro de intenção, análise, entrevista e visita na residência do adotante. <br>
Não garantimos que o animal escolhido na plataforma esteja disponível na entrega dos documentos na Diretoria de Bem Estar Animal, devido a rotatividade de adoções. Por isso é tão importante que todos documentos sejam entregues o quanto antes no órgão.</p>
<p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php?pagina=home&menu=0">Diretoria do Bem Estar Animal</a></p>
<p><a href="http://www.pmf.sc.gov.br/sistemas/adote/index.php#">ADOTE! Melhor que comprar, é GANHAR UM!</a></p>
<p>Rodovia SC-401, nº114 - DIBEA</p>
<p>Itacorubi - CEP: 88032-005</p>
<p>Telefone: (48) 3234-5677</p>
<img width="35%" src="http://www.pmf.sc.gov.br/sistemas/adote/img/logos.jpg"/>');
$path = '../pdf/entrevista_adocao.pdf';
$path1 = '../pdf/termo_adesao_dibea.pdf';
 
echo ($gmailSender->smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo, $path, $path1, $cid)) ? 1 : 0;