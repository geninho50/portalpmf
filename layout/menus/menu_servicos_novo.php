<script type="text/javascript">


var numSubMenus = 3;


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

<div id="titulo-servicos">&nbsp;</div>

 <div id="menugeral">

  <ul>   
    <li id="menu_fechado_0" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=servguia&menu=0">HOME</a></span>
    </li>
    
    <li id="menu_aberto_0" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=servguia&menu=0" class="selecionado">HOME</a></span>   
    </li>
    
    <li id="menu_fechado_5" style="display:block" >
      <span><a href="http://portal.pmf.sc.gov.br/entidades/casacivil/index.php?cms=pro+cidadao&menu=6">PR&Oacute;-CIDAD&Atilde;O</a></span>
   </li>
    
   <!-- <li id="menu_aberto_5" style="display:none">  
      <span><a href="http://portal.pmf.sc.gov.br/entidades/fazenda/index.php?cms=pro+cidadao&menu=6" class="selecionado">PR&Oacute;-CIDAD&Atilde;O</a></span>
       
         <ul>
            <li><a href="../entidades/receita/?cms=pro+cidadao">sobre o pr&oacute;-cidad&atilde;o</a></li>  
            <li><a href="../entidades/receita/?cms=unidades+de+atendimento">unidades de atendimento</a></li>  
            <li><a href="index.php?pagina=camera">c&acirc;mera on-line</a></li>         
         </ul>    
    </li> -->
    
   </ul>
</div>    
   

