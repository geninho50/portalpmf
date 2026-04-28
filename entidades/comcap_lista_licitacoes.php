<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//-----------------------
// Controle de paginação
//-----------------------
require_once("../../scripts/php/paginacao.php");	
if(!isset($_GET['pg'])){
	$pg = 1;
}else{
	$pg = $_GET['pg'];	
	}	
$inicio = ($pg * 10) - 10;

//------------------------
// Busca lista de Editais
//------------------------
require_once('../../sistemas/comcap/licitacoes/scripts/php/conexao.class.php');
$objpg->conecta();
$countSql  = "SELECT COUNT(*) FROM lic_dados WHERE lic_status = 0";
$sql 	 = "SELECT LIC.*, MODEL.*, NAT.*, SIT.*, EST.*, TIP.* FROM lic_dados AS LIC 
				INNER JOIN lic_modalidade AS MODEL ON MODEL.model_id = LIC.lic_model_id
				INNER JOIN lic_natureza AS NAT ON NAT.nat_id = LIC.lic_nat_id 
				INNER JOIN lic_situacao AS SIT ON SIT.sit_id = LIC.lic_sit_id 
				INNER JOIN lic_estado AS EST ON EST.est_id = LIC.lic_est_id 
				INNER JOIN lic_tipo AS TIP ON TIP.tipo_id = LIC.lic_tipo_id 
			WHERE LIC.lic_status = 0
			ORDER BY LIC.lic_num DESC
			LIMIT 10 OFFSET $inicio";
$TretSql = $objpg->pedido($sql);
$rqueryNun = $objpg->pedido($countSql);
?>

<div id="cabecalho_servicos" class="canto_redondo">
	<div id="caminho_migalhas">home &gt; licitações</div>
	<div id="titulo_pagina">licitações da COMCAP</div>
	<div class="box_msg_baixo">Clique no <u><i>nº do edital</i></u> ou na <u><i>descrição</i></u> para mais informações a respeito da licitação.</div> 
	<br />
</div>
<div id="area_servicos">
	<br /><br />
	<div class="comcap_desc">
        <table width="520" border="0" cellpadding="3" cellspacing="3">
            <tr>
            	<td width="90" align="center">
                	<img src="../../layout/imagens/logo_comcap.png" border="0" />
                </td>
                <td width="430" align="center" colspan="2">
                	Sistema de Divulgação de Editais de Licitação da Companhia Melhoramentos da Capital                 	
                </td>
            </tr>
            <tr>
                <td width="90" style="background-color:#1B9BE4;"><font color="#FFFFFF">&nbsp;<b>Nº Edital</b></font></td>
                <td width="285" style="background-color:#1B9BE4;"><font color="#FFFFFF">&nbsp;<b>Descrição do Objeto</b></font></td>
                <td width="145" style="background-color:#1B9BE4;"><font color="#FFFFFF">&nbsp;<b>Abertura / Situação</b></font></td>
            </tr>
            <?php
            while($Tlic = pg_fetch_object($TretSql)){
				$Tdata = explode("-",$Tlic->lic_data_abertura);
				$Tdata = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
				
				//--------------------------------------
				// verifica se o edital tem retificação
				//--------------------------------------
				$countSqlRet  = "SELECT COUNT(*) FROM lic_retificacao WHERE ret_lic_dados_id = ".$Tlic->lic_id;	
				$rqueryNunRet = $objpg->pedido($countSqlRet);
				$TvalRet	  = pg_fetch_object($rqueryNunRet);
				$TnumRet	  = (int)$TvalRet->count;
				
				?>
				<tr>
                    <td width="90" style="background-color:#F5F5F5;" align="center">
                    	<a href="?pagina=ccpusr&l=<?=$Tlic->lic_id?>&menu=<?=$_GET['menu']?>"><?=$Tlic->model_desc?><br /><?=$Tlic->lic_num?></a>
                        <?php
                        if($TnumRet > 0){ echo "<img src=\"../../layout/imagens/ico_retificado.png\" border=\"0\" />"; }
						?>
                        </td>
                    <td width="285" style="background-color:#F5F5F5;">
                    	<a href="?pagina=ccpusr&l=<?=$Tlic->lic_id?>&menu=<?=$_GET['menu']?>"><?=$Tlic->lic_desc?></a><br />
                        <span style="font-size:9px">
                        	<b>Natureza: </b><font color="#1B9BE4"><?=$Tlic->nat_desc?></font><br />
                            <b>Tipo: </b><font color="#1B9BE4"><?=$Tlic->tipo_desc?></font>
                        </span>
                    </td>
                    <td width="145" style="background-color:#F5F5F5;" align="center">&nbsp;<b><?=$Tlic->sit_desc?></b><br /><?=$Tdata?> - <?=$Tlic->lic_hora_abertura?><br /><b><span style="font-size:10px; color:#1B9BE4;"><?=$Tlic->est_desc?></span></b></td>
                </tr>
			<?php	
			}
			?>
        </table>
	</div>
    <?php
	//-------------------------
	// Imprime o Nº de páginas
	//-------------------------
	$Tcaminho = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];
	$numPagTotal = pg_fetch_object($rqueryNun);
	echo "<p align=\"center\">";
	$TnumPag = $numPagTotal->count;
	if($TnumPag < 10){
		$TnumPag = 10;
	}
	mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
	echo "<p>";		
	$objpg->close();
	?>
</div>