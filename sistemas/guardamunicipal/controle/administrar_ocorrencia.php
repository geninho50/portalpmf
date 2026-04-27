<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<META HTTP-EQUIV="REFRESH" CONTENT="05"; URL="administrar_ocorrencia.php">
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #003366;
	font-size: 24px;
}
.style2 {color: #FFFFFF}
-->
</style>
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
<script language="JavaScript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery(".content").hide();
		  //toggle the componenet with class msg_body
		  jQuery(".heading").click(function()
		  {
			jQuery(this).next(".content").slideToggle(500);
		  });
		});
		
		shortcut.add("F3",function() 
		{
			window.location.href = 'cadastro_guarnicao.php';
		});
		shortcut.add("F2",function() 
		{
			window.location.href = 'cadastro_ocorrencia.php';
		});
</script>
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><span class="style1">CENTRAL DE INFORMA&Ccedil;&Otilde;ES E ATENDIMENTO 153 </span><br><font class="negrito">Operador: <? echo $login; ?></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
  <tr>
    <th width="50%" align="left" valign="top" scope="col">
		<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
		  <tr>
			<th height="250" align="left" valign="top" scope="col">
			<legend class="fieldset">OCORRÊNCIAS EM ABERTO</legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" valign="top" align="left">
			<tr>
				<th width="4%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			
			<? 
				$sqlA = "SELECT * FROM ocorrencia where status=0";
				$resultadoA = $obj->executaQuery($sqlA);
				while( $linhaA = mysql_fetch_array($resultadoA))
				{
					$id = $linhaA["id"];
					$telefone = $linhaA["telefone"];
					$comunicante = $linhaA["comunicante"];
					$rua = $linhaA["rua"];
					$numero = $linhaA["numero"];
					$bairro = $linhaA["bairro"];
					$descricao = $linhaA["descricao_ocorrencia"];
					$hora_cadastro = $linhaA["hora_cadastro"];
			?>
			<tr valign="top">
				<th align="center" valign="top" scope="col">&nbsp;</th>
				<th width="96%" align="left" valign="top" class="negrito" scope="col"><a href="javascript:POPUP('empenhar_guarnicao.php?idOcorrencia=<? echo $id; ?>','700','550')"><? echo $hora_cadastro.' - '.$rua;?></a>
				  <p><HR></th>
			  </tr>
			<?
			}
			?>			
		</table>
		</fieldset>			</th>
		  </tr>
		  <tr>
			<th height="450" align="left" valign="top">
			<legend class="fieldset">OCORRÊNCIAS EM ANDAMENTO</legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="6%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="87%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			
				<? 
				$sqlE = "SELECT * FROM ocorrencia where status=1";
				$resultadoE = $obj->executaQuery($sqlE);
				while( $linhaE = mysql_fetch_array($resultadoE))
				{
					$id = $linhaE["id"];
					$rua = $linhaE["rua"];
					$vtr1 = $linhaE["vtr01"];
					$vtr2 = $linhaE["vtr02"];
					$horachegada = $linhaE["hora_chegada1"];
					$telefone = $linhaE["telefone"];
					$comunicante = $linhaE["comunicante"];
					$rua = $linhaE["rua"];
					$numero = $linhaE["numero"];
					$bairro = $linhaE["bairro"];
					$descricao = $linhaE["descricao_ocorrencia"];
					
										
					$sqlB = "SELECT * FROM guarnicao where vtr01='$vtr1' and status!=0 and data_entrada='$data_atual'";
					$resultadoB = $obj->executaQuery($sqlB);
					if( $linhaB = mysql_fetch_array($resultadoB))
					{
						$gm1_1 = $linhaB["guarda1"];
						$gm1_2 = $linhaB["guarda2"];
						$gm1_3 = $linhaB["guarda3"];
						$gm1_4 = $linhaB["guarda4"];
						
				?>
					<tr>
					<th align="center" valign="top" scope="col"><a href="../classes/controleChegarOcorrencia.php?idOcorrencia=<? echo $id; ?>"><? if($horachegada == ''){?><img src="images/j10.png" border="0" title="J10"><? }?></a></th>
					<th width="87%" align="left" valign="top" scope="col" class="negrito">
						<a href="javascript:POPUP('finalizar_ocorrencia.php?idOcorrencia=<? echo $id; ?>','700','550')"><? echo $rua?> <? if($horachegada != ''){?><img src="images/true.gif" border="0" /><? }?><? echo '<br>'.$vtr1.' = '.$gm1_1.' / '.$gm1_2.' / '.$gm1_3.' / '.$gm1_4;?></a>
					<p><HR></th>
				
				</tr>
				<?
					}
				}
				?>	
			
		</table>
		</fieldset>
			</th>
		  </tr>
		</table>
		</th>
    <th width="50%" align="left" scope="col" valign="top" ><table width="100%" height="710"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
      <tr>
        <th height="580" align="center" valign="top" scope="col">
		
		
		<legend class="fieldset">GUARNI&Ccedil;&Otilde;ES DISPON&Iacute;VEIS </legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="1%" align="left" valign="top" scope="col">&nbsp;</th>
				<th width="61%" align="left" valign="top" scope="col">&nbsp;</th>
			</tr>
			<?
				$sqlG = "SELECT * FROM guarnicao where status=1 order by vtr01";
				$resultadoG = $obj->executaQuery($sqlG);
				while( $linhaG = mysql_fetch_array($resultadoG))
				{
					$id = $linhaG["id"];
					$vtr1 = $linhaG["vtr01"];
					$guarda1 = $linhaG["guarda1"];
					$guarda2 = $linhaG["guarda2"];
					$guarda3 = $linhaG["guarda3"];
					$guarda4 = $linhaG["guarda4"];
					$outros = $linhaG["outros"];
					
					$sqlV = "SELECT * FROM vtr WHERE vtr='$vtr1'";
					$resultadoV = $obj->executaQuery($sqlV);
					if( $linhaV = mysql_fetch_array($resultadoV))
					{
						$classe = $linhaV["classe"];
			?>
				<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
					<th height="20" align="center"></th>
					<th width="70%" height="30" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>" class="negrito"><? echo $vtr1.' = '.$guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' - '.$outros;?></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="J4('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=J4')" href="#">	   
	   <IMG SRC="images/j4.png" width="20" height="20" BORDER="0" title="J4"></A></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="J5('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=J5')" href="#">	   
	   <IMG SRC="images/j5.png" width="20" height="20" BORDER="0" title="Excluir"></A></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="J6('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=J6')" href="#">	   
	   <IMG SRC="images/j6.png" width="20" height="20" BORDER="0" title="Excluir"></A></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="Excluir('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=J8')" href="#">	   
	   <IMG SRC="images/j8.png" width="20" height="20" BORDER="0" title="Excluir"></A></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="Excluir('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=Finalizar')" href="#">	   
	   <IMG SRC="images/j12.png" width="20" height="20" BORDER="0" title="Excluir"></A></th>
					<th width="5%" align="left" bgcolor="<? if($classe=='MT'){?>#E8E8E8<? }else{if($classe=='VTR'){?> #CFCFCF<? }else{$classe=='P18'?>#B5B5B5 <? }}?>"><a onClick="Excluir('../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=INDISPONIVEL')" href="#">	   
	   <IMG SRC="images/in.png" width="20" height="20" BORDER="0" title="Excluir"></A></th>
				
				</tr>
				<? 
					}
				}?>
			</table>
		</fieldset>        </th>
      </tr>
      <tr>
        <td height="120" align="center" valign="top"><table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
          <tr>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J4</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J5</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J6</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J8</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">Indispon&iacute;vel</th>
          </tr>
        <tr>  
           <?
		    	
				$sqlJ4 = "SELECT * FROM guarnicao where status=3 order by vtr01";
				$resultadoJ4= $obj->executaQuery($sqlJ4);
				while( $linhaJ4 = mysql_fetch_array($resultadoJ4))
				{
					$id = $linhaJ4["id"];
					$vtr1 = $linhaJ4["vtr01"];
					$guarda1 = $linhaJ4["guarda1"];
					$guarda2 = $linhaJ4["guarda2"];
					$guarda3 = $linhaJ4["guarda3"];
					$guarda4 = $linhaJ4["guarda4"];
					$outros = $linhaJ4["outros"];
			?>
				<td align="left"><? echo $vtr1;?> - <? echo $hora_atual;?> <A href="../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=ExcluirJ4"><img src="images/false.gif" border="0" title="<? echo $guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' / '.$outros;?>"/></A></td>
			<?
		    	
				}		    	
				$sqlJ5 = "SELECT * FROM guarnicao where status=4 order by vtr01";
				$resultadoJ5= $obj->executaQuery($sqlJ5);
				while( $linhaJ5 = mysql_fetch_array($resultadoJ5))
				{
					$id = $linhaJ5["id"];
					$vtr1 = $linhaJ5["vtr01"];
					$guarda1 = $linhaJ5["guarda1"];
					$guarda2 = $linhaJ5["guarda2"];
					$guarda3 = $linhaJ5["guarda3"];
					$guarda4 = $linhaJ5["guarda4"];
					$outros = $linhaJ5["outros"];
			?>
				<td align="left"><? echo $vtr1;?> - <? echo $hora_atual;?> <A href="../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=ExcluirJ5"><img src="images/false.gif" border="0" title="<? echo $guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' / '.$outros;?>"/></A></td>
			<? 
				}		    	
				$sqlJ6 = "SELECT * FROM guarnicao where status=5 order by vtr01";
				$resultadoJ6= $obj->executaQuery($sqlJ6);
				while( $linhaJ6 = mysql_fetch_array($resultadoJ6))
				{
					$id = $linhaJ6["id"];
					$vtr1 = $linhaJ6["vtr01"];
					$guarda1 = $linhaJ6["guarda1"];
					$guarda2 = $linhaJ6["guarda2"];
					$guarda3 = $linhaJ6["guarda3"];
					$guarda4 = $linhaJ6["guarda4"];
					$outros = $linhaJ6["outros"];
			?>
				<td align="left"><? echo $vtr1;?> - <? echo $hora_atual;?> <A href="../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=ExcluirJ6"><img src="images/false.gif" border="0" title="<? echo $guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' / '.$outros;?>"/></A></td>
			<? 
				}
				$sqlJ8 = "SELECT * FROM guarnicao where status=6 order by vtr01";
				$resultadoJ8= $obj->executaQuery($sqlJ8);
				while( $linhaJ8 = mysql_fetch_array($resultadoJ8))
				{
					$id = $linhaJ8["id"];
					$vtr1 = $linhaJ8["vtr01"];
					$guarda1 = $linhaJ8["guarda1"];
					$guarda2 = $linhaJ8["guarda2"];
					$guarda3 = $linhaJ8["guarda3"];
					$guarda4 = $linhaJ8["guarda4"];
					$outros = $linhaJ8["outros"];
			?>
				<td align="left"><? echo $vtr1;?> - <? echo $hora_atual;?> <A href="../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=ExcluirJ8"><img src="images/false.gif" border="0" title="<? echo $guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' / '.$outros;?>"/></A></td>
			<? 
				}
				$sqlJ8 = "SELECT * FROM guarnicao where status=7 order by vtr01";
				$resultadoJ9= $obj->executaQuery($sqlJ9);
				while( $linhaJ9 = mysql_fetch_array($resultadoJ9))
				{
					$id = $linhaJ9["id"];
					$vtr1 = $linhaJ9["vtr01"];
					$guarda1 = $linhaJ9["guarda1"];
					$guarda2 = $linhaJ9["guarda2"];
					$guarda3 = $linhaJ9["guarda3"];
					$guarda4 = $linhaJ9["guarda4"];
					$outros = $linhaJ9["outros"];
			?>
				<td align="left"><? echo $vtr1;?> - <? echo $hora_atual;?> <A href="../classes/controleAdministrarGuarnicao.php?idGuarnicao=<? echo $id;?>&chave=ExcluirINDISPONIVEL"><img src="images/false.gif" border="0" title="<? echo $guarda1.' / '.$guarda2.' / '.$guarda3.' / '.$guarda4.' / '.$outros;?>"/></A></td>
			<? 
				}
			?>
			</tr>
        </table></td>
      </tr>
    </table>
		</th>
  </tr>
</table>


	</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
