<li id="menu_fechado_3" style="display:block"><div><a href="javascript:ControlarMenu('3','abrir')">NOTÍCIAS E EVENTOS</a></div></li>
     
     <li id="menu_aberto_3" style="display:none">
     <div class="submenu_adm"><a href="javascript:ControlarMenu('3','fechar')">NOTÍCIAS E EVENTOS</a> 
         <ul>
         <?php
		 session_start();
		 $userPermissao = $_SESSION['Sgrupopermiid'];
		  if($userPermissao==0){
		  ?>
         <li>
           <a href="inicio.php?pagina=editoriacad&menu=3">cadastro de editorias</a>
              
         </li>
         <?php 
		 }
		 ?>
         
         <li>
           <a href="inicio.php?pagina=notcad&menu=3">consultar notícias</a><br>
           <a href="inicio.php?pagina=notinclui&menu=3">incluir notícia</a><br>
          <a href="inicio.php?pagina=notimport&menu=3">importação de notícias</a>     
           </li> 
	     <li>
           <a href="inicio.php?pagina=calcad&menu=3">consultar calendário</a><br>
           <a href="inicio.php?pagina=calinclui&menu=3">incluir no calendário</a>      
         </li> 
         <li>
           <a href="inicio.php?pagina=eventcad&menu=3">consultar eventos</a><br>
           <a href="inicio.php?pagina=eventinclui&menu=3">incluir eventos</a>    
         </li>
         </ul>
       </div>
     </li>    