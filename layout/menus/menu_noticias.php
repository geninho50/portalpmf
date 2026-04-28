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

function mascara_periodo(form){
	if(form.p1.value.length==2){
		form.p1.value=form.p1.value + "/";
	}
	if(form.p1.value.length==5){
		form.p1.value=form.p1.value + "/";
	}
}

function mascara_periodo_2(form){
	if(form.p2.value.length==2){
		form.p2.value=form.p2.value + "/";
	}
	if(form.p2.value.length==5){
		form.p2.value=form.p2.value + "/";
	}
}

function verificaForm (form){
	if(form.editoria.value==0){
		alert("Selecionar a Editoria");
		return false;
	}else	
	if(form.entidade.value==0){
		alert("Selecione a Entidade");
		return false;
	}else	
	return true;	
	
}
</script>



  <ul>
  
    <li>&raquo; <a href="index.php?pagina=notmanchetes"> MANCHETES</a></li>
    
    <li>&raquo; <a href="index.php?pagina=notultimas"> &Uacute;LTIMAS NOT&Iacute;CIAS </a></li>
    
    <li>&raquo; <a href="index.php?pagina=calendario">CALEND&Aacute;RIO</a></li> 
    
    <li>&raquo; <a href="index.php?pagina=agendaeventos">AGENDA DE EVENTOS</a></li>    
    
    <li><br>FAZER CONSULTA: 
    
     <ul> 
    
    <li>

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
    &raquo; editoria<br>
    	<form name="form" method="get" action="index.php"  onsubmit="return verificaForm(this)">
        <input type="hidden" name="pagina" value="resultbusca" />
        <select name="ed" class="componente_menu">
        <option value="9999"> &nbsp;&nbsp;Todas </option>
        <option value="0"></option>
        <?PHP			
        while($V_edit = pg_fetch_object($V_editorias))
        {				
        ?> 
        <option value="<?=$V_edit->edit_id?>"> &nbsp;&nbsp;<?=$V_edit->edit_nome?> </option>
        <?PHP 
        } 
        ?> 
        <option value="0"></option>          
        </select>   
    </li>
    
    <li>
    &raquo; entidade<br>
        <select name="ent" class="componente_menu">
        <option value="9999"> &nbsp;&nbsp;Todas </option>
        <option value="0"> </option>
        <option value="0"> &nbsp;&nbsp;=== Prefeitura === </option>
        <option value="0"> </option>
        <?PHP			
        while($V_principais = pg_fetch_object($V_entidades_prefeitura))
        {				
        ?> 
        <option value="<?=$V_principais->entidade_id?>"> &nbsp;<?=$V_principais->entidade_nome?> </option>
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
        <option value="<?=$V_executivas->entidade_id?>">&nbsp;&nbsp;<?=$V_executivas->entidade_nome?> </option>
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
        <option value="<?=$V_municipais->entidade_id?>">&nbsp;&nbsp;<?=$V_municipais->entidade_nome?> </option>
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
        <option value="<?=$V_org->entidade_id?>">&nbsp;&nbsp;<?=$V_org->entidade_nome?> </option>
        <?PHP 
        } 
        ?>  
        <option value="0"> </option>                     
        </select >
    </li>
    
    <li>
    &raquo; assunto<br>
        <input type="text" name="as" class="componente_menu" />    
    </li>
    
    <li>
    &raquo; per&iacute;odo<br>
	<!-- calendar attaches to existing form element -->
	<input name="p1" type="text" size="10" maxlength="10" class="componente_menu_peq" onkeyup="mascara_periodo(form)" /> &agrave; 
    <?php
    	$data = date("d/m/Y");
	?>
    <input name="p2" type="text" size="10" maxlength="10" value="<?=$data?>" class="componente_menu_peq" onkeyup="mascara_periodo_2(form)" /><br />
    <font size="1"> Ex: 00/00/0000 &nbsp; &agrave; &nbsp; 00/00/0000</font>
	
    
   
       
    </li>
    
    <li>
    <input type="submit" value="OK" />
    </form>
    <!--<div class="botao_amarelo"><span><a href="index.php?pagina=resultbusca">OK</a></span></div>-->
    <br class="clearfloat" />
    </li>    
    
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



