<script type="text/javascript">


var numSubMenus = 3;


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



  <ul class="page-navigation__primary">
  
  <li id="menu_fechado_1" style="display:block" class="primeiro">
    	<span><a href="javascript:ControlarMenu('1','abrir')">Galeria de Imagens</a></span>
        
        <ul>
         	<li><a href="index.php?pagina=imgalbuns&menu=1">Álbuns por dia</a></li>
         	<li><a href="index.php?pagina=imgbusca&menu=1">Consulta</a></li>
         </ul> 
    </li>
    
   	<li id="menu_aberto_1" style="display:none" class="primeiro">
         <span><a href="javascript:ControlarMenu('1','fechar')" class="selecionado">Galeria de Imagens</a></span>
 
         <ul>
         	<li><a href="index.php?pagina=imgalbuns&menu=1">Álbuns por dia</a></li>
         	<li><a href="index.php?pagina=imgbusca&menu=1">Consulta</a></li>         
         </ul>    
    </li>
 
 
 </ul>
   
   

<!--<div class="separador-menu">&nbsp;</div>-->
    


  <ul class="page-navigation__secondary">  

   

<!-- REMOVIDO A PEDIDO DE MARCO ZANFRA EM 31 DE JANEIRO DE 2014-->
 
   <!-- <li id="menu_fechado_2" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=assessores&menu=2">contatos</a></span>
   </li>
    
   <li id="menu_aberto_2" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=assessores&menu=2">contatos</a></span>
   </li>-->
   
   
   
    <li id="menu_fechado_3" style="display:none"> 
      <span><a href="index.php?pagina=marcas&menu=3">Marcas PMF</a></span>
   </li>
    
   <li id="menu_aberto_3" style="display:block"> 
      <span><a href="index.php?pagina=marcas&menu=3">Marcas PMF</a></span>
   </li>
    
    
 
   </ul>

   

   
 
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

