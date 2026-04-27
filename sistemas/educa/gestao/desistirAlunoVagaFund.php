<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	session_unset(); 
	session_destroy();
	header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
	if ($_SESSION['aut_gm'] != true) {
		header('Location: index.php');
	}
} else {
	header('Location: index.php');
}

if(isset($_GET['id'])){
	include 'fnc/verificaSeExisteLista.php';
	//include 'fnc/verificaLista.php';

	include_once('fnc/connect.php');

	$sqlSelect = sprintf("SELECT Aluno_Pessoa_Fisica_Pessoa_id_pessoa, 
		Tipo_Vaga_id_tipo_vaga, 
		Fase_Periodo_Periodo_id_ano, 
		Fase_Periodo_Periodo_id_periodo, 
		Fase_Periodo_Fase_id_ano_serie, 
		Fase_Periodo_Fase_Curso_id_curso,
		Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa FROM matricula.vaga
		where id_vaga = %s", mysql_real_escape_string($_GET['id']));

	$resultado = mysql_query($sqlSelect);

	$row = true;

	$i = 0;
	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		$i++;
		if ($row[0] != '') {
			$dados = $row;
		}
	}

	if($dados != false){
		if(verificaSeExisteLista($_GET['id']) == true){
			$sql = sprintf("update matricula.vaga
				set Aluno_Pessoa_Fisica_Pessoa_id_pessoa = null,
				Tipo_Vaga_id_tipo_vaga = 3
				where id_vaga = %s", mysql_real_escape_string($_GET['id']));
			$possuiLista = true;
		} else {		
			$sql = sprintf("update matricula.vaga
				set Aluno_Pessoa_Fisica_Pessoa_id_pessoa = null,
				Tipo_Vaga_id_tipo_vaga = 1
				where id_vaga = %s", mysql_real_escape_string($_GET['id']));
			$possuiLista = false;
		}

		$resultado = mysql_query($sql);
		if($resultado == true){

			$sql = sprintf("INSERT INTO `matricula`.`auditoria_vaga_fund_remover`
							(`id_aluno`,
							`id_tipo_vaga`,
							`id_ano`,
							`id_periodo`,
							`id_ano_serie`,
							`id_curso`,
							`id_escola`,
							`id_pessoa_alterou`,
							`id_motivo`,
							`dt_alteracao`)
							VALUES
							(%s,
							%s,
							%s,
							%s,
							%s,
							%s,
							%s,
							%s,
							%s,
							sysdate())", mysql_real_escape_string($dados[0])
										, mysql_real_escape_string($dados[1])
										, mysql_real_escape_string($dados[2])
										, mysql_real_escape_string($dados[3])
										, mysql_real_escape_string($dados[4])
										, mysql_real_escape_string($dados[5])
										, mysql_real_escape_string($dados[6])
										, mysql_real_escape_string($_SESSION['usuario']['id'])
										, mysql_real_escape_string($_GET['motivo']));

			$resultado = mysql_query($sql);

			header('Location: '.$_SERVER['HTTP_REFERER'].'&remocao=true&possuiLista='.$possuiLista);
		} else {
			header('Location: '.$_SERVER['HTTP_REFERER'].'&remocao=false&possuiLista='.$possuiLista);
		}
	}
}


?>