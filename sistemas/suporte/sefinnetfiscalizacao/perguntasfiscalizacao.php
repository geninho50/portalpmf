<?php


$questoesModulo1 ='
 <form action="../banco/questionario_fiscalizacao.php" method ="post" >

 <h3><span style="color:red"> <u>IMPORTANTE</u> </span>: Você terá <u>três</u> tentativas para atingir ao menos 70% de acertos no questionário.  Não atingindo aproveitamento mínimo, o servidor deverá passar por reciclagem com o gerente Alexandre Duarte.</h3>

 <input type="hidden" name="modulo" value="'.$modulo.'" />
 <input type="hidden" name="idUsuario" value="'.$idUsuario.'" />

  <p>Questão 01 – ORDEM DE SERVIÇO</p>
  <p>Conforme o Art. 115 da LC 007/1997 - “Os procedimentos administrativos fiscais serão executados, exclusivamente, pelos fiscais de tributos municipais com autorização do Diretor de Tributos Mobiliários ou do Diretor de Tributos Imobiliários da Secretaria Municipal da Fazenda (SMF) e serão instaurados, mediante expedição de Ordem de Serviço para a realização de procedimento de fiscalização ou de diligência, conforme o caso.”
A Ordem de Serviço é emitida no Sefinnet, na sequência “Relatórios Fiscais → Atividades Fiscais → Ordem de Serviço”. A tela aberta em seguida permitirá, entre outras coisas, visualizar as funções relativas à emissão, à pesquisa e às ordens de serviço emitidas anteriormente.
</p>
  <input type="radio" name="mod1q1" value= 1 required>Verdadeiro</input>
  <input type="radio" name="mod1q1" value= 0 required>Falso</input>
  
  <br><br>
  
   <p>Questão 02 – AUTO DE INFRAÇÃO</p>
   <p>“Art. 129 da LC 007/1997 - Verificada a infração a dispositivos regulamentares da legislação tributária, que não implique, diretamente, em evasão de tributos devidos ao Município, será lavrado, contra o infrator, auto de infração.”
No Sefinnet, após informar o contribuinte (manual ou por meio do CMC que recupera as informações do cadastro mobiliário), o sistema apresentará os últimos Autos de Infração emitidos contra esse contribuinte.
</p>
  <input type="radio"  name="mod1q2" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod1q2" value= 0 required>Falso</input>
  
   <br><br>
  
   <p>Questão 03 – INTIMAÇÃO</p>
   <p>A intimação é um instrumento utilizado pelo fiscal para solicitar esclarecimentos, documentação comprobatória, entre outras necessidades.
No Sefinnet, o auditor fiscal não pode selecionar e editar as informações de modelos de intimações cadastradas previamente no sistema.

</p>
  <input type="radio"  name="mod1q3" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod1q3" value= 0  required>Falso</input>
  
   <br><br>
  
   <p>Questão 04 –  PAPEIS DE TRABALHO</p>
   <p>A aula que trata dos papéis de trabalho especifica que o Sefinnet somente apresentará as Ordens de Serviço do Auditor Fiscal se já existir Termo de Início de Fiscalização e tenha data inferior a 180 dias.

</p>
  <input type="radio"  name="mod1q4" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod1q4" value= 0 required>Falso</input>
  
     <br><br>
  
   <p>Questão 05 – GERAL</p>
   <p> Não é verdade que a tela que aparece quando se clica na sequência “Relatórios Fiscais → Atividades Fiscais” mostra os comandos mais importantes para fiscalização, como Atividades Fiscais Externas, Autos de Infração, Intimação, Termos variados, Ficha de Atendimento, Histórico do Contribuinte, entre outros.
</p>
  <input type="radio"  name="mod1q5" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod1q5" value= 0 required>Falso</input>
  
       <br><br>
  
   <p>Questão 06 – TIF</p>
   <p> Para cientificar o sujeito passivo sobre o Termo de Início de Fiscalização – TIF, o auditor fiscal pode fazê-lo presencialmente. Neste caso, não será necessário anexar foto de documento, somente informar a data da ciência do TIF de forma manual
