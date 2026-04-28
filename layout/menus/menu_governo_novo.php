<script type="text/javascript">


var numSubMenus = 7;


function ControlarMenu(num,acao){ // acao = 'abrir' ou 'fechar'
	for (i=1;i<=numSubMenus;i++){
		document.getElementById('menu_fechado_'+i).style.display = 'block';
		document.getElementById('menu_aberto_'+i).style.display = 'none';
	}
	
	if (acao == 'abrir'){ 
	    document.getElementById('menu_fechado_'+num).style.display = 'none';
		document.getElementById('menu_aberto_'+num).style.display = 'block';
	} 
}


</script>

<div id="titulo-governo">&nbsp;</div>

<div id="menugeral">

  <ul>
  
  
   <li id="menu_fechado_1" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=govgestao&menu=1">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span>
    </li>
    
    <li id="menu_aberto_1" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=govgestao&menu=1" class="selecionado">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span>   
    </li>
    
    
  	<li id="menu_fechado_2" style="display:none"> 
      <span><a href="http://www.pmf.sc.gov.br/sites/acessoainformac/">acesso a informa&ccedil;&atilde;o</a></span>
    </li>
    <li id="menu_aberto_2" style="display:block"> 
      <span><a href="http://www.pmf.sc.gov.br/sites/acessoainformac/" class="selecionado">acesso a informa&ccedil;&atilde;o</a></span>   
    </li>
    
    <li id="menu_fechado_3" style="display:none"> 
      <span><a href="index.php?pagina=govquem&menu=3">endere&ccedil;os e telefones</a></span>
    </li>
    
    <li id="menu_aberto_3" style="display:block"> 
      <span><a href="index.php?pagina=govquem&menu=3" class="selecionado">endere&ccedil;os e telefones</a></span>   
    </li>
    
    
    <li id="menu_fechado_4" style="display:none" > 
      <span><a href="http://portal.pmf.sc.gov.br/entidades/ouvidoria/?cms=lei+da+transparencia">florian&oacute;polis transparente</a></span>
    </li>
    
    <li id="menu_aberto_4" style="display:block" > 
      <span><a href="http://portal.pmf.sc.gov.br/entidades/ouvidoria/?cms=lei+da+transparencia" class="selecionado">florian&oacute;polis transparente</a></span>   
    </li>
    
    <li id="menu_fechado_5" style="display:none" > 
      <span><a href="index.php?pagina=govestrutura&menu=5">estrutura organizacional</a></span>
    </li>
    
    <li id="menu_aberto_5" style="display:block" > 
      <span><a href="index.php?pagina=govestrutura&menu=5" class="selecionado">estrutura organizacional</a></span>   
    </li>
    
    
    
     <li id="menu_fechado_6" style="display:none" > 
      <span><a href="index.php?pagina=govgabinete&menu=6">gabinete do prefeito</a></span>
    </li>
    
    <li id="menu_aberto_6" style="display:block" > 
      <span><a href="index.php?pagina=govgabinete&menu=6" class="selecionado">gabinete do prefeito</a></span>   
    </li>
    
    
    
    
  
    
  </ul>
</div>  

<div class="separador-menu">&nbsp;</div>    
<div id="menugeral">
	<ul>  
  
    <li id="menu_fechado_7" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=govdiariooficial&menu=7">DI&Aacute;RIO OFICIAL</a></span>
    </li>
    
    <li id="menu_aberto_7" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=govdiariooficial&menu=7" class="selecionado">DI&Aacute;RIO OFICIAL</a></span>   
    </li>
    
    
    
    
    <li id="menu_fechado_8" style="display:block"> 
      <span><a href="index.php?pagina=goveditais&menu=8">EDITAIS</a></span>
    </li>
    
    <li id="menu_aberto_8" style="display:none"> 
      <span><a href="index.php?pagina=goveditais&menu=8" class="selecionado">EDITAIS</a></span>   
    </li>  
    
    
    
    
    <li id="menu_fechado_9" style="display:block"> 
      <span><a href="http://editais.sc.gov.br/prefeituras/editais.asp?usuario=0540">LICITA&Ccedil;&Otilde;ES</a></span>
    </li>
    
    <li id="menu_aberto_9" style="display:none"> 
      <span><a href="http://editais.sc.gov.br/prefeituras/editais.asp?usuario=0540" class="selecionado">LICITA&Ccedil;&Otilde;ES</a></span>   
    </li>   
    
    
    
    
    <li id="menu_fechado_10" style="display:block"> 
      <span><a href="index.php?pagina=govpregao&menu=10"> COMPRAS P&Uacute;BLICAS</a></span>
    </li>
    
    <li id="menu_aberto_10" style="display:none"> 
      <span><a href="index.php?pagina=govpregao&menu=10" class="selecionado"> COMPRAS P&Uacute;BLICAS</a></span>   
    </li>  
    
    
</ul>
</div>  

<!-- <div class="separador-menu">&nbsp;</div>    
<div id="menugeral">
	<ul>   
    
   <li id="menu_fechado_11" style="display:block" class="primeiro">
    	<span><a href="javascript:ControlarMenu('11','abrir')">CONSULTAS P&Uacute;BLICAS</a></span>
        
        <ul>
         	<li><a href="http://portal.pmf.sc.gov.br/governo/consultas-publicas/">abertas</a></li>
         	<li><a href="http://portal.pmf.sc.gov.br/governo/consultas-publicas/?page_id=7">encerradas</a></li>      
         </ul> 
    </li>
    
   	<li id="menu_aberto_11" style="display:none" class="primeiro">
         <span><a href="javascript:ControlarMenu('11','fechar')" class="selecionado">CONSULTAS P&Uacute;BLICAS</a></span>
 
         <ul>
         	<li><a href="http://portal.pmf.sc.gov.br/governo/consultas-publicas/">abertas</a></li>
         	<li><a href="http://portal.pmf.sc.gov.br/governo/consultas-publicas/?page_id=7">encerradas</a></li>       
         </ul>    
    </li>
 
 
   </ul>
   
   </div>
 -->  
 
<script type="text/javascript">
<?php 

   
      $menuAtual = $_GET['menu'];
	  
	  if ( empty($menuAtual) ) {
	      $menuAtual = 1 ;
	   }
	      
	  
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');";      

?>
</script> 



