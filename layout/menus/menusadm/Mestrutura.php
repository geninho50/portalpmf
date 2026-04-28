<li id="menu_fechado_1" style="display:block"><div><a href="javascript:ControlarMenu('1','abrir')">ESTRUTURA DA PREFEITURA</a></div></li>
     
     <li id="menu_aberto_1" style="display:none">
     <div class="submenu_adm"><a href="javascript:ControlarMenu('1','fechar')">ESTRUTURA DA PREFEITURA</a> 
         <ul>
         <li>
            <a href="inicio.php?pagina=entidcad&menu=1">consultar entidades</a><br>
            <?php
			if ($_SESSION['Sgrupopermiid'] == 0){
			?>           
            <a href="inicio.php?pagina=entidinclui&menu=1">incluir entidade</a>  
         	<?php
            }
			?>
         </li>
         <li>
            <a href="inicio.php?pagina=loccad&menu=1">consultar locais</a><br>
            <a href="inicio.php?pagina=locinclui&menu=1">incluir local</a>
         </li> 
         <li>
            <a href="inicio.php?pagina=setcad&menu=1">consultar setores</a><br>
            <a href="inicio.php?pagina=setinclui&menu=1">incluir setor</a>
         </li>
         <li>
            <a href="inicio.php?pagina=cargocad&menu=1">consultar cargos</a><br>
            <a href="inicio.php?pagina=cargoinclui&menu=1">incluir cargo</a> 
         </li>
         <li>
           <a href="inicio.php?pagina=colabcad&menu=1">consultar colaboradores</a><br>
           <a href="inicio.php?pagina=colabinclui&menu=1">incluir colaborador</a>
         </li>  
         <?php
			if ($_SESSION['Sgrupopermiid'] == 0){
		 ?> 
         <li>
           <a href="inicio.php?pagina=portcad&menu=1">consultar respons&aacute;veis portal</a><br>
         </li>         
         <?
			}
		 ?>
         </ul>
        </div>
     </li>