<script type="text/javascript">


var numSubMenus = 6;


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



  <ul>
    
    
    <li>&raquo; <a href="index.php?pagina=govgestao">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></li>
  
  
    <li>&raquo; <span>PREFEITURA</span> 
         <ul>
         <li>
           <a href="index.php?pagina=govestrutura">&raquo; estrutura organizacional</a><br>
           <a href="index.php?pagina=govgabinete">&raquo; gabinete do prefeito</a><br>
           <a href="index.php?pagina=govquem&id=36">&raquo; endere&ccedil;os e telefones</a>  
         </li>        
         </ul>    
    </li>
    
    <li>&raquo; <a href="index.php?pagina=govdiariooficial">DI&Aacute;RIO OFICIAL</a></li>
    
    <li>&raquo; <a href="index.php?pagina=goveditais">EDITAIS</a></li>
    
    <li>&raquo; <a href="http://editais.sc.gov.br/prefeituras/editais.asp?usuario=0540">LICITA&Ccedil;&Otilde;ES</a></li>
    
    <li>&raquo; <a href="http://wbc.pmf.sc.gov.br/WBCc001.asp"> COMPRAS P&Uacute;BLICAS (WBC)</a></li>
    
        
   
 
   </ul>
   
 
<script type="text/javascript">
<?php 

   
      $menuAtual = $_GET['menu'];
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');"; 	     

?>
</script> 



