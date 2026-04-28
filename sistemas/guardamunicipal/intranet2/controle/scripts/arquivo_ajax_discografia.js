//CRIA A VARIÁVEL RETORNO
var retorno;
function CarregaArquivoDiscografia(url,valor)
{
    retorno = null;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
	if (window.XMLHttpRequest)
	{
		retorno = new XMLHttpRequest();
		retorno.onreadystatechange = processReqChangeDiscografia;
		retorno.open("GET", url+'?id='+valor, true);
		retorno.send(null);
	} 
	else
	if (window.ActiveXObject)
	{
		retorno = new ActiveXObject("Microsoft.XMLHTTP");
		if (retorno)
		{
			retorno.onreadystatechange = processReqChangeDiscografia;
			retorno.open("GET", url+'?id='+valor, true);
			retorno.send();
		}
	}
}
//FUNÇÃO QUE TRATA O RETORNO DO AJAX
function processReqChangeDiscografia()
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
			document.getElementById('mostraComboDiscografia').innerHTML = retorno.responseText;
		} 
		else 
		{
			//MOSTRA UM ALERTA AO OBTER UM RETORNO DE OK.
			alert("Houve um problema ao obter os dados:\n" + retorno.statusText);
		}
   }
}

//FUNÇÃO MUDAR, QUE CHAMA AS INFORMAÇÕES PASSADAS NO PARÂMETRO E CARREGA O ARQUIVO EXTERNO
function mudarDiscografia(valor,id)
{
	efeitoCarregandoDiscografia(1);
	if(valor==1)
	{
		CarregaArquivoDiscografia("musicasdiscografia.php",id);
	}
	// Topo da Página
	goTopoDiscografia();
}

function efeitoCarregandoDiscografia(valor)
{
	if(valor == 1)
	{
		// Mostra o efeito de Carregando
		document.getElementById("loadingdiscografia").style.visibility="visible";		
	}
	else
	{
		// Não Mostra o efeito de Carregando
		document.getElementById("loadingdiscografia").style.visibility="hidden";
	}
}

function goTopoDiscografia()
{  
	//location='#topoArauto';
	//void(0);
	window.scrollTo(0,0);
}