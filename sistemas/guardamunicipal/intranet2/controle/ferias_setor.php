<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$idFerias = $_GET['idFerias'];
	$nome = $_GET['setor'];
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   $ano = 2010;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="negrito"><BR>&nbsp;&nbsp;&nbsp;&nbsp;SETOR:&nbsp;<? echo $nome; ?><hr/>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr align="center" bgcolor="#006699">
					<td width="10%" bgcolor="#006699" class="branco">Troca Setor</td>
					<td width="7%" bgcolor="#006699" class="branco">Colocação</td>
					<td width="17%" bgcolor="#006699" class="branco">Guarda</td>
					<? for($i=0;$ano<=$ano_atual;$i++){?>
                    	<td width="10%" bgcolor="#006699" class="branco"><? echo $ano;?></td>
                    <? 
							$ano=$ano+1;
						} 
					?>
                    <td width="11%" bgcolor="#006699" class="branco">Soma</td>
                    <td width="12%" bgcolor="#006699" class="branco">Antiguidade</td>
				  </tr>
				<?
						$cont=0;
						$queryF = "SELECT id,login,soma,antiguidade,grupo FROM usuario where grupo=$idFerias order by ordenar asc, antiguidade asc";
						$resultF = $obj->executaQuery($queryF);
						while($dados = mysql_fetch_array($resultF))
						{
							$cont++;
							$idusuario = $dados['id'];
							$login = $dados['login'];
							$soma = $dados['soma'];
							$idgrupo = $dados['grupo'];
							$antiguidade = $dados["antiguidade"];
							$sqlF = "SELECT id,login,grupo,ponto,ponto FROM ferias where login='$login'";
							$resultadoF = $obj->executaQuery($sqlF);
							$linhaF = mysql_fetch_array($resultadoF);
							if( $linhaF )
							{
								$id = $linhaF["id"];
								$login1 = $linhaF["login"];
								$grupo = $linhaF["grupo"];
								$ponto = $linhaF["ponto"];
							?>
					  <tr align="center" bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
						<td width="10%" height="18" class="negrito"><a href="troca_agente_setor.php?id=<? echo $idusuario; ?>"><img src="imagens/troca.png" width="16" height="16" border="0"></a></td>
						<td width="7%" class="negrito"><? echo $cont;?></td>
						<td width="17%" class="negrito"><? echo $login1; ?></td>
						
						<? for($i=0;$ano<=$ano_atual;$i++){?>
                    			<td width="10%" bgcolor="#006699" class="branco">
									<?
										$sql = "SELECT ponto FROM ferias where YEAR(data_inicial)=$ano and login='$login1' and atividade=1";
										$resultado = $obj->executaQuery($sql);
										$linha = mysql_fetch_array($resultado);
										if( $linha )
										{
											echo $ponto = $linha["ponto"]; 
										}
									?>
                        		</td>
						<? 
                                $ano=$ano+1;
                            } 
                        ?>
						<td width="11%" class="negrito"><? echo $soma;?></td>
						<td width="12%" class="negrito"><? echo $antiguidade;?></td>
					  </tr>			
							<?
							}
						}
				?>
				</table>
			</td>
		  </tr>
		</table>
</body>
</html>