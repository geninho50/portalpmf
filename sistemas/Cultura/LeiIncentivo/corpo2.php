<!doctype html>
<html lang='pt-BR'>

  <head>
    <meta charset="UTF-8">
</head>

<body>

<div id="item1" style="display:none;" >
    <div class="containers">
         <table class="table table-striped">
            <h1>A.1. IDENTIFICA&Ccedil;&Atilde;O DO CANDIDATO</h1>
            <th style="width:200px">CPF<input id="a1cpf" class="form-control field" type="text"></th>
            <th style="width:200px">RG<input id="a1rg" class="form-control field" type="text"></th>
            <th>NOME COMPLETO<input id="a1nome" class="form-control field" type="text"/></th>
         </table>
         <table class="table table-striped">
            <th>PROFISS&Atilde;O<input id="a1profissao" class="form-control field" type="text"/></th>
            <th>ENDERE&Ccedil;O<input id="a1endereco" class="form-control field" type="text"/></th>
        </table>
        <table class="table table-striped">
            <th>BAIRRO<input id="a1bairro" class="form-control field" type="text"/></th>
            <th>CEP<input id="a1cep" class="form-control field" type="text"/></th>
            <th>MUNIC&Iacute;PIO: FLORIAN&Oacute;POLIS</th>
        </table>
        <table class="table table-striped">
            <th>TELEFONE RESIDENCIAL<input id="a1fone1" class="form-control field" type="text"/></th>
            <th>CELULAR<input id="a1fone2" class="form-control field" type="text"/></th>
            <th>E-MAIL<input id="a1email" class="form-control field" type="text"/></th>
        </table>
        <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
        </div>
    </div>
</div>

<div id="item2" style="display:none;">
    <div class="containers">
      <table class="table table-striped">
        <h1>A.2. DADOS DO PROPONENTE: PESSOA JUR&Iacute;DICA</h1>
        <th style="width:200px">CNPJ<input id="a2cnpj" class="form-control field" type="text"></th>
        <th style="width:200px">CMC<input id="a2cmc" class="form-control field" type="text"></th>
        <th>RAZ&Atilde;O SOCIAL<input id="a2razao" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>RAMO DE ATIVIDADE<input id="a2ramo" class="form-control field" type="text"/></th>
        <th>ENDERE&Ccedil;O COMERCIAL<input id="a2endereco" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>BAIRRO<input id="a2bairro" class="form-control field" type="text"/></th>
        <th>CEP<input id="a2cep" class="form-control field" type="text"/></th>
        <th>MUNIC&Iacute;PIO: FLORIAN&Oacute;POLIS</th>
        </table>
      <table class="table table-striped">
        <th>TELEFONE<input id="a2fone1" class="form-control field" type="text"/></th>
        <th>CELULAR<input id="a2fone2" class="form-control field" type="text"/></th>
        <th>E-MAIL<input id="a2email" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>OBJETIVOS ESTATU&Aacute;RIOS<textarea id="a2objetivos" class="form-control field" row="4" type="text area"></textarea></th>
        </table>
      <table class="table table-striped">
       	<h2>DIRIGENTE DA INSTITUI&Ccedil;AO PROPONENTE/RESPONS&Aacute;VEL PELO PROJETO</h2>
        <th style="width:200px">CPF<input id="a2cpf" class="form-control field" type="text"></th>
        <th style="width:200px">RG<input id="a2rg" class="form-control field" type="text"></th>
        <th>NOME COMPLETO<input id="a2nome" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>TELEFONE RESIDENCIAL<input id="a2fone1responsa" class="form-control field" type="text"/></th>
        <th>CELULAR<input id="a2fone2responsa" class="form-control field" type="text"/></th>
        <th>E-MAIL<input id="a2emailresponsa" class="form-control field" type="text"/></th>
        </table>
      <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
        </div>
    </div>
</div>

