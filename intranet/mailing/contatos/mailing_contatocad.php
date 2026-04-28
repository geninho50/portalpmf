<script language="javascript">
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Contato?')){
		return true;
	}else{
		return false;
	}
}
</script>

<?php
//------------------------------------------------------------------
//recupera o nome da entidade a qual o novo usuário será cadastrado
//------------------------------------------------------------------
$TcategoriaId = $_GET['catId'];
$sqlCategoria =  "SELECT * FROM mailing_categoria WHERE mailing_categoria_id = $TcategoriaId";
$TreturnCat	  = $drive->pedido($sqlCategoria);
$Tcategoria   = pg_fetch_object($TreturnCat);

//----------------------------------------------------------------
//recupera todos os caontatos cadastrados na categoria em questao
//----------------------------------------------------------------
$sqlContato	= "SELECT * FROM mailing_contato WHERE mailing_contato_categoria = $TcategoriaId AND mailing_contato_excluido = 'f' ORDER BY mailing_contato_nome ASC";
$TreturnCnt	= $drive->pedido($sqlContato);

?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<div id="margem_direita">
    	<br />
		<div class="conteudo_abas">        
			<div id="conteudo_menu" style="display:inline">
				<table width="600" border="0" cellspacing="0" cellpadding="0">
					<tr>
                   		<td  class="result_busca_adm" colspan="2">
                        	<h3>
                            <img src="../layout/imagens/intra_icon_contato.png" alt="editar" border="0" align="absmiddle" /> 
                            lista de contatos: <span><?=$Tcategoria->mailing_categoria_nome?></span>
                            </h3><br />
                        </td>
                    </tr>
                    <?php
					$i = 0;
                    while($Tcontato = pg_fetch_object($TreturnCnt)){
						echo"
							<form method=\"post\">
							<input type=\"hidden\" name=\"FcntId\" value=\"".$Tcontato->mailing_contato_id."\" />
							<tr>
								<td class=\"result_busca_admB\" width=\"480\">
									<img src=\"../layout/imagens/intra_icon_contato2.png\" alt=\"editar\" border=\"0\" align=\"absmiddle\" /> 
									<strong>".$Tcontato->mailing_contato_nome."</strong>
								</td>
								<td class=\"result_busca_admB\" width=\"120\">
									<a href=\"inicio.php?pagina=mailcontatoedit&menu=".$_GET['menu']."&cntId=".$Tcontato->mailing_contato_id."\" class=\"toggleopacity\">
										<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" />
									</a> 
									<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExclui\" id=\"btExclui\" value=\"btExclui\" align=\"absmiddle\" onclick=\"return verificaExclusao()\" />                      
								</td>
							</tr>
							</form>						
						";	
					$i++;
					}
					if($i==0){
						echo"
							<tr>
								<td class=\"result_busca_admB\" width=\"480\">
									<b>Nenhum Contato Cadastrado</b>
								</td>
							</tr>
							";
					}
					?>                    
				</table>
				<br />
				<a href="inicio.php?pagina=mailcontatoinclui&menu=<?=$_GET['menu']?>&catId=<?=$_GET['catId']?>"><img src="../layout/imagens/intra_btn_contato.png" alt="incluir contato" border="0" /></a>       
				<a href="inicio.php?pagina=mailcategcad&menu=8"><img src="../layout/imagens/intra_btn_voltar.png" alt="incluir voltar" border="0" /></a></div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['btExclui_x'])){
	//-------------------------------------------------------------
	//Faz a exclusão do contato na base de dados - Exclusão LÓGICA
	//-------------------------------------------------------------
	$TcntId 	= $_POST['FcntId'];
	$sqlDelete  = "UPDATE mailing_contato SET mailing_contato_excluido = 't' WHERE mailing_contato_id = $TcntId";
	$TresultDel	= $drive->pedido($sqlDelete);
	if($TresultDel){
		echo("<script>alert('Contato Excluido com Sucesso')</script>");	
		echo("<script>window.location = \"inicio.php?pagina=mailcontatocad&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}else{
		echo("<script>alert('Nao foi possivel Excluir o Contato')</script>");
		echo("<script>window.location = \"inicio.php?pagina=mailcontatocad&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}
}
?>