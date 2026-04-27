<?php
//------------------------------------------
// Página implementada em : 30/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

//-----------------------------------
// Busca dados do usuário em questão
//-----------------------------------
$TuserId 	 = $_GET['us'];
$sqlUser 	 = "SELECT * FROM uni_usuarios WHERE user_id = $TuserId";
$TreturnUser = $drive->pedido($sqlUser); 
$TuserDados	 = pg_fetch_object($TreturnUser);
$_SESSION['entidade_id'] = $TuserDados->user_entidade_id;
//--------------------------------------------------
// Busca quais as entidades o usuário já tem acesso
//--------------------------------------------------
$sqlPerm	 = "SELECT 
					PERM.intranet_perm_id,
					PERF.intranet_perfil_nome,
					ENT.entidade_sigla,
					ENT.entidade_nome,
					ENT.entidade_id
				FROM
					(intranet_permissoes AS PERM
				INNER JOIN
					intranet_perfil AS PERF
				ON
					PERM.intranet_perfil_id = PERF.intranet_perfil_id)
				INNER JOIN
					entidades AS ENT
				ON	
					PERM.intranet_entidade_id = ENT.entidade_id
				WHERE
					PERM.intranet_user_id = $TuserId
				ORDER BY
					ENT.entidade_id ASC";

$TreurnPerm	 = $drive->pedido($sqlPerm);

?>

<script type="text/javascript">

function MostraPermissao(){
    document.getElementById('permissao').style.display = 'block';
}

function EscondePermissao(){
    document.getElementById('permissao').style.display = 'none';
}

function verificaExclusao(){
	if(confirm('Tem certeza que deseja Remover a Permissao?')){
		return true;
	}else{
		return false;
	}
}

</script> 
 
<?php
//-----------------------------------------------------------------
// Verifica se foi solicitado alguma exclusão de perfil do usuário
//-----------------------------------------------------------------
if(isset($_POST['btExclui_x'])){

	$TperId = $_POST['FpermId'];
	$sqlExc = "DELETE FROM intranet_permissoes WHERE intranet_perm_id = $TperId";
	$TresEx = $drive->pedido($sqlExc);

	if($TresEx == TRUE){
		echo("<script>alert(\"Permissao Removida com Sucesso!\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=useredit&menu=".$_GET['menu']."&us=".$_GET['us']."\";</script>");	
	}else{
		echo("<script>alert(\"Servidor Ocupado\\n\\nTente novamente dentro de alguns instantes\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=useredit&menu=".$_GET['menu']."&us=".$_GET['us']."\";</script>");	
	}
}

