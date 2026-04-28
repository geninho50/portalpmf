<div id="cabecalho_wrapper">
<div id="cabecalho_ilustracao">
<div id="cabecalho">

<?php 
//-------------------------------
// Define o caminho dos arquivos 
//-------------------------------
if($menu_principal == "intranet" || $menu_principal == "entidade" || $menu_principal == "governo"  || $menu_principal == "noticias" || $menu_principal == "ouvidoria"|| $menu_principal == "adm" || $menu_principal == "servicos" || $menu_principal == "midia" || $menu_principal == "login"){
	$caminho = "../../entidades/";
	$caminho2= "../../";
	$caminhoRaiz= "../";
}else{
	$caminho  = "../entidades/";
	$caminho2 = "../";
	$caminhoRaiz = "./";
}
?>

<!-- marca e link para home -->
<div id="marca_pmf"><a href="<?php echo($caminho2);?>"><img src="<?php echo($caminho2);?>/layout/imagens/marca-pmf.png"></a></div>

<div id="cabecalho_menu">

<?php
//--------------------------------------------
// Define o menu Pincipal do Portal - Externo
//--------------------------------------------
if (($menu_principal == "login")  || ($menu_principal == "home")  || ($menu_principal == "governo") || ($menu_principal == "servicos") || ($menu_principal == "noticias") || ($menu_principal == "ouvidoria") || ($menu_principal == "midia")){
	//--------------------------
	// verificação de segurança
	//--------------------------
	echo "<div style=\"display:none\">";
	require_once($caminhoRaiz."scripts/php/security.php");
	echo "</div>";
	?>
    <ul>
    	<li><a href="<?php echo($caminho2);?>" <?php if($menu_principal=="home"){echo("class=\"ativo\"");}?> target="_self">HOME</a></li>
        <li><a href="<?php echo($caminho2);?>entidades/turismo/index.php" target="_self">CIDADE</a></li>
        <li><a href="<?php echo($caminho2);?>governo/index.php" <?php if($menu_principal=="governo"){echo("class=\"ativo\"");}?> target="_self">GOVERNO</a></li>
        <li><a href="<?php echo($caminho2);?>servicos/index.php" <?php if($menu_principal=="servicos"){echo("class=\"ativo\"");}?> target="_self">SERVI&Ccedil;OS</a></li>
        <li><a href="<?php echo($caminho2);?>noticias/index.php" <?php if($menu_principal=="noticias"){echo("class=\"ativo\"");}?> target="_self">NOT&Iacute;CIAS</a></li>
        <li><a href="<?php echo($caminho2);?>midia/index.php" <?php if($menu_principal=="midia"){echo("class=\"ativo\"");}?> target="_self">M&Iacute;DIA</a></li>
        <li><a href="<?php echo($caminho2);?>ouvidoria/index.php" <?php if($menu_principal=="ouvidoria"){echo("class=\"ativo\"");}?> target="_self">OUVIDORIA</a></li>
        <li style="display:none;"><a href="<?php echo($caminho2);?>servicos/index.php?pagina=onibus" target="_self">HORARIO DE ONIBUS</a></li>
    </ul>

<?php 
}
//-----------------------------------------------------------
// Define o menu Principal das Entidades do Portal - Externo
//-----------------------------------------------------------
if ($menu_principal == "entidade"){ 
	//--------------------------
	// verificação de segurança
	//--------------------------
	echo "<div style=\"display:none\">";
	require_once(CAMINHO_SITE."/scripts/php/security.php");
	echo "</div>";
	
		echo "<div id=\"intranet_titulo\">";
        
		//-------------------------------------------------------------------
		// Define o tamanho da fonte conforme a extenção do Nome da Entidade 
		//-------------------------------------------------------------------      
		echo "<h4>".$TipoEntidadeNome."</h4>";
		if (strlen($Nome1) <= 20) {    
			echo"<h1>".$Nome1."</h1>";   
		}else if (strlen($Nome1) <= 40) {
			echo"<h2>".$Nome1."</h2>"; 	
		}else {
			echo"<h3>".$Nome1."</h3>"; 
			
		}
		
		echo "</div>";

		?>

<?php 
} 
//-------------------------------------
// Define o menu Principal da INTRANET
//-------------------------------------
if(($menu_principal == "intranet") || ($menu_principal == "internet")){  ?>
	<div id="intranet_titulo">
       <?php
	   
	   $TuserId = $_SESSION['SuserId'];
	$sqlEntidades	= "SELECT PERM.*, ENT.* FROM intranet_permissoes AS PERM INNER JOIN entidades AS ENT ON PERM.intranet_entidade_id = ENT.entidade_id WHERE PERM.intranet_user_id = $TuserId ORDER BY ENT.entidade_tipo ASC, ENT.entidade_linha_1";
	$TresultEnt		= $drive->pedido($sqlEntidades);
	$i = 0;
	while ($Tentidades = pg_fetch_object($TresultEnt)){
		$TentidadeId[$i] 	= $Tentidades->entidade_id;
		$TentidadeNome[$i] 	= $Tentidades->entidade_linha_1;
		$TentidadeTipo[$i]	= $Tentidades->entidade_tipo;
		$i++;
	}
	?>
    <form action="inicio.php" method="post">
		<label>INTRANET CORPORATIVA
	       	<select name="entid_intranet" class="combosecretarias" onchange="this.form.submit();"> 	
                <?php
                if (in_array(0,$TentidadeTipo)){
					?>
					<option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Prefeitura === </option>									
					<?php
					for($j=0; $j<count($TentidadeId); $j++){
						if($TentidadeTipo[$j] == 0){
							echo "<option value=\"".$TentidadeId[$j]."\"";
							if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
								echo " selected=\"selected\" ";
							}
							echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TentidadeNome[$j]."</option>";
						}
					}
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>	 										
                    <?php		
				} 
				 if (in_array(4,$TentidadeTipo)){
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Secretarias Municipais ===</option>										
                    <?php
               		for($j=0; $j<count($TentidadeId); $j++){
						if($TentidadeTipo[$j] == 4){
							echo "<option value=\"".$TentidadeId[$j]."\"";
							if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
								echo " selected=\"selected\" ";
							}
							echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TentidadeNome[$j]."</option>";
						}
					}
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>	 										
                    <?php
                }               
                if (in_array(5,$TentidadeTipo)){
					?>
                	<option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Secretarias Executivas === </option>					
					<?php
					for($j=0; $j<count($TentidadeId); $j++){
						if($TentidadeTipo[$j] == 5){
							echo "<option value=\"".$TentidadeId[$j]."\"";
							if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
								echo " selected=\"selected\" ";
							}
							echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TentidadeNome[$j]."</option>";
						}
					}	
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>	 										
                    <?php	
				}
               		
                if (in_array(6,$TentidadeTipo)){
					?>
                	<option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Org&atilde;os ===</option>							
                	<?php
               		for($j=0; $j<count($TentidadeId); $j++){
						if($TentidadeTipo[$j] == 6){
							echo "<option value=\"".$TentidadeId[$j]."\"";
							if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
								echo " selected=\"selected\" ";
							}
							echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TentidadeNome[$j]."</option>";
						}
					}
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>	 										
                    <?php
                }	
                
				if (in_array(7,$TentidadeTipo)){
					?>
                	<option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Eventos ===</option>							
                	<?php
               		for($j=0; $j<count($TentidadeId); $j++){
						if($TentidadeTipo[$j] == 7){
							echo "<option value=\"".$TentidadeId[$j]."\"";
							if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
								echo " selected=\"selected\" ";
							}
							echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TentidadeNome[$j]."</option>";
						}
					}
					?>
                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>	 										
                    <?php
                }		
                ?>				
            </select>          
        </label>
	</form>
	
       
       <h4>usuário: <?=$_SESSION['SuserNome']?> <a href="../intranet/logout.php" target="_self" target="_self">LOGOUT</a></h4>
    </div>
