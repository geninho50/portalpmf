
     <li id="menu_fechado_6" style="display:block"><span><a href="javascript:ControlarMenu('6','abrir')">PERSONALIZAR SITE</a></span></li>
     
     <li id="menu_aberto_6" style="display:none">
     	<span><a href="javascript:ControlarMenu('6','fechar')" class="selecionado">PERSONALIZAR SITE</a></span>  
         <ul>
         <li>
            <a href="inicio.php?pagina=pagcad&menu=6">consultar páginas</a><br>
           <a href="inicio.php?pagina=paginclui&menu=6">incluir página</a>     
         </li>
         <li>
           <a href="inicio.php?pagina=menucad&menu=6">montar menu</a><br>     
         </li>
         <li>
           <a href="inicio.php?pagina=bannershome&menu=6">banners da home</a>   
         </li>
         <li>
           <a href="inicio.php?pagina=notdiagram&menu=6">notícias da home</a>   
         </li>   
         <?php 
		 if( $_SESSION['Sgrupopermiid']==0 or $_SESSION['Sgrupopermiid']==5 ){
		 ?>  
         <li>
           <a href="inicio.php?pagina=evendiagram&menu=6">eventos da home</a>   
         </li>     
         <?php 
		 }
		 ?>  
         <li>
           <a href="inicio.php?pagina=destaques&menu=6">configurar destaques</a><br>     
         </li> 
         </ul>
     </li>