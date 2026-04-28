<?php
require_once('../../sistemas/comcap/licitacoes/scripts/php/conexao.class.php');
$objpg->conecta();

//----------------------------------------------------
// Recupera os dados do Edital que esta sendo baixado
//----------------------------------------------------
$sql 	 = "SELECT LIC.*, MODEL.*, EST.* FROM lic_dados AS LIC 
				INNER JOIN lic_modalidade AS MODEL ON MODEL.model_id = LIC.lic_model_id
				INNER JOIN lic_estado AS EST ON EST.est_id = LIC.lic_est_id 
			WHERE LIC.lic_id = ".$_GET['l']."
			ORDER BY LIC.lic_num DESC";
$TretSql = $objpg->pedido($sql);
$Tlic	 = pg_fetch_object($TretSql);

$TdataPub = explode("-", $Tlic->lic_data_cadastro);
$TdataPub = $TdataPub[2]."/".$TdataPub[1]."/".$TdataPub[0];

$TdataAbr = explode("-", $Tlic->lic_data_abertura);
$TdataAbr = $TdataAbr[2]."/".$TdataAbr[1]."/".$TdataAbr[0];

?>
<link rel="stylesheet" type="text/css" href="../../scripts/js/livevalidation/livevalidation13.css" />
<script type="text/javascript" src="../../scripts/js/livevalidation/livevalidation13.js"></script>
<script type="text/javascript" src="../../scripts/js/jmask/jquery.maskedinput.js" ></script>
<div id="cabecalho_servicos" class="canto_redondo">
	<div id="caminho_migalhas">home &gt; licitações</div>
	<div id="titulo_pagina">licitações da COMCAP</div>
	<div class="box_msg_baixo">Caso haja interesse no Edital, digite seu <b>E-mail</b> no campo abaixo para que possamos registrá-lo em nosso sistema, assim, para qualquer alteração voçê será notificado.</div> 
	<br />
