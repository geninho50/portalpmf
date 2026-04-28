 <li id="menu_fechado_4" style="display:block"><div><a href="javascript:ControlarMenu('4','abrir')">GESTÃO E TRANSPARÊNCIA</a></div></li>
     
     <li id="menu_aberto_4" style="display:none">
     <div class="submenu_adm"><a href="javascript:ControlarMenu('4','fechar')">GESTÃO E TRANSPARÊNCIA</a> 
         <ul>
         <li>
           <a href="inicio.php?pagina=tprelcad&menu=4">consultar tipos de relatório</a><br>
           <a href="inicio.php?pagina=tprelinclui&menu=4">incluir tipo de relatório</a>    
         </li>
         <li>
           <a href="inicio.php?pagina=relcad&menu=4">consultar relatórios</a><br>
           <a href="inicio.php?pagina=relinclui&menu=4">incluir relatório</a>       
         </li> 
         <li>
           <a href="inicio.php?pagina=editalcad&menu=4">consultar editais</a><br>
           <a href="inicio.php?pagina=editalinclui&menu=4">incluir edital</a>    
         </li>
         <li>
          <a href="inicio.php?pagina=diariocoluna&menu=4">enviar colunas do diário oficial</a><br>
		  <?php
			if ($_SESSION['Sgrupopermiid'] == 1){
		  ?> 	          
          <a href="inicio.php?pagina=diariogeracao&menu=4">gerar diário oficial</a> <br />  
          <a href="inicio.php?pagina=diariocad&menu=4">editar di&aacute;rio oficial </a>       
          <?php
          }
		  ?>
         </li>
         </ul> 
        </div>
     </li>  