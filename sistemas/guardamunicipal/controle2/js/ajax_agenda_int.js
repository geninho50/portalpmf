//CRIA A VARIÁVEL RETORNO
var retorno;
function CarregaArquivoInt(url,dia,mes,ano)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChangeInt;
		retorno.open("GET", url+'?id='+dia+'&mes='+mes+'&ano='+ano, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChangeInt;
			retorno.open("GET", url+'?dia='+dia+'&mes='+mes+'&ano='+ano, true);
			retorno.send();
		}
	}
}

//FUNÇÃO QUE TRATA O RETORNO DO AJAX
function processReqChangeInt()
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
			document.getElementById('mostraComboAgendaInt').innerHTML = retorno.responseText;
		} 
		else 
		{
			//MOSTRA UM ALERTA AO OBTER UM RETORNO DE OK.
			alert("Houve um problema ao obter os dados:\n" + retorno.statusText);
		}
   }
}

function mudarAgendaInt(valor,dia,mes,ano)
{
	efeitoCarregandoInt(1);
	if(valor == 1){
		CarregaArquivoInt("agendaint.php",dia,mes,ano);
	}
	if(valor == 2){
		CarregaArquivoInt("caladmagente.php",dia,mes,ano);
	}
	if(valor == 3){
		CarregaArquivoInt("calagente.php",dia,mes,ano);
	}
	if(valor == 4){
		CarregaArquivoInt("caladmatestado.php",dia,mes,ano);
	}
	if(valor == 5){
		CarregaArquivoInt("calatestado.php",dia,mes,ano);
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

function efeitoCarregandoInt(valor)
{
	if(valor == 1)
	{
		// Mostra o efeito de Carregando
		document.getElementById("loadingint").style.visibility="visible";		
	}
	else
	{
		// Não Mostra o efeito de Carregando
		document.getElementById("loadingint").style.visibility="hidden";
	}
}