</p>
  <input type="radio"  name="mod1q6" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod1q6" value= 0 required>Falso</input>
  
  <br>
  <br>
  
  <input type="submit" value="Terminar Questionário" style="background-color:#BEBEBE;">

</form>

';

$questoesModulo2 ='

 <form action="../banco/questionario_fiscalizacao.php" method ="post" >
<input type="hidden" name="modulo" value="'.$modulo.'" />
<input type="hidden" name="idUsuario" value="'.$idUsuario.'" />

<h3><span style="color:red"> <u>IMPORTANTE</u> </span>: Você terá <u>três</u> tentativas para atingir ao menos 70% de acertos no questionário.  Não atingindo aproveitamento mínimo, o servidor deverá passar por reciclagem com o gerente Alexandre Duarte.</h3>


<p>Questão 01</p>
   <p> O CNAE - Classificação Nacional de Atividades Econômicas – é uma forma de padronização das atividades econômicas no país, em códigos, a fim de facilitar o enquadramento de empresas, instituições públicas, organizações sem fins lucrativos e, até mesmo, profissionais autônomos. O objetivo é facilitar a categorização dos cadastros e registros da administração pública.
    Para o setor de Construção Civil, o Sefinnet possibilita a configuração do CNAE para GIF ST PF por meio da aba “Relatório Fiscal → Construção Civil”.
</p>
  <input type="radio"  name="mod2q1" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod2q1" value= 0 >Falso</input>

  <br><br>

  <p>Questão 02</p>
   <p> O Sefinnet possibilita também conhecer as declarações vinculadas à matrícula CEI. É verdade que basta inserir o código da matrícula CEI e clicar em pesquisar que as informações estarão em seguida na tela.
</p>
  <input type="radio"  name="mod2q2" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod2q2" value= 0 >Falso</input>

<br>
  <br>
 <input type="submit" value="Terminar Questionário" style="background-color:#BEBEBE;">
</form>
';


$questoesModulo3 ='

<form action="../banco/questionario_fiscalizacao.php" method ="post" >

<h3><span style="color:red"> <u>IMPORTANTE</u> </span>: Você terá <u>três</u> tentativas para atingir ao menos 70% de acertos no questionário.  Não atingindo aproveitamento mínimo, o servidor deverá passar por reciclagem com o gerente Alexandre Duarte.</h3>

<input type="hidden" name="modulo" value="'.$modulo.'" />
<input type="hidden" name="idUsuario" value="'.$idUsuario.'" />
    
  <h4>AULA 1 – PLANEJAMENTO ESTRATÉGICO</h4>
  <p>Questão 01</p>
  <p>A tarefa da administração consiste em interpretar os objetivos propostos pela instituição e traduzi‐los em ação por meio de planejamento, organização, direção e controle de todos os esforços, em todas as áreas e níveis da empresa ou órgão público, a fim de atingir os objetivos da melhor maneira.
</p>
  <input type="radio" name="mod3q1" value= 1 required>Verdadeiro</input>
  <input type="radio" name="mod3q1" value= 0 required>Falso</input>
  
  <br>
  
   <p>Questão 02</p>
   <p>O planejamento é uma das funções mais importantes para as organizações, no entanto, é necessário também que sejam implementados os processos para garantir que os objetivos  sejam alcançados. Esta etapa é conhecida como “controle” ou “acompanhamento” e ocorre ao longo de toda a execução do planejamento, em especial, no caso da GFIS, por meio de reuniões de acompanhamento ou realinhamento dos projetos de fiscalização.
</p>
  <input type="radio"  name="mod3q2" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q2" value= 0 required>Falso</input>
  
   <br>
  
   <p>Questão 03</p>
   <p>No contexto do planejamento estratégico, tem-se o pensamento estratégico que constitui a parte criativa, o pensar não analítico que envolve o conhecimento, a busca pelo consenso, a iniciativa e o impulso para o planejar. Também esta relacionado com adaptação a um ambiente mutável, portanto sujeito a incerteza a respeito dos eventos. Assim, a conclusão e a decisão mais correta é evitar o planejamento e esperar que a mão invisível do improviso formule o melhor caminho a ser tomado.
