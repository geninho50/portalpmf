<?php 
//-------------------------------
// Define o caminho dos arquivos 
//-------------------------------
if($menu_principal == "entidade" || $menu_principal == "governo"  || $menu_principal == "noticias" || $menu_principal == "ouvidoria"|| $menu_principal == "adm" || $menu_principal == "servicos"){
	$caminho = "../../entidades/";
	$caminho2= "../../";
}else{
	$caminho  = "../entidades/";
	$caminho2 = "../";
}
//--------------------------------------------
// Define o menu Pincipal do Portal - Externo
//--------------------------------------------
if (($menu_principal == "home") || ($menu_principal == "governo") || ($menu_principal == "servicos") || ($menu_principal == "noticias") || ($menu_principal == "ouvidoria")){
	//--------------------------
	// verificação de segurança
	//--------------------------
	require_once(CAMINHO_SITE."/scripts/php/security.php");	
	?>
    <div id="linksmenu"> 
        <a href="<?=$caminho2?>adm/index.php" id="intranet" target="_self">INTRANET</a>
        <a href="http://webmail.pmf.sc.gov.br" id="mail" target="_self">MAIL</a>
        <a href="http://portal.pmf.sc.gov.br" id="principal" target="_self">HOME</a> 
        <a href="<?=$caminho2?>entidades/turismo/index.php" id="cidade" target="_self">CIDADE</a>
        <a href="<?=$caminho2?>governo/index.php" id="governo" target="_self">GOVERNO</a>
        <a href="<?=$caminho2?>servicos/index.php" id="servicos" target="_self">SERVI&Ccedil;OS</a>
        <a href="<?=$caminho2?>noticias/index.php" id="noticias" target="_self">NOT&Iacute;CIAS</a>
        <a href="<?=$caminho2?>ouvidoria/index.php" id="ouvidoria" target="_self">OUVIDORIA</a>
        <div style="display:none;">
        	<a href="./servicos/index.php?pagina=onibus" id="onibus" target="_self">HORARIO DE ONIBUS</a>
        </div>
    </div>
<?php 
}
//-----------------------------------------------------------
// Define o menu Principal das Entidades do Portal - Externo
//-----------------------------------------------------------
if ($menu_principal == "entidade"){ 
	//--------------------------
	// verificação de segurança
	//--------------------------
	require_once(CAMINHO_SITE."/scripts/php/security.php");


	echo "<div id=\"linksmenu\">"; 
		//----------------------------------------
		// Centraliza o texto do tipo da Entidade
		//----------------------------------------
		if (strlen($TipoEntidadeNome) <= 10){ 
			echo "<h4><br>".$TipoEntidadeNome."</h4>";
		}else{ 
			echo "<h4>".$TipoEntidadeNome."</h4>";
		}  
		//-------------------------------------------------------------------
		// Define o tamanho da fonte conforme a extenção do Nome da Entidade 
		//-------------------------------------------------------------------      
		if (strlen($Nome1) <= 30){    
			echo"<h1>".$Nome1."</h1>";   
		}else{
			if (strlen($Nome1) <= 40){
				echo"<h2>".$Nome1."</h2>";
			}else{
				echo"<h3>".$Nome1."</h3>"; 
			}
		}
		?>  
		<a href="../../index.php" id="marca" target="_self">
			<i>
				<img src="menus/imagens/item_menu.jpg" width="320" height="70" border="0" usemap="#Map2" />
				<map name="Map2" id="Map2">
					<area shape="rect" coords="3,4,318,67" href="index.php" target="_self" />
				</map>
			</i>
		</a> 
		<a href="<?=$caminho2?>adm/index.php" id="intranet" target="_self">INTRANET</a>
		<a href="http://webmail.pmf.sc.gov.br" id="mail" target="_self">MAIL</a>        
	</div>
<?php 
} 
//-------------------------------------
// Define o menu Principal da INTRANET
//-------------------------------------
if ($menu_principal == "intranet") { ?>
	<div id="linksmenu">  
		<h4>área privada</h4>
		<h2>intranet corporativa</h2>
		<h6>
			<?=$_SESSION['SuserNome']?><br>
			<a href="../intranet/logout.php" target="_self">
            	<img src="../layout/imagens/intra_btn_logout.png" border="0">
            </a>
		</h6>
		<a href="../index.php" id="marca" target="_self">
        	<i>
                <img src="menus/imagens/item_menu.jpg" width="320" height="70" border="0" usemap="#Map3" />
                <map name="Map3" id="Map3">
                    <area shape="rect" coords="3,4,317,67" href="index.php" target="_self" />
                </map>
			</i>
      	</a> 
	</div>
<?php 
}
//-------------------------------------------------------------
// Define o menu Principal do Sistema de Atualização do Portal
//-------------------------------------------------------------
if ($menu_principal == "internet") {  ?>
    <div id="linksmenu">       
        <h4>área privada</h4>
        <h2>Atualiza&ccedil;&atilde;o do Portal Corporativo</h2>
        <h6>
            <?=$_SESSION['SuserNome']?><br>
            <a href="../intranet/logout.php" target="_self">
                <img src="../layout/imagens/intra_btn_logout.png" border="0" >
            </a>
        </h6>
        <a href="../index.php" id="marca" target="_self">
            <i>
                <img src="menus/imagens/item_menu.jpg" width="320" height="70" border="0" usemap="#Map3" />
                <map name="Map3" id="Map3">
                    <area shape="rect" coords="3,4,317,67" href="index.php" target="_self" />
                </map>
            </i>
        </a> 
	</div>
<?php 
}
//---------------------------------------------------------------------------------------
// COMBO com as entidades HABILIDATAS para o usuário da INTRANET e ATUALIZAÇÃO DO PORTAL
//---------------------------------------------------------------------------------------
if(($menu_principal == "intranet") || ($menu_principal == "internet")){ 
	$TuserId 		= $_SESSION['SuserId'];
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
		<label>
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
<?php 
}else{ 
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