<div id="item3" style="display:none;">
    <div class="containers">
      <table class="table table-striped">
        <h1>A.3. DADOS BANC&Aacute;RIOS DO PROPONENTE PESSOA F&Iacute;SICA OU JUR&Iacute;DICA</h1>
      <table class="table table-striped">
        <th>AGENTE BANC&Aacute;RIO (BANCO)<input id="a31" class="form-control field" type="text"/></th>
        <th>N&Uacute;MERO DO AGENTE BANC&Aacute;RIO<input id="a32" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>NOME DA AG�NCIA BANC&Aacute;RIA<input id="a33" class="form-control field" type="text"/></th>
        <th>N&Uacute;MERO DA AG&Ecirc;NCIA BANC&Aacute;RIA<input id="a34" class="form-control field" type="text"/></th>
        <th>ENDERE�O DA AG&Ecirc;NCIA BANC&Aacute;RIA<input id="a35" class="form-control field" type="text"/></th>
        </table>
      <table class="table table-striped">
        <th>BAIRRO<input id="a3bairro" class="form-control field" type="text"/></th>
        <th>CEP<input id="a3cep" class="form-control field" type="text"/></th>
        <th>MUNIC&Iacute;PIO: FLORIAN&Oacute;POLIS</th>
        </table>
      <table class="table table-striped">
        <th>TELEFONE RESIDENCIAL<input id="a3fone1" class="form-control field" type="text"/></th>
        <th>CELULAR<input id="a3fone2" class="form-control field" type="text"/></th>
        <th>E-MAIL<input id="a3email" class="form-control field" type="text"/></th>
        </table>
        <table class="table table-striped">
        <th>CONTATO DA AG&Ecirc;NCIA<input id="a3contatoAg" class="form-control field" type="text"/></th>
        <th>DDD/TELEFONE<input id="a3foneAg" class="form-control field" type="text"/></th>
        </table>
      <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
        </div>
    </div>
</div>