</p>
  <input type="radio"  name="mod3q3" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q3"   value= 0 required>Falso</input>
  
   <br>
  
   <p>Questão 04</p>
   <p>Enquanto o planejamento tático é voltado para toda a organização e é de longo prazo, o planejamento estratégico envolve apenas determinados setores e abrange o curto prazo.

</p>
  <input type="radio"  name="mod3q4" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q4" value= 0 required>Falso</input>
  
     <br>
  
   <p>Questão 05</p>
   <p>  Na análise da matriz SWOT, outra excelente ferramenta utilizada, a formulação da estratégia leva em consideração as ameaças e as oportunidades, que são fatores externos de criação de valor, bem como as forças e as fraquezas, que são fatores internos de criação de valor.
</p>
  <input type="radio"  name="mod3q5" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q5" value= 0 required>Falso</input>
  
       <br>
  
   <p>Questão 06</p>
   <p> A missão organizacional é um norteador estratégico direcionado para o futuro e, a partir de sua concepção, são elaborados planos para se atingir aquilo que ela idealiza.
</p>
  <input type="radio"  name="mod3q6" value= 1 required >Verdadeiro</input>
  <input type="radio"  name="mod3q6" value= 0 required>Falso</input>
  
  <br>
  
  
   <p>Questão 07</p>
   <p>Dentro do planejamento estratégico, o conceito visão representa o que a empresa quer ser no futuro ou que quer se tornar em um horizonte de tempo.
</p>
  <input type="radio"  name="mod3q7" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q7" value= 0 required >Falso</input>
  
  <br>
  
   <p>Questão 08</p>
   <p>O BSC (Balanced Score Card) da Gerência de Fiscalização levou em consideração que se trata de um órgão essencialmente público, assim sendo, a perspectiva “financeira” (que é o padrão utilizado na iniciativa privada) foi substituída por “resultados”, representados pelos projetos escolhidos como principais a serem trabalhados ao longo de dois anos.
</p>
  <input type="radio"  name="mod3q8" value= 1 required >Verdadeiro</input>
  <input type="radio"  name="mod3q8" value= 0 required>Falso</input>
  
  <br>
  
  
   <p>Questão 09</p>
   <p> Planejamento é o processo consciente e sistemático de tomar decisões sobre objetivos e atividades que uma pessoa, um grupo, uma unidade de trabalho ou uma organização. Planejamento não constitui uma resposta informal ou casual, mas sim um processo formal, com etapas importantes que devem ser seguidas. Uma correta sequência de etapas do planejamento pode ser descrita como: definição da missão/visão/valores; diagnóstico estratégico; implementação e controle e, por fim, aplicação da matriz SWOT/desdobramento dos objetivos e metas em um plano de ação.
</p>
  <input type="radio"  name="mod3q9" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q9" value= 0 required>Falso</input>
  
  <br>
  
  
   <p>Questão 10</p>
   <p>Muitas organizações têm feito um bom planejamento, entretanto, em alguns casos, a execução dos planos acaba não acontecendo, em decorrência da ausência de princípios específicos. Desta forma, é necessário que o planejamento siga alguns desses princípios, como planejamento participativo, integrado e imprevisível, entre outros.
</p>
  <input type="radio"  name="mod3q10" value= 1 required>Verdadeiro</input>
  <input type="radio"  name="mod3q10" value= 0 required>Falso</input>
  
  <br>

  <h4>AULA 2 – COMUNICAÇÃO POSITIVA</h4>

<p>Questão 11</p>

<p>Os ruídos na comunicação nada mais são do que qualquer elemento que interfira no processo da transmissão de uma mensagem de um emissor para um receptor. Como, por exemplo, temos preconceito, distorção, sobrecarga de informações e feedbacks.</p>

<input type="radio" name="mod3q11" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q11" value= 0 required>Falso</input>

<p>Questão 12</p>

