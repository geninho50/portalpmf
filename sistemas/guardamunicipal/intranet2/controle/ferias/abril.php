        <td width="15%" align="center" valign="top" class="negrito">
		<?
			$sqlJ = "SELECT id,login,atividade,DAY(data_inicial) as diaI,MONTH(data_inicial) as mesI,YEAR(data_inicial) as anoI,DAY(data_final) as diaF,MONTH(data_final) as mesF,YEAR(data_final) as anoF FROM ferias where (MONTH(data_inicial)=4 and YEAR(data_inicial)=$ano_atual and grupo=$id) or (MONTH(data_final)=4 and YEAR(data_final)=$ano_atual and grupo=$id)";
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

				if($atividade==2){
					echo '<font color="#4682B4">ATESTADO: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
				}if($atividade==4){
					echo '<font color="#FF0000">DOACAO DE SANGUE: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
			    }if($atividade==5){
					echo '<font color="#ffa500">LICENCA GALA: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
				}if($atividade==6){
					echo '<font color="#cccccc">LICENCA NOJO: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
				}if($atividade==7){
					echo '<font color="#00bfff">LICENCA PATERNIDADE: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
			 	}if($atividade==8){
					echo '<font color="#ff00ff">LICENCA GESTACAO: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>';
			    }if($atividade==9){
					echo '<font color="#ffff00">LICENCA NAO REMUNERADA: <br>'.$loginM.'('.$diaI.'-'.$mesI.'-'.$anoI.' a '.$diaF.'-'.$mesF.'-'.$anoF.')</font><br>'; 
				}
			}
		?>
		</td>