<div id="item10" style="display:none;">
<div class="containers">
    <h1>B. DADOS RESUMIDOS DO PROJETO</h1>
  <table class="table table-striped">
    
    <th>B.1. NOME DO PROJETO<input id="b1nome" class="form-control field" type="text"></th>
  </table><br>


  <table class="table table-striped">
    <th>B.2. MODALIDADE DE INCENTIVO FISCAL</th>
    </table>
	<label>Com base no Artigo 2&ordm;, Incisos III, IV e V do Decreto Municipal N&ordm;5207/07 que regulamenta a Lei N&ordm;3659/9 e Normativa N&ordm; 012/FCFFC/2014.</label><br><br>
  <div class="row">
        <label class="col-md-4">
            <input type="radio" name="b2modalidade" id="b2modalidade" value="1" > DOA&Ccedil;&Atilde;O
            </label>
        <label class="col-md-4">
            <input type="radio" name="b2modalidade" id="b2modalidade" value="2" > PATROC&Iacute;NIO
            </label>
        <label class="col-md-4">
            <input type="radio" name="b2modalidade" id="b2modalidade" value="3" > INVESTIMENTO
            </label>
  </div><BR><BR>    

   <table class="table table-striped">
     <th>B.3. SETOR(ES)/ (&Aacute;REA(S) CULTURAL(IS) QUE O PROJETO CONTEMPLA</th>
   </table>
      <div class="row">
        <label class="col-md-4">
            <input type="checkbox" name="b31" class="b3"> M&Uacute;SICA E DAN&Ccedil;A 
            </label>
        <label class="col-md-4">
            <input type="checkbox" name="b32" class="b3"> TEATRO E CIRCO
            </label>            
        <label class="col-md-4">
            <input type="checkbox" name="b33" class="b3"> LITERATURA
            </label>
        <label class="col-md-4">
            <input type="checkbox" name="b34" class="b3"> ARTES PL&Aacute;STICAS, ARTES GR&Aacute;FICAS E FILATERIA
            </label>
        <label class="col-md-4">
            <input type="checkbox" name="b35" class="b3"> FOLCLORE E ARTESANATO
            </label>
         <label class="col-md-4">
            <input type="checkbox" name="b36" class="b3"> CINEMA, FOTOGRAFIA E V&Iacute;DEO
            </label>
         <label class="col-md-12">
            <input type="checkbox" name="b37" class="b3"> ACERVO E PATRIM&Ocirc;NIO HIST&Oacute;RICO E CULTURAL, MUSEUS E CENTROS  CULTURAIS
            </label>
		 </div><br><br>

  <table class="table table-striped">
      <th>B.4. PRODUTO</th>
    </table>
	<label>Descrever brevemente o Projeto pretende realizar (identificar o produto cultural).</label>
	<textarea id="b4" class="form-control field" row="" type="text area"></textarea><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>
</div>

<div id="item14" style="display:none;">
<div class="containers">
  <table class="table table-striped">
    <h1>B. DADOS RESUMIDOS DO PROJETO</h1>
      <th>B.5. REALIZA&Ccedil;&Atilde;O</th>
    </table>
    <label>Informar as a&ccedil;&otilde;es principais do Projeto, quando e onde ser&atilde;o realizadas</label>
    <label class="col-md-6">A&Ccedil;&Atilde;O <input id="b5acao1" class="form-control field" type="text"/><input id="b5acao2" class="form-control field" type="text"/></label>
    <label class="col-md-6">LOCAL DE REALIZA&Ccedil;&Atilde;O <input id="b5local1" class="form-control field" type="text"/><input id="b5local2" class="form-control field" type="text"/>
    </label>
    <br><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


<div id="item15" style="display:none;">
<div class="containers">
  <table class="table table-striped">
    <h1>B. DADOS RESUMIDOS DO PROJETO</h1>
      <th>B.6. PREVIS&Atilde;O GERAL DE EXECU&Ccedil;&Atilde;O DE TODO O PROJETO</th>
    </table>  
    <label class="col-md-6">IN&Iacute;CIO EM<input id="b6inicio" class="form-control field" type="date"/></label>
    <label class="col-md-6">T&Eacute;RMINO EM<input id="b6termino" class="form-control field" type="date"/></label><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


<div id="item16" style="display:none;">
<div class="containers">
  <table class="table table-striped">
    <h1>B. DADOS RESUMIDOS DO PROJETO</h1>
      <th>B.7. RESUMO GERAL DOS RECURSOS PREVISTOS</th>
    </table>  
    <label class="col-md-6">VIA LEI DE INCENTIVO<input id="b7valor1" class="form-control field" type="text"/></label>
    <label class="col-md-6">OUTROS MECANISMOS DE INCENTIVO<input id="b7valor2" class="form-control field" type="text"/></label>
    <label class="col-md-6"><font color="#CC0000">LIMITE M&Aacute;XIMO por Projeto: R$ 200.000,00 (duzentos mil reais)</font></label>
    <label class="col-md-6"><font color="#CC0000"> Juntar 01 (uma) C&oacute;pia do(s) Projeto(s) e seu(s) Protocolo(s)</font></label>
    <br><br><br><br><br><br>

    <label class="col-md-6">OUTROS APORTES FINANCEIROS<input id="b7valor3" class="form-control field" type="text"/></label>
    <label class="col-md-6">VALOR TOTAL DO PROJETO<input id="b7valor4" class="form-control field" type="text"/></label>
    <label class="col-md-6"><font color="#CC0000">Juntar 01 (uma) C&oacute;pia do(s) Projeto(s) e seu(s) Protocolo(s)</font></label>
    <br><br><br><br><br><br>

    <label class="col-md-6">PREVIS&Atilde;O DE RECEITA: <input id="b7valor5" class="form-control field" type="text"/></label>
    <br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>

<div id="item20" style="display:none;">
    <div class="containers">
        <table class="table table-striped">
        <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>

        <table class="table table-striped">
        <th>C.1. DESCREVER A JUSTIFICATIVA</th>
        </table>

        <label>Explicar a necessidade de realiza&ccedil;&atilde;o do Projeto e sua relev&acirc;ncia cultural, justificando a necessidade do incentivo para a consolida&ccedil;&atilde;o dos resultados previstos.</label>
        <textarea id="c1" class="form-control field" row="4" type="text area"></textarea>
        <div align="right">
            <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
        </div>
    </div>
</div>


    <div id="item21" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.2. PRODUTO PRINCIPAL </th>
	</table>
	<label>Descrever o produto principal detalhadamente a ser desenvolvido e produtos complementares (se houver).</label>
	<textarea id="c2" class="form-control field" row="4" type="text area"></textarea>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    <div id="item22" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.3. OBJETIVOS</th>
	</table>
	<label>Descrever os objetivos gerais e espec&iacute;ficos que pretende alcan&ccedil;ar.</label>
	<textarea id="c3" class="form-control field" row="4" type="text area"></textarea>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    
    <div id="item23" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.4. CONCESS&Atilde;O DE DIREITOS AUTORAIS</th>
	</table>
	<label>Descrever os direitos autorais (se houver) e apresentar&ccedil;&atilde;o e documentos em anexo.</label>
	<textarea id="c4" class="form-control field" row="4" type="text area"></textarea>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    <div id="item24" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th >C.5. RECURSOS HUMANOS ENVOLVIDOS </th>
	</table>
	<label>Descrever os principais recursos humanos envolvidos, suas fun&ccedil;&otilde;es vinculados ao objeto (como atores, professores, artistas, coordenadores, produtores, outros) e tempo previsto em horas trabalhadas.</label>

	<table class="table table-striped" id="tableRHE" >
	<tr>    
	<th style="width:350px">Nominar pessoa e/ou fun&ccedil;&atilde;o</th>
	<th style="width:350px">Detalhamento da Fun&ccedil;&atilde;o</th>
	<th style="width:150px">Carga Hor&aacute;ria</th>
	<th style="width:150px">Opera&ccedil;&atilde;o - <input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('RHE');" /></th>
	</tr>
	<tr>
	<td style="width:350px"><input id="c51[]" class="form-control field" type="text"></td>
	<td style="width:350px"><input id="c52[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="c53[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLine(0, 'RHE');" /></td>
	</tr>
	</table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    <div id="item25" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.6. PERFIL E ESTIMATIVA DE P&Uacute;BLICO ALVO</th>
	</table>
	<label>Caracterizar o p&uacute;blico que o Projeto pretende atender e quantificar o p&uacute;blico beneficiado diretamente.</label>
	<textarea id="c6" class="form-control field" row="4" type="text area"></textarea><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>



    <div id="item26" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.7. PLANO DE A&Ccedil;&Atilde;O E CRONOGRAMA DE EXECU&Ccedil;&Atilde;O</th>
	</table>
	<label>Detalhar as a&ccedil;&otilde;es previstas para o alcance dos objetivos e o tempo necess&aacute;rio para sua execu&ccedil;&atilde;o.</label>

	<table class="table table-striped" id="tablePACE1" >
	<tr>    
	<th style="width:350px">Per&iacute;odo de Execu&ccedil;&atilde;o</th>
	<th style="width:350px">Pr&eacute;-Produ&ccedil;&atilde;o</th>
	<th style="width:150px">Custo da Realiza&ccedil;&atilde;o</th>
	<th style="width:150px">Opera&ccedil;&atilde;o - <input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PACE1');" /></th>
	</tr>
	<tr>
	<td style="width:350px"><input id="c7Pre1[]" class="form-control field" type="text"></td>
	<td style="width:350px"><input id="c7Pre2[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="c7Pre3[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 2);" /></td>
	</tr>
	</table>

	<table class="table table-striped" id="tablePACE2" >
	<tr>    
	<th style="width:350px">Per&iacute;odo de Execu&ccedil;&atilde;o</th>
	<th style="width:350px">Produ&ccedil;&atilde;o</th>
	<th style="width:150px">Custo da Realiza&ccedil;&atilde;o</th>
	<th style="width:150px">Opera&ccedil;&atilde;o - <input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PACE2');" /></th>
	</tr>
	<tr>
	<td style="width:350px"><input id="c7Pro1[]" class="form-control field" type="text"></td>
	<td style="width:350px"><input id="c7Pro2[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="c7Pro3[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 3);" /></td>
	</tr>
	</table>

	<table class="table table-striped" id="tablePACE3" >
	<tr>    
	<th style="width:350px">Per&iacute;odo de Execu&ccedil;&atilde;o</th>
	<th style="width:350px">P&oacute;s-Produ&ccedil;&atilde;o</th>
	<th style="width:150px">Custo da Realiza&ccedil;&atilde;o</th>
	<th style="width:150px">Opera&ccedil;&atilde;o - <input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PACE3');" /></th>
	</tr>
	<tr>
	<td style="width:350px"><input id="c7Pos1[]" class="form-control field" type="text"></td>
	<td style="width:350px"><input id="c7Pos2[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="c7Pos3[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 4);" /></td>
	</tr>
	</table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    <div id="item27" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.8. PLANO DE DISTRIBUI&Ccedil;&Atilde;O</th>
	</table>
	<label>Definir a distribui&ccedil;&atilde;o dos produtos culturais respeitando os seguintes crit&eacute;rios: 10% para proponentes; 10% para incentivadores do projeto; 10% para organizadores/autores; 20% para FCFFC; 50% para p&uacute;blico em geral, sendo que, no caso de livros, CD's, DVD's e cat&aacute;logos priorizar o m&iacute;nimo de 30% para bibliotecas. Todas as entregas devem ser acompanhadas de recibo identificado.</label>
	<textarea id="c8" class="form-control field" row="4" type="text area"></textarea><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


    <div id="item28" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.9. PLANO DE DIVULGA&Ccedil;&Atilde;O</th>
	</table>
	<label>Citar os meios para a divulga&ccedil;&atilde;o do projeto, tais como cartazes, folhetos, flyers, convites, outdoors, folders, faixas, bussdors, malas diretas, blogs, m&iacute;dias impressas, inser&ccedil;&otilde;es em r&aacute;dios e televis&otilde;es, camiseta, entre outros e detalhar medidas, materiais utilizados e quantidades.</label><br>

	<table class="table table-striped" id="tablePD" >
	<tr>    
	<th style="width:20%">M&iacute;dias</th>
	<th style="width:50%">Especifica&ccedil;&otilde;es</th>
	<th style="width:15%">Quantidades</th>
	<th style="width:15%">Opera&ccedil;&atilde;o <input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
	</tr>
	<tr>
	<td style="width:350px"><input id="c91[]" class="form-control field" type="text"></td>
	<td style="width:350px"><input id="c92[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="c93[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
	</tr>
	</table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


 <div id="item29" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.10. DEMONSTRA&Ccedil;&Atilde;O DA REALIZA&Ccedil;&Atilde;O DO PROJETO</th>
	</table>
	<label>Informar como comprovar&aacute; a execu&ccedil;&eacute;o do projeto: Formul&aacute;rio de Presta&ccedil;&atilde;o de contas da Lei de Incentivo; C&oacute;pia de cartaz, flyer, banner, programa; registros fotogr&aacute;ficos; DVD de shows;  VT de divulga&ccedil;&eacute;o na m&iacute;dia televisiva; Outros.</label>
	<textarea id="c10" class="form-control field" row="4" type="text area"></textarea><br><br>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
</div>
</div>


 <div id="item210" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>C. DETALHAMENTO DO PROJETO - APRESENTA&Ccedil;&Atilde;O</h1>
	<table class="table table-striped">
	<th>C.11. PRESTA&Ccedil;&Atilde;O DE CONTAS</th>
	</table>
	<label>Entregar a Presta&ccedil;&atilde;o de Contas no prazo de 60 (sessenta) dias ap&oacute;s a data de finaliza&ccedil;&atilde;o do Projeto conforme descrito no item B.6. deste formul&aacute;rio.</label>
	<textarea id="c11" class="form-control field" row="4" type="text area"></textarea><br><br>


	<table class="table table-striped">
	<th>ENTREGA PARA AN&Aacute;LISE DA FCFFC, EM: 
	<?php
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('d-m-Y');
     echo "<span style=\"color:red;\">$date</span><BR>";

	?></th>
	</table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
    </div>
	</div>




	<div id="item30" style="display:none;">
	<div class="containers">
	<table class="table table-striped">
	<h1>D. OR&Ccedil;AMENTOS</h1>

	<table class="table table-striped">
	<th>D.1. OR&Ccedil;AMENTOS DOS RECURSOS VIA LEI DE INCENTIVO</th>
	</table>
	<label>Coluna A: Informar o detalhamento de maneira clara de cada item e subitem.</label>
	<label>Coluna B: Informar a quantidade necess&aacute;ria de pessoas ou material. Ex: diretor, passagem a&eacute;rea, etc.</label>
	<label>Coluna C: Informar a unidade de medida relativa &agrave; quantidade. Ex: horas, metros, servi&ccedil;o, verba, etc.</label>
	<label>Coluna D: Informar pre&ccedil;o unit&aacute;rio de cada item. Ex: 01 camiseta, 01 contador, 01 flyer, etc.</label>
	<label>Coluna E: Informar o pre&ccedil;o multiplicando o valor unit&aacute;rio pela quantidade (coluna B x coluna D = coluna E).</label>

<br><br>

	<table class="table table-striped">
	<th>D.1.1. PR&Eacute;-PRODU&Ccedil;&Atilde;O</th>
	</table>
	
	<table class="table table-striped" id="tablePD" >
	<tr>    
	<th style="width:20%">A</th>
	<th style="width:20%">B</th>
	<th style="width:20%">C</th>
	<th style="width:20%">D</th>
	<th style="width:20%">E</th>

	<tr>    
	<th style="width:20%">Itens e Subitens de Despesa</th>
	<th style="width:20%">Quantidade</th>
	<th style="width:20%">Unidade de Medida</th>
	<th style="width:20%">Valor por Unidade(R$)</th>
	<th style="width:20%">Valor Total</th>
	</tr>
	<tr>
	<td style="width:150px"><input id="d11A[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d11B[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d11C[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input id="d11D[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d11E[]" class="form-control field" type="text"></td>
	<th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
	<td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
	</tr>

	</table>

	<table class="table table-striped">
	<th>Total Recursos: Pr&eacute;-Produ&ccedil;&atilde;o R$: 
	<?php
	/*$total = d11E[];
	echo $total;*/

	?></th>
	</table>




<br>

	<table class="table table-striped">
	<th>D.1.2. PRODU&Ccedil;&Atilde;O</th>
	</table>
	
	<table class="table table-striped" id="tablePD" >
	<tr>    
	<th style="width:20%">A</th>
	<th style="width:20%">B</th>
	<th style="width:20%">C</th>
	<th style="width:20%">D</th>
	<th style="width:20%">E</th>

	<tr>    
	<th style="width:20%">Itens e Subitens de Despesa</th>
	<th style="width:20%">Quantidade</th>
	<th style="width:20%">Unidade de Medida</th>
	<th style="width:20%">Valor por Unidade(R$)</th>
	<th style="width:20%">Valor Total</th>
	</tr>
	<tr>
	<td style="width:150px"><input id="d12A[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d12B[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d12C[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input id="d12D[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d12E[]" class="form-control field" type="text"></td>
	<th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
	<td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
	</tr>
	</table>

	<table class="table table-striped">
	<th>Total Recursos: Produ&ccedil;&atilde;o R$: 
	<?php
	/*$total = d12E[];
	echo $total;*/

	?></th>
	</table>

<br>

	<table class="table table-striped">
	<th>D.1.3. P&Oacute;S PRODU&Ccedil;&Atilde;O</th>
	</table>
	
	<table class="table table-striped" id="tablePD" >
	<tr>    
	<th style="width:20%">A</th>
	<th style="width:20%">B</th>
	<th style="width:20%">C</th>
	<th style="width:20%">D</th>
	<th style="width:20%">E</th>

	<tr>    
	<th style="width:20%">Itens e Subitens de Despesa</th>
	<th style="width:20%">Quantidade</th>
	<th style="width:20%">Unidade de Medida</th>
	<th style="width:20%">Valor por Unidade(R$)</th>
	<th style="width:20%">Valor Total</th>
	</tr>
	<tr>
	<td style="width:150px"><input id="d13A[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d13B[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d13C[]" class="form-control field" type="text"/></td>
	<td style="width:150px"><input id="d13D[]" class="form-control field" type="text"></td>
	<td style="width:150px"><input id="d13E[]" class="form-control field" type="text"></td>
	<th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
	<td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
	</tr>
	</table>

	<table class="table table-striped">
	<th >TOTAL DE RECURSOS VIA LEI DE INCENTIVO (D.1.1 + D.1.2 + D.1.3) R$: 
	<?php
	/*$total = d13E[];
	echo $total;*/

	?></th>
	</table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
    </div>
    </div>



   <div id="item31" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>D. OR&Ccedil;AMENTOS</h1>

    <table class="table table-striped">
    <th>D.2. OR&Ccedil;AMENTOS DE TODO O PROJETO - incluindo recyrsos de outros</th>
    </table>
    <label>Coluna A: Informar o detalhamento de maneira clara de cada item e subitem.</label>
    <label>Coluna B: Informar a quantidade necess&aacute;ria de pessoas ou material. Ex: diretor, passagem a&eacute;rea, etc.</label>
    <label>Coluna C: Informar a unidade de medida relativa &agrave; quantidade. Ex: horas, metros, servi&ccedil;o, verba, etc.</label>
    <label>Coluna D: Informar pre&ccedil;o unit&aacute;rio de cada item. Ex: 01 camiseta, 01 contador, 01 flyer, etc.</label>
    <label>Coluna E: Informar o pre&ccedil;o multiplicando o valor unit&aacute;rio pela quantidade (coluna B x coluna D = coluna E).</label>

<br><br>

    <table class="table table-striped">
    <th>D.2.1. PR&Eacute;-PRODU&Ccedil;�O</th>
    </table>
    
    <table class="table table-striped" id="tablePD" >
    <tr>    
    <th style="width:20%">A</th>
    <th style="width:20%">B</th>
    <th style="width:20%">C</th>
    <th style="width:20%">D</th>
    <th style="width:20%">E</th>

    <tr>    
    <th style="width:20%">Itens e Subitens de Despesa</th>
    <th style="width:20%">Quantidade</th>
    <th style="width:20%">Unidade de Medida</th>
    <th style="width:20%">Valor por Unidade(R$)</th>
    <th style="width:20%">Valor Total</th>
    </tr>
    <tr>
    <td style="width:150px"><input id="d21A[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d21B[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d21C[]" class="form-control field" type="text"/></td>
    <td style="width:150px"><input id="d21D[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d21E[]" class="form-control field" type="text"></td>
    <th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
    <td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
    </tr>

    </table>

    <table class="table table-striped">
    <th>Total Recursos: Pr&eacute;-Produ&ccedil;&atilde;o R$: 
    <?php
    /*$total = d11E[];
    echo $total;*/

    ?></th>
    </table>

<br>

    <table class="table table-striped">
    <th>D.2.2. PRODU&Ccedil;&Atilde;O</th>
    </table>
    
    <table class="table table-striped" id="tablePD" >
    <tr>    
    <th style="width:20%">A</th>
    <th style="width:20%">B</th>
    <th style="width:20%">C</th>
    <th style="width:20%">D</th>
    <th style="width:20%">E</th>

    <tr>    
    <th style="width:20%">Itens e Subitens de Despesa</th>
    <th style="width:20%">Quantidade</th>
    <th style="width:20%">Unidade de Medida</th>
    <th style="width:20%">Valor por Unidade(R$)</th>
    <th style="width:20%">Valor Total</th>
    </tr>
    <tr>
    <td style="width:150px"><input id="d22A[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d22B[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d22C[]" class="form-control field" type="text"/></td>
    <td style="width:150px"><input id="d22D[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d22E[]" class="form-control field" type="text"></td>
    <th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
    <td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
    </tr>
    </table>

    <table class="table table-striped">
    <th>Total Recursos: Produ&ccedil;&atilde;o R$: 
    <?php
    /*$total = d12E[];
    echo $total;*/

    ?></th>
    </table>

<br>

    <table class="table table-striped">
    <th>D.2.3. P&Oacute;S PRODU&Ccedil;&Atilde;O</th>
    </table>
    
    <table class="table table-striped" id="tablePD" >
    <tr>    
    <th style="width:20%">A</th>
    <th style="width:20%">B</th>
    <th style="width:20%">C</th>
    <th style="width:20%">D</th>
    <th style="width:20%">E</th>

    <tr>    
    <th style="width:20%">Itens e Subitens de Despesa</th>
    <th style="width:20%">Quantidade</th>
    <th style="width:20%">Unidade de Medida</th>
    <th style="width:20%">Valor por Unidade(R$)</th>
    <th style="width:20%">Valor Total</th>
    </tr>
    <tr>
    <td style="width:150px"><input id="d23A[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d23B[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d23C[]" class="form-control field" type="text"/></td>
    <td style="width:150px"><input id="d23D[]" class="form-control field" type="text"></td>
    <td style="width:150px"><input id="d23E[]" class="form-control field" type="text"></td>
    <th style="width:10%"><input id="btnADD" class="btn btn-success" type="button" value=" + " onclick = "addLine('PD');" /></th>
    <td style="width:10px"><input class="btn btn-danger" type="button"  alt="Excluir" value = " - " onclick ="delLne(0, 'PD');" /></td>
    </tr>
    </table>

    <table class="table table-striped">
    <th >TOTAL DE RECURSOS VIA LEI DE INCENTIVO (D.1.1 + D.1.2 + D.1.3) R$: 
    <?php
    /*$total = d13E[];
    echo $total;*/

    ?></th>
    </table>
    <div align="right">
        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
    </div>
    </div>
    </div>



   <div id="item40" style="display:none;">
    <div class="containers">
    <table class="table table-striped">
    <h1>E. DOCUMENTOS</h1>

	<table class="table table-striped">
    <th>1. DOCUMENTOS OBRIGAT&Oacute;RIOS PARA PROTOCOLIZA&Ccedil;&Atilde;O</th>  
    </table>
        <label>A protocoliza&ccedil;&atilde;o dos projetos ser&aacute; realizada na Diretoria de Projetos da FCFFC, mediante a apresenta&ccedil;&atilde;o de TODOS os seguintes documentos:
        </label> 

<br><br>

    <table class="table table-striped">
    <th>1.1 NO CASO DE PROPONENTE TRATAR-SE DE PESSOA F&Iacute;SICA:</th>  
    </table>
        <label>a) C&oacute;pia de identidade e CPF (autenticados);</label>
        <label>b) C&oacute;pia do comprovante de domic&iacute;lio no munic&iacute;pio de Florian&oacute;polis (&aacute;gua, luz ou telefone), ou contrato de loca&ccedil;&atilde;o ou declara&ccedil;&atilde;o de que reside com familiares (conforme modelo dispon&iacute;vel no Formul&aacute;rio de Inscri&ccedil;&atilde;o), assinado pelo propriet&aacute;rio ou locat&aacute;rio do im&oacute;vel, com firma reconhecida;</label>
        <label>c) Curr&iacute;culo profissional comprovado na &aacute;rea cultural/atua&ccedil;&atilde;o ou forma&ccedil;&atilde;o comprovada na &aacute;rea cultural;</label>
        <label>d) Certid&atilde;o Negativa de D&eacute;bitos Municipal;</label><br>
        <label>e) Certid&atilde;o Negativa de D&eacute;bitos Estadual;</label>
        <label>f) Certid&atilde;o Conjunta de D&eacute;bitos Relativos a Tributos Federais e &agrave; D&iacute;vida Ativa da Uni&atilde;o;</label>
        <label>g) Certid&atilde;o Negativa de D&eacute;bitos Trabalhistas;</label>
        <label>h) Declara&ccedil;&atilde;o que n&atilde;o emprega menor, conforme Art. 7&ordm;, inciso XXXIII da Constitu&ccedil;&atilde;o Federal.</label>