<p>A linguagem utilizada no processo de comunicação independe dos interesses e das necessidades da pessoa a quem se transmite alguma informação.</p>

<input type="radio" name="mod3q12" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q12" value= 0 required>Falso</input>

<p>Questão 13 </p>

<p>O importante na comunicação de retorno (feedback) é descrever e avaliar o problema de forma a auxiliar as pessoas em uma ajuda mútua para mudança.</p>

<input type="radio" name="mod3q13" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q13" value= 0 required>Falso</input>

<p>Questão 14</p>

<p>Na comunicação com os contribuintes, é recomendado o uso de gírias e jargões técnicos caso possibilite um melhor entendimento do problema.</p>

<input type="radio" name="mod3q14" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q14" value= 0 required>Falso</input>


<p>Questão 15</p>

<p>A comunicação não verbal é importante, pois reforça o que está sendo falado através do comportamento e da linguagem corporal.</p>

<input type="radio" name="mod3q15" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q15" value= 0 required>Falso</input>


<p>Questão 16</p>

<p>Numa reunião considerada produtiva, espera-se que cada um fale tudo o que precisar, sem consciência do tempo e do assunto, afinal o que importa é a clareza. Além disso, numa boa reunião não deve ser utilizada pauta ou roteiro, nem proposição de prazos para cumprimento de metas e ações, pois, sendo assim, delimitaria demasiadamente a criatividade do grupo.</p>

<input type="radio" name="mod3q16" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q16" value= 0 required>Falso</input>

<p>Questão 17</p>

<p>Os relacionamentos, as amizades e as conexões de um indivíduo podem atrapalhar sua vida profissional, por este motivo, recomenda-se ser assertivo e evitar se comunicar.</p>

<input type="radio" name="mod3q17" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q17" value= 0 required>Falso</input>

<p>Questão 18</p>

<p>De acordo com a tríade da comunicação positiva apresentada na aula, a autoconfiança se traduz em diminuir a insegurança para que se tenha maior clareza nos argumentos, sem misturá-los e nem perder a linha de raciocínio.</p>

<input type="radio" name="mod3q18" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q18" value= 0 required>Falso</input>

<p>Questão 19</p>

<p>Comunicação é a troca de informações, ideias e sentimentos. É, ainda, um processo que mantém os indivíduos em contato permanente, propiciando a interação. Evitar interpretações, desculpar-se e ouvir com atenção podem ser formas de melhorar a comunicação.</p>

<input type="radio" name="mod3q19" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q19" value= 0 required>Falso</input>

<p>Questão 20</p>

<p>Podemos considerar como as formas mais adequadas de avaliação e reconhecimento (feedback) de um colega a utilização do whatsapp ou do silêncio (este último, a pessoa deverá interpretar por conta própria o que se pensa e o que se espera dela).</p>

<input type="radio" name="mod3q20" value= 1 required>Verdadeiro</input>
<input type="radio" name="mod3q20" value= 0 required>Falso</input>

<br>
  <br>

   <input type="submit" value="Terminar Questionário" style="background-color:#BEBEBE;">
  
</form>

';
//simples nacional
$questoesModulo4 ='

 <form action="../banco/questionario_fiscalizacao.php" method ="post" >
<input type="hidden" name="modulo" value="'.$modulo.'" />
<input type="hidden" name="idUsuario" value="'.$idUsuario.'" />

<h3><span style="color:red"> <u>IMPORTANTE</u> </span>: Você terá <u>três</u> tentativas para atingir ao menos 70% de acertos no questionário.  Não atingindo aproveitamento mínimo, o servidor deverá passar por reciclagem com o gerente Alexandre Duarte.</h3>


<p>Questão 01</p>
   <p> Na função “Divergências DAS x NFE” existe para que se possa observar a diferença entre os recolhimentos do DAS (documento de arrecadação do Lucro Presumido) em relação às Notas Fiscais Eletrônicas emitidas pelo prestador de Serviço..
</p>
  <input type="radio"  name="mod4q1" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q1" value= 0 >Falso</input>

  <br><br>

  <p>Questão 02</p>
   <p> Para observar as Divergências DAS x NFE, você deve clicar em “Relatório Fiscal” e em seguida “Simples Nacional”.