//------------------------------------------------------------------------
// Se não foi solicitado exclusão ou inclusão de perfis mostra tela geral
//------------------------------------------------------------------------
if(!isset($_POST['btInclui_x'])){
?> 
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">permissões de usuário</div>
	<div id="margem_direita"><br>	   
		<div class="conteudo_abas">
			<div id="conteudo_dados" style="display:inline">
				<h3>
                    <div class="texto_formulario">Nome:</div>
                    <input type="text" name="nome" class="componente_grande" value="<?=utf8_encode($TuserDados->user_nome)?>" disabled="disabled" style="background-color:#EEEEEE;" /><br>
                    <div class="texto_formulario">Matrícula:</div>
                    <input type="text" name="matricula" class="componente_grande" value="<?=$TuserDados->user_maticula?>" disabled="disabled" style="background-color:#EEEEEE;" />
                    <br /><br />  
				</h3> 
				<hr size="1" noshade="noshade" width="100%" color="#999999"><br>
                <h2>permissões atuais</h2>
                
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                		<td width="275" class="container_item_result">entidade</td>
                		<td width="275" class="container_item_result">perfil de acesso</td>
                		<td width="50" class="container_item_result"><h2>&nbsp;</h2></td>
                	</tr>
					<?php
                    while($TpermDados	 = pg_fetch_object($TreurnPerm)){
                    ?>
                    <form method="post" action="inicio.php?pagina=useredit&menu=<?=$_GET['menu']?>&us=<?=$_GET['us']?>">
                    <input type="hidden" name="FpermId" value="<?=$TpermDados->intranet_perm_id?>" />
                    <tr>
                        <td class="container_item_result"><strong><?=$TpermDados->entidade_nome?></strong></td>
                        <td class="container_item_result"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?=$TpermDados->intranet_perfil_nome?></strong></td>
                        <td class="container_item_result">
                       		<?php
							if(($_SESSION['SuserEnt'] != $TpermDados->entidade_id) OR ($_SESSION['SuserPerfilId'] == 1)){
							?>
                            <input type="image" src="../layout/imagens/intra_btn_remover.png" name="btExclui" id="btExclui" value="btExclui" onclick="return verificaExclusao()" />    
                        	<?php } ?>
                        </td>
	                </tr>
                    </form>
                    <?php } ?>        
                </table>
                <br />
				<p>                
                <a href="?pagina=useredit&menu=<?=$_GET['menu']?>&us=<?=$_GET['us']?>&acao=novo" class="toggleopacity"> <img src="../layout/imagens/atualiza_btn_incluir.png" alt="incluir"  border="0" align="absmiddle" /></a></p>
				<?php
                if(!empty($_GET['acao'])){
				
				//-----------------------------------
				// Incluir nona permissão ao usuário
				//-----------------------------------
				?>
                <form method="post" action="inicio.php?pagina=useredit&menu=<?=$_GET['menu']?>&us=<?=$_GET['us']?>">
                <div id="permissao"> 	
					<hr size="1" width="100%" noshade="noshade" color="#999999">
                    <br>
                    <h2>configurar permissões</h2><br>                    
                    <div class="texto_formulario">Entidade:</div> 
                    <?php
                    include("../scripts/php/funcoes.php");
					
					combo_entidades($drive, "entidade","","idPermissoes");
					
					echo "<br /><div class=\"texto_formulario\">Perfil:</div>"; 
                    
					$sqlPerfil = "SELECT * FROM intranet_perfil ORDER BY intranet_perfil_nome ";
					
					$drive->conecta();
					$Tresult = $drive->pedido($sqlPerfil);
					$drive->close();
					
                    echo "<select name=\"perfil\" class=\"componente_miolo\">";
					while($Tperfil = pg_fetch_object($Tresult)){
                    	echo "<option value=\"".$Tperfil->intranet_perfil_id."\">".$Tperfil->intranet_perfil_nome."</option>";
					}
                    echo "</select >";
                    ?>
                    <br> 
                    <br>
                    <br>
                    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="btInclui" align="absmiddle" />
                    </a> 
                    <a href="javascript:EscondePermissao()" class="toggleopacity">
                    <img src="../layout/imagens/intra_btn_cancelar.png"  border="0" align="absmiddle" />
                    </a>          
				</div>
                </form>
                <?php } ?>
            </div>
        </div>        
    </div>
</div>
<?php
}else{
	
	//----------------------------------
	// Insere nova permissão ao usuário
	//----------------------------------
	$TentidadeId  = $_POST['entidade'];
	$TperfilId	  = $_POST['perfil'];
	$TuserId	  = $_GET['us'];
	
	$sqlVerifica  = "SELECT * FROM intranet_permissoes WHERE intranet_entidade_id = $TentidadeId AND intranet_user_id = $TuserId";
	$TreturnVer   = $drive->pedido($sqlVerifica);
	$TnumReg	  = pg_fetch_object($TreturnVer);

	//------------------------------------------------------------------
	// Verifica se ja existe um perfil do usuário na entidade escolhida
	//------------------------------------------------------------------
	if($TnumReg == false){
	
		$sqlInsere    = "INSERT INTO 
							intranet_permissoes(
								intranet_perm_id,
								intranet_user_id,
								intranet_perfil_id,
								intranet_entidade_id
						)VALUES(
								default,
								$TuserId,
								$TperfilId,
								$TentidadeId)";
								
		$TreturnIns	  = $drive->pedido($sqlInsere);
		
		if($TreturnIns == TRUE){
			echo("<script>alert(\"Permissao Incluida com Sucesso!\");</script>");
			echo("<script>window.location = \"inicio.php?pagina=useredit&menu=".$_GET['menu']."&us=".$_GET['us']."\";</script>");	
		}else{
			echo("<script>alert(\"Servidor Ocupado\\n\\nTente novamente dentro de alguns instantes\");</script>");
			echo("<script>window.location = \"inicio.php?pagina=useredit&menu=".$_GET['menu']."&us=".$_GET['us']."\";</script>");	
		}
	
	}else{
		echo("<script>alert(\"Já existe um perfil deste usuário nesta entidade\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=useredit&menu=".$_GET['menu']."&us=".$_GET['us']."\";</script>");
	}
}


?>
                    
