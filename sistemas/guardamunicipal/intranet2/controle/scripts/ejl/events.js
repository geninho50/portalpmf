/*
	Tratamento de eventos crossbrowser
	Baseado em http://simon.incutio.com/archive/2003/11/06/easytoggle
	Elcio Ferreira - 2004 - http://elcio.locaweb.com.br
*/

function addEvent(obj, evType, fn){
	if(obj.addEventListener)obj.addEventListener(evType,fn,true)
	if(obj.attachEvent)obj.attachEvent("on"+evType,fn)
}


function getSource(e){
	if(typeof e=='undefined')var e=window.event;
	var source=typeof e.target!='undefined'?e.target:typeof e.srcElement!='undefined'?e.srcElement:true
	if(source.nodeType == 3)source=source.parentNode;
	return source
}
