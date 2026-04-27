<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");
if(!isset($_POST['entidade'])){
	$_POST['entidade']=$_SESSION['SuserEnt'];
	$Tpasso = 1;
}
?>

<script>
function verificaForm (form){	
	if(form.entidade.value==""){
		alert("Selecione a Entidade");
		return false;
	}else	
	return true;
}
</script> 

<?
$idzinho = $_GET['id'];
	require_once("../scripts/php/funcoes_bd.php");		
	require_once("../scripts/php/funcoes.php");	
	$drive->conecta();
?> 
   		
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">contatos</div>
    <div id="coluna_intranet_unica">
	<div>
		<div id="topo_editais">
			<form method="post" name="form" onsubmit="return verificaForm(this)">
			<table><tr><td>
                <input type="hidden" name="passo" value="1" />
                <?php         
					combo_entidades($drive, "entidade", $_POST['entidade']);
				?>
                </td><td>               
                <input type="image" name="enviar" id="enviar" src="../layout/imagens/atualiza_btn_OK.png" align="absmiddle"/>         
            </td></tr></table>         
            </form><br><br>
			<?php           
		    if($_POST['passo'] == 1 or ($Tpasso == 1)){    
				if(!isset($_POST['entidade'])){
					$entidade_id=$_SESSION['SuserEnt'];
				}else{      
		    		$entidade_id =  $_POST['entidade'];           
				}
			$sql = "SELECT * FROM entidades WHERE entidade_id = $entidade_id";           
		    $result = $drive->pedido($sql);
		    $V_entidade = pg_fetch_object($result);    			
		               
			$sql = "SELECT
						*
					FROM
						setores
					WHERE
						setor_entidade_id = $entidade_id
					ORDER BY
						setor_posicao";
			
			$result = $drive->pedido($sql);
			$indice = 0;
			while($all_setores = pg_fetch_object($result)){
				$setores_id[$indice] = $all_setores->setor_id;	
				$setores_nome[$indice] = $all_setores->setor_nome;	
				$setores_local_id[$indice] = $all_setores->setor_local_id;		
				$indice++;
			}            
			for($i=0; $i < $indice; $i++){
				$sql = "SELECT 
							* 
						FROM 
							locais 
						WHERE
							loc_id = $setores_local_id[$i]";

				$result = $drive->pedido($sql);
				$local = pg_fetch_object($result);
			?>         
               <span class="titulo_quem_e_quem"><?=$setores_nome[$i]?></span><br><br>
                <p><?=$local->loc_rua?>, nº<?=$local->loc_num?> - <?=$local->loc_complemento?><br />				
                <?=$local->loc_bairro?> CEP: <?=$local->loc_cep?><br />				
                Telefone: <?=$V_telefone = " (".substr($local->loc_fone,0,2).") ".substr($local->loc_fone,2,4)."-".substr($local->loc_fone,6,4);?>  <br />	
    			E-mail: <?=$local->loc_email?>@pmf.sc.gov.br</p>
				<br>				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">				
				<?PHP					
				$V_ent_id = $V_entidade->entidade_id;
				
				$sql = "SELECT USERI.*, CARGO.* FROM uni_usuarios AS USERI
						 JOIN cargos AS CARGO ON USERI.user_cargo_id = CARGO.cargo_id							
						WHERE 
							USERI.user_entidade_id = $V_ent_id 
						AND
							USERI.user_setor_id = $setores_id[$i]
						AND 
							USERI.user_quem = 't' 
						ORDER BY 
							CARGO.cargo_posicao"; 		
				
				$result = $drive->pedido($sql);					
				$alterna = 2;				
				while($V_usuario = pg_fetch_object($result)){					
					$V_telefone = "(".substr($V_usuario->user_fone,0,2).") ".substr($V_usuario->user_fone,2,4)."-".substr($V_usuario->user_fone,6,4);			
					$V_cargo_id = $V_usuario->user_cargo_id;				
					$sql2 = "SELECT * FROM cargos WHERE cargo_id = $V_cargo_id";				
					$result2 = $drive->pedido($sql2);				
					$V_cargo2 = pg_fetch_object($result2);				
					if($alterna%2 == 0){					
						$classe = "result_busca_governoB";				
					}else{				
						$classe = "result_busca_governo";
					}			
					$user_nome = utf8_encode($V_usuario->user_nome);
					$cargo_nome = utf8_encode($V_cargo2->cargo_nome);
					$imprime = "				
						<tr>				
							<td class=\"$classe\" width=\"57%\">				
								<strong>$user_nome</strong><br >				
								$cargo_nome				
							</td>				
							<td class=\"$classe\" width=\"43%\">				
								$V_telefone<br />				
								<a href=\"mailto:$V_usuario->user_email@pmf.sc.gov.br\">$V_usuario->user_email@pmf.sc.gov.br</a>				
							</td>				
						</tr>"; 				
					echo($imprime);				
					$alterna++;
					
				} 				
				?>				
				</table>				
				<br /><br />				
				<?php				
				}				
			}					
			?>	
    	</div>        
	</div>   
 </div>
     
</div>