</div>
<div id="area_servicos">
	<br /><br />
	<div>
    	<form method="post">
        <table width="500" border="0">
        	<tr>
            	<td width="120" align="center">
                	<img src="../../layout/imagens/logo_comcap.png" border="0" />
                </td>
                <td width="380" align="center">
                	Sistema de Divulgação de Editais de Licitação da Companhia Melhoramentos da Capital                 	
                </td>
            </tr>
            <tr>
            	<td colspan="2">
            		<hr size="1" width="100%"><br />
        		</td>
           	</tr>
            <tr>
            	<td colspan="2" align="center">
            		<b>Edital:</b> <font color="#1B9BE4"><?=$Tlic->model_desc?> <?=$Tlic->lic_num?></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Situação:</b> <font color="#1B9BE4"><?=$Tlic->est_desc?></font><br />&nbsp;
        		</td>
           	</tr>
            <tr>
            	<td colspan="2">
            		<hr size="1" width="100%"><br />
        		</td>
           	</tr>
            <tr>
            	<td colspan="2" align="center">
            		<b>Publicação:</b> <font color="#1B9BE4"><?=$TdataPub?> - <?=$Tlic->lic_hora_cadastro?></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Abertura Edital:</b><font color="#1B9BE4"> <?=$TdataAbr?> - <?=$Tlic->lic_hora_abertura?></font><br />&nbsp;
        		</td>
           	</tr>
            <tr>
            	<td colspan="2">
            		<hr size="1" width="100%"><br />
        		</td>
           	</tr>
            <?php
			if(!isset($_POST["btCad"])){
			?>
            <tr>
            	<td colspan="2">
            		<b>Descrição:</b><br />
                    <?=$Tlic->lic_desc?>
                    <br />&nbsp;
        		</td>
           	</tr>
            <tr>
            	<td colspan="2">
            		<hr size="1" width="100%"><br />
        		</td>
           	</tr>
            <tr>
            	<td colspan="2" align="center">
                	Para visualizar o edital, você deverá ser preenchido, obrigatoriamente o E-mail<br /><br />
            		E-mail: <input type="text" name="Femail" id="Femail" />
                    <script type="text/javascript">
						var Femail = new LiveValidation('Femail'); 
						Femail.add( Validate.Presence, {failureMessage: " "} ); 
						Femail.add( Validate.Email , {failureMessage: " "} );  
					</script> 
           			<input type="submit" name="btCad" id="btCad" value="cadastrar" />
        		</td>
           	</tr>
            <?php
			}else{
				//---------------------------------------------
				// Se é um cadastro novo, entao joga pro banco
				//---------------------------------------------
				if(isset($_POST["Fnew"])){
					$sqlNewVer 	   	= "SELECT user_id FROM lic_user ORDER BY user_id DESC LIMIT 1";
					$TretSqlNewVer 	= $objpg->pedido($sqlNewVer);
					$TnewUser		= pg_fetch_object($TretSqlNewVer);					
					$TnewId 		= $TnewUser->user_id + 1;					
					$sqcNew		= "INSERT INTO 
									  lic_user(
										  user_id,
										  user_email,
										  user_nome,
										  user_telefone,
										  user_tipo,
										  user_cpf_cnpj
									)VALUES(
									   ".$TnewId.",
									  '".$_POST['FemailConf']."',
									  '".$_POST['Fnome']."',
									  '".$_POST['Ffone']."',
									   ".$_POST['Fpessoa'].",
									  '".$_POST['FcpfCnpj']."')";
					$objpg->pedido($sqcNew);					
				}
				
				//---------------------------------------
				// Verifica se o usuário já é cadastrado
				//---------------------------------------
				$sqlUsr  = "SELECT COUNT(*) FROM lic_user WHERE user_email = '".$_POST['Femail']."'";
				$TretUsr = $objpg->pedido($sqlUsr);
				$Tver	 = pg_fetch_object($TretUsr);
				if($Tver->count == 1){
					//--------------------------------------------------------
					// Verifica se o usuário já tem cadastro para este edital
					//--------------------------------------------------------
					$sqlCad  = "SELECT COUNT(*) FROM lic_baixados WHERE baixado_user = '".$_POST['Femail']."' AND baixado_edital_id = ".$Tlic->lic_id;
					$TretCad = $objpg->pedido($sqlCad);
					$Tcad	 = pg_fetch_object($TretCad);
					$Tdata   = date("Y-m-d");
					$Thora	 = date("H:i");
					if($Tcad->count == 0){
						$sqlNewCad 	   	= "SELECT baixado_id FROM lic_baixados ORDER BY baixado_id DESC LIMIT 1";
						$TretSqlNewCad 	= $objpg->pedido($sqlNewCad);
						$TnewCad		= pg_fetch_object($TretSqlNewCad);					
						$TnewCadId 		= $TnewCad->baixado_id + 1;	
						$sql = "INSERT INTO 
									  lic_baixados(
										  baixado_id,
										  baixado_user,
										  baixado_edital_id,
										  baixado_data,
										  baixado_hora
									)VALUES(
									   ".$TnewCadId.",
									  '".$_POST['Femail']."',
									   ".$Tlic->lic_id.",
									  '".$Tdata."',
									  '".$Thora."')";
						$objpg->pedido($sql);
					}
					//----------------------------------
					//Verifica se há alguma retificação
					//----------------------------------
					$queryRet     = "SELECT * FROM lic_retificacao WHERE ret_lic_dados_id = ".$Tlic->lic_id." ORDER BY ret_data DESC";	
					$countSqlRet  = "SELECT COUNT(*) FROM lic_retificacao WHERE ret_lic_dados_id = ".$Tlic->lic_id;	
					$rqueryRet    = $objpg->pedido($queryRet); 
					$rqueryNunRet = $objpg->pedido($countSqlRet);
					$TvalRet 	  = pg_fetch_object($rqueryNunRet);
					$TnumRet	  = (int)$TvalRet->count;
					?>
					<tr>
                        <td colspan="2" align="center">Segue abaixo os arquivos para downlaod<br />&nbsp;</td>                        
                    </tr>                    
                    <tr>
                        <td width="120" colspan="2" align="center"><img src="../../layout/imagens/ico_pdf.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;<a href="http://www.pmf.sc.gov.br/sistemas/comcap/licitacoes/arquivos/<?=$Tlic->lic_arq_pdf?>"><?=$Tlic->model_desc?> <?=$Tlic->lic_num?> (.pdf)</a>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="120" colspan="2" align="center"><img src="../../layout/imagens/ico_rar.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;<a href="http://www.pmf.sc.gov.br/sistemas/comcap/licitacoes/arquivos/<?=$Tlic->lic_arq_rar?>"><?=$Tlic->model_desc?> <?=$Tlic->lic_num?> (.rar)</a><br />&nbsp;</td>
                    </tr>
					<?php
					if($TnumRet > 0){
						echo "
						<tr>
							<td colspan=\"2\" align=\"center\"><b>Retificações</b><br />&nbsp;</td>                        
						</tr> 
						";						
						while($Tret = pg_fetch_object($rqueryRet)){
						$Tdata = explode("-",$Tret->ret_data);
						$Tdata = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];	
						?>
						<tr>
                            <td width="120" colspan="2" align="center"><img src="../../layout/imagens/ico_pdf.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;<a href="http://www.pmf.sc.gov.br/sistemas/comcap/licitacoes/arquivos/retificado/<?=$Tret->ret_arq_pdf?>"><?=$TnumRet?>&ordf; Retificação: <?=$Tdata?> (.pdf)</a>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="120" colspan="2" align="center"><img src="../../layout/imagens/ico_rar.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;<a href="http://www.pmf.sc.gov.br/sistemas/comcap/licitacoes/arquivos/retificado/<?=$Tret->ret_arq_rar?>"><?=$TnumRet?>&ordf; Retificação: <?=$Tdata?> (.rar)</a><br />&nbsp;</td>
                        </tr>					
						<?php
						$TnumRet--;
						}
					}
				}else{
				?>
                	
                	<script type="text/javascript">
					$(function() {
						$.mask.definitions['~'] = "[+-]";
						$("#Ffone").mask("(99) 9999-9999");
					});
					$(function() {
						$.mask.definitions['~'] = "[+-]";
						$("#FcpfCnpj").mask("999.999.999-99");
					});
					function AlteraMascara(){ 
						if(document.getElementById("Fcpf").checked){
							$(function() {
								$.mask.definitions['~'] = "[+-]";
								$("#FcpfCnpj").mask("999.999.999-99");
							});
						}else{
							$(function() {
								$.mask.definitions['~'] = "[+-]";
								$("#FcpfCnpj").mask("99.999.999/9999-99");
							});
						}
					} 
						
					</script>
					<tr>
                        <td colspan="2" align="center">Para baixar o edital, preencha as informações abaixo.<br />Na próxima vêz que utilizar o sistema, não será solicitado este cadastro.<br />&nbsp;</td>                        
                    </tr>
                    <form method="post">
                    <tr>
                        <td width="120"><b>Nome / R.S.:</b></td>
                        <td width="380">
                        	<input type="text" name="Fnome" id="Fnome" style="width:250px; border:1px solid #666; background-color:#F3F3F3;" />
                        	<script type="text/javascript">
								var Fnome = new LiveValidation('Fnome'); 
								Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
							</script>    
                        </td>
                    </tr>
                    <tr>
                        <td width="120"><b>Email:</b></td>
                        <td width="380">
                        	<input type="text" name="Femail" id="Femail" value="<?=$_POST['Femail']?>" style="width:250px; border:1px solid #666; background-color:#F3F3F3;"/>
                        	<script type="text/javascript">
								var Femail = new LiveValidation('Femail'); 
								Femail.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
								Femail.add( Validate.Email, {failureMessage: "Inválido"} );   
							</script>     
                        </td>
                    </tr>
                    <tr>
                        <td width="120"><b>Confirmar E-mail:</b></td>
                        <td width="380">
                        	<input type="text" name="FemailConf" id="FemailConf"  oncontextmenu="return false;" OnPaste="return false;" style="width:250px; border:1px solid #666; background-color:#F3F3F3;" />
                        	<script type="text/javascript">
								var FemailConf = new LiveValidation('FemailConf'); 
								FemailConf.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
								FemailConf.add( Validate.Email, {failureMessage: "Inválido"} );   
								FemailConf.add( Validate.Confirmation, { match: 'Femail', failureMessage: "Incompatível" } );
							</script>    
                        </td>
                    </tr>
                    <tr>
                        <td width="120"><b>Telefone:</b></td>
                        <td width="380">
                        	<input type="text" name="Ffone" id="Ffone" style="width:250px; border:1px solid #666; background-color:#F3F3F3;" maxlength="10" />
                        	<script type="text/javascript">
								var Ffone = new LiveValidation('Ffone'); 
								Ffone.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
							</script>    
                        </td>
                    </tr>
                    <tr>
                        <td width="120"><b>Pessoa:</b></td>
                        <td width="380">
                        	<input type="radio" value="1" name="Fpessoa" id="Fcpf" onchange="javascript:AlteraMascara()" checked="checked" /> Física &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" value="0" name="Fpessoa" id="Fcnpj" onchange="javascript:AlteraMascara()" /> Jurídica

                        </td>
                    </tr>
                    <tr>
                        <td width="120"><b>CPF / CNPJ:</b></td>
                        <td width="380">
                        	<input type="text" name="FcpfCnpj" id="FcpfCnpj" style="width:250px; border:1px solid #666; background-color:#F3F3F3;" maxlength="14" />
                        	<script type="text/javascript">
								var FcpfCnpj = new LiveValidation('FcpfCnpj'); 
								FcpfCnpj.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
							</script>  <br />
                            <i>apenas números</i>  
                        </td>
                    </tr>
                    <tr>
                        <td width="120"></td>
                        <td width="380">
                        	<input type="hidden" name="Fnew" id="Fnew" value="ok" />
                        	<br /><input type="submit" name="btCad" id="btCad" value="Cadastrar" />
                        </td>
                    </tr>
					</form>
				<?php	
				}
			}
			?>
        </table>
        </form>
	</div>
</div>
<?php
$objpg->close();
?>