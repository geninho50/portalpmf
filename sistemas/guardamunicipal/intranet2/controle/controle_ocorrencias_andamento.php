<!-- ini inc head -->
					<?php 

	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

					include("incValidaSessao.php");
					$idsession = $_SESSION['idSESSION'];
					require ("../classes/DB_mysql.php");
					require ("../classes/trataString.php");
					$obj = new DB_mysql ;
					$objS = new trataString;
					$conexao = $obj->conectarConf();
					include("head/incHeadCentral.php");
					?>
			<!-- fim inc head -->
<legend class="fieldset">OCORR&Ecirc;NCIAS EM ANDAMENTO</legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="57%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			
				<? 
				$sqlE = "SELECT * FROM ocorrencia where status=1 and chave=1";
				$resultadoE = $obj->executaQuery($sqlE);
				while( $linhaE = mysql_fetch_array($resultadoE))
				{
					$id = $linhaE["id"];
					$rua = $linhaE["rua"];
					$horachegada = $linhaE["hora_chegada"];
					$telefone = $linhaE["telefone"];
					$comunicante = $linhaE["comunicante"];
					$rua = $linhaE["rua"];
					$numero = $linhaE["numero"];
					$bairro = $linhaE["bairro"];
					$descricao = $linhaE["descricao_ocorrencia"];
					$infracao = $linhaE["infracao"];
					
										
					
						
				?>
					<tr>
					<th width="6%" align="center" valign="top" scope="col"><a href="../classes/controleChegarOcorrencia.php?idOcorrencia=<? echo $id; ?>">
					<? if($horachegada == ''){?>
                        <img src="imagens/j10.png" width="24" height="24" border="0" title="J10">                   
                    <? }?></a>
                    <? if($horachegada != ''){?>
                    	<img src="imagens/sinal_verde.png" border="0" title="<? echo $horachegada; ?>" />
					<? }?>
                        </th>
					<th width="57%" align="left" valign="top" scope="col" class="negrito" title="<? echo 'Comunicante: '.$comunicante.' - '.$telefone.'&#13;Endere&ccedil;o: '.$rua.', '.$numero.' - '.$bairro.'&#13;Descri&ccedil;&atilde;o: '.$descricao.'&#13;Infra&ccedil;&atilde;o: '.$infracao;?>" >
						<a href="javascript:POPUP('finalizar_ocorrencia.php?idOcorrencia=<? echo $id; ?>','720','680')"><? echo $rua.', '.$numero;?> 
							
						<? 
						$sqlB = "SELECT ocorrencia_atendida.idguarnicao,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 FROM ocorrencia_atendida inner join guarnicao where ocorrencia_atendida.idocorrencia=$id and guarnicao.id=ocorrencia_atendida.idguarnicao and ocorrencia_atendida.visivel=2 order by ocorrencia_atendida.id";
						$resultadoB = $obj->executaQuery($sqlB);
						while( $linhaB = mysql_fetch_array($resultadoB))
						{
							$vtr = $linhaB["vtr"];
							$gm1_1 = $linhaB["guarda1"];
							$gm1_2 = $linhaB["guarda2"];
							$gm1_3 = $linhaB["guarda3"];
							$gm1_4 = $linhaB["guarda4"];
							$gm1_5 = $linhaB["guarda5"];
						
								if($gm1_1 != '' ){echo '<br>'.$vtr.' = '.$gm1_1;}
								if($gm1_2 != '' ){echo ' / '.$gm1_2;}
								if($gm1_3 != '' ){echo ' / '.$gm1_3;}
								if($gm1_4 != '' ){echo ' / '.$gm1_4;}
								if($gm1_5 != '' ){echo ' / '.$gm1_5;}
						}
						?>
					</a>
					<br><HR></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('adicionar_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','150')"><img src="imagens/add_guarnicao.png" width="24" height="24" title="ADICIONAR GUARNICOES NA OCORRENCIA" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('adicionar_dados_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','350')"><img src="imagens/add_informacao.png" width="24" height="24" title="ADICIONAR INFORMACOES NA OCORRENCIA" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('trocar_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','300')"><img src="imagens/TR.png" width="24" height="24" title="TROCAR GUARNICAO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('remover_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id; ?>','720','300')"><img src="imagens/REMOVER.png" width="24" height="24" title="REMOVER GUARNICAO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('cadastro_guinchamento.php?idOcorrencia=<? echo $id; ?>','800','600')"><img src="imagens/guincho.png" width="24" height="24" title="GUINCHAMENTO DE VEICULOS" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('cadastro_conduzido_delegacia.php?idOcorrencia=<? echo $id; ?>','800','600')"><img src="imagens/grade.png" width="24" height="24" title="ENCMINHAMENTO A DELEGACIA" border="0"/></a></th>
				
				</tr>
				<?
				}
				?>	
		
		</table>
		</fieldset>