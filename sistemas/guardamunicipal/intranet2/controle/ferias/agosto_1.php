<td width="15%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT id,login,atividade,DAY(data_inicial) as diaI,MONTH(data_inicial) as mesI,YEAR(data_inicial) as anoI,DAY(data_final) as diaF,MONTH(data_final) as mesF,YEAR(data_final) as anoF FROM ferias where (MONTH(data_inicial)=8 and YEAR(data_inicial)=$ano_atual and grupo=$id) or (MONTH(data_final)=8 and YEAR(data_final)=$ano_atual and grupo=$id)";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$atividade = $linhaJ['atividade'];
				$mesI = $linhaJ['mesI'];
				$anoI = $linhaJ['anoI'];
				$diaI = $linhaJ['diaI'];
				$mesF = $linhaJ['mesF'];
				$anoF = $linhaJ['anoF'];
				$diaF = $linhaJ['diaF'];

				if($atividade==2){?>
					<a href="#" title="ATESTADO" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#4682B4">'.$loginM.'</font><font size="-2" color="#000000" title="ATESTADO">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
			<?	}
				if($atividade==4){?>
					<a href="#" title="DOACAO DE SANGUE" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#FF0000">'.$loginM.'</font><font size="-2" color="#000000" title="DOACAO DE SANGUE">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
					
			<?	}if($atividade==5){?>
					<a href="#" title="LICENCA GALA" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#ffa500">'.$loginM.'</font><font size="-2" color="#000000" title="LICENCA GALA">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
					
			<?	}if($atividade==6){?>
					<a href="#" title="LICENCA NOJO" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#cccccc">'.$loginM.'</font><font size="-2" color="#000000" title="LICENCA NOJO">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
					
			<?	}if($atividade==7){?>
					<a href="#" title="LICENCA PATERNIDADE" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#00bfff">'.$loginM.'</font><font size="-2" color="#000000" title="LICENCA PATERNIDADE">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
					
			<?	}if($atividade==8){?>
					<a href="#" title="LICENCA GESTACAO" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#ff00ff">'.$loginM.'</font><font size="-2" color="#000000" title="LICENCA GESTACAO">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
				
			<? }if($atividade==9){?>
					<a href="#" title="LICENCA NAO REMUNERADA" onClick="Excluir('../classes/controleAdmFerias.php?id=<? echo $idM;?>&login=<? echo $loginM;?>&mes=<? echo $mesI;?>&ano=<? echo $anoI;?>')"><? echo '<font color="#ffff00">'.$loginM.'</font><font size="-2" color="#000000" title="LICENCA NAO REMUNERADA">&nbsp;('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';?></a>
				<? }
			}
		?>
		</td>