<script type="text/javascript">


var numSubMenus = 2;


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


function verifica(form) 
{
	if(form.txtbusca.value == "")
	{
		alert("Preencha um dado para pesquisa !");
		return false;
	}else {
		return true;
	}
}


</script>



  <ul>
  
    
    <li>&raquo; <a href="index.php?pagina=servonline2">SERVI&Ccedil;OS ONLINE (VIA WEB)</a></li>
  
        
    <li>&raquo; <span><b>GUIA DE SERVI&Ccedil;OS</b></span>
    
<div class="container_2a">

<a href="index.php?pagina=servalfabetica&letra=A">A</a> <a href="index.php?pagina=servalfabetica&letra=B">B</a> <a href="index.php?pagina=servalfabetica&letra=C">C</a> <a href="index.php?pagina=servalfabetica&letra=D">D</a> <a href="index.php?pagina=servalfabetica&letra=E">E</a> <a href="index.php?pagina=servalfabetica&letra=F">F</a> <a href="index.php?pagina=servalfabetica&letra=G">G</a> <a href="index.php?pagina=servalfabetica&letra=H">H</a> <a href="index.php?pagina=servalfabetica&letra=I">I</a><br /> 
<a href="index.php?pagina=servalfabetica&letra=J">J</a> <a href="index.php?pagina=servalfabetica&letra=K">K</a> <a href="index.php?pagina=servalfabetica&letra=L">L</a> <a href="index.php?pagina=servalfabetica&letra=M">M</a> <a href="index.php?pagina=servalfabetica&letra=N">N</a> <a href="index.php?pagina=servalfabetica&letra=O">O</a> <a href="index.php?pagina=servalfabetica&letra=P">P</a> <a href="index.php?pagina=servalfabetica&letra=Q">Q</a> <a href="index.php?pagina=servalfabetica&letra=R">R</a> <br />
<a href="index.php?pagina=servalfabetica&letra=S">S</a> <a href="index.php?pagina=servalfabetica&letra=T">T</a> <a href="index.php?pagina=servalfabetica&letra=U">U</a> <a href="index.php?pagina=servalfabetica&letra=V">V</a> <a href="index.php?pagina=servalfabetica&letra=X">X</a> <a href="index.php?pagina=servalfabetica&letra=Y">Y</a> <a href="index.php?pagina=servalfabetica&letra=W">W</a><a href="index.php?pagina=servalfabetica&letra=Z"> Z </a>
<br>
</div>  

<div class="container_2b"> 
<a href="index.php?pagina=servonline">listagem completa</a>  
</div>  

<div class="container_2b"> 
<a href="index.php?pagina=servacessados">mais acessados</a>  
</div>   

    </li> 
   
 
     <li id="menu_fechado_1" style="display:block">&raquo; 
      <span><a href="javascript:ControlarMenu('1','abrir')">UTILIDADE P&Uacute;BLICA</a></span></li>
    
    <li id="menu_aberto_1" style="display:none">&raquo;  
      <span><a href="javascript:ControlarMenu('1','fechar')">UTILIDADE P&Uacute;BLICA</a></span>
       
         <ul>
            <li>&raquo; <a href="index.php?pagina=onibus">hor&aacute;rio de &ocirc;nibus</a></li>  
            <li>&raquo; <a href="index.php?pagina=servpagina&amp;id=260">coleta de lixo</a></li>  
            <li>&raquo; <a href="http://cta.ipuf.sc.gov.br/sistema.html">condi&ccedil;&otilde;es de tr&acirc;nsito</a></li>         
         </ul>    
    </li>
    
    
      <li id="menu_fechado_2" style="display:block">&raquo; 
      <span><a href="javascript:ControlarMenu('2','abrir')">PR&Oacute;-CIDAD&Atilde;O</a></span></li>
    
      <li id="menu_aberto_2" style="display:none">&raquo;  
      <span><a href="javascript:ControlarMenu('2','fechar')">PR&Oacute;-CIDAD&Atilde;O</a></span>
       
         <ul>
            <li>&raquo; <a href="../entidades/casacivil/?cms=pro+cidadao">sobre o pr&oacute;-cidad&atilde;o</a></li>  
            <li>&raquo; <a href="../entidades/casacivil/?cms=unidades+de+atendimento">unidades de atendimento</a></li>  
            <li>&raquo; <a href="index.php?pagina=camera">c&acirc;mera on-line</a></li>         
         </ul>    
    </li>
   
    
    
    <li><br>CONSULTAR SERVI&Ccedil;OS: 
    
     <ul> 
  	
    <form id="frmbuscaserv" name="frmbuscaserv" action="index.php?pagina=servbusca" method="post" onsubmit="return verifica(this);">
    <li>
<?php

require_once("../scripts/php/funcoes.php");		
combo_entidades($drive, "entidade", $_POST['entidade']);
?>
    </li>
    
    <li>
    &raquo; nome do servi&ccedil;o:<br>
        <input type="text" name="txtbusca" id="txtbusca" class="componente_menu" />    
    </li>
    
    <li>
    	<input type="submit" value="OK" id="enviar" name="enviar"/>
    
    <br class="clearfloat" />
    </li>    
    </form>
    </ul>
    </li>  
   </ul>
   
 
<script type="text/javascript">
<?php 

   
      $menuAtual = $_GET['menu'];
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');"; 	     

?>
</script>