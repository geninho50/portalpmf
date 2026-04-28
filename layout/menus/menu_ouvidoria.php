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
  
    <li>&raquo; <a href="index.php?pagina=home">FALE COM O OUVIDOR</a></li>
    
    <li>&raquo; <a href="index.php?pagina=consulta">CONSULTE REIVINDICA&Ccedil;&Atilde;O</a></li>
     
   </ul>
   
 
<script type="text/javascript">
<?php 

   
      $menuAtual = $_GET['menu'];
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');"; 	     

?>
</script> 