<div class="separador-menu">&nbsp;</div>
    
 <div id="menugeral">

  <ul>      
  
  
   <li id="menu_fechado_1" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=servonline2&menu=1">SERVI&Ccedil;OS ONLINE (VIA WEB)</a></span>
    </li>
    
    <li id="menu_aberto_1" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=servonline2&menu=1" class="selecionado">SERVI&Ccedil;OS ONLINE (VIA WEB)</a></span>   
    </li>
    
    
     <li id="menu_fechado_2" style="display:none"> 
      <span><a href="index.php?pagina=servonline&menu=2">listagem completa</a></span>
    </li>
    
    <li id="menu_aberto_2" style="display:block" > 
      <span><a href="index.php?pagina=servonline&menu=2" class="selecionado">listagem completa</a></span>   
    </li>
    
    
    <li id="menu_fechado_3" style="display:none"> 
      <span><a href="index.php?pagina=servacessados&menu=3">mais acessados</a></span>
    </li>
    
    <li id="menu_aberto_3" style="display:block"> 
      <span><a href="index.php?pagina=servacessados&menu=3" class="selecionado">mais acessados</a></span>   
    </li>
    

        
        
        
 
    <li id="menu_fechado_4" style="display:block">
    	<span><a href="javascript:ControlarMenu('4','abrir')">LISTA ALFAB&Eacute;TICA</a></span>
    
		<ul><li class="letras">
		<a href="index.php?pagina=servalfabetica&letra=A&menu=4">A</a> 
		<a href="index.php?pagina=servalfabetica&letra=B&menu=4">B</a> 
		<a href="index.php?pagina=servalfabetica&letra=C&menu=4">C</a> 
		<a href="index.php?pagina=servalfabetica&letra=D&menu=4">D</a> 
		<a href="index.php?pagina=servalfabetica&letra=E&menu=4">E</a> 
		<a href="index.php?pagina=servalfabetica&letra=F&menu=4">F</a> 
		<a href="index.php?pagina=servalfabetica&letra=G&menu=4">G</a> 
		<a href="index.php?pagina=servalfabetica&letra=H&menu=4">H</a> 
		<a href="index.php?pagina=servalfabetica&letra=I&menu=4">I</a><br /> 
		<a href="index.php?pagina=servalfabetica&letra=J&menu=4">J</a> 
		<a href="index.php?pagina=servalfabetica&letra=K&menu=4">K</a> 
		<a href="index.php?pagina=servalfabetica&letra=L&menu=4">L</a> 
		<a href="index.php?pagina=servalfabetica&letra=M&menu=4">M</a> 
		<a href="index.php?pagina=servalfabetica&letra=N&menu=4">N</a>
		<a href="index.php?pagina=servalfabetica&letra=O&menu=4">O</a> 
		<a href="index.php?pagina=servalfabetica&letra=P&menu=4">P</a> 
		<a href="index.php?pagina=servalfabetica&letra=Q&menu=4">Q</a> 
		<a href="index.php?pagina=servalfabetica&letra=R&menu=4">R</a><br />  
		<a href="index.php?pagina=servalfabetica&letra=S&menu=4">S</a> 
		<a href="index.php?pagina=servalfabetica&letra=T&menu=4">T</a> 
		<a href="index.php?pagina=servalfabetica&letra=U&menu=4">U</a>
		<a href="index.php?pagina=servalfabetica&letra=V&menu=4">V</a> 
		<a href="index.php?pagina=servalfabetica&letra=X&menu=4">X</a> 
		<a href="index.php?pagina=servalfabetica&letra=Y&menu=4">Y</a> 
		<a href="index.php?pagina=servalfabetica&letra=W&menu=4">W</a>
		<a href="index.php?pagina=servalfabetica&letra=Z&menu=4">Z</a>
		</li>
		</ul></li>
        
        
    <li id="menu_aberto_4" style="display:none">
    	<span><a href="javascript:ControlarMenu('4','fechar')" class="selecionado">LISTA ALFAB&Eacute;TICA</a></span>
    
		<ul><li class="letras">
		<a href="index.php?pagina=servalfabetica&letra=A&menu=4">A</a> 
		<a href="index.php?pagina=servalfabetica&letra=B&menu=4">B</a> 
		<a href="index.php?pagina=servalfabetica&letra=C&menu=4">C</a> 
		<a href="index.php?pagina=servalfabetica&letra=D&menu=4">D</a> 
		<a href="index.php?pagina=servalfabetica&letra=E&menu=4">E</a> 
		<a href="index.php?pagina=servalfabetica&letra=F&menu=4">F</a> 
		<a href="index.php?pagina=servalfabetica&letra=G&menu=4">G</a> 
		<a href="index.php?pagina=servalfabetica&letra=H&menu=4">H</a> 
		<a href="index.php?pagina=servalfabetica&letra=I&menu=4">I</a><br /> 
		<a href="index.php?pagina=servalfabetica&letra=J&menu=4">J</a> 
		<a href="index.php?pagina=servalfabetica&letra=K&menu=4">K</a> 
		<a href="index.php?pagina=servalfabetica&letra=L&menu=4">L</a> 
		<a href="index.php?pagina=servalfabetica&letra=M&menu=4">M</a> 
		<a href="index.php?pagina=servalfabetica&letra=N&menu=4">N</a>
		<a href="index.php?pagina=servalfabetica&letra=O&menu=4">O</a> 
		<a href="index.php?pagina=servalfabetica&letra=P&menu=4">P</a> 
		<a href="index.php?pagina=servalfabetica&letra=Q&menu=4">Q</a> 
		<a href="index.php?pagina=servalfabetica&letra=R&menu=4">R</a><br />  
		<a href="index.php?pagina=servalfabetica&letra=S&menu=4">S</a> 
		<a href="index.php?pagina=servalfabetica&letra=T&menu=4">T</a> 
		<a href="index.php?pagina=servalfabetica&letra=U&menu=4">U</a>
		<a href="index.php?pagina=servalfabetica&letra=V&menu=4">V</a> 
		<a href="index.php?pagina=servalfabetica&letra=X&menu=4">X</a> 
		<a href="index.php?pagina=servalfabetica&letra=Y&menu=4">Y</a> 
		<a href="index.php?pagina=servalfabetica&letra=W&menu=4">W</a>
		<a href="index.php?pagina=servalfabetica&letra=Z&menu=4">Z</a>
		</li>
		</ul></li>

     
 
    
 </ul>
 </div>
 
 <div class="separador-menu">&nbsp;</div>
 
  <div id="menuespecifico">

  <ul>  
   
    
    
    <li class="primeiro">CONSULTAR SERVI&Ccedil;OS:<br>
    
    
  	
    <form id="frmbuscaserv" name="frmbuscaserv" action="index.php?pagina=servbusca&menu=2" method="post" onsubmit="return verifica(this);">
    