</p>
  <input type="radio"  name="mod4q2" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q2" value= 0 >Falso</input>

  <br><br>

  <p>Questão 03</p>
   <p> A tela que irá se abrir após clicar em Divergências DAS x NFE mostrará a opção para escolher o contribuinte com seus dados de cadastro.
</p>
  <input type="radio"  name="mod4q3" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q3" value= 0 >Falso</input>

  <br><br>

    <p>Questão 04</p>
   <p> Após colocar o CPF ou CNPJ do contribuinte no filtro existente no sistema, o Sefinnet não irá exibir nenhum relatório útil ao Auditor, tendo que, portanto, abrir um chamado específico para identificar a divergência.
</p>
  <input type="radio"  name="mod4q4" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q4" value= 0 >Falso</input>

  <br><br>


    <p>Questão 05</p>
   <p> Existe uma forma de visualizar a lista de atividades, clicando em “Confi. Atividades”. Ali é apresentada uma lista com a descrição das atividades de prestação de serviço.
</p>
  <input type="radio"  name="mod4q5" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q5" value= 0 >Falso</input>

  <br><br>

    <p>Questão 06</p>
   <p> O CIGA (Consórcio de Informática na Gestão Pública Municipal) é um consórcio público, fundado em 2007 pela Federação Catarinense de Municípios – FECAM, com o propósito de desenvolver soluções para o aperfeiçoamento da gestão pública, usando a tecnologia da informação. Ele está integrado ao Sefinnet para fornecer informações de PF e PJ.
</p>
  <input type="radio"  name="mod4q6" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q6" value= 0 >Falso</input>

  <br><br>

   <p>Questão 07</p>
   <p>Para gerar arquivos de integração com o CIGA, você deve clicar em “Relatório Fiscal” e em seguida “Infográfico”.
</p>
  <input type="radio"  name="mod4q7" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q7" value= 0 >Falso</input>

  <br><br>

   <p>Questão 08</p>
   <p> A tela que irá se abrir para coleta das informações apresenta duas opções: “Arquivo de Informações sobre Pessoa Jurídica” e “Arquivo de Informações sobre Pessoa Física”.
</p>
  <input type="radio"  name="mod4q8" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q8" value= 0 >Falso</input>

  <br><br>

   <p>Questão 09</p>
   <p> Clicando em qualquer uma das duas opções, bastará aguardar a geração automática dos arquivos em formato JPEG.
</p>
  <input type="radio"  name="mod4q9" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q9" value= 0 >Falso</input>

  <br><br>

   <p>Questão 10</p>
   <p> É de relevante importância para as atividades da Gerência de Fiscalização obter a informação sobre se o sujeito passivo é optante do Simples Nacional e em quais períodos isso ocorreu.
</p>

  <input type="radio"  name="mod4q10" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q10" value= 0 >Falso</input>

  <br><br>

     <p>Questão 11</p>
   <p> Às informações do sujeito passivo podem ser obtidas pela inserção dos dados pessoais no campo apropriado, inclusive número do título de eleitor.
</p>

  <input type="radio"  name="mod4q11" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q11" value= 0 >Falso</input>

  <br><br>

     <p>Questão 12</p>
   <p> Caso o sujeito passivo tenha sido optante num determinado mês, ele aparecerá na tela na cor verde. Se não for optante, aparecerá na cor cinza.
</p>

  <input type="radio"  name="mod4q12" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q12" value= 0 >Falso</input>

  <br><br>


     <p>Questão 13</p>
   <p> Há ainda a possibilidade de que não constem informações sobre o sujeito passivo, neste caso a legenda será da cor vermelha, que significa que não existem informações.
</p>

  <input type="radio"  name="mod4q13" value= 1 >Verdadeiro</input>
  <input type="radio"  name="mod4q13" value= 0 >Falso</input>

  <br><br>


<br>
  <br>
 <input type="submit" value="Terminar Questionário" style="background-color:#BEBEBE;">
</form>
';

?>