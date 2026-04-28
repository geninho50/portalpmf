//CRIA A VARIÁVEL RETORNO
var retorno;
function CarregaArquivo(url,dia,mes,ano)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChange;
		retorno.open("GET", url+'?id='+dia+'&mes='+mes+'&ano='+ano, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChange;
			retorno.open("GET", url+'?dia='+dia+'&mes='+mes+'&ano='+ano, true);
			retorno.send();
		}
	}
}

//FUNÇÃO QUE TRATA O RETORNO DO AJAX
function processReqChange()
{
	//CASO O STATUS DO AJAX SEJA OK, CHAMA A FUNÇÃO mudar()
	//A LISTA COMPLETA DOS VALORES readyState É A SEGUINTE:
	//0 (uninitialized) 
	//1 (a carregar) 
	//2 (carregado) 
	//3 (interactivo) 
	//4 (completo) 
    if (retorno.readyState == 4)
	{
		if(retorno.status == 200) 
		{
			//PROCURA PELA DIV MOSTRACOMBO E INSERE O OBJETO
			document.getElementById('mostraComboAgenda').innerHTML = retorno.responseText;
		} 
		else 
		{
			//MOSTRA UM ALERTA AO OBTER UM RETORNO DE OK.
			alert("Houve um problema ao obter os dados:\n" + retorno.statusText);
		}
   }
}

function mudarAgenda(valor,dia,mes,ano)
{
	efeitoCarregando(1);
	if(valor == 1){
		CarregaArquivo("agenda.php",dia,mes,ano);
	}
	if(valor == 2){
		CarregaArquivo("caladmagente.php",dia,mes,ano);
	}
	if(valor == 3){
		CarregaArquivo("calagente.php",dia,mes,ano);
	}
	if(valor == 4){
		CarregaArquivo("caladmatestado.php",dia,mes,ano);
	}
	if(valor == 5){
		CarregaArquivo("calatestado.php",dia,mes,ano);
	}
	if(valor == 6){
		CarregaArquivo("calEventos.php",dia,mes,ano);
	}
	if(valor == 7){
		CarregaArquivoInt("calOcorrencia.php",dia,mes,ano);
	}
	if(valor == 8){
		CarregaArquivoInt("calChamada.php",dia,mes,ano);
	}
	if(valor == 9){
		CarregaArquivoInt("calChamadaTroca.php",dia,mes,ano);
	}
	if(valor == 10){
		CarregaArquivoInt("calReGuarnicao.php",dia,mes,ano);
	}
	if(valor == 11){
		CarregaArquivoInt("calPresenca.php",dia,mes,ano);
	}
	if(valor == 12){
		CarregaArquivoInt("calAtividade.php",dia,mes,ano);
	}
	if(valor == 13){
		CarregaArquivoInt("calSolicitacao.php",dia,mes,ano);
	}
	if(valor == 14){
		CarregaArquivoInt("calAit.php",dia,mes,ano);
	}
	// Topo da Página
	goTopo();
}

function goTopo()
{  
	//location='#topoArauto';
	//void(0);
	window.scrollTo(0,0);
}

function efeitoCarregando(valor)
{
	if(valor == 1)
	{
		// Mostra o efeito de Carregando
		document.getElementById("loading").style.visibility="visible";		
	}
	else
	{
		// Não Mostra o efeito de Carregando
		document.getElementById("loading").style.visibility="hidden";
	}
}