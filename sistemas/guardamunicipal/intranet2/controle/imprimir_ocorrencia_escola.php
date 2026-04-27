<?php
	ini_set('default_charset','UTF-8');
	
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
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
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
    $idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	$idEscola = (int)$_POST['idEscola'];
	if( $idOcorrencia == 0 || $idEscola == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
		$idEscola = (int)$_GET['idEscola'];
	}
   
    $sqlA = "SELECT * FROM escolas where id=$idEscola";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$nome = $linhaA["nome"];
   }
   
   $query = "select * from solicitacaoescola where escola=$idEscola";
   $resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
   while ($linha=mysql_fetch_array($resultado))
   {
	 $idOcorrencia = $linha['id'];
	 $escola = $linha['escola'];
	 $guarda = $linha['guarda'];
	 $guarda1 = $linha['guarda1'];
	 $guarda2 = $linha['guarda2'];
	 $comunicante = $linha['comunicante'];
	 $vtr = $linha['vtr'];
	 $tipo = $linha['tipo'];
	 $descricao = $linha['descricao'];
	 $data_cadastro = $linha['data_cadastro'];
	 $hora_cadastro = $linha['descricao'];
   }
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/central_ocorrencia.php");?>
<!-- fim inc head -->

</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="100%" height="42" colspan="2">
		<!--topo-->
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" background="images/topo_fundo.jpg">
		  <tr>
			<td width="798" valign="bottom">&nbsp;</td>
			<td width="100%" colspan="2">&nbsp;</td>
		  </tr>
	    </table>
		<!--topo-->
	</th>
  </tr>
  <tr>
    <td height="85%" colspan="2" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="88%" valign="top">
          <fieldset>
			<legend class="cabecalho">CADASTRAR OCORRÊNCIA</legend>
		    <form action="../classes/controleOcorrenciaEscola.php" method="post" name="form" id="form" onsubmit="return validaFormAll(this,'Confirmar','Confirmar')" >
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                    <tr>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td width="230">&nbsp;</td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td width="650">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Ocorr&ecirc;ncia de N&ordm;:</td>
                      <td align="left" class="negrito"><? echo $idOcorrencia;?></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Escola:</td>
                      <td align="left" class="negrito"><? echo $nome;?></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"  class="letra">Gerado por:</td>
                      <td align="left" class="negrito"><? echo $guarda;?></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="251" align="right" class="letra">Guarnição:</td>
                      <td align="left" class="negrito"><? echo $vtr.' - '.$guarda1.' / '.$guarda2;?></td>
                      <td width="76" align="right"  class="letra">:</td>
                      <td align="left" class="negrito">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" class="letra">Solicitante</td>
                      <td align="left" class="negrito"><? echo $comunicante; ?></td>
                      <td align="right"  class="letra">&nbsp;</td>
                      <td align="left" class="negrito">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
                  <tr>
                    <td align="right" valign="top" >Tipificação:</td>
                    <td width="956"  align="left" class="negrito"><? echo $tipo; ?></td>
                  </tr>
                  <tr>
                    <td width="253" align="right" valign="top" >Descri&ccedil;&atilde;o da Ocorr&ecirc;ncia:</td>
                    <td align="left" class="negrito"><? echo $descricao;?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              </table>
        </form>
		</fieldset>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>

</html>


