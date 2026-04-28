<script type="text/javascript">


var numSubMenus = 4;


function ControlarMenu(num,acao){ // acao = 'abrir' ou 'fechar'
	for (i=0;i<=numSubMenus;i++){
		document.getElementById('menu_fechado_'+i).style.display = 'block';
		document.getElementById('menu_aberto_'+i).style.display = 'none';
	}
	
	if (acao == 'abrir'){ 
	    document.getElementById('menu_fechado_'+num).style.display = 'none';
		document.getElementById('menu_aberto_'+num).style.display = 'block';
	} 
}


</script>


 <div id="menugeral">
  <ul>
  	
   <li id="menu_fechado_0" style="display:none"> 
      <span><a href="index.php?pagina=home&menu=0">DESTAQUES</a></span></li>
    
    <li id="menu_aberto_0" style="display:block"> 
      <span><a href="index.php?pagina=home&menu=0" class="selecionado">DESTAQUES</a></span>
    </li>
    
    
    
     <li id="menu_fechado_1" style="display:none"> 
      <span><a href="javascript:ControlarMenu('1','abrir')">Tv</a></span></li>
    
    <li id="menu_aberto_1" style="display:block"> 
      <span><a href="javascript:ControlarMenu('1','fechar')" class="selecionado">Tv</a></span>
     	 <ul>
            <li><a href="index.php?pagina=vidbusca&menu=1">V&iacute;deos</a></li>   
            <li><a href="index.php?pagina=vidalbuns&menu=1">Canais</a></li> 
              
         </ul>    
    </li> 
    
      <li id="menu_fechado_2" style="display:none"> 
      <span><a href="javascript:ControlarMenu('2','abrir')">Galeria</a></span></li>
    
    <li id="menu_aberto_2" style="display:block"> 
      <span><a href="javascript:ControlarMenu('2','fechar')" class="selecionado">Galeria</a></span>
     	 <ul>  
      		<li><a href="index.php?pagina=imgbusca&menu=2">imagens</a></li> 
            <li><a href="index.php?pagina=imgalbuns&menu=2">&aacute;lbuns</a></li> 
              
         </ul>    
    </li> 
    
    <li id="menu_fechado_3" style="display:none"> 
      <span><a href="javascript:ControlarMenu('3','abrir')">R&aacute;dio</a></span></li>
    
    <li id="menu_aberto_3" style="display:block"> 
      <span><a href="javascript:ControlarMenu('3','fechar')" class="selecionado">R&aacute;dio</a></span>
     	 <ul>  
      		 <li><a href="index.php?pagina=audbusca&menu=3">&aacute;udios</a></li>  
            <li><a href="index.php?pagina=audalbuns&menu=3">canais</a></li> 
            
         </ul>    
    </li>
    
    <li id="menu_fechado_4" style="display:none"> 
      <span><a href="javascript:ControlarMenu('4','abrir')">DOWNLOADS</a></span></li>
    
    <li id="menu_aberto_4" style="display:block"> 
      <span><a href="javascript:ControlarMenu('4','fechar')" class="selecionado">DOWNLOADS</a></span>
     	 <ul>  
      		<li><a href="index.php?pagina=arqbusca&menu=4">arquivos</a></li> 
            <li><a href="index.php?pagina=arqalbuns&menu=4">cole&ccedil;&otilde;es</a></li> 
              
         </ul>    
    </li>  
 
 
   </ul>
   </div>
   
   
    <div id="menuespecifico">
    <span class="titulo_pequeno_2">sobre a TvFranklin</span><br><br>
  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est.<br><br>
  
  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
  </div>
   
 
<script type="text/javascript">
<?php 

      $menuAtual = $_GET['menu'];
	  
	  if ( empty($menuAtual) ) {
	      $menuAtual = 0 ;
	   }
	      
	  
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');";    

?>
</script> 