<br><br>

    <table class="table table-striped">
    <th>1.2 NO CASO DE PROPONENTE TRATAR-SE DE PESSOA JUR&Iacute;DICA:</th>  
    </table>
        <label>a) Cart&atilde;o do CNPJ atualizado;</label>
        <label>b) C&oacute;pia do instrumento constitutivo da empresa, suas altera&ccedil;&otilde;es, devidamente consolidadas e registradas;</label>
        <label>c) C&oacute;pia de Identidade e do CPF do dirigente legal pessoa jur&iacute;dica (autenticados);</label>
        <label>d) Prova de inscri&ccedil;&atilde;o regular junto ao Cadastro Municipal de Contribuintes (CMC);</label>
        <label>e) Relat&oacute;rio das a&ccedil;&otilde;es culturais realizadas pela Institui&ccedil;&atilde;o ou curr&iacute;culo dos seus dirigentes na &aacute;rea cultural;</label>
        <label>f) Certid&atilde;o Negativa de D&eacute;bitos Municipal;</label><br>
        <label>g) Certid&atilde;o Negativa de D&eacute;bitos Estadual;</label>
        <label>h) Certid&atilde;o Conjunta de D&eacute;bitos Relativos a Tributos Federais e &agrave; D&iacute;vida Ativa da Uni&atilde;o;</label><br>
        <label>i) Certid&atilde;o Negativa de D&eacute;bitos Trabalhistas;</label><br>
        <label>j) Certificado de Regularidade do FGTS &ndash; CRF;</label>
        <label>k) Declara&ccedil;&atilde;o que n&atilde;o emprega menor, conforme Art. 7&ordm;, inciso XXXIII da Constitui&ccedil;&atilde;o Federal.</label>

    </div>
    </div>
    </div>
    </div>

</body>

    </html>