//CRIA A VARIÁVEL RETORNO
var retorno;
function CarregaArquivo(url,valor)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChange;
		retorno.open("GET", url+'?id='+valor, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChange;
			retorno.open("GET", url+'?id='+valor, true);
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
			document.getElementById('mostraCombo').innerHTML = retorno.responseText;
		} 
		else 
		{
			//MOSTRA UM ALERTA AO OBTER UM RETORNO DE OK.
			alert("Houve um problema ao obter os dados:\n" + retorno.statusText);
		}
   }
}

//FUNÇÃO MUDAR, QUE CHAMA AS INFORMAÇÕES PASSADAS NO PARÂMETRO E CARREGA O ARQUIVO EXTERNO
function mudar(valor)
{
	//CARREGA O ARQUIVO EXTERNO DO AJAX
    CarregaArquivo("resultadofotos.php",valor);
}



// Para o cadastrar_produtos_destaque.php
function CarregaArquivoDestaque(url,valor,verimagem)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChange;
		retorno.open("GET", url+'?verimagem='+verimagem+'&xBusca='+valor, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChange;
			retorno.open("GET", url+'?verimagem='+verimagem+'&xBusca='+valor, true);
			retorno.send();
		}
	}
}

function busca(valor,verimagem)
{
	//CARREGA O ARQUIVO EXTERNO DO AJAX
    CarregaArquivoDestaque("destaques.php",valor,verimagem);
}


function CarregaArquivoAlteraDestaque(url,valor,id,verimagem,acao)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChange;
		retorno.open("GET", url+'?acao='+acao+'&verimagem='+verimagem+'&idProduto='+id+'&xBusca='+valor, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChange;
			retorno.open("GET", url+'?acao='+acao+'&verimagem='+verimagem+'&idProduto='+id+'&xBusca='+valor, true);
			retorno.send();
		}
	}
	// CarregaArquivoDestaque("destaques.php",valor,verimagem);
}
function altera(valor,id,verimagem,acao)
{
	//CARREGA O ARQUIVO EXTERNO DO AJAX
    CarregaArquivoAlteraDestaque("../classes/controleProdutoDestaque.php",valor,id,verimagem,acao);
}