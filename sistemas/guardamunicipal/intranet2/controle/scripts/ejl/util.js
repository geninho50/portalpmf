/*
	Funções úteis
	Elcio Ferreira - 2004 - http://elcio.locaweb.com.br
*/

Array.prototype.find=function(elmnt){
	for(var i=0;i<this.length;i++)
		if(this[i]==elmnt)return true
	return false
}
