
     <div id="titulo_pagina">servi&ccedil;os</div>
     
     <div class="box_msg_baixo">Utilize o menu abaixo para acessar informações sobre os serviços disponíveis na Prefeitura, incluindo a descrição dos serviços, passo a passo de como solicitar, lista de documentos necessários e requisitos, bem como endereço de onde solicitar.</div> 



  <ul>
  
    
    <li>&raquo; <a href="index.php?pagina=servonline" title="listagem completa de serviços">listagem completa de serviços</a> </li>
    
    <li>&raquo; <a href="index.php?pagina=servacessados" title="serviços mais acessados por ordem alfabética">serviços mais acessados por ordem alfabética</a> </li>
  
        
    <li>
    
<div class="container_letras">

<a href="index.php?pagina=servalfabetica&letra=A" title="A">A</a> <a href="index.php?pagina=servalfabetica&letra=B" title="B">B</a> <a href="index.php?pagina=servalfabetica&letra=C" title="C">C</a> <a href="index.php?pagina=servalfabetica&letra=D" title="D">D</a> <a href="index.php?pagina=servalfabetica&letra=E" title="E">E</a> <a href="index.php?pagina=servalfabetica&letra=F" title="F">F</a> <a href="index.php?pagina=servalfabetica&letra=G" title="G">G</a> <a href="index.php?pagina=servalfabetica&letra=H" title="H">H</a> <a href="index.php?pagina=servalfabetica&letra=I" title="I">I</a><br /> 
<a href="index.php?pagina=servalfabetica&letra=J" title="J">J</a> <a href="index.php?pagina=servalfabetica&letra=K" title="K">K</a> <a href="index.php?pagina=servalfabetica&letra=L" title="L">L</a> <a href="index.php?pagina=servalfabetica&letra=M" title="M">M</a> <a href="index.php?pagina=servalfabetica&letra=N" title="N">N</a> <a href="index.php?pagina=servalfabetica&letra=O" title="O">O</a> <a href="index.php?pagina=servalfabetica&letra=P" title="P">P</a> <a href="index.php?pagina=servalfabetica&letra=Q" title="Q">Q</a> <a href="index.php?pagina=servalfabetica&letra=R" title="R">R</a><br />
<a href="index.php?pagina=servalfabetica&letra=S" title="S">S</a> <a href="index.php?pagina=servalfabetica&letra=T" title="T">T</a> <a href="index.php?pagina=servalfabetica&letra=U" title="U">U</a> <a href="index.php?pagina=servalfabetica&letra=V" title="V">V</a> <a href="index.php?pagina=servalfabetica&letra=X" title="X">X</a> <a href="index.php?pagina=servalfabetica&letra=Y" title="Y">Y</a> <a href="index.php?pagina=servalfabetica&letra=W" title="W">W</a> <a href="index.php?pagina=servalfabetica&letra=Z" title="Z"> Z </a>
<br>
</div>  

    </li> 
   
 
   
    
    <li>CONSULTAR SERVI&Ccedil;OS: 
    
     
  	
    <form id="frmbuscaserv" name="frmbuscaserv" action="index.php?pagina=servbusca" method="post" onsubmit="return verifica(this);">
    
<?php

require_once("../scripts/php/funcoes_bd.php");		
require_once("../scripts/php/funcoes.php");		
$drive->conecta();
?>    
    &raquo; secretaria ou &oacute;rg&atilde;o:<br>
    
    	<?php combo_entidades($drive, "Ssec", $_POST['Ssec'])?>
        
   
    	<br>&raquo; nome do servi&ccedil;o:<br>    	
        <input type="text" name="txtbusca" id="txtbusca" class="componente_menu" title="Selecione Secretaria ou Órgão"/> 
        <label for="Nome do Serviço">
        <input type="submit" value="OK" id="enviar" name="enviar"/>   
    	</label>
    
    <br class="clearfloat" />   
    </form>
    
    </li>  
   </ul>
   