<?php 
}
?>


</div>  <!-- fim cabecalho_menu -->
<div id="menu_entidades">

<?php 
//---------------------------------------------------------------------------------------
// COMBO com as entidades HABILIDATAS para o usuário da INTRANET e ATUALIZAÇÃO DO PORTAL
//---------------------------------------------------------------------------------------
if(($menu_principal != "intranet") && ($menu_principal != "internet")){ 
//-----------------------------------------
// COMBO das Entidades para acesso Externo
//-----------------------------------------
	// ########################### Select Entidades PREFEITURA ###########################				
	$sql2 = "SELECT * FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
	$V_entidades_prefeitura = $drive->pedido($sql2);	
	// ########################### Select Entidades SECRATARIAS MUNICIPAIS ###########################				
	$sql2 = "SELECT * FROM entidades WHERE entidade_tipo = 4 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
	$V_entidades_municipais = $drive->pedido($sql2);	
	// ########################### Select Entidades SECRETARIAS EXECUTIVAS ###########################				
	$sql3 = "SELECT * FROM entidades WHERE entidade_tipo = 5 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
	$V_entidades_executivas = $drive->pedido($sql3);
	// ########################### Select Entidades SECRETARIAS EXECUTIVAS ###########################				
	$sql4 = "SELECT * FROM entidades WHERE entidade_tipo = 6 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
	$V_orgaos = $drive->pedido($sql4);		
	?>
	<label>
		<select name="select" id="select" class="combosecretarias" onchange="window.open('<?=$caminho?>' + this.value,'_self');">
            <option value="../index.php" selected="selected">Secretarias e &Oacute;rg&atilde;os </option>
            <option value="../index.php"> </option>
            <option value="../index.php"  title="Pagina Inicial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home Portal</option>   
            <option value="../index.php"> </option>     	
				<?php if(pg_num_rows($V_entidades_prefeitura) != 0){?>	
                    <option value="../index.php"> &nbsp;&nbsp;=== Prefeitura === </option>									
					<?php							
					while($V_principais = pg_fetch_object($V_entidades_prefeitura)){						
					?> 					
					<option value="<?=$V_principais->entidade_path?>" title="<?=$V_principais->entidade_nome?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$V_principais->entidade_linha_1?> </option>
					<?php 					
					}
				}
				if(pg_num_rows($V_entidades_municipais) != 0){ 						
					?> 	
                    <option value="../index.php"> </option>										
					<option value="../index.php"> &nbsp;&nbsp=== Secretarias Municipais ===</option>										
					<?php								
					while($V_municipais = pg_fetch_object($V_entidades_municipais)){		
					?> 					
					<option value="<?=$V_municipais->entidade_path?>" title="<?=$V_municipais->entidade_nome?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$V_municipais->entidade_linha_1?> </option>
					<?php 					
					} 
				}
				if(pg_num_rows($V_entidades_executivas) != 0){ 					
					?>
                    <option value="../index.php"> </option>	 										
					<option value="../index.php"> &nbsp;&nbsp;=== Secretarias Executivas === </option>					
					<?php						
					while($V_executivas = pg_fetch_object($V_entidades_executivas)){			
					?> 					
					<option value="<?=$V_executivas->entidade_path?>" title="<?=$V_executivas->entidade_nome?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$V_executivas->entidade_linha_1?> </option>

					<?php 					
					} 
				}
				if(pg_num_rows($V_orgaos) != 0){ 					
					?>  
                    <option value="../index.php"> </option>	  									
					<option value="../index.php"> &nbsp;&nbsp=== Org&atilde;os ===</option>					
					<?php								
					while($V_org = pg_fetch_object($V_orgaos)){							
					?> 					
					<option  value="<?=$V_org->entidade_path?>" title="<?=$V_org->entidade_nome?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$V_org->entidade_linha_1?> </option>		
					<?php					
					}
				} 					
				?>					
		</select>
	</label>
<?php 
} 
?>


</div>  <!-- fim menu_entidades -->



<?php 
//-------------------------------------------------------------
// Define o menu Principal do Sistema de Atualização do Portal
//-------------------------------------------------------------

if(($menu_principal != "intranet") && ($menu_principal != "internet")){  ?>
				<div id="menu_secundario">
                <div id="redes_sociais">
                    <ul>
                        <li class="twitter"><a href="http://www.twitter.com/scflorianopolis" target="_blank"></a></li>
                    </ul>
                </div>
                
                <div id="menu_interno">
                    <ul>
                        <li><a href="<?php echo($caminho2);?>intranet/index.php" target="_self">intranet</a></li>
                        <li><a href="https://webmail.pmf.sc.gov.br/" target="_self">e-mail</a></li>
                    </ul>
                </div>
                </div>  <!-- fim menu_secundario -->

<?php 
} 
?>




</div>  <!-- fim do cabecalho -->
<br class="clearfloat" />
</div>  <!-- fim do cabecalho-ilustracao -->
</div>  <!-- fim do cabecalho-wrapper -->