<?php


require_once("../scripts/php/funcoes_bd.php");		
$drive->conecta();

// ########################### Select Entidades PREFEITURA ###########################				

$sql2 = "SELECT * FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 ORDER BY entidade_nome";
$V_entidades_prefeitura = $drive->pedido($sql2);	

// ########################### Select Entidades SECRATARIAS MUNICIPAIS ###########################				

$sql2 = "SELECT * FROM entidades WHERE entidade_tipo = 4 ORDER BY entidade_nome";
$V_entidades_municipais = $drive->pedido($sql2);	

// ########################### Select Entidades SECRETARIAS EXECUTIVAS ###########################				

$sql3 = "SELECT * FROM entidades WHERE entidade_tipo = 5 ORDER BY entidade_nome";
$V_entidades_executivas = $drive->pedido($sql3);

// ########################### Select Entidades ORGAOS ###########################				

$sql4 = "SELECT * FROM entidades WHERE entidade_tipo = 6 ORDER BY entidade_nome";
$V_orgaos = $drive->pedido($sql4);	

// ########################### Select Entidades EDITORIAS ###########################

$sql5 = "SELECT * FROM editorias ORDER BY edit_nome";
$V_editorias = $drive->pedido($sql5);	

?>    
    <div>secretaria ou &oacute;rg&atilde;o:</div>
        <select width="180" name="Ssec"  class="componente_menu" id="Ssec">
        <option value="9999"> &nbsp;&nbsp;Todas </option>
        <option value="0"> </option>
        <option value="0"> &nbsp;&nbsp;=== Prefeitura === </option>
        <option value="0"> </option>
        <?PHP			
        while($V_principais = pg_fetch_object($V_entidades_prefeitura))
        {				
        ?> 
        <option value="<?=$V_principais->entidade_id?>"> &nbsp;<?=$V_principais->entidade_linha_1?> </option>
        <?PHP 
        } 
        ?> 
         <option value="0"> </option> 
        <option value="0"> &nbsp;&nbsp=== Secretarias Municipais ===</option>
        <option value="0"> </option>
        <?PHP			
        while($V_municipais = pg_fetch_object($V_entidades_municipais))
        {				
        ?> 
        <option value="<?=$V_municipais->entidade_id?>">&nbsp;&nbsp;<?=$V_municipais->entidade_linha_1?> </option>
        <?PHP 
        } 
        ?>
        <option value="0"> </option>  
        <option value="0"> &nbsp;&nbsp;=== Secretarias Executivas === </option>
        <option value="0"> </option>
        <?PHP			
        while($V_executivas = pg_fetch_object($V_entidades_executivas))
        {				
        ?> 
        <option value="<?=$V_executivas->entidade_id?>">&nbsp;&nbsp;<?=$V_executivas->entidade_linha_1?> </option>
        <?PHP 
        } 
        ?>        
        <option value="0"> </option> 
        <option value="0"> &nbsp;&nbsp=== Org&atilde;os ===</option>
        <option value="0"> </option>
        <?PHP			
        while($V_org = pg_fetch_object($V_orgaos))
        {				
        ?> 
        <option value="<?=$V_org->entidade_id?>">&nbsp;&nbsp;<?=$V_org->entidade_linha_1?> </option>
        <?PHP 
        } 
        ?>  
        <option value="0"> </option>                     
        </select >      
    
       <div>nome do servi&ccedil;o:</div>
        <input type="text" name="txtbusca" id="txtbusca" class="componente_menu" />    
    
    	<input type="submit" value="OK" id="enviar" name="enviar"/>
    
      
    </form>
   
    </li>  
   </ul>
 
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



