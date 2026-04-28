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


<div id="titulo-ouvidoria">&nbsp;</div>

<div id="menugeral">

  <ul>
  
  
   <li id="menu_fechado_1" style="display:none"> 
      <span><a href="index.php?pagina=home&menu=1">FALE COM O OUVIDOR</a></span>
    </li>
    
    <li id="menu_aberto_1" style="display:block"> 
      <span><a href="index.php?pagina=home&menu=1" class="selecionado">FALE COM O OUVIDOR</a></span>   
    </li>
    
    
     <li id="menu_fechado_2" style="display:none"> 
      <span><a href="https://sistema.ouvidorias.gov.br/publico/Manifestacao/ConsultarManifestacaoLogin.aspx">CONSULTE REIVINDICA&Ccedil;&Atilde;O PMF</a></span>
    </li>
    
    <li id="menu_aberto_2" style="display:block"> 
      <span><a href="https://sistema.ouvidorias.gov.br/publico/Manifestacao/ConsultarManifestacaoLogin.aspx" class="selecionado">CONSULTE REIVINDICA&Ccedil;&Atilde;O PMF</a></span>   
    </li>

    <li id="menu_fechado_3" style="display:none"> 
      <span><a href="http://www.pmf.sc.gov.br/entidades/saude/sistema.php?servicoid=4733">CONSULTE REIVINDICA&Ccedil;&Atilde;O VIGILÂNCIA SANITÁRIA</a></span>
    </li>
    
    <li id="menu_aberto_3" style="display:block"> 
      <span><a href="http://www.pmf.sc.gov.br/entidades/saude/sistema.php?servicoid=4733" class="selecionado">CONSULTE REIVINDICA&Ccedil;&Atilde;O VIGILÂNCIA SANITÁRIA</a></span>   
    </li>
 
     
   </ul>
   <br><br><br><br><br><br><br><br>
   
</div>
   
 
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



