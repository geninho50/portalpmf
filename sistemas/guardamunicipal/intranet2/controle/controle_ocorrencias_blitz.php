
<legend class="fieldset">OPERAÇÃO DE TRÂNSITO</legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="45%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			
				<? 
				$sqlE = "SELECT * FROM ocorrencia where status=1 and chave=2";
				$resultadoE = $obj->executaQuery($sqlE);
				while( $linhaE = mysql_fetch_array($resultadoE))
				{
					$id = $linhaE["id"];
					$rua = $linhaE["rua"];
					$horachegada = $linhaE["hora_chegada"];
					$telefone = $linhaE["telefone"];
					$responsavel = $linhaE["responsavel"];
					$rua = $linhaE["rua"];
					$numero = $linhaE["numero"];
					$bairro = $linhaE["bairro"];
					$descricao = $linhaE["descricao_ocorrencia"];
					$infracao = $linhaE["infracao"];
					
										
					
						
				?>
					<tr>
					<th width="6%" align="center" valign="top" scope="col"><a href="../classes/controleChegarOperacao.php?idOcorrencia=<? echo $id; ?>">
					<? if($horachegada == ''){?>
                        <img src="imagens/j10.png" width="24" height="24" border="0" title="J10">                    
					<? }?></a>
                    <? if($horachegada != ''){?>
                    	<img src="imagens/sinal_verde.png" width="24" height="24" border="0" title="<? echo $horachegada; ?>"/>
					<? }?>
                        
                    </th>
					<th width="45%" align="left" valign="top" scope="col" class="negrito" title="<? echo 'Responsavel: '.$responsavel.'&#13;Endereco: '.$rua.', '.$numero.' - '.$bairro;?>" >
						<a href="javascript:POPUP('finalizar_ocorrencia.php?idOcorrencia=<? echo $id; ?>','720','680')"><? echo $rua.', '.$numero;?> 
							
						<? 
						$sqlB = "SELECT ocorrencia_guarnicao.idguarnicao,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 FROM ocorrencia_guarnicao inner join guarnicao where ocorrencia_guarnicao.idocorrencia=$id and guarnicao.id=ocorrencia_guarnicao.idguarnicao";
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
					</th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('quantidade_acimalimite.php?idOcorrencia=<? echo $id;?>','800','250')"><img src="imagens/bafometro.png" width="24" height="24" title="ADICIONAR INFORMACOES DO BAFOMETRO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('adicionar_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','150')"><img src="imagens/add_guarnicao.png" width="24" height="24" title="ADICIONAR GUARNICOES NA OCORRENCIA" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('adicionar_dados_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','350')"><img src="imagens/add_informacao.png" width="24" height="24" title="ADICIONAR INFORMACOES NA OCORRENCIA" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('trocar_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id;?>','720','300')"><img src="imagens/TR.png" width="24" height="24" title="TROCAR GUARNICAO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('remover_guarnicao_ocorrencia.php?idOcorrencia=<? echo $id; ?>','720','300')"><img src="imagens/REMOVER.png" width="24" height="24" title="REMOVER GUARNICAO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('cadastro_auto_infracao.php?idOcorrencia=<? echo $id; ?>','800','270')"><img src="imagens/bloco.png" width="24" height="24" title="AUTO DE INFRACAO DE TRANSITO" border="0"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('cadastro_guinchamento.php?idOcorrencia=<? echo $id; ?>','800','600')"><img src="imagens/guincho.png" width="24" height="24" border="0" usemap="#Map" title="GUINCHAMENTO DE VEICULOS"/></a></th>
					<th width="6%" align="center" valign="top" scope="col"><a href="javascript:POPUP('cadastro_conduzido_delegacia.php?idOcorrencia=<? echo $id; ?>','800','600')"><img src="imagens/grade.png" width="24" height="24" border="0" usemap="#Map2" title="ENCAMINHAMENTO A DELEGACIA"/></a></th>
				
				</tr>
				<?
				}
				?>	
		
		</table>
		</fieldset>
        <map name="Map" id="Map">
          <area shape="circle" coords="13,6,0" href="#" />
        </map>

<map name="Map2" id="Map2">
  <area shape="circle" coords="2,15,0" href="#" />
</map>
